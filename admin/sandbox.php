<?php

include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();

//fetch students class details 

$sql = "SELECT DISTINCT(classesID) FROM student";
$conn->query($sql);
$chart_data = '';
$result_set = $conn->fetchMultiple();




foreach ($result_set as $student_details) {

    //fetch class names
    $sql = "SELECT name FROM classes WHERE id= :classesID";
    $conn->query($sql);
    $conn->bind(":classesID", $student_details->classesID);
    $class_name = $conn->fetchColumn();

    //total number of students per class
    $sql = "SELECT COUNT(classesID) FROM student WHERE classesID =:classID";
    $conn->query($sql);
    $conn->bind(":classID", $student_details->classesID);
    $total_students = $conn->fetchColumn();
    $chart_data .= "{ class:'".$class_name."', students:".$total_students.",}, ";



////     echo "<pre>";
////     print_r("Class->". $class_name . " Total Students->". $total_students);
////
////     echo "</pre>";

};

$chart_data = substr($chart_data, 0, -1);



