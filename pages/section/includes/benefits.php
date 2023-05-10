<?php if( have_rows('add_benefits') ): ?>
<section class="benefits bg-grey pb-40">
<div class="container">
<div class="text-center pt-60 mb-5">
<h2 class="text-center"><?php the_field('add_box_section_heading'); ?></h2>
	</div>
<div class="row">
<?php while( have_rows('add_benefits') ): the_row(); ?>
<div class="col-lg-3 col-md-4 col-6 mb-5">
<div class="service-box2">
<img src="<?php the_sub_field('upload_icon'); ?>" class="img-fluid mb-4" alt="<?php the_sub_field('add_title');?>">
<h3 class="mb-2"><?php the_sub_field('add_title'); ?></h3>
<p><?php the_sub_field('add_content'); ?></p>
</div></div>
<?php endwhile; ?>

</div>
</div>
</section>
<?php endif; ?>
