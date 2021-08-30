
$( function () {





// Set up the namespace
window.__BFS = window.__BFS || { };
window.__BFS.UI = window.__BFS.UI || { };


/*
 * ----- Set up the Sell Gold Form
 */
window.__BFS.UI.homeVisitForm = window.__BFS.UI.homeVisitForm || { };
window.__BFS.UI.homeVisitForm.bfsFormInstance = new BFSForm( ".js_home_visit_form" );

var homeVisitForm = window.__BFS.UI.homeVisitForm.bfsFormInstance

	// Pincode
homeVisitForm.addField( "pincode", "#js_home_visit_form_input_pincode", function ( values ) {
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
homeVisitForm.addField( "phoneNumber", [ "#js_home_visit_form_input_phone_country_code", "#js_home_visit_form_input_phone" ], function ( values ) {
	var phoneCountryCode = values[ 0 ]
	var phoneNumberLocal = values[ 1 ]

	return BFSForm.validators.phoneNumber( phoneCountryCode, phoneNumberLocal )
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
 * ----- Form submission event handler
 */
$( document ).on( "submit", ".js_home_visit_form", function ( event ) {
	let homeVisitForm = window.__BFS.UI.homeVisitForm.bfsFormInstance

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
		let domNodeFocusIndex = error.fieldName === "phoneNumber" ? 1 : 0
		homeVisitForm.fields[ error.fieldName ].focus( domNodeFocusIndex )
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
			homeVisitForm.getFormNode().parent().addClass( "show-thankyou" )

		} )

} );





} );
