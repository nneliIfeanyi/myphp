<?php
include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();

if(!empty($_POST['name']) && !empty($_POST['class_numeric'])
&& !empty($_POST['teacher_name'])){
$name = $_POST['name'];
$class_numeric = $_POST['class_numeric'];
$teacher_name = $_POST['teacher_name'];
$class_id = $_POST['class_id'];

// check if class name already exists
    $sql = "SELECT * FROM classes WHERE name = :name AND teacher_name =:teacher_name";
    $conn->query($sql);
    $conn->bind(":name", $name);
    $conn->bind(":teacher_name", $teacher_name);

    if($conn->rowCount() > 0){

        echo "<script>
            toastr['error']('The class you are updating already exists');
      </script>";
        return false;

    }else{
        //process  inserting of data into database
        $sql = "UPDATE classes SET name=:name, class_numeric=:class_numeric, teacher_name=:teacher_name
                WHERE id =:id";
        $conn->query($sql);
        $conn->bind(":name", $name);
        $conn->bind(":class_numeric", $class_numeric);
        $conn->bind(":teacher_name", $teacher_name);
        $conn->bind(":id", $class_id);
        $send = $conn->execute();
        if ($send) {
            $redirect = $conn->base_url().'class';
            echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
            <i class='fas fa-check-circle'></i> Class Data was updated successfully.
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



