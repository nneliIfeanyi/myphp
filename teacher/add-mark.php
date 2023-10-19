<?php
session_start();
if(isset($_SESSION['teacher'])){
    $username = $_SESSION['teacher'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include('../admin/includes/styles.php');?>
    <title> Add a mark | <?php echo $school_name; ?></title>
    <style>
        /*.parsley-required, .parsley-pattern {*/
        /*    position: relative !important;*/
        /*    top: 10px !important;*/
        /*    left: 245px !important;*/
        /*    width: 200px !important;*/
        /*    list-style-type: none !important;*/
        /*}*/

        .fa-upload{
            background: #709561;
            padding: 5px;
            border-radius: 2px;
            color: white;
            font-size: 11px;
            cursor: pointer;
        }

        .fa-eye{
            cursor: pointer;
            background: #f59c1a;
            padding: 5px;
            border-radius: 2px;
            color: white;
            font-size: 11px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <?php include('includes/notifications.php');?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->

    <?php 
    
    include('includes/sidebar.php');
    
    $sql = "SELECT * FROM teachers WHERE username =:username";
    $conn->query($sql);
    $conn->bind(":username", $username);

    $result = $conn->fetchSingle();
    $teacher_name = $result->name;


    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add a mark </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $teacher_url; ?>">Home</a></li>
                            <li class="breadcrumb-item active">Add a mark</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->



        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                 <div class="col-lg-12">
                     <div class="callout callout-danger" style='margin-top: 30px;'>
                        <p>Note: You can only add marks for the subject and classes you are teaching</p>
                     </div>
                     <div class="card card-info">
                         <div class="card-header">
                             <h3 class="card-title"> <i class="fa fa-flask"></i> Mark</h3>
                         </div>

                         <form action="" class="form-horizontal" method="post" id="mark-add">
                              <div class="card-body">
                             <div class="form-row">
                              <div class="col-md-3">
                                <label for="class"> Class <span class="text-danger">*</span></label>
                                <select name="class" id="classID" class="form-control select2 myclass" data-parsley-trigger="keyup" style="width: 100%;"  required>
                                    <option value="">Select Class</option>
                                    <?php
                                    //fetch all teachers information
                                    $sql = "SELECT * FROM classes WHERE teacher_name =:name";
                                    $conn->query($sql);
                                    $conn->bind(":name", $teacher_name);
                                    $rowcount = $conn->rowCount();

                                    if($rowcount > 0){
                                        $result = $conn->fetchMultiple();
                                        foreach ($result as $class) {
                                            ?>  <option value="<?php echo $class->id; ?>"><?php echo $class->name; ?></option><?php
                                        }

                                    }

                                    ?>

                                </select>
                             </div>

                        <div class="col-md-3">
                            <label for="exam"> Exam <span class="text-danger">*</span></label>
                            <select name="exam" id="exam" class="form-control select2" required data-parsley-trigger="keyup" style="width: 100%;">
                                <option value="">Select Exam</option>
                                <?php
                                //fetch all teachers information
                                $sql = "SELECT * FROM exams";
                                $conn->query($sql);
                                $rowcount = $conn->rowCount();

                                if($rowcount > 0){
                                    $result = $conn->fetchMultiple();
                                    foreach ($result as $exam) {
                                        ?>  <option value="<?php echo $exam->name; ?>"><?php echo $exam->name; ?></option><?php
                                    }

                                }

                                ?>

                            </select>
                          </div>

                          <div class="col-md-3">
                            <label for="section"> Section <span class="text-danger">*</span></label>
                            <select name="section" id="section" class="form-control select2" required data-parsley-trigger="keyup" style="width: 100%;">
                                <option value="">Select Section</option>
                            </select>

                        </div>

                         <div class="col-md-3">
                            <label for="subject"> Subject <span class="text-danger">*</span></label>
                            <select name="subject" id="subject" class="form-control select2" required data-parsley-trigger="keyup" style="width: 100%;">
                                <option value="">Select Subject</option>


                            </select>
                          </div>

                          <input type="hidden" name="exam_year" value="<?php echo date('Y'); ?>">
                        
                          <div class="col-md-3" style="margin-top: 20px;">
                                <input type="submit" value="Mark" class="btn btn-success" id="mark">
                             </div>

                            </div>

                            </div>
                            

                             <div id="success-msg">
                             </div>

                         </form>

                     </div>


                
                 </div>

                 <!-- display mark details here... -->
                 <div class="col-lg-12">
                     <div class="card card-info" id="display-details">

                     </div>
                 </div>



                 


                </div>



            </div><!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include '../admin/includes/footer.php'; ?>
<!-- Add logo  Modal start -->

<script>
$(function(){
 
    $('#classID').on('change', function(){
        var classID = $(this).val();
        if(classID){
            $.ajax({
                type: 'POST',
                url: '<?php echo $teacher_url; ?>/fetch_section.php',
                data: 'classID='+ classID, //concatenate with classID variable
                success: function(data){
                  $('#section').html(data)
                }


            })
        }else{
            $('#section').html('<option value="">select class</option>');
        }
    })


})

</script>

<script>
$(function(){
 
    $('#classID').on('change', function(){
        var classID = $(this).val();
        if(classID){
            $.ajax({
                type: 'POST',
                url: '<?php echo $teacher_url; ?>/fetch_subject.php',
                data: 'classID='+ classID, //concatenate with classID variable
                success: function(data){
                  $('#subject').html(data)
                }


            })
        }else{
            $('#subject').html('<option value="">select class</option>');
        }
    })


})

</script>

<script>
    $('[data-toggle ="tooltip"]').tooltip();
</script>

    <script>
       $(function () {
           $('.select2').select2();
       })
    </script>
<script>
    $('#mark-add').parsley();
    $('#mark-add').on('submit', function(event){
        event.preventDefault();
        if($('#mark-add').parsley().isValid()){
            $.ajax({
                url: "<?php echo $teacher_url; ?>/fetch-mark-details.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#mark').attr('disabled', 'disabled');
                    $('#mark').val('Fetching details, pls wait ......');

                },
                success:function (data) {
                    $('#mark-add').parsley().reset();
                    $('#mark').attr('disabled', false);
                    $('#mark').val('Mark');
                    $('#display-details').html(data);
                }
            })
        }

    })
</script>
    <?php

    if(isset($_POST['submit_result'])){
        $student_class = $_POST['class'];
        $student_exam_score = $_POST['exam_score'];
        $student_first_ca_score = $_POST['first_ca_score'];
        $student_second_ca_score = $_POST['second_ca_score'];
        $section = $_POST['section'];
        $subject = $_POST['subject'];
        $student_name = $_POST['student_name'];
        $reg_no = $_POST['reg_no'];
        $current_exam = $_POST['exam'];
        $exam_year = $_POST['exam_year'];
        $score_id = $_POST['score_id'];
        $total_scores_obtained = $_POST['total_score'];
        $zero = 0;
        $current_school_section = $_POST['current_school_section'];

        $success_msg1 = '';
        $success_msg2 = '';

        foreach($student_class as $index=>$result_details ){
       //check if details already exists in the results table
        $sql = "SELECT * FROM results WHERE name_of_student =:name AND exam =:exam AND class =:class AND subject =:subject";
        $conn->query($sql);
        $conn->bind(":name", $student_name[$index]);
        $conn->bind(":exam", $current_exam[$index]);
        $conn->bind(":class", $student_class[$index]);
        $conn->bind(":subject", $subject[$index]);
        $rowcount = $conn->rowCount();

        if($rowcount > 0){
         $db_result = $conn->fetchSingle();

            //update records

            $sql = "UPDATE results SET name_of_student =:name, class =:class, exam =:exam, 
                        section =:section, subject =:subject, first_ca =:first_ca,
                         second_ca=:second_ca, school_year =:exam_year, 
                         exam_score =:exam_score, current_school_session =:current_school_session WHERE id =:id";
            $conn->query($sql);
            $conn->bind(":name", $student_name[$index]);
            $conn->bind(":exam", $current_exam[$index]);
            $conn->bind(":class", $student_class[$index]);
            $conn->bind(":subject", $subject[$index]);
            $conn->bind(":section", $section[$index]);
            $conn->bind(":first_ca", $student_first_ca_score[$index]);
            $conn->bind(":second_ca", $student_second_ca_score[$index]);
            $conn->bind(":exam_year", $exam_year[$index]);
            $conn->bind(":exam_score", $student_exam_score[$index]);
            $conn->bind(":id", $score_id[$index]);
            $conn->bind(":current_school_session", $current_school_section[$index]);

            try{
                $conn->execute();
                $success_msg1 = "<script>
                            toastr['success']('Exam details updated successfully.');
                       </script>";

            }catch (PDOException $err){
                $error = $err->getMessage();
                $success_msg1 = "<script>
                            toastr['error']('$error');
                       </script>";
            }
        }else{
            //no records found, insert records afresh to db
            $sql = "INSERT INTO results(name_of_student, class, exam, section, subject, first_ca, second_ca, school_year, exam_score, current_school_session)
                        VALUES(:name, :class, :exam, :section, :subject, :first_ca, 
                        :second_ca, :school_year, :exam_score, :current_school_session)";
            $conn->query($sql);
            $conn->bind(":name", $student_name[$index]);
            $conn->bind(":exam", $current_exam[$index]);
            $conn->bind(":class", $student_class[$index]);
            $conn->bind(":subject", $subject[$index]);
            $conn->bind(":section", $section[$index]);
            $conn->bind(":first_ca", $student_first_ca_score[$index]);
            $conn->bind(":second_ca", $student_second_ca_score[$index]);
            $conn->bind(":school_year", $exam_year[$index]);
            $conn->bind(":exam_score", $student_exam_score[$index]);
            $conn->bind(":current_school_session", $current_school_section[$index]);

            try{
                $conn->execute();
                $success_msg1 = "<script>
                         toastr['success']('Exam details added successfully.');
                         </script>";
            }catch (PDOException $err){
                $error = $err->getMessage();
                $success_msg1 =  "<script>
                         toastr['error']('$error');
                         </script>";
            }

        }

       //try the second query for student positions

            //check if student position already exists in positions table in db

            $sql = "SELECT * FROM student_class_positions WHERE name =:name AND class=:class 
                           AND section =:section AND exam =:exam AND exam_year =:year AND reg_no =:reg_no";
            $conn->query($sql);
            $conn->bind(":name", $student_name[$index]);
            $conn->bind(":exam", $current_exam[$index]);
            $conn->bind(":class", $student_class[$index]);
            $conn->bind(":section", $section[$index]);
            $conn->bind(":year", $exam_year[$index]);
            $conn->bind(":reg_no", $reg_no[$index]);
            $rowcount2 = $conn->rowCount();

            if($rowcount2 > 0){
                //do stuffs
                //fetch first_ca, second_ca and exam total

                $sql = "SELECT SUM(first_ca) FROM results WHERE name_of_student = :name  
                        AND second_ca != :zero 
                        AND first_ca != :zero 
                       AND exam_score != :zero 
                      AND class=:class AND section =:section 
                     AND school_year =:school_year AND exam =:exam";
                $conn->query($sql);
                $conn->bind(":name", $student_name[$index]);
                $conn->bind(":section", $section[$index]);
                $conn->bind(":class", $student_class[$index]);
                $conn->bind(":exam", $current_exam[$index]);
                $conn->bind(":school_year", $exam_year[$index]);
                $conn->bind(":zero", $zero);
                $total_first_ca = $conn->fetchColumn();

                //fetch second CA total

                $sql = "SELECT SUM(second_ca) FROM results WHERE name_of_student = :name  
                        AND second_ca != :zero 
                        AND first_ca != :zero 
                       AND exam_score != :zero 
                      AND class=:class AND section =:section 
                     AND school_year =:school_year AND exam =:exam";
                $conn->query($sql);
                $conn->bind(":name", $student_name[$index]);
                $conn->bind(":section", $section[$index]);
                $conn->bind(":class", $student_class[$index]);
                $conn->bind(":exam", $current_exam[$index]);
                $conn->bind(":school_year", $exam_year[$index]);
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
                $conn->bind(":name", $student_name[$index]);
                $conn->bind(":section", $section[$index]);
                $conn->bind(":class", $student_class[$index]);
                $conn->bind(":exam", $current_exam[$index]);
                $conn->bind(":school_year", $exam_year[$index]);
                $conn->bind(":zero", $zero);
                $total_exam_score = $conn->fetchColumn();
                $total_marks_obtained = $total_first_ca + $total_second_ca + $total_exam_score;


                $sql = "UPDATE student_class_positions SET  marks_obtained =:marks_obtained 
                       WHERE name =:name AND class =:class AND exam =:exam
                        AND section =:section AND reg_no =:reg_no AND 
                          exam_year =:exam_year";
                $conn->query($sql);
                $conn->bind(":name", $student_name[$index]);
                $conn->bind(":exam", $current_exam[$index]);
                $conn->bind(":class", $student_class[$index]);
                $conn->bind(":section", $section[$index]);
                $conn->bind(":reg_no", $reg_no[$index]);
                $conn->bind(":exam_year", $exam_year[$index]);
                $conn->bind(":marks_obtained", $total_marks_obtained);

                try{

                    $conn->execute();

                    //try updating the students positions details
                    $sql = "SELECT * FROM student_class_positions WHERE  class=:class 
                           AND section =:section AND exam =:exam AND exam_year =:year ORDER BY name";
                    $conn->query($sql);
                    $conn->bind(":exam", $current_exam[$index]);
                    $conn->bind(":class", $student_class[$index]);
                    $conn->bind(":section", $section[$index]);
                    $conn->bind(":year", $exam_year[$index]);

                    $scores = $conn->fetchMultiple();
                    $all_scores = [];
                    $row_count = $conn->rowCount();
                    $i = 1;
                    $position = '';
                    foreach ($scores as $details){
                        $all_scores[] = $details->marks_obtained;
                    }
                    rsort($all_scores);
                    $rank=1;
                    $prev=$all_scores[0];
                    foreach($all_scores as $number){
                        if($prev!=$number){
                            $prev=$number;
                            $rank++;
                        }
                        $ones = $rank % 10;
                        $tens = floor($rank / 10) % 10;
                        if ($tens == 1) {
                            $suff = "th";
                        } else {
                            switch ($ones) {
                                case 1 : $suff = "st"; break;
                                case 2 : $suff = "nd"; break;
                                case 3 : $suff = "rd"; break;
                                default : $suff = "th";
                            }
                        }

                        $sql = "UPDATE student_class_positions SET  position =:position 
                       WHERE class =:class AND exam =:exam
                        AND section =:section AND 
                          exam_year =:exam_year AND marks_obtained =:marks_obtained";
                        $conn->query($sql);
                        $conn->bind(":exam", $current_exam[$index]);
                        $conn->bind(":class", $student_class[$index]);
                        $conn->bind(":section", $section[$index]);
                        $conn->bind(":exam_year", $exam_year[$index]);
                        $conn->bind(":marks_obtained", $number);
                        $conn->bind(":position", $rank.$suff);
                        $execute = $conn->execute();

                    }

                    $success_msg2 ="<script>
                         toastr['success']('Student\'s scores were updated successfully.');
                         </script>";
                }catch (PDOException $err){
                    $error = $err->getMessage();
                    $success_msg2 = "<script>
                         toastr['error']('Opps: $error');
                         </script>";
                }


            }else{
                //nothing inserted, add afresh
                //fetch first_ca, second_ca and exam total
                $sql = "SELECT SUM(first_ca) FROM results WHERE name_of_student = :name  
                        AND second_ca != :zero 
                        AND first_ca != :zero 
                       AND exam_score != :zero 
                      AND class=:class AND section =:section 
                     AND school_year =:school_year AND exam =:exam";
                $conn->query($sql);
                $conn->bind(":name", $student_name[$index]);
                $conn->bind(":section", $section[$index]);
                $conn->bind(":class", $student_class[$index]);
                $conn->bind(":exam", $current_exam[$index]);
                $conn->bind(":school_year", $exam_year[$index]);
                $conn->bind(":zero", $zero);
                $total_first_ca = $conn->fetchColumn();

                //fetch second CA total

                $sql = "SELECT SUM(second_ca) FROM results WHERE name_of_student = :name  
                        AND second_ca != :zero 
                        AND first_ca != :zero 
                       AND exam_score != :zero 
                      AND class=:class AND section =:section 
                     AND school_year =:school_year AND exam =:exam";
                $conn->query($sql);
                $conn->bind(":name", $student_name[$index]);
                $conn->bind(":section", $section[$index]);
                $conn->bind(":class", $student_class[$index]);
                $conn->bind(":exam", $current_exam[$index]);
                $conn->bind(":school_year", $exam_year[$index]);
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
                $conn->bind(":name", $student_name[$index]);
                $conn->bind(":section", $section[$index]);
                $conn->bind(":class", $student_class[$index]);
                $conn->bind(":exam", $current_exam[$index]);
                $conn->bind(":school_year", $exam_year[$index]);
                $conn->bind(":zero", $zero);
                $total_exam_score = $conn->fetchColumn();

                $total_marks_obtained = $total_first_ca + $total_second_ca + $total_exam_score;

                $sql = "INSERT INTO student_class_positions(name, class, exam, section, exam_year, marks_obtained, reg_no)
                        VALUES(:name, :class, :exam, :section, :exam_year, :marks_obtained, :reg_no)";
                $conn->query($sql);
                $conn->bind(":name", $student_name[$index]);
                $conn->bind(":exam", $current_exam[$index]);
                $conn->bind(":class", $student_class[$index]);
                $conn->bind(":section", $section[$index]);
                $conn->bind(":reg_no", $reg_no[$index]);
                $conn->bind(":exam_year", $exam_year[$index]);
                $conn->bind(":marks_obtained", $total_marks_obtained);

                try{
                    $conn->execute();
                    $success_msg2 = "<script>
                         toastr['success']('Student\'s scores were added successfully.');
                         </script>";
                }catch (PDOException $err){
                    $error = $err->getMessage();
                    $success_msg2 = "<script>
                         toastr['error']('Opps: $error');
                         </script>";
                }



            }

        }

        //echo success msg variable

        echo $success_msg1;
        echo $success_msg2;
    }
    ?>

    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>

    <?php
}else{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
     

        <?php include '../admin/includes/styles.php'; ?>
        <title> Login to continue | <?php echo $school_name; ?> </title>
        <?php
        $redirect = $teacher_url."/login";
        ?>

        <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    </head>
<body>
<div class="container" style="margin-top: 20%;">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="section-title text-center">
                <h6> You need to login to continue </h6>
                <div class="spinner-border text-info" role="status">
                    <span class="sr-only">Loading...</span>
                    <meta http-equiv='refresh' content='3; <?php echo $redirect; ?>'>
                </div>
                <p>Redirecting to the login  page...</p>
            </div>
        </div>
    </div>
</div>

    <?php

}

?>