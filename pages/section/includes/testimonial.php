<?php if( have_rows('add_testimonials') ): ?>
<section class="testimonial pt-60 pb-60 d-none d-md-block">
<div class="container">
<div class="text-center mb-5">
<h2 class="mt-5 mb-5">Real People Real Heros</h2></div>
<div style="background-size:cover;background-image:url(<?php the_field('add_testimonial_bg');?>)">
<div class="slider">
<?php while( have_rows('add_testimonials') ): the_row(); ?>
<div class="">
<div class="box-testimonials">
<div class="d-lg-flex">
<img src="<?php the_sub_field('upload_profile_image'); ?>" class="img-fluid profile-img" alt="<?php the_sub_field('alt_tag');?>">
<div class="img-fluid" style="background-size:contain;background-repeat:no-repeat;background-image:url(<?php the_field('testimonial_icon');?>)"></div>
<img src="<?php the_field('testimonial_icon');?>" class="icon" style="width:32px;height:auto;">
<p class=""><?php the_sub_field('description'); ?></p></div>
<div class="testimonial-heading">
<h5 class="mb-3"><?php the_sub_field('name'); ?></h5>
<h6 class=""><?php the_sub_field('location'); ?></h6></div>
</div></div><?php endwhile; ?>
</div</div>
</div>
</section><?php endif; ?>





<?php if( have_rows('add_testimonials') ): ?>
<section class="testimonial pt-60 pb-60 d-lg-none d-md-none">
<div class="container">
<div class="text-center mb-5">
<h2 class="mt-5 mb-5">Real People Real Heros</h2></div>
<div style="background-position: center;background-size:cover;background-repeat: no-repeat;background-image:url(<?php the_field('add_testimonial_bg_mobile');?>)">
<div class="slider">
<?php while( have_rows('add_testimonials') ): the_row(); ?>
<div class="">
<div class="box-testimonials">
<div class="d-lg-flex">
<img src="<?php the_sub_field('upload_profile_image'); ?>" class="img-fluid profile-img" alt="<?php the_sub_field('alt_tag');?>">
<div class="img-fluid" style="background-size:contain;background-repeat:no-repeat;background-image:url(<?php the_field('testimonial_icon');?>)" alt="<?php the_sub_field('alt_tag');?>"></div>
<img src="<?php the_field('testimonial_icon');?>" class="icon" style="width:32px;height:auto;">
<p class=""><?php the_sub_field('description'); ?></p></div>
<div class="testimonial-heading">
<h5 class="mb-3"><?php the_sub_field('name'); ?></h5>
<h6 class=""><?php the_sub_field('location'); ?></h6></div>
</div></div><?php endwhile; ?>
</div</div>
</div>
</section><?php endif; ?>

