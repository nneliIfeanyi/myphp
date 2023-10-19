<?php
session_start();
include('../admin/includes/database.php');
include('../admin/includes/functions.php');

$conn = new Functions();

if(!empty($_POST['username'])){
    $username = $_POST['username'];
    $designation  = $_POST['designation'];
    $phone_no = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    $settings_id = $_POST['settings_id'];

    //perform validations

    $sql = "SELECT * FROM teachers WHERE phone =:phoneno AND phone != '' AND id !=:settings_id";
    $conn->query($sql);
    $conn->bind(":phoneno", $phone_no);
    $conn->bind(":settings_id", $settings_id);
    if($conn->rowCount() > 0){
        echo "<script>
                toastr['error']('Phone number already exists.');
             </script>";
        return false;
    }

    $sql = "SELECT * FROM teachers WHERE email =:email AND email != ''  AND id !=:settings_id";
    $conn->query($sql);
    $conn->bind(":email", $email);
    $conn->bind(":settings_id", $settings_id);
    if($conn->rowCount() > 0){
        echo "<script>
              toastr['error']('The email already exists.');
             </script>";
        return false;
    }else{

        //process  updating of data into database
        $sql = "UPDATE teachers SET designation =:designation, phone =:phoneno, email =:email, 
        address =:address, dob =:dob, gender =:gender, religion =:religion 
        WHERE username =:username";
          $conn->query($sql);
          $conn->bind(":username", $username);
          $conn->bind(":designation", $designation);
          $conn->bind(":phoneno", $phone_no);
          $conn->bind(":email", $email);
          $conn->bind(":address", $address);
          $conn->bind(":dob", $dob);
          $conn->bind(":gender", $gender);
          $conn->bind(":religion", $religion);

        $send = $conn->execute();
        if ($send) {
            echo "<script>
                 toastr['success']('Your Settings have been updated successfully.');
             </script><meta http-equiv='refresh' content='3; settings'>";

        } else {
            echo "<script>
                toastr['error']('An error occurred while updating data');
             </script><meta http-equiv='refresh' content='3; settings'>";
        }
    
    }
}else{
    echo "<script>
        toastr['error']('All fields are required.');
        </script>";
}
