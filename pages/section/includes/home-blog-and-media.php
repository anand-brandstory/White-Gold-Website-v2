<section class="fill-neutral-1 space-200-top space-200-bottom home-blog-and-media d-none d-md-block">
<div class="container">
    <div class="text-center mt-5 mb-5"><h2>Want to know more?</h2></div>
    <div class="text-center">
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'media')" id="defaultOpen">Media</button>
  <button class="tablinks" onclick="openCity(event, 'blogs')">Blogs</button>
</div></div>

<div id="media" class="tabcontent mt-5">
<div class="container">
<div class="row">
<div class="blog-grid-inner">
<?php
$repeater_field = get_field('add_articles', 2465);
if ($repeater_field) {
    $limited_rows = array_slice($repeater_field, 0, 3);
    foreach ($limited_rows as $row) {
        $sub_field_value_1 = $row['add_image'];
        $sub_field_value_2 = $row['add_title'];
        $sub_field_value_3 = $row['add_news_souce'];
        $sub_field_value_4 = $row['posted_date'];
        $sub_field_value_5 = $row['add_link'];
        // Display the sub-field values in the desired location
       ?>


<div class="columns small-12 large-4 pd-10 mb-4">
  
  <a rel="nofollow" href="<?php echo $sub_field_value_5;?>">
       <img src="<?php echo $sub_field_value_1;?>" class="img-fluid" alt="<?php echo $sub_field_value_2;?>" title="<?php echo $sub_field_value_2;?>"></a>


       <a rel="nofollow" class="mb--5" href="<?php echo $sub_field_value_5;?>" target="_blank">
 <div class="mb-4 mt-4 except" href="<?php echo $sub_field_value_5;?>" target="_blank">
 <?php echo $sub_field_value_2;?></div></a>

 <div class="">
<p class="author-name"><?php echo $sub_field_value_3;?></p>
<p class="col-o mt-2 "><?php echo $sub_field_value_4;?></p>
</div>
       </div> 
       <?php
    }

}
?>
</div></div></div>
<div class="text-center"><a href="/news-and-articles">
<div class="button fill-neutral-2">Show More</div></a></div>


</div>

<div id="blogs" class="tabcontent mt-3">
 
<?php 
$wpb_all_query = new WP_Query(array(
                        'post_type'=>'post',
                        'post_status' => 'publish',
                        'posts_per_page'=> 3,
                        'orderby' => 'date',
                        'order' => 'DESC',
                    )); ?>
                    <?php if ( $wpb_all_query->have_posts() ) : ?>
<section class="blog-grid space-100-top space-200-bottom bg-dark-grey items">
    <div class="container">
        <div class="row">
        <div class="blog-grid-inner">
        <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
<div class="columns small-12 large-4 pd-10 mb-4">
<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
<div class="d-flex mb-4 justify-content-between align-items-center mt-4">
<h6><?php the_category(); ?></h6>
<p class="time-text">5min read</p>
</div>
<a href="<?php the_permalink(); ?>"><div class="except">
<?php the_title(); ?></div></a>
<div class="d-flex-all mt-2">
<p class="author-name mb-3"><?php the_field('add_short_content');
	?><span class="bg-light-grey f-500">Read More..</span></p>
</div>
</div></a>
<?php endwhile; ?></div>
<div class="text-center mt-5"><a href="/blog">
<div class="button fill-neutral-2">Show More</div></a></div>
</div>
</div></div>
</div>
                  </section> <?php endif; ?>
                  

</div>
</section>


<section class="fill-neutral-1 space-200-top space-200-bottom home-blog-and-media d-lg-none">
<div class="container">
    <div class="text-center mt-5 mb-5"><h2>Want to know more?</h2></div>
    <div class="text-center">
<div class="tab">
  <button class="tablinksm" onclick="openCitym(event, 'mediam')" id="defaultOpen1">Media</button>
  <button class="tablinksm" onclick="openCitym(event, 'blogsm')">Blogs</button>
</div></div>

<div id="mediam" class="tabcontentm mt-5">
<div class="container">
<div class="row">
<div class="blog-grid-inner"><div class="swiper sample-slider">
<div class="swiper-wrapper">
<?php
$repeater_field = get_field('add_articles', 2465);
if ($repeater_field) {
    $limited_rows = array_slice($repeater_field, 0, 6);
    foreach ($limited_rows as $row) {
        $sub_field_value_1 = $row['add_image'];
        $sub_field_value_2 = $row['add_title'];
        $sub_field_value_3 = $row['add_news_souce'];
        $sub_field_value_4 = $row['posted_date'];
        $sub_field_value_5 = $row['add_link'];
        // Display the sub-field values in the desired location
       ?>

<div class="swiper-slide">  
<div class="columns small-12 large-4 pb-30p">
  
  <a rel="nofollow" href="<?php echo $sub_field_value_5;?>">
       <img src="<?php echo $sub_field_value_1;?>" class="img-fluid" alt="<?php echo $sub_field_value_2;?>" title="<?php echo $sub_field_value_2;?>"></a>


       <a rel="nofollow" class="mb--5" href="<?php echo $sub_field_value_5;?>" target="_blank">
 <div class="mb-4 mt-4 except" rel="nofollow" href="<?php echo $sub_field_value_5;?>" target="_blank">
 <?php echo $sub_field_value_2;?></div></a>

 <div class="">
<p class="author-name"><?php echo $sub_field_value_3;?></p>
<p class="col-o mt-2 "><?php echo $sub_field_value_4;?></p>
</div>
 </div> </div>
       <?php
    }

}
?></div>
<div class="swiper-button-prev">
    <img src="/content/cms/arrow-left.png" alt="arrow-left">    
