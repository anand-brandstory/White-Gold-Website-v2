
/*
 * ----- the Form class
 */
function BFSForm ( className ) {

	className = className.replace( /^\./, "" ).trim();

	/*
	 * ----- Get a reference to the form
	 */
	if ( ! className )
		throw new Error( "Form class name not provided." );
	var domForms = document.getElementsByClassName( className );
	if ( ! domForms.length )
		throw new Error( "Form could not be found." );
	this.domForm = domForms[ 0 ];

	this.fields = { };

}
BFSForm.getErrorResponse = function getErrorResponse () {
	var code = -1;
	var message;
	if ( jqXHR.responseJSON ) {
		code = jqXHR.responseJSON.code || jqXHR.responseJSON.statusCode;
		message = jqXHR.responseJSON.message;
	}
	else if ( typeof e == "object" ) {
		message = e.stack;
	}
	else {
		message = jqXHR.responseText;
	}
	var error = new Error( message );
	error.code = code;
	return error;
}
BFSForm.prototype.disable = function disable ( fn ) {
	$( this.domForm ).find( "input, textarea, select, button" ).prop( "disabled", true );
	if ( Object.prototype.toString.call( fn ).toLowerCase() === "[object function]" )
		fn.call( this, this.domForm );
};
BFSForm.prototype.enable = function enable ( fn ) {
	$( this.domForm ).find( "input, textarea, select, button" ).prop( "disabled", false );
	if ( Object.prototype.toString.call( fn ).toLowerCase() === "[object function]" )
		fn.call( this, this.domForm );
};
BFSForm.prototype.giveFeedback = function giveFeedback ( message ) {
	var $submitButton = $( this.domForm ).find( "[ type = 'submit' ]" );
	// Backup the initial label of the button
	if ( $submitButton.data( "initial-label" ) === void 0 /* i.e. `undefined` */ )
		$submitButton.data( "initial-label", $submitButton.text() );

	$submitButton.text( message );
}
BFSForm.prototype.setSubmitButtonLabel = function setSubmitButtonText ( label ) {
	var $submitButton = $( this.domForm ).find( "[ type = 'submit' ]" );
	var label = label || $submitButton.data( "initial-label" );
	$submitButton.text( label );
}

BFSForm.prototype.getFieldValue = function getFieldValue ( domField ) {
	var elementTag = domField.nodeName.toLowerCase();
	var value;

	if ( elementTag === "input" ) {
		var inputType = domField.getAttribute( "type" );
		if ( inputType === "radio" )
			value = domField.checked ? domField.value : null;
		else
			value = domField.value;
	}
	else if ( elementTag === "textarea" ) {
		value = domField.value;
	}
	return value;
}

BFSForm.prototype.addField = function addField ( name, domFields, fn ) {
	if ( ! Array.isArray( domFields ) )
		domFields = [ domFields ];
	this.fields[ name ] = {
		domFields: domFields,
		validateAndAssemble: fn,
		// isRequired: isRequired
	};
};

BFSForm.prototype.getData = function getData () {
	this.data = { };
	var _key;
	for ( _key in this.fields ) {
		var field = this.fields[ _key ];
		var valueParts = field.domFields.map( this.getFieldValue );
		var value = field.validateAndAssemble( valueParts );
		this.data[ _key ] = value;
	}
	return this.data;
};
