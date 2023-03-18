<?php 

session_start();

if (isset($_SESSION['username']))
 {
	// code...
	unset($_SESSION['username']);
}

header("Location: login.php");
die;