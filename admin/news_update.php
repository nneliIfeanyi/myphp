<?php
session_start();
include '../config.php';
include '../functions.php';
if(isset($_SESSION['username'])){
  $username = $_SESSION['username'];
  $titleErr = $bodyErr = $msg1 = $msg2 ='';

  if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($conn, htmlspecialchars($_POST['title'], ENT_QUOTES, 'utf-8'));
    $body =mysqli_real_escape_string($conn, htmlspecialchars($_POST['body'], ENT_QUOTES, 'utf-8'));

    if (empty($title)) {

        $titleErr = "<div class='error' style='width:70%;font-size:16px;'>
                         This field is required.
                     </div>";
    }elseif(empty($body)){
        $bodyErr = "<div class='error' style='width:70%;font-size:16px;'>
                        You must include this field!
                    </div>";
    }else{

      $sql= "INSERT INTO blog (title,body) VALUES ('$title','$body')";

      $result = mysqli_query($conn, $sql);

      if ($result) {
          
          $msg1 = "<div class='w3-green w3-padding-small w3-round-large' style='width:70%;margin-left:20px;'>
                      Successfull
                      <span><i class='fa fa-spinner w3-text-light-grey w3-large fa-spin fa-fw'></i></span>
                      <meta http-equiv='refresh' content='3; news_update.php'>
                   </div>";
      }
      else{
          $msg2 = "<div class='w3-red w3-padding-small w3-round-large' style='width:70%;margin-left:20px;'>
                      An error occured.
                      <span><i class='fa fa-spinner w3-text-light-grey w3-large fa-spin fa-fw'></i></span>
                      <meta http-equiv='refresh' content='3; dashboard.php'>
                   </div>";
      }

    }
  }
  require 'header.php';
?>
<!-- body starts -->
<body class="bg-image w3-serif" style="height:100vh;overflow-y: scroll;color: antiquewhite;">
   <section class="w3-margin w3-padding" style="background:rgba(0, 0, 0, 0.8);">
    <div class="w3-row">
      <div class="w3-half w3-padding-16">

        <div class="w3-center">
            <h3 class="text-center header">Use the form below to add recent updates about the school.</h3>
        </div>

            <?php echo $msg1; ?>
            <?php echo $msg2; ?>
            <div class="w3-padding-small w3-center w3-round-large">
                <form action="" method="post">

                    <div class="w3-margin-bottom">
                        <label for="student">Add A Title or Heading</label>
                        <input type="text" name="title" class="w3-input" placeholder="Title">
                        <span><?php echo $titleErr;?></span>
                    </div>

                    <div class="w3-margin-bottom w3-padding-16">
                       <label for="student">The Message Body</label>
                        <input type="text" name="body" class="w3-input w3-padding-32">
                        <span><?php echo $bodyErr;?></span>
                    </div>

                 
                <input type="submit" value="Submit" name="submit" class="w3-btn w3-padding w3-blue w3-round">

                </form>

                <?php
                $sql = "SELECT * FROM blog ORDER BY id DESC LIMIT 1";
                $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) > 0) {

                    $result=mysqli_fetch_assoc($query);
                    $id = $result['id'];
                    ?>

                    <p class="w3-serif w3-text-light-gray">Click <a href="edit_news.php?t_id=<?=$id?>" class="w3-text-blue">here</a> to edit previous Post.</p>

                    <?php
                }
                ?>
            </div>
            </div>
             <div class="w3-third m-2">
      
      <div class="w3-padding-16 w3-margin-top" style="">
        <ul class="w3-ul">
           <li><a href="dashboard.php" class="btn btn-primary">Return to Dashboard</a></li>
           <li><a href="logout.php" class="btn btn-primary">Logout</a></li>
        </ul>
      </div>

   </div>
        </div>
    </section>




<!-- copyright -->
<div class="w3-center footer" style="width:100%;color: navy;">
        © 2023 <span class="my-font">CPM Int. School Suleja</span><br> All Rights Reserved
  </div>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
<!-- //body ends -->









<?php 
}else{

    ?>
    <head>
        <title>School Admin Dashboard</title>
        <!-- custom-theme -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="CPM School Result Checking Portal." />

        <!-- //custom-theme -->
        <!-- css files -->
        <link href="../css/bootstrap.min.css" type="text/css" rel="stylesheet">
        <link href="../css/style.css" type="text/css" rel="stylesheet" media="all">
        <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext" rel="stylesheet">
        <!-- //css files -->
    </head>
    <body>
    <div class="container">
      <div class="jumbotron">
           <h1 class="alert alert-danger">You must login to Access this Page.</h1>
      </div>
     <p class="text-center">You will be redirected to the login page in 4s.</p>
        <meta http-equiv="refresh" content="4; login.php">
    </div>

    </body>
    <?php


}?>