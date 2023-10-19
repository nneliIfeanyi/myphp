<?php

session_start();
include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();

if(!empty($_POST['name']) && !empty($_POST['password'])
   && !empty($_POST['username'])){

    $name = $_POST['name'];
    $username= $_POST['username'];
    $password= $_POST['password'];
    $user_type = $_POST['user_type'];

    //check if system admin already exists
    $sql = "SELECT * FROM admin WHERE username=:username AND name=:name";
    $conn->query($sql);
    $conn->bind(':username', $username);
    $conn->bind(':name', $name);
    $rowCount = $conn->rowCount();

    if($rowCount > 0){
        echo "<script>
              toastr['error'](' System admin already exists.');
             </script>";
           return false;
    }elseif(!$conn->Checkpassword($password)){
            echo "<script>
            toastr['error']('Password must include one uppercase letter, one lowercase letter, one number,  one special character such as  x $ or % and length should be between 6 and 16.');
        </script>";
    }else{
            
        $sql = "INSERT INTO admin (name, username, password, type) 
        VALUES(:name, :username, :password, :type)";
        $conn->query($sql);
        $conn->bind(":name", $name);
        $conn->bind(":username", $username);
        $conn->bind(":password", $conn->Password_Encryption($password));
        $conn->bind(":type", $user_type);

        $send = $conn->execute();

        if($send){
            echo "<script>
            toastr['success']('System Admin $name was added successfully.');
           </script><meta http-equiv='refresh' content='3; systemadmin'>";


        }else{
            echo "<script>
              toastr['error']('An error occurred while adding system admin.');
             </script><meta http-equiv='refresh' content='3; systemadmin'>";
        }


    }

}else{
   
      echo "<script>
              toastr['error']('Fields marked (*) are required.');
             </script>"; 
}