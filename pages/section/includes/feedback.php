<section class="feedback desktop pt-60 pb-60 d-none d-md-block" style="background-size:cover;background-image:url(<?php the_field('add_feedback_bg_img');?>)" alt="Candidate Feedback">
<div class="container">
<div class="col-lg-6"><div class="mt-3 mb-4">
<h2 class="mt-5 mb-3"><?php the_field('add_feedback_title');?></h2></div>
<?php the_field('add_feedback_description');?>
<div class="d-flex mt-5">
<?php if( have_rows('add_buttons') ): ?>
    <?php while( have_rows('add_buttons') ): the_row(); ?>
    <?php 
                        $link1 = get_sub_field('add_button');
                        if( $link1 ): 
                        $link1_url = $link1['url'];
                        $link1_title = $link1['title'];
                        $link1_target = $link1['target'] ? $link1['target'] : '_self';
                        ?>
			<a class="btn-custom-primary" target="<?php echo esc_attr( $link1_target ); ?>" href="<?php echo esc_url( $link1_url ); ?>"> <i class="fa fa-<?php the_sub_field('add_icon_class');?> fa-fw" aria-hidden="true"></i><?php echo esc_html( $link1_title ); ?></a>
                        <?php endif; ?>
                        <?php endwhile; ?>
                        <?php endif; ?>
</div></div>
<div class="col-lg-6"></div>
</div>

</section>
<section class="feedback mobile pt-60 pb-60 d-lg-none d-md-none" style="background-size:cover;background-image:url(<?php the_field('add_feedback_bg_img_mobile');?>)" alt="Candidate Feedback">
<div class="container">
<div class="col-lg-6"><div class="mt-0 mb-3">
<h2 class="mt-0 mb-3"><?php the_field('add_feedback_title');?></h2></div>
<?php the_field('add_feedback_description');?>
<div class="d-flex mt-4">
<?php if( have_rows('add_buttons') ): ?>
    <?php while( have_rows('add_buttons') ): the_row(); ?>
    <?php 
                       $link1 = get_sub_field('add_button');
                        if( $link1 ): 
                        $link1_url = $link1['url'];
                        $link1_title = $link1['title'];
                        $link1_target = $link1['target'] ? $link1['target'] : '_self';
                        ?>
			<a class="btn-custom-primary" target="<?php echo esc_attr( $link1_target ); ?>" href="<?php echo esc_url( $link1_url ); ?>"><i class="fa fa-<?php the_sub_field('add_icon_class');?> fa-fw" aria-hidden="true"></i><?php echo esc_html( $link1_title ); ?></a>
<?php endif; ?>			<?php endwhile; ?>

                        <?php endif; ?>

</div>
</div>
<div class="col-lg-6"></div>
</div>


</section>
