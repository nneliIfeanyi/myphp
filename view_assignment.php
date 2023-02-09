<?php
session_start();

include '../config.php';
include '../functions.php';

if(!isset($_SESSION['username'])){
    
    header('location:index.php');

}else{
  $username = $_SESSION['username'];

  if (isset($_POST['check'])) {
  	$class = $_GET['class'];
  	$subject = $_GET['subject'];
  	$sub_date = $_GET['sub_date'];

  	$sql = "SELECT * FROM homework WHERE class = '$class' AND subject = '$subject' AND sub_date = '$sub_date'";
  	$query = mysqli_query($conn, $sql);

  	if ($query) {

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

  	}else{
  		echo "try again";
  	}

  }else{
  	header("location:dashboard.php");
  }

  
	  	



 ?>



<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <title>Admin Login</title>
	  <link rel="stylesheet" type="text/css" href="../css/w3.css">
	  <link rel="stylesheet" type="text/css" href="../css/theme.css">
	  <link rel="stylesheet" type="text/css" href="../css/style.css">
	  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body class="bg-image w3-serif" style="height:100vh;overflow-y: scroll;color: antiquewhite;">
		<section class="w3-margin w3-padding-small w3-padding-32" style="background:rgba(0, 0, 0, 0.8);">

			<div class="w3-row-padding">
			
			<div class="w3-twothird w3-margin-bottom">
				<div class="w3-light-grey w3-round">

					
						<h3 class="w3-padding-16 w3-blue w3-center"><b>PREVIEW ASSIGNMENT</b></h3>
						  <table class="w3-table-all">
						    <thead>
						      <tr class="w3-text-black">
						        <th><b>Questions</b></th>
						      </tr>
						    </thead>

						    <tbody>
						    	<tr>
							    	<td><?= '1' . '.' . ' ' .$dq1 ?></td>
						    	</tr>

						    	<tr>
							    	<td><?= '2' . '.' . ' ' .$dq2 ?></td>
						    	</tr>

						    	<tr>
							    	<td><?= '3' . '.' . ' ' .$dq3 ?></td>
						    	</tr>

						    	<?php 
						    		if (empty($dq4)) {
						    			// code...
						    		}else{
						    			?>

				    			    	<tr>
				    				    	<td><?= '4' . '.' . ' ' .$dq4 ?></td>
				    			    	</tr>

						    			<?php
						    		}

						    		if (empty($dq5)) {
						    			// code...
						    		}else{

						    			?>
				    			    	<tr>
				    				    	<td><?= '5' . '.' . ' ' .$dq5 ?></td>
				    			    	</tr>

						    			<?php 
						    		}

						    		if (empty($dq6)) {
						    			// code...
						    		}else{
						    			?>

				    			    	<tr>
				    				    	<td><?= '6' . '.' . ' ' .$dq6 ?></td>
				    			    	</tr>

						    			<?php
						    		}

						    		if (empty($dq7)) {
						    			// code...
						    		}else{
						    			?>

				    			    	<tr>
				    				    	<td><?= '7' . '.' . ' ' .$dq7 ?></td>
				    			    	</tr>

						    			<?php
						    		}

						    		if (empty($dq8)) {
						    			// code...
						    		}else{
						    			?>

				    			    	<tr>
				    				    	<td><?= '8' . '.' . ' ' .$dq8 ?></td>
				    			    	</tr>

						    			<?php
						    		}

						    		if (empty($dq9)) {
						    			// code...
						    		}else{
						    			?>

				    			    	<tr>
				    				    	<td><?= '9' . '.' . ' ' .$dq9 ?></td>
				    			    	</tr>

						    			<?php
						    		}


						    		if (empty($dq10)) {
						    			// code...
						    		}else{
						    			?>

				    			    	<tr>
				    				    	<td><?= '10' . '.' . ' ' .$dq10 ?></td>
				    			    	</tr>

						    			<?php
						    		}
						    	?>
									


						    </tbody>
						  </table>

						  <div class="w3-margin w3-padding-16"><a href="dashboard.php" class="w3-btn w3-padding w3-blue" >Return</a></div>

						
				</div>
			</div>
			

				<?php

					include 'menu.php';

				?>

			</div>

		</section>

		
		<div class="w3-center footer" style="width:100%;color: navy;">
		       © 2023 <span class="my-font">CPM Int. School Suleja</span><br> All Rights Reserved
		</div>

	</body>
</html>

<?php

	}
?>