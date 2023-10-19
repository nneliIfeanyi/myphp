<?php
session_start();

include '../config.php';
include '../functions.php';

if(!isset($_SESSION['username'])){
    
    header('location:login.php');

}else{
  
   $username = $_SESSION['username'];
require 'header.php';
?>
<body class="bg-image w3-serif" style="height:100vh;overflow-y: scroll;color: antiquewhite;">


  <section class="w3-padding-small" style="background:rgba(0, 0, 0, 0.6);">
    <div class="w3-row">
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
       <option value="class6">Common Entrance</option>
    </select>
    <div id="showSS1" style="display:none; height: auto;" class="">
      <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16">ALL SS1 STUDENTS</h2>
      <div class="">
        <table class="w3-table-all w3-text-blue" style="width:100%;margin: auto;">
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
                <td><?php echo "<a class='w3-tiny w3-card' href='add_result.php?addResult=$name'>Add Result</a>"; ?>
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

  <div id="showClass6" style="display:none; height: auto;" class="">
    <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16">Common Entrance Students</h2>
      <div class="">
        <table class="w3-table-all w3-text-blue" style="width:100%;margin: auto;">
          <thead>
            <tr class="w3-text-black">
              <th><b>S/N</b></th>
              <th><b>Name</b></th>
              <th><b>Action</b></th>
            </tr>
          </thead>

          <tbody>
            <?php 

              $sql = "SELECT * FROM student WHERE classesID = 'class6'" ;
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
                <td><?php echo "<a class='w3-tiny w3-card' href='add_result.php?addResult=$name'>Add Result</a>"; ?>
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
    
       <div id="showSS2" style="display:none; height: auto;" class="">
         <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16">ALL SS2 STUDENTS</h2>
         <div class="">
           <table class="w3-table-all w3-text-blue" style="width:100%;margin: auto;">
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
                <td><?php echo "<a class='w3-tiny w3-card' href='add_result.php?addResult=$name'>Add Result</a>"; ?>
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
    
     <div id="showSS3" style="display:none; height: auto;" class="">
       <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16">ALL SS3 STUDENTS</h2>
       <div class="">
         <table class="w3-table-all w3-text-blue" style="width:100%;margin: auto;">
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
                <td><?php echo "<a class='w3-tiny w3-card' href='add_result.php?addResult=$name'>Add Result</a>"; ?>
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
  
     <div id="showJS1" style="display:none; height: auto;" class="">
       <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16">ALL JS1 STUDENTS</h2>
       <div class="">
         <table class="w3-table-all w3-text-blue" style="width:100%;margin: auto;">
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
                     <td><?php echo "<a class='w3-tiny w3-card' href='add_result.php?addResult=$name'>Add Result</a>"; ?>
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
  
   <div id="showJS2A" style="display:none; height: auto;" class="">
     <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16">ALL JS2A STUDENTS</h2>
     <div class="">
       <table class="w3-table-all w3-text-blue" style="width:100%;margin: auto;">
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
               <td><?php echo "<a class='w3-tiny w3-card' href='add_result.php?addResult=$name'>Add Result</a>"; ?>
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
  


   <div id="showJS2b" style="display:none; height: auto;" class="">
     <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16">ALL JS2b STUDENTS</h2>
     <div class="">
       <table class="w3-table-all w3-text-blue" style="width:100%;margin: auto;">
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
                <td><?php echo "<a class='w3-tiny w3-card' href='add_result.php?addResult=$name'>Add Result</a>"; ?>
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
  



   <div id="showJS3" style="display:none; height: auto;" class="">
     <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16">ALL JS3 STUDENTS</h2>
     <div class="">
       <table class="w3-table-all" style="width:100%;margin: auto;">
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
                <td><?php echo "<a class='w3-tiny w3-card' href='add_result.php?addResult=$name'>Add Result</a>"; ?>
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
    <div class="w3-margin">
      
      <div class="w3-padding-16 w3-margin" style="">
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
    
 <script type="text/javascript" src="jsfile.js"></script>  
</body>

  <!-- //body ends -->
  </html>
  
  <?php 

      }

    ?>