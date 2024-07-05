<?php
/**

 * Template Name: template location
 */

\BFS\CMS\WordPress::setupContext();

// If a post revision or preview is being viewed, and the user is not authorized to view it, simply return to the home page
// NOTE: The revision / preview URLs of **unpublished** posts have no URL slugs, only query parameters, i.e. they essential resemble that of the home page URL
if ( \BFS\Router::$urlSlug == '' )
	return require_once __ROOT__ . '/pages/sell-gold-in-mysore.php';

require_once __ROOT__ . '/pages/partials/header-custom.php';

?>
<?php require_once __ROOT__ . '/pages/section/header.php'; ?>
<link rel="stylesheet" type="text/css" href="/css/lp.css">
<!-- Landing Carousel Section -->
<?php require_once __ROOT__ . '/pages/section/includes-lp/slider-lp.php'; ?>
<!-- END: Landing Carousel Section -->



<?php require_once __ROOT__ . '/pages/section/includes/menu-below-slider.php'; ?>

<!-- Sell Gold Form Section -->
<?php require_once __ROOT__ . '/pages/section/includes-lp/lp-form.php'; ?>
<!-- END: Sell Gold Form Section -->
<?php if( get_field('add_contents')): ?>
<section class="exchange-gold space-200-top-bottom bg-grey">
<?php the_field('add_contents');?>
</section><?php endif; ?>




<!-- START highlights  Section -->
<?php require_once __ROOT__ . '/pages/section/includes-lp/section-highlights.php'; ?>
<!-- END highlights  Section -->

<!-- what we do section -->
<?php require_once __ROOT__ . '/pages/section/includes-lp/what-we-do-section.php'; ?>
<!-- END: what we do Section -->
<?php if( get_field('enable_section') == 'yes' ): ?>
<!-- START: Price Section -->
<?php require_once __ROOT__ . '/pages/section/includes-lp/price-section.php'; ?>
<!-- END: Price Section --><?php endif; ?>

<?php require_once __ROOT__ . '/pages/section/includes/benefits.php'; ?>
<!-- Report Malpractice Section -->
<?php if( get_field('enable_sell_gold_section') == 'yes' ): ?>
<section class="home-why-whitegold space-200-top space-200-bottom">
<div class="container">
    <div class="text-center mt-3 mb-4"><h2>Why Sell Gold To White Gold?</h2></div>
    <div class="row mt-5-xl">
<div class="columns small-12 large-5">
<img src="/cms/../content/cms/Group-4189-1-2.png" class="img-fluid" alt="" title="">
</div>
<div class="columns small-12 large-7 mt-2">
<div class="row mt-2">
<!-- box starts  --><div class="columns small-6 large-4 mb-1 mt-1">
<div class="grey-box bg-grey">
 
<img src="/cms/../content/cms/Group.svg" class="img-fluid mb-2" alt="Technology Driven logo" title="Technology Driven"><p class="mt-1">Technology Driven</p>
</div></div>
<!-- box ends --><div class="columns small-6 large-4 mb-1 mt-1">
<div class="grey-box bg-grey">
 
<img src="/cms/../content/cms/Group-1.svg" class="img-fluid mb-2" alt="Wide Network Of Branches icon" title="Wide Network Of Branches"><p class="mt-1">Wide Network Of Branches</p>
</div></div>
<!-- box ends --><div class="columns small-6 large-4 mb-1 mt-1">
<div class="grey-box bg-grey">
 
<img src="/cms/../content/cms/Group-2.svg" class="img-fluid mb-2" alt="Professional Team icon" title="Professional Team"><p class="mt-1">Professional Team</p>
</div></div>
<!-- box ends --><div class="columns small-6 large-4 mb-1 mt-1">
<div class="grey-box bg-grey">
 
<img src="/cms/../content/cms/Group-3.svg" class="img-fluid mb-2" alt="Complaint Redressal System icon" title="Complaint Redressal System"><p class="mt-1">Complaint Redressal System</p>
</div></div>
<!-- box ends --><div class="columns small-6 large-4 mb-1 mt-1">
<div class="grey-box bg-grey">
 
<img src="/cms/../content/cms/Group-4.svg" class="img-fluid mb-2" alt="White Group Conglomerate icon" title="White Group Conglomerate"><p class="mt-1">White Group Conglomerate</p>
</div></div>
<!-- box ends --><div class="columns small-6 large-4 mb-1 mt-1">
<div class="grey-box bg-grey">
 
<img src="/cms/../content/cms/Group-5.svg" class="img-fluid mb-2" alt="Live Gold Rate - White Gold" title="Live Gold Rate"><p class="mt-1">Live Gold Rate</p>
</div></div>
<!-- box ends --></div>
</div>
<div class="text-center mt-3">
<div class="">
<a class="btn-primary-blue" href="https://whitegold.money/why-whitegold/" aria-label="Know More">Know More</a></div>
    </div>
