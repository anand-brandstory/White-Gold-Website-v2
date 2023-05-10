<?php if( have_rows('add_service_section') ): ?>
<section class="what-we-do-sec fill-blue-5 space-200-top-bottom">
    <div class="container">
    <div class="text-center mb-5">
        <h2><?php the_field('add_title3'); ?></h2>
        <p class="mt-4"><?php the_field('add_sub_title3'); ?></p>
    </div>
    <!-- row starts  -->
    <div class="row"> 
        <!-- col starts  --> 
        <?php while( have_rows('add_service_section') ): the_row(); ?>
    <div class="col-lg-4 mt-3 mb-3">
        <div class="box-3" alt="<?php the_sub_field('add_title'); ?>" style="background-image: url(<?php the_sub_field('add_image'); ?>);background-position: bottom;background-size: cover;background-repeat: no-repeat;">
     <!-- box content starts  -->
    <div class="inner-box-section">
        <div class="mt-3 mb-3">
<h5 class=""><?php the_sub_field('add_title'); ?></h5></div>
<p class=""><?php the_sub_field('add_content'); ?></p>
<a class="btn-custom-white" target="_self" href="#sell-gold-form-section">Contact Us</a>
    </div>
<!-- box content ends  -->
</div></div>
<!-- col ends  --><?php endwhile; ?> 

</div> 
<!-- row ends  --> 
</div>
</section><?php endif; ?>

