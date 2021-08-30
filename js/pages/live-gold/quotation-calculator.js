
$( function () {

	/*
	 | Save references to certain DOM nodes
	 */
	const $quantity = $( "#js_quotation_form_input_quantity" )
	const $purity = $( "#js_quotation_form_input_purity" )
	const $basicRate = $( ".js_basic_rate" )
	const $serviceCharge = $( ".js_service_charge" )
	const $finalQuotation = $( ".js_final_quotation" )
	/*
	 | Set up some global references
	 */
	let quantity
	let selectedGoldPurity = $purity.val()
	let currentGoldRateData


	// When the gold purity value is updated, trigger a re-calculation of the quote
	$purity.on( "change", function ( event ) {
		selectedGoldPurity = event.target.value
		$( document ).trigger( "gold-rates/input/change" )
	} )

	// When the quantity value is updated, trigger a re-calculation of the quote
	$quantity.on( "input", function ( event ) {
		quantity = event.target.value
		quantity = quantity.trim()
		quantity = parseFloat( quantity )
		$( document ).trigger( "gold-rates/input/change" )
	} )

	// When the any of the values the quote depends on changes (including the gold rate itself), re-calculate the quote
	$( document ).on( "gold-rates/input/change", function () {
		let stubValue = "₹ --,---"

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
