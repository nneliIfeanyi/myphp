<?php
session_start();
error_reporting(0);

include '../admin/includes/database.php';
include '../admin/includes/functions.php';
$conn= new Functions();
$output = '';

if(!empty($_POST['class']) && !empty($_POST['exam']) && !empty($_POST['section'])
&& !empty($_POST['subject'])){
  
    $class = $_POST['class'];
    $exam = $_POST['exam'];
    $section = $_POST['section'];
    $subject = $_POST['subject'];
    $exam_year = $_POST['exam_year'];

    $sql = "SELECT subject_name FROM subjects WHERE id = :id";
    $conn->query($sql);
    $conn->bind(":id", $subject);
    $db_subject = $conn->fetchColumn();
    
    $sql = "SELECT name FROM sections WHERE id = :id";
    $conn->query($sql);
    $conn->bind(":id", $section);
    $db_section = $conn->fetchColumn();

    //fetch class names
    $sql = "SELECT name FROM classes WHERE id = :id";
    $conn->query($sql);
    $conn->bind(":id", $class);
    $db_class = $conn->fetchColumn();

    $zero = 0;
    $total_marks_obtained = '';

       //fetch current section from settings table

       $sql = "SELECT current_school_session FROM general_settings";
       $conn->query($sql);
       $current_school_section = $conn->fetchColumn();

    
    $count = 1;
    //fetch students names based on the selected class
    $sql = "SELECT * FROM student WHERE classesID = :class AND sectionid =:section ORDER BY name ASC";
    $conn->query($sql);
    $conn->bind(":class", $class);
    $conn->bind(":section", $section);
    $rowCount = $conn->rowCount();
    if($rowCount > 0){

        $result = $conn->fetchMultiple();
        $output = "<div class='card-body'>";
        $output.= "<div class='col-md-12 jumbotron'>
               <h3 class='text-center'>Mark Details</h3>
               <div class='text-center'>
                 <span class='text-center' style='display: inline-block;'>Class: <span>$db_class</span></span><br>
                 <span class='text-center' style='display: inline-block;'>Examination: <span>$exam</span></span><br>
                 <span class='text-center' style='display: inline-block;'>Section: <span>$db_section</span></span><br>
                 <span class='text-center' style='display: inline-block;'>Subject: <span>$db_subject</span></span>
                  </div>
         
         </div>";

        $output .= "<form method='post' action='' id='add-exam-scores'>";
        $output.= "<div class='table-responsive'>";
        $output .= "<table class='table table-bordered table-hover table-stripped' id='teacher'>
                        <thead>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Reg No</th>
                        <th>1st CA (20%)</th>
                        <th>2nd CA (20%)</th>
                        <th>Exam (60%)</th>
                    </thead>";
        $output .= "<tbody>";
        foreach ($result as $student){
            //fetch exam and test scores from database if it exists
            $sql = "SELECT * FROM results WHERE name_of_student = :name AND subject=:subject AND class=:class AND section =:section AND school_year =:school_year AND exam =:exam";
            $conn->query($sql);
            $conn->bind(":name", $student->name);
            $conn->bind(":subject", $db_subject);
            $conn->bind(":section", $db_section);
            $conn->bind(":class", $db_class);
            $conn->bind(":exam", $exam);
            $conn->bind(":school_year", date('Y'));
            $details = $conn->fetchSingle();
            $rowCount = $conn->rowCount();

            if($rowCount > 0){
                $existing_first_ca_scores = $details->first_ca;
                $existing_second_ca_scores = $details->second_ca;
                $existing_exam_scores = $details->exam_score;
                $score_id = $details->id;

                //fetch first_ca, second_ca and exam totals
                $sql = "SELECT SUM(first_ca) FROM results WHERE name_of_student = :name  
                        AND second_ca != :zero 
                        AND first_ca != :zero 
                       AND exam_score != :zero 
                      AND class=:class AND section =:section 
                     AND school_year =:school_year AND exam =:exam";
                $conn->query($sql);
                $conn->bind(":name", $student->name);
                $conn->bind(":section", $db_section);
                $conn->bind(":class", $db_class);
                $conn->bind(":exam", $exam);
                $conn->bind(":school_year", date('Y'));
                $conn->bind(":zero", $zero);
                $total_first_ca = $conn->fetchColumn();

                //fetch second CA
                $sql = "SELECT SUM(second_ca) FROM results WHERE name_of_student = :name  
                        AND second_ca != :zero 
                        AND first_ca != :zero 
                       AND exam_score != :zero 
                      AND class=:class AND section =:section 
                     AND school_year =:school_year AND exam =:exam";
                $conn->query($sql);
                $conn->bind(":name", $student->name);
                $conn->bind(":section", $db_section);
                $conn->bind(":class", $db_class);
                $conn->bind(":exam", $exam);
                $conn->bind(":school_year", date('Y'));
                $conn->bind(":zero", $zero);
                $total_second_ca = $conn->fetchColumn();

                //select total exam score

                $sql = "SELECT SUM(exam_score) FROM results WHERE name_of_student = :name  
                        AND second_ca != :zero 
                        AND first_ca != :zero 
                       AND exam_score != :zero 
                      AND class=:class AND section =:section 
                     AND school_year =:school_year AND exam =:exam";
                $conn->query($sql);
                $conn->bind(":name", $student->name);
                $conn->bind(":section", $db_section);
                $conn->bind(":class", $db_class);
                $conn->bind(":exam", $exam);
                $conn->bind(":school_year", date('Y'));
                $conn->bind(":zero", $zero);
                $total_exam_score = $conn->fetchColumn();

                $total_marks_obtained = $total_first_ca + $total_second_ca + $total_exam_score;
            }//second rowcount if statement

            //fetch students' photo
            $student_image = $student->photo;
            if(empty($student_image)){
                $student_image = "<img src='../admin/images/default.png' width='32' height='32'>";
            }else{
                $student_image = "<img src='../admin/upload/$student->photo' width='32' height='32'>";
            }
            $reg_no = $student->registerNO;
            $output.= "<tr>
                     <td>$count</td>
                     <td>$student_image </td>
                     <td><input type='hidden' name='student_name[]' value='$student->name'>$student->name</td>
                     <td><input type='hidden' name='reg_no[]' value='$reg_no'>$reg_no</td>
                     <td><input type='number' name='first_ca_score[]' placeholder='1st CA' class='form-control' max='20' min='0' value='$existing_first_ca_scores'></td>
                     <td><input type='number' name='second_ca_score[]' placeholder='2nd CA' class='form-control' max='20' min='0' value='$existing_second_ca_scores'></td>
                     <td><input type='number' name='exam_score[]' placeholder='Exam score' class='form-control' max='60' min='0' value='$existing_exam_scores'></td>
                <input type='hidden' name='class[]' value='$db_class'>
                <input type='hidden' name='subject[]' value='$db_subject'>
                <input type='hidden' name='section[]' value='$db_section'>
                <input type='hidden' name='exam[]' value='$exam'>
                <input type='hidden' name='exam_year[]' value='$exam_year'>
                <input type='hidden' name='score_id[]' value='$score_id'>
                <input type='hidden' name='total_score[]' value='$total_marks_obtained'>
                <input type='hidden' name='current_school_section[]' value='$current_school_section'>
                </tr>";
              $count++;
        }//first rowcount if statement

        $output .= "</tbody>";
        $output .= "<tfoot>
                      <th>#</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Reg No</th>
                        <th>1st CA (20%)</th>
                        <th>2nd CA (20%)</th>
                        <th>Exam (60%)</th>
                   </tfoot>";

        $output.= "</table>";
        $output.= "</div>";
        $output .= "<tr><td colspan='4'><input type='submit' name='submit_result' value='Add Mark' class='btn btn-dark'></td></tr>";
        $output .= "</form>";
        $output .= "</div>";

        echo $output;

    }else{
        echo "<p style='padding: 30px; text-align: center; '>No Students found for the selected class.</p>";
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