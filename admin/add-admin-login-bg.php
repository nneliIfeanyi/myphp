<?php
session_start();
include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();

$base_url = $conn->base_url();

if(!empty($_FILES['new_photo']['name'])){
    $photo_name = $_FILES['new_photo']['name'];
    $photo_tmpname = $_FILES['new_photo']['tmp_name'];
    $photo_size = $_FILES['new_photo']['size'];

    $photofilenameAr = explode('.', $photo_name);
    $photo_extension = end($photofilenameAr);
    $photo_ext = strtolower($photo_extension);
    $setting_id = $_POST['settings_id'];

    //check if image was selected
    if(!empty($photo_name)) {
        if ($photo_size > 2000000) {
            echo "<script>
               toastr['error']('Photo size exceeded. Max size is 2MB.');
             </script>";
            return false;
        }
        if ($photo_ext == 'png' || $photo_ext == 'jpg' || $photo_ext == 'jpeg' || $photo_ext == 'svg') {
            $strgPath = "upload/".$photo_name;
            $student_url = $conn->student_url();
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
                        $sql = "UPDATE general_settings SET admin_login_bg =:photo WHERE id =:settings_id";
                        $conn->query($sql);
                        $conn->bind(":photo", $photo_name);
                        $conn->bind(":settings_id", $setting_id);
                        if($conn->execute()){
                            echo "<script>
                      toastr['success']('Admin Background Image updated successfully');
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



