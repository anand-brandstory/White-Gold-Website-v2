<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

require get_template_directory() . '/inc/hooks.php';
require get_template_directory() . '/inc/utils.php';





add_action( 'bfs/init/backend', function () {

	/*
	 |
	 | - Only allow users with the `edit_user_auth` capability to edit their multi-factor authentication settings
	 |
	 */
	if ( defined( 'IS_PROFILE_PAGE' ) and IS_PROFILE_PAGE )
		if ( ! current_user_can( 'edit_user_auth' ) )
			remove_action( 'show_user_profile', [ Two_Factor_Core::class, 'user_two_factor_options' ] );

} );





/*
 *
 * ----- Reveal the hidden "Reusable Blocks" post type
 *
 * This is a native post type that WordPress (i.e. Gutenberg) uses to store Reusable Blocks.
 *
 */
add_action( 'admin_menu', function () {
	add_menu_page(
		'Reusable Blocks',	// page title
		'Reusable Blocks',	// menu title
		'edit_posts',	// capability
		'edit.php?post_type=wp_block',	// menu slug
		'',	// callable function
		'dashicons-block-default',	// dashicon or icon URL
		4	// menu position
	);
} );



/*
 *
 * ----- Custom ACF Gutenberg blocks
 *
 */
add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_register_block_type' ) )
		return;

	// Card block (used for carousels)
	acf_register_block_type( [
		'name' => 'bfs-card',
		'title' => __( 'Card' ),
		'description' => __( 'A card that has a line of text, an image in the background, and maybe a link.' ),
		'category' => 'white-gold',
		'icon' => 'testimonial',
		'align' => 'wide',
		'mode' => 'edit',
		'supports' => [
			'multiple' => false,
			'align' => [ 'wide' ]
		],
		'render_callback' => 'acf_render_callback'
	] );

	// Branches
	acf_register_block_type( [
		'name' => 'bfs-branch',
		'title' => __( 'Branch' ),
		'description' => __( 'A branch is physical location where White Gold offer their services.' ),
		'category' => 'white-gold',
		'icon' => 'testimonial',
		'align' => 'wide',
		'mode' => 'edit',
		'supports' => [
			'multiple' => false,
			'align' => [ 'wide' ]
		],
		'render_callback' => 'acf_render_callback'
	] );

	function acf_render_callback ( $block, $content, $is_preview, $post_id ) {
		if ( ! class_exists( '\BFS\CMS' ) )
			return;

		\BFS\CMS::$currentQueriedPostACF = array_merge( \BFS\CMS::$currentQueriedPostACF, get_fields() ?: [ ] );
	}

} );

add_action( 'after_setup_theme', function () {

	/*
	 *
	 * Templates for the various Post Types
	 *
	 */
	add_filter( 'register_post_type_args', function ( $args, $postType ) {

		if ( $postType === 'card' ) {
			$args[ 'template' ] = [
				[ 'acf/bfs-card' ]
			];
			$args[ 'template_lock' ] = 'all';
		}
		else if ( $postType === 'branch' ) {
			$args[ 'template' ] = [
				[ 'acf/bfs-branch' ]
			];
			$args[ 'template_lock' ] = 'all';
		}

		return $args;

	}, 20, 2 );



	/*
	 *
	 * Show the Meta-data page if ACF is enabled
	 *
	 */
	if ( function_exists( 'acf_add_options_page' ) ) {
		acf_add_options_page( [
			'page_title' => 'Metadata',
			'menu_title' => 'Metadata',
			'menu_slug' => 'metadata',
			'capability' => 'edit_posts',
			'parent_slug' => '',
			'position' => '5',
			'icon_url' => 'dashicons-info'
		] );
	}

} );



/*
 *
 * ----- Cards (Carousels)
 *	Capture certain ACF values and store them as native post (or post meta) attributes, or tags.
 *	This is to optimize the post querying.
 *
 */
