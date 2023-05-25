<?php if( have_rows('add_testimonials') ): ?>
<section class="testimonial pt-60 pb-60 d-none d-md-block space-200-top space-200-bottom">
<div class="container">
<div class="text-center mb-5">
<h2 class="mt-5 mb-5"><?php the_field('add_testimonial_heading'); ?></h2></div>
<div style="background-size:cover;background-image:url(<?php the_field('add_testimonial_bg');?>)">
<div class="slider">
<?php while( have_rows('add_testimonials') ): the_row(); ?>
<div class="">
<div class="box-testimonials">
<div class="d-lg-flex">
<img src="<?php the_sub_field('upload_profile_image'); ?>" class="img-fluid profile-img" alt="<?php the_sub_field('alt_tag');?>" title="<?php the_sub_field('alt_tag');?>">
<div class="img-fluid" style="background-size:contain;background-repeat:no-repeat;background-image:url(<?php the_field('testimonial_icon');?>)"></div>
<img src="<?php the_field('testimonial_icon');?>" class="icon" alt="testimonial-icon" style="width:32px;height:auto;">
<p class=""><?php the_sub_field('description'); ?></p></div>
<div class="testimonial-heading">
<h5 class="mb-3"><?php the_sub_field('name'); ?></h5>
<h6 class=""><?php the_sub_field('location'); ?></h6></div>
</div></div><?php endwhile; ?>
</div</div>
</div>
</section><?php endif; ?>





<?php if( have_rows('add_testimonials') ): ?>
<section class="testimonial pt-60 pb-60 d-lg-none d-md-none space-200-top space-200-bottom">
<div class="container">
<div class="text-center mb-5">
<h2 class="mt-5 mb-5"><?php the_field('add_testimonial_heading_mobile'); ?></h2></div>
<div style="background-position: center;background-size:cover;background-repeat: no-repeat;background-image:url(<?php the_field('add_testimonial_bg_mobile');?>)">
<div class="slider">
<?php while( have_rows('add_testimonials') ): the_row(); ?>
<div class="">
<div class="box-testimonials">
<div class="d-lg-flex">
<img src="<?php the_sub_field('upload_profile_image'); ?>" class="img-fluid profile-img" alt="<?php the_sub_field('alt_tag');?>" title="<?php the_sub_field('alt_tag');?>">
<div class="img-fluid" style="background-size:contain;background-repeat:no-repeat;background-image:url(<?php the_field('testimonial_icon');?>)" alt="<?php the_sub_field('alt_tag');?>"></div>
<img src="<?php the_field('testimonial_icon');?>" class="icon" alt="testimonial-icon" style="width:32px;height:auto;">
<p class=""><?php the_sub_field('description'); ?></p></div>
<div class="testimonial-heading">
<h5 class="mb-3"><?php the_sub_field('name'); ?></h5>
<h6 class=""><?php the_sub_field('location'); ?></h6></div>
</div></div><?php endwhile; ?>
</div</div>
</div>
</section><?php endif; ?>

<style>

.testimonial h2 {
    font-size: 32px;
    font-weight: 800;
}
.box-testimonials p {
    display: inline-block;
    font-size: 18px;
    color: #212322;
}


    .mb-5 {
    margin-bottom: 3rem!important;
}
    .box-testimonials {
    padding: 15px;
    background-color: white;
    border-radius: 16px;
}

