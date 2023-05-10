<?php if(have_rows('add_highlight_images')):?>
<section class="section-highlights space-100-bottom space-100-top mb-md-4 <?php the_field('page_class');?>">
    <div class="container-fluid mb-5">
<div class="text-center mt-5 mb-5">
<h2 class=""><?php the_field('add_section_title');?></h2>
</div>
<!-- slider loop starts -->
<div class="highlight">
<?php while( have_rows('add_highlight_images') ): the_row(); ?>
    <div class="test">
    <?php 
                    $image3 = get_sub_field('add_images');
                    if( !empty( $image3 ) ): ?> 
<img src="<?php echo esc_url($image3['url']); ?>" alt="<?php echo esc_attr($image3['alt']); ?>" title="<?php echo esc_attr($image3['title']); ?>" class="img-fluid"><?php endif; ?></div>
<?php endwhile; ?>
<!-- slider loop end -->
</div>
<!-- START below content -->
<div class="container">
<p class="mt-4 mb-4 below-contents"><?php the_field('add_below_contents');?></p></div>
<!-- END below content -->
</div>
</section>
<?php endif; ?>



