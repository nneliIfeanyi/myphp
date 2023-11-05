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

<a class="" href="teacher/index.php"><i class="fa fa-lock"></i>Admin Login</a>

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


<li><a href="index.php">Home</a></li>
<li><a href="page-about.php">About Us</a></li>
<li><a href="page-about.php#subjects">Curriculumns</a></li>
<li><a href="blog.php">News</a></li>
<li><a href="index.php#contact">Contact Us</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li><a class="btn btn-primary w3-small" href="student/login.php"><i class="fa fa-sign-in"></i> Student Login</a></li>
</ul>
</div>
</div>
</div>
</div>
</header>



<section class="grey section">
<div class="container">
<div class="row">
<div id="content" class="col-md-8 col-sm-8 col-xs-12">

<div class="blog-wrapper">
<div class="row second-bread">
<div class="col-md-6 text-left">
<h1 class="w3-serif w3-text-red w3-small">News Update</h1>
<?php
$sql = "SELECT * FROM blog ORDER BY id DESC";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
$i=1;
while($result = mysqli_fetch_array($query)){


$title = $result['title'];
$body = $result['body'];
?>
<div class="widget">
<div class="widget-title">
<h4><?=$title?></h4>
<p><?=$body?></p>
<hr>
</div>
</div>
<?php
$i++;
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
</div>


</div>
</div>
</div>
</section>


<?php

include 'footer.php';

?>

</div>
<script src="js/jquery.min.js.pagespeed.jm.iDyG3vc4gw.js"></script>
<script src="js/bootstrap.min.js%2bretina.js%2bwow.js.pagespeed.jc.pMrMbVAe_E.js"></script><script>eval(mod_pagespeed_gFRwwUbyVc);</script>
<script>eval(mod_pagespeed_rQwXk4AOUN);</script>
<script>eval(mod_pagespeed_U0OPgGhapl);</script>
<script src="js/carousel.js%2bcustom.js%2bjquery.fitvids.js.pagespeed.jc.ghpaVHFgk4.js"></script><script>eval(mod_pagespeed_6Ja02QZq$f);</script>
<script>eval(mod_pagespeed_KxQMf5X6rF);</script>
<script>eval(mod_pagespeed_ehrgEOlD2f);</script>
<script>$(document).ready(function(){$(".blog-image").fitVids();});</script>
</body>

<!-- blog00  -->
</html>