
$( function () {





// Set up the namespace
window.__BFS = window.__BFS || { };
window.__BFS.UI = window.__BFS.UI || { };


/*
 * ----- Set up the Sell Gold Form
 */
window.__BFS.UI.sellGoldForm = window.__BFS.UI.sellGoldForm || { };
window.__BFS.UI.sellGoldForm.bfsFormInstance = new BFSForm( "js_sell_gold_form" );

var sellGoldForm = window.__BFS.UI.sellGoldForm.bfsFormInstance
	var domInputName = document.getElementById( "js_sell_gold_form_input_name" );
	var domInputQuantity = document.getElementById( "js_sell_gold_form_input_quantity" );
	var domInputPhoneCountryCode = document.getElementById( "js_sell_gold_form_input_phone_country_code" );
	var domInputPhoneNumber = document.getElementById( "js_sell_gold_form_input_phone" );

// Set up the form's input fields, data validators and data assemblers
	// Name
sellGoldForm.addField( "name", domInputName, function ( values ) {
	var name = values[ 0 ].trim();

	if ( name === "" )
		throw new Error( "Please provide your name." );

	if ( name.match( /\d/ ) )
		throw new Error( "Please provide a valid name." );

	return name;
} );

	// Quantity
sellGoldForm.addField( "quantity", domInputQuantity, function ( values ) {
	var quantity = values[ 0 ].trim();

	if ( quantity === "" )
		throw new Error( "Please provide the quantity of gold (in grams)." );

	quantity = parseInt( quantity, 10 );
	if ( window.isNaN( quantity ) )
		throw new Error( "Please provide a valid gold quantity amount." );

	return quantity;
} );

	// Phone number
sellGoldForm.addField( "phoneNumber", [ domInputPhoneCountryCode, domInputPhoneNumber ], function ( values ) {
	var phoneCountryCode = values[ 0 ].trim();
	var phoneNumberLocal = values[ 1 ].trim();
	var phoneNumber = phoneCountryCode + phoneNumberLocal;

	if ( phoneNumberLocal.length <= 1 )
		throw new Error( "Please provide a valid phone number." );

	if ( phoneNumberLocal.length > 1 )
		if ( ! (
			phoneNumber.match( /^\+\d[\d\-]+\d$/ )	// this is not a perfect regex, but it's close
			&& phoneNumberLocal.replace( /\D/g, "" ).length > 3
		) )
			throw new Error( "Please provide a valid phone number." );

	return phoneNumber;
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
			sellGoldForm.domForm.parentNode.className += " show-thankyou";

		} )

} );





} );
