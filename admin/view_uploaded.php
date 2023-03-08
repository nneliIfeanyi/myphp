<?php
session_start();

include '../config.php';
include '../functions.php';

if(!isset($_SESSION['username'])){
    
    header('location:login.php');

}else{
  
   $username = $_SESSION['username'];

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
    <link href="../css/w3.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/theme.css">
    <!-- //css files -->
  </head>

  <body class="bg-image w3-serif" style="height:100vh;overflow-y: scroll;color: antiquewhite;">


  <section class="w3-margin w3-padding-small" style="background:rgba(0, 0, 0, 0.6);">
    <div class="w3-row">
      <div class="w3-col m12 l12 s12">
    <div style="height: 550px;overflow-y: scroll;" class="">
      <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16">Terminal Reports</h2>
      <div class="">
        <table class="w3-table-all">
          <thead>
            <tr class="w3-text-black">
              <th><b>S/N</b></th>
              <th><b>Report Card</b></th>
              <th><b>Class</b></th>
               <th><b>Name</b></th>
              <th><b>Year</b></th>
               <th><b>Term</b></th>
              <th><b>Action</b></th>
            </tr>
          </thead>

          <tbody>
            <?php 
           

              $sql = "SELECT * FROM terminal_report ORDER BY id DESC" ;
              $query = mysqli_query($conn, $sql);
              $i = 1;

              while($result = mysqli_fetch_array($query)){

             
                $name = $result['student_name'];
                $class = $result['classID'];
                $reportCard = $result['report_card'];
                $year = $result['exam_year'];
                $term = $result['exam_term'];
            ?>
            <tr class="w3-text-dark-grey">
              <td><?php echo $i; ?></td>
              <td><?php  echo $reportCard; ?></td>
              <td><?php  echo $class; ?></td>
              <td><?php  echo $name; ?></td>
              <td><?php  echo $year; ?></td>
              <td><?php  echo $term; ?></td>
              <td><a href="delete.php?name=<?php echo $name;?>&year=<?php echo $year;?>" class="w3-text-red w3-tiny">Delete</a>
              <a href="<?php echo $reportCard;?>" class="w3-text-green w3-tiny">View</a>
              <a href="../download.php?result=<?php echo $reportCard;?>" class="btn btn-info w3-tiny">Download</a></td>
              

            </tr>

            <?php

              $i++;

              }

            ?>
          </tbody>
        </table>
      </div>
   </div>

    </div>
    <?php

    include 'menu.php';

     ?>
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