<section class="careers-home fill-blue-5 space-200-top space-200-bottom">

<div class="container">

<div class="mt-4 mb-4 space-150-bottom">

<h2><?php the_field('add_career_title');?></h2>
<div class="position-absolute">
<img src="https://whitegold.money/cms/../content/cms/we-are-hiring.png"style="width:130px;height:auto;"  class="img-fluid" alt="we-are-hiring">
</div>

</div>
<div class="row">
<div class="columns small-12 large-6">

<div class="position-absolute-star">
<img src="https://whitegold.money/cms/../content/cms/Vector-3.png" style="width:56px;height:auto;" class="img-fluid" alt="star">
</div>

<div class="career-home-box">

<h4><?php the_field('add_career_subtitle');?></h4>
<?php if( have_rows('add_career_descriptions') ): ?>
<ul>
    <?php while( have_rows('add_career_descriptions') ): the_row(); ?>
<li><?php the_sub_field('add_points');?></li>
<?php endwhile; ?>			
</ul>
<?php endif; ?>
<div class="" onclick="window.location='https://whitegold.money/careers/';">
<a href="https://whitegold.money/careers/" aria-label="careers"><a class="btn-custom-primary" aria-label="View Current Openings" href="https://whitegold.money/careers/">View Current Openings</a></a></div>
</div>
</div>

<div class="columns small-12 large-6 custom-career-row text-center mt-sm-40 mt-ls-40 mt--5">
<div class="row mb-1">
    <div class="columns small-4 large-3"><img src="/cms/../content/cms/Img19.png" class="img-fluid img-gap" alt="careerimg1" title="careerimg1"></div>
    <div class="columns small-4 large-3"> <img src="/cms/../content/cms/Img2.png" class="img-fluid img-gap" alt="careerimg2" title="careerimg2"></div>
    <div class="columns small-4 large-3"> <img src="/cms/../content/cms/Img3.png" class="img-fluid img-gap" alt="careerimg3" title="careerimg3"></div>
</div>

<div class="row mb-1">
    <div class="columns small-4 large-3"> <img src="https://whitegold.money/cms/../content/cms/Img4.png" class="img-fluid img-gap" alt="careerimg4" title="careerimg4"></div>
    <div class="columns small-4 large-3"> <img src="https://whitegold.money/cms/../content/cms/Img5.png" class="img-fluid img-gap" alt="careerimg5" title="careerimg5"></div>
    <div class="columns small-4 large-3"> <img src="https://whitegold.money/cms/../content/cms/Img6.png" class="img-fluid img-gap" alt="careerimg6" title="careerimg6"></div>
</div>

<div class="row mb-1">
    <div class="columns small-4 large-3"> <img src="https://whitegold.money/cms/../content/cms/Img7.png" class="img-fluid img-gap" alt="careerimg7" title="careerimg7"></div>
    <div class="columns small-4 large-3"> <img src="https://whitegold.money/cms/../content/cms/Img8.png" class="img-fluid img-gap" alt="careerimg8" title="careerimg8"></div>
    <div class="columns small-4 large-3"> <img src="https://whitegold.money/cms/../content/cms/Img1.png" class="img-fluid img-gap" alt="careerimg9" title="careerimg9"></div>
</div>



</div>

</div>

</div>

</section>



<style>
/* home career section css starts */
.mt-40{
margin-top:40px;

}
.position-absolute-star{

position: absolute;
left: -3.7%;
top: 10%;
}


.career-home-box{
border-right: 6px solid #012C8C;
border-bottom: 6px solid #012C8C;
border-radius: 20px;
padding: 39px 30px 47px 30px;
background-color: #1E50CC;



}
.careers-home h2{
font-weight:800;
font-size:34.5px;
}

.career-home-box ul li{
list-style:none;
padding-left: 20px;
position: relative;
color: #ffffffe6;
font-size:16px;
}


.career-home-box ul li:before{
 color: #FFC980;
    font-family: 'FontAwesome';
    content: "\f00c";
    background-color: #012c8c00;
    border-radius: 46px;
    font-weight: 300;
    padding: 4px 0px 0px 3px;
    font-size: 7px;
    position: absolute;
    top: 1px;
    left: 0px;
    width: 15px;
    height: 15px;
    line-height: 7px;
    border: 1px solid #FFC980;
}

.career-home-box ul{
margin-bottom: 22px;
    margin-top: 22px;
}

.career-home-box .btn-custom-primary {
    font-size: 14px;
    color: #0032A0!important;
    background-color: white;
    border-radius: 7px;
    text-decoration: none!important;
    font-weight: 700;
    padding: 14px 15px 13px 15px;
position:relative;
}
.career-home-box h4{

font-weight: 700;
    font-size: 22px;
    line-height: 27.6px;
}

 @media only screen and (max-width: 600px) {

.careers-home .position-absolute-star{
position: absolute;
left: -10.7%;
top: 10%;

}



.careers-home h2 {
    font-weight: 800;
    font-size: 35px;
}

.careers-home .position-absolute{
position: absolute;
    top: 5%;
    bottom: 0px;
    left: 26%;

}


.mt-sm-50{
margin-top:60px;
}

.mt-sm-40{
margin-top:40px;

}


}


.img-gap{
padding: 5px;

}

.position-absolute{
position: absolute;
    top: -3%;
    bottom: 0;
    left: 36.5%;
}

@media (min-width: 1480px){

.career-home-box .btn-custom-primary {
    font-size: 20px;
    padding: 17px 15px 17px 15px;
    position: relative;
}




.career-home-box {
    border-radius: 20px;
    padding: 60px 30px 60px 30px;
    background-color: #1E50CC;
}

.career-home-box h4 {
    font-weight: 700;
    font-size: 32px;
    line-height: 27.6px;
}
.career-home-box ul li {
    font-size: 22px!important;
}

.career-home-box ul li:before {
    font-weight: 300;
    padding: 6px 0px 0px 5px;
    font-size: 10px;
    position: absolute;
    top: 4px;
    left: -7px;
    width: 20px;
    height: 20px;
}



.position-absolute {
    position: absolute;
    top: -3%;
    bottom: 0;
    left: 25.5%;
}

.position-absolute-star {
    position: absolute;
    left: -2.7%;
    top: 10%;
}

.career-home-box ul li {
    font-size: 16px;
}


}

@media only screen and (min-device-width: 480px) 
                   and (max-device-width: 1000px) 
                   and (orientation: landscape) {

.mt-ls-40{
margin-top:40px;
}


.position-absolute {
    position: absolute;
    top: -1%;
    bottom: 0;
    left: 61%;
}

.position-absolute-star {
    position: absolute;
    left: -6.7%;
    top: 4%;
}

}


@media only screen 
  and (min-device-width: 320px) 
  and (max-device-width: 480px)
  and (-webkit-min-device-pixel-ratio: 2)
  and (orientation: landscape) {

.mt-ls-40{
margin-top:40px;
}


.position-absolute {
    position: absolute;
    top: -1%;
    bottom: 0;
    left: 61%;
}

.position-absolute-star {
    position: absolute;
    left: -6.7%;
    top: 4%;
}

}


@media only screen and (min-width: 1080px){
.mt--5{

margin-top:-10px;
}

/* home career section css ends */
</style>






