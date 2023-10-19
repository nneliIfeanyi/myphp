<?php
session_start();
error_reporting(0);
include "includes/database.php";
include "includes/functions.php";

$conn = new Functions();
$base_url = $conn->base_url();
$output = '';

if(!empty($_POST['class']) && !empty($_POST['exam']) && !empty($_POST['section']) && !empty($_POST['year'])){

    $class = $_POST['class'];
    $exam = $_POST['exam'];
    $section = $_POST['section'];
    $year = $_POST['year'];

    $sql = "SELECT name FROM exams WHERE name = :name";
    $conn->query($sql);
    $conn->bind(":name", $exam);
    $db_exam = $conn->fetchColumn();
    $slugify_exam = $conn->slugify($db_exam);

    $sql = "SELECT name FROM sections WHERE id = :id";
    $conn->query($sql);
    $conn->bind(":id", $section);
    $db_section = $conn->fetchColumn();
    $slugify_section = $conn->slugify($db_section);

    //fetch class names
    $sql = "SELECT name FROM classes WHERE id = :id";
    $conn->query($sql);
    $conn->bind(":id", $class);
    $db_class = $conn->fetchColumn();
    $slugify_class = $conn->slugify($db_class);

    $count = 1;

    //fetch students names based on the selected class
    $sql = "SELECT * FROM student WHERE classesID = :class AND sectionid =:section";
    $conn->query($sql);
    $conn->bind(":class", $class);
    $conn->bind(":section", $section);

    $rowCount = $conn->rowCount();

    if($rowCount > 0){

        $result = $conn->fetchMultiple();
        $output = "<div class='card-body'>";
        $output.= "<div class='col-md-12 jumbotron'>
                   <h3 class='text-center'>Student Details</h3>
                   <div class='text-center'>
                   <span class='text-center' style='display: inline-block;'>Class: <span>$db_class</span></span><br>
                   <span class='text-center' style='display: inline-block;'>Examination: <span>$exam</span></span><br>
                   <span class='text-center' style='display: inline-block;'>Section: <span>$db_section</span></span><br>
                   <span class='text-center' style='display: inline-block;'>Year: <span>$year</span></span>
                  </div>

            </div>";

        $output.= "<div class='table-responsive'>";
        $output .= "<table class='table table-bordered table-hover table-stripped' id='teacher'>
                 <thead>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Reg No</th>
                        <th>Action</th>
                    </thead>";

        $output .= "<tbody>";

        foreach ($result as $student){
        $name_of_student = $conn->slugify($student->name);
            //fetch exam and test scores from db if it exists
            $sql = "SELECT * FROM results WHERE name_of_student = :name  
                    AND class=:class AND section =:section
                    AND school_year =:school_year AND exam =:exam";
            $conn->query($sql);
            $conn->bind(":name", $student->name);
            $conn->bind(":section", $db_section);
            $conn->bind(":class", $db_class);
            $conn->bind(":exam", $exam);
            $conn->bind(":school_year", $year);
            $details = $conn->fetchSingle();
            $rowCount = $conn->rowCount();

            if($rowCount > 0){
                $existing_test_scores = $details->test;
                $existing_exam_scores = $details->exam_score;
                $score_id = $details->id;
            }

            $student_image = $student->photo;

            if(empty($student_image)){
                $default_image_url = $base_url.'images/default.png';
                $student_image = "<img src='$default_image_url' width='32' height='32'>";
            }else{
                $main_image_url = $base_url."upload/$student->photo";
                $student_image = "<img src='$main_image_url' width='32' height='32'>";
            }

            $reg_no = $student->registerNO;
            $result_url = $base_url."generate_report/$name_of_student/$slugify_exam/$slugify_section/$slugify_class/$year";
            $output.= "<tr>
                <td>$count</td>
                <td>$student_image </td>
                <td>$student->name</td>
                <td>$reg_no</td>
                <td>
                  <a href='$result_url' target='_blank'><i class=\"fa fa-check-square\"></i </a>
              </td>
              
            </tr>";
            $count++;

        }

        $output .= "</tbody>";

        $output .= "<tfoot>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Reg No</th>
                        <th>Action</th>
                    </tfoot>";
        $output.= "</table>";
        $output.= "</div>";
        $output.= "</div>";

        echo $output;

    }else{
        echo "<p style='padding: 30px; text-align: center; '> No Students found for the selected details.</p>";
    }

}else{
    echo "<p class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
              <i class='fas fa-ban'></i>
                Fields marked (*) are required.
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                             <span aria-hidden='true'>×</span>
                  </button>
           </p>";

}