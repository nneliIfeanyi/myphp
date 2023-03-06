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
    <div class="w3-row-padding">
      <div class="w3-twothird">
    <label for="classID" class="w3-xlarge">UPLOAD RESULT FOR: </label>
    <select id="classID" class="w3-text-dark-grey" style="padding:7px;border-radius: 15px;">
      <option value="">--Select Class--</option>
      <option value="ss1">SS1</option>
      <option value="ss2">SS2</option>
      <option value="ss3">SS3</option>
      <option value="js1">JS1</option>
      <option value="js2A">JS2A</option>
        <option value="js2b">JS2b</option>
      <option value="js3">JS3</option>
    </select>
    <div id="showSS1" style="display:none; height: 550px;overflow-y: scroll;" class="">
      <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16">ALL SS1 STUDENTS</h2>
      <div class="">
        <table class="w3-table-all w3-text-blue" style="width:95%;margin: auto;">
          <thead>
            <tr class="w3-text-black">
              <th><b>S/N</b></th>
              <th><b>Name</b></th>
              <th><b>Action</b></th>
            </tr>
          </thead>

          <tbody>
            <?php 

              $sql = "SELECT * FROM student WHERE classesID = 'ss1'" ;
              $query = mysqli_query($conn, $sql);
             if (mysqli_num_rows($query) > 0) {
               // code...

                 $i = 1;
                while($result = mysqli_fetch_array($query)){

                  $name = $result['name'];
              
              ?>
              <tr class="w3-text-dark-grey">
               <td><?php echo $i;?></td>
                <td><?php  echo $name; ?></td>
                <td><?php echo "<a class='w3-card w3-tiny w3-teal w3-card' href='add_result.php?addResult={$result['name']}'>Add Result</a>"; ?>
                  <?php echo "<a class='w3-tiny w3-red w3-card' href='delete.php?name2={$result['name']}'>Delete</a>"; ?>
                  <?php echo "<a class='w3-tiny w3-text-green w3-card' href='edit.php?name2={$result['name']}'>Edit</a>"; ?>
                </td>

              </tr>

              <?php
              $i++;
                }
             }else{
              ?>
              <tr class="w3-text-dark-grey">
               <td colspan="3" align="center" class="w3-text-red">No student found..</td>
             </tr>


              <?php

             }
             
           ?>
          </tbody>
        </table>
      </div>
   </div>
    
       <div id="showSS2" style="display:none; height: 550px;overflow-y: scroll;" class="">
         <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16">ALL SS2 STUDENTS</h2>
         <div class="">
           <table class="w3-table-all w3-text-blue" style="width:95%;margin: auto;">
             <thead>
               <tr class="w3-text-black">
                <th><b>S/N</b></th>
                 <th><b>Name</b></th>
                 <th><b>Action</b></th>
               </tr>
             </thead>

             <tbody>
               <?php 

                 $sql = "SELECT * FROM student WHERE classesID = 'ss2'" ;
                 $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) > 0) {
               // code...

                 $i = 1;
                while($result = mysqli_fetch_array($query)){

                  $name = $result['name'];
              
              ?>
              <tr class="w3-text-dark-grey">
               <td><?php echo $i;?></td>
                <td><?php  echo $name; ?></td>
                <td><?php echo "<a class='w3-tiny w3-card w3-teal' href='add_result.php?addResult={$result['name']}'>Add Result</a>"; ?>
                  <?php echo "<a class='w3-tiny w3-red w3-card' href='delete.php?name2={$result['name']}'>Delete</a>"; ?>
                </td>

              </tr>

              <?php
              $i++;
                }
             }else{
              ?>
              <tr class="w3-text-dark-grey">
               <td colspan="3" align="center" class="w3-text-red">No student found..</td>
             </tr>


              <?php

             }
             
           ?>
             </tbody>
           </table>
         </div>
      </div>
    
     <div id="showSS3" style="display:none; height: 550px;overflow-y: scroll;" class="">
       <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16">ALL SS3 STUDENTS</h2>
       <div class="">
         <table class="w3-table-all w3-text-blue" style="width:95%;margin: auto;">
           <thead>
             <tr class="w3-text-black">
              <th><b>S/N</b></th>
               <th><b>Name</b></th>
               <th><b>Action</b></th>
             </tr>
           </thead>

           <tbody>
             <?php 

             $sql = "SELECT * FROM student WHERE classesID = 'ss3'" ;
             $query = mysqli_query($conn,$sql);
              if (mysqli_num_rows($query) > 0) {
               // code...

                 $i = 1;
                while($result = mysqli_fetch_array($query)){

                  $name = $result['name'];
              
              ?>
              <tr class="w3-text-dark-grey">
               <td><?php echo $i;?></td>
                <td><?php  echo $name; ?></td>
                <td><?php echo "<a class='w3-tiny w3-teal w3-card' href='add_result.php?addResult={$result['name']}'>Add Result</a>"; ?>
                  <?php echo "<a class='w3-tiny w3-red w3-card' href='delete.php?name2={$result['name']}'>Delete</a>"; ?>
                </td>

              </tr>

              <?php
              $i++;
                }
             }else{
              ?>
              <tr class="w3-text-dark-grey">
               <td colspan="3" align="center" class="w3-text-red">No student found..</td>
             </tr>


              <?php

             }
             
           ?>
           </tbody>
         </table>
       </div>
    </div>
  
     <div id="showJS1" style="display:none; height: 550px;overflow-y: scroll;" class="">
       <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16">ALL JS1 STUDENTS</h2>
       <div class="">
         <table class="w3-table-all w3-text-blue" style="width:95%;margin: auto;">
           <thead>
             <tr class="w3-text-black">
              <th><b>S/N</b></th>
               <th><b>Name</b></th>
               <th><b>Action</b></th>
             </tr>
           </thead>

           <tbody>
             <?php 

               $sql = "SELECT * FROM student WHERE classesID = 'js1'" ;
               $query = mysqli_query($conn, $sql);
               if (mysqli_num_rows($query) > 0) {
                    // code...

                      $i = 1;
                     while($result = mysqli_fetch_array($query)){

                       $name = $result['name'];
                   
                   ?>
                   <tr class="w3-text-dark-grey">
                    <td><?php echo $i;?></td>
                     <td><?php  echo $name; ?></td>
                     <td><?php echo "<a class='w3-tiny w3-teal w3-card' href='add_result.php?addResult={$result['name']}'>Add Result</a>"; ?>
                       <?php echo "<a class='w3-tiny w3-red w3-card' href='delete.php?name2={$result['name']}'>Delete</a>"; ?>
                     </td>

                   </tr>

                   <?php
                   $i++;
                     }
                  }else{
                   ?>
                   <tr class="w3-text-dark-grey">
                    <td colspan="3" align="center" class="w3-text-red">No student found..</td>
                  </tr>


                   <?php

                  }
                  
                ?>
           </tbody>
         </table>
       </div>
    </div>
  
   <div id="showJS2A" style="display:none; height: 550px;overflow-y: scroll;" class="">
     <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16">ALL JS2A STUDENTS</h2>
     <div class="">
       <table class="w3-table-all w3-text-blue" style="width:95%;margin: auto;">
         <thead>
           <tr class="w3-text-black">
            <th><b>S/N</b></th>
             <th><b>Name</b></th>
             <th><b>Action</b></th>
           </tr>
         </thead>

         <tbody>
           <?php 

             $sql = "SELECT * FROM student WHERE classesID = 'js2A'" ;
             $query = mysqli_query($conn, $sql);
              if (mysqli_num_rows($query) > 0) {
               // code...

                 $i = 1;
                while($result = mysqli_fetch_array($query)){

                  $name = $result['name'];
              
              ?>
              <tr class="w3-text-dark-grey">
               <td><?php echo $i;?></td>
                <td><?php  echo $name; ?></td>
                <td><?php echo "<a class='w3-tiny w3-teal w3-card' href='add_result.php?addResult={$result['name']}'>Add Result</a>"; ?>
                  <?php echo "<a class='w3-tiny w3-red w3-card' href='delete.php?name2={$result['name']}'>Delete</a>"; ?>
                </td>

              </tr>

              <?php
              $i++;
                }
             }else{
              ?>
              <tr class="w3-text-dark-grey">
               <td colspan="3" align="center" class="w3-text-red">No student found..</td>
             </tr>


              <?php

             }
             
           ?>
         </tbody>
       </table>
     </div>
  </div>
  


   <div id="showJS2b" style="display:none; height: 550px;overflow-y: scroll;" class="">
     <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16">ALL JS2b STUDENTS</h2>
     <div class="">
       <table class="w3-table-all w3-text-blue" style="width:95%;margin: auto;">
         <thead>
           <tr class="w3-text-black">
            <th><b>S/N</b></th>
             <th><b>Name</b></th>
             <th><b>Action</b></th>
           </tr>
         </thead>

         <tbody>
           <?php 

             $sql = "SELECT * FROM student WHERE classesID = 'js2b'" ;
             $query = mysqli_query($conn, $sql);
              if (mysqli_num_rows($query) > 0) {
               // code...

                 $i = 1;
                while($result = mysqli_fetch_array($query)){

                  $name = $result['name'];
              
              ?>
              <tr class="w3-text-dark-grey">
               <td><?php echo $i;?></td>
                <td><?php  echo $name; ?></td>
                <td><?php echo "<a class='w3-tiny w3-teal w3-card' href='add_result.php?addResult={$result['name']}'>Add Result</a>"; ?>
                  <?php echo "<a class='w3-tiny w3-red w3-card' href='delete.php?name2={$result['name']}'>Delete</a>"; ?>
                </td>

              </tr>

              <?php
              $i++;
                }
             }else{
              ?>
              <tr class="w3-text-dark-grey">
               <td colspan="3" align="center" class="w3-text-red">No student found..</td>
             </tr>


              <?php

             }
             
           ?>
         </tbody>
       </table>
     </div>
  </div>
  



   <div id="showJS3" style="display:none; height: 550px;overflow-y: scroll;" class="">
     <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16">ALL JS3 STUDENTS</h2>
     <div class="">
       <table class="w3-table-all w3-text-blue" style="width:95%;margin: auto;">
         <thead>
           <tr class="w3-text-black">
            <th><b>S/N</b></th>
             <th><b>Name</b></th>
             <th><b>Action</b></th>
           </tr>
         </thead>

         <tbody>
           <?php 

             $sql = "SELECT * FROM student WHERE classesID = 'js3'" ;
             $query = mysqli_query($conn, $sql);
             if (mysqli_num_rows($query) > 0) {
               // code...

                 $i = 1;
                while($result = mysqli_fetch_array($query)){

                  $name = $result['name'];
              
              ?>
              <tr class="w3-text-dark-grey">
               <td><?php echo $i;?></td>
                <td><?php  echo $name; ?></td>
                <td><?php echo "<a class='w3-tiny w3-teal w3-card' href='add_result.php?addResult={$result['name']}'>Add Result</a>"; ?>
                  <?php echo "<a class='w3-tiny w3-red w3-card' href='delete.php?name2={$result['name']}'>Delete</a>"; ?>
                </td>

              </tr>

              <?php
              $i++;
                }
             }else{
              ?>
              <tr class="w3-text-dark-grey">
               <td colspan="3" align="center" class="w3-text-red">No student found.</td>
             </tr>


              <?php

             }
             
           ?>
         </tbody>
       </table>
     </div>
  </div>
    <div id="msg" style="display:block;" class="w3-margin-top w3-padding-32 w3-xlarge w3-serif">You have not selected any class..</div>

    </div>
    <?php

    include 'menu.php';

     ?>
  </div>
</section>


<div class="w3-center footer" style="width:100%;color: navy;">
       © 2023 <span class="my-font">CPM Int. School Suleja</span><br> All Rights Reserved
 </div>
    
 <script type="text/javascript" src="jsfile.js"></script>  
</body>

  <!-- //body ends -->
  </html>
  
  <?php 

      }

    ?>