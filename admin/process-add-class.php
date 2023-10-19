<?php
include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();

if(!empty($_POST['name']) && !empty($_POST['class_numeric'])
&& !empty($_POST['teacher_name'])){
$name = $_POST['name'];
$class_numeric = $_POST['class_numeric'];
$teacher_name = $_POST['teacher_name'];

//perform validations for email
//check for email availability
$sql = "SELECT * FROM classes WHERE name =:name || class_numeric =:class_numeric";
$conn->query($sql);
$conn->bind(":name", $name);
$conn->bind(":class_numeric", $class_numeric);
if($conn->rowCount() > 0){
echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i> Either Class name or class numeric already exists.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";
return false;
}else {

//process  inserting of data into database
$sql = "INSERT INTO classes (name, class_numeric, teacher_name) 
        VALUES (:name, :class_numeric, :teacher_name)";
$conn->query($sql);
$conn->bind(":name", $name);
$conn->bind(":class_numeric", $class_numeric);
$conn->bind(":teacher_name", $teacher_name);

$send = $conn->execute();
$redirect = $conn->base_url().'class';
if($send){
    echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
                    <i class='fas fa-check-circle'></i> Class was added successfully.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <span aria-hidden=\"true\">×</span>
                  </button>
                  <meta http-equiv='refresh' content='3; $redirect'>
           </p>";
}else{
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



