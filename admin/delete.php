<?php
session_start();

include '../config.php';
include '../functions.php';


if (isset($_GET['name']) && isset($_GET['year'])) {
	
	$name = $_GET['name'];
	$year = $_GET['year'];

	$sql = "DELETE FROM terminal_report WHERE exam_year = '$year' AND student_name = '$name' LIMIT 1";
	$query = mysqli_query($conn, $sql);

	if ($query) {
		
		?>
			<script type="text/javascript">
				alert('Result deleted successfully for <?php echo $name ?>')
			</script>
			<meta http-equiv="refresh" content="2; view_uploaded.php">
		<?php

	}else{

		?>
			<script type="text/javascript">
				alert('An error occured while deleting result.')
			</script>
			<meta http-equiv="refresh" content="3; all_students.php">
		<?php


	}

}elseif (isset($_GET['name2'])) {
	
	$name = $_GET['name2'];

	$sql = "DELETE FROM student WHERE name = '$name'";
	$query = mysqli_query($conn, $sql);

	$sql = "DELETE FROM terminal_report WHERE student_name = '$name'";
	$query2 = mysqli_query($conn, $sql);

	if ($query && $query2) {
		
		?>
			<script type="text/javascript">
				alert('Delete successfull')
			</script>
			<meta http-equiv="refresh" content="2; all_students.php">
		<?php

	}else{

		?>
			<script type="text/javascript">
				alert('An error occured while deleting result.')
			</script>
			<meta http-equiv="refresh" content="3; all_students.php">
		<?php


	}

}elseif (isset($_GET['pin']) && isset($_GET['id'])) {
	
	$used_pin = $_GET['pin'];
	$pin_id = $_GET['id'];

	$sql = "DELETE FROM generated_pins WHERE id = '$pin_id' AND pin = '$used_pin' LIMIT 1";
	$query = mysqli_query($conn, $sql);

	if ($query) {
		
		?>
			<script type="text/javascript">
				alert('Pin deleted successfully.')
			</script>
			<meta http-equiv="refresh" content="2; generate_pin.php">
		<?php

	}else{

		?>
			<script type="text/javascript">
				alert('An error occured while deleting pin.')
			</script>
			<meta http-equiv="refresh" content="3; generate_pin.php">
		<?php


	}
}