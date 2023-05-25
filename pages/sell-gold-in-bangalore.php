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
	return require_once __ROOT__ . '/pages/sell-gold-in-india.php';

require_once __ROOT__ . '/pages/partials/header-custom.php';

?>
<?php require_once __ROOT__ . '/pages/section/header.php'; ?>
<div class="why-whitegold">
<?php require_once __ROOT__ . '/pages/section/includes/slider-lp.php'; ?>
<?php require_once __ROOT__ . '/pages/section/includes/menu-below-slider.php'; ?>
<!-- Sell Gold Form Section -->
<?php require_once __ROOT__ . '/pages/section/includes-lp/lp-form.php'; ?>
<!-- END: Sell Gold Form Section -->

<div class="new-sell-page">
<!-- sell gold section START -->
<section class="new-sell-gold fill-blue-5 space-200-top">
<div class="container">

  <div class="text-center">
<h2 class="text-white">Experience Exceptional Customer Service with Every Transaction!</h2>
<p class="text-white">At White Gold, we offer more than just a simple transaction - we offer a reliable service of buying your gold at the best market rate.</p>
<img src="/cms/../content/cms/Full-img-3.png" class="img-fluid mt-5">
</div>
</div>
</section>
<!-- sell gold section END -->
<!-- why sell section START -->
<section class="new-sell-gold icon-section space-100-top space-200-bottom">
<div class="container">
 <!-- row start -->
<div class="row">
  <div class="small-12 large-6"><!--col start -->
<img src="/cms/../content/cms/Group-4106.png" class="img-fluid pd-lg-50 d-none d-md-block">
</div><!--col end -->
<div class="small-12 large-6"><!--col start -->
<div class="mt-5 pt-20p">
<h2>Why Sell Your Gold With White Gold</h2>
</div>
<div class="row">
<div class="small-6 large-6">
<div class="icon">
<div class="d-lg-flex mt-5">
<img src="/cms/../content/cms/Group-4035.svg" class="img-fluid">
<p>Get advanced gold purity check with German Technology</p>
</div>
<div class="d-lg-flex mt-5">
<img src="/cms/../content/cms/Group-4034-1.svg" class="img-fluid">
<p>Hassle-free transaction and KYC verification</p>
</div>
<div class="d-lg-flex mt-5">
<img src="/cms/../content/cms/Group-4034-2.svg" class="img-fluid">
<p class="pt-3 pt-sm-4c">Closure of the deal</p>
</div>
</div></div>
<div class="small-6 large-6">
<div class="icon">
<div class="d-lg-flex mt-5">
<img src="/cms/../content/cms/Group-4034.svg" class="img-fluid">
<p>Benefits from 50 branches across South India</p>
</div>

<div class="d-lg-flex mt-5 pt-sm-6c">
<img src="/cms/../content/cms/Group-4036.svg" class="img-fluid">
<p>Secured and Safe legal documentation</p>
</div>

<div class="d-lg-flex mt-5 ">
<img src="/cms/../content/cms/Group-4034-3.svg" class="img-fluid">
<p class="pt-sm-5c pt-3">Earn bonus and benefits</p>
</div>
</div></div>
</div>
<div class="text-small-center">
<p style="font-style:italic;color:#0032A0;font-size:20px;" class="pt-5 pb-4 d-block">Get The Best Value For Your Gold!</p>
<a href="/ka/branches" class="button fill-blue-5">
										<span class="button-label">Find Branch&ensp;</span>
										<img class="button-icon tall" alt="location" src="/media/icon/location-tall-red.svg?v=20230406_1">
									</a></div>
</div>

</div><!--col end -->
</div>
<!-- row end -->
</div>
</section>
<!-- why sell section END -->
<section class="fill-neutral-1 old-gold space-200-top-bottom new-sell-page">
<div class="container">
<div class="row">
<div class="small-12 large-8">
<h2>Financial Difficulties? Cutting Down Your Old Gold? </h2>
<p class="text-blue-4 strong pb-3 d-block">Put Everything At Ease With White Gold</p>
  <!-- inner row -->
<div class="row">
<div class="small-12 large-6">
<div class="box mt-4">
<p>At White Gold, we are equipped with advanced technology and offer the best value for you to<a href="https://whitegold.money/"> sell gold.</a></p>
</div>
</div>
<div class="small-12 large-6">
<div class="box mt-4">
  <p>Our highly trained staff, easy-to-navigate branches, and efficient customer service can get the best value for your gold.</p>
</div>
</div>
</div>
<!-- inner row end -->
</div>
<div class="small-12 large-4">
    <div class="text-small-center">
<img src="/cms/../content/cms/Group-4082-2.png" class="img-fluid pt-5"></div>
</div>
</div>
</div>
</section>
<section class="seven-steps fill-blue-5 space-200-top new-sell-page">
    <div class="text-center">
