<?php
session_start();
error_reporting(0);

include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();
$output = '';

if(!empty($_POST['class']) && !empty($_POST['exam']) && !empty($_POST['section'])
&& !empty($_POST['year'])){
  
    $class = $_POST['class'];
    $exam = $_POST['exam'];
    $section = $_POST['section'];
    $exam_year = $_POST['year'];

    
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
               <h3 class='text-center'>Comment Details</h3>
               <div class='text-center'>
                 <span class='text-center' style='display: inline-block;'>Class: <span>$db_class</span></span><br>
                 <span class='text-center' style='display: inline-block;'>Examination: <span>$exam</span></span><br>
                 <span class='text-center' style='display: inline-block;'>Section: <span>$db_section</span></span><br>
                  <span class='text-center' style='display: inline-block;font-size: 20px;'>Year: <span style='color: #296658;'>$exam_year</span></span>
                   <p class='text-info text-center'>Max Length of comment text is 60.</p>
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
                    <th>Marks Obtained</th>
                    <th>Class Teacher's Comment</th>
                    <th>Principal's Comment</th>
                    </thead>";
        $output .= "<tbody>";
        foreach ($result as $student){
            //fetch exam and test scores from database if it exists
            $sql = "SELECT * FROM results WHERE name_of_student = :name AND class=:class AND section =:section AND school_year =:school_year AND exam =:exam";
            $conn->query($sql);
            $conn->bind(":name", $student->name);
            $conn->bind(":section", $db_section);
            $conn->bind(":class", $db_class);
            $conn->bind(":exam", $exam);
            $conn->bind(":school_year", $exam_year);
            $details = $conn->fetchSingle();
            $rowCount = $conn->rowCount();

            if($rowCount > 0){
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
                $conn->bind(":school_year", $exam_year);
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
                $conn->bind(":school_year", $exam_year);
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
                $conn->bind(":school_year", $exam_year);
                $conn->bind(":zero", $zero);
                $total_exam_score = $conn->fetchColumn();

                $total_marks_obtained = $total_first_ca + $total_second_ca + $total_exam_score;

                //fetch student comment from the database
                $sql = "SELECT * FROM comments WHERE student_name=:name AND exam =:exam AND exam_year =:year";
                $conn->query($sql);
                $conn->bind(":name", $student->name);
                $conn->bind(":exam", $exam);
                $conn->bind(":year", $exam_year);
                $result_details = $conn->fetchSingle();
                $teacher_comment = $result_details->class_teacher_comment;
                $principal_comment = $result_details->principal_comment;
                $comment_id = $result_details->id;

            }//second rowcount if statement

            //fetch students' photo
            $student_image = $student->photo;
            if(empty($student_image)){
                $student_image = "<img src='images/default.png' width='32' height='32'>";
            }else{
                $student_image = "<img src='upload/$student->photo' width='32' height='32'>";
            }
            $reg_no = $student->registerNO;
            $output.= "<tr>
                     <td>$count</td>
                     <td>$student_image </td>
                     <td><input type='hidden' name='student_name[]' value='$student->name'>$student->name</td>
                     <td><input type='hidden' name='reg_no[]' value='$reg_no'>$reg_no</td>
                      <td>$total_marks_obtained</td>
                <td><input type='text' name='teacher_comment[]' placeholder='Class Teacher Comment' class='form-control' maxlength='60' value='$teacher_comment'></td>
                <td><input type='text' name='principal_comment[]' placeholder='Principal Comment' class='form-control'  maxlength='60' value='$principal_comment'></td>
                  
                <input type='hidden' name='class[]' value='$db_class'>
                <input type='hidden' name='section[]' value='$db_section'>
                <input type='hidden' name='exam[]' value='$exam'>
                <input type='hidden' name='exam_year[]' value='$exam_year'>
                <input type='hidden' name='comment_id[]' value='$comment_id'>
               
                </tr>";
              $count++;
        }//first rowcount if statement

        $output .= "</tbody>";
        $output .= "<tfoot>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Reg No</th>
                    <th>Marks Obtained</th>
                    <th>Class Teacher's Comment</th>
                    <th>Principal's Comment</th>
                   </tfoot>";

        $output.= "</table>";
        $output.= "</div>";
        $output .= "<tr><td colspan='8'><input type='submit' name='submit_comment' value='Add Comment' class='btn btn-dark'></td></tr>";
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