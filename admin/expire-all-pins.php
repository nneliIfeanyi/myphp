<?php
include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();

if(!empty($_POST['date'])){
$date = $_POST['date'];


//process  inserting of data into database
$sql = "UPDATE generated_pins SET expired_date = :p_date";
$conn->query($sql);
$conn->bind(":p_date", $date);
$send = $conn->execute();
//process  delete of data in database
$sql2 = "DELETE FROM generated_pins WHERE status = :close";
$conn->query($sql2);
$conn->bind(":close", "close");
$send2 = $conn->execute();
$redirect = $conn->base_url().'exp';
    if($send){
    echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
        <i class='fas fa-check-circle'></i> successfull.
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">×</span>
        </button>
        <meta http-equiv='refresh' content='4; $redirect'>
    </p>";

    }else {

        echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <i class='fas fa-ban'></i> An error occurred while adding data.
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                 <span aria-hidden=\"true\">×</span>
                      </button>
                      <meta http-equiv='refresh' content='4; $redirect'>
               </p>";

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