function card__SavePostHook ( $postId, $post, $postWasUpdated ) {

	if ( get_post_type( $postId ) !== 'card' )
		return;

	require_once __DIR__ . '/../../../../inc/cms.php';

	// Unregister the save_post action hook to prevent an infinite loop
	remove_action( 'save_post_card', 'card__SavePostHook', 100, 3 );

	$thePost = \BFS\CMS::getPostById( $postId );

	/*
	 * Capture the "card_text" value as the post title
	 */
	// Strip away all the HTML and newline characters
	$text = strip_tags( str_replace( "\r\n", ' ', $thePost->get( 'card_text' ) ) );
	wp_update_post( [ 'ID' => $postId, 'post_title' => $text ], false, false );


	/*
	 * Capture the "Regions" value as tags
	 */
	$regionsApplicable = $thePost->get( 'regions_applicable' ) ?? [ ];
	$tagPrefix = '__region';
	$tagPrefixLength = strlen( $tagPrefix );
	$tags = array_map( function ( $tag ) use ( $tagPrefix ) {
		return $tagPrefix . '-' . $tag;
	}, $regionsApplicable );

	$allExistingPostTags = wp_get_post_tags( $postId, [ 'fields' => 'slugs' ] );
	$allOtherTags = array_filter( $allExistingPostTags, function ( $tag ) use ( $tagPrefix, $tagPrefixLength ) {
		return substr( $tag, 0, $tagPrefixLength ) !== $tagPrefix;
	} );

	$tagsToSet = array_merge( $allOtherTags, $tags );
	wp_set_post_tags( $postId, $tagsToSet, false );

	// Re-register the action hook
	add_action( 'save_post_card', 'card__SavePostHook', 100, 3 );

}
// Register a `save_post` action hook for the Card (Carousel) post
add_action( 'save_post_card', 'card__SavePostHook', 100, 3 );





/*
 *
 * ----- Branches
 *	Capture certain ACF values and store them as native post (or post meta) attributes, or tags.
 *	This is to optimize the post querying.
 *
 */
function branch__SavePostHook ( $postId, $post, $postWasUpdated ) {

	if ( get_post_type( $postId ) !== 'branch' )
		return;

	require_once __DIR__ . '/../../../../inc/cms.php';

	// Unregister the save_post action hook to prevent an infinite loop
	remove_action( 'save_post_branch', 'branch__SavePostHook', 100, 3 );

	$thePost = \BFS\CMS::getPostById( $postId );

	/*
	 * Capture the "branch_name" and "region" value as the post title
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
	 * Capture the "Regions" value as tags
	 */
	$region = $thePost->get( 'region' );
	if ( ! empty( $region ) ) {
		$tagPrefix = '__region';
		$tagPrefixLength = strlen( $tagPrefix );
		$regionTag = $tagPrefix . '-' . $region;

		$allExistingPostTags = wp_get_post_tags( $postId, [ 'fields' => 'slugs' ] );
		$allOtherTags = array_filter( $allExistingPostTags, function ( $tag ) use ( $tagPrefix, $tagPrefixLength ) {
			return substr( $tag, 0, $tagPrefixLength ) !== $tagPrefix;
		} );

		$tagsToSet = array_merge( $allOtherTags, [ $regionTag ] );
		wp_set_post_tags( $postId, $tagsToSet, false );
	}


	// Re-register the action hook
	add_action( 'save_post_branch', 'branch__SavePostHook', 100, 3 );

}
// Register a `save_post` action hook for the branch (Carousel) post
add_action( 'save_post_branch', 'branch__SavePostHook', 100, 3 );



add_action( 'bfs/backend/on-editing-posts', function ( $postType ) {

	if ( $postType === 'card' )
		wp_enqueue_script(
			'bfs-cards',
			get_template_directory_uri() . '/js/cards.js',
			[ 'wp-data', 'wp-hooks', 'wp-edit-post', 'lodash', 'jquery', 'acf', 'acf-input', 'acf-field-group' ],
			filemtime( get_template_directory() . '/js/cards.js' )
		);

	if ( $postType === 'branch' )
		wp_enqueue_script(
			'bfs-branches',
			get_template_directory_uri() . '/js/branches.js',
			[ 'wp-data', 'wp-hooks', 'wp-edit-post', 'lodash', 'jquery', 'acf', 'acf-input', 'acf-field-group' ],
			filemtime( get_template_directory() . '/js/branches.js' )
		);

} );




