
/*
 * ----- Dependencies
 */
const { debounce } = lodash;



/*
 * ----- Hide the tag panel
 */
wp.domReady( function () {

	wp.data.dispatch( 'core/edit-post').removeEditorPanel( "taxonomy-panel-post_tag" );

} );



/*
 * ----- Broadcast whenever Gutenberg's editor mode is changed
 *
 *	The first occurence of this event is basically used as an indirect measure of determining
 *	when Gutenberg has loaded. A lot of the code that follows in this file relies on this event.
 *
 */
wp.data.subscribe( function () {
	let currentEditorMode = null
	// Data store state tree selectors
	let getEditorMode = wp.data.select( 'core/edit-post').getEditorMode;

	return function () {
		let newEditorMode = getEditorMode();
		if ( newEditorMode === currentEditorMode )
			return;
		wp.hooks.doAction( "gutenberg-editor-mode-change", { editorMode: newEditorMode } );
		currentEditorMode = newEditorMode;
	};
}() );



/*
 * ----- Make the post title non-editable
 *
 * 	This has to be done every time the editor mode is changed
 * 	(i.e. between "visual" and "code/text")
 *
 */
function disablePostTitleFromBeingEdited () {
	jQuery( ".editor-post-title" ).find( "textarea" )
		.prop( "disabled", true )
		.attr( "placeholder", "" )
		.val( null )
}
disablePostTitleFromBeingEdited();
wp.hooks.addAction( "gutenberg-editor-mode-change", "disable_post_title_from_being_edited", debounce( disablePostTitleFromBeingEdited, 750, { trailing: true } ) );



/*
 * ----- Dynamically set the post title based on data entered into the custom (ACF) fields
 */
let branchName = "";
let branchRegion = "";

function setPostTitle () {
	let postTitle = ""
	if ( branchName.trim() ) {
		postTitle = branchName.trim();
		if ( branchRegion.trim() )
			postTitle = postTitle + ", " + branchRegion.trim().toUpperCase();
	}
	jQuery( ".editor-post-title" ).find( "textarea" )
		.val( "" )
		.attr( "placeholder", postTitle )
}


wp.hooks.addAction( "gutenberg-editor-mode-change", "set_post_title", debounce( setPostTitle, 750, { trailing: true } ) );

wp.hooks.addAction( "gutenberg-editor-mode-change", "when_on_visual_mode", debounce( function ( { editorMode } ) {

	if ( editorMode !== "visual" )
		return;

	wp.hooks.removeAction( "gutenberg-editor-mode-change", "when_on_visual_mode" );

	wp.hooks.addAction( "acf-fields-mount", "dynamically_update_post_title_based_on_user_input", function () {

		let branchNameField = acf.getFields( { name: "branch_name" } )[ 0 ];
		let branchRegionField = acf.getFields( { name: "region" } )[ 0 ];

		branchNameField.on( "input", onFieldEditEventHandler );
		branchRegionField.on( "change", onFieldEditEventHandler );

		function onFieldEditEventHandler ( event ) {

			branchName = branchNameField.val();
			branchRegion = branchRegionField.val();

			setPostTitle( branchName, branchRegion );

		}

		onFieldEditEventHandler();

	} );

	/*
	 * ----- When ACF mounts all the custom fields, trigger an event
	 */
	// This is a hacky approach that essentially polls the DOM (via ACF's `getFields` function)
	// 	until a non-empty value is returned
	function observeWhenACFFieldsLoad () {
		if ( acf.getFields().length )
			wp.hooks.doAction( "acf-fields-mount", { } );
		else
			setTimeout( observeWhenACFFieldsLoad, 100 );
	}
	observeWhenACFFieldsLoad();

}, 1500, { trailing: true } ) );
