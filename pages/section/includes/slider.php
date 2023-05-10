<div class="careers-page">
<div class="slider-desktop">
<section class="landing-carousel-section fill-blue-5 position-relative d-none d-md-block" id="landing-carousel-section" data-section-title="Landing Carousel Section" data-section-slug="landing-carousel-section">
	<div class="row carousel js_carousel_container" style="--fade-left: linear-gradient( to left, rgba(0, 50, 160, 0) 0%, rgba(0, 50, 160, 1) 50%); --fade-right: linear-gradient( to right, rgba(0, 50, 160, 0) 0%, rgba(0, 50, 160, 1) 50%);">
		<div class="carousel-list js_carousel_content">
		<?php if( have_rows('add_banner_section') ): ?>
		<?php while( have_rows('add_banner_section') ): the_row(); ?>
			<div class="row carousel-list-item js_carousel_item">
					<div class="carousel-card container space-100-top-bottom" style="background-image: url( '<?php the_sub_field('add_bg_image'); ?>' ); background-position:right;background-size:contain;" alt="careers-whitegold">
						<div class="card-content content-block">
					<div class="text-white" style="padding-top:30px;font-weight:800;"><?php the_sub_field('add_title'); ?></div>
<p><?php the_sub_field('add_sub_title');?></p>
<a class="btn-custom-primary" href="<?php the_sub_field('add_link');?>">View Current Openings</a>					
</div>
					</div>
				</div>

				<?php endwhile; ?>
				<?php endif; ?>
		</div>
		</div>
	</div>
	</section>
</div>

<!-- mobile version slider starts -->
<div class="slider-mobile">
        <section class="landing-carousel-section fill-blue-5 position-relative d-lg-none d-md-none" id="landing-carousel-section" data-section-title="Landing Carousel Section" data-section-slug="landing-carousel-section">
	<div class="row carousel js_carousel_container" style="--fade-left: linear-gradient( to left, rgba(0, 50, 160, 0) 0%, rgba(0, 50, 160, 1) 50%); --fade-right: linear-gradient( to right, rgba(0, 50, 160, 0) 0%, rgba(0, 50, 160, 1) 50%);">
		<div class="carousel-list js_carousel_content">
		<?php if( have_rows('add_banner_section') ): ?>
		<?php while( have_rows('add_banner_section') ): the_row(); ?>
			<div class="row carousel-list-item js_carousel_item pl-30">
					<div class="carousel-card container pb-40">
						<div class="card-content content-block">
					<div class="text-white" style="padding-top:30px;font-weight:800;"><?php the_sub_field('add_title'); ?></div>
<?php the_sub_field('add_sub_title');?>
<a class="btn-custom-primary" href="#current-opening">View Current Openings</a>				<div style="text-align:center;" class="img-mobile"> <img src="<?php the_sub_field('add_bg_image_mobile'); ?>" class="img-fluid"></div>	
</div>
					</div>
				</div>

				<?php endwhile; ?>
				<?php endif; ?>
		</div>
		</div>
	</div>
        </section></div>
<!-- mobile version slider ends -->