</div>
<div class="swiper-button-next">
    <img src="/content/cms/arrow-right.png" alt="arrow-right">  
</div>
</div></div></div></div>
<div class="text-center"><a href="/news-and-articles">
<div class="button fill-neutral-2">Show More</div></a></div>


</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<div id="blogsm" class="tabcontentm mt-3">
 
<?php 
$wpb_all_query = new WP_Query(array(
                        'post_type'=>'post',
                        'post_status' => 'publish',
                        'posts_per_page'=> 6,
                        'orderby' => 'date',
                        'order' => 'DESC',
                    )); ?>
                    <?php if ( $wpb_all_query->have_posts() ) : ?>
<section class="blog-grid space-100-top space-200-bottom bg-dark-grey items">
    <div class="container">
        <div class="row">
        
        <div class="blog-grid-inner">
        <div class="swiper sample-slider">
        <div class="swiper-wrapper">
        <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
        <div class="swiper-slide">   
<div class="columns small-12 large-4 pb-30p">
<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
<div class="d-flex mb-4 justify-content-between align-items-center mt-4">
<h6><?php the_category(); ?></h6>
<p class="time-text mt-2">5min read</p>
</div>
<a href="<?php the_permalink(); ?>"><div class="except">
<?php the_title(); ?></div>
<div class="d-flex-all mt-2">
<p class="author-name mb-3"><?php the_field('add_short_content');
	?><span class="bg-light-grey f-500">Read More..</span></p>
</div>
</div></div></a>

<?php endwhile; ?>
    </div> 
    <div class="swiper-button-prev">
    <img src="/content/cms/arrow-left.png" alt="arrow-left">    <!--added-->
</div>
<div class="swiper-button-next">
    <img src="/content/cms/arrow-right.png" alt="arrow-right">   <!--added-->
</div>
</div></div>

<div class="text-center mt--20"><a href="/blog">
<div class="button fill-neutral-2">Show More</div></a></div>
</div>
</div></div>
</div>
                  </section> <?php endif; ?>
                  

</div>
</section>

<script>
    var swiper = new Swiper('.sample-slider', {
      loop: true,
      spaceBetween: 20,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        480: {
            slidesPerView: 1,
            spaceBetween: 20,
          },
          640: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          768: {
            slidesPerView: 2,
            spaceBetween: 40,
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 50,
          },
        }
      
    });
</script>

<style>
    /* home blog and media css STARTS */
.f-500{font-weight:500;}
    .bg-light-grey{
color:#000000;
opacity: 0.5;

    }
    .mt--6{
        margin-top: -6px;
    }
    .mt--20{
        margin-top: -20px;
    }
.pb-30p{
    padding-bottom: 30%;
}

 /*hide default arrows*/
 .sample-slider [class^="swiper-button-"]::after{
        content: "";
    }
    /*adjust arrow size*/
    .sample-slider [class^="swiper-button-"]{
        width: 55px;
        height: 55px;
    }
    /*adjust arrow position*/
    .sample-slider .swiper-button-next{
        top: 84%;
        right: 115px;
    }
    .sample-slider .swiper-button-prev{
        top: 84%;
        left: 115px;
    }
.home-blog-and-media h2 {
    font-size: 32px;
    font-weight: 800;
}
.blog-grid-inner img{
  border-radius:8px;
}
.home-blog-and-media .blog-grid-inner .author-name {
  display:block;
    padding-left: 0px;
}


.home-blog-and-media .blog-grid img {
    border-radius: 8px;
}
/* Style the tab */

.home-blog-and-media .time-text{
        line-height: 32px!important;
    }

    /* blog list style starts */
    .home-blog-and-media .blog-grid a{
        text-decoration:none;
    }

    .home-blog-and-media .d-flex-all{

        display:flex!important;
    }
    .home-blog-and-media .blog-grid-inner .justify-content-between {
    justify-content: space-between!important;
}

    .bg-dark-grey{
  background-color: #E9E9E7;
}

    /* blog list style ends */
    

    .home-blog-and-media .geeks {
    text-align: center;
    overflow: hidden;
    background-color: #FFC980;
    position: relative;
}
.home-blog-and-media .geeks a {
    text-decoration: none;
    color: #0032A0;
    padding: 14px 16px;
    font-size: 16px;
    display: block;
}
.home-blog-and-media .geeks a.icon {
    display: block;
    position: absolute;
    right: 33%;
    top: 0;
}


/* banner section style starts */
.home-blog-and-media .blog-listing .slider-banner p {
    color: white;
    padding-bottom: 33%;
    font-size: 18px!important;
}

