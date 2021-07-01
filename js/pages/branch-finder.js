
$( function () {





// If the GeoLocation API is not supported, do nothing and leave everything as it is.
if ( ! navigator.geolocation )
	return;

// For each branch in memory, store a reference to its corresponding DOM node
var $branches = $( ".js_branch" );
window.__BFS.data.branchesInRegion = window.__BFS.data.branchesInRegion.map( function ( branch, _index ) {
	return Object.assign(
		{ },
		branch,
		{ $node: $branches.eq( _index ) }
	);
} );

// If user has not consented to sharing their geolocation, or has not been prompted, then reveal the "Check distance" buttons
$( ".js_branch .js_check_distance" ).removeClass( "hidden" );

// If the user clicks on the "Check distance" button, query the location, calculate the distances and plug them in
$( document ).on( "click", ".js_check_distance", function ( event ) {
	// Get the user's geolocation
	getCurrentUserGeoLocation().then( function ( userGPSData ) {
		var branches = window.__BFS.data.branchesInRegion;
		// Calculate the distances between the user and the branches
		branches = branches.map( function ( branch ) {
			return Object.assign(
				{ },
				branch,
				{ distanceFromUser: calculateDistanceBetweenCoordinates( userGPSData, branch ) }
			);
		} );
		// Plug in the calculated distances in the markup
		branches.forEach( function ( branch ) {
			var $branch = $( branch.$node );
			$branch.find( ".js_distance_from_user" ).text( branch.distanceFromUser ).removeClass( "hidden" );
			$branch.find( ".js_check_distance" ).addClass( "hidden" );
		} );
	} );
} );



// If the user clicks on the "Show Nearest Branch" button, order the branches by distance
$( document ).on( "click", ".js_order_branches", function ( event ) {

	var $orderBranchesByNearestButton = $( event.target ).closest( ".js_order_branches" );
	$orderBranchesByNearestButton.addClass( "loading" );

	// 1. Get the user's geolocation
	getCurrentUserGeoLocation().then( function ( userGPSData ) {

		// 2. Calculate the distances between the user and the branches
		var branches = window.__BFS.data.branchesInRegion;
		branches = branches.map( function ( branch ) {
			return Object.assign(
				{ },
				branch,
				{ distanceFromUser: calculateDistanceBetweenCoordinates( userGPSData, branch ) }
			);
		} );

		// 3. Hide the branches from the user
		var $branchesContainer = $( ".js_branches_container" );
		$branchesContainer.addClass( "fade-out" );
			// Expand the list of branches and lock the height
		$( ".js_more_branches" ).get( 0 ).checked = true;
		$branchesContainer.css( { height: $branchesContainer.height() + "px" } );

		setTimeout( function () {

			// 4. Sort the branches
			branches = branches.sort( function ( a, b ) {
				return parseFloat( a.distanceFromUser ) - parseFloat( b.distanceFromUser );
			} );

			// 5. Plug in the calculated distances to the branches markup
			branches.forEach( function ( branch ) {
				var $branch = $( branch.$node );
				$branch.find( ".js_distance_from_user" ).text( branch.distanceFromUser ).removeClass( "hidden" );
				$branch.find( ".js_check_distance" ).addClass( "hidden" );
			} );

			// 6. Un-mount the branches from the DOM
			branches.forEach( function ( branch ) {
				branch.$node.detach();
			} )

			// 7. Re-mount the branches to the DOM
			branches.forEach( function ( branch ) {
				$branchesContainer.append( branch.$node );
			} );

			// 8. Hide the "Show Nearest Branch" button
			$orderBranchesByNearestButton.addClass( "hidden" );

			// 9. Reveal the branches to the user again
			$branchesContainer.css( { height: "auto" } );
			$branchesContainer.removeClass( "fade-out" );

			// 10. Scroll to the top
			window.scrollTo( {
				top: $branchesContainer.offset().top,
				left: 0,
				behavior: "smooth"
			} )

		}, 100 );

	} );

} );






} );





/*
 * ----- Returns the user's geo-location
 *   ( or prompts the user for their consent if they haven't already )
 */
function getCurrentUserGeoLocation () {
	return getCurrentPosition()
		.then( getLocationDetails )
		.catch( handleErrorWhileAcquiringLocation )
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
		alert( "We were unable to fetch your location. Please refresh the page and try again, or check your privacy settings on your device for this website." );
		console.log( e );
	}


/*
 * ----- Given a reference points and a list of candidate points, this function returns the point that is the closest to the reference point
 */
function getNearest ( referenceCoordinates, candidateCoordinates ) {
	return geolib.findNearest( referenceCoordinates, candidateCoordinates );
}

/*
 * ----- Given a reference points and a list of candidate points, this function returns the list of candidate points ordered by distance.
 */
function orderByDistance ( referenceCoordinates, candidateCoordinates ) {
	return geolib.orderByDistance( referenceCoordinates, candidateCoordinates );
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
