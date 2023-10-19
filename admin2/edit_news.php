<?php

session_start();
include '../config.php';

if (isset($_SESSION['username'])) {
	$name = $_SESSION['username'];
	
	$msg1 = $msg2= $nameErr = $name2 = $classErr= $genderErr ='';

	if ($_GET['t_id']) {
		
		$id = $_GET['t_id'];
		$sql = "SELECT * FROM blog WHERE id = '$id' ";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {

			$info = mysqli_fetch_assoc($result);

				$id = $info['id'];
				
				$dbtitle= $info['title'];
				$dbbody = $info['body'];
				
		
		}else{

			echo "Something is fishy with the entire system, call for repair..";
		}
	}else{


		if (isset($_POST['update'])) {

			$id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['id'], ENT_QUOTES, 'utf-8'));
			
			$title = mysqli_real_escape_string($conn, htmlspecialchars($_POST['title'], ENT_QUOTES, 'utf-8'));
			$body =mysqli_real_escape_string($conn, htmlspecialchars($_POST['body'], ENT_QUOTES, 'utf-8'));


			$sql = "UPDATE blog SET title='$title',body='$body' WHERE id = '$id'";

			$query = mysqli_query($conn, $sql);

			if ($query) {
				
				$msg1 = "<div class='w3-padding w3-margin-top w3-margin-bottom w3-green'>

							Changes made successfully.

						</div>";
						?>
						<meta http-equiv="refresh" content="2; news_update.php">

						<?php

						$sql = "SELECT * FROM blog WHERE id = '$id' ";
						$result = mysqli_query($conn, $sql);

						if (mysqli_num_rows($result) > 0) {

							while ($info = mysqli_fetch_assoc($result)) {

								$id = $info['id'];
								
								$dbtitle= $info['title'];
								$dbbody = $info['body'];
					
							}
							
						}
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
		<link rel="stylesheet" type="text/css" href="../css/w3.css">
		<link rel="stylesheet" type="text/css" href="../css/theme.css">
		
	</head>
	<body  class="bg-image w3-serif" style="height:100vh;overflow-y: scroll;color: antiquewhite;">
		
		<section class="w3-margin w3-padding-small w3-padding-32" style="background:rgba(0, 0, 0, 0.6);">
			<div class="w3-row-padding">
				<div class="w3-twothird w3-padding-16">
				
				<?= $msg1 ?>
				<?= $msg2 ?>
				
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
					<div class="w3-padding-32 w3-grey w3-padding">

					<div class="w3-padding-small w3-card w3-margin-bottom">
						<label class="">Edit Title</label>
					<input type="text"  class="w3-input" name="title" value="<?= $dbtitle ?>">
					</div>

					<div class="w3-padding-small w3-card">
						<label class="">Edit Message Body</label>
					<input type="text"  class="w3-input" name="body" value="<?= $dbbody ?>">
					</div>


					
				
					<div class="w3-padding-16 w3-wide">
						<input type="hidden" name="id" value="<?=$id?>">
						<input name="update" type="submit" value="Update" class="w3-teal w3-btn">
					</div>
				</div>
				</form>
				</div>
				<div class="w3-col m12 l12 s12">
					
					<div class="w3-padding-16 w3-margin-top" style="">
						<ul class="w3-ul">
						<li class=""><a href="news_update.php" class="w3-btn w3-hover-teal"><span class="w3-small">&#10094;&#10094;</span> Go Back</a></li>
						<li class=""><a href="logout.php" class="w3-btn w3-hover-teal">Logout</a></li>
						
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
