<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


function login_pass($conn,$username,$password){

  $sql = "SELECT * FROM student WHERE name = '$username'";
  $query = mysqli_query($conn, $sql);
  $row_count = mysqli_num_rows($query);
  $guest = mysqli_fetch_assoc($query);

    if ($row_count > 0 && $guest['name'] == $username && $guest['regNO'] == $password){
      
      return true;
      
    }else{

      return false;
    }

}
