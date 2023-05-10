<?php
/**
 * The template for displaying for refer-and-earn page 
 *
 * `/cms/wp-content/themes/<theme>/404.php` has been symbolically linked to this.
 *
 *
 */

\BFS\CMS\WordPress::setupContext();

// If a post revision or preview is being viewed, and the user is not authorized to view it, simply return to the home page
// NOTE: The revision / preview URLs of **unpublished** posts have no URL slugs, only query parameters, i.e. they essential resemble that of the home page URL
if ( \BFS\Router::$urlSlug == '' )
	return require_once __ROOT__ . '/pages/news-and-articles.php';

require_once __ROOT__ . '/pages/partials/header-custom.php';

?>
<?php wp_head(); ?>
<?php require_once __ROOT__ . '/pages/section/header.php'; ?>


<div class="blog-listing">

<?php 
                    $image = get_field('add_blog_banner_desktop');
                    if( !empty( $image ) ): ?>
<section class="slider-banner fill-blue-5 space-200-top d-none d-md-block" style="
background-image: url(<?php echo esc_url($image['url']); ?>);background-position: right 0% bottom 45%;background-size: contain;background-repeat: no-repeat;" alt="<?php echo esc_attr($image['alt']); ?>">
<?php endif; ?>
<div class="container">
		<!-- row starts -->
<div class="row">
<div class="columns small-12 large-7">
<h1 class="mt-5 mb-4"><?php the_field('add_blog_banner_title');?></h1>
<p class="d-none d-md-block"><?php the_field('add_blog_banner_description');?></p>
<p class="d-lg-none d-md-none"><?php the_field('add_blog_banner_description_mobile');?></p>
</div>

<div class="columns small-12 large-6">
</div>
<div>
<!-- row ends -->
</div>
</section>
<!-- banner section desktop version ends -->


<!-- banner mobile version starts -->
<div class="blog-mobile-banner d-lg-none">
<section class="slider-banner fill-blue-5 space-100-top space-100-bottom">

<div class="container">
		<!-- row starts -->
<div class="row">
<div class="col-lg-6">
<h1 class="mb-4"><?php the_field('add_blog_banner_title');?></h1>
<p><?php the_field('add_blog_banner_description');?></p>
</div>

<div class="col-lg-6">
    <?php
$imagemobile = get_field('add_blog_banner_mobile');
                    if( !empty( $imagemobile ) ): ?>
	<div class="bg-mobile" style="background-image: url(<?php echo esc_url($imagemobile['url']); ?>);background-position: right 84% bottom 45%;background-size: cover;background-repeat: no-repeat;height: 232px;position:relative;
    left:4.5%;top:-8%;" alt="<?php echo esc_attr($imagemobile['alt']); ?>">
	</div><?php endif; ?>
</div>

<div>
<!-- row ends -->

</div>
</section></div>

<?php if( have_rows('add_articles') ): ?>
<section class="blog-grid space-100-top space-200-bottom bg-dark-grey items">
    <div class="container">
        <div class="row">
        <div class="blog-grid-inner">


        <?php while( have_rows('add_articles') ): the_row(); ?>
        <div class="columns small-12 large-4 pd-10 mb-4 ">
        

        <a href="<?php the_sub_field('add_link');?>" target="_blank"><img src="<?php the_sub_field('add_image');?>" class="img-fluid" alt=""></a>

        
                        <a class="mb--5" href="<?php the_sub_field('add_link');?>" target="_blank">
 <div class="mb-4 mt-4 except" href="<?php the_sub_field('add_link');?>" target="_blank">
<?php the_sub_field('add_title');?></div></a>
<div class="d-flex-all">
<p class="author-name d-flex"><?php the_sub_field('add_news_souce');?></p>
<p class="col-o mt-2 "><?php the_sub_field('posted_date');?></p>
</div>
</div>
<?php endwhile; ?>



</div>
</div></div>
</section>
<?php endif; ?>

<section class="blog-newsletter fill-blue-5 space-200-top space-200-bottom" id="subscribenow">
<div class="container">
<div class="row">

<div class="columns small-12 large-12">
  <div class="mt-4 mb-5">
<h2 class="mt-4 mb-5">Subscribe To Our Media Updates</h2></div>
<div class="mb-5"><p class="">Thank you for visiting our Media Page, we hope you find our content informative and useful. Subscribe to our blog updates to explore more fascinating topics.</p>
</div>
<?php echo do_shortcode('[contact-form-7 id="1467" title="Contact form 1"]'); ?>

</div>

</div>

</div>

</section>
<?php
require_once __ROOT__ . '/pages/partials/footer.php'; ?>
<?php wp_footer(); ?>


<style>

/* News and Articles inner page STARTS */

.mb--5{
  margin-bottom:-5px;
}

  .col-o{
      color:#00000075!important;
  }
.blog-grid a:hover{
  color: #000000a3;
}
.blog-grid img{
  border-radius:8px;
}

  .blog-newsletter ::-webkit-input-placeholder { /* WebKit browsers */
  color: #ffffff !important;
  opacity: 0.56;
}
.blog-newsletter :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
  color: #ffffff !important;
  opacity: 0.56;
}
.blog-newsletter ::-moz-placeholder { /* Mozilla Firefox 19+ */
  color: #ffffff !important;
  opacity: 0.56;
}
.blog-newsletter :-ms-input-placeholder { /* Internet Explorer 10+ */
  color: #ffffff !important;
  opacity: 0.56;
}
.blog-newsletter .input-field:focus, input[type="email"]:focus, input[type="number"]:focus, input[type="search"]:focus, input[type="text"]:focus, input[type="tel"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="date"]:focus, textarea:focus, select:focus{
  background-color: #0000ff00;
  outline: 0;
  border-color: #c7c8c9;
  color: white;
}
.blog-newsletter .input-field, input[type="email"], input[type="number"], input[type="search"], input[type="text"], input[type="tel"], input[type="url"], input[type="password"], input[type="date"], textarea, select{
  color:white;
}


  .btn-custom-primary {
  font-size: 14px;
  color: #0032A0!important;
  background-color: white!important;
  border-radius: 7px;
  text-decoration: none!important;
  font-weight: 700;
  padding: 14px 15px 13px 15px;
  position: relative;
}
  .blog-newsletter p {
  color: white;
  font-size: 18px;
}
.blog-newsletter h2 {
  font-size: 32px;
  font-weight: 800;
  color: white;
}
@media (min-width: 1440px){
  .blog-grid-inner .except {
      padding-right: 82px!important;
}
}



.bg-dark-grey {
  background-color: #E9E9E7;
}
.blog-grid-inner p {
  display: inline-block;
  font-size: 15px;
  color: #212322;
}
  .pd-10 {
  padding: 10px;
}
  .except::after {
  position: relative;
  content: url(https://whitegold.money/cms/../content/cms/charm_arrow-right.svg);
  left: 5px;
  top: 3px;
}
.except:hover::after {
  position: relative;
  content: url(https://whitegold.money/cms/../content/cms/charm_arrow-right1.svg);
  left: 5px;
  top: 3px;
}
  .blog-grid-inner .except {
  padding-right: 26px;
  font-size: 20px;
  font-weight: 700;
}

.blog-listing .slider-banner p {
  color: white;
  padding-bottom: 33%;
  font-size: 18px!important;
}

.blog-listing .slider-banner h1 {
  font-size: 42px;
  font-weight: 800;
}


/* News and Articles inner page ENDS */


</style>