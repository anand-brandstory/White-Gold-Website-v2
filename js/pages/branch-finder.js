
$( function () {





// If the GeoLocation API is not supported, do nothing and leave everything as it is.
if ( ! navigator.geolocation )
	return;

// If user has not consented to sharing their geolocation, or has not been prompted, then reveal the "Check distance" buttons
$( ".js_branch .js_check_distance" ).removeClass( "hidden" );

// If the user clicks on the "Check distance" button, query the location, calculate the distances and plug them in
$( document ).on( "click", ".js_check_distance", function ( event ) {
	// Get the user's geolocation
	getCurrentUserGeoLocation().then( function ( userGPSData ) {
		var branches = window.__BFS.data.branchesInRegion;
		// Calculate the distances between the user and the branches
		branches = branches.map( function ( branch ) {
			branch.distanceFromUser = calculateDistanceBetweenCoordinates( userGPSData, branch );
			return branch;
		} );
		// Plug in the calculated distances in the markup
		$( ".js_branch" ).each( function ( _i, domEl ) {
			var $branch = $( domEl );
			var branch = branches[ _i ];
			$branch.find( ".js_distance_from_user" ).text( branch.distanceFromUser ).removeClass( "hidden" );
			$branch.find( ".js_check_distance" ).addClass( "hidden" );
		} );
	} );
} );





} );





/*
 * ----- Returns the user's geo-location
 *   ( or prompts the user for their consent if they haven't already )
 */
function getCurrentUserGeoLocation () {
	return getCurrentPosition()
		.then( getLocationDetails );
}

	/*
	 * ----- A wrapper around the native GeoLocation API
	 */
	function getCurrentPosition () {
		let options = {
			enableHighAccuracy: true
		};
		return new Promise( function ( resolve, reject ) {
			navigator.geolocation.getCurrentPosition(
				resolve,
				reject,
				options
			);
		} );
	}

	/*
	 * ----- Extracts and returns relevant data on successfully acquiring the user's location
	 */
	function getLocationDetails ( rawData ) {
		return {
			timestamp: rawData.timestamp,
			accuracy: rawData.coords.accuracy,
			altitude: rawData.coords.altitude,
			altitudeAccuracy: rawData.coords.altitudeAccuracy,
			heading: rawData.coords.heading,
			latitude: rawData.coords.latitude,
			longitude: rawData.coords.longitude,
			speed: rawData.coords.speed
		}
	}

	/*
	 * ----- Error handler: While attempting to acquire the user's location
	 */
	function handleErrorWhileAcquiringLocation ( e ) {
		alert( "There was an issue in fetching your location. Please check your privacy settings for this website or try again after sometime." );
		console.log( e );
	}

/*
 * ----- Calculate the distance between two coordinates
 */
function calculateDistanceBetweenCoordinates ( source, destination ) {
	var distanceInMeters = geolib.getDistance( source, destination );
	var distanceInKm = parseFloat( ( distanceInMeters / 1000 ).toFixed( 1 ) );
	var distanceInWords = distanceInKm + "km";
	return distanceInWords;
}

