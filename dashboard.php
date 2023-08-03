<?php
session_start();
include 'config.php';
if (isset($_SESSION['username'])) {
	
	$username = $_SESSION['username'];
}else{
	//redirect to login

	header("location:index.php");
}

$pinErr = $yearErr = $termErr = $dbErr = $msg = $msg1 = $Err = '';

if (isset($_POST['submit'])) {
	$scratch_pin1 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['scratch_pin'], ENT_QUOTES, 'utf-8'));
	$scratch_pin = trim($scratch_pin1);

	$sch_year = mysqli_real_escape_string($conn, htmlspecialchars($_POST['year'], ENT_QUOTES, 'utf-8'));

	$term = mysqli_real_escape_string($conn, htmlspecialchars($_POST['term'], ENT_QUOTES, 'utf-8'));

	$activated_date = date('Y-m-d');

	if (empty($scratch_pin)) {
		$pinErr = 'Pls enter your scratch card pin';
	}
	elseif(empty($sch_year)){
		$yearErr = 'Pls select year';
	}
	elseif(empty($term)){
		$termErr = 'Pls select term';
	}else{
		$sql = "SELECT * FROM generated_pins WHERE pin = '$scratch_pin' LIMIT 1";
		$query = mysqli_query($conn, $sql);
		if (mysqli_num_rows($query) > 0 ) {

			$sql2 = "SELECT * FROM pins WHERE pin_code = '$scratch_pin'";
			$query2 = mysqli_query($conn, $sql2);

			if (mysqli_num_rows($query2) == 0) {
				
				$sql3 = "INSERT INTO pins (pin_code,date_issued,used_by) VALUES('$scratch_pin','$activated_date','$username')";
				$query3 = mysqli_query($conn, $sql3);

				$sql4 = "UPDATE generated_pins SET status = 'used' WHERE pin = '$scratch_pin'";
				$query4 = mysqli_query($conn, $sql4);
				$sql5 = "UPDATE student SET card_serial_no = '$scratch_pin' WHERE name = '$username'";
				$query5 = mysqli_query($conn, $sql5);
					//FETCH RESULT
				$msg = "<div class='w3-green w3-padding-small w3-margin-bottom w3-round-large' style='width:100%;'>
	                Fetching your result.. pls wait<br>

	                <span><i class='fa fa-spinner w3-text-light-grey w3-large fa-spin fa-fw'></i></span>
	               
	                <meta http-equiv='refresh' content='4; view_result.php?name=$username&term=$term&year=$sch_year'>
	             </div>";

				}elseif (mysqli_num_rows($query2) > 0) {
					
					$sql6 = "SELECT * FROM pins WHERE pin_code = '$scratch_pin'";
					$query6 = mysqli_query($conn, $sql6);
					if (mysqli_num_rows($query6) > 0) {
						$check = mysqli_fetch_assoc($query6);
						if ($username === $check['used_by']) {
							//FETCH RESULT

							$msg = "<div class='w3-green w3-margin-bottom w3-padding-small w3-round-large' 			style='width:100%;'>
						                Fetching your result.. pls wait<br>

						                <span><i class='fa fa-spinner w3-text-light-grey w3-large fa-spin fa-fw'></i></span>
						               
						                <meta http-equiv='refresh' content='4; view_result.php?name=$username&term=$term&year=$sch_year'>
						            </div>";
						}else{
							$pinErr = "The pin you entered is already used by another student.";
						}
						
					}

				}//End of if pin is valid.
			

		}else{
			$pinErr = "The pin you entered is invalid.";
		}
	}
}//end of isset POST 'submit'







