<?php
/**
 * The template for displaying for thankyou page 
 *
 * `/cms/wp-content/themes/<theme>/404.php` has been symbolically linked to this.
 *
 *
 */

\BFS\CMS\WordPress::setupContext();

// If a post revision or preview is being viewed, and the user is not authorized to view it, simply return to the home page
// NOTE: The revision / preview URLs of **unpublished** posts have no URL slugs, only query parameters, i.e. they essential resemble that of the home page URL
if ( \BFS\Router::$urlSlug == '' )
	return require_once __ROOT__ . '/pages/ka/gold-buyers-in-thalayolaparambu.php';



require_once __ROOT__ . '/pages/partials/header-custom.php';

?>
<?php require_once __ROOT__ . '/pages/section/header.php'; ?>
<link rel="stylesheet" type="text/css" href="/css/lp.css">
<!-- ## Home Page -->
<!-- Landing Carousel Section -->
<?php require_once __ROOT__ . '/pages/section/includes-lp/slider-lp.php'; ?>
<!-- END: Landing Carousel Section -->

<?php require_once __ROOT__ . '/pages/section/includes/menu-below-slider.php'; ?>

<!-- Sell Gold Form Section -->
<?php require_once __ROOT__ . '/pages/section/includes-lp/lp-form.php'; ?>
<!-- END: Sell Gold Form Section -->

<!-- START highlights  Section -->
<?php require_once __ROOT__ . '/pages/section/includes-lp/section-highlights.php'; ?>
<!-- END highlights  Section -->

<!-- what we do section -->
<?php require_once __ROOT__ . '/pages/section/includes-lp/what-we-do-section.php'; ?>
<!-- END: what we do Section -->



<!-- START: Price Section -->
<?php require_once __ROOT__ . '/pages/section/includes-lp/price-section.php'; ?>
<!-- END: Price Section -->

<?php require_once __ROOT__ . '/pages/section/includes/benefits.php'; ?>
<!-- Report Malpractice Section -->
<!-- start "File Complaint" -->
<?php require_once __ROOT__ . '/pages/section/includes-lp/report-malpractice.php'; ?>
<!-- END: Report Malpractice Section -->
<?php require_once __ROOT__ . '/pages/section/includes-lp/testimonial-lp.php'; ?>

<!-- START: location Section -->
<?php require_once __ROOT__ . '/pages/section/includes-lp/reach-us.php'; ?>
<!-- END: location Section -->

<!-- START: faq Section -->
<?php require_once __ROOT__ . '/pages/section/includes/faq-section.php'; ?>
<!-- END: faq Section -->

<?php require_once __ROOT__ . '/pages/section/includes/store-locator.php'; ?>
<!-- <script type="text/javascript" src="/js/pages/custom.js"></script> -->
<?php
require_once __ROOT__ . '/pages/partials/footer.php'; ?>
<script type="text/javascript" src="/js/pages/custom.js"></script>
<script type="text/javascript" src="/js/modules/lp.js<?= $ver ?>"></script>
<style>
@media screen and (max-width: 980px){
    .lp-thalayolaparambu .highlight .slick-prev {
    position: absolute;
    left: 35%;
    top: 235%;
    z-index: 1;
}
.lp-thalayolaparambu .highlight .slick-next {
    position: absolute;
    top: 235%;
    right: 35%;
    z-index: 1;
}  
}
@media screen and (min-width: 1080px){
    .lp-thalayolaparambu .highlight .slick-prev {
    position: absolute;
    left: 35%;
    top: 138%;
    z-index: 1;
}
.lp-thalayolaparambu .highlight .slick-next {
    position: absolute;
    top: 138%;
    right: 35%;
    z-index: 1;
}  
.lp-thalayolaparambu .highlight .slick-dots {
    bottom: -216px!important;
}
}

</style>



