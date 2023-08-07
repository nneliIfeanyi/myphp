<?php 

require '../config.php';
require '../functions.php';
require 'header.php';
 
  if (isset($_GET['surname'])) {
    $search_input = trim($_GET['surname']);
    $sql = "SELECT * FROM student WHERE name LIKE '%$search_input%' ";
    $query = mysqli_query($conn, $sql);
  }


?>
 <div class="row"> 
   <div class="col-md-8 offset-md-2">
    <div class=" mx-auto">
      <div class="card bg-light px-2 my-3">
       
        <h2 class="text-success card-title">Search Results</h2>
      
        <form action="search_results.php" method="get" class="modal-content modal-body border-0 p-0">
          <div class="row">
            <div class="col-md-6">
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="surname" placeholder="Search student ...">
                <button type="submit" class="input-group-text bg-success text-light">
                    <i class="fa fa-fw fa-search text-white"></i>Search
                </button>
            </div>
            <a href="all_students.php" class="btn btn-secondary ">Return</a>
          </div>
        </div>
        </form>
        <div class="card-body">
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
              if (mysqli_num_rows($query) > 0) {
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

              // Num Rows Less == 0
              }else{

                ?>
                   <tr>
                      <td colspan="6" class="text-danger">No result found.</td>
                   </tr>

                  <?php
                }
              ?>
          </tbody>
        </table>
      </div>
    </div>
   </div>
 </div>

