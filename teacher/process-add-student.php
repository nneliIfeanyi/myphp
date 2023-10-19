<?php
include '../admin/includes/database.php';
include '../admin/includes/functions.php';
$conn= new Functions();

if(!empty($_POST['name']) && !empty($_POST['class'])
    && !empty($_POST['section']) && !empty($_POST['sex'])
    && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['reg_no'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $reg_no = $_POST['reg_no'];
    $dob = $_POST['dob'];
    $sex = $_POST['sex'];
    $religion = $_POST['religion'];
    $phone = $_POST['phone'];
    $class = $_POST['class'];
    $section = $_POST['section'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $address = $_POST['address'];
    $photo_name = $_FILES['photo']['name'];
    $photo_tmpname = $_FILES['photo']['tmp_name'];
    $photo_size = $_FILES['photo']['size'];
    $username = ($_POST['username']);
    $password = ($_POST['password']);
    $generated_pin = rand(10000, 99999);


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
            $strgPath = "../admin/upload/" . $photo_name;
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
    $sql = "SELECT * FROM student WHERE username =:username AND username !=''";
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
    }

    $sql = "SELECT * FROM student WHERE name =:name AND name !=''";
    $conn->query($sql);
    $conn->bind(":name", $name);
    if($conn->rowCount() > 0){
        echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i>Name already exists.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";
        return false;
    }
//check for username availability
    $sql = "SELECT * FROM student WHERE email =:email AND email !=''";
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
    }else {
        $redirect = $conn->main_url().'/teacher/student';

//process  inserting of data into database
        $hashed_password = $conn->Password_Encryption($password);
        $sql = "INSERT INTO student (name, sex, classesid, sectionid, username, country, 
            dob, religion, email, phone, address, state, registerNO, photo, password, exam_pin) 
          VALUES(:name, :sex, :classesid, :sectionid, :username, :country, 
            :dob, :religion, :email, :phone, :address, :state, :register_no, :photo, :password, :exam_pin)";
        $conn->query($sql);
        $conn->query($sql);
        $conn->bind(":name", $name);
        $conn->bind(":sex", $sex);
        $conn->bind(":classesid", $class);
        $conn->bind(":sectionid", $section);
        $conn->bind(":username", $username);
        $conn->bind(":country", $country);
        $conn->bind(":dob", $dob);
        $conn->bind(":religion", $religion);
        $conn->bind(":email", $email);
        $conn->bind(":phone", $phone);
        $conn->bind(":address", $address);
        $conn->bind(":state", $state);
        $conn->bind(":register_no", $reg_no);
        $conn->bind(":photo", $photo_name);
        $conn->bind(":password", $hashed_password);
        $conn->bind(":exam_pin", $generated_pin);

        $send = $conn->execute();
        if ($send) {
            echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
    <i class='fas fa-check-circle'></i> Student $name was added successfully.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
    <meta http-equiv='refresh' content='3; $redirect'>
</p>";
        } else {
            echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i> An error occurred while adding data.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
    <meta http-equiv='refresh' content='4; $redirect'>
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



