
$( function () {









/*
 *
 * If the URL has a hash value,
 * 	smooth-scroll to that section
 *	and restore the hash to the URL
 *
 */
// The hash was removed but cached in this variable
if ( window.__BFS.scrollTo ) {
	if ( window.scrollY < 1 )
		window.__BFS.utils.smoothScrollTo( window.__BFS.scrollTo );
	var fullURL = location.origin + location.pathname + location.search + window.__BFS.scrollTo;
	window.history.replaceState( { }, "", fullURL )
}



/*
 *
 * ----- Smooth-scroll to sections
 *
 */
$( document ).on( "click", "a[ href ]", function ( event ) {

	var $anchor = $( event.target ).closest( "a" );
	var domAnchor = $anchor.get( 0 );

	var urlParts = domAnchor.href.split( "#" );
	// If the url has more than one `#`es in it, we're not even going to try
	if ( urlParts.length !== 2 )
		return;

	var path = urlParts[ 0 ];
	var sectionId = urlParts[ 1 ];

	// If the path does not match that of the current page
	if ( path !== window.location.href )
		return;

	// If the section id is empty or a stub
	if ( ! sectionId.trim() || sectionId === "0" )
		return;

	// Prevent default behaviour
	event.preventDefault();
	event.stopPropagation();
	event.stopImmediatePropagation();

	window.__BFS.utils.smoothScrollTo( sectionId );

	return false;

} );



/*
 *
 * ----- Floating Menu logic
 *
 */
// Show or Hide the floating menu depending on the direction of scroll
var domInlineMenuWidget = $( ".js_inline_menu_widget" ).get( 0 );
window.__BFS.utils.onScroll( function () {
	var currentScrollY = window.scrollY || document.body.scrollTop;
	var previousScrollY = currentScrollY;
	var scrollThreshold = 50;

	var $body = $( document.body );

	return function () {
		currentScrollY = window.scrollY || document.body.scrollTop;

		if ( domInlineMenuWidget && currentScrollY < domInlineMenuWidget.offsetTop + 100 )
			$body.removeClass( "show-menu" );
		else
			$body.addClass( "show-menu" );

		previousScrollY = currentScrollY;
	};

}(), { frequencyMode: "throttle", interval: 0.25 } );

// By default, show the floating menu **initially**
// 	**if** there is no above-the-fold inline version of it for that page
if ( ! domInlineMenuWidget )
	$( document.body ).addClass( "show-menu" );



/*
 *
 * ----- Menu toggling, opening and closing
 *
 */
// On opening the _primary_ menu, ensure that the _WhatsApp_ menu is closed (if not already)
$( ".js_main_menu" ).on( "click", ".js_primary_toggle_menu", function ( event ) {
	var $menu = $( event.target ).closest( ".js_main_menu" )
	closeWhatsAppSubMenu( $menu )
} )
// Likewise, on opening the _WhatsApp_ menu, ensure that the _primary_ menu is closed (if not already)
$( ".js_main_menu" ).on( "click", ".js_wa_toggle_menu", function ( event ) {
	if ( !Cupid.personIsLoggedIn() ) {
		var $menu = $( event.target ).closest( ".js_main_menu" )
		closePrimarySubMenu( $menu )
		return;
	}

	// Prevent the WhatsApp sub-menu from opening
	event.preventDefault()

	// Directly navigate to WhatsApp
	let clientPhoneNumber = window.__BFS.UI.whatsappForm.getFormNode()
						.data( "number" ).replace( /\s+/g, "" )
	navigateToWhatsAppChat( clientPhoneNumber )
} )

function closePrimarySubMenu ( $menuContainer ) {
	var domSubMenu = $menuContainer.find( ".js_primary_toggle_menu" ).get( 0 )
	domSubMenu.checked = false
}
function closeWhatsAppSubMenu ( $menuContainer ) {
	var domSubMenu = $menuContainer.find( ".js_wa_toggle_menu" ).get( 0 )
	domSubMenu.checked = false
}



/*
 *
 * When scrolling through the page, communicate with GTM if the user is viewing a section for longer than a threshold amount of time
 *
 */
var intervalToCheckForEngagement = 250;
var thresholdTimeForEngagement = 2000;
var timeSpentOnASection = 0;
window.__BFS.engagementIntervalCheck = null;	// this is set later

var thingsToDoOnEveryInterval = function () {

	var $window = $( window );
	var currentScrollTop;
	var previousScrollTop;
	var $currentSection;
	var currentSectionName;
		var currentSectionId;
		var currentSectionDOMId;
	var previousSectionName;
	var sectionScrollTop;
	var $currentNavItem;
	var lastRecordedSection;

	// Get all the sections in the reverse order
	var $sections = Array.prototype.slice.call( $( "[ data-section-slug ]" ) )
					.filter( function ( domSection ) {
						return ! $( domSection ).hasClass( "hidden" );
					} )
					.reverse()
					.map( function ( el ) { return $( el ) } );

	return function thingsToDoOnEveryInterval () {

		var viewportHeight = $window.height();
		currentScrollTop = window.scrollY || document.body.scrollTop;
		$currentSection = null;
		currentSectionName = null;

		// Determine the section being viewed
		var _i
		for ( _i = 0; _i < $sections.length; _i += 1 ) {
			$currentSection = $sections[ _i ];
			sectionScrollTop = $currentSection.position().top;
			if (
				( currentScrollTop >= sectionScrollTop - viewportHeight / 2 )
				&&
				( currentScrollTop <= sectionScrollTop + $currentSection.height() + viewportHeight / 2 )
			) {
				currentSectionName = $currentSection.data( "section-title" );
				currentSectionId = $currentSection.data( "section-slug" );
				break;
			}
		}

		/*
		 * If the previous and the current section are the same, then add time
		 * Else, reset the "time spent on a section" counter
		 */
		if ( currentSectionId && currentSectionName == previousSectionName ) {
			timeSpentOnASection += intervalToCheckForEngagement
			if ( timeSpentOnASection >= thresholdTimeForEngagement ) {
				if ( currentSectionName != lastRecordedSection ) {
					window.__BFS.utils.gtmPushToDataLayer( {
						event: "section-view",
						currentSectionId: currentSectionId,
						currentSectionName: currentSectionName
					} );
					lastRecordedSection = currentSectionName;
				}
			}
		}
		else {
			timeSpentOnASection = 0
		}

		previousScrollTop = currentScrollTop;
		previousSectionName = currentSectionName;

	};

}();


window.__BFS.engagementIntervalCheck = window.__BFS.utils.executeEvery(
	intervalToCheckForEngagement / 1000,
	thingsToDoOnEveryInterval
);
window.__BFS.engagementIntervalCheck.start();









} );
