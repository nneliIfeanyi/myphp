<?php
session_start();
//error_reporting(0);
require_once('TCPDF-main/tcpdf.php');
include 'includes/database.php';
include 'includes/functions.php';

$conn = new Functions();
$redirect = $conn->base_url();
$back_to_terminal_report = $conn->base_url()."terminal-report";

if(isset($_GET['name']) AND isset($_GET['exam']) AND isset($_GET['year'])
    AND isset($_GET['class']) AND isset($_GET['section'])) {
    $name = str_replace('-', ' ', $_GET['name']);
    $exam = str_replace('-', ' ', $_GET['exam']);
    $year = $_GET['year'];
    $new_year = $year - 1 . '/'. $year;
    $class =str_replace('-', ' ', $_GET['class']);
    $section = str_replace('-', ' ', $_GET['section']);
    $zero = 0;
    $sql = "SELECT * FROM results WHERE name_of_student =:student AND first_ca != :zero AND second_ca != :zero AND exam_score != :zero
            AND class =:class AND exam=:exam AND section =:section AND school_year =:year ORDER BY subject ASC";
    $conn->query($sql);
    $conn->bind(":student", $name);
    $conn->bind(":zero", $zero);
    $conn->bind(":class", $class);
    $conn->bind(":exam", $exam);
    $conn->bind(":section", $section);
    $conn->bind(":year", $year);
    $rowcount = $conn->rowCount();


    if ($rowcount > 0) {
        $result = $conn->fetchMultiple();
        //fetch students class teacher and principal comment
        $sql = "SELECT * FROM comments WHERE student_name=:name AND exam =:exam AND exam_year =:exam_year";
        $conn->query($sql);
        $conn->bind(":name", $name);
        $conn->bind(":exam", $exam);
        $conn->bind(":exam_year", $year);
        $details = $conn->fetchSingle();
        $teacher_comment = $details->class_teacher_comment;
        $principal_comment = $details->principal_comment;

        //fetch students' attendance details
        $sql = "SELECT * FROM attendance WHERE student_name=:name AND exam =:exam AND exam_year =:exam_year";
        $conn->query($sql);
        $conn->bind(":name", $name);
        $conn->bind(":exam", $exam);
        $conn->bind(":exam_year", $year);
        $details = $conn->fetchSingle();
        $attendance = $details->attendance;

        //fetch teachers name for the student class
        $sql = "SELECT teacher_name FROM classes WHERE name =:name";
        $conn->query($sql);
        $conn->bind(":name", $class);
        $teacher_name = $conn->fetchColumn();





        class PDF extends TCPDF
        {
            public $conn;

            //students variables

            private $student_name;


            public function Header()
            {
                $conn = new Functions();
                //fetch all available school  information
                $sql = "SELECT * FROM general_settings";
                $conn->query($sql);
                $result_set = $conn->fetchSingle();
                $school_logo = $result_set->logo;
                $school_name = $result_set->school_name;
                $school_tagline = $result_set->school_tagline;
                $phone_no = $result_set->phone_no;
                $email = $result_set->email;
                $address = $result_set->address;
                $school_website = $result_set->school_website;
                global $total_marks_obtained;

                $imageFile = "upload/$school_logo";
                $this->Image($imageFile, 30, 2, 20, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
                $this->Ln(2);
                $this->SetFont('helvetica', 'B', 20);
                $this->cell(205, 2, "$school_name", 0, 1, "C");
                $this->SetFont('helvetica', 'B', 10);
                $this->cell(190, 3, "$school_tagline", 0, 1, "C");


                if(!empty($school_website)){
                    $this->SetFont('helvetica', 'B', 10);
                    $this->cell(190, 2, "Website:    $school_website", 0, 1, "C");
                    $this->SetFont('helvetica', '');
                    $this->cell(86, 0, '__________________________________________________________________________________________________', 0, '', '', '');

                }
                $this->Ln();
                $this->SetFont('helvetica', '');
                $conn = new Functions();
                global  $name;
                global $class;
                global $exam;
                global $section;
                global $year;
                global $new_year;
                $this->student_name = $name;
                $sql = "SELECT * FROM results WHERE name_of_student =:name AND class =:class 
                                AND exam=:exam AND section =:section AND school_year =:year";
                $conn->query($sql);
                $conn->bind(":name", $this->student_name);
                $conn->bind(":class", $class);
                $conn->bind(":exam", $exam);
                $conn->bind(":section", $section);
                $conn->bind(":year", $year);
                $result = $conn->fetchSingle();
                $class = $result->class;
                $name_student = $result->name_of_student;
                $current_school_session = $result->current_school_session;

                //fetch reg no
                $sql = "SELECT registerNO FROM student WHERE name =:name";
                $conn->query($sql);
                $conn->bind(":name", $name_student);
                $reg_no = $conn->fetchColumn();
                $new_section = ucfirst($section);
                $new_exam = ucfirst($exam);

                //fetch student profile image
                $sql = "SELECT photo FROM student WHERE name =:name";
                $conn->query($sql);
                $conn->bind(":name", $name_student);
                $photo = $conn->fetchColumn();
                if(empty($photo)){
                    $img_file = 'upload/default.png';
                }else{
                    $img_file = "upload/$photo";
                }


                $html = "
              <div class='row'>
                 <div class='col-md-3'>
                   <p class='pad'><strong>Address:</strong> $address</p>   
                   <p><strong>Email:</strong> $email</p> 
                   <p><strong>Academic Year:</strong> $current_school_session </p> 
                </div>
              </div>
              <style>
                h3{font-size: 12px; text-transform: lowercase !important;}  
                p{font-size: 11px; line-height: 10px;} 
                span{font-size: 12px;}
             </style>
            ";
                $html2 = "
              <div class='row'>
                 <div class='col-md-3'>
                   <p>Name:<strong> $name_student</strong></p>
                   <p><strong>Reg No:</strong> $reg_no </p>
                  <p><strong>Class:</strong> $new_section</p>
                   
                  
                </div>
              </div>
              <style>
                h3{font-size: 12px;}  
                h3 span{font-weight: 400 !important; font-size: 11px;}
                p{font-size: 11px; line-height: 10px;} 
                div{padding-right: 20px;}
                .pad{margin-top:4px !important;}
             </style>
            ";

                //fetch marks obtainable
                $sql = "SELECT DISTINCT(subject) FROM results WHERE name_of_student =:name AND school_year =:year";
                $conn->query($sql);
                $conn->bind(":name", $name_student);
                $conn->bind(":year", $year);
                $rowcount = $conn->rowCount();
                $obtainable_mark = $rowcount * 100;

                //fetch student gender
                $sql = "SELECT sex FROM student WHERE name =:student_name";
                $conn->query($sql);
                $conn->bind(":student_name", $name_student);
                $gender = $conn->fetchColumn();
                $html3 = "
              <div class='row'>
                 <div class='col-md-3'>
                   <p><strong>Marks Obtainable:</strong>$obtainable_mark</p>
                  <p><strong>Gender:</strong> $gender <strong></p>
                  <p><strong>Term:</strong> $new_exam </p>
                </div>
              </div>
              <style> 
                p{font-size: 11px; line-height: 10px;} 
                div{padding-right: 20px;}
             </style>
            ";


                $this->WriteHtmlCell(50, 10, '', 15, $html);
                $this->WriteHtmlCell(40, 20, 70, 16, $html2);
                $this->WriteHtmlCell(40, 20, 120, 16, $html3);
                $this->Image($img_file, 170, 28, 32, 32, '', '', '', false, 300, '', false, false, 0);


            }

            public function Footer()
            {

                $this->SetY(-245);
                $this->Ln(8);
                $this->SetFont('times', 'B', '10');
                $this->MultiCell(189, 5, 'TERMINAL REPORT', 0, 'L', 0, 1, '', '', true);

            }


        }


// create new PDF document
        $pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
        global $school_name;
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor("$school_name");
        $pdf->SetTitle('Terminal Report');


// set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

// ---------------------------------------------------------

// set font
        $pdf->SetFont('helvetica', '', 10);

// add a page
        $pdf->AddPage();
        $sql = "SELECT * FROM general_settings";
        $conn->query($sql);
        $result_details = $conn->fetchSingle();
        $terminal_report_bg = $result_details->terminal_report_bg_image;
        $principal_name = $result_details->principal_name;
        $school_stamp = $result_details->school_stamp;

        if(!empty($terminal_report_bg)){
            //add background image
            $url_bg = $redirect."upload/$terminal_report_bg";
            $pdf->Image("$url_bg", 60, 70, 90);
        }

        $pdf->Ln(38);
        $pdf->SetFillColor(224, 225, 255);
        $pdf->Cell(45, 4, 'Subject', 1, 0, 'L', 1);
        $pdf->Cell(25, 4, '1st CA (20%)', 1, 0, 'L', 1);
        $pdf->Cell(25, 4, '2nd CA (20%)', 1, 0, 'L', 1);
        $pdf->Cell(25, 4, 'Exam (60%)', 1, 0, 'L', 1);
        $pdf->Cell(25, 4, 'Total (100%)', 1, 0, 'L', 1);
        $pdf->Cell(20, 4, 'Grade', 1, 0, 'L', 1);
        $pdf->Cell(27, 4, 'Remark', 1, 0, 'L', 1);

        foreach ($result as $report_details) {
            $subject_offered = $report_details->subject;
            $first_ca_score = $report_details->first_ca;
            $second_ca_score = $report_details->second_ca;
            $exam_score = $report_details->exam_score;
            $total_score = $exam_score + $first_ca_score + $second_ca_score;
            $total_subjects_offered = $rowcount;
            //fetch total first CA score

            $sql = "SELECT SUM(first_ca) FROM results WHERE name_of_student = :student AND first_ca != :zero AND exam_score != :zero AND second_ca != :zero
                      AND class =:class AND exam=:exam AND section =:section AND school_year =:year";
            $conn->query($sql);
            $conn->bind(":student", $name);
            $conn->bind(":zero", $zero);
            $conn->bind(":class", $class);
            $conn->bind(":exam", $exam);
            $conn->bind(":section", $section);
            $conn->bind(":year", $year);

            $total_first_ca_score = $conn->fetchColumn();

            //fetch total second CA score

            $sql = "SELECT SUM(second_ca) FROM results WHERE name_of_student = :student AND first_ca != :zero AND exam_score != :zero AND second_ca != :zero
                      AND class =:class AND exam=:exam AND section =:section AND school_year =:year";
            $conn->query($sql);
            $conn->bind(":student", $name);
            $conn->bind(":zero", $zero);
            $conn->bind(":class", $class);
            $conn->bind(":exam", $exam);
            $conn->bind(":section", $section);
            $conn->bind(":year", $year);

            $total_second_ca_score = $conn->fetchColumn();

            //fetch total exam score
            $sql = "SELECT SUM(exam_score) FROM results WHERE name_of_student = :student AND first_ca != :zero AND second_ca != :zero AND exam_score != :zero
                     AND class =:class AND exam=:exam AND section =:section AND school_year =:year";
            $conn->query($sql);
            $conn->bind(":student", $name);
            $conn->bind(":zero", $zero);
            $conn->bind(":class", $class);
            $conn->bind(":exam", $exam);
            $conn->bind(":section", $section);
            $conn->bind(":year", $year);

            $total_exam_score = $conn->fetchColumn();

            //fetch exam grades and remarks

            $sql = "SELECT * FROM grade WHERE :student_score BETWEEN mark_from AND mark_upto";
            $conn->query($sql);
            $conn->bind(":student_score", $total_score);
            $result = $conn->fetchSingle();
            $grade = $result->grade_name;
            $remark = $result->note;
            //show the values
            $pdf->Ln(6); //this will reduce the line height of each subject
//            $pdf->SetTextColor(14, 93,117);
            $pdf->Cell(48, 3, $subject_offered, 0, 0, "L");
            $pdf->Cell(25, 3, $first_ca_score, 0, 0, "L");
            $pdf->Cell(25, 3, $second_ca_score, 0, 0, "L");
            $pdf->Cell(25, 3, $exam_score, 0, 0, "L");
            $pdf->Cell(25, 3, $total_score, 0, 0, "L");
            $pdf->Cell(20, 3, $grade, 0, 0, "L");
            $pdf->Cell(20, 3, $remark, 0, 0, "L");

        }
        $pdf->Ln(4);
        $pdf->MultiCell(189, 7, '______________________________________________________________________________________________', 0, 'L', 0, 1, '', '', true);
        $pdf->SetTextColor(14, 93,117);
        $pdf->SetFont('times', 'B', '11');
        $pdf->Cell(48, 4, 'Total', 0, 0, "L");
        $pdf->Cell(25, 4, $total_first_ca_score, 0, 0, "L");
        $pdf->Cell(25, 4, $total_second_ca_score, 0, 0, "L");
        $pdf->Cell(25, 4, $total_exam_score, 0, 0, "L");
        $pdf->Cell(20, 4, $total_exam_score + $total_first_ca_score + $total_second_ca_score, 0, 0, "L");
        $total_marks_obtained = $total_exam_score + $total_first_ca_score + $total_second_ca_score;
        global $total_marks_obtained;
        $pdf->Ln(8);
        $mark_average = round(($total_exam_score + $total_first_ca_score + $total_second_ca_score) / $total_subjects_offered, 2);
        $pdf->SetTextColor(0, 0,0);
        $pdf->SetFont('times', 'B', '11');
        $pdf->Cell(21, 4, "Percentage: ", 0, 0, "L");
        $pdf->SetFont('times', 'N', '11');
        $pdf->Cell(40, 4, "$mark_average %", 0, 0, "L");

        //fetch class position visibility status

        $sql = "SELECT show_position FROM classes WHERE name =:name";
        $conn->query($sql);
        $conn->bind(":name", $class);
        $show_hide_position = $conn->fetchColumn();

        //fetch student position
        $sql = "SELECT position FROM student_class_positions WHERE name=:name AND class=:class AND section =:section
            AND exam =:exam AND exam_year =:exam_year";
        $conn->query($sql);
        $conn->bind(":name", $name);
        $conn->bind(":class", $class);
        $conn->bind(":exam", $exam);
        $conn->bind(":section", $section);
        $conn->bind(":exam_year", $year);
        $student_position = $conn->fetchColumn();

        if($show_hide_position == 'yes'){
            //position in class start
            $pdf->SetTextColor(0, 0,0);
            $pdf->SetFont('times', 'B', '11');
            $pdf->Cell(30, 4, "Position in class: ", 0, 0, "L");
            $pdf->SetFont('times', 'N', '11');
            $pdf->Cell(40, 4, $student_position, 0, 0, "L");
            //position in class end
        }
        $pdf->Ln(6);
        $pdf->SetFont('times', 'B', '11');
        $pdf->Cell(47, 4, "Class Teacher's Comment: ______________________________________", 0, 0, "L");
        $pdf->SetTextColor(0, 0,0);
        $pdf->SetFont('times', 'N', '10');
        $pdf->Cell(40, 4, "$teacher_comment", 0, 0, "L");

        $pdf->Ln(6);
        $pdf->SetFont('times', 'B', '11');
        $pdf->Cell(40, 4, "Class Teacher's Name: ", 0, 0, "L");
        $pdf->SetTextColor(14, 93,117);
        $pdf->SetFont('times', 'N', '10');
        $pdf->Cell(40, 5, "$teacher_name", 0, 0, "L");

        $pdf->Ln(6);
        $pdf->SetTextColor(0, 0,0);
        $pdf->SetFont('times', 'B', '11');
        $pdf->Cell(40, 4, "Principal's Comment: __________________________________________", 0, 0, "L");
        $pdf->SetTextColor(0, 0,0);
        $pdf->SetFont('times', 'N', '10');
        $pdf->Cell(40, 4, "$principal_comment", 0, 0, "L");

        $pdf->Ln(6);
        $pdf->SetFont('times', 'B', '11');
        $pdf->Cell(40, 4, "Principal's Name: ", 0, 0, "L");
        $pdf->SetTextColor(14, 93,117);
        $pdf->SetFont('times', 'N', '10');
        $pdf->Cell(40, 4, "$principal_name", 0, 0, "L");

        $pdf->Ln(10);
        $pdf->SetTextColor(14, 93,117);
        $pdf->SetFont('times', 'B', '11');
        $pdf->Cell(21, 5, "Attendance:", 0, 0, 'L', 0);
        $pdf->SetTextColor(0, 0,0);
        $pdf->SetFont('times', 'N', '10');
        $pdf->Cell(20, 6, "$attendance times", 0, 0, 'L', 0);


        $sql = "SELECT * FROM general_settings";
        $conn->query($sql);
        $result_set = $conn->fetchSingle();
        $next_term_begins =$result_set->next_term_begins;
        $next_term_begins1 = date_create($next_term_begins);
        $new_next_term_begins = date_format($next_term_begins1, 'F d, Y');
        $no_times_school_open = $result_set->no_times_school_open;
        $footer = $result_set->footer;
//        $pdf->Ln(10);
        $pdf->SetTextColor(14, 93,117);
        $pdf->SetFont('times', 'B', '11');
        $pdf->Cell(30, 5, "Next term begins:", 0, 0, 'L', 0);
        $pdf->SetTextColor(0, 0,0);
        $pdf->SetFont('times', 'N', '10');
        $pdf->Cell(37, 5, "$new_next_term_begins", 0, 0, 'L', 0);
        $pdf->SetTextColor(14, 93,117);
        $pdf->SetFont('times', 'B', '11');
        $pdf->Cell(45, 5, "No of times school opened:", 0, 0, 'L', 0);
        $pdf->SetTextColor(0, 0,0);
        $pdf->SetFont('times', 'N', '10');
        $pdf->Cell(10, 6, "$no_times_school_open times", 0, 0, 'L', 0);

        // $pdf->Ln(7);
        // $pdf->SetTextColor(14, 93,117);
        // $pdf->SetFont('times', 'N', '11');
        // $pdf->Cell(33, 3, 'Meaning of Grades:', 0, 0, 'L');
        // //fetch all available grades from the system
        // $sql = "SELECT * FROM grade ORDER BY mark_from DESC LIMIT  0, 8";
        // $conn->query($sql);
        // $grade_result = $conn->fetchMultiple();


        // foreach ($grade_result as $student_grading){
        //     $mark_upto = $student_grading->mark_upto;
        //     $mark_from = $student_grading->mark_from;
        //     $student_grade = $student_grading->grade_name;
        //     $pdf->SetTextColor(0, 0,0);
        //     $pdf->SetFont('times', 'N', '10');
        //     $pdf->Cell(20, 3, "$mark_from - $mark_upto($student_grade) ", 0, 0, "L");
        // }

        // $sql = "SELECT * FROM grade ORDER BY mark_from DESC LIMIT  8, 6";
        // $conn->query($sql);
        // $grade_result = $conn->fetchMultiple();
        // $pdf->Ln(4);
        // foreach ($grade_result as $student_grading){
        //     $mark_upto = $student_grading->mark_upto;
        //     $mark_from = $student_grading->mark_from;
        //     $student_grade = $student_grading->grade_name;
        //     $pdf->SetTextColor(0, 0,0);
        //     $pdf->SetFont('times', 'N', '10');
        //     $pdf->Cell(15, 7, "", 0, 0, "L");
        //     $pdf->Cell(4, 5, "$mark_from - $mark_upto($student_grade) ", 0, 0, "L");
        // }

        //student weight  and more ....
        $sql = "SELECT * FROM student WHERE name =:name";
        $conn->query($sql);
        $conn->bind(":name", $name);
        $row_count = $conn->rowCount();

        if($row_count > 0){
            $student_info = $conn->fetchSingle();
            $dob = $student_info->dob;
            $dob1 = date_create($dob);
            $new_date = date_format($dob1, 'F, d Y');
            $weight = $student_info->weight;
            $height = $student_info->height;
            $pdf->Ln(8);
            if(!empty($weight)){
                $pdf->SetFont('times', 'N', '11');
                $pdf->Cell(15, 5, "Weight: ", 0, 0, "L");
                $pdf->SetTextColor(14, 93,117);
                $pdf->SetFont('times', 'N', '10');
                $pdf->Cell(13, 5, "$weight kg", 0, 0, "L");
            }
            if(!empty($height)){
                $pdf->SetTextColor(0, 0,0);
                $pdf->SetFont('times', 'N', '11');
                $pdf->Cell(13, 6, "Height: ", 0, 0, "L");
                $pdf->SetTextColor(14, 93,117);
                $pdf->SetFont('times', 'N', '10');
                $pdf->Cell(13, 6, "$height m", 0, 0, "L");
            }

            if(!empty($new_date)){
                $pdf->SetTextColor(0, 0,0);
                $pdf->SetFont('times', 'N', '11');
                //$pdf->Cell(23, 6, "Date of Birth: ", 0, 0, "L");
                $pdf->SetTextColor(14, 93,117);
                $pdf->SetFont('times', 'N', '10');
                //$pdf->Cell(30, 6, "$new_date", 0, 0, "L");
            }
        }

        //result analysis

        $pdf->SetTextColor(0, 0,0);
        $pdf->SetFont('times', 'N', '11');
        $pdf->Cell(28, 5, "Result Analysis: ", 0, 0, "L");
        $pass_percent = 50;
        if($mark_average >= $pass_percent){
            $pdf->SetTextColor(0, 128, 0);
            $pdf->SetFont('times', 'B', '10');
            $pdf->Cell(16, 5, "Passed", 0, 0, "L");
        }else{
            $pdf->SetTextColor(255, 0, 0);
            $pdf->SetFont('times', 'B', '10');
            $pdf->Cell(16, 5, "Failed", 0, 0, "L");
        }

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('times', 'N', '10');
        $pdf->Cell(50, 5, "(based on 50% and above)", 0, 0, "L");

        if(!empty($school_stamp)){
            //add school stamp image
            $url_bg = $redirect."upload/$school_stamp";
            $pdf->Image("$url_bg", 85, 244, 30);
        }

        $pdf->Ln(50);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('times', 'N', '10');
        $pdf->Cell(37, 5, "", 0, 0, "L");

        $today_date = date('F d, Y') .' at exactly '. date('h:sa');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('times', 'N', '10');
        $pdf->Cell(80, 5, "This result was generated on $today_date", 0, 0, "L");

    }else{

        ?>
        <script>
            alert('Student results details have not been added yet for the selected term. Pls add marks before viewing terminal report.');
        </script>
        <meta http-equiv="refresh" content="4; <?php echo $back_to_terminal_report; ?>">
        <?php

    }

}else{
    //return back to index page

    header("location: $redirect");
}
// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('terminal_report.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+