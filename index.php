<?php
session_start();
include 'config.php';


?>


<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="CPM International School, Glory Land Academy">
<meta name="author" content="Stanvic Concepts">
<meta name="keywords" content="CPM International School, Glory Land Academy, Best School in Suleja">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
<link rel="apple-touch-icon" href="images/apple-touch-icon.png"/>
<link rel="apple-touch-icon" sizes="57x57" href="images/apple-touch-icon-57x57.png"/>
<link rel="apple-touch-icon" sizes="72x72" href="images/xapple-touch-icon-72x72.png.pagespeed.ic.lf5d8kCpOf.png"/>
<link rel="apple-touch-icon" sizes="76x76" href="images/xapple-touch-icon-76x76.png.pagespeed.ic.ATZZpSeito.png"/>
<link rel="apple-touch-icon" sizes="114x114" href="images/xapple-touch-icon-114x114.png.pagespeed.ic.Fi5O5s2tzL.png"/>
<link rel="apple-touch-icon" sizes="120x120" href="images/xapple-touch-icon-120x120.png.pagespeed.ic.uPQH0sygdV.png"/>
<link rel="apple-touch-icon" sizes="144x144" href="images/xapple-touch-icon-144x144.png.pagespeed.ic.yZ9-_sm5OF.png"/>
<link rel="apple-touch-icon" sizes="152x152" href="images/xapple-touch-icon-152x152.png.pagespeed.ic.gThaVrKtXF.png"/>
<link rel="apple-touch-icon" sizes="180x180" href="images/xapple-touch-icon-180x180.png.pagespeed.ic.Q8Pmsj5fQM.png"/>
<link rel="stylesheet" type="text/css" href="rs-plugin/css/A.settings.css.pagespeed.cf.xeOyGChsgq.css" media="screen"/>

<link rel="stylesheet" type="text/css" href="A.fonts%2c%2c_font-awesome-4.3.0%2c%2c_css%2c%2c_font-awesome.min.css%2bcss%2c%2c_bootstrap.css%2bcss%2c%2c_animate.css%2cMcc.kSNwpaaMDX.css.pagespeed.cf.w2G3xGgFf0.css"/>

<link rel="stylesheet" type="text/css" href="css/A.menu.css.pagespeed.cf.0_hLwXzYkZ.css">
<link rel="stylesheet" type="text/css" href="css/A.carousel.css%2bbxslider.css%2cMcc.jgeTii-u52.css.pagespeed.cf.STKSIMl7GF.css"/>
<link rel="stylesheet" type="text/css" href="A.style.css%2bcss%2c%2c_custom.css%2cMcc.HvWh1qoob-.css.pagespeed.cf.pWH5huNcWh.css"/>
<link rel="stylesheet" type="text/css" href="css/w3.css"/>
<title>Welcome to CPM International School</title>
</head>
<body style="scroll-behavior:smooth !important;">
<div id="loader">
<div class="loader-container">
<img src="images/site.gif" alt="" class="loader-site">
</div>
</div>

<div id="wrapper">
<div class="topbar">
<div class="container">
<div class="row">
<div class="col-md-6 text-left">
<p><i class="fa fa-graduation-cap"></i>Best learning environment.</p>
</div>
<div class="col-md-6 text-right">
<ul class="list-inline">

<li class="dropdown">
<a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-lock"></i>Admin Login</a>
<div class="dropdown-menu">
<form method="post" action="admin/login.php">
<div class="form-title">
<h4>Login Area</h4>
<hr>
</div>
<input class="form-control" type="text" name="username" placeholder="User Name">
<div class="formpassword">
<input class="form-control" type="password" name="password" placeholder="******">
</div>
<div class="clearfix"></div>
<input type="submit" name="submit" class="btn btn-block btn-primary" value="Login">
<hr>

</form>
</div>
</li>
</ul>
</div>
</div>
</div>
</div>


<header class="header">
<div class="container">
<div class="hovermenu ttmenu">
<div class="navbar navbar-default" role="navigation">

<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
<span class="sr-only">Toggle navigation</span>
<span class="fa fa-bars"></span>
</button>
<div class="logo">
<a class="navbar-brand" href="index.php">
      <i class="fa fa-graduation-cap" style="color:red;"></i>
      <span class="w3-large w3-text-blue w3-serif">C.P.M. <span class="w3-cursive w3-medium">International School</span></span>
