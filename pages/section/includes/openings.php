<!-- tab 2 -->
<?php if( have_rows('openings') ): ?>
<div class="custom-tab pb-40 d-none d-md-block" id="current-openings">

  <div class="container custom-boxshadow mt-5 mb-5">
     <div class="text-center mt-5 mb-5"> <h2 class="">Current Openings</h2>
     <p class="d-none d-md-block mt-4 mb-4"> <?php the_field('add_openings_sub_heading');?> </p>
<h3 class="d-lg-none d-md-none">Open Positions</h3>
</div>
  <div class="">
      <div class="tab">
<h3 class="d-none d-md-block">Open Positions</h3>
      <?php while( have_rows('openings') ): the_row(); ?>
          <button class="tablinks" onclick="openTab(event, '<?php the_sub_field('add_job_title'); ?>')" id="defaultOpen"><?php the_sub_field('add_job_title'); ?></button>
          <?php endwhile; ?>
        </div>
        <?php while( have_rows('openings') ): the_row(); ?>
        <div id="<?php the_sub_field('add_job_title'); ?>" class="tabcontent">
         <h4 class="mb-5"><?php the_sub_field('add_job_title'); ?></h4>
         <?php the_sub_field('add_job_description'); ?>

<a class="btn-custom-secondary mt-3 mb-3" target="_blank" href="<?php the_sub_field('apply_now_link'); ?>">Apply Now</a>
        </div> <?php endwhile; ?>
     
        </div>
      </div>
  </div><?php endif; ?>
<!-- end tab 2 -->




<?php if( have_rows('openings') ): ?>
<div class="container" id="current-opening">
<div class="custom-tab-mobile d-lg-none d-md-none pb-40">
<div class="text-center mt-5 mb-3"> <h2 class="">Current Openings</h2>
</div>
<div class="mt-3 mb-3 text-center">
<p class="d-lg-none d-md-none" style="font-size:11px!important;"><?php the_field('add_position_content');?></p></div>
<div class="accordion accordion-flush" id="accordionFlush<?php the_sub_field('sl_no'); ?>">
  
   <?php while( have_rows('openings') ): the_row(); ?>
  <div class="accordion-item">
      <h2 class="accordion-header" id="flush-heading<?php the_sub_field('sl_no'); ?>">
        <button class="accordion-button mb-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php the_sub_field('sl_no'); ?>" aria-expanded="false" aria-controls="flush-collapse<?php the_sub_field('sl_no'); ?>">
          <?php the_sub_field('add_job_title'); ?>
          </button>
        </h2>
       <div id="flush-collapse<?php the_sub_field('sl_no'); ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php the_sub_field('sl_no'); ?>" data-bs-parent="#accordionFlush<?php the_sub_field('sl_no'); ?>">
      <div class="accordion-body mb-3"><?php the_sub_field('add_job_description'); ?>

<a class="btn-custom-secondary mt-3 mb-3" target="_blank" href="<?php the_sub_field('apply_now_link'); ?>">Apply Now</a>

</div>
    </div>
  </div>
  <?php endwhile; ?>
</div>
<div class="text-center mb-3" style="font-size:11px!important;"><?php the_field('add_opening_bottom_content'); ?></div>
</div>

</div></div>
<?php endif; ?>
