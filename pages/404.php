<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * The canonical file is `/pages/404.php`.
 * `/cms/wp-content/themes/<theme>/404.php` has been symbolically linked to this.
 *
 *
 */

// If a post revision or preview is being viewed, and the user is not authorized to view it, simply return to the home page
// NOTE: The revision / preview URLs of **unpublished** posts have no URL slugs, only query parameters, i.e. they essential resemble that of the home page URL
if ( \BFS\Router::$urlSlug == '' )
	return require_once __ROOT__ . '/pages/home.php';

\BFS\Router::$httpResponseCode = 404;
require_once __ROOT__ . '/inc/header.php';

?>

	<section class="space-50-top">
		<div class="container">
			<div class="row">
				<div class="columns small-12 large-5">
					<div class="row">
						<div class="columns small-12 medium-10 large-12 space-50-top-bottom">
							<div class="h2 strong">It looks like nothing was found at this location.</div>
							<a class="h5 text-blue-4 space-50-top" href="/">Click here to go back to the home page.</a>
						</div>
					</div>
				</div>
				<div class="columns small-12 large-6 large-offset-1 space-25-bottom">
				</div>
			</div>
		</div>
	</section>

<?php
require_once __ROOT__ . '/inc/footer.php';
