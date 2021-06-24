<?php

/* ------------------------------- \
 * Script Bootstrapping
 \-------------------------------- */
# * - Error Reporting
ini_set( 'display_errors', 1 );
ini_set( 'error_reporting', E_ALL );
# * - Request Permissions
header( 'Access-Control-Allow-Origin: *' );
# * - Date and Timezone
date_default_timezone_set( 'Asia/Kolkata' );
# * - Prevent Script Cancellation by Client
ignore_user_abort( true );
# * - Script Timeout
set_time_limit( 0 );





/* ------------------------------- \
 * Request Parsing
 \-------------------------------- */
# Get input from query parameters
$ipAddress = $_SERVER[ 'MMDB_ADDR' ] ?? $_SERVER[ 'REDIRECT_MMDB_ADDR' ];
$countryISOCode = $_SERVER[ 'COUNTRY_CODE' ] ?? $_SERVER[ 'REDIRECT_COUNTRY_CODE' ];
$mostSpecificSubdivisionISOCode = $_SERVER[ 'MOST_SPECIFIC_SUBDIVISION_CODE' ] ?? $_SERVER[ 'REDIRECT_MOST_SPECIFIC_SUBDIVISION_CODE' ];





/* ------------------------------------- \
 * Get the location data
 \-------------------------------------- */
$data = [
	'ipAddress' => $ipAddress,
	'country' => [
		'isoCode' => $countryISOCode
	],
	'mostSpecificSubdivision' => [
		'isoCode' => $mostSpecificSubdivisionISOCode
	]
];





/* ------------------------------- \
 * Response Preparation
 \-------------------------------- */
# Set Headers
header_remove( 'X-Powered-By' );
header( 'Content-Type: application/json' );
header( 'Cache-Control: no-store, no-cache, private, max-age=0, s-maxage=0' );
# Build response content body
echo json_encode( [
	'statusCode' => 200,
	'status' => 'ok',
	'data' => $data
] );

# Terminate the script
exit;
