<?php
# * - Error Reporting
ini_set( 'display_errors', 1 );
ini_set( 'error_reporting', E_ALL );

// Script Bootstrapping
require_once __DIR__ . '/../../lib/api-script-bootstrap.php';
// Response Preparation
require_once __DIR__ . '/../../lib/api-script-response-preparation.php';
// Parse input from the request, reject if empty
require_once __DIR__ . '/../../lib/api-script-mandatory-input-parsing.php';


require_once __DIR__ . '/../../conf.php';
require_once __DIR__ . '/../../lib/http.php';

use BFS\HTTP;

/*
 |
 | Further input parsing
 |
 | If the essential data is not provided, respond accordingly
 |
 */
if ( empty( $input[ 'phoneNumber' ] ) )
	return HTTP::respond( 'Phone number not provided.', 400 );
# If the phone number is in the exclusion list, do not proceed
if ( in_array( $input[ 'phoneNumber' ], CUPID_EXCLUSION_LIST ) )
	return HTTP::respond( 'This phone number is not to be considered.', 200 );





/* ------------------------------------- \
 * Pull in the module dependencies
 \-------------------------------------- */
require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/../../lib/datetime.php';
require_once __DIR__ . '/../../lib/google-forms.php';

use Symfony\Component\Yaml\Yaml;



/**
 |
 | Interpret the request data and set other data
 |
 */
$when = null;	// declared properly later
$phoneNumber = $input[ 'phoneNumber' ];
$name = $input[ 'name' ] ?? null;
$emailAddress = $input[ 'emailAddress' ] ?? null;
$sourceMedium = $input[ 'sourceMedium' ];
$sourcePoint = $input[ 'sourcePoint' ] ?? '';





/**
 |
 | Send data to a Google Sheet
 |
 */
$dataForGoogleSheet = [
	'when' => CFD\DateTime::getCurrentTimestamp__SpreadsheetCompatible(),
	'phoneNumber' => $phoneNumber,
	'name' => $name,
	'emailAddress' => $emailAddress,
	'sourceMedium' => $sourceMedium,
	'sourcePoint' => $sourcePoint,
];

GoogleForms\submitPerson( $dataForGoogleSheet );



/**
 |
 | Push webhooks
 |
 |
 */
$webhookData = [
	'when' => CFD\DateTime::formatAsISO8601( new \DateTime( 'now' ) ),
	'phoneNumber' => $phoneNumber,
	'name' => $name,
	'emailAddress' => $emailAddress,
	'sourceMedium' => $sourceMedium,
	'sourcePoint' => $sourcePoint,
];
HTTP::post( 'https://ka.whitegold.online/newuser.php', [ 'data' => $webhookData ] );





/* ------------------------------- \
 * Respond back to the client
 \-------------------------------- */
HTTP::respond( $webhookData, 200 );
