
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
 * ----- Sell Gold Form
 */
loginPrompts.sellGoldForm = new __.LoginPrompt( "Sell Gold Form", $( ".js_sell_gold_form_section" ) );
loginPrompts.sellGoldForm.conversionSlug = "sell-gold-form";
loginPrompts.sellGoldForm.$primaryForm = loginPrompts.sellGoldForm.$site.find( ".js_sell_gold_form" );
// loginPrompts.sellGoldForm.context = loginPrompts.sellGoldForm.$primaryForm.data( "context" ) || "Sell Gold Form";
var sellGold__BFSForm = window.__BFS.UI.sellGoldForm.bfsFormInstance;

/*
 *
 * ----- Set up the OTP form **in** the Sell Gold section
 *
 */
var sellGoldOTP__BFSForm = new BFSForm( "js_otp_form_sell_gold" );
window.__BFS.UI.sellGoldOTPForm = { bfsFormInstance: sellGoldOTP__BFSForm };
	var domInputOTPSellGold = document.getElementById( "js_form_input_otp_sell_gold" );

sellGoldOTP__BFSForm.addField( "otp", domInputOTPSellGold, function ( values ) {
	var otp = values[ 0 ].trim();

	if ( otp === "" )
		throw new Error( "Please provide the OTP." );

	return otp;
} );


loginPrompts.sellGoldForm.triggerFlowOn( "submit", ".js_sell_gold_form" );

loginPrompts.sellGoldForm.on( "requirePhone", function ( event ) {
	this.trigger( "phoneSubmit", event );
} );

// When the phone number is to be submitted
loginPrompts.sellGoldForm.on( "phoneSubmit", function ( event ) {
	var loginPrompt = this;

	/*
	 * ----- Prevent interaction with the form
	 */
	sellGold__BFSForm.disable();

	// Pull data from the form
	var formData;
	try {
		formData = sellGold__BFSForm.getData();
	}
	catch ( e ) {
		// Report the message
		alert( e.message );
		sellGold__BFSForm.enable();
		return;
	}

	// Get the relevant data
	var phoneNumber = formData.phoneNumber;

	// Create a new (but temporary) Person object
	__.tempUser = new __.Person( phoneNumber, loginPrompt.context );

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
loginPrompts.sellGoldForm.on( "requireOTP", function ( event, phoneNumber ) {
	var loginPrompt = this;

	__.tempUser.requestOTP( loginPrompt.context )
		.then( function ( otpSessionId ) {
			__.tempUser.otpSessionId = otpSessionId;
			loginPrompt.$primaryForm.parent().addClass( "show-otp" );
			sellGoldOTP__BFSForm.enable();
		} )
		.catch( function ( e ) {
			alert( e.message );
			sellGold__BFSForm.enable();
		} )
} );


loginPrompts.sellGoldForm.on( "OTPSubmit", function onOTPSubmit ( event ) {

	var loginPrompt = this;

	/*
	 * ----- Prevent interaction with the form
	 */
	sellGoldOTP__BFSForm.disable();


	var formData;
	try {
		formData = sellGoldOTP__BFSForm.getData();
	}
	catch ( e ) {
		// Report the message
		alert( e.message );
		sellGoldOTP__BFSForm.enable();
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

loginPrompts.sellGoldForm.on( "OTPError", function ( e ) {
	alert( e.message );
} );
loginPrompts.sellGoldForm.on( "OTPVerified", onOTPVerified );
// When the user is logged in
loginPrompts.sellGoldForm.on( "login", onLogin );

loginPrompts.sellGoldForm.on( "postLogin", function ( user ) {
	var loginPrompt = this;
	loginPrompt.$primaryForm.trigger( "submit" );
} );












/*
 * ----- Home Visit Form
 */
loginPrompts.homeVisitForm = new __.LoginPrompt( "Home Visit Form", $( ".js_home_visit_form_section" ) );
loginPrompts.homeVisitForm.conversionSlug = "home-visit-form";
loginPrompts.homeVisitForm.$primaryForm = loginPrompts.homeVisitForm.$site.find( ".js_home_visit_form" );
// loginPrompts.homeVisitForm.context = loginPrompts.homeVisitForm.$primaryForm.data( "context" ) || "Home Visit Form";
var homeVisit__BFSForm = window.__BFS.UI.homeVisitForm.bfsFormInstance;

/*
 *
 * ----- Set up the OTP form **in** the Sell Gold section
 *
 */
var homeVisitOTP__BFSForm = new BFSForm( "js_otp_form_home_visit" );
window.__BFS.UI.homeVisitOTPForm = { bfsFormInstance: homeVisitOTP__BFSForm };
	var domInputOTPHomeVisit = document.getElementById( "js_form_input_otp_home_visit" );

homeVisitOTP__BFSForm.addField( "otp", domInputOTPHomeVisit, function ( values ) {
	var otp = values[ 0 ].trim();

	if ( otp === "" )
		throw new Error( "Please provide the OTP." );

	return otp;
} );


loginPrompts.homeVisitForm.triggerFlowOn( "submit", ".js_home_visit_form" );

loginPrompts.homeVisitForm.on( "requirePhone", function ( event ) {
	this.trigger( "phoneSubmit", event );
} );

// When the phone number is to be submitted
loginPrompts.homeVisitForm.on( "phoneSubmit", function ( event ) {
	var loginPrompt = this;

	/*
	 * ----- Prevent interaction with the form
	 */
	homeVisit__BFSForm.disable();

	// Pull data from the form
	var formData;
	try {
		formData = homeVisit__BFSForm.getData();
	}
	catch ( e ) {
		// Report the message
		alert( e.message );
		homeVisit__BFSForm.enable();
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
loginPrompts.homeVisitForm.on( "requireOTP", function ( event, phoneNumber ) {
	var loginPrompt = this;

	__.tempUser.requestOTP( loginPrompt.context )
		.then( function ( otpSessionId ) {
			__.tempUser.otpSessionId = otpSessionId;
			loginPrompt.$primaryForm.parent().addClass( "show-otp" );
			homeVisitOTP__BFSForm.enable();
		} )
		.catch( function ( e ) {
			alert( e.message );
			homeVisit__BFSForm.enable();
		} )
} );


loginPrompts.homeVisitForm.on( "OTPSubmit", function onOTPSubmit ( event ) {

	var loginPrompt = this;

	/*
	 * ----- Prevent interaction with the form
	 */
	homeVisitOTP__BFSForm.disable();


	var formData;
	try {
		formData = homeVisitOTP__BFSForm.getData();
	}
	catch ( e ) {
		// Report the message
		alert( e.message );
		homeVisitOTP__BFSForm.enable();
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

loginPrompts.homeVisitForm.on( "OTPError", function ( e ) {
	alert( e.message );
} );
loginPrompts.homeVisitForm.on( "OTPVerified", onOTPVerified );
// When the user is logged in
loginPrompts.homeVisitForm.on( "login", onLogin );

loginPrompts.homeVisitForm.on( "postLogin", function ( user ) {
	var loginPrompt = this;
	loginPrompt.$primaryForm.trigger( "submit" );
} );





} );
