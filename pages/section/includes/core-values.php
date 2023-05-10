<?php if( have_rows('add_values') ): ?>
	
<section class="our-values">
	<div class="container">
<div class="text-center mt-2 mb-5">
<h2 class="text-center">What makes us who we are</h2>
	</div>	<div class="row">
<?php while( have_rows('add_values') ): the_row(); ?>
<div class="col-lg-6 col-md-6">
<div class="core-box mb-5">
	<div class="d-flex">
	<img src="<?php the_sub_field('add_icon');?>" class="img-fluid mb-4" alt="<?php the_sub_field('add_title');?>">
<h3><?php the_sub_field('add_title');?></h3>
</div>
<p><?php the_sub_field('add_description');?></p>
</div>
</div>
<?php endwhile; ?>
<div class="text-center middle-logo-section d-none d-md-block">
<img src="<?php the_field('add_middle_logo');?>" class="img-fluid">

				</div>
</div>
		</div></div>
		</section>
<?php endif; ?>

