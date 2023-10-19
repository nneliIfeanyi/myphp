<?php
include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();

if(!empty($_POST['name']) && !empty($_POST['date'])){
$name = $_POST['name'];
$date = $_POST['date'];


//check if exam already added
$sql = "SELECT * FROM exams WHERE name =:name";
$conn->query($sql);
$conn->bind(":name", $name);

if($conn->rowCount() > 0){
echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i> exam already exists.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";

return false;
}else {

//process  inserting of data into database
$sql = "INSERT INTO exams (name, date) 
        VALUES (:name, :date)";
$conn->query($sql);
$conn->bind(":name", $name);
$conn->bind(":date", $date);


$send = $conn->execute();
$redirect = $conn->base_url().'exam';
if($send){
    echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
                    <i class='fas fa-check-circle'></i> Exam was added successfully.
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



