<?php

session_start();
include 'config.php';

if (isset($_SESSION['username'])) {
	$name = $_SESSION['username'];
	
	$msg1 = $msg2= $passErr1 = $passErr ='';

	$sql = "select * from student where name = '$name'";
	$result = mysqli_query($conn,$sql);

	$user_data = $result->fetch_assoc(); 
		

	if (isset($_POST['update'])) {
		
		$new_password = $_POST['password'];
		$comfirm_password = $_POST['password2'];

		if (empty($new_password)) {
			$passErr = "Please input password.";

		}elseif(strlen($new_password) < 8) {

			$passErr = "Password must not be less than 8 digits.";
		}elseif (empty($comfirm_password)) {
			
			$passErr1 = "Please comfirm password.";

		}elseif (strlen($comfirm_password) < 8) {
			
			$passErr1 = "Password must not be less than 8 digits.";

		}elseif ($new_password !== $comfirm_password) {

			$passErr1 = "Password does not match.";
		}else{

			$sql = "UPDATE student SET regNO = '$comfirm_password' WHERE name = '$name'";
			$query = mysqli_query($conn, $sql);

			if ($query) {
				
				$msg1 = "<div class='w3-padding w3-margin-top w3-margin-bottom w3-green'>

							You have successfully changed your default password.

						</div>";
			}else{


				$msg1 = "<div class='w3-padding w3-margin-top w3-margin-bottom w3-red'>

							An error occured, pls try later.

						</div>";

			}
		}

	}

?>


	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Students Dashboard</title>
		<link rel="stylesheet" type="text/css" href="css/w3.css">
		<link rel="stylesheet" type="text/css" href="css/theme.css">
		
	</head>
	<body  class="bg-image w3-serif" style="height:100vh;overflow-y: scroll;color: antiquewhite;">
		
		<section class="w3-margin w3-padding-small w3-padding-32" style="background:rgba(0, 0, 0, 0.6);">
			<div class="w3-row-padding">
				<div class="w3-twothird">
				
				<?= $msg1 ?>
				<?= $msg2 ?>
				<h4 class="my-font w3-center">You are advise to change your default password to any password of your choice.</h4>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
					

					<div class="w3-padding w3-blue-gray">
						<label> Your default Password is..</label>
						<input type="text"  class="w3-input" readonly value="<?php echo "{$user_data['regNO']}" ?>">
					</div>

					<div class="w3-padding w3-blue-gray">
						<label>New Password</label>
						<input type="password" name="password" class="w3-input" placeholder="Create new password">
						<span class="w3-red"><?= $passErr ?></span>
					</div>

					<div class="w3-padding w3-blue-gray">
						<label>Comfirm Password</label>
						<input type="password" name="password2" class="w3-input" placeholder="Retype new password">
						<span class="w3-red"><?= $passErr1 ?></span>
					</div>

				
					<div class="w3-margin w3-wide">
						<input class="w3-teal w3-btn" type="submit" value="Update" name="update">
					</div>
				</form>
				</div>
				<div class="w3-third">
					
					<div class="w3-padding-16 w3-margin-top" style="">
						<ul class="w3-ul">
						<li class="w3-hover-teal"><a href="dashboard.php" class="btn">Dashboard</a></li>
						<li class="w3-hover-teal"><a href="logout.php" class="btn">Logout</a></li>
						<li class="w3-hover-teal"><a href="tel:+2347076602896" class="btn">Contact Admin</a></li>
					</ul>
					</div>

				</div>
			</div>
			</section>
		</body>
	</html>

	<?php
	}else{

		?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Students Dashboard</title>
			<link rel="stylesheet" type="text/css" href="css/w3.css">
			<link rel="stylesheet" type="text/css" href="css/theme.css">
			
		</head>
		<body class="w3-serif">
			
			<div class="w3-center w3-text-grey">

				<div class="w3-padding-large w3-margin w3-card-4 w3-padding-16">
					<h4 class="w3-padding-large my-font w3-large">YOU MUST LOGIN FIRST BEFORE ACCESSING THIS PAGE.</h4>


					<meta http-equiv="refresh" content="3; index.php">
				</div>
				
			</div>
		</body>
		</html>

		<?php
	}

	?>
