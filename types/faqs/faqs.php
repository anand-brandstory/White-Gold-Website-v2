<?php

namespace BFS\Types;

require_once __ROOT__ . '/lib/providers/wordpress.php';

use BFS\CMS\WordPress;

class FAQs {

	private static $typeSlug = 'faq';

	public static function getPreparedData ( $content ) {

		if ( empty( $content ) )
			return $content;

		$content->set( 'url', str_replace( home_url(), '/' . REGION, get_permalink( $content->get( 'ID' ) ) ) );
		$content->set( 'featuredImage', get_the_post_thumbnail_url( $content->get( 'ID' ) ) );

		$faqTextualContent = wp_strip_all_tags( $content->get( 'post_content' ) );
		if ( ! $content->get( 'summary' ) ) {
			$content->set( 'summary', substr( $contentTextualContent, 0, 415 ) );
			if ( strlen( $contentTextualContent ) > 415 )
				$content->set( 'thereIsMore?', true );
		}
		else
			$content->set( 'thereIsMore?', true );

		return $content;
	}

	public static function get ( $options = [ ] ) {
		WordPress::setupContext();
		return WordPress::findPostsOf(
			self::$typeSlug,
			$options,
			[ self::class, 'getPreparedData' ]
		);
	}

	public static function getBySlug ( $slug ) {
		WordPress::setupContext();
		return self::getPreparedData( WordPress::findPostBySlug( $slug, self::$typeSlug ) );
	}

	public static function getFromURL ( $slug = null ) {
		WordPress::setupContext();
		if ( ! is_string( $slug ) )
			return self::getPreparedData( WordPress::getThisPost() );
		else
			return self::getBySlug( $slug, self::$typeSlug );
	}

	public static function getFeatured () {
		WordPress::setupContext();
		return WordPress::findPostsOf(
			self::$typeSlug,
			[
				'meta_key' => '_is_ns_featured_post',
				'meta_value' => 'yes'
			],
			[ self::class, 'getPreparedData' ]
		);
	}

	public static function getAll () {
		WordPress::setupContext();
		return WordPress::findPostsOf(
			self::$typeSlug,
			[
				'orderby' => [
					'date' => 'DESC',
					'menu_order' => 'ASC'
				]
			],
			[ self::class, 'getPreparedData' ]
		);
	}

	// Build the a hierarchical tree representation of the given FAQs
	public static function getTreeRepresentation ( $faqPosts ) {
		$tree = [ ];
		foreach ( $faqPosts as $faq ) {
			$tree[ $faq->get( 'post_parent' ) ][ ] = $faq;
		}
		return $tree;
	}

	public static function getFirstFAQ () {
		return self::get( [
			'numberposts' => 1
		] )[ 0 ];
	}

	public static function getByRegion ( $region ) {
		return self::get( [
			'tax_query' => [
				[
					'taxonomy' => 'tag_region',
					'field' => 'slug',
					'terms' => [ REGION ]
				]
			],
			'orderby' => [
				'date' => 'DESC',
				'menu_order' => 'ASC'
			]
		] );
	}

	public static function getByRegionAndSection ( $region, $section ) {
		return self::get( [
			'tax_query' => [
				[
					'taxonomy' => 'tag_region',
					'field' => 'slug',
					'terms' => [ REGION ]
				],
				[
					'taxonomy' => 'tag_section',
					'field' => 'slug',
					'terms' => [ $section ]
				]
			],
			'orderby' => [
				'date' => 'DESC',
				'menu_order' => 'ASC'
			]
			// 'orderby' => 'menu_order',
			// 'order' => 'ASC',
		] );
	}



	public static function setupGutenbergBlocks () {
		add_action( 'acf/init', function () {
			if ( ! function_exists( 'acf_register_block_type' ) )
				return;

			acf_register_block_type( [
				'name' => 'bfs-faqs',
				'title' => __( 'FAQs' ),
				'description' => __( 'FAQs' ),
				'category' => CLIENT_SLUG,
				'icon' => 'editor-textcolor',
				'align' => 'wide',
				'mode' => 'edit',
				'supports' => [
					'multiple' => false,
					'align' => [ 'wide' ]
				],
				'render_callback' => [ WordPress::class, 'acfRenderCallback' ]
			] );
		} );
	}

	public static function setupContentInputForm () {
		add_filter( 'register_post_type_args', function ( $args, $postType ) {
			if ( $postType !== self::$typeSlug )
				return $args;

			$args[ 'template' ] = [
				[ 'core/paragraph', [ 'placeholder' => 'Type in a detailed answer here...' ] ],
				[ 'acf/bfs-faqs' ],
				[ 'acf/bfs-regions-applicable' ],
				[ 'acf/bfs-section' ]
			];

			return $args;
		}, 20, 2 );
	}

	public static function enqueueAssets () {
		add_action( 'bfs/backend/on-screen', function ( $screenId ) {
			if ( $screenId !== self::$typeSlug )
				return;
			WordPress::enqueueScript( 'hide-region-tag-panel', '/js/hide-region-tag-panel.js' );
			WordPress::enqueueScript( 'hide-section-tag-panel', '/js/hide-section-tag-panel.js' );
		} );
	}



	// Register a `save_post` action hook
	public static function onSavingInstance () {
		add_action( 'wp_loaded', [ __CLASS__, 'registerHook__OnSavingPost' ] );
	}

	public static function registerHook__OnSavingPost () {
		add_action( 'save_post_' . self::$typeSlug, [ __CLASS__, 'hook__SavePost' ], 100, 3 );
	}

	public static function unregisterHook__OnSavingPost () {
		remove_action( 'save_post_' . self::$typeSlug, [ __CLASS__, 'hook__SavePost' ], 100, 3 );
	}

	/*
	 | Capture certain ACF values and store them as native post (or post meta) attributes, or tags.
	 | This is to optimize the post querying.
	 |
	 */
	public static function hook__SavePost ( $postId, $post, $postWasUpdated ) {

		// this hook is invoked _even_ when a revision is created, i.e. post type of "revision"
		if ( WordPress::getPostType( $postId ) !== self::$typeSlug )
			return;

		// Unregister the save_post action hook to prevent an infinite recursive loop
		self::unregisterHook__OnSavingPost();



		$thePost = WordPress::findPostById( $postId );

		/*
		 | Derive the `tag_region` taxonomy value from the `regions_applicable` field
		 */
		$selectedRegions = $thePost->get( 'regions_applicable' ) ?? [ ];
		wp_set_post_terms( $thePost->get( 'ID' ), $selectedRegions, 'tag_region', false );

		/*
		 | Derive the `tag_section` taxonomy value from the `sections` field
		 */
		$selectedPlacementPoints = $thePost->get( 'sections' ) ?? [ ];
		wp_set_post_terms( $thePost->get( 'ID' ), $selectedPlacementPoints, 'tag_section', false );



		// Re-register the action hook
		self::registerHook__OnSavingPost();

	}

}
