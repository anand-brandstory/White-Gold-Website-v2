<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Braun E. Fridge
 *
 */

use BFS\CMS\WordPress;
use BFS\Router;

WordPress::setupContext();
$footerPost = WordPress::findPostBySlug( 'footer', 'wp_block' );
$footerNavigationMenuItems = WordPress::getNavigation( 'Footer' );

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
								<a href="/<?= $item[ 'url' ] ?>" aria-label="links" class="link h6 strong text-yellow-2"><?= $item[ 'title' ] ?></a><br>
							<?php endforeach; ?>
<a href="https://whitegold.money/careers/" aria-label="careers" class="link h6 strong text-yellow-2">Careers</a><br>
	<a href="mailto:wecare@whitegold.money" aria-label="email" ><h5 class="emailfooter">Email us: wecare@whitegold.money</h5></a>
<div class="support">
<a href="tel://9590704444">
<h4>Support: +91 9590704444</h4>
</a></div>
		<div class="social-icons">
<h5>Connect with us: </h5><br>
<a href="https://www.facebook.com/whitegold.money/" target="_blank" aria-label="facebook" class="fa fa-facebook"></a>
<a href="https://www.linkedin.com/company/white-gold-india/" target="_blank" aria-label="linked-in"  class="fa fa-linkedin mr-3"></a>
<a href="https://instagram.com/whitegold.money?igshid=YmMyMTA2M2Y=" target="_blank" aria-label="instagram" class="fa fa-instagram"></a>
<a href="https://twitter.com/whitegold_money?s=21&t=XjezEzzMapqJvw2naUEyFg" target="_blank" aria-label="Twitter" class="fa fa-twitter"></a>
<a href="https://youtube.com/channel/UCm2R8_Z8hRuOywELr6CjT7A" target="_blank" aria-label="youtube" class="fa fa-youtube-play"></a>
</div>

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
							<p>gold buyers <?= PLACES_IN_REGIONS[ REGION ] ?></p>
							<p>old gold buyers <?= PLACES_IN_REGIONS[ REGION ] ?></p>
							<p>sell gold in <?= PLACES_IN_REGIONS[ REGION ] ?></p>
							<p>cash for gold in <?= PLACES_IN_REGIONS[ REGION ] ?></p>
							<p>gold selling rate in <?= PLACES_IN_REGIONS[ REGION ] ?></p>
						</a>
					</li>
				</ul>
			</nav>
		</section>
		<!-- END: Sitemap Section -->

	</div> <!-- END : Page Content -->


	<?php require_once __ROOT__ . '/pages/snippet/lazaro-signature.php'; ?>

</div><!-- END : Page Wrapper -->

<?php require_once __ROOT__ . '/pages/snippet/modals.php' ?>

<!--  ☠  MARKUP ENDS HERE  ☠  -->

<?php if ( ! BFS_ENV_PRODUCTION ) : ?>
	<?php require_once __ROOT__ . '/pages/snippet/lazaro-disclaimer.php'; ?>
<?php endif; ?>





<!-- JS Modules -->
<script type="text/javascript" src="/plugins/base64/base64.js__v3.7.2.min.js<?= $ver ?>"></script>
<script type="text/javascript" src="/plugins/js-cookie/js-cookie__v3.0.1.min.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/utils.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/forms.js<?= $ver ?>"></script>
<?php if ( ! BFS_ENV_PRODUCTION ) : ?>
	<script type="text/javascript" src="/js/modules/disclaimer.js<?= $ver ?>"></script>
<?php endif; ?>
<script type="text/javascript" src="/js/modules/navigation.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/cupid.js<?= $ver ?>"></script>
<!-- <script type="text/javascript" src="/js/modules/cupid/utils.js<?= $ver ?>"></script> -->
<!-- <script type="text/javascript" src="/js/modules/cupid/user.js<?= $ver ?>"></script> -->
<script type="text/javascript" src="/js/pages/whatsapp-form.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/region-selector.js<?= $ver ?>"></script>
<!-- <script type="text/javascript" src="/js/modules/device-charge.js<?= $ver ?>"></script> -->
<script type="text/javascript" src="/js/modules/video_embed.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/modal_box.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/carousel.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/phone-country-code.js<?= $ver ?>"></script>
<!-- <script type="text/javascript" src="/js/modules/cupid/extensions.js<?= $ver ?>"></script> -->
<script type="text/javascript" src="/js/modules/form-utils.js<?= $ver ?>"></script>



<script
            src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
            crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" type="text/javascript"></script>
 <script>

$('.slider').slick();
            </script>




<?php if ( substr( Router::$urlSlug, 0, 4 ) === 'faqs' or ( WordPress::$isEnabled and WordPress::getPostType() === 'faq' ) ) : ?>
	<script type="text/javascript" src="/js/modules/search.js<?= $ver ?>"></script>
<?php endif; ?>

<?php if ( WordPress::$isEnabled and ! WordPress::$onlySetupContext ) wp_footer() ?>

<?= WordPress::get( 'arbitrary_code_before_body_closing' ) ?>
<!-- <span aria-hidden="true" style="display: none;" hidden></span> -->
</body>

</html>
