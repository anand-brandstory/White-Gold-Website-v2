
/**
 |
 | Hide the tag panel
 |
 |
 */
wp.domReady( function () {
	wp.data.dispatch( 'core/edit-post').removeEditorPanel( "taxonomy-panel-post_tag" )
} )
