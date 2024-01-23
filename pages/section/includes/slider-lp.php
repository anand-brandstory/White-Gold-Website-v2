<div class="careers-page">
<div class="slider-desktop">
<section class="landing-carousel-section fill-blue-5 position-relative d-none d-md-block" id="landing-carousel-section" data-section-title="Landing Carousel Section" data-section-slug="landing-carousel-section" style="
background-image: url(<?php the_field('add_banner_img_bg'); ?>);background-position: right -10% bottom 45%;background-size: contain;background-repeat: no-repeat;">
	<div class="row carousel js_carousel_container" style="--fade-left: linear-gradient( to left, rgba(0, 50, 160, 0) 0%, rgb(0 50 160 / 0%) 50%); --fade-right: linear-gradient( to right, rgba(0, 50, 160, 0) 0%, rgb(0 50 160 / 0%) 50%);">
		<div class="carousel-list js_carousel_content">
		<?php if( have_rows('add_banner_section') ): ?>
		<?php while( have_rows('add_banner_section') ): the_row(); ?>
			<div class="row carousel-list-item js_carousel_item">
				<div class="carousel-card container space-100-top-bottom"style=" background-image: url(<?php the_sub_field('add_bg_image'); ?>);background-position: <?php the_field('add_bg_position');?>;background-size: contain;background-repeat: no-repeat;background-origin: content-box;">
						<div class="card-content content-block pr-p30">
					<div class="text-white" style="padding-top:30px;font-weight:800;"><?php the_sub_field('add_title'); ?></div>

<?php if( get_sub_field('add_sub_title') ): ?>
<?php the_sub_field('add_sub_title');?><?php endif; ?>
<?php 
                        $link2 = get_field('add_link_mobile_view_copy');
                        if( $link2 ): 
                        $link2_url = $link2['url'];
                        $link2_title = $link2['title'];
                        $link2_target = $link2['target'] ? $link2['target'] : '_self';
                        ?>
<a class="btn-custom-primary" target="<?php echo esc_attr( $link2_target ); ?>" href="<?php echo esc_url( $link2_url ); ?>"><?php echo esc_html( $link2_title ); ?></a>
<?php endif; ?>				
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
        <section class="landing-carousel-section fill-blue-5 position-relative d-lg-none d-md-none" id="landing-carousel-section" data-section-title="Landing Carousel Section" data-section-slug="landing-carousel-section" style="
background-image: url(<?php the_field('add_banner_img_bg'); ?>);background-position: right -10% bottom 7%;background-size: contain;background-repeat: no-repeat;">
	<div class="row carousel js_carousel_container" style="--fade-left: linear-gradient( to left, rgba(0, 50, 160, 0) 0%, rgba(0, 50, 160, 1) 50%); --fade-right: linear-gradient( to right, rgba(0, 50, 160, 0) 0%, rgba(0, 50, 160, 1) 50%);">
		<div class="carousel-list js_carousel_content">
		<?php if( have_rows('add_banner_section') ): ?>
		<?php while( have_rows('add_banner_section') ): the_row(); ?>
			<div class="row carousel-list-item js_carousel_item pl-30">
					<div class="carousel-card container pb-40">
						<div class="card-content content-block">
					<div class="text-white" style="padding-top:30px;font-weight:800;"><?php the_sub_field('add_title'); ?></div>
<?php the_sub_field('add_sub_title');?>
<?php 
                        $link2 = get_field('add_link_mobile_view_copy');
                        if( $link2 ): 
                        $link2_url = $link2['url'];
                        $link2_title = $link2['title'];
                        $link2_target = $link2['target'] ? $link2['target'] : '_self';
                        ?>
<a class="btn-custom-primary" target="<?php echo esc_attr( $link2_target ); ?>" href="<?php echo esc_url( $link2_url ); ?>"><?php echo esc_html( $link2_title ); ?></a>
<?php endif; ?>				<div style="text-align:center;" class="img-mobile"> <img src="<?php the_sub_field('add_bg_image_mobile'); ?>" class="img-fluid"></div>	
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
