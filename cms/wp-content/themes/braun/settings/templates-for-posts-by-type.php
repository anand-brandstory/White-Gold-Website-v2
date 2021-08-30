<?php

/*
 |
 | Templates for Posts by their Type
 |
 */
add_filter( 'register_post_type_args', function ( $args, $postType ) {

	if ( $postType === 'card' ) {
		$args[ 'template' ] = [
			[ 'acf/bfs-card' ]
		];
		$args[ 'template_lock' ] = 'all';
	}
	else if ( $postType === 'branch' ) {
		$args[ 'template' ] = [
			[ 'acf/bfs-branch' ]
		];
		$args[ 'template_lock' ] = 'all';
	}
	else if ( $postType === 'faq' ) {
		$args[ 'template' ] = [
			[ 'core/paragraph', [ 'placeholder' => 'Type in a detailed answer here...' ] ],
			[ 'acf/bfs-faqs' ]
		];
	}

	return $args;

}, 20, 2 );
