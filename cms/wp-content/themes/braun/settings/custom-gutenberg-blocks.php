<?php

/*
 |
 | Custom Gutenberg blocks
 |
 */
add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_register_block_type' ) )
		return;

	// Card block (used for carousels)
	acf_register_block_type( [
		'name' => 'bfs-card',
		'title' => __( 'Card' ),
		'description' => __( 'A card that has a line of text, an image in the background, and maybe a link.' ),
		'category' => 'white-gold',
		'icon' => 'testimonial',
		'align' => 'wide',
		'mode' => 'edit',
		'supports' => [
			'multiple' => false,
			'align' => [ 'wide' ]
		],
		'render_callback' => 'acf_render_callback'
	] );

	// Branches
	acf_register_block_type( [
		'name' => 'bfs-branch',
		'title' => __( 'Branch' ),
		'description' => __( 'A branch is physical location where White Gold offer their services.' ),
		'category' => 'white-gold',
		'icon' => 'testimonial',
		'align' => 'wide',
		'mode' => 'edit',
		'supports' => [
			'multiple' => false,
			'align' => [ 'wide' ]
		],
		'render_callback' => 'acf_render_callback'
	] );

	// FAQs
	acf_register_block_type( [
		'name' => 'bfs-faqs',
		'title' => __( 'FAQs' ),
		'description' => __( 'FAQs' ),
		'category' => 'white-gold',
		'icon' => 'editor-textcolor',
		'align' => 'wide',
		'mode' => 'edit',
		'supports' => [
			'multiple' => false,
			'align' => [ 'wide' ]
		],
		'render_callback' => 'acf_render_callback'
	] );

	function acf_render_callback ( $block, $content, $is_preview, $post_id ) {
		if ( ! class_exists( '\BFS\CMS' ) )
			return;

		\BFS\CMS::$currentQueriedPostACF = array_merge( \BFS\CMS::$currentQueriedPostACF, get_fields() ?: [ ] );
	}

} );
