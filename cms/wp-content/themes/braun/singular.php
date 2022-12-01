<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();

?>

<?php require_once __ROOT__ . '/pages/section/header.php'; ?>

<main id="site-content" class="content-block container space-200-top-bottom">
	<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			the_content();
		}
	}

	?>

</main><!-- #site-content -->

<?php get_footer(); ?>