.home-blog-and-media .blog-listing .slider-banner h1 {
    font-size: 42px;
    font-weight: 800;
   
}

/* banner section style ends */

.home-blog-and-media .duration::before{
	top: -2px;
    position: relative;
	padding-right: 13px;
    content: url(https://whitegold.money/cms/../content/cms/Vector.svg);
    padding-left: 19px;
}


.home-blog-and-media .time-text::before{
	position: relative;
    content: url(https://whitegold.money/cms/../content/cms/fa-solid_book-open.svg);
    right: 7px;
    top: 2px;

}
.home-blog-and-media .blog-grid-inner .author-name {
    padding-top: 4px;
    padding-left: 0px;
}

.home-blog-and-media .blog-grid-inner .except {
	font-size:20px;
    font-weight: 700;
}

.home-blog-and-media .except::after{
	position: relative;
    content: url(https://whitegold.money/cms/../content/cms/charm_arrow-right.svg);
    left: 5px;
    top: 3px;
}

.home-blog-and-media .time-text{
	float:right;
}
	
.home-blog-and-media .blog-grid-inner .author-name {
    padding-left: 0px;
}

.home-blog-and-media .blog-grid-inner h6 {
    margin: 0 auto;
    text-align: center;
    line-height: 8px;
    display: inline-flex;
    background-color: #B3D4FC;
    padding: 7px;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 600;
    color: #0032A0;
    width: 119px;
    height: 38px;
}
.home-blog-and-media .blog-grid-inner .post-categories{
    margin:0 auto;
    list-style:none;
}


.home-blog-and-media .tags{
	display: unset;
    margin-left: 10px;
}

.home-blog-and-media .date{
	margin-left: auto;
}

.home-blog-and-media .blog-detail-box .fa{
	margin-top: -4px;
	font-size:24px;
color:#0032A0;
padding-right: 14px;
margin-left: auto;

}

.home-blog-and-media .author{
		padding-left: 15px;
	}
.home-blog-and-media .logo-company{
	width: 50px;
    height: 50px;
}

.home-blog-and-media .blog-detail-box{
	border-radius: 16px;
	background-color:white;
	padding:20px;
}

.home-blog-and-media .bg-grey2{
	background-color:#F1F1F1;
}

.home-blog-and-media .blog-detail-box .category{
	display: table-cell;
	background-color: #FFC980;
    padding: 7px 15px 7px 15px;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 600;
    color: #0032A0;
}
.home-blog-and-media .blog-detail-box .category .post-categories{
	background-color: #FFC980;
    padding: 7px;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 600;
    color: #0032A0;
	list-style:none;
}
@media screen and (max-width:767px){

  .home-blog-and-media .tabcontent {
    display: none;
    padding: 0px!important;
    border-top: none;
}
}
@media (max-width: 600px){
    /* banner css for mobile starts */

    .home-blog-and-media .blog-grid .container {
    max-width: 380px;
}
.home-blog-and-media .blog-listing .slider-banner p {
    color: white;
    padding-bottom: 12%!important;
}
.home-blog-and-media .blog-detail-box .fa {
    font-size: 16px;  
}
.home-blog-and-media .date {
    float: right;
}
}

@media only screen and (min-device-width: 480px) 
                   and (max-device-width: 1000px) 
                   and (orientation: landscape) {


                    .home-blog-and-media .blog-listing .slider-banner p {
    color: white;
    padding-bottom: 3%;
    font-size: 18px!important;
}

.home-blog-and-media .date {float: right;}
	   }

	   @media only screen 
  and (min-device-width: 320px) 
  and (max-device-width: 480px)
  and (-webkit-min-device-pixel-ratio: 2)
  and (orientation: landscape) {
    

	.home-blog-and-media .date {float: right;}


  }

.home-blog-and-media .tab {
  overflow: hidden;
  display: flex;
  justify-content: center;
  background-color: #e9e9e7;
}

/* Style the buttons inside the tab */
.home-blog-and-media .tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 2px 26px;
  transition: 0.3s;
  font-size: 17px;
  color: black;
  margin-left: 10px;
}

/* Change background color of buttons on hover */
.home-blog-and-media .tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.home-blog-and-media .tab button.active {
    background-color: #fff;
}

/* Style the tab content */
.home-blog-and-media .tabcontent {
  display: none;
  padding: 6px 12px;
  border-top: none;
}
   /* home blog and media css END*/

</style>


<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();
</script>
<script>
function openCitym(evt, cityNamem) {
  var i, tabcontentm, tablinksm;
  tabcontentm = document.getElementsByClassName("tabcontentm");
  for (i = 0; i < tabcontentm.length; i++) {
    tabcontentm[i].style.display = "none";
  }
  tablinksm = document.getElementsByClassName("tablinksm");
  for (i = 0; i < tablinksm.length; i++) {
    tablinksm[i].className = tablinksm[i].className.replace(" active", "");
  }
  document.getElementById(cityNamem).style.display = "block";
  evt.currentTarget.className += " active";
}

document.getElementById("defaultOpen1").click();
</script>
