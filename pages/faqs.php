<?php
/*
 *
 * ----- FAQs
 *
 */
require_once __ROOT__ . '/inc/routing.php';
require_once __ROOT__ . '/inc/cms.php';

use BFS\Router;
use BFS\CMS;
CMS::setupContext();



// If this is search query request, then delegate the handling to `faq-search.php`
if ( Router::$urlSlug == 'faqs' and ! empty( $_GET[ 's' ] ) )
	return require_once __ROOT__ . '/pages/faq-search.php';



global $thePost;
$thePost = CMS::getThisPost();

// If there isn't a corresponding post, redirect to the introduction FAQ
if ( empty( $thePost ) ) {
	http_response_code( 404 );
	return header( 'Location: /faqs/introduction', true, 302 );
	exit;
}

$faqs = CMS::getPostsOf( 'faqs' );
$faqs__Tree = [ ];
foreach ( $faqs as $faq ) {
	$faq->set( 'url', get_permalink( $faq->get( 'ID' ) ) );
	// Build the a hierarchical tree representation of all the FAQs
	$faqs__Tree[ $faq->get( 'post_parent' ) ][ ] = $faq;
}

function getFAQHierarchyMarkup ( $faqs__Tree, $parentId ) {
	if ( empty( $faqs__Tree[ $parentId ] ) )
		return '';

	global $thePost;

	?>

	<ul>
		<?php foreach ( $faqs__Tree[ $parentId ] as $faq ) : ?>
			<li class="<?php if ( $faq->get( 'ID' ) == $thePost->get( 'ID' ) ) : ?>active js_active<?php endif; ?>">
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

require_once __ROOT__ . '/inc/header.php';

?>

<script type="text/javascript">
	window.__BFS = window.__BFS || { };
	window.__BFS.post = {
		title: "<?= $thePost->get( 'post_title' ) ?>"
	};
</script>

<?php /* ----- Search Section ----- */
require __ROOT__ . '/pages/snippet/search-bar.php';
?>


<!-- FAQ Content Section -->
<section class="faq-content-section space-50-top-bottom">
	<div class="container">
		<div class="row">
			<div class="faq-sidebar columns small-12 large-4 js_faq_sidebar">
				<div class="sidebar-min fill-blue-1 hide-large hide-xlarge space-min cursor-pointer js_toggle_sidebar" tabindex="-1">
					<div class="sidebar-min-label h5 text-blue-4 opacity-50 clearfix"><span class="label float-left">Help Center Menu</span> <span class="icon material-icons float-right">expand_more</span></div>
					<div class="active-title h6 text-blue-4 js_current_category">Lumpsum</div>
				</div>
				<div class="faq-hierarchy js_faq_listing"><?= getFAQHierarchyMarkup( $faqs__Tree, 0, $thePost->get( 'ID' ) ) ?></div>
			</div>
			<div class="faq-content columns small-12 large-8 xlarge-7">
				<div class="title h4 strong space-50-bottom">
					<?= $thePost->get( 'post_title' ) ?>
				</div>
				<div class="post-content">
					<?= $thePost->get( 'post_content' ) ?>
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

<?php require_once __ROOT__ . '/inc/footer.php'; ?>
