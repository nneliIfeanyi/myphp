<?php ob_start(); ?>
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
    <title> Edit Class | <?php echo $school_name; ?></title>
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
    <?php
      if(isset($_GET['class'])){
          $class_id = $_GET['class'];
          $sql = "SELECT * FROM classes WHERE id =:id";
          $conn->query($sql);
          $conn->bind(":id", $class_id);
          $result = $conn->fetchSingle();
          $db_id = $result->id;
          if($class_id == $db_id){
              $class_name = $result->name;
              $teacher_name = $result->teacher_name;
              $class_numeric = $result->class_numeric;
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Editing <?php echo $class_name; ?> </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo $conn->base_url();?>class">All classes</a></li>
                            <li class="breadcrumb-item active"><?php echo $class_name; ?></li>
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
                                <h3 class="card-title">Editing Classs</h3>
                            </div>
                            <form action="" class="form-horizontal" method="post" id="class-edit">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Class name <span style="color: #f00;">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" required data-parsley-trigger="keyup" name="name" value="<?php echo $class_name; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="class_numeric" class="col-sm-3 col-form-label">Class Numeric<span style="color: #f00;">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="number" id="class_numeric" name="class_numeric" class="form-control" required data-parsley-trigger="keyup" value="<?php echo $class_numeric; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="teacher_name" class="col-sm-3 col-form-label">Teacher Name</label>
                                        <div class="col-sm-9">
                                            <select name="teacher_name" id="teacher_name" class="form-control select2" required  data-parsley-trigger="keyup" style="width: 100%;">
                                                <option value="<?php echo $teacher_name; ?>" selected><?php echo $teacher_name; ?></option>
                                                <?php
                                                //fetch all teacher information
                                                $sql = "SELECT * FROM teachers WHERE name !=:name";
                                                $conn->query($sql);
                                                $conn->bind(":name", $teacher_name);
                                                $rowCount = $conn->rowCount();
                                                if($rowCount > 0){
                                                    $result = $conn->fetchMultiple();
                                                    foreach ($result as $teachers){
                                                        ?>
                                                        <option value="<?php echo $teachers->name; ?>"><?php echo $teachers->name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">

                                    <div class="form-group row">
                                        <label for="state" class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <input type="submit" name="update_class" value="Update Class" class="btn btn-success" id="submit">
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
    //redirect back to the teacher's page
    header("Location: ../class");
}
?>
<?php }else{
    //redirect back to the teacher's page
    header("Location: class");
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
    $('#class-edit').parsley();
    $('#class-edit').on('submit', function(event){
        event.preventDefault();
        if($('#class-edit').parsley().isValid()){
            $.ajax({
                url: "<?php echo $conn->base_url();?>process-edit-class.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#submit').attr('disabled', 'disabled');
                    $('#submit').val('Updating class details, pls wait ......');

                },
                success:function (data) {
                    $('#class-edit').parsley().reset();
                    $('#submit').attr('disabled', false);
                    $('#submit').val('Update Class');
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