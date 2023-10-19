<?php
include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();

if(!empty($_POST['class_name']) && !empty($_POST['pass_mark'])
&& !empty($_POST['final_mark']) && !empty($_POST['subject_code'])
&& !empty($_POST['teacher_name'])){
$subject_code = $_POST['subject_code'];
$subject_author = $_POST['subject_author'];
$subject_name = $_POST['subject_name'];
$pass_mark = $_POST['pass_mark'];
$final_mark = $_POST['final_mark'];
$teacher_name = $_POST['teacher_name'];
$subject_id = $_POST['subject_id'];
$class_id = $_POST['class_name'];

// check if subject code already exists
    $sql = "SELECT subject_code FROM subjects WHERE subject_name !=:subject_name";
    $conn->query($sql);
    $conn->bind(":subject_name", $subject_name);
    $db_subject_code = $conn->fetchColumn();

    if($db_subject_code === $subject_code){
        echo "<script>
            toastr['error']('Subject code $subject_code already exists for another subject.');
      </script>";
        return false;

    }else{
        //process  inserting of data into database
        $sql = "UPDATE subjects SET class_id =:class_id, teacher_name =:teacher_name, pass_mark =:pass_mark
                , final_mark =:final_mark, subject_name =:subject_name, subject_author =:subject_author,
                subject_code =:subject_code WHERE id =:subject_id";
        $conn->query($sql);
        $conn->bind(":class_id", $class_id);
        $conn->bind(":teacher_name", $teacher_name);
        $conn->bind(":pass_mark", $pass_mark);
        $conn->bind(":final_mark", $final_mark);
        $conn->bind(":subject_name", $subject_name);
        $conn->bind(":subject_author", $subject_author);
        $conn->bind(":subject_code", $subject_code);
        $conn->bind(":subject_id", $subject_id);

        $send = $conn->execute();
        if ($send) {
            $redirect = $conn->base_url().'subject';
            echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
            <i class='fas fa-check-circle'></i> Subject was updated successfully.
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">×</span>
            </button>
            <meta http-equiv='refresh' content='3; $redirect'>
        </p>";
        }else {
            echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
            <i class='fas fa-ban'></i> An error occurred while updating data.
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



