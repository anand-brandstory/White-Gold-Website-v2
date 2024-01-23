
$( function () {

	/*
	 | Save references to certain DOM nodes
	 */
	const $quantity = $( "#cus2_js_quotation_form_input_quantity" )
	const $quantity_two = $( "#num" )
	const $purity = $( "input[name='cus2_js_quotation_form_input_purity']:checked" )
	
	
	
	const $basicRate = $( ".cus_js_basic_rate" )
	const $serviceCharge = $( ".cus_js_service_charge" )
	const $finalQuotation = $( ".cus_js_final_quotation" )
	/*
	 | Set up some global references
	 */
	let quantity
	let selectedGoldPurity = $purity.val()
	let currentGoldRateData





	
	
	


	// When the gold purity value is updated, trigger a re-calculation of the quote=
	
	$purity.on( "change", function ( event ) {
	//	console.log("purity calling...");
		selectedGoldPurity = event.target.value
		$( document ).trigger( "gold-rates/input/change" )
	} )
	
	const $purity2 = $( "input[name='cus2_js_quotation_form_input_purity']" )
		$purity2.on( "change", function ( event ) {
		//console.log("purity calling...");
		selectedGoldPurity = event.target.value
		$( document ).trigger( "gold-rates/input/change" )
	} )
	

	// When the quantity value is updated, trigger a re-calculation of the quote
	$quantity.on( "input", function ( event ) {
		console.log("quantity calling..."); 
		quantity = event.target.value;
		quantity = quantity.trim();
		//	console.log("quantity calling..."+quantity); 
		
		quantity = parseFloat( quantity );
		$( document ).trigger( "gold-rates/input/change" )
	} )


	$quantity_two.on( "input", function ( event ) {
		console.log("quantity calling..."); 
		quantity = event.target.value;
		quantity = quantity.trim();
	//		console.log("quantity calling..."+quantity); 
		$("#cus2_js_quotation_form_input_quantity").val(quantity);
			 
			 
		quantity = parseFloat( quantity );
		$( document ).trigger( "gold-rates/input/change" )
	} )


const $selecteregion = $( "input[name='cus_region']" )
	
	$selecteregion.on( "change", function ( event ) {
	//	console.log("region calling...");
		
		
		const selectedRegion = event.target.value
	
		
	//	window.__BFS = window.__BFS || { }
	//	window.__BFS.CONF = window.__BFS.CONF || { }
		//window.__BFS.CONF.region = selectedRegion;
	console.log("Selected Region : "+selectedRegion);
	  
	  
	  
	// Change the region of the global gold rate tracker
	window.__BFS.goldRateTracker.region = selectedRegion

	// Assign stub values for all the figures (basic rate, etc.)
//	"₹ --,---"
		let stubValue = "₹ --,---"
		$basicRate.text( stubValue )
		$serviceCharge.text( "" + stubValue )
		$finalQuotation.text( stubValue )
		

	// Add a loading indicator
	// saying something like "fetching data..." (This is up to you)
		
	} )	
	
	// When the any of the values the quote depends on changes (including the gold rate itself), re-calculate the quote
	$( document ).on( "gold-rates/input/change", function () {
		 
		console.log("calling gold-rates/input/change");
	
	console.log(" ----quantity---- "+selectedGoldPurity);
		console.log(" ----quantity---- "+quantity);
		let stubValue = "₹ --,---"


//console.log("--- selectedGoldPurity ---"+selectedGoldPurity);
//console.log("--- selectedGoldPurity 1 ---"+currentGoldRateData[ selectedGoldPurity ]);
//console.log("--- selectedGoldPurity 2 ---"+currentGoldRateData[ selectedGoldPurity ].toFixed( 2 ));

		let goldRatePerGram = parseFloat( currentGoldRateData[ selectedGoldPurity ].toFixed( 2 ) )

		let basicRate = quantity * goldRatePerGram
		let serviceCharge = parseFloat( ( ( 3 / 100 ) * basicRate ).toFixed( 2 ) )
		let finalQuotation = basicRate - serviceCharge

		if ( typeof basicRate !== "number" || Number.isNaN( basicRate ) )
			basicRate = stubValue
		else
			basicRate = GoldRates.formatAsRupee( basicRate )
		if ( typeof serviceCharge !== "number" || Number.isNaN( serviceCharge ) )
			serviceCharge = stubValue
		else
			serviceCharge = GoldRates.formatAsRupee( serviceCharge )
		if ( typeof finalQuotation !== "number" || Number.isNaN( finalQuotation ) )
			finalQuotation = stubValue
		else
			finalQuotation = GoldRates.formatAsRupee( finalQuotation )


		$basicRate.text( basicRate )
		$serviceCharge.text( "- " + serviceCharge )
		$finalQuotation.text( finalQuotation )
	} )




	/*
	 | Finally, subscribe to the gold rate feed
	 */
	let unsubscribe
	function bindQuotationCalculatorToGoldRateFeed () {
		unsubscribe = window.__BFS.goldRateTracker.subscribe( function ( data ) {
			currentGoldRateData = data;
			$( document ).trigger( "gold-rates/input/change" )
		} )
	}
	function unbindQuotationCalculatorFromGoldRateFeed () {
		unsubscribe()
	}



	/*
	 |
	 | Exports
	 |
	 */
	window.__BFS.bindQuotationCalculatorToGoldRateFeed = bindQuotationCalculatorToGoldRateFeed
	window.__BFS.unbindQuotationCalculatorFromGoldRateFeed = unbindQuotationCalculatorFromGoldRateFeed

} )