</a>
</div>
</div>

<div class="navbar-collapse collapse">
<ul class="nav navbar-nav">


<li><a href="#">Home</a></li>
<li><a href="page-about.php">About Us</a></li>
<li><a href="page-about.php#subjects">Curriculumns</a></li>
<li><a href="blog.php">News</a></li>
<li><a href="index.php#contact">Contact Us</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li><a class="btn btn-primary w3-small" href="login.php"><i class="fa fa-sign-in"></i> Student Login</a></li>
</ul>
</div>
</div>
</div>
</div>
</header>



<div class="row">

<div class="col-md-12">
<div class="media-element">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
<div class="carousel-inner" role="listbox">
<div class="item active">
<img src="img/edit.jpg" alt="" width="100%;" class="img-responsive">
</div>
<div class="item">
<img src="img/edit5.jpg" alt=""  width="100%;" class="img-responsive">
</div>
<div class="item">
<img src="img/edit4.jpg" alt=""  width="100%;" class="img-responsive">
</div>
</div>
<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
<span class="fa fa-angle-left" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
<span class="fa fa-angle-right" aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>
</div>
</div>
</div>



<div class="container">

      <!--=== WELCOME ADDRESS ===-->
<div class="w3-row-">
<div class="section-title text-center">

<div class="w3-half">
<img src="img/badge_.png" width="60%" style="border-radius:10%;height: 150px;" class="w3-image" />
</div>
<div class="w3-half">
<h4><span class="w3-tiny">a.k.a</span>Glory Land Academy</h4>
<p>Welcomes all tribes, religion and nationality to be part of this noble vision. We are dedicated to giving quality and sound education without any track out of their life time. We are glad you are here, and we promise to meet up to your expectations. <br />Once again you are welcome!
</p>
</div>
</div>
</div>

</div>



<div class="row-fluid">

<div class="container">
<div class="row">
<div class="col-md-6 col-md-offset-6">
<div class="section-container nopadding">
<div class="textrotate">
<ul class="bxslider">

<li class="">
<div class="big-title">
<h3><i class="fa fa-user"></i> <span>WHO</span> WE ARE</h3>
</div>
<p>We are a co-education mission<br> school that welcomes any student<br> interested in exploring and soaring<br>the fields of academic and moral excellence.</p>
</li>

<li>
<div class="big-title">
<h3><i class="fa fa-eye"></i> <span>OUR</span> VISSION</h3>
<div class="border-title"></div>
</div>
<p>To ensure a solid foundation in <br>education and moral training in the<br> fear of God.</p>
</li>

<li>
<div class="big-title">
<h3><i class="fa fa-bullseye"></i> <span>OUR</span> MISSION</h3>
<div class="border-title"></div>
</div>
<p>We aim to develop well rounded and <br>thoughtful students prepared to cope<br> with a changing post-modern world and <br>globalized world.</p>
</li>
<div class="w3-center"><a href="page-about.php" class="btn btn-default" title="About Us">Learn More</a></div>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>






<!--=== FACILITY SECTIONS ===-->


<section class="grey section">
<div class="row-fluid">
<div class="col-md-6 myimg"></div>
<div class="container">
<div class="row">
<div class="col-md-6 col-md-offset-6">
<div class="section-container nopadding">
<div class="textrotate">
<ul class="bxslider">

<li>
<div class="big-title">
<p class="lead w3-red w3-tag"><b>Our Facilities</b></p>
<h3 class="w3-large"><b>Kid's Playground</b></h3>
<div class="border-title"></div>
</div>
<img src="img/edit10.jpg" alt="">
</li>

<li>
<div class="big-title">
<p class="lead w3-red w3-tag"><b>Our Facilities</b></p>
<h3 class="w3-large"><b>Science Labouratory</b></h3>
<div class="border-title"></div>
</div>
<img src="img/edit6.jpg" alt="">
</li>
<li>
<div class="big-title">
<p class="lead w3-red w3-tag"><b>Our Facilities</b></p>
<h3 class="w3-large"><b>Computer Lab | ICT Unit</b></h3>
<div class="border-title"></div>
</div>
<img src="img/edit8.jpg" alt="">
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</section>





<!--=== PAST EVENTS SECTION ===-->
<section class="section darkskin fullscreen paralbackground parallax" style="background-image:url(img/edit.jpg)" data-img-width="1627" data-img-height="868" data-diff="100">

