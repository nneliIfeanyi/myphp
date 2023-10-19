<?php
include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();

if(!empty($_POST['name']) && !empty($_POST['grade_point']) 
   && !empty($_POST['mark_from']) && !empty($_POST['mark_upto'])
   && !empty($_POST['note'])){
   
    $grade_name = $_POST['name'];
    $grade_point = $_POST['grade_point'];
    $mark_from = $_POST['mark_from'];
    $mark_upto = $_POST['mark_upto'];
    $note = $_POST['note'];


//check if exam already added

$sql = "SELECT * FROM grade WHERE grade_name=:name";
$conn->query($sql);
$conn->bind(':name', $grade_name);

if($conn->rowCount() > 0){
echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i> Grade name already exists.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";

return false;
}else {

//process  inserting of data into database
$sql = "INSERT INTO grade (grade_name,  grade_point, mark_from, mark_upto, note) VALUES(:grade_name, :grade_point, :mark_from, :mark_upto, :note)";
$conn->query($sql);
$conn->bind(":grade_name", $grade_name);
$conn->bind(":grade_point", $grade_point);
$conn->bind(":mark_from", $mark_from);
$conn->bind(":mark_upto", $mark_upto);
$conn->bind(":note", $note);


$send = $conn->execute();
$redirect = $conn->base_url().'grade';
if($send){
    echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
                    <i class='fas fa-check-circle'></i> Grade was added successfully.
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



