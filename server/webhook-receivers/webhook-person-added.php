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
 * Response Pre-Preparation
 \-------------------------------- */
# Set Headers
header_remove( 'X-Powered-By' );
header( 'Content-Type: application/json' );



/* ------------------------------- \
 * Request Parsing
 \-------------------------------- */
# Get JSON as a string
$json = file_get_contents( 'php://input' );
# Convert the JSON string to an object
$error = null;
try {
	$input = json_decode( $json, true );
	if ( empty( $input ) )
		throw new \Exception( "No data provided." );
	$input = $input[ 'data' ];
}
catch ( \Exception $e ) {
	$error = $e->getMessage();
}
if ( ! empty( $error ) ) {
	echo json_encode( [
		'code' => 400,
		'message' => 'Data not provided'
	] );
	exit;
}





/* ------------------------------------- \
 * Pull in the dependencies
 \-------------------------------------- */
require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/../../lib/datetime.php';
require_once __DIR__ . '/../../lib/deprecated-google-forms.php';

use Symfony\Component\Yaml\Yaml;



/* ------------------------------------- \
 * Ingest the data onto the Spreadsheet
 \-------------------------------------- */
# Interpret the data
$when = $input[ 'when' ];
$id = $input[ 'id' ];
$verified = $input[ 'verified' ];
$phoneNumber = $input[ 'phoneNumber' ];
$name = $input[ 'name' ] ?? '';
$emailAddresses = empty( $input[ 'emailAddresses' ] ) ? [ ] : $input[ 'emailAddresses' ];
$interests = empty( $input[ 'interests' ] ) ? [ ] : $input[ 'interests' ];
$sourcePoint = $input[ 'source' ][ 'point' ] ?? $input[ 'agent' ][ 'name' ] ?? $input[ 'agent' ][ 'phoneNumber' ] ?? '';
$sourceMedium = $input[ 'source' ][ 'medium' ];
$callRecording = $input[ 'recordingURL' ] ?? '';
$extendedAttributes = $input[ 'extendedAttributes' ] ?? [ ];

# Shape the data
$dataForGoogleSheet = [
	'when' => CFD\DateTime::getSpreadsheetDateFromISO8601( $when ),
	'id' => $id,
	'verified' => $verified,
	'phoneNumber' => $phoneNumber,
	'name' => $name,
	'emailAddress' => implode( ', ', $emailAddresses ),
	'sourceMedium' => $sourceMedium,
	'sourcePoint' => $sourcePoint,
	'interests' => implode( ', ', $interests ),
	'callRecording' => $callRecording,
	'extendedAttributes' => empty( $extendedAttributes ) ? '' : Yaml::dump( $extendedAttributes ),
];

GoogleForms\submitPerson( $dataForGoogleSheet );
// $spreadsheet->addRow( $data );



/**
 |
 | Push webhooks
 |
 |
 */
$webhookData = [
	'when' => $input[ 'timestamp' ],
	'client' => CLIENT_SLUG,
	'phoneNumber' => $phoneNumber,
	// 'id' => '',     // this is no longer supported
	'name' => $name,
	// 'verified' => false,
	'source' => [
		'medium' => 'Website',
		'point' => $sourcePoint
	],
	'interests' => [ ],
	'emailAddresses' => $emailAddress
];
HTTP::post( 'http://139.59.50.103:8003/person/added', [ 'data' => $webhookData ] );



/* ------------------------------- \
 * Respond back to the client
 \-------------------------------- */
$output = $webhookData ?: [ ];
echo json_encode( $output );
