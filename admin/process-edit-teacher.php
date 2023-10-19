<?php
include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();

if(!empty($_POST['name']) && !empty($_POST['designation'])
&& !empty($_POST['dob']) && !empty($_POST['email'])
&& !empty($_POST['username']) && !empty($_POST['joining_date'])){
$name = $_POST['name'];
$designation = $_POST['designation'];
$email = $_POST['email'];
$joining_date = $_POST['joining_date'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$religion = $_POST['religion'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$username = ($_POST['username']);
$status = ($_POST['status']);

//process  inserting of data into database
    $sql = "UPDATE teachers SET name=:name, designation=:designation, dob=:dob, 
           gender=:gender, religion= :religion, email=:email,  phone= :phone,  
           address=:address,  joining_date =:joining_date, status =:status, username=:username
         WHERE username =:username";
$conn->query($sql);
$conn->bind(":name", $name);
$conn->bind(":designation", $designation);
$conn->bind(":dob", $dob);
$conn->bind(":gender", $gender);
$conn->bind(":religion", $religion);
$conn->bind(":email", $email);
$conn->bind(":phone", $phone);
$conn->bind(":address", $address);
$conn->bind(":joining_date", $joining_date);
$conn->bind(":username", $username);
$conn->bind(":status", $status);

$send = $conn->execute();
if ($send) {
echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
    <i class='fas fa-check-circle'></i> Teacher $name was updated successfully.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
    <meta http-equiv='refresh' content='3; teacher'>
</p>";
}else {
echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i> An error occurred while updating data.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
    <meta http-equiv='refresh' content='4; teacher'>
</p>";
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



