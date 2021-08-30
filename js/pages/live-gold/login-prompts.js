
$( function () {





/*
 * ------------------------\
 *  Common event handlers
 * ------------------------|
 */
function onOTPVerified () {
	var loginPrompt = this;
	// Trigger the login event
	loginPrompt.trigger( "login" );
}
function trackConversion ( loginPrompt ) {
	// Track the conversion
	var conversionUrl = $( loginPrompt.triggerElement ).data( "c" ) || loginPrompt.conversionSlug;
	__.utils.trackPageVisit( conversionUrl );
}
function onLogin () {
	var loginPrompt = this;
	// Set cookie ( for a month )
	var ONE_YEAR_ISH = 31 * 24 * 60 * 60 * 11.5;
	__.utils.setCookie( __.settings.authCookieName, __.user, ONE_YEAR_ISH );
	// Record the activity
	__.utils.getAnalyticsId()
		.then( function ( deviceId ) {
			__.user.hasDeviceId( deviceId );
			__.user.isOnWebsite();
			// __.user.update();	// the name and email might have been provided somewhere earlier
		} )

	loginPrompt.trigger( "postLogin" );
}



/*
 * ------------------------\
 *  The Login Prompts
 * ------------------------|
 */
var __ = window.__CUPID;
window.__BFS = window.__BFS || { };
var loginPrompts = { };
window.__BFS.loginPrompts = loginPrompts;





/*
 * ----- Live Gold Form
 */
loginPrompts.liveGoldForm = new __.LoginPrompt( "Live Gold Form", $( ".js_live_gold_form_section" ) );
loginPrompts.liveGoldForm.conversionSlug = "live-gold-form";
loginPrompts.liveGoldForm.$primaryForm = loginPrompts.liveGoldForm.$site.find( ".js_live_gold_form" );
loginPrompts.liveGoldForm.getDataThatShouldBeConsistent = function getDataThatShouldBeConsistent () {
	return window.__BFS.UI.liveGoldForm.bfsFormInstance.getData()
}
// loginPrompts.liveGoldForm.context = loginPrompts.liveGoldForm.$primaryForm.data( "context" ) || "Live Gold Form";
var liveGold__BFSForm = window.__BFS.UI.liveGoldForm.bfsFormInstance;

/*
 *
 * ----- Set up the OTP form **in** the Live Gold section
 *
 */
var liveGoldOTP__BFSForm = new BFSForm( ".js_otp_form_live_gold" );
window.__BFS.UI.liveGoldOTPForm = { bfsFormInstance: liveGoldOTP__BFSForm };

liveGoldOTP__BFSForm.addField( "otp", "#js_form_input_otp_live_gold", function ( values ) {
	var otp = values[ 0 ].trim();

	if ( otp === "" )
		throw new Error( "Please provide the OTP." );

	return otp;
} );


loginPrompts.liveGoldForm.triggerFlowOn( "submit", ".js_live_gold_form" );

loginPrompts.liveGoldForm.on( "requirePhone", function ( event ) {
	this.trigger( "phoneSubmit", event );
} );

// When the phone number is to be submitted
loginPrompts.liveGoldForm.on( "phoneSubmit", function ( event ) {
	let loginPrompt = this;
	let liveGold__BFSForm = window.__BFS.UI.liveGoldForm.bfsFormInstance;

	/*
	 * ----- Prevent interaction with the form
	 */
	liveGold__BFSForm.disable();

	// Pull data from the form
	let formData;
	try {
		formData = liveGold__BFSForm.getData();
	}
	catch ( error ) {
		// Report the message
		alert( error.message );
		liveGold__BFSForm.enable();
		liveGold__BFSForm.setSubmitButtonLabel();
		let domNodeFocusIndex = error.fieldName === "phoneNumber" ? 1 : 0
		liveGold__BFSForm.fields[ error.fieldName ].focus( domNodeFocusIndex )
		return;
	}

	// Get the relevant data
	var phoneNumber = formData.phoneNumber;

	// Create a new (but temporary) Person object
	__.tempUser = new __.Person( phoneNumber, loginPrompt.context );
	if ( formData.name )
		__.tempUser.name = formData.name;
	if ( formData.emailAddress )
		__.tempUser.emailAddress = formData.emailAddress;

		// Set the device id
	__.utils.getAnalyticsId()
		.then( function ( deviceId ) {
			__.tempUser.hasDeviceId( deviceId );
		} )
		// Attempt to find the person in the database
		.then( function () {
			__.tempUser.getFromDB()
				// If the person exists, log in
				.then( function ( person ) {
					if ( person.verification && person.verification.isVerified ) {
						__.user = person;
						Object.assign( __.user, person );
						if ( formData.name )
							__.user.name = formData.name;
						if ( formData.emailAddress )
							__.user.emailAddress = formData.emailAddress;
						loginPrompt.trigger( "login", __.user );
					}
					else
						throw person;
				} )
				// If the person don't exist, add the person, and send an OTP
				.catch( function ( person ) {
					if ( person instanceof Error || ! person )
						trackConversion( loginPrompt );
					return __.tempUser.add()
						.then( function () {
							if ( window.__CUPID.policies.requireOTP )
								loginPrompt.trigger( "requireOTP" );
							else {
								__.user = __.tempUser;
								loginPrompt.trigger( "login" );
							}
						} )
						.catch( function () {
							loginPrompt.trigger( "phoneError" );
						} );
				} )
		} );

} );

// When the OTP is required
loginPrompts.liveGoldForm.on( "requireOTP", function ( event, phoneNumber ) {
	var loginPrompt = this;

	__.tempUser.requestOTP( loginPrompt.context )
		.then( function ( otpSessionId ) {
			__.tempUser.otpSessionId = otpSessionId;
			loginPrompt.$primaryForm.parent().addClass( "show-otp" );
			var liveGoldOTP__BFSForm = window.__BFS.UI.liveGoldOTPForm.bfsFormInstance
			liveGoldOTP__BFSForm.enable();
		} )
		.catch( function ( e ) {
			alert( e.message );
			if ( e.codeWord === "PHONE_INVALID" ) {
				var bfsForm = window.__BFS.UI.liveGoldForm.bfsFormInstance
				bfsForm.enable();
				bfsForm.fields[ "phoneNumber" ].focus( 1 )
			}
		} )
} );


loginPrompts.liveGoldForm.on( "OTPSubmit", function onOTPSubmit ( event ) {
	var loginPrompt = this;
	var liveGoldOTP__BFSForm = window.__BFS.UI.liveGoldOTPForm.bfsFormInstance

	/*
	 * ----- Prevent interaction with the form
	 */
	liveGoldOTP__BFSForm.disable();


	var formData;
	try {
		formData = liveGoldOTP__BFSForm.getData();
	}
	catch ( error ) {
		// Report the message
		alert( error.message );
		liveGoldOTP__BFSForm.enable();
		liveGoldOTP__BFSForm.fields[ error.fieldName ].focus()
		return;
	}

	__.tempUser.verifyOTP( formData.otp )
		.then( function () {
			__.user = __.tempUser;
			loginPrompt.trigger( "OTPVerified" );
		} )
		.catch( function ( e ) {
			loginPrompt.trigger( "OTPError", e );
		} );

} );

loginPrompts.liveGoldForm.on( "OTPError", function ( e ) {
	alert( e.message );
	var liveGoldOTP__BFSForm = window.__BFS.UI.liveGoldOTPForm.bfsFormInstance
	liveGoldOTP__BFSForm.enable()
	liveGoldOTP__BFSForm.fields[ "otp" ].focus()
} );
loginPrompts.liveGoldForm.on( "OTPVerified", onOTPVerified );
// When the user is logged in
loginPrompts.liveGoldForm.on( "login", onLogin );

loginPrompts.liveGoldForm.on( "postLogin", function ( user ) {
	var loginPrompt = this;
	loginPrompt.$primaryForm.trigger( "submit" );
} );





} );
