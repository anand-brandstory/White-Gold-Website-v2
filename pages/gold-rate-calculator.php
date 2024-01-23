<?php
/**
 * The template for displaying for gold-rate-calculator
 *
 * 
 *
 *
 */

\BFS\CMS\WordPress::setupContext();

// If a post revision or preview is being viewed, and the user is not authorized to view it, simply return to the home page
// NOTE: The revision / preview URLs of **unpublished** posts have no URL slugs, only query parameters, i.e. they essential resemble that of the home page URL
if ( \BFS\Router::$urlSlug == '' )
	return require_once __ROOT__ . '/pages/gold-rate-calculator.php';

require_once __ROOT__ . '/pages/partials/header-custom.php';

?>
<?php require_once __ROOT__ . '/pages/section/header.php'; ?>
<div class="why-whitegold">
<?php require_once __ROOT__ . '/pages/section/includes/slider-lp.php'; ?>
<?php require_once __ROOT__ . '/pages/section/includes/menu-below-slider.php'; ?>
<?php require_once __ROOT__ . '/pages/section/includes/calculator-form.php'; ?>


	<section class="custom live-gold-section fill-neutral-1 w-100">
	<div class="live-gold space-100-top">
		<div class="container">
			<div class="row">
				
				<div class="live-gold-data columns small-12 medium-12 large-12 space-100-bottom ">
<div class="title h2 strong space-50-top" style="text-align: center;">White Gold Live Gold Rate</div>

<div class="data inline-old row mt-sm-5c">
<div class="columns small-12 large-4 mt-lg-5">

<div class="bg-box-time text-sm-center"><div class="mr-lg">	<div class="timestamp label blue-filled "><span class="date inline js_current_date strong f24 f14"></span><br><span class="time inline js_current_time f20 f12"></span></div>
	</div></div>	</div>




	<div class="24k space-50-top columns small-6 large-4 mb-3 mt-lg-4">
	<div class="bg-box">
        <div class="mr-lg">	
    <div class="d-flex">
            <img src="https://whitegold.money/cms/../content/cms/gold-2.svg" class="img-fluid">
    <div class="h6 text-black p-rel">24 Karat Gold</div></div>
		<div class="live-rate">
			<span class="f18 rate h2 medium text-yellow-2 inline js_24_karat_per_gram"><!-- ₹ 5,011.4 --></span>
			<span class="trend inline space-25-left-right">
				<span class="trend-icon"></span>
			</span>
			<span class="unit h6 inline f11"> per gram</span>
		</div></div></div>
	</div>


<!--	<hr class="fill-light"> -->
	<div class="22k space-50-top columns small-6 large-4 mb-3 mt-lg-4">
    <div class="bg-box">	
    <div class="mr-lg">	
    <div class="d-flex">
            <img src="https://whitegold.money/cms/../content/cms/gold-2.svg" class="img-fluid">
		<div class="h6 text-black p-rel">22 Karat Gold</div></div>
		<div class="live-rate">
			<span class="f18 rate h2 medium text-yellow-2 inline js_22_karat_per_gram"><!-- ₹ 4,900.3 --></span>
			<span class="trend inline space-25-left-right">
				<span class="trend-icon"></span>
			</span>
			<span class="unit h6 inline f11"> per gram</span>
		</div></div></div>
	</div>
</div>
</div>
<style>


</style>
				
				<div class="columns small-12 medium-8 large-2 d-none d-md-block" style="">	</div>
				<div class="live-gold-graph columns small-12 medium-8 large-8 space-200-bottom" style="" >
					<div class="chart-container" style="position: relative; width: 100%;" >
						<canvas id="js_chart_canvas"    style=" height: 350px!important; " ></canvas>
					</div> 
                   
				</div>

                <div class="columns small-12 medium-8 large-2 d-none d-md-block" style="">	</div>
             
		
			</div>
		</div>
		</div>
		</section>



<section class="calculator fill-blue-5 space-200-top space-200-bottom" id="calculator">

<div class="container">
	<div class="text-center">
<h2>Gold Rate Calculator</h2>
<p class="mt-2">With White Gold calculator, you can put the guesswork out of the equation. We provide you with a reliable estimate of the worth of gold based on the weight, purity and current market price. Get accurate value for your gold in minutes.</p>
</div>
<div class="row"><!-- row starts -->
<div class="columns small-12 large-4 p-releative-90"><!-- col starts -->
<img src="/cms/../content/cms/5K8A6755-1024x798-2-4.png" class="img-fluid d-none d-md-block">

</div><!-- col-ends -->

