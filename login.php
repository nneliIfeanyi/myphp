<?php
session_start();
include 'config.php';
include 'functions.php';

$passErr = $nameErr = $msg= $msg2= $username= '';


if ($_SERVER['REQUEST_METHOD'] == "POST" ) {

	$username1 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['username'], ENT_QUOTES, 'utf-8'));
	$username = trim($username1);
	$password = mysqli_real_escape_string($conn, htmlspecialchars($_POST['password'], ENT_QUOTES, 'utf-8'));
	if (empty($username)) {

		$nameErr = "Please kindly enter a username..";

	}elseif (empty($password)) {
		
		$passErr = "Input password..";

	}else{

		if (login_pass($conn, $username, $password)) {
			
			$_SESSION['username'] = $username;
			$msg2 = "Login Successful";
			?>
			<meta http-equiv="refresh" content="2; dashboard.php">
			<?php
		}else{

			$msg = "Invalid Credentials.";
		}

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

				<div class="w3-center my-font p-font-size">Please login with your portal details.
						<?php

					  	if (!empty($msg)) {

					  		?>
					  		<p class="w3-text-red"><?= $msg ?></p>
					  		<?php
					  	}
					 
						?>
							<?php

						  	if (!empty($msg2)) {

						  		?>
						  		<p class="user w3-text-green"><?= $msg2 ?></p>
						  		<?php
						  	}
						 
							?>
						</div>
				<div class="container">
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
						<div class="w3-padding-16">
							<div class="w3-margin-top w3-padding w3-blue-gray">
								<input type="text" name="username" placeholder="Your username" value="<?=$username?>" class="w3-input">
								<span class="error"><?php echo "$nameErr";?></span>
							</div>
							<div class="w3-margin-top w3-padding w3-blue-gray">
								<input type="text" name="password" placeholder="Your password" class="w3-input">
								<span class="error"><?php echo "$passErr";?></span>
							</div>

							

							<div class="w3-center">
								<input type="submit" name="submit" value="Submit And Continue" class="w3-round-large w3-btn w3-teal w3-margin-top">
								<a href="index.php" class="w3-round-large w3-btn w3-margin-top w3-text-teal w3-border">Bact to Homepage</a>
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