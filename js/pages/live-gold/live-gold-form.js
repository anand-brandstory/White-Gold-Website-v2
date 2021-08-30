
$( function () {





// Set up the namespace
window.__BFS = window.__BFS || { };
window.__BFS.UI = window.__BFS.UI || { };


/*
 * ----- Set up the Live Gold Form
 */
window.__BFS.UI.liveGoldForm = window.__BFS.UI.liveGoldForm || { };
window.__BFS.UI.liveGoldForm.bfsFormInstance = new BFSForm( ".js_live_gold_form" );

var liveGoldForm = window.__BFS.UI.liveGoldForm.bfsFormInstance

	// Phone number
liveGoldForm.addField( "phoneNumber", [ ".js_form_input_phone_country_code", ".js_form_input_phone_number" ], function ( values ) {
	var phoneCountryCode = values[ 0 ]
	var phoneNumberLocal = values[ 1 ]

	return BFSForm.validators.phoneNumber( phoneCountryCode, phoneNumberLocal )
} );



liveGoldForm.submit = async function submit ( data ) {

	var __ = window.__CUPID;

	const sessionDurationLimit = window.__BFS.CONF.goldRates.sessionDurationLimit
	if ( await __.user.sessionHasExpiredOrHasNotBegun( "liveGoldRate", sessionDurationLimit ) )
		await __.user.startSession( "liveGoldRate" )

	return Promise.resolve();

}



/*
 * ----- Form submission event handler
 */
$( document ).on( "submit", ".js_live_gold_form", function ( event ) {
	let liveGoldForm = window.__BFS.UI.liveGoldForm.bfsFormInstance

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
		let domNodeFocusIndex = error.fieldName === "phoneNumber" ? 1 : 0
		liveGoldForm.fields[ error.fieldName ].focus( domNodeFocusIndex )
		liveGoldForm.setSubmitButtonLabel();
		return;
	}

	/*
	 * ----- Submit data
	 */
	liveGoldForm.submit( data )
		.then( window.__BFS.runUserFlow )

} );





} );
