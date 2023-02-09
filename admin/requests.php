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
    <title>Pins Requested</title>
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
      <div class="w3-col m11 l11 s12">
    <div style="height: 550px;overflow-y: scroll;" class="">
      <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16">USED SCRATCH PINS</h2>
      <div class="">
        <table class="w3-table-all">
          <thead>
            <tr class="w3-text-black">
              <th><b>S/N</b></th>
              <th><b>Pin Code</b></th>
              <th><b>Used_By</b></th>
               <th><b>Date_used</b></th>
              <th><b>Expiry_Date</b></th>
            </tr>
          </thead>

          <tbody>
            <?php 
           

              $sql = "SELECT * FROM pins ORDER BY id DESC" ;
              $query = mysqli_query($conn, $sql);
              $i = 1;

              while($result = mysqli_fetch_array($query)){

             
                $scratch_pin = $result['pin_code'];
                $usedBy = $result['used_by'];
                $dateUsed = $result['date_issued'];
                $expiry = $result['exp_date'];
               
            ?>
            <tr class="w3-text-dark-grey">
              <td><?php echo $i; ?></td>
              <td><?php  echo $scratch_pin; ?></td>
              <td><?php  echo $usedBy; ?></td>
              <td><?php  echo $dateUsed; ?></td>
              <td><?php  echo $expiry; ?></td>              
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