add_action( 'template_redirect', function () {

	// If the URL slug is simply `cms`, then forward to the login or admin screen depending on if the user is already logged in or not
	global $wp;
	if ( $wp->request == 'cms' ) {
		nocache_headers();
		$redirectURL = is_user_logged_in() ? get_admin_url() : wp_login_url();
		wp_redirect( $redirectURL, 302, 'BFS' );
		exit;
	}

	// If the site is private, prompt the user to log in
	if ( BFS_PRIVATE_SITE and ! is_user_logged_in() )
		if ( substr( $_SERVER[ 'REQUEST_URI' ], 0, strlen( '/robots.txt' ) ) != '/robots.txt' ) {
			$redirectURL = wp_login_url() . '?redirect_to=' . urlencode( get_home_url() . $_SERVER[ 'REQUEST_URI' ] );
			wp_redirect( $redirectURL, 302, 'BFS' );
			exit;
		}

	// If WordPress is being loaded as a module, then cut short the on the "template routing" and "response preparation".
	if ( \BFS\CMS::$onlySetupContext )
		add_filter( 'template_include', function ( $template ) {
			return get_template_directory() . '/template-stub.php';
		} );

} );

add_action( 'after_setup_theme', function () {

	/*
	 * Let WordPress manage the document title.
	 * This theme does not use a hard-coded <title> tag in the document head,
	 * WordPress will provide it for us.
	 */
	if ( class_exists( '\BFS\CMS' ) and ! \BFS\CMS::$onlySetupContext ) {
		add_theme_support( 'title-tag' );
		add_filter( 'document_title_separator', function ( $separator ) {
			return '|';
		} );
	}

	/**
	 * Add post-formats support.
	 */
	add_theme_support( 'post-formats', [
		'link',
		'aside',
		'gallery',
		'image',
		'quote',
		'status',
		'video',
		'audio',
		'chat',
	] );

	add_theme_support( 'menu' );
	add_theme_support( 'menus' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/*
	 *
	 * Media Settings
	 *
	 */
	add_image_size( 'small', 400, 400, false );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', [
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
		'navigation-widgets',
	] );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );
	$backgroundColor = get_theme_mod( 'background-color', 'D1E4DD' );
	// If the background color is dark, then enable dark mode for Gutenberg
	if ( getRelativeLuminanceFromHex( $backgroundColor ) <= 127 )
		add_theme_support( 'dark-editor-style' );

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// Add support for custom line height controls.
	add_theme_support( 'custom-line-height' );

	// Add support for experimental link color control.
	add_theme_support( 'experimental-link-color' );

	// Add support for experimental cover block spacing.
	add_theme_support( 'custom-spacing' );

	// Add support for custom units.
	// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
	add_theme_support( 'custom-units' );

} );



/*
 *
 * ----- Manage the scripts and stylesheets being enqueued
 *
 */
add_action( 'wp_enqueue_scripts', function () {
	if ( is_admin() )
		return;
	// Remove some default and stylesheets
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );

} );




/**
 * Remove the `no-js` class from body if JS is supported.
 */
add_action( 'wp_footer', function () {
	echo '<script>document.body.classList.remove("no-js");</script>';
} );



/*
 *
 * ----- robots.txt
 * 	Disable the default one.
 *
 */
// If the site is private, then prevent the Google Sitemap plugin from adding the sitemap line in the robots.txt file
add_action( 'wp_loaded', function () {
	if ( BFS_PRIVATE_SITE or ! get_option( 'blog_public' ) )
		remove_all_actions( 'do_robots', 100 );
} );
add_filter( 'robots_txt', function ( $output, $isSitePublic ) {
	if ( BFS_PRIVATE_SITE or ! $isSitePublic ) {
		$output = 'User-agent: *'
				. "\n"
				. 'User-agent: AdsBot-Google'
				. "\n"
				. 'Disallow: /'
				. "\n"
				. 'Disallow: /*'
				. "\n"
				. 'Disallow: /*?'
				. "\n";
	}
	else
		$output = '';

	return $output;
}, 100, 2 );
