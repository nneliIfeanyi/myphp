 <?php

 	if (!empty($_GET['result'])) {
 		$file_name = basename($_GET['result']);
 		$file_path = 'admin/results/'.$file_name;
 		if (!empty($file_name) && file_exists($file_path)) {
 			
 			header("Cache-Control: public");

 			header("Content-Description: File Transfer");

 			header("Content-Disposition: attachment; filename=$file_name");

 			header("Content-Type: application/pdf");

 			header("Content-Transfer-Enconding: binary");

 			readfile($file_path);
 			exit;
 		}else{
 			echo "The file does not exist.";
 		}
 	}