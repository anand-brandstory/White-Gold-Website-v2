
/**
 |
 | Hide the *section* tag panel
 |
 |
 */
wp.domReady( function () {
	wp.data.dispatch( 'core/edit-post').removeEditorPanel( "taxonomy-panel-tag_section" )
} )
