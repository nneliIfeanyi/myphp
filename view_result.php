<?php
session_start();

include 'config.php';
include 'functions.php';

if(!isset($_GET['name']) && !isset($_GET['term']) && !isset($_GET['year'])){
    
    header('location:dashboard.php');

}else{
  
   $name = $_GET['name'];
    $term = $_GET['term'];
     $year = $_GET['year'];
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <title>Check Result</title>
    <!-- custom-theme -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="CPM School Result Checking Portal." />

    <!-- //custom-theme -->
    <!-- css files -->
    <link href="css/w3.css" type="text/css" rel="stylesheet" media="all">
    <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/theme.css">
    <!-- //css files -->
  </head>

  <body class="bg-image w3-serif" style="height:100vh;overflow-y: scroll;color: antiquewhite;">


  <section class="w3-margin w3-padding-small" style="background:rgba(0, 0, 0, 0.6);">
    <div class="w3-row-padding">
      <div class="w3-col m12 l12 s12">
      <div style="height: 1 result50px;overflow-y: scroll;" class="">
      <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16"></h2>
      <div class="">
        <table class="w3-table-all">
            <thead>
               <tr class="w3-text-black">
                 <th><b>Name</b></th>
                 <th><b>Class</b></th>
                 <th><b>Year</b></th>
                  <th><b>Term</b></th>
                 <th><b>Action</b></th>
               </tr>
            </thead>

             <tbody>
               <?php 
              

                 $sql = "SELECT * FROM terminal_report WHERE student_name = '$name' AND exam_term = '$term' AND exam_year = '$year'" ;
                 $query = mysqli_query($conn, $sql);
                 $info = mysqli_num_rows($query);

                 if ($info > 0) {

                    
                      while($result = mysqli_fetch_array($query)){

                     
                        $name = $result['student_name'];
                        $class = $result['classID'];
                        $reportCard = $result['report_card'];
                        $year = $result['exam_year'];
                        $term = $result['exam_term'];
                    ?>
                    <tr class="w3-text-dark-grey">
                      <td><?php  echo $name; ?></td>
                      <td><?php  echo $class; ?></td>
                      <td><?php  echo $year; ?></td>
                      <td><?php  echo $term; ?></td>
                      <td>
                       <a href="admin/<?php echo $reportCard;?>" class="w3-text-green w3-btn w3-small">View result</a>
                       <!--<a href="download.php?result=<?php echo $reportCard; ?>" target="_blank" class="w3-text-teal w3-btn w3-tiny">Download result</a>-->
                      </td>
                      

                    </tr>

                     <?php

                    }
                 
                    ?>
               <?php

                 }else{
                  ?>
                     <tr>
                        <td colspan="6" class="w3-text-red">No result found.</td>
                     </tr>

                  <?php
                 }

               ?>
             </tbody>
           </table>
         </div>
      </div>

         </div>
         <div class="w3-third">
            <div class="w3-padding-16 w3-margin-top" style="">
            <ul class="w3-ul">
            <li class="w3-hover-teal"><a href="dashboard.php" class="btn">Dashboard</a></li>
            <li class="w3-hover-teal"><a href="logout.php" class="btn">Logout</a></li>
            <li class="w3-hover-teal"><a href="" class="btn">Contact Us</a></li>
            </ul>
           </div>
        </div>
     </div>
   </section>


<div class="w3-center footer" style="width:100%;color: navy;">
       © 2023 <span class="my-font">CPM Int. School Suleja</span><br> All Rights Reserved
 </div>
     
</body>

  <!-- //body ends -->
  </html>
  
  <?php 

      }

    ?>