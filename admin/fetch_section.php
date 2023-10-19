<?php
session_start();
include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();

if(!empty($_POST['classID'])){
    $classID = $_POST['classID'];

    //fetch student's data based on the specific class
    $sql = "SELECT * FROM sections WHERE class = :classID ORDER BY name";
    $conn->query($sql);
    $conn->bind(":classID", $classID);
    //generate HTML of student option
    if($conn->rowCount() > 0){
        $result = $conn->fetchMultiple();

        ?> <option value=''>Select Section</option><?php
        foreach ($result as $section) {
            $section_name = $section->name;
            ?> <option value="<?php echo $section->id; ?>"><?php echo $section_name; ?></option><?php
        }
    }else{
        echo "<option value=''>Section not found.</option>";
    }
}else{
    echo "<option value=''>error occurred.</option>";
}