
$( function () {

	const $quantity = $( "#js_quotation_form_input_quantity" )
	const $purity = $( "#js_quotation_form_input_purity" )
	const $basicRate = $( ".js_basic_rate" )
	const $serviceCharge = $( ".js_service_charge" )
	const $finalQuotation = $( ".js_final_quotation" )


	let quantity
	let selectedGoldPurity = $purity.val()
	let currentGoldRateData



	let unsubscribe = window.__BFS.goldRateTracker.subscribe( function ( data ) {
		currentGoldRateData = data;
		$( document ).trigger( "gold-rates/input/change" )
	} )

	$purity.on( "change", function ( event ) {
		selectedGoldPurity = event.target.value
		$( document ).trigger( "gold-rates/input/change" )
	} )

	$quantity.on( "input", function ( event ) {
		quantity = event.target.value
		quantity = quantity.trim()
		quantity = parseInt( quantity, 10 )
		$( document ).trigger( "gold-rates/input/change" )
	} )

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

} )