<div class="overlay"></div>
<div>
<div class="row">
<div class="col-md-12">
<div class="section-title text-center">
<h4>OUR PAST EVENTS</h4>
<p>We Shared Awesome times together exploring places...</p>
</div>
</div>
</div>
<div class="row service-center" style="margin-left:17px ;">
<div class="col-md-4 col-sm-6">
<div class="feature-list" style="margin-bottom:40px;">
 <img src="img/edit12.jpg" width="100%" height="200px" style="margin-bottom:15px; border-radius:10%;" />
<p class="w3-medium">Abuja International Airport</p>
<p></p>
</div>
</div>

<div class="col-md-4 col-sm-6">
<div class="feature-list" style="margin-bottom:40px;">
<img src="img/edit13.jpg" width="104%" height="200px" style="margin-bottom:15px; border-radius:10%;" />
<p class="w3-medium">National Assembly</p>
<p></p>
</div>
</div>

<div class="col-md-4 col-sm-6">
<div class="feature-list">
 <img src="img/edit11.jpg" width="100%" height="200px" style="margin-bottom:15px; border-radius:10%;" />
<p class="w3-medium">End of year party 2011</p>
<p></p>
</div>
</div>
</div>
</div>
</section>

<!--=== THE BLOG SECTION ==-->

<section class="grey section">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="section-title text-center">
<h4 class="w3-medium">From The Blog</h4>
<p class="w3-xlarge"><b>RECENT NEWS AND UPCOMING EVENTS</b></p>
</div>
</div>
</div>
<div class="row blog-widget">


<?php
$sql = "SELECT * FROM blog ORDER BY id DESC LIMIT 2";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {

while($result = mysqli_fetch_array($query)){


$title = $result['title'];
$body = $result['body'];
?>
<div class="col-md-4 col-sm-6">
<div class="blog-wrapper">
<div class="blog-title">
<p class="category_title" title=""><?=$title?></p>
<p><?=$body?></p>
</div>
</div>
</div>

<?php

}
}else{
?>
<div class="widget">
<div class="widget-title">
<h4 class="w3-tag w3-red">No Posts found.</h4>
<hr>
</div>
</div>
<?php
}
?>

</div>
</div>
</section>




<!--=== TEAMS ===-->
<section class="white section">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="section-title text-center">
<h4>Meet Our Team</h4>
<p>We teach/build with care and love</p>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="content-widget">
<div class="team-members row">
<div class="col-md-3 col-sm-6 col-xs-12">
<div class="team">
<img src="img/edit16.jpg" width="70%" height="240px" alt="" class="wow fadeInUp">
<div class="team-hover-content">
<h5>Principal</h5>
<span></span>
<p></p>
</div>
</div>
</div>

<div class="col-md-3 col-sm-6 col-xs-12">
<div class="team">
<img src="img/edit20.jpg" width="70%" height="220px" alt="" class="wow fadeInUp">
<div class="team-hover-content">
<h5>Leadership</h5>
<span></span>
<p></p>
</div>
</div>
</div>


<div class="col-md-3 col-sm-6 col-xs-12">
<div class="team">
<img src="" width="70%" height="220px" alt="" class="wow fadeInUp">
<div class="team-hover-content">
<h5>Name</h5>
<span></span>
<p></p>
</div>
</div>
</div>

<div class="col-md-3 col-sm-6 col-xs-12">
<div class="team">
<img src="" width="70%" height="220px" alt="" class="wow fadeInUp">
<div class="team-hover-content">
<h5>Name</h5>
<span></span>
<p></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>


<style type="text/css">

.contents img{
  width: 100%;
  border-radius: 10px;
  transition: all .7s ease-out;
}

.contents img:hover{
  transform: scale(1.1) !important;
  margin: 0 10px !important;
}
</style>



<div class="container contents">
<div class="row">
<div class="col-md-12">
<div class="section-title text-center">
<h4>Photo Gallery</h4>
<p></p>
</div>
</div>
</div>

<div id="owl-featured" class="owl-custom">
<div class="owl-featured">
<div class="shop-item-list ">
<div class="">
<img src="img/edit19.jpg" width="100%" height="100px" alt="">
<div class="magnifier">
</div>
</div>
</div>
</div>

