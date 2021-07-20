
$( function () {





// Set up the namespace
window.__BFS = window.__BFS || { };
window.__BFS.UI = window.__BFS.UI || { };


/*
 * ----- Set up the Sell Gold Form
 */
window.__BFS.UI.homeVisitForm = window.__BFS.UI.homeVisitForm || { };
window.__BFS.UI.homeVisitForm.bfsFormInstance = new BFSForm( "js_home_visit_form" );

var homeVisitForm = window.__BFS.UI.homeVisitForm.bfsFormInstance
	var domInputPincode = document.getElementById( "js_home_visit_form_input_pincode" );
	var domInputPhoneCountryCode = document.getElementById( "js_home_visit_form_input_phone_country_code" );
	var domInputPhoneNumber = document.getElementById( "js_home_visit_form_input_phone" );

	// Pincode
homeVisitForm.addField( "pincode", domInputPincode, function ( values ) {
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
homeVisitForm.addField( "phoneNumber", [ domInputPhoneCountryCode, domInputPhoneNumber ], function ( values ) {
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



homeVisitForm.submit = function submit ( data ) {

	var __ = window.__CUPID;

	var extendedAttributes = { };
	if ( data.pincode )
		extendedAttributes.pincode = data.pincode;


	// __.user.updateProfile();
	__.user.appendAdditionalData( extendedAttributes );
	__.user.submitData( extendedAttributes );

	return Promise.resolve();

}



/*
 * ----- Contact Form submission handler
 */
$( document ).on( "submit", ".js_home_visit_form", function ( event ) {

	/*
	 * ----- Prevent default browser behaviour
	 */
	event.preventDefault();

	/*
	 * ----- Prevent interaction with the form
	 */
	homeVisitForm.disable();

	/*
	 * ----- Provide feedback to the user
	 */
	homeVisitForm.giveFeedback( "Sending..." );

	/*
	 * ----- Extract data (and report issues if found)
	 */
	var data;
	try {
		data = homeVisitForm.getData();
	} catch ( error ) {
		alert( error.message )
		console.error( error.message )
		homeVisitForm.enable();
		homeVisitForm.setSubmitButtonLabel();
		return;
	}

	/*
	 * ----- Submit data
	 */
	homeVisitForm.submit( data )
		.then( function ( response ) {
			/*
			 * ----- Provide further feedback to the user
			 */
			homeVisitForm.domForm.parentNode.className += " show-thankyou";

		} )

} );





} );
