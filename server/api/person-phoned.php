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





/* ------------------------------------- \
 * Pull in the module dependencies
 \-------------------------------------- */
require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/../../lib/datetime.php';
require_once __DIR__ . '/../../lib/http.php';
require_once __DIR__ . '/../../lib/google-forms.php';
require_once __DIR__ . '/../../lib/providers/mcube.php';

use Symfony\Component\Yaml\Yaml;
use \BFS\HTTP;





/**
 |
 | Parse incoming call data
 |
 */
$callData = MCube::parse( $input );



/*
 |
 | Further input parsing
 |
 |
 */
# If the phone number is in the exclusion list, do not proceed
if ( in_array( $input[ 'phoneNumber' ], CUPID_EXCLUSION_LIST ) )
     return HTTP::respond( 'This phone number is not to be considered.', 200 );



/**
 |
 | Send data to a Google Sheet
 |
 */
$data = [ ];
$data[ 'phoneNumber' ] = $callData[ 'phoneNumber' ];
$data[ 'sourceMedium' ] = 'Phone';
if ( !empty( $callData[ 'agentPhoneNumber' ] ) )
	$data[ 'sourcePoint' ] = $callData[ 'agentPhoneNumber' ];

// Extended attributes
$extendedAttributes = [ ];
if ( !empty( $callData[ 'recordingURL' ] ) )
	$extendedAttributes[ 'Recording URL' ] = $callData[ 'recordingURL' ];
if ( !empty( $callData[ 'duration' ] ) )
	$extendedAttributes[ 'Duration' ] = $callData[ 'duration' ];
$data[ 'extendedAttributes' ] = Yaml::dump( $extendedAttributes );
$data[ 'when' ] = CFD\DateTime::getTimestamp__SpreadsheetCompatible( $callData[ 'endTime' ] ?? null );

$activity = 'Phone';
GoogleForms\submitPersonActivity( $activity, $data );





/* ------------------------------- \
 * Respond back to the client
 \-------------------------------- */
HTTP::respond( $data, 200 );
