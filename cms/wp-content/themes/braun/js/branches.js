
wp.domReady( function () {

	/*
	 * ----- Hide the tag panel
	 */
	wp.data.dispatch( 'core/edit-post').removeEditorPanel( "taxonomy-panel-post_tag" );

} );
