<?php
session_start();
include '../admin/includes/database.php';
include '../admin/includes/functions.php';
$conn= new Functions();

if(isset($_SESSION['teacher'])){

$username = $_SESSION['teacher'];
$sql = "SELECT * FROM teachers WHERE username =:username";
$conn->query($sql);
$conn->bind(":username", $username);

$result = $conn->fetchSingle();
$teacher_name = $result->name;

if(!empty($_POST['classID'])){
    $classID = $_POST['classID'];

    //fetch student's data based on the specific class
    $sql = "SELECT * FROM subjects WHERE class_id = :classID AND teacher_name =:name ORDER BY subject_name";
    $conn->query($sql);
    $conn->bind(":classID", $classID);
    $conn->bind(":name", $teacher_name);
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

}