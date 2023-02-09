<?php
session_start();
include 'config.php';
if (isset($_SESSION['username'])) {
	
	$username = $_SESSION['username'];
}else{
	//redirect to login

	header("location:index.php");
}
 $Err = $msg1 = $classErr =$dateErr=$subErr= $msg=$view ='';
   if (isset($_POST['check'])) {

	$class = mysqli_real_escape_string($conn, htmlspecialchars($_POST['class'], ENT_QUOTES, 'utf-8'));
	$subject = mysqli_real_escape_string($conn, htmlspecialchars($_POST['subject'], ENT_QUOTES, 'utf-8'));
	$submit_date = mysqli_real_escape_string($conn, htmlspecialchars($_POST['submit_date'], ENT_QUOTES, 'utf-8'));

		if (empty($class)) {
		  $classErr = "Pls select class.";
		}elseif (empty($subject)) {
		  $subErr = "Please select subject.";
		}elseif (empty($submit_date)) {
		  $dateErr = "Submission date of the assignment is required.";

		}else{

			$sql = "SELECT * FROM homework WHERE class = '$class' AND subject = '$subject' AND sub_date = '$submit_date' ";
			$query = mysqli_query($conn, $sql);

			if (mysqli_num_rows($query) > 0) {

				$no = 1;
				while ($info = mysqli_fetch_assoc($query)) {

					$id = $info['id'];
					$dq1 = $info['one'];
					$dq2 = $info['two'];
					$dq3 = $info['three'];
					$dq4 = $info['four'];
					$dq5 = $info['five'];
					$dq6 = $info['six'];
					$dq7 = $info['sev'];
					$dq8 = $info['eight'];
					$dq9 = $info['nine'];
					$dq10 = $info['ten'];
					$no++;
				}

				$view = "


						<h3 class='w3-padding-16 w3-blue w3-center'><b>PREVIEW $subject ASSIGNMENT</b></h3>
						  <table class='w3-table-all'>
						    <thead>
						      <tr class='w3-text-black'>
						        <th><b>Questions</b></th>
						      </tr>
						    </thead>

						    <tbody>
						    	<tr>
							    	<td>1. $dq1</td>
						    	</tr>

						    	<tr>
							    	<td>2. $dq2</td>
						    	</tr>

						    	<tr>
							    	<td>3. $dq3</td>
						    	</tr>

						    	<tr>
							    	<td>4. $dq4</td>
						    	</tr>

						    	<tr>
							    	<td>5. $dq5</td>
						    	</tr>

						    	<tr>
							    	<td>6. $dq6</td>
						    	</tr>

						    	<tr>
							    	<td>7. $dq7</td>
						    	</tr>

						    	<tr>
							    	<td>8. $dq8</td>
						    	</tr>

						    	<tr>
							    	<td>9. $dq9</td>
						    	</tr>

						    	<tr>
							    	<td>10. $dq10</td>
						    	</tr>

						    </tbody>
						  </table>




				";

			}else{
				

				$view = "


						<h3 class='w3-padding-16 w3-blue w3-center'><b>PREVIEW ASSIGNMENT</b></h3>
						  <table class='w3-table-all'>
						    <thead>
						      <tr class='w3-text-black'>
						        <th><b>Questions</b></th>
						      </tr>
						    </thead>

						    <tbody>
						    	<tr class='w3-text-red'>
							    	<td>There is no posted assignment for the subject you are looking for, Kindly crosscheck the Submission date you enterd or contact your subject teacher.</td>
						    	</tr>

						    </tbody>
						  </table>




				";
			}

		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Student Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/w3.css">
	<link rel="stylesheet" type="text/css" href="css/theme.css">
</head>
<body class="w3-serif">
	<div class="bg-image1 w3-padding-32" style="height:100vh;overflow-y: scroll;">
		<div class="w3-margin main-content w3-padding-32">
			<div class="w3-row-padding">
				<div class="w3-twothird">
					<div class="w3-center">
						<h1 style="margin:0;color: antiquewhite;" class="w3-large w3-padding-large">
							WELCOME <?php echo "$username";?>
						</h1>
						<h3 style="margin:0;" class="w3-text-light-grey w3-medium my-font">Please kindly fiil out the form below to check for Assignments.</h3>
					</div>
					<div><?= $msg1 ?></div>
					<div><?= $msg ?></div>
					<div class="w3-light-grey w3-padding-large w3-card-4 w3-padding-32 w3-margin-bottom">
						<form action="#" method="POST">
							<div class="w3-margin-bottom w3-margin-top w3-grey w3-padding-small">

							  <select name="class" class="w3-select">
							    <option value="">--Select Class--</option>
							    <option value="js1">JS 1</option>
							    <option value="js2">JS 2</option>
							    <option value="js3">JS 3</option>
							    <option value="ss1">SS 1</option>
							    <option value="ss2">SS 2</option>
							    <option value="ss3">SS 3</option>
							  </select><br>
							  <span class="w3-red"><?= $classErr ?></span>
							</div>

							<div class="w3-margin-bottom w3-grey w3-padding-small">

							  <select name="subject" class="w3-select">
							    <option value="">--Select Subject--</option>
							    <option value="english">English Lang.</option>
							    <option value="maths">mathematics</option>
							    <option value="commerce">commerce</option>
							    <option value="government">government</option>
							    <option value="physics">physics</option>
							    <option value="chemistry">chemistry</option>
							    <option value="geography">geography</option>
							    <option value="fishery">fishery</option>
							    <option value="C.R.K">C.R.K</option>
							    <option value="lit. in english">lit. in english</option>
							    <option value="agric">agriculture</option>
							    <option value="economics">economics</option>
							    <option value="biology">biology</option>
							    <option value="civiv">civiv</option>
							    <option value="account">account</option>
							    <option value=""></option>
							    <option value=""></option>
							  </select>
							  <span class="w3-red"><?= $subErr ?></span>
							</div>

							<div class="w3-grey w3-padding-small w3-margin-bottom">
							  <label for="sub_date">Submission Date</label>
							  <input type="date" name="submit_date" id="sub_date" min="2023-01-01"><br>
							  <span class="w3-red"><?= $dateErr ?></span>
							</div>

							<div class="w3-margin-bottom">
								<input type="submit" name="check" value="Check" class="w3-btn w3-teal">
							</div>

						</form>
					</div>
				</div>
				<div class="w3-twothird w3-padding-small">
							

							<?= $view ?>

				</div>

				<div class=" w3-twothird w3-padding-16 w3-margin-top" style="">
		           <ul class="w3-ul w3-center">
		           <li class="w3-hover-teal"><a href="dashboard.php" class="btn w3-wide">Return</a></li>
		         </ul>
		        </div>
			</div>
		</div>

		<div class="w3-center footer" style="width:100%;color: navy;">
		    © 2023 <span class="my-font">CPM Int. School Suleja</span><br> All Rights Reserved
		</div>
	</div>
</body>
</html>