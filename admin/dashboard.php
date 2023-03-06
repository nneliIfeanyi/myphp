<?php
session_start();
include '../config.php';
include '../functions.php';
if(isset($_SESSION['username'])){
  $username = $_SESSION['username'];

  $nameErr = $genderErr = $classErr = $msg1 = $msg2 ='';

  if (isset($_POST['submit'])) {
    $stu_name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['name'], ENT_QUOTES, 'utf-8'));
    $stu_class =mysqli_real_escape_string($conn, htmlspecialchars($_POST['class'], ENT_QUOTES, 'utf-8'));
    $sex = mysqli_real_escape_string($conn, htmlspecialchars($_POST['sex'], ENT_QUOTES, 'utf-8'));
    $reg_no = "12345";

    //validate name

    
        if (empty($stu_class)) {

            $classErr = "<div class='error' style='width:70%;font-size:16px;'>
                             Pls select student's class.
                         </div>";
        }elseif(empty($stu_name)){
            $nameErr = "<div class='error' style='width:70%;font-size:16px;'>
                            Student's name is required!
                        </div>";
        }elseif(empty($sex)){
            $genderErr = "<div class='error' style='width:70%;font-size:16px;'>
                             Choose an option.
                        </div>";
        }else{  
            
            $check = "SELECT * FROM student WHERE name = '$stu_name' AND classesID = '$stu_class'";
            $check_user = mysqli_query($conn,$check);
            $row_count = mysqli_num_rows($check_user);

            if ($row_count==1) {

                $msg2 = "<div class='w3-red w3-padding-small w3-round-large' style='width:70%;margin-left:20px;'>
                                Already added this student!
                                <span><i class='fa fa-spinner w3-text-light-grey w3-large fa-spin fa-fw'></i></span>
                                <meta http-equiv='refresh' content='3; dashboard.php'>
                             </div>";
            }

            else{

                $sql= "INSERT INTO student (name,sex,classesID,regNO) VALUES ('$stu_name','$sex','$stu_class','$reg_no')";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    
                    $msg1 = "<div class='w3-green w3-padding-small w3-round-large' style='width:70%;margin-left:20px;'>
                                Successfull
                                <span><i class='fa fa-spinner w3-text-light-grey w3-large fa-spin fa-fw'></i></span>
                                <meta http-equiv='refresh' content='3; dashboard.php'>
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
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <title>School Admin Dashboard</title>
    <!-- custom-theme -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="CPM School Result Checking Portal." />

    <!-- //custom-theme -->
    <!-- css files -->
    <link rel="stylesheet" type="text/css" href="../css/theme.css">
    <link rel="stylesheet" type="text/css" href="../css/w3.css">
    <!-- //css files -->
    <style>
        .welcomemsg{
            text-transform: uppercase;
            color: #9a2448;
            font-size: 20px;
        }
        .welcome2{
            color: #5cb85c;
            font-size: 20px;
            text-transform: uppercase;
        }
        .header{
            font-weight: 700;
            font-size: 19px;
        }
        select{
            border-radius: 20px;
            outline: none;
            background-color: lightgrey;
            padding: 6px;
        }
    </style>
</head>
<!-- body starts -->
<body class="bg-image w3-serif" style="height:100vh;overflow-y: scroll;color: antiquewhite;">
   <section class="w3-margin w3-padding" style="background:rgba(0, 0, 0, 0.8);">
    <div class="w3-row-padding">
      <div class="w3-twothird w3-padding-16">
        <div class="w3-center">
            <p class="welcomemsg w3-text-green w3-tag">Welcome <?php echo $username; ?></p>
            <h3 class="text-center header">Please use the form below to upload a student's Data.</h3>
        </div>

            <?php echo $msg1; ?>
            <?php echo $msg2; ?>
            <div class="w3-grey w3-padding-small w3-round-large w3-border-blue w3-border">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- Classes Dropdown-->
                    <div class="w3-margin-bottom w3-padding-16">
                        <label for="classID">Student's Class</label>
                        <select name="class" id="classID" class="w3-text-dark-grey">
                            <option value="">Select class</option>
                            <option value="ss1">S.S.1</option>
                            <option value="ss2">S.S.2</option>
                            <option value="ss3">S.S.3</option>
                            <option value="js1">J.S.1</option>
                            <option value="js2A">J.S.2A</option>
                            <option value="js2b">J.S.2b</option>
                            <option value="js3">J.S.3</option>

                        </select>
                        <span><?php echo $classErr; ?></span>
                    </div>

                    <div class="w3-margin-bottom">
                        <label for="student">Student's Name</label>
                        <input type="text" name="name" class="w3-input" placeholder="Surname first, then other names" style="background-color: lightgrey;width: 80%;">
                        <span><?php echo $nameErr;?></span>
                    </div>

                    <div class="w3-margin-bottom w3-padding-16">
                        <input type="radio" name="sex" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
                        <input type="radio" name="sex" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
                        <input type="radio" name="sex" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
                        <span> <?php echo $genderErr;?></span>
                    </div>

                 
                <input type="submit" value="Submit" name="submit" class="w3-btn w3-padding w3-blue w3-round">

                </form>
            </div>
            </div>
            <?php 

            include 'menu.php';

            ?>
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
</html>
<?php }else{

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