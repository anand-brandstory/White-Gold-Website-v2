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
	return require_once __ROOT__ . '/pages/why-whitegold.php';

require_once __ROOT__ . '/pages/partials/header-custom.php';

?>
<?php require_once __ROOT__ . '/pages/section/header.php'; ?>
<div class="why-whitegold">
<?php require_once __ROOT__ . '/pages/section/includes/slider-lp.php'; ?>
<?php require_once __ROOT__ . '/pages/section/includes/menu-below-slider.php'; ?>

<?php if(have_rows('add_section')):?>
  <?php while( have_rows('add_section') ): the_row(); ?>
<?php the_sub_field('add_contents');?>
<?php endwhile; ?>
<?php endif; ?>
<?php require_once __ROOT__ . '/pages/section/includes/faq-section.php'; ?>
<?php require_once __ROOT__ . '/pages/section/includes/store-locator.php'; ?></div>
<?php
require_once __ROOT__ . '/pages/partials/footer.php'; ?>

<script>
$('.branch-slider').slick({
dots: true,
arrows: true,	
  infinite: true,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
		slidesToScroll: 2,
		dots: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
	slidesToScroll: 1,
	dots:false
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
</script>

<script>
var rev = $('.highlight');
rev.on('init', function(event, slick, currentSlide) {
  var
    cur = $(slick.$slides[slick.currentSlide]),
    next = cur.next(),
    prev = cur.prev();
  prev.addClass('slick-sprev');
  next.addClass('slick-snext');
  cur.removeClass('slick-snext').removeClass('slick-sprev');
  slick.$prev = prev;
  slick.$next = next;
}).on('beforeChange', function(event, slick, currentSlide, nextSlide) {
  //console.log('beforeChange');
  var
    cur = $(slick.$slides[nextSlide]);
  //console.log(slick.$prev, slick.$next);
  slick.$prev.removeClass('slick-sprev');
  slick.$next.removeClass('slick-snext');
  next = cur.next(),
    prev = cur.prev();
  prev.prev();
  prev.next();
  prev.addClass('slick-sprev');
  next.addClass('slick-snext');
  slick.$prev = prev;
  slick.$next = next;
  cur.removeClass('slick-next').removeClass('slick-sprev');
});

rev.slick({
  speed: 1000,
  arrows: true,
  dots: true,
  infinite: true,
  slidesPerRow: 1,
  slidesToShow: 1,
  slidesToScroll: 1,
  customPaging: function(slider, i) {
    return '';
  },
  /*infinite: false,*/
});
</script>
<script type="text/javascript">

	$( function () {

		/*
		 *
		 * ----- Allow the user to collapse an open FAQ in the Release Gold FAQs section
		 *
		 */
		var $releaseGoldFAQsSection = $( ".js_section_release_gold_faqs" );
		var currentlyToggledCardId = $releaseGoldFAQsSection.find( ".js_faq_toggle:checked" ).attr( "id" );
		$releaseGoldFAQsSection.on( "click", ".js_faq_toggle", function ( event ) {
			var domCardToggle = event.target;
			var newlyToggledCardId = domCardToggle.id;

			if ( currentlyToggledCardId !== newlyToggledCardId )
				return;

			domCardToggle.checked = false;
			currentlyToggledCardId = null;
		} );
		$releaseGoldFAQsSection.on( "change", ".js_faq_toggle", function ( event ) {
			currentlyToggledCardId = event.target.id;
		} );

	} );

</script>
<style>



/* why white gold page css START */
.cms-content .section1 h2{
  font-size: 32px;
    font-weight: 800;
    color:black;
}
.cms-content .section1 .icon p{
  margin-left: 6px;
    margin-top: 9px;
    color: #212322;
    display: flex;
}

.cms-content2 h2{
  font-weight: 700;
    font-size: 32px;
}

@media (min-width:1025px){
  .landing-carousel-section h1{
  padding-top:10%;
}
  .cms-content2 .btn-custom-primary img{
  margin-right: 10px;
    line-height: 29px;
    align-items: center;
    width: 30px;
    height: 30px;
    color: white;
    background-color: #0032A0;
    border-radius: 53px;

}
.cms-content2 .btn-custom-primary {
    border-radius: 10px;
    margin-right: 15px;
}
.pd50-lg{padding: 50px;}
.pt-35cm{padding-top:35%;}
.pt-20cm{padding-top:20%;}
.pt-25cm{padding-top:25%;}
.pt-30cm{padding-top:30%;}
.pt-10cm{padding-top:10%;}
.pt-15cm{padding-top:15%;}
.pt-22cm{padding-top:22%;}
}
.cms-content3 h2{
  color:black;
  font-weight: 700;
  font-size: 32px;
}
.cms-content3 .map-location .icon2 p{
  display:flex;
margin-left: 7px;
margin-top: 9px;
}
.cms-content2 .icon4 p {
  display:flex;
margin-left: 6px;
margin-top: 9px;
color:white;
}
@media (min-width:1440px){
  .why-whitegold h1{font-size:60px!important;}
  .pt-10-xl{padding-top:10%;}
}
.icon img, .icon2 img, .icon4 img{margin-top: -9px;margin-right: 10px;}


@media (max-width:1025px){
  .cms-content2 .btn-custom-primary {
    border-radius: 10px;
    margin-right: 15px;
    padding: 7px 6px 5px 5px;
}
  .cms-content2 .btn-custom-primary img {
    margin-right: 10px;
    line-height: 24px;
    align-items: center;
    width: 25px;
    height: 25px;
    color: white;
    background-color: #0032A0;
    border-radius: 53px;
}

  .cms-content2 .btn-custom-primary {
  font-size: 10px;
  }
}
@media (max-width:480px){
  .cms-content .container {
    max-width: 370px;
}
}
/* why white gold page css END */
</style>