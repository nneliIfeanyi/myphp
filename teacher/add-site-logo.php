<?php
session_start();
include '../admin/includes/database.php';
include '../admin/includes/functions.php';
$conn= new Functions();

//$base_url = $conn->base_url();

if(!empty($_FILES['new_photo']['name'])){
    $photo_name = $_FILES['new_photo']['name'];
    $photo_tmpname = $_FILES['new_photo']['tmp_name'];
    $photo_size = $_FILES['new_photo']['size'];

    $photofilenameAr = explode('.', $photo_name);
    $photo_extension = end($photofilenameAr);
    $photo_ext = strtolower($photo_extension);
    $setting_id = $_POST['settings_id'];
    $username = $_POST['username'];

    $new_photo_name = time().'profile_image' .'.'.$photo_ext; 

    //check if image was selected
    if(!empty($photo_name)) {
        if ($photo_size > 400000) {
            echo "<script>
               toastr['error']('Photo size exceeded. Max size is 400KB.');
             </script>";
            return false;
        }
        if ($photo_ext == 'png' || $photo_ext == 'jpg' || $photo_ext == 'jpeg' || $photo_ext == 'svg') {
            $strgPath = "../admin/upload/".$new_photo_name;
            if (file_exists($strgPath)) {
                echo "<script>
              toastr['error']('Photo with the same name already exists.');
             </script>";
                return false;

            } else {
                try{
                    $photo_upload = move_uploaded_file($photo_tmpname, $strgPath);
                    if($photo_upload){
                        //update photo details in the database
                        $sql = "UPDATE teachers SET photo =:photo WHERE username =:username";
                        $conn->query($sql);
                        $conn->bind(":photo", $new_photo_name);
                        $conn->bind(":username", $username);
                        if($conn->execute()){
                            echo "<script>
                      toastr['success']('Profile Image updated successfully');
                     </script> <meta http-equiv='refresh' content='3; settings'>";
                        }else{
                            echo "<script>
                         toastr['error']('An error occurred while uploading your image');
                     </script>";
                        }
                    }else{
                        echo "<script>
                      toastr['error']('Photo cannot upload');
                     </script>";
                    }

                }catch(PDOException $err){
                    $error = $err->getMessage();
                    echo "<script>
                      toastr['error']('$error');
                     </script>";

                }

            }
        } else {

            echo "<script>
                      toastr['error']('Only png, jpg, jpeg or svg formats are allowed. Photo did not upload.');
                     </script>";

        }
    }



}else{
    echo "<script>
                      toastr['error']('  Please select a photo to upload.');
                     </script>";
}



