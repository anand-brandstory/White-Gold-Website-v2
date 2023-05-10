<?php if( have_rows('add_details') ): ?>
<section class="home-why-whitegold space-200-top space-200-bottom">
<div class="container">
    <div class="text-center mt-3 mb-4"><h2><?php the_field('add_why_title');?></h2></div>
    <div class="row mt-5-xl">
<div class="columns small-12 large-5">
<?php 
                    $image = get_field('add_left_image');
                    if( !empty( $image ) ): ?>
<img src="<?php echo esc_url($image['url']); ?>" class="img-fluid" alt="<?php echo esc_attr($image['alt']); ?>" title="<?php echo esc_attr($image['alt']); ?>">
<?php endif; ?>
</div>
<div class="columns small-12 large-7 mt-2">
<div class="row mt-2">
<!-- box starts  --><?php while( have_rows('add_details') ): the_row(); ?>
<div class="columns small-6 large-4 mb-2 mt-2">
<div class="grey-box bg-grey">
<?php 
                    $image1 = get_sub_field('add_icon');
                    if( !empty( $image1 ) ): ?> 
<img src="<?php echo esc_url($image1['url']); ?>" class="img-fluid mb-2" alt="<?php echo esc_attr($image1['alt']); ?>" title="<?php the_sub_field('add_title'); ?>"><?php endif; ?>
<p class="mt-1"><?php the_sub_field('add_title'); ?></p>
</div></div>
<!-- box ends --><?php endwhile; ?>
</div>
</div>
<div class="text-center mt-3">
<div class="">
<a class="btn-primary-blue" href="https://whitegold.money/why-whitegold/">Learn More</a></div>
    </div>
</div>
</div>


</section>
<?php endif; ?>

<style>

@media (max-width:1024px){
    .home-why-whitegold .btn-primary-blue {
    font-size: 14px;
    padding: 14px 15px 13px 15px;
    position: relative;
    background-color:#0032a0;
    color:white;
    border-radius:10px;
}
}
    @media (min-width:1025px){
    
    .home-why-whitegold .btn-primary-blue {
    font-size: 14px;
    padding: 14px 15px 13px 15px;
    position: relative;
    background-color:#0032a0;
    color:white;
    border-radius:10px;
}
}
@media (min-width:1440px){
    .home-why-whitegold .btn-primary-blue{
        position: relative;
        top:-90px;
        font-size: 16px;
        padding: 15px 25px 15px 25px;
    } 

}

</style>
