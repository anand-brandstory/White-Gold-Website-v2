<?php
# * - Error Reporting
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
ini_set( 'error_reporting', E_ALL );





define( '__ROOT__', $_SERVER[ 'DOCUMENT_ROOT' ] );

require_once __DIR__ . '/conf.php';
require_once __DIR__ . '/lib/routing.php';
require_once __DIR__ . '/lib/providers/wordpress.php';

\BFS\Router::$routeWithCMS = ROUTE_WITH_CMS;
if ( /*!BFS_ENV_PRODUCTION and*/ $_SERVER[ 'REQUEST_URI' ] === '/' )
	return \BFS\Router::redirectTo( '/' . DEFAULT_REGION );
\BFS\Router::route();
