
$( function () {





// Set up the namespace
window.__BFS = window.__BFS || { };
window.__BFS.UI = window.__BFS.UI || { };


/*
 * ----- Set up the Sell Gold Form
 */
window.__BFS.UI.sellGoldForm = window.__BFS.UI.sellGoldForm || { };
window.__BFS.UI.sellGoldForm.bfsFormInstance = new BFSForm( ".js_sell_gold_form" );

var sellGoldForm = window.__BFS.UI.sellGoldForm.bfsFormInstance

// Set up the form's input fields, data validators and data assemblers
	// Name
sellGoldForm.addField( "name", "#js_sell_gold_form_input_name", function ( values ) {
	var name = values[ 0 ].trim();

	if ( name === "" )
		throw new Error( "Please provide your name." );

	if ( name.match( /\d/ ) )
		throw new Error( "Please provide a valid name." );

	return name;
} );

	// Quantity
sellGoldForm.addField( "quantity", "#js_sell_gold_form_input_quantity", function ( values ) {
	var quantity = values[ 0 ].trim();

	if ( quantity === "" )
		throw new Error( "Please provide the quantity of gold (in grams)." );

	quantity = parseInt( quantity, 10 );
	if ( window.isNaN( quantity ) )
		throw new Error( "Please provide a valid gold quantity amount." );

	return quantity;
} );

	// Phone number
sellGoldForm.addField( "phoneNumber", [ "#js_sell_gold_form_input_phone_country_code", "#js_sell_gold_form_input_phone" ], function ( values ) {
	var phoneCountryCode = values[ 0 ]
	var phoneNumberLocal = values[ 1 ]

	return BFSForm.validators.phoneNumber( phoneCountryCode, phoneNumberLocal )
} );



sellGoldForm.submit = function submit ( data ) {

	var __ = window.__CUPID;

	var extendedAttributes = { };
	if ( data.quantity )
		extendedAttributes.goldQuantityToSellInGrams = data.quantity;

	__.user.name = data.name;
	__.user.updateProfile();

	__.user.appendAdditionalData( extendedAttributes );
	__.user.submitData( extendedAttributes );

	return Promise.resolve();

}



/*
 * ----- Contact Form submission handler
 */
$( document ).on( "submit", ".js_sell_gold_form", function ( event ) {

	/*
	 * ----- Prevent default browser behaviour
	 */
	event.preventDefault();

	/*
	 * ----- Prevent interaction with the form
	 */
	sellGoldForm.disable();

	/*
	 * ----- Provide feedback to the user
	 */
	sellGoldForm.giveFeedback( "Sending..." );

	/*
	 * ----- Extract data (and report issues if found)
	 */
	var data;
	try {
		data = sellGoldForm.getData();
	} catch ( error ) {
		alert( error.message )
		console.error( error.message )
		sellGoldForm.enable();
		sellGoldForm.setSubmitButtonLabel();
		let domNodeFocusIndex = error.fieldName === "phoneNumber" ? 1 : 0
		sellGoldForm.fields[ error.fieldName ].focus( domNodeFocusIndex )
		return;
	}

	/*
	 * ----- Submit data
	 */
	sellGoldForm.submit( data )
		.then( function ( response ) {
			/*
			 * ----- Provide further feedback to the user
			 */
			sellGoldForm.getFormNode().parent().addClass( "show-thankyou" )

		} )

} );





} );
