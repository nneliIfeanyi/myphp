<?php
session_start();
include '../config.php';
include '../functions.php';

$passErr = $checkErr = $nameErr = $msg= '';

if (isset($_POST['submit'])) {
	$username = test_input($_POST["username"]);
	$password = test_input($_POST["password"]);
	
	if (!empty($username) && !empty($password)) {

	 	$sql = "SELECT * FROM admin WHERE user_name = '$username'";
	 	$query = mysqli_query($conn, $sql);
	 	if (mysqli_num_rows($query) > 0) {
	 		$result = mysqli_fetch_assoc($query);
	 		$db_username =$result['user_name'];
	 		$db_password =$result['password'];
	 		if ($db_username == $username && $db_password == $password) {
	 			$_SESSION['username'] = $username;
	 			$msg = "<div class='w3-green container w3-padding w3-round-large' 
	 						style='width:70%;'>
	 						Login Successful
	 						<span>Redirecting <i class='fa fa-spinner w3-text-light-grey w3-large fa-spin fa-fw'></i></span>
	 						<meta http-equiv='refresh' content='2; dashboard.php'>
	 					</div>";
	 		}else{
	 			$msg = "<div class='w3-red  w3-padding container w3-round-large' 
	 						style='width:70%;font-size:16px;'>
	 						Pls Crosscheck Your Details!
	 					</div>";
	 		}
	 	}else{
	 		$msg = "<div class='w3-red container w3-padding w3-round-large' 
	 					style='width:70%;'>
	 					An error occured!
	 				</div>";
	 	} 
		 	
	}else{
	
		$msg =  "<div class='error container'>
					Enter username and password.
				</div>";
	}
		
}


?>





<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Login</title>
	<link rel="stylesheet" type="text/css" href="../css/w3.css">
	<link rel="stylesheet" type="text/css" href="../css/theme.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="w3-serif">
	<div class="bg-image w3-padding-32" style="height:100vh;overflow-y: scroll;">
		<div class="container main-content">
			<div class="w3-padding  w3-card-4 w3-text-light-grey">
				 <div class="w3-center w3-margin-top">
				 	<img src="images/badge.jpg" width="100" height="100" class="w3-circle">
				 </div>
				<div class="container">
					<h1 class="w3-hide-small w3-center h-font-size ">
						<span style="font-weight: 400;opacity: 0.86;"> Welcome To Glory Land</span><br><span style=""> School Management System.</span>
					</h1>
					<h2 class="w3-text-green w3-center w3-large h-font-size w3-hide-large w3-hide-medium">		Welcome To Glory Land<br><span class="w3-medium"> School Management System.</span>
					</h2>
				</div>

				<div class="w3-center my-font p-font-size">Please login with Admin Username and Password.</div>
					<?php echo $msg ;?>
				<div class="container">
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
						<div class="w3-padding-16">
							<div class="w3-margin-top w3-padding w3-blue-gray">
								<input type="text" name="username" placeholder="Your username" class="w3-input">
								<span class="error"><?php echo "$nameErr";?></span>
							</div>
							<div class="w3-margin-top w3-padding w3-blue-gray">
								<input type="text" name="password" placeholder="Your password" class="w3-input">
								<span class="error"><?php echo "$passErr";?></span>
							</div>

							<div class="w3-center">
								<input type="submit" name="submit" value="Submit And Continue" class="w3-round-large w3-btn w3-teal w3-margin-top">
								<a href="../index.php" class="w3-round-large w3-btn w3-margin-top w3-text-teal w3-border">Bact to Homepage</a>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>

		<div class="w3-center footer" style="width:100%;color: navy;">
		    © 2023 <span class="my-font">CPM Int. School Suleja</span><br> All Rights Reserved
		</div>

</div>

		<!-- copyright -->
		

	<script>
	    if ( window.history.replaceState ) {
	        window.history.replaceState( null, null, window.location.href );
	    }
	</script>
</body>
</html>