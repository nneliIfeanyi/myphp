<?php
include '../admin/includes/database.php';
include '../admin/includes/functions.php';
$conn= new Functions();

if(!empty($_POST['class_name']) && !empty($_POST['teacher_name'])
&& !empty($_POST['pass_mark']) && !empty($_POST['final_mark'])){
$subject_code = $_POST['subject_code'];
$subject_author = $_POST['subject_author'];
$subject_name = $_POST['subject_name'];
$pass_mark = $_POST['pass_mark'];
$final_mark = $_POST['final_mark'];
$teacher_name = $_POST['teacher_name'];
$class_id = $_POST['class_name'];

$sql = "SELECT name FROM classes WHERE id =:id";
$conn->query($sql);
$conn->bind(":id", $class_id);
$className = $conn->fetchColumn();



//perform validations for email
//check for email availability
$sql = "SELECT * FROM subjects WHERE subject_code =:subject_code";
    $conn->query($sql);
    $conn->bind(":subject_code", $subject_code);
    if($conn->rowCount() > 0){
        echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i> Subject code $subject_code already exists in the system.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";
        return false;
}
//check if subject name and class already exists
$sql = "SELECT * FROM subjects WHERE subject_name =:subject_name AND class_id =:class_id";
    $conn->query($sql);
    $conn->bind(":subject_name", $subject_name);
    $conn->bind(":class_id", $class_id);
    if($conn->rowCount() > 0){
        echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i> Subject name $subject_name already exists for class $className.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";
        return false;
    }else {
//process  inserting of data into database
$sql = "INSERT INTO subjects(class_id, teacher_name, pass_mark, final_mark, subject_name, subject_author, subject_code)
        VALUES (:class_id, :teacher_name, :pass_mark, :final_mark, :subject_name, :subject_author, :subject_code)";
$conn->query($sql);
$conn->bind(":class_id", $class_id);
$conn->bind(":pass_mark", $pass_mark);
$conn->bind(":teacher_name", $teacher_name);
$conn->bind(":final_mark", $final_mark);
$conn->bind(":subject_name", $subject_name);
$conn->bind(":subject_author", $subject_author);
$conn->bind(":subject_code", $subject_code);

$send = $conn->execute();
$redirect = $conn->main_url().'/teacher/subject';
if($send){
    echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
                    <i class='fas fa-check-circle'></i> Subject $subject_name was added successfully.
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



