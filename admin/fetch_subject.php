<?php
session_start();
include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();

if(!empty($_POST['classID'])){
    $classID = $_POST['classID'];

    //fetch student's data based on the specific class
    $sql = "SELECT * FROM subjects WHERE class_id = :classID ORDER BY subject_name";
    $conn->query($sql);
    $conn->bind(":classID", $classID);
    //generate HTML of student option
    if($conn->rowCount() > 0){
        $result = $conn->fetchMultiple();

        ?> <option value=''>Select Subject</option><?php
        foreach ($result as $subject) {
            $subject_name = $subject->subject_name;
            ?> <option value="<?php echo $subject->id; ?>"><?php echo $subject_name; ?></option><?php
        }
    }else{
        echo "<option value=''>Subject not found.</option>";
    }
}else{
    echo "<option value=''>error occurred.</option>";
}