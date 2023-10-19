<?php
include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();

$redirect = $conn->base_url().'grade';

if(!empty($_POST['name']) && !empty($_POST['grade_point']) && !empty($_POST['mark_from'])
   && !empty($_POST['mark_upto']) && !empty($_POST['note'])){
    $grade_name = $_POST['name'];
    $grade_point = $_POST['grade_point'];
    $mark_from = $_POST['mark_from'];
    $mark_upto = $_POST['mark_upto'];
    $note = $_POST['note'];
    $grade_id = $_POST['grade_id'];

// check if grade name  already exists
$sql = "SELECT grade_name FROM grade WHERE id != :grade_id AND grade_name =:grade_name";
$conn->query($sql);
$conn->bind(":grade_id", $grade_id);
$conn->bind(":grade_name", $grade_name);

if($conn->rowCount() > 0){

 echo "<script>

         toastr['error']('Grade name already exists.');

   </script>";
      return false;

}


     //check if grade point already exists
     $sql = "SELECT grade_point FROM grade WHERE id != :grade_id AND grade_point =:grade_point";
     $conn->query($sql);
     $conn->bind(":grade_id", $grade_id);
     $conn->bind(":grade_point", $grade_point);

     if($conn->rowCount() > 0){

       echo "<script>

              toastr['error']('Grade point already exists.');

        </script>";
           return false;

     }

     
     //check if mark from already exists

    $sql = "SELECT mark_from FROM grade WHERE id != :grade_id AND mark_from =:mark_from";
    $conn->query($sql);
    $conn->bind(":grade_id", $grade_id);
    $conn->bind(":mark_from", $mark_from);

    if($conn->rowCount() > 0){

     echo "<script>

             toastr['error']('Mark from already exists.');

       </script>";
          return false;

    }

    
     //check if mark upto already exists

     $sql = "SELECT mark_upto FROM grade WHERE id != :grade_id AND mark_upto =:mark_upto";
     $conn->query($sql);
     $conn->bind(":grade_id", $grade_id);
     $conn->bind(":mark_upto", $mark_upto);

     if($conn->rowCount() > 0){

      echo "<script>

              toastr['error']('Mark upto already exists.');

        </script>";
           return false;

     }

     //proces the updating of data into the database

     $sql = "UPDATE grade SET grade_name =:grade_name,  grade_point=:grade_point, mark_from =:mark_from, mark_upto =:mark_upto, note =:note WHERE id =:grade_id";
     $conn->query($sql);
     $conn->bind(":grade_name", $grade_name);
     $conn->bind(":grade_point", $grade_point);
     $conn->bind(":mark_from", $mark_from);
     $conn->bind(":mark_upto", $mark_upto);
     $conn->bind(":note", $note);
     $conn->bind(":grade_id", $grade_id);

     
     $send = $conn->execute();
     if ($send) {
       echo "<script>

           toastr['success']('Grade updated successfully.');

     </script> <meta http-equiv='refresh' content='3; $redirect'>";

     } else {

        echo "<script>

           toastr['error']('An error occurred while adding data.');

     </script> <meta http-equiv='refresh' content='3; $redirect'>";
      
     }

}else{
echo "<p class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
    <i class='fas fa-ban'></i>
    Fields marked (*) are required.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>×</span>
    </button>
</p>";
}