</div>
</div>


</section><?php endif; ?>

<!-- END: Report Malpractice Section -->
<?php require_once __ROOT__ . '/pages/section/includes-lp/testimonial-lp.php'; ?>

<?php if( get_field('add_image') ): ?>
<!-- START: location Section -->
<?php require_once __ROOT__ . '/pages/section/includes-lp/reach-us.php'; ?>
<!-- END: location Section -->
<?php endif; ?>
<!-- START: faq Section -->
<?php require_once __ROOT__ . '/pages/section/includes/faq-section.php'; ?>
<?php require_once __ROOT__ . '/pages/section/includes/faq-section.php'; ?>
<?php require_once __ROOT__ . '/pages/section/includes/store-locator.php'; ?>



<?php

get_footer(); ?>

</script><script type="text/javascript" src="/js/modules/lp.js<?= $ver ?>"></script>
<style>

@media only screen and (min-width: 600px) and (max-width: 1000px)  {
.d-tab-none{display: none!important;}

}
@media screen and (max-width: 1100px){
.text-sml-center{text-align:center;}
}
@media screen and (max-width: 980px){
    .lp-mysore .highlight .slick-prev {
    position: absolute;
    left: 35%;
    top: 203%;
    z-index: 1;
}
.lp-mysore .highlight .slick-next {
    position: absolute;
    top: 203%;
    right: 35%;
    z-index: 1;
}  
}