<div class="columns small-12 large-8 mt-5 mt-md-0"><!-- col starts -->
<div class="row mt-5"><!-- inner-row-starts -->
<div class="custom-box"> 	<!-- white box css starts -->
<div class="columns small-12 large-6 mt-4 mt-md-0"><!-- inner col-starts --> 
<label class="f-18 d-block medium cus_state">State</label>

<div class="form-check form-check-inline mt-4 mb-4">
  <input class="form-check-input" type="radio" name="cus_region" id="inlineRadio3" checked value="ka">
  <label class="form-check-label" for="inlineRadio3">Karnataka</label>
</div>

<div class="form-check form-check-inline mt-4 mb-4">
  <input class="form-check-input" type="radio" name="cus_region" id="inlineRadio1" value="tn">
  <label class="form-check-label" checked for="inlineRadio1">Tamil Nadu</label>
</div>
<div class="form-check form-check-inline mt-4 mb-4">
  <input class="form-check-input" type="radio" name="cus_region" id="inlineRadio2" value="kl">
  <label class="form-check-label" for="inlineRadio2">Kerala</label>
</div>


<div class="d-flex justify-content-between">
<label class="f-18 d-block medium ">Quantity (in grams)</label>



<input type="number" id="num" class="" maxlength="4" value="0" style="width: 30%;" > </div>	


<input  type="range" id="cus2_js_quotation_form_input_quantity" value="0" max="1000" oninput="num.value = this.value" style="accent-color: #0032A0">
<div class="d-flex justify-content-between mb-4">
<label class="f-18 d-block">1</label>
<label class="f-18 d-block">Max</label>
</div>
<label class="f-18 d-block mb-3 medium">Purity</label>
<div class="form-check form-check-inline cus_purity">
  <input class="form-check-input"  type="radio" name="cus2_js_quotation_form_input_purity"  checked id="inlineRadio4" value="cost__24KaratGold__perGram">
  <label class="form-check-label"  for="inlineRadio4">24 Karat</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input"  type="radio" name="cus2_js_quotation_form_input_purity" id="inlineRadio5" value="cost__22KaratGold__perGram"  >
  <label class="form-check-label"  for="inlineRadio5">22 Karat</label>
</div>


</div><!-- inner col-ends -->

<div class="columns small-12 large-6 mt-5 mt-md-0"><!-- inner col-starts -->
<div class="fill-blue-4 custom-box3 mt-0 mt-md-5">

<div class="d-flex justify-content-between mb-4">
<label class="d-block f-16-lg f-12-sm">Base Price</label>
<label class="d-block f-20-lg cus_js_basic_rate">₹ 37,000.15</label>
</div>

<div class="d-flex justify-content-between mb-4">
<label class="d-block">3% service charge </label>
<label class="d-block f-20-lg cus_js_service_charge">-₹ 1,110.00</label>
</div>
<label class="f-20-lg f-12-sm medium mb-2">Final Quotation</label>
<div class="final-price medium cus_js_final_quotation">₹ 35,890.15</div>
</div>
	

</div><!-- inner col-ends -->
</div><!-- inner-row-ends -->
</div>	<!-- white box css ends -->
</div><!-- col-ends -->



</div><!-- row ends -->

</div>

</section>


<!-- START: CMS box Section -->
<?php if(have_rows('add_section')):?>
  <?php while( have_rows('add_section') ): the_row(); ?>
<?php the_sub_field('add_contents');?>
<?php endwhile; ?>
<?php endif; ?>
<!-- END: CMS box Section -->
<!-- START: Service box Section -->
<?php require_once __ROOT__ . '/pages/section/includes/service-box.php'; ?>
<!-- END: Service box  Section -->
<!-- START: faq Section -->
<?php require_once __ROOT__ . '/pages/section/includes/faq-section.php'; ?>
<!-- END: faq Section -->

<?php
require_once __ROOT__ . '/pages/partials/footer.php'; ?>




<!-- cus start -->

<script type="text/javascript">

	window.__BFS = window.__BFS || { }
	window.__BFS.CONF = window.__BFS.CONF || { }
	window.__BFS.CONF.region = "<?php echo "ka" ?>";

</script>
<script type="text/javascript" src="/js/modules/cupid-extensions.js"></script>
<script type="text/javascript" src="/plugins/buffer/buffer-v5.6.0-custom.min.js"></script>
<script type="text/javascript" src="/plugins/chartjs/chart.v3.4.1.min.js"></script>
<script type="text/javascript" src="/js/modules/clock.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/gold-rates.js?v1=<?php echo  rand(10,99); ?>"></script>
<script type="text/javascript" src="/js/pages/live-gold/custom-gold-feed.js?v=<?php echo  rand(10,99); ?>"></script>


