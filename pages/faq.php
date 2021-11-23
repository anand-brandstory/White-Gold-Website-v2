<?php
/**
 |
 | FAQs page
 |
 | This basically redirects to the plural version "/faqs"
 |
 */

use BFS\Router;

if ( ! defined( 'REGION' ) )
	define( 'REGION', DEFAULT_REGION );

$redirectURL = '/' . REGION . '/faqs/'
			. ( Router::$postSlug ?: '' );

Router::redirectTo( $redirectURL );
