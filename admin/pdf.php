<?php
session_start();
//error_reporting(0);
require_once('TCPDF-main/tcpdf.php');
include 'includes/database.php';
include 'includes/functions.php';

$conn = new Functions();
// create new PDF document
$pdf = new TCPDF('l', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// // set document information
// $pdf->setCreator(PDF_CREATOR);
// $pdf->setAuthor('Nicola Asuni');
// $pdf->setTitle('TCPDF Example 006');
// $pdf->setSubject('TCPDF Tutorial');
// $pdf->setKeywords('TCPDF, PDF, example, test, guide');

//set default header data
$pdf->setHeaderData('', 70, '   C.P.M INTERNATIONAL SCHOOL', 'A.K.A GLORYLAND ACADEMY SULEJA');

//set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', 18));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// // set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// // set margins
$pdf->setMargins(PDF_MARGIN_LEFT, 27, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, 15);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('dejavusans', '', 10);
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

// add a page
$pdf->AddPage();
$sqls = "SELECT * FROM student WHERE classesID=:id ORDER BY name ASC";
$conn->query($sqls);
$conn->bind(":id", '9');
$results = $conn->fetchMultiple();
// create some HTML content

$html = '<h4 align="center">ENTRANCE EXAMINATION SHEET 2023/2024 SESSION</h4>
<table border="1" cellpadding="7" style="text-align:left;" >
	<tr  style="font-weight:bold;">
		<th width="41">S/N</th>
		<th width="270">NAMES</th>
		<th width="58">SEX</th>
		<th width="91">STATE</th>
        <th width="66">MATH</th>
		<th width="66">ENG</th>
		<th width="66">SOS</th>
        <th width="66">B/S</th>
		<th width="66">V/A</th>
		<th width="70">TOTAL</th>
        <th width="90">REMARK</th>
	</tr>';
$count = 0;
foreach ($results as $names) {
    $sql = "SELECT exam_score FROM results WHERE exam=:exam AND name_of_student=:name AND subject=:sub";
    $conn->query($sql);
    $conn->bind(":exam", 'Entrance Exam');
    $conn->bind(":name", $names->name);
    $conn->bind(":sub", 'Mathematics');
    $maths = $conn->fetchColumn();
    // English
    $sql = "SELECT exam_score FROM results WHERE exam=:exam AND name_of_student=:name AND subject=:sub";
    $conn->query($sql);
    $conn->bind(":exam", 'Entrance Exam');
    $conn->bind(":name", $names->name);
    $conn->bind(":sub", 'English Language');
    $eng = $conn->fetchColumn();

    // Vocational
    $sql = "SELECT exam_score FROM results WHERE exam=:exam AND name_of_student=:name AND subject=:sub";
    $conn->query($sql);
    $conn->bind(":exam", 'Entrance Exam');
    $conn->bind(":name", $names->name);
    $conn->bind(":sub", 'Vocational Attitude');
    $voc = $conn->fetchColumn();
    // Basic Science
    $sql = "SELECT exam_score FROM results WHERE exam=:exam AND name_of_student=:name AND subject=:sub";
    $conn->query($sql);
    $conn->bind(":exam", 'Entrance Exam');
    $conn->bind(":name", $names->name);
    $conn->bind(":sub", 'Basic Science');
    $Bs = $conn->fetchColumn();

    // Social Studies
    $sql = "SELECT exam_score FROM results WHERE exam=:exam AND name_of_student=:name AND subject=:sub";
    $conn->query($sql);
    $conn->bind(":exam", 'Entrance Exam');
    $conn->bind(":name", $names->name);
    $conn->bind(":sub", 'Social Studies');
    $sos = $conn->fetchColumn();
    $total = $eng + $maths + $sos + $Bs + $voc;

    // Fetch Remark
    $sql = "SELECT * FROM grade WHERE :student_score BETWEEN mark_from AND mark_upto";
    $conn->query($sql);
    $conn->bind(":student_score", $total);
    $result = $conn->fetchSingle();
    $grade = $result->grade_name;
    $remark = $result->note;
    $html .= "<tr>
        <td>$count</td>
        <td>$names->name</td>
        <td>$names->sex</td>
        <td>$names->state</td>
        <td>$maths</td>
        <td>$eng</td>
        <td>$sos</td>
        <td>$Bs</td>
        <td>$voc</td>
        <td><b>$total</b></td>
        <td>$remark</td>
    </tr>";
    $count++;
}

$html .= '
</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Print some HTML Cells

// $html = '<span color="red">red</span> <span color="green">green</span>
//  <span color="blue">blue</span><br /><span color="red">red</span> 
//  <span color="green">green</span> <span color="blue">blue</span>';

// $pdf->setFillColor(255, 255, 0);

// $pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'L', true);
// $pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 1, true, 'C', true);
// $pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'R', true);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('table06.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
