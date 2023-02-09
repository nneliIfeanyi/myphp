<?php

session_start();
include 'config.php';

if (isset($_SESSION['username'])) {
	$name = $_SESSION['username'];
	
	$msg1 = $msg2= $nameErr = $name2 = $classErr= $genderErr ='';

	if (isset($_GET['name2'])) {
		
		$name2 = $_GET['name2'];
		$sql = "SELECT * FROM student WHERE name = '$name2' ";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {

			while ($info = mysqli_fetch_assoc($result)) {

				$id = $info['ID'];
				
				$dbname= $info['name'];
			}
			
		}else{

			echo "Something is fishing with the entire system, call for repair..";
		}
	}else{

		?>
			<meta http-equiv="refresh" content="10; upload_result.php">

		<?php
	}
		

	if (isset($_POST['update'])) {
		
		$stu_name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['name'], ENT_QUOTES, 'utf-8'));
		$stu_class =mysqli_real_escape_string($conn, htmlspecialchars($_POST['class'], ENT_QUOTES, 'utf-8'));
		$sex = mysqli_real_escape_string($conn, htmlspecialchars($_POST['sex'], ENT_QUOTES, 'utf-8'));


			$sql = "UPDATE student SET name = '$stu_name', sex = '$sex', classesID = '$stu_class' WHERE ID = '$id'";

			$query = mysqli_query($conn, $sql);

			if ($query) {

				echo "$id $dbname";
				
				$msg1 = "<div class='w3-padding w3-margin-top w3-margin-bottom w3-green'>

							Changes made successfully.

						</div>";
			}else{


				$msg1 = "<div class='w3-padding w3-margin-top w3-margin-bottom w3-red'>

							An error occured, pls try later.

						</div>";

			}
		

	}

?>


	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Students Dashboard</title>
		<link rel="stylesheet" type="text/css" href="../css/w3.css">
		<link rel="stylesheet" type="text/css" href="../css/theme.css">
		
	</head>
	<body  class="bg-image w3-serif" style="height:100vh;overflow-y: scroll;color: antiquewhite;">
		
		<section class="w3-margin w3-padding-small w3-padding-32" style="background:rgba(0, 0, 0, 0.6);">
			<div class="w3-row-padding">
				<div class="w3-twothird">
				
				<?= $msg1 ?>
				<?= $msg2 ?>
				<h4 class="my-font w3-center">You are editing <?= $name2 ?>'s info.</h4>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
					

					<div class="w3-padding w3-blue-gray">
						<label>Edit Name</label>
					<input type="text"  class="w3-input" name="name" value="<?= $dbname ?>">
					</div>

					<div class="w3-margin-bottom w3-padding-16">
					    <label for="classID">Reselect Class</label>
					    <select name="class" id="classID" class="w3-text-dark-grey">
					        <option value="">Select class</option>
					        <option value="ss1">S.S.1</option>
					        <option value="ss2">S.S.2</option>
					        <option value="ss3">S.S.3</option>
					        <option value="js1">J.S.1</option>
					        <option value="js2">J.S.2</option>
					        <option value="js3">J.S.3</option>

					    </select>
					    <span><?php echo $classErr; ?></span>
					</div>

					<div class="w3-margin-bottom w3-padding-16">
					    <input type="radio" name="sex" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
					    <input type="radio" name="sex" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
					    <input type="radio" name="sex" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
					    <span> <?php echo $genderErr;?></span>
					</div>

				
					<div class="w3-margin w3-wide">
						<input class="w3-teal w3-btn" type="submit" value="Update Student's info" name="update">
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
			<title>Admin Dashboard</title>
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
