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
    <title> View Students Terminal Report | <?php echo $school_name; ?></title>
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
                        <h1 class="m-0"> View Terminal Report  </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active"> View Terminal Report </li>
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
                     <div class="callout callout-success" style="margin-top: 30px;">

                         <p>
                             Please select Class, Exam and Section to view terminal reports.
                             <span class="text-warning">
                                 <i class="fa fa-info-circle" data-toggle='tooltip'
                                    title="Only students with scores added will be displayed." style="cursor: pointer;">
                                 </i>
                             </span>
                         </p>
                     </div>
                     <div class="card card-info">
                         <div class="card-header">
                             <h3 class="card-title"> <i class="fa fa-flask"></i> Terminal Report </h3>
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
                                <input type="submit" value="View Students Details" class="btn btn-success" id="mark">
                             </div>

                            </div>

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
    $('#mark-add').parsley();
    $('#mark-add').on('submit', function(event){
        event.preventDefault();
        if($('#mark-add').parsley().isValid()){
            $.ajax({
                url: "<?php echo $base_url; ?>fetch-students-results.php",
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
                    $('#mark').val('View Students Details');
                    $('#display-details').html(data);
                }
            })
        }

    })
</script>

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