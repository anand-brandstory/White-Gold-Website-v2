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
<link rel="stylesheet" type="text/css" href="/css/lp.css">
<div class="why-whitegold">
<?php require_once __ROOT__ . '/pages/section/includes/slider-lp.php'; ?>
<?php require_once __ROOT__ . '/pages/section/includes/menu-below-slider.php'; ?>
<!-- Sell Gold Form Section -->
<?php require_once __ROOT__ . '/pages/section/includes-lp/lp-form.php'; ?>
<!-- END: Sell Gold Form Section -->

<!-- what we do section -->
<?php require_once __ROOT__ . '/pages/section/includes-lp/what-we-do-section.php'; ?>
<!-- END: what we do Section -->

<section class="price-section space-200-top-bottom light-grey ">
<div class="container">
    <div class="text-center mb-5 mt-3">
    <h2 class=""><?php the_field('add_section_heading');?></h2></div>

<!-- table section Start -->
<table class="table mt-3">
    <!-- start table heading -->
  <thead>
    <tr>
      <th scope="col" class="item"><h6 class="mt-3">Factors</h6></th>
      <th scope="col" class="item2"> <h6 class="mt-3">Other Gold Buyers</h6></th>
      <th scope="col" class="item3 fill-blue-5"> <h6 class="mt-3">White Gold - Gold Buyers</h6></th>
    </tr>
  </thead>
   <!-- end table heading -->
  <tbody>
    <!-- start table row -->
    <tr>
      <td>
      <div class="d-lg-flex mt-4 mb-2">
    <img src="/cms/../content/cms/Group-4167.svg" class="img-fluid" alt="">
    <h6 class="title1">Technology-Driven Expertise</h6>
</div>
      </td>
      <td>
    <ul>
<li>Use of unreliable scales, improper testing methods to determine the weight and purity of gold will give inconclusive results.</li>
</ul>
</td>
<td>
    <ul>
<li>Possess specialized knowledge and expertise in gold purity checks with advanced technology German machines.</li>
</ul>
</td>
</tr>
<!-- end table row -->
<tr>
      
      <td><div class="d-lg-flex mt-4 mb-2">
    <img src="/cms/../content/cms/Group-4167.svg" class="img-fluid">
    <h6 class="title1">Wide network of branches</h6>
</div></td>
      <td> <ul>
<li>Do not have multiple branches, and sellers must stick to one shop.</li>
</ul></td>
      <td><ul>
<li>We are spread across South India with over 50 branches. </li>
</ul></td>
    </tr>
    <tr>
      
      <td><div class="d-lg-flex mt-4 mb-2">
    <img src="/cms/../content/cms/Group-4169.svg" class="img-fluid">
    <h6 class="title1">Security and transparency</h6>
</div></td>
<td> <ul>
<li>Do not possess the same level of security in terms of transaction and billing.</li>
</ul></td>
<td> <ul>
<li>We follow a secure & transparent transaction process with thorough KYC and zero hidden charges.</li>
</ul></td>
    </tr>
    <tr>
      
      <td><div class="d-lg-flex mt-4 mb-2">
    <img src="/cms/../content/cms/Group-4170.svg" class="img-fluid">
    <h6 class="title1">Payouts</h6>
</div></td>
      <td><ul>
<li>Can provide a low price with fewer benefits when compared to White Gold.</li>
</ul></td>
<td><ul>
<li>We provide the right payouts and other benefits like a bonus.</li>
</ul></td>
    </tr>
    <tr>
      
      <td><div class="d-lg-flex mt-4 mb-2">
    <img src="/cms/../content/cms/Group-4171.svg" class="img-fluid">
    <h6 class="title1">Easy Steps</h6>
</div></td>
<td><ul>
<li>Often take a long-time to process the gold and still may not provide the full payout.</li>
</ul></td>
<td><ul>
<li>We offer convenient and easy 7 steps with an authentic process for selling your gold objects.</li>
</ul></td>
    </tr>
   
  </tbody>
</table>
<!-- table section ends -->
</div>
</section>

</div>

<!-- why us section  START -->
<section class="why-us space-200-top-bottom fill-blue-5">
<div class="container">
<div class="text-center mb-5">
<h2>Why Us?</h2>
</div>
<!-- row start -->
<div class="row">
	<!-- col start -->