<h2 class="pb-4"> Our Simple Seven-Step Process To Sell Gold</h2></div>
<div class="container">
  <!-- row start -->
<div class="row">
<!-- col start -->
<div class="small-12 large-5 d-none d-md-block d-medium-none">

<img src="/cms/../content/cms/Growth-Ladder-At-White-Gold-img-6.png" class="img-fluid pt-5">
</div>
<!-- col end -->
<!-- col start -->
<div class="small-12 large-7">
    <!-- inner row start -->
<div class="row">
<!-- inner col start -->
<div class="small-12 large-6">
<div class="d-flex">
<div class="number">1</div>
<h4 class="text-white">Reach out to the nearest branch <span class="text-white">Contact your nearest branch to sell gold.</span></h4>
<!-- <p class="text-white">Contact your nearest branch to sell gold.</p> -->
</div>


</div>
<div class="small-12 large-6">
<div class="d-flex">
<div class="number">2</div>
<h4 class="text-white">Carry an ID proof <span class="text-white">Submit Govt. issued ID card for verification and to passport to fast-track the verification process.</span></h4>
<!-- <p class="text-white">Contact your nearest branch to sell gold.</p> -->

</div>
</div>
<div class="small-12 large-6 mt-3 mt-md-0">
<div class="d-flex">
<div class="number">3</div>
<h4 class="text-white">Check the Gold Purity<span class="text-white">We make use of the latest technology advanced gold testing machine to ensure you get the right gold value as you sell gold to us.</span></h4>
<!-- <p class="text-white">Contact your nearest branch to sell gold.</p> -->

</div>
</div>
<div class="small-12 large-6 mt-3 mt-md-0">
<div class="d-flex">
<div class="number">4</div>
<h4 class="text-white">Compare the current Gold rate <span class="text-white">We shall fix the gold rate post the purity check based on the current market value.</span></h4>
<!-- <p class="text-white">Contact your nearest branch to sell gold.</p> -->

</div>
</div>
<div class="small-12 large-6">
<div class="d-flex">
<div class="number">5</div>
<h4 class="text-white">KYC verification <span class="text-white">Once you are satisfied with the gold rate, we will proceed with identity verification and other procedures.</span></h4>
<!-- <p class="text-white">Contact your nearest branch to sell gold.</p> -->

</div>
</div>
<div class="small-12 large-6">
<div class="d-flex">
<div class="number">6</div>
<h4 class="text-white">Instant Payment <span class="text-white">Post the verification and documentation, we instantly transfer the amount to your bank account and confirm the transaction.</span></h4>
<!-- <p class="text-white">Contact your nearest branch to sell gold.</p> -->

</div>
</div>
<div class="small-12 large-6  mt-3 mt-md-0">
<div class="d-flex">
<div class="number">7</div>
<h4 class="text-white">Extra Bonus <span class="text-white">Carry the original bills and get an extra bonus while you sell gold.</span></h4>
<!-- <p class="text-white">Contact your nearest branch to sell gold.</p> -->

</div>
</div>
</div>
 <!-- inner row start -->

</div>
<!-- col end -->


</div>
<!-- row end -->
</div>
</section>
<section class="solutions-section fill-dark space-200-top-bottom">
<div class="container">
<div class="row text-center"><!-- row start -->
<div class="small-12 large-6"><!-- col start -->
<div class="h4 strong line-height-medium pt-lg-25p">Get an instant financial solution</div>
<div class="h2 strong text-yellow-2 pb-4">Sell gold to us now!</div>
</div><!-- col start -->
<div class="small-12 large-6"><!-- col start -->

<div class="fill-neutral-5 space-150 radius-50">
<div class="bdr-btm pb-5">
<div class="h5 strong line-height-medium pb-3">Learn more about our procedures</div>
<a href="#" class="button fill-yellow-2"><img class="button-icon" src="/cms/../content/cms/information-button-1-1.svg"><span class="button-label">&ensp;Know More</span></a>
</div>
<div class="h5 strong line-height-medium pb-3 pt-5">Get all your queries answered</div>
<a href="tel://919590704444" class="button fill-yellow-2"><img class="button-icon" src="/cms/../content/cms/Vector-3.svg"><span class="button-label">&ensp;+91 9590704444</span></a>
</div>
</div><!-- col start -->


</div><!-- row end -->
</div>
</section>

</div>
<?php if( have_rows('faq_careers') ): ?>

<section class="release-gold-faqs-section fill-neutral-1 space-200-top space-200-bottom js_section_release_gold_faqs" id="release-gold-faqs-section" data-section-title="Release Gold FAQs Section" data-section-slug="release-gold-faqs-section">
	<div class="container">
		<div class="row">
			<div class="text-center">
				<div class="h2 strong text-neutral-3 space-100-bottom">Frequently Asked Questions</div></div>
                <!-- <div class="columns small-12 large-2"></div> -->
			<div class="columns small-12 large-12">

				<div class="row">
