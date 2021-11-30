
/**
 |
 | WhatsApp Forms
 |
 |
 */
$( function () {

// Imports
let BFSForm = window.__BFS.exports.BFSForm

// Set up the namespace
window.__BFS = window.__BFS || { };
window.__BFS.UI = window.__BFS.UI || { };





window.__BFS.UI.whatsappForm = new BFSForm( ".js_whatsapp_form" )
let whatsappForm = window.__BFS.UI.whatsappForm

// Set up the form's input fields, data validators and data assemblers
	// Message
whatsappForm.addField( "message", ".js_form_input_message", function ( values ) {
	var message = values[ 0 ].trim()
	if ( message.length === 0 )
		throw new Error( "Please provide a message." )
	return message
} )

	// Phone number
whatsappForm.addField( "phoneNumber", [ ".js_phone_country_code_label", ".js_form_input_phone_number" ], function ( values ) {
	let [ phoneCountryCode, phoneNumberLocal ] = values
	return BFSForm.validators.phoneNumber( phoneCountryCode, phoneNumberLocal )
} )
// When programmatically focusing on this input field, which of the (two, in this case) input elements to focus on?
whatsappForm.fields[ "phoneNumber" ].defaultDOMNodeFocusIndex = 1



whatsappForm.submit = function submit ( data ) {
	let person = Cupid.getCurrentPerson( data.phoneNumber )
	person.setSourcePoint( "WhatsApp Form" )

	Cupid.logPersonIn( person, { _trackSlug: "whatsapp-form" } )

	person.setExtendedAttributes( { whatsappMessage: data.message } )
	Cupid.savePerson( person )
	PersonLogger.submitData( person )

	return Promise.resolve( person )
}



/*
 * ----- WhatsApp Form submission handler
 */
$( document ).on( "submit", ".js_whatsapp_form", function ( event ) {

	/*
	 | Prevent default browser behaviour
	 */
	event.preventDefault();

	/*
	 | Get a reference to the form
	 */
	let $form = $( event.target ).closest( "form" )
	let bfsForm = whatsappForm.bind( $form )

	/*
	 | Prevent interaction with the form
	 */
	bfsForm.disable();

	/*
	 | Provide feedback to the user
	 */
	bfsForm.giveFeedback( "Sending..." );

	/*
	 | Extract data (and report issues if found)
	 */
	var data;
	try {
		data = bfsForm.getData();
	} catch ( error ) {
		alert( error.message )
		console.error( error.message )
		bfsForm.enable();
		bfsForm.fields[ error.fieldName ].focus()
		return;
	}

	/*
	 | Submit data
	 */
	bfsForm.submit( data )
		.then( function ( response ) {
			// The client's WhatsApp number has been stored in a data attribute
			let clientPhoneNumber = bfsForm.getFormNode().data( "number" ).replace( /\s+/g, "" )
			navigateToWhatsAppChat( clientPhoneNumber, data.message )

			closeWhatsAppMenu( bfsForm )
			clearMessageFieldContents( bfsForm )
			bfsForm.enable()
		} )

} );


function clearMessageFieldContents ( bfsForm ) {
	bfsForm.fields[ "message" ].set( "" )
}

function closeWhatsAppMenu ( bfsForm ) {
	bfsForm.getFormNode()
		.closest( ".js_whatsapp_form_section" )
		.find( ".js_primary_toggle_menu" )
		.trigger( "click" )
}





} );
