<?php
/**
 |
 | Cards
 |
 | This is labelled as _Carousel_ on the WordPress backend
 |
 */

namespace BFS\Types;

require_once __ROOT__ . '/lib/providers/wordpress.php';

use BFS\CMS\WordPress;

class Cards {

	private static $typeSlug = 'card';

	public static function getPreparedData ( $content ) {

		if ( empty( $content ) )
			return $content;

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

	public static function getByRegion ( $region ) {
		return self::get( [
			'tax_query' => [
				[
					'taxonomy' => 'tag_region',
					'field' => 'slug',
					'terms' => [ $region ]
				]
			],
			'orderby' => [
				'menu_order' => 'ASC',
				'date' => 'DESC'
			]
		] );
	}




	public static function setupGutenbergBlocks () {
		add_action( 'acf/init', function () {
			if ( ! function_exists( 'acf_register_block_type' ) )
				return;

			acf_register_block_type( [
				'name' => 'bfs-card',
				'title' => __( 'Card' ),
				'description' => __( 'A card that has a line of text, an image in the background, and maybe a link.' ),
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
				[ 'acf/bfs-card' ]
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
		 | Capture the "card_text" value as the post title
		 */
		// Strip away all the HTML and newline characters
		$text = strip_tags( str_replace( "\r\n", ' ', $thePost->get( 'card_text' ) ) );
		wp_update_post( [ 'ID' => $postId, 'post_title' => $text ], false, false );


		/*
		 | Derive the `tag_region` taxonomy value from the `regions_applicable` field
		 */
		$selectedRegions = $thePost->get( 'regions_applicable' ) ?? [ ];
		wp_set_post_terms( $thePost->get( 'ID' ), $selectedRegions, 'tag_region', false );



		// Re-register the action hook
		self::registerHook__OnSavingPost();

	}

}