.slider .slick-prev:before {
    content: url(https://staging.whitegold.money/content/cms/arrow-left.png)!important;
}

.slider .slick-next:before {
    content: url(https://staging.whitegold.money/content/cms/arrow-right.png)!important;
}
.d-none {
    display: none!important;
}

.img-fluid {
    max-width: 100%;
    height: auto;
}

@media (min-width: 1480px){

    .d-lg-flex{
        display:flex!important;
    }

    .blue-box {
    margin-top: 83px!important;
    margin-left: -138px!important;
    width: 500px;
    padding: 40px;
    background-color: #0032A0;
    margin-bottom: 50px;
}

.box-testimonials {
        top: 20px;
    position: relative;
    margin: 70px 193px 110px 185px!important;
    padding: 20px;
    background-color: white;
    border-radius: 16px;
}

.slider .slick-next{
    left: 87.2%!important;
    position: absolute;
    right: 10px;
    top: 51%!important;
}

.slider .slick-prev{
top: 51%!important;
}

.slick-next {
    width: 35px!important;
    height: 40px;
}

.slick-prev {
    width: 35px!important;
    height: 35px;
}
.box-testimonials .testimonial-heading {
    position: relative;
    left: 250px;
    right: 0;
    top: -48px!important;
}


}


@media screen and (min-width: 700px){
    .d-lg-flex{
        display:flex!important;
    }
    .d-md-block {
    display: block!important;
}
    .slider .slick-prev {
    z-index: 1;
    position: absolute;
    left: 9.9%;
}
.slider .slick-next {
    left: 91.7%;
    position: absolute;
    right: 10px;
}
.box-testimonials {
    margin: 29px 86px 22px 139px;
    padding: 20px;
    background-color: white;
    border-radius: 16px;
}
.box-testimonials .profile-img {
    padding-right: 36px;
    border-right: 4px solid #FFC980;
}
.d-lg-flex {
    display: flex!important;
}
.box-testimonials .icon {
    left: 34px;
    top: 20px;
    position: relative;
    width: 32px!important;
    height: 32px!important;
}
.box-testimonials p {
    margin-top: 70px;
}
.box-testimonials h5 {
    font-size: 16px;
    font-weight: 800!important;
    display: table-footer-group;
}
.mb-3 {
    margin-bottom: 1rem!important;
}
.box-testimonials h6 {
    font-size: 14px;
    font-weight: 500!important;
}
.box-testimonials .testimonial-heading {
    position: relative;
    left: 250px;
    right: 0;
    top: 9px;
}

.box-testimonials p {
    display: inline-block;
    font-size: 18px;
    color: #212322;
}

.d-lg-none{
    display:none;
}

}

/* start mobile version portrait android */
@media screen and (max-width: 600px){
    .slick-next {
    width: 35px!important;
    height: 40px;
}

.slick-prev {
    width: 35px!important;
    height: 35px;
}
    
    .testimonial h2 {
    font-size: 27px!important;
    font-weight: 800;
}

.slider .slick-prev {
    bottom: 57px;
    z-index: 1;
    left: -16px;
}
.box-testimonials {
    margin: 20px!important;
}
.box-testimonials .profile-img {
    text-align: center;
    margin: 0 auto;
    width: 73px;
    height: 93px;
}
.box-testimonials .icon {
    left: 17px;
    width: 15px!important;
    height: 15px!important;
    position: relative;
}
.box-testimonials p {
    border-left: 3px solid #ffc980;
    margin-top: 10px;
    font-size: 16px;
    padding-left: 15px;
}
.box-testimonials .testimonial-heading {
    position: relative;
    left: 17px;
    display: grid;
    top: 5px;
}
.box-testimonials h5 {
    font-weight: 800;
    font-size: 12px;
}
.box-testimonials h6 {
    margin-top: -8px;
    font-size: 10px;
}
.slider .slick-next {
    position: absolute;
    right: -18px;
}
}
/* end mobile version portrait android */

.mb-3 {
    margin-bottom: 1rem!important;
}

@media screen and (min-device-width: 767px) and (max-device-width: 1056px) {

    .box-testimonials .icon {
    left: 0px;
    top: 45px;
    position: relative;
    width: 32px!important;
    height: 32px!important;
}
.box-testimonials .testimonial-heading {
    position: relative;
    left: 0px;
    right: 0;
    top: 10px;
}

.box-testimonials{
margin: 40px 86px 30px 109px;

}
.box-testimonials .profile-img {
    padding-right: 36px;
    text-align: center;
    margin: 0 auto;
border-right: 4px solid #ffffff!important;
}

}

@media only screen 
  and (min-device-width: 320px) 
  and (max-device-width: 480px)
  and (-webkit-min-device-pixel-ratio: 2)
  and (orientation: landscape) {

    .slick-next {
    width: 35px!important;
    height: 40px;
}

.slick-prev {
    width: 35px!important;
    height: 35px;
}

    .d-lg-flex{
        display:inline-block!important;
    }

    .testimonial-heading {
    position:relative!important;
    left: 0px!important;
    right: 100px!important;
    top: 10px!important;
}

.box-testimonials p {
    display: inline-block;
    margin-top: 70px;
}

.box-testimonials .profile-img {
    padding-right: 36px;
    text-align: center;
    margin: 0 auto;
    border-left: 4px solid #FFC980!important;
border-right: 4px solid #ffffff!important;
padding-left: 30px;
}


  }

  @media only screen and (min-device-width: 480px) 
                   and (max-device-width: 1000px) 
                   and (orientation: landscape) {
                    .d-lg-flex{
        display:inline-block!important;
    }

                   }
</style>
