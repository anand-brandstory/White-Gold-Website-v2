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


	// global $versionNumber;
	// $stylesheets = [
	// 	// Base
	// 	'normalize' => '1_normalize.css',
	// 	'base' => '2_base.css',
	// 	'grid' => '3_grid.css',
	// 	'helper' => '4_helper.css',
	// 	'stylescape' => '5_stylescape.css',
	// 	// Modules
	// 	'header' => 'modules/header.css',
	// 	'video-embed' => 'modules/video-embed.css',
	// 	'modal-box' => 'modules/modal-box.css',
	// 	'lazaro-signature' => 'modules/lazaro-signature.css',
	// 	// Pages + Sections + Modals
	// 	'page' => 'pages/page.css',
	// 	'modal-menu' => 'pages/modal/modal-menu.css',
	// 	'sample-section' => 'pages/section/sample-section.css'
	// ];

	// foreach ( $stylesheets as $handle => $stylesheet )
	// 	wp_enqueue_style( $handle, '/../css/' . $stylesheet, [ ], $versionNumber );

	// wp_register_script(
	// 	'twenty-twenty-one-ie11-polyfills-asset',
	// 	get_template_directory_uri() . '/assets/js/polyfills.js',
	// 	array(),
	// 	wp_get_theme()->get( 'Version' ),
	// 	true
	// );

	// wp_add_inline_script(
	// 	'twenty-twenty-one-ie11-polyfills',
	// 	wp_get_script_polyfill(
	// 		$wp_scripts,
	// 		array(
	// 			'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'twenty-twenty-one-ie11-polyfills-asset',
	// 		)
	// 	)
	// );

} );



/**
 * Enqueue block editor script.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
add_action( 'enqueue_block_editor_assets', function () {
	wp_enqueue_script( 'twentytwentyone-editor', get_theme_file_uri( '/assets/js/editor.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
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
