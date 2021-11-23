<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Braun E. Fridge
 *
 */

require_once ABSPATH . '/../lib/providers/wordpress.php';
define( 'THEME_SETTINGS_PATH', get_template_directory() . '/settings' );



require get_template_directory() . '/lib/utils.php';

\BFS\CMS\WordPress::setupHooks();



require_once THEME_SETTINGS_PATH . '/routing.php';
require_once THEME_SETTINGS_PATH . '/authentication.php';
require_once THEME_SETTINGS_PATH . '/url-auto-correction.php';
require_once THEME_SETTINGS_PATH . '/dequeue-defaults.php';
require_once THEME_SETTINGS_PATH . '/gutenberg-block-categories.php';
require_once THEME_SETTINGS_PATH . '/unhide-reusable-blocks-post-type.php';

add_action( 'after_setup_theme', function () {

	// Theme supports
	require_once THEME_SETTINGS_PATH . '/theme-supports.php';
	// Document Title
	require_once THEME_SETTINGS_PATH . '/document-title.php';
	// Media settings
	require_once THEME_SETTINGS_PATH . '/media.php';
	// Custom Gutenberg Blocks
	require_once THEME_SETTINGS_PATH . '/custom-gutenberg-blocks.php';
	// Gutenberg Block editor settings
	require_once THEME_SETTINGS_PATH . '/gutenberg-block-editor.php';
	// Admin dashboard settings
	require_once THEME_SETTINGS_PATH . '/admin-dashboard/settings-options-page.php';
	require_once THEME_SETTINGS_PATH . '/admin-dashboard/gold-rate-parameters-settings-page.php';

} );


require_once __ROOT__ . '/types/cards/cards.php';
require_once __ROOT__ . '/types/branches/branches.php';
require_once __ROOT__ . '/types/faqs/faqs.php';
require_once __ROOT__ . '/types/videos/videos.php';

use \BFS\Types;

/* ~ Cards ~ */
Types\Cards::setupGutenbergBlocks();
Types\Cards::setupContentInputForm();
Types\Cards::enqueueAssets();
Types\Cards::onSavingInstance();

/* ~ Branches ~ */
Types\Branches::setupGutenbergBlocks();
Types\Branches::setupContentInputForm();
Types\Branches::enqueueAssets();
Types\Branches::onSavingInstance();

/* ~ FAQs ~ */
Types\FAQs::setupGutenbergBlocks();
Types\FAQs::setupContentInputForm();
Types\FAQs::enqueueAssets();
Types\FAQs::onSavingInstance();

/* ~ Videos ~ */
Types\Videos::setupGutenbergBlocks();
Types\Videos::setupContentInputForm();
Types\Videos::enqueueAssets();
Types\Videos::onSavingInstance();
