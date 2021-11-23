<?php

// Check if there's anything in the honeypot
	// If there is, then pretend there is a server error
if ( ! empty( $_GET[ 'bfs_hi_puf' ] ) ) {
	http_response_code( 500 );
	exit;
}



require_once __ROOT__ . '/lib/providers/wordpress.php';
require_once __ROOT__ . '/types/faqs/faqs.php';

use BFS\CMS\WordPress;
use BFS\Types\FAQs;

WordPress::setupContext();
$faqs = FAQs::get( [
	's' => get_query_var( 's' )
] );
foreach ( $faqs as $faq ) {
	// If summary exists, use that, else pull from the faq content and crop it to below 199 characters ( and don't break in the middle of a word )
	$summary = $faq->get( 'summary' ) ?: wp_strip_all_tags( $faq->get( 'post_content' ) );
	if ( strlen( $summary ) <= 199 )
		$faq->set( 'preview', $summary );
	else
		$faq->set(
			'preview',
			preg_replace(
				'/\s[^\s]+$/',
				'',
				substr( $summary , 0, 199 )
			) . '...'
		);
}

$postTitle = 'Search results for "' . get_query_var( 's' ) . '"';

require_once __ROOT__ . '/pages/partials/header.php';

?>

<?php require_once __ROOT__ . '/pages/section/header.php'; ?>

<section class="faq-header-section fill-blue-5 space-75-bottom">
	<div class="container">
		<div class="row">
			<div class="columns small-12">
				<div class="h1 strong">Search Results</div>
			</div>
		</div>
	</div>
</section>
<?php /* ----- Search Section ----- */
require __ROOT__ . '/pages/snippet/search-bar.php';
?>


<!-- Search Listing Section -->
<section class="search-listing-section space-50-top space-75-bottom">
	<div class="container">
		<div class="row">
			<div class="search-listing columns small-12 large-9">
				<?php if ( ! empty( $faqs ) ) : ?>
					<?php foreach ( $faqs as $faq ) : ?>
						<a class="item block space-50 fill-blue-1 radius-25" href="<?= $faq->get( 'url' ) ?>">
							<div class="title h6 strong space-25-bottom"><?= $faq->get( 'post_title' ) ?></div>
							<div class="description p opacity-50 space-25-bottom"><?= $faq->get( 'preview' ) ?></div>
							<span class="label inline text-lowercase">Read More <span class="material-icons">subject</span></span>
						</a>
					<?php endforeach; ?>
				<?php else : ?>
					<div class="h4 strong">Sorry, we could not find any articles matching :</div>
					<div class="space-25-top p">"<?= esc_html( get_query_var( 's' ) ) ?>"</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<!-- END: Search Listing Section -->



<?php require_once __ROOT__ . '/pages/partials/footer.php'; ?>
