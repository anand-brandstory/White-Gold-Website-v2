<?php
/*
 *
 * This is a sample page you can copy and use as boilerplate for any new page.
 *
 */

require_once __ROOT__ . '/inc/header.php';

use BFS\CMS;
CMS::setupContext();

?>





<!-- Sample Section -->
<section class="sample-section">
	<div class="container">
		<div class="row">
			<div class="columns small-12">
				<!-- insert text -->
			</div>
		</div>
	</div>
</section>
<!-- END: Sample Section -->


<!-- ## General Page -->
<?php require_once __ROOT__ . '/pages/section/header.php'; ?>


<!-- ## Home Page -->
<!-- Landing Carousel Section -->
<?php require_once __ROOT__ . '/pages/section/landing-carousel.php'; ?>
<!-- END: Landing Carousel Section -->


<!-- Home Menu Section -->
<section class="home-menu-section">
	<div class="container">
		<div class="row">
			<?php require __ROOT__ . '/pages/snippet/menu.php'; ?>
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
<?php require_once __ROOT__ . '/pages/section/sell-gold-home-visit-form.php'; ?>
<!-- END: Sell Gold Home Visit Form Section -->


<!-- Sell Gold FAQs Section -->
<?php require_once __ROOT__ . '/pages/section/sell-gold-faqs.php'; ?>
<!-- END: Sell Gold FAQs Section -->


<!-- Report Malpractice Section -->
<?php //require_once __ROOT__ . '/pages/section/report-malpractice.php'; ?>
<!-- END: Report Malpractice Section -->


<!-- Release Gold Section -->
<?php require_once __ROOT__ . '/pages/section/release-gold.php'; ?>
<!-- END: Release Gold Section -->


<!-- Release Gold FAQs Section -->
<?php require_once __ROOT__ . '/pages/section/release-gold-faqs.php'; ?>
<!-- END: Release Gold FAQs Section -->


<!-- ## Live Gold Page -->
<!-- Live Gold Section -->
<section class="live-gold-section">
	<div class="container">
		<div class="row">
			<div class="inline-modal columns small-12">
				<div class="otp-verify">
					<!-- insert text -->
				</div>
				<div class="off-hrs">
					<!-- insert text -->
				</div>
				<div class="holiday">
					<!-- insert text -->
				</div>
				<div class="number-blocked">
					<!-- insert text -->
				</div>
			</div>
			<div class="live-gold columns small-12">
				<div class="row">
					<div class="live-gold-graph columns small-12">
						<!-- insert text -->
					</div>
					<div class="live-gold-data columns small-12">
						<!-- insert text -->
					</div>
					<div class="live-gold-quote columns small-12">
						<!-- insert text -->
					</div>
					<div class="live-gold-alert-form columns small-12">
						<!-- insert text -->
					</div>
					<div class="live-gold-video columns small-12">
						<!-- insert text -->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Live Gold Section -->





<?php require_once __ROOT__ . '/inc/footer.php'; ?>
<script type="text/javascript" src="/js/pages/home/sell-gold-form.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/pages/home/home-visit-form.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/pages/home/login-prompts.js<?= $ver ?>"></script>
