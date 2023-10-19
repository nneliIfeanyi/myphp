<?php
include '../admin/includes/database.php';
include '../admin/includes/functions.php';
$conn= new Functions();

if(!empty($_FILES['new_photo']['name'])){
$photo_name = $_FILES['new_photo']['name'];
$photo_tmpname = $_FILES['new_photo']['tmp_name'];
$photo_size = $_FILES['new_photo']['size'];
$username = $_POST['username'];

$photofilenameAr = explode('.', $photo_name);
$photo_extension = end($photofilenameAr);
$photo_ext = strtolower($photo_extension);

$new_photoname = 'photo'.time().'.'.$photo_ext;

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
$link = "../admin/upload/".$new_photoname;

$strgPath = $link;
if (file_exists($strgPath)){
echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i> Photo with the same name already exists.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";
}else{
$photo_upload = move_uploaded_file($photo_tmpname, $strgPath);
if($photo_upload){
//update photo details in the database
$sql = "UPDATE student SET photo =:photo WHERE username =:username";
$conn->query($sql);
$conn->bind(":photo", $new_photoname);
$conn->bind(":username", $username);

try{
$conn->execute();
echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
    <i class='fas fa-checked-circle-o'></i> Profile photo updated successfully.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
    <meta http-equiv='refresh' content='3; student'>
</p>";

}catch(PDOException $err){
echo $err->getMessage();

}
}

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
}else{
echo "<p class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
    <i class='fas fa-ban'></i>
    Please select a photo to upload.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>×</span>
    </button>
</p>";
}



