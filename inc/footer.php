<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

use BFS\CMS;
use BFS\Router;

$footerPost = CMS::getPostBySlug( 'footer', 'page' );
$footerNavigationMenuItems = CMS::getNavigation( 'Footer' );

$citiesInRegions = [
	'ka' => 'bangalore',
	'tn' => 'chennai',
	'kl' => 'kochi'
];

?>
		
		<!-- Footer Section -->
		<section class="footer-section space-200-bottom fill-dark" id="footer-section" data-section-title="Footer Section" data-section-slug="footer-section">
			<div class="container">
				<div class="row">
					<div class="columns small-12 medium-8 space-200-top">
						<div class="footer-content content-block">
							<?= $footerPost->get( 'post_content' ) ?>
						</div>
					</div>
					<div class="columns small-12 medium-3 medium-offset-1 space-200-top">
						<div class="footer-menu">
							<div class="title h4 strong text-neutral-4 space-75-bottom">Quick Links:</div>
							<?php foreach ( $footerNavigationMenuItems as $item ) : ?>
								<a href="/<?= $item[ 'url' ] ?>" class="link h6 strong text-yellow-2"><?= $item[ 'title' ] ?></a><br>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- END: Footer Section -->

		<!-- Sitemap Section -->
		<section class="visuallyhidden">
			<nav>
				<ul>
					<li>
						<a href="/">
							<p>online gold buyers</p>
							<p>buyers of gold near me</p>
							<p>old gold buyers</p>
							<p>selling gold for cash</p>
							<p>resale value of gold</p>
							<p>pledge gold release</p>
							<p>pledge gold</p>
							<p>old gold selling rate</p>
							<p>best gold buyers</p>
							<p>selling my gold</p>
							<p>sell old gold</p>
							<p>sell gold online</p>
							<p>gold buying and selling</p>
						</a>
					</li>
					<?php /* <li><a href="/<?= REGION ?>/gold-rate">gold selling rate today</a></li> */ ?>
					<li>
						<a href="/<?= REGION ?>">
							<p>gold buyers <?= $citiesInRegions[ REGION ] ?></p>
							<p>old gold buyers <?= $citiesInRegions[ REGION ] ?></p>
							<p>sell gold in <?= $citiesInRegions[ REGION ] ?></p>
							<p>cash for gold in <?= $citiesInRegions[ REGION ] ?></p>
							<p>gold selling rate in <?= $citiesInRegions[ REGION ] ?></p>
						</a>
					</li>
				</ul>
			</nav>
		</section>
		<!-- END: Sitemap Section -->

	</div><!-- END: Page Content -->
	<?php lazaro_signature(); ?>
</div><!-- END: Page Wrapper -->

<?php require_once __ROOT__ . '/inc/modals.php' ?>
<!--  ☠  MARKUP ENDS HERE  ☠  -->

<?php if ( ! BFS_ENV_PRODUCTION ) : ?>
	<?php lazaro_disclaimer(); ?>
<?php endif; ?>

<!-- JS Modules -->
<script type="text/javascript" src="/js/modules/utils.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/region-selector.js<?= $ver ?>"></script>
<!-- <script type="text/javascript" src="/js/modules/device-charge.js<?= $ver ?>"></script> -->
<script type="text/javascript" src="/js/modules/video_embed.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/modal_box.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/carousel.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/form.js<?= $ver ?>"></script>
<?php if ( ! BFS_ENV_PRODUCTION ) : ?>
	<script type="text/javascript" src="/js/modules/disclaimer.js<?= $ver ?>"></script>
<?php endif; ?>

<?php if ( CMS::$isEnabled and ! CMS::$onlySetupContext ) wp_footer() ?>

<?= CMS::get( 'arbitrary_code / before_body_closing' ) ?>

</body>

</html>
