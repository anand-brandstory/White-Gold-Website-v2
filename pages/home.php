<?php
/**
 |
 | Home page
 |
 */

require_once __ROOT__ . '/types/cards/cards.php';
require_once __ROOT__ . '/types/faqs/faqs.php';
require_once __ROOT__ . '/types/videos/videos.php';

use \BFS\Types\FAQs;
use \BFS\Types\Videos;
use \BFS\Types\Cards;

$carouselSlides = Cards::getByRegion( REGION );
$sellGoldFAQs = FAQs::getByRegionAndSection( REGION, 'sell-gold' );
$sellGoldVideos = Videos::getByRegionAndSection( REGION, 'sell-gold' );
$releaseGoldFAQs = FAQs::getByRegionAndSection( REGION, 'release-gold' );
$releaseGoldVideos = Videos::getByRegionAndSection( REGION, 'release-gold' );


$postTitle = '';

require_once __ROOT__ . '/pages/partials/header.php';

?>





<!-- ## General Page -->
<?php require_once __ROOT__ . '/pages/section/header.php'; ?>


<!-- ## Home Page -->
<!-- Landing Carousel Section -->
<?php require_once __ROOT__ . '/pages/section/landing-carousel.php'; ?>
<!-- END: Landing Carousel Section -->


<!-- Home Menu Section -->
<section class="home-menu-section js_inline_menu_widget">
	<div class="container">
		<div class="row">
			<?php navigationMenuComponent( 'home', $contactNumbersForRegions ); ?>
		</div>
	</div>
</section>
<!-- END: Home Menu Section -->


<!-- Sell Gold Form Section -->
<?php require_once __ROOT__ . '/pages/section/sell-gold-form.php'; ?>
<!-- END: Sell Gold Form Section -->


<!-- Sell Gold Section -->
<?php require_once __ROOT__ . '/pages/section/sell-gold.php'; ?>
<!-- END: Sell Gold Section -->


<!-- Sell Gold Home Visit Form Section -->
<?php // require_once __ROOT__ . '/pages/section/sell-gold-home-visit-form.php'; ?>
<!-- END: Sell Gold Home Visit Form Section -->


<!-- Sell Gold FAQs Section -->
<?php require_once __ROOT__ . '/pages/section/sell-gold-faqs.php'; ?>
<!-- END: Sell Gold FAQs Section -->


<!-- Report Malpractice Section -->
<!-- aka "Don't Get Cheated", "File Complaint" -->
<?php require_once __ROOT__ . '/pages/section/report-malpractice.php'; ?>
<!-- END: Report Malpractice Section -->


<!-- Release Gold Section -->
<?php require_once __ROOT__ . '/pages/section/release-gold.php'; ?>
<!-- END: Release Gold Section -->


<!-- Release Gold FAQs Section -->
<?php require_once __ROOT__ . '/pages/section/release-gold-faqs.php'; ?>
<!-- END: Release Gold FAQs Section -->





<?php require_once __ROOT__ . '/pages/partials/footer.php'; ?>

<script type="text/javascript" src="/js/pages/home/sell-gold-form.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/pages/home/home-visit-form.js<?= $ver ?>"></script>
<!-- <script type="text/javascript" src="/js/pages/home/login-prompts.js<?= $ver ?>"></script> -->
