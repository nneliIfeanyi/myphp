<?php
include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();

if(!empty($_POST['name']) && !empty($_POST['category'])
&& !empty($_POST['capacity']) && !empty($_POST['class'])
&& !empty($_POST['teacher_name'])){
$name = $_POST['name'];
$capacity = $_POST['capacity'];
$category = $_POST['category'];
$teacher_name = $_POST['teacher_name'];
$class = $_POST['class'];
$section_id = $_POST['section_id'];

// check if the same name of class and section already exists for the section
    $sql = "SELECT * FROM sections WHERE name = :name AND class =:class_name AND category =:cat
            AND capacity =:capacity AND id =:id";
    $conn->query($sql);
    $conn->bind(":name", $name);
    $conn->bind(":class_name", $class);
    $conn->bind(":capacity", $capacity);
    $conn->bind(":cat", $category);
    $conn->bind(":id", $section_id);

    if($conn->rowCount() > 0){
        echo "<script>
            toastr['error']('No new details added.');
      </script>";
        return false;

    }else{
        //process  inserting of data into database
        $sql = "UPDATE sections SET name=:name, class=:class_name, teacher_name=:teacher_name,
                capacity =:capacity, category =:category WHERE id =:section_id";
        $conn->query($sql);
        $conn->bind(":name", $name);
        $conn->bind(":class_name", $class);
        $conn->bind(":teacher_name", $teacher_name);
        $conn->bind(":capacity", $capacity);
        $conn->bind(":category", $category);
        $conn->bind(":section_id", $section_id);
        $send = $conn->execute();
        if ($send) {
            $redirect = $conn->base_url().'section';
            echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
            <i class='fas fa-check-circle'></i> Section Data was updated successfully.
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