<div class="small-12 large-4">
<img src="/cms/../content/cms/Rectangle-826-1.png" class="img-fluid d-none d-md-block d-med-none">
<div class="inner-box4 fill-blue-4 mt-4">
<h5>Cutting-edge tech</h5>
<p>White Gold uses the latest gold testing machines to ensure accuracy and reliability.</p>
</div>
<div class="inner-box4 fill-blue-4 mt-4 mb-4">
<h5>Expert staff</h5>
<p>White Gold's well-educated and highly professional team is ready to assist with all your gold needs.</p>
</div>
<img src="/cms/../content/cms/Rectangle-829.png" class="img-fluid d-none d-md-block d-med-none mt-4">
</div>
<div class="small-12 large-4 mb-2">
<div class="inner-box4 fill-blue-4">
<h5>Real-time rates</h5>
<p>We get<a href="/ka/live-gold"> <b>&nbsp;live gold rates&nbsp; </a></b>sourced from MCX India to calculate the right value.</p>
</div>
<div class="inner-box4 bg-white mt-4">
<h6 class="text-black fw-500 mb-3">Choose White Gold to exchange your gold today!</h6>
<p class="text-black mt-3">Write to us at</p>
<a class="btn-primary-blue mt-3"  href="tel://9590704444"><img src="/cms/../content/cms/telephone-svg.svg" class="img-fluid mt--2"> +91 9590704444</a>
</div>
<img src="/cms/../content/cms/Rectangle-823.png" class="img-fluid d-none d-md-block d-med-none mt-4">

</div>
<div class="small-12 large-4">
<img src="/cms/../content/cms/Rectangle-827-2.png" class="img-fluid d-none d-md-block d-med-none mt-4">
<div class="inner-box4 fill-blue-4 mt-4">
<h5>Wide reach</h5>
<p>With 50 branches across South India, White Gold is accessible to customers across the region.</p>
</div>
<div class="inner-box4 fill-blue-4 mt-4">
<h5>Happy customers</h5>
<p>Join over 500,000 satisfied customers who trust White Gold for their gold transactions.</p>
</div>
<img src="/cms/../content/cms/Rectangle-828.png" class="img-fluid d-none d-md-block d-med-none mt-4">
</div>

</div>
<!-- row start -->
</div>
</section>
<!-- why us section END -->


<?php if( have_rows('top_career_section') ): ?>
<section class="sell-gold-section fill-neutral-1 space-200-top space-80-bottom js_section_sell_gold" id="sell-gold-section" data-section-title="Sell Gold Section" data-section-slug="sell-gold-section">
	<div class="container">
		<div class="row">
			<div class="intro columns small-12 large-4">
				<div class="h2 strong text-white-2">Our Gold Selling Process</div>
				<img src="<?php the_field('add_left_sec_img');?>" alt="Growth Ladder At White Gold" class="img-fluid d-none d-md-block mt-50">		
	</div>
			<div class="step-cards columns small-12 large-8 pl-15 pr-15">
				<div class="step-card-grid row">
					<div class="step-break columns small-12 space-75-left-right">
						<div class="row text-blue-3 space-75-top">
							<div class="label strong text-uppercase columns small-6"></div>
							<div class="p strong columns small-6 text-right"></div>
						</div>
					</div>
					
					
					<?php while( have_rows('top_career_section') ): the_row(); ?>
					<div class="card sgs<?php the_sub_field('add_sl_no');?> columns small-12 fill-white">
						<input id="sgs<?php the_sub_field('add_sl_no');?>" type="radio" name="sell-gold-step" class="visuallyhidden js_card_toggle">
						<label for="sgs<?php the_sub_field('add_sl_no');?>" class="card-head row block">
							<div class="columns small-1"><span class="index h6 medium"><?php the_sub_field('add_sl_no');?></span></div>
							<div class="title h4 strong text-black columns small-10 space-50-left-right"><?php the_sub_field('add_job_title');?></div>
							<div class="toggle columns small-1">
								<div class="arrow"><span class="a1"></span><span class="a2"></span></div>
							</div>
						</label>
						<div class="card-content">
							<div class="row space-50-left-right">
								<div class="columns small-12 medium-12 small-offset-1 space-50-left-right space-20-top-bottom space-100-bottom">
								
									<div class="p space-100-right text-black"><?php the_sub_field('add_job_description');?>
                                    <?php if( get_field('apply_now_link') ): ?>
<a class="btn-custom-primary" href="<?php the_sub_field('apply_now_link'); ?>">Apply Now</a>
<?php endif; ?>	
</div>
								</div>
							</div>
						
						</div>
					</div>
					<?php endwhile; ?>


				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<section class="what-we-buy space-200-top space-200-bottom bg-white">
<div class="container">
  <div class="text-center mb-5 mt-3">
  <h2>What We Buy?</h2>
  </div>

