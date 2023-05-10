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
	return require_once __ROOT__ . '/pages/careers.php';

require_once __ROOT__ . '/pages/partials/header-custom.php';

?>
<?php require_once __ROOT__ . '/pages/section/header.php'; ?>

<?php require_once __ROOT__ . '/pages/section/includes/slider.php'; ?>
<?php require_once __ROOT__ . '/pages/section/includes/menu-below-slider.php'; ?>
<?php require_once __ROOT__ . '/pages/section/includes/about-section.php'; ?>
<?php require_once __ROOT__ . '/pages/section/includes/core-values.php'; ?>
<?php require_once __ROOT__ . '/pages/section/includes/growth.php'; ?>
<?php require_once __ROOT__ . '/pages/section/includes/image-section.php'; ?>
<?php require_once __ROOT__ . '/pages/section/includes/benefits.php'; ?>
<?php require_once __ROOT__ . '/pages/section/includes/openings.php'; ?>
<?php require_once __ROOT__ . '/pages/section/includes/feedback.php'; ?>
<?php require_once __ROOT__ . '/pages/section/includes/testimonial.php'; ?>
<?php require_once __ROOT__ . '/pages/section/includes/faq-section.php'; ?>
<?php require_once __ROOT__ . '/pages/section/includes/store-locator.php'; ?>



<?php
require_once __ROOT__ . '/pages/partials/footer.php'; ?>

</script>
<!-- tab js -->
<script>
  function openTab(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }
  
  document.getElementById("defaultOpen").click();
    
  </script>
<!-- tab js end -->



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

<script type="text/javascript">

	$( function () {

		/*
		 *
		 * ----- Allow the user to collapse an open procedure step (card) in the Sell Gold section
		 *
		 */
		var $sellGoldSection = $( ".js_section_sell_gold" );
		var currentlyToggledCardId = $sellGoldSection.find( ".js_card_toggle:checked" ).attr( "id" );
		$sellGoldSection.on( "click", ".js_card_toggle", function ( event ) {
			var domCardToggle = event.target;
			var newlyToggledCardId = domCardToggle.id;

			if ( currentlyToggledCardId !== newlyToggledCardId )
				return;

			domCardToggle.checked = false;
			currentlyToggledCardId = null;
		} );
		$sellGoldSection.on( "change", ".js_card_toggle", function ( event ) {
			currentlyToggledCardId = event.target.id;
		} );

	} );

</script>



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
<style>.btn-custom-primary {
    color: #0032A0!important;
    background-color: white;
    padding: 15px 15px 13px 15px;
    border-radius: 7px;
    text-decoration: none!important;
    font-weight: 700;
}</style>