<script type="text/javascript" src="/js/pages/live-gold/cus-quotation-calculator.js?v=<?php echo  rand(10,99); ?>"></script>
<script type="text/javascript" src="/js/pages/live-gold/live-gold-form.js<?= $ver ?>"></script>
<!-- <script type="text/javascript" src="/js/pages/live-gold/login-prompts.js<?= $ver ?>"></script> -->

<script>
$( function () {
	
	
	
window.__BFS.setupLiveGoldRateFeed()
window.__BFS.bindQuotationCalculatorToGoldRateFeed()
window.__BFS.clock.run()

window.__BFS.initChart()


} )



</script>




<!-- cus end -->





<style>
@media (min-width: 1025px){
.why-whitegold .landing-carousel-section h1 {
    padding-top: 3%;
padding-right:3%;
}
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

.cms-content2 h2 {
    color: black;
    font-weight: 700;
    font-size: 32px;
}
.cms-content2 ol{margin-top:20px;}
.p-releative-30{top: 30px;
    position: relative;}
.cms-content2 li{list-style: auto;}
@media (max-width: 580px){
.service-box .container {max-width: 360px;}
}
.calculator h2{color: #ffff;font-weight: 700;font-size: 32px;}
.calculator p{color: #ffff;}
.calculator .custom-box{background-color:#ffff;border-radius: 8px;padding:15px;}
.calculator label{color:black;}
.f-18{font-size:18px;}
.calculator output {display: inline-block;color:#000000;margin-bottom: 11px;padding: 6px 15px 4px 15px;border: 1px solid #E9E9E7;}
input[type="range"]{width:100%;}
.form-check-input:checked[type=radio]{background-color: #0032A0;}
.form-check-input:checked{border-color: #0032A0;}
@media (max-width: 1035px){
	.p-releative-90{ position: relative;top: 30px;}
	.final-price{font-size:24px;color:#ffff;}
	.f-12-sm{font-size:12px;}
.calculator .custom-box3{padding:15px;border-radius: 8px;margin: 0px;}}
@media (min-width: 1036px){
	.text-center-lg{text-align:center;}
	.pt-15cm{padding-top:5%;}
	.final-price{font-size:36px;color:#ffff;}
	.calculator .custom-box3{padding:20px;border-radius: 8px;margin: 15px;}	
	.f-16-lg{font-size:16px;}
	.f-20-lg{font-size:20px;}
	.p-releative-90{position: relative;top:70px;}
}
@media (min-width: 1440px){.p-releative-90{position: relative;top: 80px;}.pt-15cm{padding-top:15%;}}
.calculator .custom-box3 label{color:#ffff;}
@media (min-width: 767px){
.bg-box{background-color:white;padding:15px;border-radius:8px;height: 130px;}
.bg-box-time{background-color:white;padding:15px;border-radius:8px;height: 130px;}
.custom .live-gold-section .h2{font-size:28px;}
.f20{font-size:20px;}
.f24{font-size:24px;}
.p-rel{position: relative;left: 10px;top: 2px;}
.mr-lg{margin-top:17px;}
}
@media (max-width: 767px){
    .w-sm-250 {width: 250px;}
    .mt-sm-5c{margin-top: 3rem!important;}
    .custom .inline-old{background-color:white;padding: 10px;margin: 5px;}
    .bg-box{padding: 10px;background-color: #f1f1f1;border-radius: 7px;}
    .custom .live-gold-section .live-rate .h2{font-size: 18px;}  
    .custom .bg-box{font-size: 12px;}
    .p-rel{position: relative;left: 10px;top: 2px;font-size:12px;}
    .f18{font-size:18px;}
    .f11{font-size:11px;}
    .f12{font-size:12px;}
    .f14{font-size:14px;}
    .text-sm-center{text-align:center;}
    .p-rel{position: relative;left: 10px;top: 6px;}

}


.blue-filled{color:#0032A0;}
@media (min-width: 767px){
 .pr-p30{padding-right: 40%;}
}
.custom {
    padding-left: 0px!important;
}
style attribute {
    --fade-right: linear-gradient( to right, rgba(0, 71, 167, 0) 0%, rgba(0, 71, 167, 1) 50%)!important;
    --fade-left: linear-gradient( to left, rgba(0, 50, 160, 0) 0%, rgba(0, 50, 160, 1) 50%);
   
}
</style>
<script>
$('#num').keyup(function(){
  if ($(this).val() > 1000){
	 var xy= $(this).val();
    alert("No numbers above 1000");
	const newNum = Number(xy.toString().slice(0, -1));
    $(this).val(newNum);
	$("#cus2_js_quotation_form_input_quantity").val(newNum);
	
  }
});
</script>
