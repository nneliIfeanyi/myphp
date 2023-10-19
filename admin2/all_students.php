<?php
session_start();

require '../config.php';
require '../functions.php';

if(!isset($_SESSION['username'])){
    
    header('location:login.php');

}else{
  
   $username = $_SESSION['username'];
   $msg1 = '';
require 'header.php';
?>
  <body class="bg-image w3-serif" style="height:100vh;overflow-y: scroll;color: antiquewhite;">


  <section class="w3-padding-small" style="background:rgba(0, 0, 0, 0.6);">
    <div class="w3-row">
      <div class="w3-col m12 l12 s12">
         <div class="w3-center w3-margin-top">
            <img src="images/badge.jpg" width="100" height="100" class="w3-circle">
         </div>
    <div  class="m-2">
      <h2 class="w3-center my-font w3-large w3-padding-16"><strong>A Comprehensive List of All Students</strong><span class="w3-small w3-opacity"><b>&nbsp;<br>(In Alphabetical order)</b></span></h2>
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <form action="search_results.php" method="get" class="">
            <div class="input-group mb-2">
              <input type="text" class="form-control" name="surname" placeholder="Search by surname ...">
              <button type="submit" class="input-group-text px-3 bg-success text-light">
                <i class="fa fa-fw fa-search text-white"></i> Search
              </button>
            </div>
          </form>
        </div>
      </div>
      <?php

      if (isset($_SESSION['msg'])) {
        $msg1 = $_SESSION['msg'];

      }
      if (!empty($msg1)) {

      ?>
      <div class='w3-padding w3-large w3-text-green'>
        <?=$msg1?>
      </div>
      <?php
       
      }
      ?>
      <div class="" style="height: 100vh; overflow-y: scroll;">
        <table class="w3-table-all">
          <thead>
            <tr class="w3-text-black">
              <th><b>S/N</b></th>
              <th><b>Name</b></th>
               <th><b>Sex</b></th>
              <th><b>Class</b></th>
               <th><b>Card Pin</b></th>
              <th><b>Action</b></th>
            </tr>
          </thead>

          <tbody>
            <?php 
           

              $sql = "SELECT * FROM student ORDER BY name ASC" ;
              $query = mysqli_query($conn, $sql);
              $i = 1;

              while($result = mysqli_fetch_array($query)){

             
                $name = $result['name'];
                $class = $result['classesID'];
                $sex = $result['sex'];
                $pin = $result['card_serial_no'];
            ?>
            <tr class="w3-text-dark-grey">
              <td><?php echo $i; ?></td>
              <td><?php  echo $name; ?></td>
              <td><?php  echo $sex; ?></td>
              <td><?php  echo $class; ?></td>
              <td><?php  echo $pin; ?></td>
            
              <td>
               <a href="edit.php?name2=<?php echo $name;?>" class="w3-text-green w3-btn w3-tiny">Edit</a>
              <a href="delete.php?name2=<?=$name?>" class="w3-text-red w3-btn  w3-tiny">Delete</a>
             </td>
              

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


<div class="w3-center footer" style="width:100%;color: navy;">
       © 2023 <span class="my-font">CPM Int. School Suleja</span><br> All Rights Reserved
 </div>
     
</body>

  <!-- //body ends -->
  </html>
  
  <?php 

      }

    ?>