<?php
session_start();
include '../admin/includes/database.php';
include '../admin/includes/functions.php';

$conn = new Functions();

if(!empty($_POST['name'])
    AND !empty($_POST['class'])
    AND !empty($_POST['section'])
    AND !empty($_POST['sex'])
    AND !empty($_POST['reg_no'])
){

    $name = $_POST['name'];
    $sex = $_POST['sex'];
    $reg_no = $_POST['reg_no'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $section = $_POST['section'];
    $class = $_POST['class'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = $_POST['sex'];
    $religion = $_POST['religion'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $username = ($_POST['username']);
    $weight = ($_POST['weight']);
    $height = ($_POST['height']);

    //check if student name already exists
    $sql = "SELECT * FROM student WHERE name =:name AND username !=:username AND name !=''";
    $conn->query($sql);
    $conn->bind(":name", $name);
    $conn->bind(":username", $username);

    if($conn->rowCount() > 0){
        echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
         <i class='fas fa-ban'></i> Name already exists for another student.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <span aria-hidden=\"true\">×</span>
                  </button>
           </p>";
        return false;
    }

    //check if reg no already exists
    $sql = "SELECT * FROM student WHERE registerNO =:reg_no AND username !=:username AND registerNO !=''";
    $conn->query($sql);
    $conn->bind(":reg_no", $reg_no);
    $conn->bind(":username", $username);

    if($conn->rowCount() > 0){
        echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
         <i class='fas fa-ban'></i> Registration no already exists for another student.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <span aria-hidden=\"true\">×</span>
                  </button>
           </p>";
        return false;
    }

    //check if email already exist for another student
    $sql = "SELECT * FROM student WHERE email =:email AND username !=:username AND email !=''";
    $conn->query($sql);
    $conn->bind(":email", $email);
    $conn->bind(":username", $username);
    if($conn->rowCount() > 0) {
        echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <i class='fas fa-ban'></i> Email already exists for another student.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <span aria-hidden=\"true\">×</span>
                  </button>
           </p>";
        return false;
    }else{
        //process student data updating
        $sql = "UPDATE student SET sex=:sex, username=:username, country=:country, 
            dob=:dob, religion=:religion, email=:email, phone=:phone, address=:address, 
            state=:state, height=:height, weight =:weight WHERE username =:username";
        $conn->query($sql);
        $conn->bind(":sex", $sex);
        $conn->bind(":username", $username);
        $conn->bind(":country", $country);
        $conn->bind(":dob", $dob);
        $conn->bind(":religion", $religion);
        $conn->bind(":email", $email);
        $conn->bind(":phone", $phone);
        $conn->bind(":address", $address);
        $conn->bind(":state", $state);
        $conn->bind(":height", $height);
        $conn->bind(":weight", $weight);

        $send = $conn->execute();

        if($send){
            echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
                    <i class='fas fa-check-circle'></i> Student $name was updated successfully.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <span aria-hidden=\"true\">×</span>
                  </button>
                  <meta http-equiv='refresh' content='3; student'>
           </p>";

        }else{
            echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <i class='fas fa-ban'></i> An error occurred while adding data.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <span aria-hidden=\"true\">×</span>
                  </button>
                  <meta http-equiv='refresh' content='4; student'>
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