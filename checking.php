<?php 
if (isset($_POST['submit'])) {
   # $stu_name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['name'], ENT_QUOTES, 'utf-8'));

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
    	    <link rel="stylesheet" type="text/css" href="css/theme.css">
    	    <link rel="stylesheet" type="text/css" href="css/w3.css">

    	    <style type="text/css">
    	    	#height{
    	    		display: none;
    	    	}
    	    </style>
    	</head>
    	<body>
    		
    		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
    			
    			<div class="w3-padding w3-blue-gray">
    				<label>eMAIL</label>
    				<input type="text"  class="w3-input" name="name">
    			</div>

    			<input type="submit" value="Submit" name="continue" class="w3-btn w3-padding w3-blue w3-round">

    		</form>

    	</body>
    	</html>

    <?php

}elseif (isset($_POST['continue'])) {

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
	    <link rel="stylesheet" type="text/css" href="../css/theme.css">
	    <link rel="stylesheet" type="text/css" href="../css/w3.css">
	</head>
	<body>
		
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
			
			<div class="w3-padding w3-blue-gray">
				<label>Number</label>
				<input type="text"  class="w3-input" name="name">
			</div>

			<input type="submit" value="Submit" name="submit2" class="w3-btn w3-padding w3-blue w3-round">

		</form>

	</body>
	</html>

    <?php

	
}elseif (isset($_POST['submit2'])) {

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
	    <link rel="stylesheet" type="text/css" href="../css/theme.css">
	    <link rel="stylesheet" type="text/css" href="../css/w3.css">
	</head>
	<body>
		
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
			
			<div class="w3-padding w3-blue-gray">
				<label>Address</label>
				<input type="text"  class="w3-input" name="name">
			</div>

			<input type="submit" value="Submit" name="submit" class="w3-btn w3-padding w3-blue w3-round">

		</form>

	</body>
	</html>

    <?php

	
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
    <link rel="stylesheet" type="text/css" href="../css/theme.css">
    <link rel="stylesheet" type="text/css" href="../css/w3.css">
</head>
<body id="height">
	
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
		
		<div class="w3-padding w3-blue-gray">
			<label>Name</label>
			<input type="text"  class="w3-input" name="name">
		</div>

		<input type="submit" value="Submit" name="submit" class="w3-btn w3-padding w3-blue w3-round">

	</form>

</body>
</html>