<div class="owl-featured">
<div class="shop-item-list ">
<div class="">
<img src="img/edit17.jpg" width="100%" height="100px" alt="">
<div class="magnifier">
</div>
</div>
</div>
</div>


<div class="owl-featured">
<div class="shop-item-list ">
<div class="">
<img src="img/edit15.jpg" width="100%" height="100px" alt="">
<div class="magnifier">
</div>
</div>
</div>
</div>


<div class="owl-featured">
<div class="shop-item-list ">
<div class="">
<img src="img/edit4.jpg" width="100%" height="100px" alt="">
<div class="magnifier">
</div>
</div>
</div>
</div>

<div class="owl-featured">
<div class="shop-item-list ">
<div class="">
<img src="img/edit2.jpg" width="100%" height="100px" alt="">
<div class="magnifier">
</div>
</div>
</div>
</div>

<div class="owl-featured">
<div class="shop-item-list ">
<div class="">
<img src="img/edit18.jpg" width="100%" height="100px" alt="">
<div class="magnifier">
</div>
</div>
</div>
</div>

<div class="owl-featured">
<div class="shop-item-list ">
<div class="">
<img src="img/edit3.jpg" width="100%" height="100px" alt="">
<div class="magnifier">
</div>
</div>


</div>
</div>

</div>
</div>

<?php

include 'footer.php';

?>

</div>
      <script src="js/jquery.min.js.pagespeed.jm.iDyG3vc4gw.js"></script>
      <script src="js/bootstrap.min.js%2bretina.js%2bwow.js.pagespeed.jc.pMrMbVAe_E.js"></script><script>eval(mod_pagespeed_gFRwwUbyVc);</script>
      <script>eval(mod_pagespeed_U0OPgGhapl);</script>
      <script src="js/carousel.js%2bcustom.js.pagespeed.jc.nVhk-UfDsv.js"></script><script>eval(mod_pagespeed_6Ja02QZq$f);</script>
      <script>eval(mod_pagespeed_KxQMf5X6rF);</script>
      <script src="rs-plugin/js/jquery.themepunch.tools.min.js.pagespeed.jm.0PLSBOOLZa.js"></script>
      <script src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
      <script>jQuery(document).ready(function(){jQuery('.tp-banner').show().revolution({dottedOverlay:"none",delay:16000,startwidth:1170,startheight:620,hideThumbs:200,thumbWidth:100,thumbHeight:50,thumbAmount:5,navigationType:"none",navigationArrows:"solo",navigationStyle:"preview3",touchenabled:"on",onHoverStop:"on",swipe_velocity:0.7,swipe_min_touches:1,swipe_max_touches:1,drag_block_vertical:false,parallax:"mouse",parallaxBgFreeze:"on",parallaxLevels:[10,7,4,3,2,5,4,3,2,1],parallaxDisableOnMobile:"off",keyboardNavigation:"off",navigationHAlign:"center",navigationVAlign:"bottom",navigationHOffset:0,navigationVOffset:20,soloArrowLeftHalign:"left",soloArrowLeftValign:"center",soloArrowLeftHOffset:20,soloArrowLeftVOffset:0,soloArrowRightHalign:"right",soloArrowRightValign:"center",soloArrowRightHOffset:20,soloArrowRightVOffset:0,shadow:0,fullWidth:"on",fullScreen:"off",spinner:"spinner4",stopLoop:"off",stopAfterLoops:-1,stopAtSlide:-1,shuffle:"off",autoHeight:"off",forceFullWidth:"off",hideThumbsOnMobile:"off",hideNavDelayOnMobile:1500,hideBulletsOnMobile:"off",hideArrowsOnMobile:"off",hideThumbsUnderResolution:0,hideSliderAtLimit:0,hideCaptionAtLimit:0,hideAllCaptionAtLilmit:0,startWithSlide:0,fullScreenOffsetContainer:""});});</script>
      <script src="js/bxslider.js.pagespeed.jm.X-sF7YFq4Y.js"></script>
      <script type="text/javascript">(function($){"use strict";$('.bxslider').bxSlider({mode:'vertical',minSlides:1,maxSlides:1,slideMargin:0,pager:false,nextText:'<i class="fa fa-arrow-down"></i>',prevText:'<i class="fa fa-arrow-up"></i>',speed:1000,auto:true});})(jQuery);</script>
      </body>
</html>