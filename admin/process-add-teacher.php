<?php
include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();

if(!empty($_POST['name']) && !empty($_POST['designation'])
&& !empty($_POST['dob']) && !empty($_POST['email'])
&& !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['joining_date'])){
$name = $_POST['name'];
$designation = $_POST['designation'];
$email = $_POST['email'];
$joining_date = $_POST['joining_date'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$religion = $_POST['religion'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$photo_name = $_FILES['photo']['name'];
$photo_tmpname = $_FILES['photo']['tmp_name'];
$photo_size = $_FILES['photo']['size'];
$username = ($_POST['username']);
$password = ($_POST['password']);


$photofilenameAr = explode('.', $photo_name);
$photo_extension = end($photofilenameAr);
$photo_ext = strtolower($photo_extension);

//check if image was selected
if(!empty($photo_name)) {
if ($photo_size > 2000000) {
echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i>  Photo size exceeded. Max size is 2MB.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";
}
if ($photo_ext == 'png' || $photo_ext == 'jpg' || $photo_ext == 'jpeg' || $photo_ext == 'svg') {
$strgPath = "upload/" . $photo_name;
if (file_exists($strgPath)) {
echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i>  Photo with the same name already exists.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";
} else {
$photo_upload = move_uploaded_file($photo_tmpname, $strgPath);
}
} else {
echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i> Only png, jpg, jpeg or svg formats are allowed. Photo did not upload.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";

}
}

//perform validations for email
//check for email availability
$sql = "SELECT * FROM teachers WHERE email =:email";
$conn->query($sql);
$conn->bind(":email", $email);
if($conn->rowCount() > 0){
echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i> Email already exists.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";
return false;
}
$sql = "SELECT * FROM teachers WHERE name =:name";
$conn->query($sql);
$conn->bind(":name", $name);
if($conn->rowCount() > 0){
echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i>Teacher name already exists.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";
return false;
}
//check for username availability
$sql = "SELECT * FROM teachers WHERE username =:username";
$conn->query($sql);
$conn->bind(":username", $username);
if($conn->rowCount() > 0){
echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i> Username already exists.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";
return false;
}else {

//process  inserting of data into database
$hashed_password = $conn->Password_Encryption($password);
$sql = "INSERT INTO teachers (name, designation, dob, gender, religion, email, phone,
address, joining_date, photo, username, password)
VALUES(:name, :designation, :dob, :gender, :religion, :email, :phone,
:address, :joining_date, :photo, :username, :password)";
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
$conn->bind(":photo", $photo_name);
$conn->bind(":username", $username);
$conn->bind(":password", $hashed_password);

$send = $conn->execute();
if ($send) {
echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
    <i class='fas fa-check-circle'></i> Teacher $name was added successfully.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
    <meta http-equiv='refresh' content='3; teacher'>
</p>";
} else {
echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i> An error occurred while adding data.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
    <meta http-equiv='refresh' content='4; teacher'>
</p>";
}
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



