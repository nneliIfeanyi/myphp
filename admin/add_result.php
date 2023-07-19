<?php
session_start();
include '../config.php';
include '../functions.php';

	if (!isset($_SESSION['username'])) {
		header("location:login.php");
	}

	$msg1 = $msg2 = $Err1 = $Err2 = $Err3 ='';

	$id = $_GET['addResult'];
	

	if (isset($_POST['update'])) {

		$sql = "SELECT * FROM student WHERE name = '$id' LIMIT 1";
		$query = mysqli_query($conn, $sql);
		$info = mysqli_fetch_assoc($query);

		$class = $info['classesID'];
		$sch_year = mysqli_real_escape_string($conn, htmlspecialchars($_POST['year'], ENT_QUOTES, 'utf-8'));
		$term = mysqli_real_escape_string($conn, htmlspecialchars($_POST['term'], ENT_QUOTES, 'utf-8'));

		$result_file = $_FILES['result']['name'];
		$file_nameArr = explode(".", $result_file);
		$extension = end($file_nameArr);
		$ext = strtolower($extension);
		$unique_name = rand(100, 999).rand(100, 999).'.'.$ext;

		$result_folder = "results/".$unique_name;
		$db_result_file = "results/".$unique_name;
		


		if (empty($sch_year)) {

		    $Err1 = "<div class='error' style='width:70%;font-size:16px;'>
		                     Pls select year.
		                 </div>";
		}elseif(empty($term)){
		    $Err2 = "<div class='error' style='width:70%;font-size:16px;'>
		                    Term is required!
		                </div>";

		}
		elseif(empty($result_file)) {

			$Err3 = "<div class='error' style='width:70%;font-size:16px;'>
			                Choose result file!
			            </div>";
		}
		elseif($ext !== 'pdf'){

				$Err3 = "<div class='error' style='width:70%;font-size:16px;'>
				               Only pdf files are allowed!
				            </div>";
		}elseif($ext == 'pdf'){		            

			$check = "SELECT * FROM terminal_report WHERE exam_year = '$sch_year' AND exam_term = '$term' AND student_name = '$id'";
            $check_user = mysqli_query($conn, $check);
            $row_count = mysqli_num_rows($check_user);

            if ($row_count > 0 ) {
            	
                	$msg2 = "<div class='w3-red w3-padding-small w3-round-large' 			style='width:70%;margin-left:20px;'>
                                Already added <span style='font-weight:bold;color:antiquewhite;'> $term </span> result for <span style='font-weight:bold;color:antiquewhite;'>$id </span>!
                               
                                <meta http-equiv='refresh' content='4; upload_result.php'>
                             </div>";
               }else{ 

	            	move_uploaded_file($_FILES['result']['tmp_name'],$result_folder);

				  	$sql2= "INSERT INTO terminal_report (classID,report_card,student_name,exam_year,exam_term) VALUES ('$class','$db_result_file','$id','$sch_year','$term')";

					$result = mysqli_query($conn,$sql2);

					if ($result) {
						

						$msg1 = "<div class='w3-green w3-padding-small w3-round-large' style='width:70%;margin-left:20px;'>
		                                Result Added Successfully.
		                                <span><i class='fa fa-spinner w3-text-light-grey w3-large fa-spin fa-fw'></i></span>
		                                <meta http-equiv='refresh' content='4; upload_result.php'>
		                             </div>";


					}else{
						
						$msg1 = "<div class='w3-green w3-padding-small w3-round-large' style='width:70%;margin-left:20px;'>
		                                An error occured.
		                                <span><i class='fa fa-spinner w3-text-light-grey w3-large fa-spin fa-fw'></i></span>
		                                <meta http-equiv='refresh' content='4; upload_result.php'>
		                             </div>";


				}
			}
		
		}

		
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>School Admin Dashboard</title>
    <!-- custom-theme -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="CPM School Result Checking Portal." />

    <!-- //custom-theme -->
    <!-- css files -->
    <link href="../css/w3.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/theme.css">
    <!-- //css files -->
  </head>

  <body class="bg-image w3-serif" style="height:100vh;overflow-y: scroll;color: antiquewhite;">


  <section class="w3-margin w3-padding" style="background:rgba(0, 0, 0, 0.6);">
    <div class="w3-row-padding">
      	<div class="w3-twothird">
  
      		<h1 class="w3-text-light-grey">Upload Result For <span class="w3-text-red w3-opacity-min"><?php echo $id; ?></span></h1>

				<?php echo $msg1 ?>
				<?php echo $msg2 ?>
			<div class="w3-padding-16">
				<form action="#" method="POST" enctype="multipart/form-data">

					<div class="w3-grey w3-padding w3-margin-bottom">
						<select class="w3-select" name="year">
							<option value="">Select schoolsession..</option>
							<option value="2022/2023">2022/2023</option>
						</select>
						<span><?php echo $Err1; ?></span>
					</div>

					<div class="w3-grey w3-padding w3-margin-bottom">
						<select class="w3-select" name="term">
							<option value="">Choose Term..</option>
							<option value="first_term">First Term</option>
							<option value="second_term">Second Term</option>
							<option value="third_term">Third Term</option>
							<option value="Common Entrance">Common Entrance</option>
						</select>

						<span><?php echo $Err2; ?></span>
					</div>

					<div class="w3-grey w3-padding w3-margin-bottom">
						<label class="w3-text-red w3-opacity-min">UPLOAD RESULT:</label><br>
						<input type="file" name="result">

						<span><?php echo $Err3; ?></span>
					</div>


					<div class="w3-margin-bottom">
						<input class="w3-teal w3-btn" type="submit" value="Upload Result" name="update">
					</div>
				</form>
			</div>
    	</div>
    		<div class="w3-col m12 l12 s12">
					
					<div class="w3-padding-16 w3-margin-top" style="">
						<ul class="w3-ul">
						<li class=""><a href="upload_result.php" class="w3-btn w3-hover-teal"><span>&#10094;&#10094;</span> Go Back</a></li>
						<li class=""><a href="logout.php" class="w3-btn w3-hover-teal">Logout</a></li>
						
					</ul>
					</div>

				</div>
  </div>
</section>
     
</body>

  <!-- //body ends -->
  </html>