<div class="row"> <!-- row start -->
<div class="col-lg-7"><!-- col start -->
<table class="table">
  <thead>
    <tr>
      <th scope="col" style="border-top-left-radius: 10px;">Gold jewellery</th>
      <th scope="col">Gold coins</th>
      <th scope="col" style="border-top-right-radius: 10px;">Gold bullions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>10K</td>
      <td>Krugerrand gold coin</td>
      <td>BRPL Gold bars</td>
    </tr>
    <tr>
      <td>14K</td>
      <td>Canadian maple leaf gold coin</td>
      <td>PAMP Suisse Gold bars</td>
    </tr>
    <tr>
      <td>18K</td>
      <td>American gold eagle gold coin</td>
      <td>Perth Mint Gold bars</td>
    </tr>
    <tr>
      <td>22K</td>
      <td>American Buffalo gold coin</td>
      <td>MMTC-PAMP Gold bars</td>
    </tr>
    <tr>
      <td style="border-bottom-left-radius: 10px;">24K</td>
      <td>British Britannia gold coin</td>
      <td style="border-bottom-right-radius: 10px;">Emirates Gold bars</td>
    </tr>
  </tbody>
</table>
</div> <!-- col end -->
<div class="col-lg-5"> <!-- col start -->
<img src="/cms/../content/cms/6c074d4ec2-1-1.jpg" class="img-fluid pt-4">

</div> <!-- col end -->
</div><!-- row end -->
</div>
</div>
</section>





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
<?php require_once __ROOT__ . '/pages/section/includes/store-locator.php'; ?>
<script type="text/javascript" src="/js/pages/form-script.js"></script>

<?php
require_once __ROOT__ . '/pages/partials/footer.php'; ?>


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

</script>






<style>
  .what-we-buy th:first-child, td:first-child {padding: 15px;width: 30%;background-color: #b3d4fc00;
}
  .sell-gold-section .step-cards .card > input:checked ~ .card-head .index{color: #1e50cc;}
  .sell-gold-section .step-cards .card .index{background-color:white;color:#1e50cc;box-shadow: inset 0 0 0 calc(var(--space-25)/3) #1e50cc;}
  .what-we-buy h2{ font-size: 32px;font-weight: 700;}
 /* .what-we-buy table th:nth-child(2){background-color: var(--blue-5)!important;} */
 .what-we-buy td:last-child {padding-right: 0;background-color: #b3d4fc1a!important;font-size: 16px;font-weight: 500;padding: 15px;color: black;}
    .what-we-buy table tr td:nth-child(2) {width: 35%;padding: 15px;background-color: #b3d4fc1a!important;box-shadow: none;font-weight: 500;font-size: 16px;color: black;}
.price-section th:first-child, td:first-child {font-size: 16px;padding: 12px;width: 30%;background-color: #b3d4fc1a;font-weight: 600;
}
.what-we-buy table tr td:nth-child(2), table th:nth-child(2) {width: 35%;padding: 15px;background-color: #ffffff00;box-shadow:none;}
.what-we-buy thead{ background-color: var(--blue-5);font-size: 16px;color: white;}
.what-we-buy thead tr th{padding:15px;}
    .sell-gold-section p{color:black;}
.mt--2{margin-top:-4px!important;}
.what-we-do-sec .inner-box-section {height: 375px;}
@media (min-width:1440px)  {.what-we-do-sec .inner-box-section {height: 450px;} .what-we-buy table{ margin-top: 9%;} } 
.why-us h2{font-size: 32px;font-weight: 700;}
.inner-box4 h5{color: white;font-size: 24px;font-weight: 500;}
.inner-box4 p{display: block;color: white;font-size: 16px;}
.inner-box4{padding:25px;border-radius: 12px;}
.inner-box4 h6{font-size:20px;}
.fw-500{font-weight: 500!important;}
.btn-primary-blue {font-size: 16px;padding: 20px 15px 20px 15px;position: relative;background-color: #0032a0;color: white;border-radius: 10px;line-height: 9px;}
@media screen and (min-device-width: 696px) and (max-device-width: 1035px) { .d-med-none{display:none!important;}}
.arrow {right: 5px;top: 5px;}
.arrow-custom {width: 50px;height: 24px;background-position: right 0% bottom 45%;background-size: contain;background-repeat: no-repeat;background-image: url(/cms/../content/cms/Ellipse-294.png);}

.sell-gold-section .step-cards .card .toggle .arrow .a1, .step-cards .card .toggle .arrow .a2{background-color: #1e50cc;
    box-shadow: 0 0 0 1px #1e50cc;}
</style>

