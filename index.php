<?php
session_start();
include 'config.php';
include 'functions.php';

$passErr = $checkErr = $nameErr = $msg= '';

if (isset($_POST['submit'])) {
	$username = test_input($_POST["username"]);
	$password = test_input($_POST["password"]);
	
	if (!empty($username) && !empty($password)) {
		if (!empty($_POST["consent"])) {
		 	$terms = test_input($_POST["consent"]);

		 	$sql = "SELECT * FROM student WHERE name = '$username'";
		 	$query = mysqli_query($conn, $sql);
		 	if ($query) {
		 		$result = mysqli_fetch_assoc($query);
		 		$db_username =$result['name'];
		 		$db_password =$result['regNO'];
		 		if ($db_username == $username && $db_password == $password) {
		 			$_SESSION['username'] = $username;
		 			$msg = "<div class='w3-green container w3-padding w3-round-large' 
		 						style='width:70%;'>
		 						Login Successful
		 						<span>Redirecting <i class='fa fa-spinner w3-text-light-grey w3-large fa-spin fa-fw'></i></span>
		 						<meta http-equiv='refresh' content='2; dashboard.php'>
		 					</div>";
		 		}else{
		 			$msg = "<div class='w3-red w3-padding container w3-round-large' 
		 						style='width:70%;'>
		 						Pls crosscheck your details!
		 					</div>";
		 		}
		 	}else{
		 		$msg = "<div class='w3-red container w3-padding w3-round-large' 
		 					style='width:70%;'>
		 					An error occured!
		 				</div>";
		 	} 
		 	
		}else{
			$checkErr =  "<div class='error'>
		 					Pls accept school terms and conditions!
		 				</div>";
		}
	}else{
	
		$passErr = $nameErr =  "<div class='error'>
		 							must not be empty!
		 						</div>";
	}
		
}


?>





<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Result_checker</title>
	<link rel="stylesheet" type="text/css" href="css/w3.css">
	<link rel="stylesheet" type="text/css" href="css/theme.css">
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
					<h1 class="h-font-size w3-hide-small w3-center">
						Welcome To Glory Land<br><span class="w3-large"> Result Checking Portal.</span>
					</h1>
					<h2 class="w3-text-green w3-center w3-large h-font-size w3-hide-large w3-hide-medium">		Welcome To Glory Land<br><span class="w3-medium"> Result Checking Portal.</span>
					</h2>
				</div>

				<div class="w3-center my-font p-font-size">Please login with your portal details.</div>
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

							<div class="w3-margin-top">
								<input type="checkbox" name="consent" style="margin-left-80px;"><span style="margin:0 7px;">I agree to the <a href="">terms and conditions</a></span><br>
								<span class="error"><?php echo "$checkErr";?></span>
							</div>

							<div class="w3-margin-top">
								<input type="submit" name="submit" value="Submit And Continue" class="w3-btn w3-teal">
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