<?php
include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();

if(!empty($_POST['name']) && !empty($_POST['date'])){
$name = $_POST['name'];
$date = $_POST['date'];
$exam_id = $_POST['exam_id'];

// check if exam details already exists
    $sql = "SELECT * FROM exams WHERE name = :name AND date =:date";
    $conn->query($sql);
    $conn->bind(":name", $name);
    $conn->bind(":date", $date);

    if($conn->rowCount() > 0){

        echo "<script>
            toastr['error']('This exam already exists. Pls edit it to save changes.');
      </script>";
        return false;

    }else{
        //process  inserting of data into database
        $sql = "UPDATE exams SET name=:name, date=:date
                WHERE id =:exam_id";
        $conn->query($sql);
        $conn->bind(":name", $name);
        $conn->bind(":date", $date);
        $conn->bind(":exam_id", $exam_id);
        $send = $conn->execute();
        if ($send) {
            $redirect = $conn->base_url().'exam';
            echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
            <i class='fas fa-check-circle'></i> Exams was updated successfully.
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



