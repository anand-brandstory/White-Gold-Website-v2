<?php
/**
 |
 | FAQs
 |
 */

require_once __ROOT__ . '/lib/routing.php';
require_once __ROOT__ . '/lib/providers/wordpress.php';
require_once __ROOT__ . '/types/faqs/faqs.php';

use BFS\Router;
use BFS\CMS\WordPress;
use BFS\Types\FAQs;


/*
 |
 | Update the request URL slug
 | 	so that WordPress routes as per as intended
 |
 | Since all URLs are contextual to a region, we need to modify the URL (take for example) `/ka/faqs/what-is-this` to `/faqs/what-is-this`. The latter URL actually maps to an FAQ post, whereas the former does not.
 |
 */
if ( strpos( Router::$urlSlug, 'faqs' ) !== 0 )
	Router::$urlSlug = implode( '/', array_slice( explode( '/', Router::$urlSlug ), 1 ) );	// Strip away the region prefix

WordPress::setupContext( Router::$urlSlug );



if ( ! defined( 'REGION' ) )
	define( 'REGION', DEFAULT_REGION );


// If this is request to the base url `/faqs`, then redirect to the first FAQ
if ( Router::$urlSlug === 'faqs' and empty( $_GET[ 's' ] ) ) {
	$firstFAQ = FAQs::getFirstFAQ();
	$redirectURL = '/' . REGION . wp_make_link_relative( get_permalink( $firstFAQ->get( 'ID' ) ) );
	return Router::redirectTo( $redirectURL );
	exit;
}

// If this is a search query request, then delegate the handling to `faq-search.php`
if ( Router::$urlSlug == 'faqs' and ! empty( $_GET[ 's' ] ) )
	return require_once __ROOT__ . '/pages/faq-search.php';



global $thisFAQ;
$thisFAQ = FAQs::getFromURL();

// If there isn't a corresponding post, redirect to the first FAQ
if ( empty( $thisFAQ ) ) {
	http_response_code( 404 );
	$firstFAQ = FAQs::getFirstFAQ();
	$redirectURL = '/' . REGION . wp_make_link_relative( get_permalink( $firstFAQ->get( 'ID' ) ) );
	return Router::redirectTo( $redirectURL );
	exit;
}

$faqs = FAQs::getByRegion( REGION );
$faqs__Tree = FAQs::getTreeRepresentation( $faqs );


function getFAQHierarchyMarkup ( $faqs__Tree, $parentId ) {
	if ( empty( $faqs__Tree[ $parentId ] ) )
		return '';

	global $thisFAQ;

	?>

	<ul>
		<?php foreach ( $faqs__Tree[ $parentId ] as $faq ) : ?>
			<li class="<?php if ( $faq->get( 'ID' ) == $thisFAQ->get( 'ID' ) ) : ?>active js_active<?php endif; ?>">
				<a href="<?= $faq->get( 'url' ) ?>"><?= $faq->get( 'post_title' ) ?></a>
				<?= getFAQHierarchyMarkup( $faqs__Tree, $faq->get( 'ID' ) ) ?>
				<button class="hierarchy-toggle js_expand">&#9654;</button>
			</li>
		<?php endforeach; ?>
	</ul>

	<?php

}



// Set the document's section title
$sectionTitle = 'Help Center';

require_once __ROOT__ . '/pages/partials/header.php';

?>

<?php require_once __ROOT__ . '/pages/section/header.php'; ?>

<script type="text/javascript">
	window.__BFS = window.__BFS || { };
	window.__BFS.post = {
		title: "<?= $thisFAQ->get( 'post_title' ) ?>"
	};
</script>


<section class="faq-header-section fill-blue-5 space-75-bottom">
	<div class="container">
		<div class="row">
			<div class="columns small-12">
				<div class="h1 strong">Help Center</div>
			</div>
		</div>
	</div>
</section>
<?php /* ----- Search Section ----- */
require __ROOT__ . '/pages/snippet/search-bar.php';
?>

<!-- FAQ Content Section -->
<section class="faq-content-section space-75-top-bottom">
	<div class="container">
		<div class="row">
			<div class="faq-sidebar columns small-12 large-4 js_faq_sidebar">
				<div class="sidebar-min fill-blue-1 hide-large hide-xlarge space-50 cursor-pointer js_toggle_sidebar" tabindex="-1">
					<div class="sidebar-min-label h5 text-blue-5 opacity-50 clearfix"><span class="label float-left">Help Center Menu</span> <span class="icon material-icons float-right">expand_more</span></div>
					<div class="active-title h6 text-blue-5 js_current_category">Lumpsum</div>
				</div>
				<div class="faq-hierarchy js_faq_listing"><?= getFAQHierarchyMarkup( $faqs__Tree, 0, $thisFAQ->get( 'ID' ) ) ?></div>
			</div>
			<div class="faq-content columns small-12 large-8 xlarge-7">
				<div class="title h3 strong text-blue-4 space-75-bottom">
					<?= $thisFAQ->get( 'post_title' ) ?>
				</div>
				<div class="content-block">
					<?= $thisFAQ->get( 'post_content' ) ?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: FAQ Content Section -->





<script type="text/javascript">

	$( function () {

		/*
		 * ----- Expand the entire listing on clicking the global toggle (mobile only)
		 */
		$( ".js_toggle_sidebar" ).on( "click", function ( event ) {
			var $faqSidebar = $( event.target ).closest( ".js_faq_sidebar" );
			$faqSidebar.toggleClass( "show-sidebar" );
		} );

		/*
		 * ----- Expand all the parent sections
		 */
		var $activeFAQ = $( ".js_faq_listing .js_active" );
		$activeFAQ
			.addClass( "active" )
			.addClass( "show-hierarchy" )
			.parentsUntil( ".js_faq_listing", "li" )
				.addClass( "show-hierarchy" )

		/*
		 * ----- Reflect the top-level section name in the Listing Heading / Toggle (mobile only)
		 */
		var $topLevelFAQ = $activeFAQ.parentsUntil( ".js_faq_listing", "li" ).last();
		if ( ! $topLevelFAQ.length )
			$topLevelFAQ = $activeFAQ;
		var currentTopLevelHeading = $topLevelFAQ.find( " > a" ).text();
		$( ".js_current_category" ).text( currentTopLevelHeading );

		/*
		 * ----- Expand a listing section on clicking on the adjacent arrow
		 */
		$( ".js_faq_listing" ).on( "click", ".js_expand", function ( event ) {
			$( event.target ).closest( "li" ).toggleClass( "show-hierarchy" );
		} );

	} );

</script>

<?php require_once __ROOT__ . '/pages/partials/footer.php'; ?>

<?php
/*
 | If there are any carousels on the page, initiate them
 */
?>
<script type="text/javascript" src="/plugins/slick/slick.min.js"></script>
<script type="text/javascript">
( function () {

	let galleryBlockCarousel = $( ".blocks-gallery-grid" ).slick( {
		arrows: true,
		dots: false,
		infinite: true,
		speed: 800,
		autoplaySpeed: 3000,
		slidesToShow: 1,
		centerMode: true,
		variableWidth: true,
		lazyLoad: 'ondemand'
	} )

	setTimeout( function () {
		galleryBlockCarousel.slick( "slickNext" );
	}, 150 )

}() )
</script>
