<?php

session_start();
include('includes/database.php');
include('includes/functions.php');

$conn = new Functions();

if(!empty($_POST['old_password']) AND !empty($_POST['new_password'])){
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $username = $_POST['username'];

    //validate password 
    if(!$conn->Checkpassword($new_password)){
        echo "<p class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
               <i class='fas fa-ban'></i>
                 Password must include one uppercase letter, one lowercase letter, one number,  
                  one special character such as $ or % and length should be between 6 and 16.
                   <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                              <span aria-hidden='true'>×</span>
                   </button>
            </p>";
        return false;
 
    }
  //check if old password matches the one in database
  $sql = "SELECT * FROM admin WHERE username = :username";
  $conn->query($sql);
  $conn->bind(":username", $username);
  $result = $conn->fetchSingle();
  $db_password = $result->password;

  $existing_password = $conn->password_check($old_password, $db_password);
  $crypt_new_password = $conn->password_check($new_password, $db_password);
  if(!$existing_password){
    echo "<p class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
           <i class='fas fa-ban'></i>
             Your old password does not match with the one we have in our record.
               <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>×</span>
               </button>
        </p>";
    return false;
}

if($crypt_new_password == $new_password){
    echo "<p class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
          <i class='fas fa-ban'></i>
            Your cannot use the same password for old and new.
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                         <span aria-hidden='true'>×</span>
              </button>
       </p>";
    return false;
}

 //all checks passed, update password in database

 $sql = "UPDATE admin SET password =:password WHERE username =:username";
 $conn->query($sql);
 $conn->bind(":password", $conn->Password_Encryption($new_password));
 $conn->bind(":username", $username);

 if($conn->execute()){

      echo "<p class='alert alert-success alert-dismissible fade show text-center' role='alert'>
           <i class='fas fa-check-circle'></i>
             Your password was updated successfully.
               <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>×</span>
               </button>
               <meta http-equiv='refresh' content='4; index'>
        </p>";


 }else{
        echo "<p class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
           <i class='fas fa-ban'></i>
             An error occurred while updating password.
               <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>×</span>
               </button>
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