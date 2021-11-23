
wp.domReady( function() {

	/*
	 *
	 * ----- Only allow specific blocks to be used
	 *
	 */
	let allowedBlockTypes = [
		"core/group",
		"core/column",
		"core/columns",
		"core/heading",
		"core/subhead",
		"core/paragraph",
		"core/quote",
		// "core/pullquote",
		"core/image",
		"core/gallery",
		"core/list",
		"core/separator",
		"core/block",
		"core/spacer"
	];

	if ( postType === "card" )
		allowedBlocks.push( "acf/bfs-card" )
	if ( postType === "branch" )
		allowedBlocks.push( "acf/bfs-branch" )
	if ( postType === "faq" )
		allowedBlocks.push( "acf/bfs-faqs" )
	if ( postType === "video" )
		allowedBlocks.push( "acf/bfs-video" )

	let allBlockTypes = wp.blocks.getBlockTypes();
	allBlockTypes.forEach( function ( blockType ) {
		if ( allowedBlockTypes.indexOf( blockType.name ) === -1 )
			wp.blocks.unregisterBlockType( blockType.name );
	} );

} );
