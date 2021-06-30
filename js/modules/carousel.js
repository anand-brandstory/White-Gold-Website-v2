
( function () {





/*
 *
 * This handles the interaction of the arrow buttons on either side of the
 * 	carousel.
 *
 */
$( document ).on( "click", ".js_carousel_container .js_pager", function ( event ) {

	/*
	 * 1. Get references to all the relevant elements
	 */
	var $carouselArrowButton = $( event.currentTarget );
	var domCarouselContent = $carouselArrowButton
				.closest( ".js_carousel_container" )
				.find( ".js_carousel_content" )
				.get( 0 );

	/*
	 * 2. Figure out the "current" carousel item, i.e. the one that's in the center
	 */
	// var { top, left, width, height } = domCarouselContent.getBoundingClientRect();
	// var contentXMidpoint = left + width / 2;
	// var contentYMidpoint = top + height / 2;
	// var domCurrentItem = document.elementFromPoint( contentXMidpoint, contentYMidpoint );
	// var $currentItem;
	// if ( domCurrentItem )
	// 	$currentItem = $( domCurrentItem ).closest( ".js_carousel_item" );

	/*
	 * 3. Get the "next" carousel item in the sequence
	 * 	This could be either the preceeding or the following item,
	 * 	depending on the arrow's direction.
	 */
	// var $nextItem;
	var scrollDirection = $carouselArrowButton.data( "dir" );
	// if ( scrollDirection == "left" )
	// 	$nextItem = $currentItem.prev( ".js_carousel_item" );
	// else
	// 	$nextItem = $currentItem.next( ".js_carousel_item" );

	/*
	 * 4. Get the amount of scroll that has to be done to center the next item
	 */
	// var scrollOffset;
	// if ( $nextItem.length )
	// 	scrollOffset = ( $nextItem.get( 0 ).offsetLeft + $nextItem.innerWidth() / 2 )
	// 					- ( width / 2 );
	// else	// there is no "next" item because the current one is at the boundary
	// 	return;

	var scrollOffset = domCarouselContent.scrollLeft;
	var newScrollOffset;
	var $carouselItem = $( domCarouselContent ).find( ".js_carousel_item" );
	if ( scrollDirection == "left" )
		newScrollOffset = scrollOffset - $carouselItem.width();
	else
		newScrollOffset = scrollOffset + $carouselItem.width();

	/*
	 * 5. Finally, scroll the carousel.
	 */
	try {
		domCarouselContent.scrollTo( { left: newScrollOffset, behavior: "smooth" } );
	}
	catch ( e ) {
		domCarouselContent.scrollTo( newScrollOffset, 0 );
	}

} );



/*
 *
 * When scrolling through a carousel, determine whether to hide/disable any of the directional buttons
 *
 */
$( ".js_carousel_content" ).on( "scroll", window.__BFS.utils.throttle( function ( event ) {
	hideOrShowCarouselButtons( event.target );
}, 0.5 ) );



/*
 * ---- Determine whether to show or hide each of the two carousel's buttons
 *
 * 	(depending on the horizontal scroll position)
 *
 */
function hideOrShowCarouselButtons ( domCarouselContent ) {

	var $carouselContent = $( domCarouselContent );
	var $carouselContainer = $carouselContent.closest( ".js_carousel_container" );
	$carouselContainer.data( "leftPager", $carouselContainer.find( ".js_pager[ data-dir = 'left' ]" ) );
	$carouselContainer.data( "rightPager", $carouselContainer.find( ".js_pager[ data-dir = 'right' ]" ) );

	// Get the computed styles (from cache, else add it)
	var carouselContentStyles = $carouselContent.data( "computedStyles" );
	if ( ! carouselContentStyles ) {
		carouselContentStyles = getComputedStyle( domCarouselContent );
		$carouselContent.data( "computedStyles", carouselContentStyles );
	}
	var carouselContentPaddingLeft = parseInt( carouselContentStyles.paddingLeft );
	var carouselContentPaddingRight = parseInt( carouselContentStyles.paddingRight );
	var scrollWidth = domCarouselContent.scrollWidth;
	var scrollLeft = domCarouselContent.scrollLeft;
	var newCarouselEndOffset = scrollLeft + domCarouselContent.offsetWidth;
	if ( inWithin( scrollLeft, 0, carouselContentPaddingLeft + 100 ) ) {
		$carouselContainer.data( "leftPager" ).addClass( "fade-out" );
		$carouselContainer.data( "rightPager" ).removeClass( "fade-out" );
	}
	else if ( inWithin( newCarouselEndOffset, scrollWidth - carouselContentPaddingRight - 100, scrollWidth ) ) {
		$carouselContainer.data( "leftPager" ).removeClass( "fade-out" );
		$carouselContainer.data( "rightPager" ).addClass( "fade-out" );
	}

}

function inWithin ( number, startRange, endRange ) {
	if ( startRange > endRange ) {
		var tmp = startRange;
		startRange = endRange;
		endRange = tmp;
	}
	return number >= startRange && number <= endRange;
}





}() );