?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Student Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/w3.css">
	<link rel="stylesheet" type="text/css" href="css/theme.css">
	<style type="text/css">
        body{
            position: relative;
        }
        .msgBox{
            position: absolute;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.9);
            padding: 50px 0;
            height: 100vh;

        }

        .message{
            color: antiquewhite;
            font-size: 1.5rem;
            width: 57%;
            margin: auto;
        }
        .exit{
            font-size: 20px;
            padding: 7px 12px;
            background-color: green;
            color: antiquewhite;
            position: absolute;
            top: 0;
            right: 0;
            cursor: pointer;
        }
    </style>
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
						<h3 style="margin:0;" class="w3-text-light-grey w3-medium my-font">Please complete the form below to check your result.</h3>
					</div>
					<div><?= $msg1 ?></div>
					<div><?= $msg ?></div>
					<div class="w3-light-grey w3-padding-large w3-card-4 w3-padding-32 w3-margin-bottom">
						<form action="#" method="POST">
							<div class="w3-margin-bottom w3-padding w3-blue-gray">
								<input type="text" name="scratch_pin" placeholder="Enter card serial no." class="w3-input">
								<span class="w3-red"><?= $pinErr ?></span>
							</div>

							
							<div class="w3-blue-grey w3-padding w3-margin-bottom">
								<select class="w3-select" name="year">
									<option value="2022/2023">Year 2022/2023</option>
								</select>
								<span class="w3-red"><?= $yearErr ?></span>
							</div>

							<div class="w3-blue-grey w3-padding w3-margin-bottom">
								<select class="w3-select" name="term">
									<option value="">Select Term..</option>
									<option value="first_term">First Term</option>
									<option value="second_term">Second Term</option>
									<option value="third_term">Third Term</option>
									<option value="Common Entrance">Common Entrance</option>
								</select>
								<span class="w3-red"><?= $termErr ?></span>
							</div>

							<div class="w3-margin-bottom">
								<input type="submit" name="submit" value="Check Result" class="w3-btn w3-teal">
							</div>

						</form>
					</div>
				</div>
				<div class="w3-third w3-padding-large">
					<h4 class="w3-large w3-center w3-text-light-grey">PLEASE NOTE</h4>

					<div class="w3-padding-small w3-black" style="margin-top:23px;">
						<p>You have to purchase a scratch card from the school to check your result.</p>
					</div>
					<div class="w3-padding-small w3-light-grey w3-border">
						<p>You are to use the card as many times as possible.</p>
					</div>
					<div class="w3-padding-small w3-red">
						<p>Scratch card expires at the end of the term.</p>
					</div>

					<div class="w3-padding-16 w3-margin-top" style="">
						<ul class="w3-ul">
						<li class="w3-hover-teal"><a href="" class="btn">Dashboard</a></li>
						<li class="w3-hover-teal"><a href="password.php" class="btn">Change Password</a></li>

						<li class="w3-hover-teal"><a href="homework.php" class="btn">Assignments</a></li>
						<li class="w3-hover-teal"><a href="logout.php" class="btn">Logout</a></li>
						<li class="w3-hover-teal"><a href="tel:+2347076602896" class="btn">Contact Admin</a></li>
					</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="w3-center footer" style="width:100%;color: navy;">
		    © 2023 <span class="my-font">CPM Int. School Suleja</span><br> All Rights Reserved
		</div>
	</div>

	<script>
	    if ( window.history.replaceState ) {
	        window.history.replaceState( null, null, window.location.href );
	    }

	    setTimeout(displayMessage, 2100);

		function displayMessage() {
		const body = document.body;

		const panel = document.createElement('div');
		panel.setAttribute('class','msgBox');
		body.appendChild(panel);

		const msg = document.createElement('p');
		msg.textContent = 'Please kindly bear with us, as the results compilation is till ongoing. Therefore you might not be able to check your results now until 6pm on Monday 7th August, 2023. We sincerely apologize for this delay. Thanks for your coperation!';
		panel.appendChild(msg);
		msg.setAttribute('class','message');



		const closeBtn = document.createElement('button');
		closeBtn.textContent = 'Continue';
		closeBtn.setAttribute('class','exit');
		panel.appendChild(closeBtn);

		closeBtn.addEventListener('click', () => panel.parentNode.removeChild(panel));

}
	</script>
</body>
</html>