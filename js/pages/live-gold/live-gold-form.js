
/**
 |
 | Live Gold Form
 |
 |
 */
$( function () {

// Imports
let BFSForm = window.__BFS.exports.BFSForm

// Set up the namespace
window.__BFS = window.__BFS || { };
window.__BFS.UI = window.__BFS.UI || { };





let liveGoldForm = new BFSForm( ".js_live_gold_form" );

// Set up the form's input fields, data validators and data assemblers
	// Phone number
liveGoldForm.addField( "phoneNumber", [ ".js_form_input_phone_country_code", ".js_form_input_phone_number" ], function ( values ) {
	let [ phoneCountryCode, phoneNumberLocal ] = values
	return BFSForm.validators.phoneNumber( phoneCountryCode, phoneNumberLocal )
} );



liveGoldForm.submit = async function submit ( data ) {
	let person = Cupid.getCurrentPerson( data.phoneNumber )
	person.setSourcePoint( "Live Gold Form" )

	Cupid.logPersonIn( person, { _trackSlug: "live-gold-form" } )

	let interest = "Live Gold Rate"
	if ( ! person.hasInterest( interest ) ) {
		person.setInterests( interest )
		Cupid.savePerson( person )
		PersonLogger.registerInterest( person )
	}

	// Start a fresh session
	const sessionDurationLimit = window.__BFS.CONF.goldRates.sessionDurationLimit
	if ( person.sessionHasExpiredOrNotEvenBegun( "liveGoldRate", sessionDurationLimit ) )
		person.startSession( "liveGoldRate" )

	return Promise.resolve()
}



/**
 | Form submission handler
 |
 */
$( document ).on( "submit", ".js_live_gold_form", function ( event ) {

	/*
	 | Prevent default browser behaviour
	 */
	event.preventDefault();

	/*
	 | Prevent interaction with the form
	 */
	liveGoldForm.disable();

	/*
	 | Provide feedback to the user
	 */
	liveGoldForm.giveFeedback( "Sending..." );

	/*
	 | Extract data (and report issues if found)
	 */
	var data;
	try {
		data = liveGoldForm.getData();
	} catch ( error ) {
		alert( error.message )
		console.error( error.message )
		liveGoldForm.enable();
		liveGoldForm.fields[ error.fieldName ].focus()
		liveGoldForm.setSubmitButtonLabel();
		return;
	}

	/*
	 | Submit data
	 */
	liveGoldForm.submit( data )
		.then( window.__BFS.runUserFlow )

} );





} );
