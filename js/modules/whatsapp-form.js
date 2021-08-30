
$( function () {





/*
 * ------------------------\
 *  Common event handlers
 * ------------------------|
 */
function trackConversion ( loginPrompt ) {
	// Track the conversion
	var conversionUrl = $( loginPrompt.triggerElement ).data( "c" ) || loginPrompt.conversionSlug;
	window.__CUPID.utils.trackPageVisit( conversionUrl );
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
 * ----- WhatsApp Form
 */
loginPrompts.whatsAppForm = new __.LoginPrompt( "WhatsApp Form", $( ".js_whatsapp_form_section" ) );
loginPrompts.whatsAppForm.conversionSlug = "whatsapp-form";
// loginPrompts.whatsAppForm.$primaryForm = loginPrompts.whatsAppForm.$site.find( ".js_whatsapp_form" );
// loginPrompts.whatsAppForm.context = loginPrompts.whatsAppForm.$primaryForm.data( "context" ) || "Sell Gold Form";
// var whatsapp__BFSForm = window.__BFS.UI.whatsAppForm.bfsFormInstance;


loginPrompts.whatsAppForm.triggerFlowOn( "submit", ".js_whatsapp_form" );

loginPrompts.whatsAppForm.on( "requirePhone", function ( event ) {
	this.trigger( "phoneSubmit", event );
} );

// When the phone number is to be submitted
loginPrompts.whatsAppForm.on( "phoneSubmit", async function ( event ) {
	var loginPrompt = this;
	var $form = $( event.target ).closest( "form" )
	var bfsForm = whatsapp__BFSForm.bind( $form )

	/*
	 * ----- Prevent interaction with the form
	 */
	bfsForm.disable()

	// Pull data from the form
	var formData;
	try {
		formData = bfsForm.getData();
	}
	catch ( error ) {
		// Report the message
		alert( error.message )
		console.error( error.message )
		bfsForm.enable();
		let domNodeFocusIndex = error.fieldName === "phoneNumber" ? 1 : 0
		bfsForm.fields[ error.fieldName ].focus( domNodeFocusIndex )
		return;
	}

	// Get the relevant data
	var phoneNumber = formData.phoneNumber;

	// Create a new (but temporary) Person object
	__.tempUser = new __.Person( phoneNumber, loginPrompt.context );

	// Fetch and set the device id
	let deviceId = await __.utils.getAnalyticsId()
	__.tempUser.hasDeviceId( deviceId );
	try {
		let person = await __.tempUser.getFromDB()
		if ( person.verification && person.verification.isVerified ) {
			__.user = person;
			if ( formData.name )
				__.user.name = formData.name;
			if ( formData.emailAddress )
				__.user.emailAddress = formData.emailAddress;

			whatsAppFormSubmitEventHandler( null, bfsForm.$formNode )
		}
		else
			throw person;
	}
	catch ( e ) {
		if ( e instanceof Error || !e )
			trackConversion( loginPrompt );

		try {
			await __.tempUser.add()
			whatsAppFormSubmitEventHandler( null, bfsForm.$formNode )
		}
		catch ( e ) {
			loginPrompt.trigger( "phoneError" );
		}
	}

} );






// Set up the namespace
window.__BFS = window.__BFS || { };
window.__BFS.UI = window.__BFS.UI || { };


/*
 * ----- Set up the WhatsApp Form
 */
window.__BFS.UI.whatsappForm = window.__BFS.UI.whatsappForm || { };
window.__BFS.UI.whatsappForm.bfsFormInstance = new BFSForm( ".js_whatsapp_form" );

var whatsapp__BFSForm = window.__BFS.UI.whatsappForm.bfsFormInstance

	// Message
whatsapp__BFSForm.addField( "message", ".js_form_input_message", function ( values ) {
	var message = values[ 0 ].trim()
	if ( message.length === 0 )
		throw new Error( "Please provide a message." )
	return message
} )

	// Phone number
whatsapp__BFSForm.addField( "phoneNumber", [ ".js_phone_country_code_label", ".js_form_input_phone_number" ], function ( values ) {
	var phoneCountryCode = values[ 0 ]
	var phoneNumberLocal = values[ 1 ]

	return BFSForm.validators.phoneNumber( phoneCountryCode, phoneNumberLocal )
} )


whatsapp__BFSForm.submit = function submit ( data ) {

	var urlSearchParams = new URLSearchParams()
	urlSearchParams.append( "text", data.message )
	let phoneNumber = this.getFormNode().data( "number" ).replace( /\s+/g, "" )

	var url = `https://wa.me/${ phoneNumber }?${ urlSearchParams.toString() }`
	window.open( url, "_blank" )

	return Promise.resolve();

}


/*
 * ----- WhatsApp Form submission handler
 */
function whatsAppFormSubmitEventHandler ( event, $form ) {

	$form = $form || $( event.target ).closest( "form" )
	var bfsForm = whatsapp__BFSForm.bind( $form )

	/*
	 * ----- Prevent default browser behaviour
	 */
	event && event.preventDefault();

	/*
	 * ----- Prevent interaction with the form
	 */
	bfsForm.disable();

	/*
	 * ----- Extract data (and report issues if found)
	 */
	var data;
	try {
		data = bfsForm.getData();
	} catch ( error ) {
		alert( error.message )
		console.error( error.message )
		bfsForm.enable();
		let domNodeFocusIndex = error.fieldName === "phoneNumber" ? 1 : 0
		bfsForm.fields[ error.fieldName ].focus( domNodeFocusIndex )
		return;
	}

	/*
	 * ----- Submit data
	 */
	bfsForm.submit( data )
		.then( function ( response ) {
			bfsForm.fields[ "message" ].set( "" )
			bfsForm.enable()
			bfsForm.$formNode.closest( ".js_whatsapp_form_section" ).find( ".js_primary_toggle_menu" ).trigger( "click" )
		} )

}
$( document ).on( "submit", ".js_whatsapp_form", whatsAppFormSubmitEventHandler );





} );
