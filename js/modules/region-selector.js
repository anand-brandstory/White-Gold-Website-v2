
$( function () {

	/*
	 * ----- Store some references that'll be used throughout this script
	 */
	var $regionSelectorContainer = $( ".js_region_selector_container" );
		var $regionSelector = $regionSelectorContainer.find( ".js_region_selector" );
		var $regionLabel = $regionSelectorContainer.find( ".js_region_label" );
	var $regionNavigationMenu = $( ".js_region_nav" );

	/*
	 * ----- On selecting a region with the select input field
	 */
	$regionSelector.on( "change", function ( event ) {
		var regionCode = $( event.target ).val();

		// Update the region label
		var regionName = $regionSelector.find( "[ value = " + regionCode + " ]" ).text();
		$regionLabel.text( regionName );

		// Navigation to corresponding region-specific page
		var urlToNavigateTo = getRegionSpecificURL( regionCode, window.location );
		window.location.href = urlToNavigateTo;
	} );

	/*
	 * ----- On clicking a link on the region navigation menu
	 *
	 * 	This menu is "visually" hidden, yet accessible to crawlers (and screen readers) which is crucial for SEO and accessibility
	 *
	 */
	$regionNavigationMenu.on( "click", function ( event ) {
		// Prevent the browser from performing its default behavior
		event.preventDefault();
		event.stopImmediatePropagation();
		event.stopPropagation();

		var regionCode = $( event.target ).data( "region" );

		// Update the region label
		var regionName = $regionSelector.find( "[ value = " + regionCode + " ]" ).text();
		$regionLabel.text( regionName );

		// Navigation to corresponding region-specific page
		var urlToNavigateTo = getRegionSpecificURL( regionCode, window.location );
		window.location.href = urlToNavigateTo;
	} );

} );

/*
 *
 * ----- Returns the given URL transposed with the given region
 *
 */
function getRegionSpecificURL ( region, browserLocation ) {

	var pathNameParts = browserLocation.pathname
		.replace( /\/+/g, "/" )
		.split( "/" )

	if ( pathNameParts.length < 2 )
		return browserLocation.href;

	pathNameParts[ 1 ] = region;
	var url = pathNameParts.join( "/" ) + browserLocation.search + browserLocation.hash;

	return url;

}
