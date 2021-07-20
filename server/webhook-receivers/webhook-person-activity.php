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
 * Response Preparation
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
	$event = $input[ 'event' ];
	// $resource = $input[ 'resource' ] ?? [ ];
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

require_once __DIR__ . '/../../inc/datetime.php';
require_once __DIR__ . '/../../inc/google-forms.php';

use Symfony\Component\Yaml\Yaml;



/* ------------------------------------- \
 * Ingest the data onto the Spreadsheet
 \-------------------------------------- */
# Interpret the data
$when = CFD\DateTime::getSpreadsheetDateFromISO8601( $input[ 'when' ] );
$activity = '';
$personId = $input[ 'id' ] ?? '';
$sourceMedium = '';
$sourcePoint = '';
$verificationMethod = $input[ 'verificationMethod' ] ?? '';
$activityData = [ ];
if ( $event === 'person/is/verified' ) {
	$activity = 'Verification';
	if ( ! empty( $input[ 'source' ] ) ) {
		if ( ! empty( $input[ 'source' ][ 'medium' ] ) ) {
			$sourceMedium = $input[ 'source' ][ 'medium' ];
			if ( strtolower( $sourceMedium ) === 'phone' )
				$recordingURL = $input[ 'source' ][ 'data' ][ 'recordingURL' ] ?? '';
		}
		if ( ! empty( $input[ 'source' ][ 'point' ] ) )
			$sourcePoint = $input[ 'source' ][ 'point' ];
	}
}
else if ( $event === 'person/phoned/' ) {
	$activity = 'Phone';
	$sourceMedium = 'Phone';
	if (
		! empty( $input[ 'agent' ] )
		and ! empty( $input[ 'agent' ][ 'phoneNumber' ] )
	)
		$sourcePoint = $input[ 'agent' ][ 'phoneNumber' ];

	$activityData[ 'Recording URL' ] = $input[ 'recordingURL' ] ?? '';
	$activityData[ 'Duration' ] = $input[ 'duration' ] ?? '';
	if ( ! empty( $input[ 'extendedAttributes' ] ) )
		$activityData = array_merge( $activityData, $input[ 'extendedAttributes' ] );
}
else if ( $event === 'person/on/website' ) {
	$activity = 'Website';
	$sourceMedium = 'Website';
	if ( ! empty( $input[ 'where' ] ) )
		$sourcePoint = $input[ 'where' ];
}
else if ( $event === 'person/updated/profile' ) {
	$activity = 'Profile Update';
	$personId = $input[ 'personId' ];
	$phoneNumber = $input[ 'phoneNumber' ] ?? '';
	$sourceMedium = 'Website';
	$activityData = $input[ 'profile' ] ?? [ ];
}
else if ( $event === 'person/submitted/data' ) {
	$activity = 'Data Submission';
	$personId = $input[ 'personId' ];
	$phoneNumber = $input[ 'phoneNumber' ] ?? '';
	$sourceMedium = 'Website';
	if ( ! empty( $input[ 'where' ] ) )
		$sourcePoint = $input[ 'where' ];
	$activityData = $input[ 'extendedAttributes' ] ?? [ ];
}
else if ( $event === 'person/submitted/message' ) {
	$activity = 'Message';
	$personId = $input[ 'personId' ];
	$phoneNumber = $input[ 'phoneNumber' ] ?? '';
	$sourceMedium = 'Website';
	if ( ! empty( $input[ 'where' ] ) )
		$sourcePoint = $input[ 'where' ];
	$activityData[ 'Format' ] = $input[ 'format' ] ?? '';
	$activityData[ 'Content' ] = $input[ 'content' ] ?? '';
}
$interests = empty( $input[ 'interests' ] ) ? '' : Yaml::dump( $input[ 'interests' ] );

if ( ! empty( $activityData ) )
	$activityDataFormatted = Yaml::dump( $activityData );
else
	$activityDataFormatted = '';

# Shape the data
$data = [
	'when' => $when,
	'activity' => $activity,
	'id' => $personId,
	'phoneNumber' => $phoneNumber ?? $input[ 'phoneNumber' ],
	'verified' => $input[ 'verified' ],
	'verificationMethod' => $input[ 'verificationMethod' ] ?? '',
	'sourceMedium' => $sourceMedium,
	'sourcePoint' => $sourcePoint,
	'interests' => $interests,
	'activityData' => $activityDataFormatted
	// 'duration' => $input[ 'duration' ] ?? '',
	// 'callRecording' => $recordingURL ?? ''
];
GoogleForms\submitPersonActivity( $data );



/* ------------------------------- \
 * Respond back to the client
 \-------------------------------- */
$output = $data ?: [ ];
echo json_encode( $output );
