<?php
session_start();
ob_start();
if(isset($_SESSION['username'])){

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include('includes/styles.php');?>
    <title> Edit subject | <?php echo $school_name; ?></title>
    <style>
        .parsley-required, .parsley-pattern {
            position: relative !important;
            top: 10px !important;
            left: 245px !important;
            width: 200px !important;
            list-style-type: none !important;
        }

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
    <?php
     if(isset($_GET['subject'])){
         $subject_id = $_GET['subject'];

         $sql = "SELECT * FROM subjects WHERE id =:id";
         $conn->query($sql);
         $conn->bind(":id", $subject_id);
         $result = $conn->fetchSingle();
         $db_id = $result->id;

         if($subject_id == $db_id){
           $subject_name = $result->subject_name;
           $teacher_name = $result->teacher_name;
           $class_id = $result->class_id;
           $pass_mark = $result->pass_mark;
           $final_mark = $result->final_mark;
           $subject_author = $result->subject_author;
           $subject_code = $result->subject_code;

           //fetch class name from classes

            $sql = "SELECT name FROM classes WHERE id =:id";
            $conn->query($sql);
            $conn->bind(":id", $class_id);
            $class_name = $conn->fetchColumn();
    ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Editing Subject: <?php echo $subject_name; ?> </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="<?php echo $conn->base_url(); ?>subject">All Subjects</a></li>
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
                    <div class="col-lg-8">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Class: <?php echo $class_name; ?></h3>
                            </div>

                            <form action="" class="form-horizontal" method="post" id="subject-edit">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="class_name" class="col-sm-3 col-form-label">Class Name <span
                                                    style="color: #f00;">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="class_name" id="class_name" class="form-control select2"
                                                    required data-parsley-trigger="keyup" style="width: 100%;">
                                                <option value="<?php echo $class_id; ?>" selected><?php echo $class_name; ?></option>
                                                <?php
                                                //fetch all teacher information
                                                $sql = "SELECT * FROM classes WHERE name != :name";
                                                $conn->query($sql);
                                                $conn->bind(":name", $class_name);
                                                $rowCount = $conn->rowCount();
                                                if ($rowCount > 0) {
                                                    $result = $conn->fetchMultiple();
                                                    foreach ($result as $class) {
                                                        ?>
                                                        <option value="<?php echo $class->id; ?>"><?php echo $class->name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="teacher_name" class="col-sm-3 col-form-label">Teacher <span
                                                    style="color: #f00;">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="teacher_name" id="teacher_name" class="form-control select2"
                                                    required data-parsley-trigger="keyup" style="width: 100%;">
                                                <option value="<?php echo $teacher_name; ?>"><?php echo $teacher_name; ?></option>
                                                <?php
                                                //fetch all teacher information
                                                $sql = "SELECT * FROM teachers WHERE name !=:name";
                                                $conn->query($sql);
                                                $conn->bind(":name", $teacher_name);
                                                $rowCount = $conn->rowCount();
                                                if ($rowCount > 0) {
                                                    $result = $conn->fetchMultiple();
                                                    foreach ($result as $teachers) {
                                                        ?>
                                                        <option value="<?php echo $teachers->name; ?>"><?php echo $teachers->name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="pass_mark" class="col-sm-3 col-form-label">Pass Mark <span
                                                    style="color: #f00;">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="pass_mark" required
                                                   data-parsley-trigger="keyup" name="pass_mark" value="<?php echo $pass_mark; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="final_mark" class="col-sm-3 col-form-label">Final Mark<span
                                                    style="color: #f00;">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="number" id="final_mark" name="final_mark" class="form-control"
                                                   required data-parsley-trigger="keyup" value="<?php echo $final_mark; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="subject_name" class="col-sm-3 col-form-label">Subject Name<span
                                                    style="color: #f00;">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="subject_name" name="subject_name"
                                                   class="form-control" required data-parsley-trigger="keyup" value="<?php echo $subject_name; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="subject_author" class="col-sm-3 col-form-label">Subject
                                            Author</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="subject_author" name="subject_author"
                                                   class="form-control" data-parsley-trigger="keyup" value="<?php echo $subject_author; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="subject_code" class="col-sm-3 col-form-label">Subject Code<span
                                                    style="color: #f00;">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="subject_code" name="subject_code"
                                                   class="form-control" required data-parsley-trigger="keyup" value="<?php echo $subject_code; ?>">
                                        </div>
                                    </div>
                                    <input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>">

                                    <div class="form-group row">
                                        <label for="submit" class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <input type="submit" name="edit_subject" value="Update Subject"
                                                   class="btn btn-success" id="submit">
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
    <?php
     }else{
    $redirect = $base_url."subject";
    header("Location: $redirect");
}
    ?>
<?php
     }else{
         $redirect = $base_url."subject";
         header("Location: $redirect");
}

?>
<?php include 'includes/footer.php'; ?>
<!-- Add logo  Modal start -->

<script>
    $('[data-toggle ="tooltip"]').tooltip();
</script>

    <script>
       $(function () {
           $('.select2').select2();
       })
    </script>
<script>
    $('#subject-edit').parsley();
    $('#subject-edit').on('submit', function(event){
        event.preventDefault();
        if($('#subject-edit').parsley().isValid()){
            $.ajax({
                url: "<?php echo $base_url; ?>process-edit-subject.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#submit').attr('disabled', 'disabled');
                    $('#submit').val('Updating Subject details, pls wait ......');

                },
                success:function (data) {
                    $('#subject-edit').parsley().reset();
                    $('#submit').attr('disabled', false);
                    $('#submit').val('Update Subject');
                    $('#success-msg').html(data);
                }
            })
        }

    })
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