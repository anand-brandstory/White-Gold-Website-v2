
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
