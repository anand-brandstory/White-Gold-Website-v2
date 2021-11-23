<?php

namespace BFS\Types;

require_once __ROOT__ . '/lib/providers/wordpress.php';

use BFS\CMS\WordPress;

class Branches {

	private static $typeSlug = 'branch';

	public static function getPreparedData ( $content ) {

		if ( empty( $content ) )
			return $content;

		$content->set(
			'branchImage',
			$content->get( 'branch_image / sizes / small' ) ?? $content->get( 'branch_image / sizes / medium' ) ?? $content->get( 'branch_image / sizes / large' ) ?? $content->get( 'branch_image / url' )
		);

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
		return self::getPreparedData( WordPress::findPostsOf(
			self::$typeSlug,
			[
				'meta_key' => '_is_ns_featured_post',
				'meta_value' => 'yes'
			]
		)[ 0 ] ?? null );
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

	public static function getByRegion ( $region ) {
		return self::get( [
			'tax_query' => [
				[
					'taxonomy' => 'tag_region',
					'field' => 'slug',
					'terms' => [ $region ]
				]
			]
		] );
	}




	public static function setupGutenbergBlocks () {
		add_action( 'acf/init', function () {
			if ( ! function_exists( 'acf_register_block_type' ) )
				return;

			acf_register_block_type( [
				'name' => 'bfs-branch',
				'title' => __( 'Branch' ),
				'description' => __( 'A branch is physical location where White Gold offer their services.' ),
				'category' => CLIENT_SLUG,
				'icon' => 'testimonial',
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
				[ 'acf/bfs-branch' ]
			];
			$args[ 'template_lock' ] = 'all';

			return $args;
		}, 20, 2 );
	}

	public static function enqueueAssets () {
		add_action( 'bfs/backend/on-screen', function ( $screenId ) {
			if ( $screenId !== self::$typeSlug )
				return;
			WordPress::enqueueScript( 'hide-region-tag-panel', '/js/hide-region-tag-panel.js' );
			WordPress::enqueueScript( 'branches', '/js/branches.js' );
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
		 | Capture the "branch_name" and "region" value as the post title
		 */
		// Strip away all the HTML and newline characters
		$branchName = strip_tags( str_replace( "\r\n", ' ', $thePost->get( 'branch_name' ) ) );
		$region = $thePost->get( 'region' );
		$postTitle = '(branch name)';
		if ( ! empty( $branchName ) ) {
			$postTitle = $branchName;
			if ( ! empty( $region ) )
				$postTitle = $postTitle . ', ' . strtoupper( $region );
		}
		wp_update_post( [ 'ID' => $postId, 'post_title' => $postTitle ], false, false );


		/*
		 | Derive the `tag_region` taxonomy value from the `regions_applicable` field
		 */
		$selectedRegion = $thePost->get( 'region' );
		if ( ! empty( $selectedRegion ) )
			wp_set_post_terms( $thePost->get( 'ID' ), $selectedRegion, 'tag_region', false );



		// Re-register the action hook
		self::registerHook__OnSavingPost();

	}

}
