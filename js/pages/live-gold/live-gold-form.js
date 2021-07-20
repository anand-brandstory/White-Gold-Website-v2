
$( function () {





// Set up the namespace
window.__BFS = window.__BFS || { };
window.__BFS.UI = window.__BFS.UI || { };


/*
 * ----- Set up the Sell Gold Form
 */
window.__BFS.UI.liveGoldForm = window.__BFS.UI.liveGoldForm || { };
window.__BFS.UI.liveGoldForm.bfsFormInstance = new BFSForm( "js_live_gold_form" );

var liveGoldForm = window.__BFS.UI.liveGoldForm.bfsFormInstance
	var domInputPhoneCountryCode = document.getElementById( "js_live_gold_form_input_phone_country_code" );
	var domInputPhoneNumber = document.getElementById( "js_live_gold_form_input_phone" );

	// Phone number
liveGoldForm.addField( "phoneNumber", [ domInputPhoneCountryCode, domInputPhoneNumber ], function ( values ) {
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



liveGoldForm.submit = function submit ( data ) {

	var __ = window.__CUPID;

	var extendedAttributes = {
		interestInLiveGoldRate: true
	};

	__.user.appendAdditionalData( extendedAttributes );
	__.user.submitData( extendedAttributes );

	return Promise.resolve();

}



/*
 * ----- Contact Form submission handler
 */
$( document ).on( "submit", ".js_live_gold_form", function ( event ) {

	/*
	 * ----- Prevent default browser behaviour
	 */
	event.preventDefault();

	/*
	 * ----- Prevent interaction with the form
	 */
	liveGoldForm.disable();

	/*
	 * ----- Provide feedback to the user
	 */
	liveGoldForm.giveFeedback( "Sending..." );

	/*
	 * ----- Extract data (and report issues if found)
	 */
	var data;
	try {
		data = liveGoldForm.getData();
	} catch ( error ) {
		alert( error.message )
		console.error( error.message )
		liveGoldForm.enable();
		liveGoldForm.setSubmitButtonLabel();
		return;
	}

	/*
	 * ----- Submit data
	 */
	liveGoldForm.submit( data )
		.then( function ( response ) {
			/*
			 * ----- Provide further feedback to the user
			 */
			liveGoldForm.domForm.parentNode.className += " show-thankyou";

		} )

} );





} );
