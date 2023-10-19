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
    <title> Promote Students | <?php echo $school_name; ?></title>
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
                        <h1 class="m-0">Students' Promotion </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Students' Promotion</li>
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
                        <p style='font-size: 18px;'> <i class='fa fa-info-circle' data-toggle='tootip' 
                          title='Pls read and understand this before promoting.'></i>
                             Few information to keep in mind before promoting:
                            <span class='text-info'>
                               <br>
                               1. When Promoting, what changes is the student's class and the section(arms) names. You can edit individual
                                      student later to correct section name. <br>

                               2.  We advise that you start promoting from the highest class. For example, Promote
                                    SS3 to a different class(you need to rename the new class if it's the highest class, e.g SS3 to SS3_2021_2022) before 
                                    promoting SS2 to SS3, SS1 to SS2...etc. Any class lower than the highest can stay the same(no renaming). <br>
                            
                               3.   Promotion does not affect students scores already uploaded. Scores remain intact, this is   
                                      so that students who are no longer active in a class can still have access to their terminal 
                                      report for the previous class. <br>
                               4.   Promotions are based on the current Academic Year.   
                                </span>
                        
                        </p>
                     </div>

                     <div class="card card-info">
                         <div class="card-header">
                             <h3 class="card-title"> <i class="fa fa-flask"></i>  Promote Students </h3>
                         </div>

                         <form action="" class="form-horizontal" method="post" id="promote_class">
                              <div class="card-body">
                             <div class="form-row">
                              <div class="col-md-3">
                                <label for="class"> Class <span class="text-danger">*</span></label>
                                <select name="previous_class" id="classID" class="form-control select2 myclass" data-parsley-trigger="keyup" style="width: 100%;"  required>
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
                                <label for="new_classID">New  Class <span class="text-danger">*</span></label>
                                <select name="new_class" id="new_classID" class="form-control select2 myclass" data-parsley-trigger="keyup" style="width: 100%;"  required>
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

                             <div class ='col-md-3'>
                                <div class="custom-control custom-checkbox" style='top:35px;'>
                                <input class="custom-control-input" name='change_class_name' type="checkbox" id="customCheckbox2" value='change_class_name'>
                                <label for="customCheckbox2" class="custom-control-label"> Change new class name </label>
                                </div>
                             </div>

                             <div class ='col-md-3 change_class_name' style='display:none;'> 
                                <label for="new_class_name"> New class name <span class="text-danger"></span></label>
                                <input type="text" name="new_class_name" id="new_class_name" placeholder='Enter new class name' class='form-control myclass'>
                             </div>

                          </div>

                        
                          <div class="col-md-3" style="margin-top: 20px;">
                                <input type="submit" value="Promote Students" class="btn btn-success" id="promote">
                             </div>

                            </div>

                            </div>
                            

                             <div id="success-msg">
                             </div>

                         </form>

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
    $('[data-toggle = "tooltip"]').tooltip();
</script>

    <script>
       $(function () {
           $('.select2').select2();
           //activate rename class div
           $('input[type="checkbox"]').click(function(){
                let inputValue = $(this).attr('value');
               $('.' + inputValue).toggle(); 

           });
       });

    </script>
<script>
    $('#promote_class').parsley();
    $('#promote_class').on('submit', function(event){
        event.preventDefault();
        if($('#promote_class').parsley().isValid()){
            $.ajax({
                url: "<?php echo $base_url; ?>process-class-promote.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#promote').attr('disabled', 'disabled');
                    $('#promote').val('Fetching details, pls wait ......');

                },
                success:function (data) {
                    $('#promote_class').parsley().reset();
                    $('#promote').attr('disabled', false);
                    $('#promote').val('Promote Students');
                    $('#success-msg').html(data);
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
       

        <?php include 'includes/styles.php'; ?>
        <title> Login to continue | <?php echo $school_name; ?> </title>
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