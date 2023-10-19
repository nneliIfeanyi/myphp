<?php
session_start();
include 'includes/database.php';
include 'includes/functions.php';

$login = new Functions();

if(!empty($_POST['username']) AND !empty($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    //check if username is valid
    if(!$login->loginCheck($username, $password)){
        echo "<script>
                toastr['error']('Double check your details');
          </script>";
    }else{
        //login user in
        $sql = "SELECT * FROM admin WHERE username =:username";
        $login->query($sql);
        $login->bind(":username", $_POST['username']);
        try{
            $result = $login->fetchSingle();
            $username = $result->username;
            $_SESSION['username'] = $username;
            $redirect = $login->base_url();
            echo "<script>
                toastr['success']('Login Successful. Redirecting to Account Dashboard');
          </script><meta http-equiv='refresh' content='4; $redirect'>";
            echo "<div class='spinner-border text-info text-center' role='status'>
                    <span class='sr-only'>Loading.....</span>

                 </div>";
        }catch (PDOException $err){
            echo "<script>
                toastr['error']('An error occurred.');
          </script>";
        }
    }

}else{
    echo "<script>
                toastr['error']('Both username and password are required.');
          </script>";
}
