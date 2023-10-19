<?php
session_start();
if(isset($_SESSION['username'])){

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include('includes/styles.php');?>
    <title> Add a comment  | <?php echo $school_name; ?></title>
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

    <?php include('includes/sidebar.php');?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add a comment  </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Add a comment</li>
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
                     <div class="card card-info">
                         <div class="card-header">
                             <h3 class="card-title"> <i class="fa fa-flask"></i> Add a comment</h3>
                         </div>

                         <form action="" class="form-horizontal" method="post" id="comment-add">
                              <div class="card-body">
                             <div class="form-row">
                              <div class="col-md-3">
                                <label for="class"> Class <span class="text-danger">*</span></label>
                                <select name="class" id="classID" class="form-control select2 myclass" data-parsley-trigger="keyup" style="width: 100%;"  required>
                                    <option value="">Select Class</option>
                                    <?php
                                    //fetch all teachers information
                                    $sql = "SELECT * FROM classes";
                                    $conn->query($sql);
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
                                     <label for="year"> Exam Year <span class="text-danger">*</span></label>
                                     <select name="year" id="year" class="form-control select2" required data-parsley-trigger="keyup" style="width: 100%;">
                                         <option value="">Select Year</option>
                                         <?php
                                         $sql = "SELECT DISTINCT school_year  FROM results";
                                         $conn->query($sql);
                                         $result = $conn->fetchMultiple();
                                         foreach ($result as $year){
                                             $school_year = $year->school_year;
                                             ?>
                                             <option value="<?php echo $school_year; ?>"><?php echo $school_year; ?></option>
                                             <?php
                                         }
                                         ?>
                                     </select>
                                 </div>


                        
                          <div class="col-md-3" style="margin-top: 20px;">
                                <input type="submit" value="Add Comment" class="btn btn-success" id="comment">
                             </div>

                            </div>

                            </div>
                            

                             <div id="success-msg">
                             </div>

                         </form>

                     </div>

                     <div class="callout callout-info" style="margin-top: 30px;">
                         <p> Note: You need to add exam scores for the students before adding comment. </p>
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

<?php include 'includes/footer.php'; ?>
<!-- Add logo  Modal start -->

<script>
$(function(){
 
    $('#classID').on('change', function(){
        var classID = $(this).val();
        if(classID){
            $.ajax({
                type: 'POST',
                url: 'fetch_section.php',
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
    $('[data-toggle ="tooltip"]').tooltip();
</script>

    <script>
       $(function () {
           $('.select2').select2();
       })
    </script>
<script>
    $('#comment-add').parsley();
    $('#comment-add').on('submit', function(event){
        event.preventDefault();
        if($('#comment-add').parsley().isValid()){
            $.ajax({
                url: "<?php echo $base_url; ?>fetch-comment-details.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#comment').attr('disabled', 'disabled');
                    $('#comment').val('Fetching comment details, pls wait ......');

                },
                success:function (data) {
                    $('#comment-add').parsley().reset();
                    $('#comment').attr('disabled', false);
                    $('#comment').val('Add Comment');
                    $('#display-details').html(data);
                }
            })
        }

    })
</script>
    <?php


    if(isset($_POST['submit_comment'])){
        $student_class = $_POST['class'];
        $section = $_POST['section'];
        $student_name = $_POST['student_name'];
        $reg_no = $_POST['reg_no'];
        $current_exam = $_POST['exam'];
        $exam_year = $_POST['exam_year'];
        $comment_id = $_POST['comment_id'];
        $teacher_comment = $_POST['teacher_comment'];
        $principal_comment = $_POST['principal_comment'];
        $add_comment = '';
        $update_comment = '';

        foreach ($student_class as $index=>$result_details){
            $sql = "SELECT * FROM comments WHERE student_name =:name AND exam =:exam 
                    AND class =:class AND section =:section AND exam_year =:year";
            $conn->query($sql);
            $conn->bind(":name", $student_name[$index]);
            $conn->bind(":exam", $current_exam[$index]);
            $conn->bind(":class", $student_class[$index]);
            $conn->bind(":section", $section[$index]);
            $conn->bind(":year", $exam_year[$index]);

            $rowcount = $conn->rowCount();

            if($rowcount > 0){
                $db_result = $conn->fetchSingle();
                //update records

                $sql = "UPDATE comments SET student_name =:name, class =:class, exam =:exam, 
                        section =:section, exam_year =:exam_year, class_teacher_comment =:teacher_comment,
                     principal_comment =:principal_comment  WHERE id =:id";
                $conn->query($sql);
                $conn->bind(":name", $student_name[$index]);
                $conn->bind(":exam", $current_exam[$index]);
                $conn->bind(":class", $student_class[$index]);
                $conn->bind(":section", $section[$index]);
                $conn->bind(":teacher_comment", $teacher_comment[$index]);
                $conn->bind(":principal_comment", $principal_comment[$index]);
                $conn->bind(":exam_year", $exam_year[$index]);
                $conn->bind(":id", $comment_id[$index]);

                try{
                    $conn->execute();
                    $update_comment = "<script>
                         toastr['success']('Comment details updated successfully.');
                         </script>";
                }catch (PDOException $err){
                    $error = $err->getMessage();
                    $update_comment = "<script>
                         toastr['error']('$error');
                         </script>";
                }


            }else{
                //no records found, insert records afresh to db
                $sql = "INSERT INTO comments(student_name, class, section, exam, exam_year, class_teacher_comment, principal_comment) 
                         VALUES (:name, :class, :section, :exam, :exam_year, :teacher_comment, :principal_comment)";
                $conn->query($sql);
                $conn->bind(":name", $student_name[$index]);
                $conn->bind(":exam", $current_exam[$index]);
                $conn->bind(":class", $student_class[$index]);
                $conn->bind(":section", $section[$index]);
                $conn->bind(":teacher_comment", $teacher_comment[$index]);
                $conn->bind(":principal_comment", $principal_comment[$index]);
                $conn->bind(":exam_year", $exam_year[$index]);

                try{
                    $conn->execute();
                    $add_comment = "<script>
                         toastr['success']('Comment details inserted successfully.');
                         </script>";
                }catch (PDOException $err){
                    $error = $err->getMessage();
                    $add_comment = "<script>
                         toastr['error']('$error');
                         </script>";
                }


            }


        }

        echo $add_comment;
        echo $update_comment;

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
        <title> Login to continue | <?php echo $school_name; ?> </title>

        <?php include 'includes/styles.php'; ?>
        <?php
        $conn = new Functions();
        $base_url = $conn->base_url();
        $redirect = $base_url."login";
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