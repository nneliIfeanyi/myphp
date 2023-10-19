<?php
include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();

if(!empty($_POST['name']) && !empty($_POST['category'])
&& !empty($_POST['capacity'])){
$name = $_POST['name'];
$capacity = $_POST['capacity'];
$category = $_POST['category'];
$class = $_POST['class'];
$teacher_name = $_POST['teacher_name'];

//fetch name of class
    $sql = "SELECT name FROM classes WHERE id=:id";
    $conn->query($sql);
    $conn->bind(":id", $class);
    $className = $conn->fetchColumn();

//perform validations for email
//check for email availability
$sql = "SELECT * FROM sections WHERE name =:name AND class =:class_name";
$conn->query($sql);
$conn->bind(":name", $name);
$conn->bind(":class_name", $name);
if($conn->rowCount() > 0){
echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i> Section name already exists for class $className
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";
return false;
}else {
//process  inserting of data into database
$sql = "INSERT INTO sections (name, category, class, teacher_name, capacity) 
        VALUES (:name, :category, :class, :teacher_name, :capacity)";
$conn->query($sql);
$conn->bind(":name", $name);
$conn->bind(":class", $class);
$conn->bind(":teacher_name", $teacher_name);
$conn->bind(":category", $category);
$conn->bind(":capacity", $capacity);

$send = $conn->execute();
$redirect = $conn->base_url().'section';
if($send){
    echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
                    <i class='fas fa-check-circle'></i> Section was added successfully.
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



