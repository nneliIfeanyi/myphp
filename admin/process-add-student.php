<?php
include 'includes/database.php';
include 'includes/functions.php';
$conn = new Functions();
$name = trim($_POST['surname']) . ' ' . trim($_POST['firstname']) . ' ' . trim($_POST['middlename']);
$username = $_POST['username'];
if (
    !empty($name) && !empty($_POST['class'])
    && !empty($_POST['section']) && !empty($_POST['sex']) && !empty($_POST['password']) && !empty($_POST['reg_no'])
) {
    $name = $name;
    $reg_no = $_POST['reg_no'];
    $sex = $_POST['sex'];
    $class = $_POST['class'];
    $section = $_POST['section'];
    $username = $username;
    $password = ($_POST['password']);
    $generated_pin = rand(10000, 99999);

    $sql = "SELECT * FROM student WHERE name =:name AND name !=''";
    $conn->query($sql);
    $conn->bind(":name", $name);
    if ($conn->rowCount() > 0) {
        echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i>Name already exists.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";
        return false;
    } else {

        //process  inserting of data into database
        $hashed_password = $conn->Password_Encryption($password);
        $sql = "INSERT INTO student (name, sex, classesid, sectionid, username, registerNO, password, exam_pin) 
          VALUES(:name, :sex, :classesid, :sectionid, :username, :register_no, :password, :exam_pin)";
        $conn->query($sql);
        //$conn->query($sql);
        $conn->bind(":name", $name);
        $conn->bind(":sex", $sex);
        $conn->bind(":classesid", $class);
        $conn->bind(":sectionid", $section);
        $conn->bind(":username", $username);
        $conn->bind(":register_no", $reg_no);
        $conn->bind(":password", $hashed_password);
        $conn->bind(":exam_pin", $generated_pin);

        $send = $conn->execute();
        if ($send) {
            $redirect = $conn->base_url() . 'student';
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
} else {
    echo "<p class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
    <i class='fas fa-ban'></i>
    Fields marked (*) are required.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>×</span>
    </button>
</p>";
}
