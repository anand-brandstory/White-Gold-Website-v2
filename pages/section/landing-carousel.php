<?php

use BFS\CMS;

$allCarouselSlides = CMS::getPostsOf( 'card' );
$carouselSlides = array_filter( $allCarouselSlides, function ( $slide ) {
	return in_array( REGION, $slide->get( 'regions_applicable' ) );
} );

?>
<section class="landing-carousel-section fill-blue-5 position-relative" id="landing-carousel-section" data-section-title="Landing Carousel Section" data-section-slug="landing-carousel-section">
	<div class="row carousel js_carousel_container" style="--fade-left: linear-gradient( to left, rgba(0, 50, 160, 0) 0%, rgba(0, 50, 160, 1) 50%); --fade-right: linear-gradient( to right, rgba(0, 50, 160, 0) 0%, rgba(0, 50, 160, 1) 50%);">
		<div class="carousel-list js_carousel_content">
			<?php foreach ( $carouselSlides as $slide ) : ?>
				<div class="row carousel-list-item js_carousel_item">
					<div class="carousel-card container space-100-top-bottom" style="background-image: url( '<?= $slide->get( 'bg_image' ) . $ver ?>' ); background-position: <?= $slide->get( 'bg_image_anchor' ) ?>;">
						<div class="card-content content-block">
							<?= $slide->get( 'card_text' ) ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="carousel-controls clearfix">
			<div class="prev float-left"><button class="carousel-button h3 fade-out js_pager" data-dir="left"><span class="country-code-divider material-icons" data-icon="arrow_back"></span></button></div>
			<div class="next float-right"><button class="carousel-button h3 js_pager" data-dir="right"><span class="country-code-divider material-icons" data-icon="arrow_forward"></span></button></div>
		</div>
	</div>
</section>