.exchange-gold ul li:before {
    content: url(https://staging.whitegold.money/cms/../content/cms/correct-2-1.svg)!important;
    position: absolute;
    left: 10px;
}

.landing-carousel-section .carousel .carousel-list-item p {
    text-align: left;
    word-spacing: 0px;
}



.mt--2{margin-top:-4px!important;}
.why-us h2{font-size: 32px;font-weight: 700;}
.inner-box4 h5{color: white;font-size: 24px;font-weight: 500;}
.inner-box4 p{display: block;color: white;font-size: 16px;}
.inner-box4{padding:25px;border-radius: 12px;}
.inner-box4 h6{font-size:20px;}
.fw-500{font-weight: 500!important;}
.exchange-gold h2{font-size: 32px;font-weight: 700;}
.exchange-gold p{font-size: 16px;}
.exchange-gold ul li{font-size:16px;color:#000000;list-style:none;padding-left: 40px;}

.company .inner-box p{margin-left: 12px;margin-top: 9px;}
.careers-page h1,
.landing-carousel-section h1 {
    line-height:53px!important;
    font-size: 44px !important;
    font-weight: 800;
}
.cms-content .section1 .icon p {
    margin-left: 6px;
    margin-top: 9px;
    color: #212322;
    display: flex;
}
.icon img, .icon2 img, .icon4 img {
    margin-top: -9px;
    margin-right: 10px;
}
.home-why-whitegold p {
    font-size:15px;
}
.grey-box {margin: 5px;}
</style>
<script>
    /**
 |
 | Sell Gold Form
 |
 |
 */
 $( function () {

// Imports
let BFSForm = window.__BFS.exports.BFSForm

// Set up the namespace
window.__BFS = window.__BFS || { };
window.__BFS.UI = window.__BFS.UI || { };

let sellGoldForm = new BFSForm( ".js_sell_gold_form" );

// Set up the form's input fields, data validators and data assemblers
    // Name
sellGoldForm.addField( "name", ".js_form_input_name", function ( values ) {
    let name = values[ 0 ]
    return BFSForm.validators.name( name )
} );

    // Quantity
sellGoldForm.addField( "quantity", ".js_form_input_quantity", function ( values ) {
    var quantity = values[ 0 ].trim();

    if ( quantity === "" )
        throw new Error( "Please provide the quantity of gold (in grams)." );

    quantity = parseInt( quantity, 10 );
    if ( window.isNaN( quantity ) )
        throw new Error( "Please provide a valid gold quantity amount." );

    return quantity;
} );

    // Phone number
sellGoldForm.addField( "phoneNumber", [ ".js_phone_country_code", ".js_form_input_phonenumber" ], function ( values ) {
    let [ phoneCountryCode, phoneNumberLocal ] = values
    return BFSForm.validators.phoneNumber( phoneCountryCode, phoneNumberLocal )
} );
// When programmatically focusing on this input field, which of the (two, in this case) input elements to focus on?
sellGoldForm.fields[ "phoneNumber" ].defaultDOMNodeFocusIndex = 1



sellGoldForm.submit = function submit ( data ) {
    let person = Cupid.getCurrentPerson( data.phoneNumber )
    person.setName( data.name )
    person.setSourcePoint( "Sell Gold" )

    Cupid.logPersonIn( person, { trackSlug: "sell-gold-form" } )

    person.setExtendedAttributes( { goldQuantityToSellInGrams: data.quantity } )
    Cupid.savePerson( person )
    PersonLogger.submitData( person )

    return Promise.resolve( person )
}



/**
 | Form submission handler
 |
 */
$( document ).on( "submit", ".js_sell_gold_form", function ( event ) {

    /*
     | Prevent default browser behaviour
     */
    event.preventDefault();

    /*
     | Prevent interaction with the form
     */
    sellGoldForm.disable();

    /*
     | Provide feedback to the user
     */
    sellGoldForm.giveFeedback( "Sending..." );

    /*
     | Extract data (and report issues if found)
     */
    var data;
    try {
        data = sellGoldForm.getData();
    } catch ( error ) {
        alert( error.message )
        console.error( error.message )
        sellGoldForm.enable();
        sellGoldForm.fields[ error.fieldName ].focus()
        sellGoldForm.setSubmitButtonLabel();
        return;
    }

    /*
     | Submit data
     */
    sellGoldForm.submit( data )
        .then( function ( response ) {
            closeFormAndGiveFeedback()
        } )

} );




/**
 |
 | Helper functions
 |
 */
function closeFormAndGiveFeedback () {
window.location.href = "https://whitegold.money/thank-you";
}

} );
/**
 |
 | Home Visit Form
 |
 |
 */
$( function () {

// Imports
let BFSForm = window.__BFS.exports.BFSForm

// Set up the namespace
window.__BFS = window.__BFS || { };
window.__BFS.UI = window.__BFS.UI || { };
let homeVisitForm = new BFSForm( ".js_home_visit_form" );

// Set up the form's input fields, data validators and data assemblers
    // Pincode
homeVisitForm.addField( "pincode", ".js_form_input_pincode", function ( values ) {
    var pincode = values[ 0 ].trim();

    if ( pincode === "" )
        throw new Error( "Please provide your pincode." );

    pincode = parseInt( pincode, 10 );
    if ( window.isNaN( pincode ) )
        throw new Error( "Please provide a valid pincode number." );
    else if ( pincode.toString().length !== 6 )
        throw new Error( "Please provide a 6-digit pincode number." );

    return pincode;
} );

    // Phone number
homeVisitForm.addField( "phoneNumber", [ ".js_phone_country_code", ".js_form_input_phonenumber" ], function ( values ) {
    let [ phoneCountryCode, phoneNumberLocal ] = values
    return BFSForm.validators.phoneNumber( phoneCountryCode, phoneNumberLocal )
} );
// When programmatically focusing on this input field, which of the (two, in this case) input elements to focus on?
homeVisitForm.fields[ "phoneNumber" ].defaultDOMNodeFocusIndex = 1
homeVisitForm.submit = function submit ( data ) {
    let person = Cupid.getCurrentPerson( data.phoneNumber )
    person.setSourcePoint( "Home Visit Form" )

    Cupid.logPersonIn( person, { trackSlug: "home-visit-form" } )

    person.setExtendedAttributes( { pincode: data.pincode } )
    Cupid.savePerson( person )
    PersonLogger.submitData( person )

    return Promise.resolve( person )
}



/**
 | Form submission handler
 |
 */
$( document ).on( "submit", ".js_home_visit_form", function ( event ) {

    /*
     | Prevent default browser behaviour
     */
    event.preventDefault();

    /*
     | Prevent interaction with the form
     */
    homeVisitForm.disable();

    /*
     | Provide feedback to the user
     */
    homeVisitForm.giveFeedback( "Sending..." );

    /*
     | Extract data (and report issues if found)
     */
    var data;
    try {
        data = homeVisitForm.getData();
    } catch ( error ) {
        alert( error.message )
        console.error( error.message )
        homeVisitForm.enable();
        homeVisitForm.fields[ error.fieldName ].focus()
        homeVisitForm.setSubmitButtonLabel();
        return;
    }

    /*
     | Submit data
     */
    

homeVisitForm.submit( data )
        .then( function ( response ) {
            //closeFormAndGiveFeedback()
            
                window.location.href = "https://whitegold.money/thank-you";
            
        } )


} );

/**
 |
 | Helper functions
 |
 */


function closeFormAndGiveFeedback () {
    homeVisitForm.getFormNode().parent().addClass( "show-thankyou" )
}



} );


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
    

   .highlight .slick-prev {
      display: none;
}
.highlight .slick-next {
    display: none;
}  
.highlight .slick-dots{display: none;}
.section-highlights.space-100-bottom {
    padding-bottom: 0px!important;
}
.section-highlights .container-fluid.mb-5{
    margin-bottom: 0rem !important;
}

</style>
