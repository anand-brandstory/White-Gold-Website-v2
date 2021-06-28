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

?>
		
		<!-- Footer Section -->
		<section class="footer-section space-200-bottom fill-dark" id="footer-section" data-section-title="Footer Section" data-section-slug="footer-section">
			<div class="container">
				<div class="row">
					<div class="columns small-12 medium-8 space-200-top">
						<div class="footer-content">
							<?= $footerPost->get( 'post_content' ) ?>
						</div>
					</div>
					<div class="columns small-12 medium-3 medium-offset-1 space-200-top">
						<div class="footer-menu">
							<?php foreach ( $footerNavigationMenuItems as $item ) : ?>
								<a href="/<?= $item[ 'url' ] ?>" class="block p strong"><?= $item[ 'title' ] ?></a>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- END: Footer Section -->

	</div><!-- END: Page Content -->
	<?php lazaro_signature(); ?>
</div><!-- END: Page Wrapper -->

<?php require_once __ROOT__ . '/inc/modals.php' ?>
<!--  ☠  MARKUP ENDS HERE  ☠  -->

<?php if ( ! BFS_ENV_PRODUCTION ) : ?>
	<?php lazaro_disclaimer(); ?>
<?php endif; ?>

<!-- JS Modules -->
<script type="text/javascript" src="/js/modules/utils.js"></script>
<!-- <script type="text/javascript" src="/js/modules/device-charge.js"></script> -->
<script type="text/javascript" src="/js/modules/video_embed.js"></script>
<script type="text/javascript" src="/js/modules/modal_box.js"></script>
<script type="text/javascript" src="/js/modules/form.js"></script>
<?php if ( ! BFS_ENV_PRODUCTION ) : ?>
	<script type="text/javascript" src="/js/modules/disclaimer.js"></script>
<?php endif; ?>

<?php if ( CMS::$isEnabled and ! CMS::$onlySetupContext ) wp_footer() ?>

<?= CMS::get( 'arbitrary_code / before_body_closing' ) ?>

</body>

</html>
