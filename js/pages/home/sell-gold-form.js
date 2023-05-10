
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
	person.setSourcePoint( "Sell Gold Form" )

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
	window.location.href = "https://whitegold.money/thank-you/";
}





} );