<p class="mb-5 text-justify" style="font-size:16px;"><?php the_field('add_faq_sub_content');?></p>
					<div class="videos-faqs columns small-12">
						<div class="videos-faqs-grid row">
													</div>
					</div>
					<div class="articles-faqs columns small-12">
						<input id="more-release-gold-faqs" type="checkbox" name="more-release-gold-faqs" class="more-faqs visuallyhidden">
						<div class="faqs">
												
              <?php while( have_rows('faq_careers') ): the_row(); ?>	
															<div class="faq">
									<input id="release-gold-faq-<?php the_sub_field('add_title');?>" type="radio" name="release-gold-faq" class="visuallyhidden js_faq_toggle" checked="">
									<label for="release-gold-faq-<?php the_sub_field('add_title');?>" class="question block row space-25-top-bottom">
                                    <div class="toggle columns small-2 large-1"><div class="arrow-custom"><div class="arrow"><span class="a1"></span><span class="a2"></span></div></div></div>
                                    <div class="title columns small-10 large-11 space-25">
											<div class="h6 medium" style="font-weight: 800;"><?php the_sub_field('add_title');?></div>
										</div>
										
									</label>
									<div class="answer fill-neutral-2 radius-50">
										<div class="p space-50"><!-- wp:paragraph {"placeholder":"Type in a detailed answer here..."} -->
<p class="text-justify"><?php the_sub_field('add_description');?></p>
</div>
									</div>
								</div>
                <?php endwhile; ?>
													</div>
						<label class="hide-faqs columns small-12 text-center" for="more-release-gold-faqs">
							<div class="button fill-neutral-2">Show All FAQs</div>
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>


<?php
require_once __ROOT__ . '/pages/partials/footer.php'; ?>



<style>
    .arrow{
    right: 5px;
    top: 5px;
    }
    .arrow-custom{
    width: 50px;
    height: 24px;
        background-position: right 0% bottom 45%;
    background-size: contain;
    background-repeat: no-repeat;
        background-image: url("https://whitegold.money/cms/../content/cms/Ellipse-294.png");
       
    }
    @media screen and (min-width: 1440px){
        .pt-10p{padding-top:10%;}
        .pt-20p{padding-top:20%;}
        .arrow-custom{width: 43px;height: 43px;background-position: right 0% bottom 45%;margin-top: -8px;}
    .arrow{right: 11px;top: 12px;position: relative!important;top: 11px!important;

    }
    }
  
    .bdr-btm{border-bottom: 1px solid rgba(255, 255, 255, 0.12);}
    .seven-steps h4{font-weight:700;}
    .seven-steps span{font-size:15px;display:block;margin-top:5px;font-weight: 400;}

.new-sell-page h2{font-weight: 700;font-size: 32px;}
/* .new-sell-page p {} */
@media screen and (min-width: 980px){ .pd-lg-50{padding:50px;}.seven-steps .number{color:#FFFFFF;opacity: 0.1;font-size: 120px;font-weight: 700;}.seven-steps h4{position: relative;font-size: 20px;top: 33px;right: 29px;}.pt-lg-25p{padding-top: 25%;}}
.new-sell-gold .icon p{margin-left: 10px;margin-top: 9px;}
.old-gold .box{background:#FFFFFF;padding:20px;border-radius: 12px;border-right: 6px solid #DCDCDC;border-bottom: 6px solid #DCDCDC;}
@media screen and (max-width: 980px){
    /* .icon-section p{font-size:16px;} */
.pb-sm-2c {padding-bottom: 0.5rem!important;}
.pb-sm-4c {padding-bottom: 1.5rem!important;}
.pb-sm-5c {padding-bottom: 1.8rem!important;}
.pb-sm-7c {padding-bottom: 2.4rem!important;}
.pt-sm-2c {padding-top: 0.5rem!important;}
.pt-sm-3c {padding-top: 0.9rem!important;}
.pt-sm-4c {padding-top: 1.5rem!important;}
.pt-sm-5c {padding-top: 1.8rem!important;}
.pt-sm-6c {padding-top: 2.0rem!important;}
.pt-sm-7c {padding-top: 2.4rem!important;}
    .text-small-center{text-align:center;}
    .seven-steps h4{position: relative;font-size: 20px;top: 25px;right: 29px;} 
.seven-steps .number{color:#FFFFFF;opacity: 0.1;font-size: 96px;font-weight: 700;}}
@media only screen and (min-width: 769px) and (max-width: 1035px) { .d-medium-none{display:none!important;}

}

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

