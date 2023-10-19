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
        <title> Show or Hide Class Positions in terminal Report  | <?php echo $school_name; ?></title>
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
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> Position Settings </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active"> Position Settings </li>
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
                    <section class="col-lg-12 connectedSortable">
                        <?php
                        $sql = "SELECT * FROM classes";
                        $conn->query($sql);
                        $rowCount = $conn->rowCount();
                        $result = $conn->fetchMultiple();
                        ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Manage Position Settings <i class='fa fa-info-circle' data-toggle="tooltip" title="Use this section to either show the students positions or hide them on the terminal report for a particular class." style="cursor: pointer;"></i></h3>
                            </div>
                            <div class="card-body">
                                <table id="class" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Class</th>
                                        <th>Teacher Name</th>
                                        <th>Position Visible</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    if($rowCount > 0){
                                        foreach ($result as $class):
                                            $name = $class->name;
                                            $teacher_name = $class->teacher_name;
                                            $position = $class->show_position;
                                            $class_id = $class->id

                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $teacher_name; ?></td>
                                                <td>
                                                    <?php
                                                    if($position == 'yes'){
                                                        ?> <button class='btn btn-success'><span style='color: #fff;'>Visible</span></button><?php
                                                    }else{
                                                        ?> <button class='btn btn-danger'><span style='color: #fff;'>Hidden</span></button><?php
                                                    }
                                                    ?>

                                                </td>

                                                <td>
                                                    <?php
                                                    if($position == 'yes'){
                                                        ?>    <a href="javascript:void();" data-toggle='modal' data-target='#close-position<?php echo $class_id;?>'>
                                                            <i class="fa fa-eye-slash" data-toggle="tooltip" title="Set position to hidden"></i>
                                                        </a><?php
                                                    }else{
                                                        ?>    <a href="javascript:void();" data-toggle='modal' data-target='#close-position<?php echo $class_id;?>'>
                                                            <i class="fa fa-eye" data-toggle="tooltip" title="Set position to visible"></i>
                                                        </a><?php
                                                    }
                                                    ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php
                                    }else{
                                        ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No Data in table</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Class</th>
                                        <th>Teacher Name</th>
                                        <th>Position Visible</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </div>


                    </section>

                </div>



            </div><!-- /.row (main row) -->
        </section>
    </div><!-- /.container-fluid -->
    <!-- /.content -->

    <!-- /.content-wrapper -->

<?php include 'includes/footer.php'; ?>
<?php
foreach ($result as $class){
$name = $class->name;
$teacher_name = $class->teacher_name;
$position = $class->show_position;
$class_id = $class->id;
?>
    <!--       close position  modal start-->
    <div class="modal fade" id="close-position<?php echo $class_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change class position visibility on terminal report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                     <?php
                     if($position == 'yes'){
                         ?><p>Are you sure you want to change position visibility status from <span style="color: #00b855;">visible </span>  to <span style="color: #f00;"> hidden </span>for <span style="color: #00b855;"><?php echo $name; ?></span>?</p>
                         <?php
                     }else{
                         ?><p>Are you sure you want to change position visibility status from <span style="color: #f00;">hidden </span>  to <span style="color: #00b855;"> visible </span>for <span style="color: #00b855;"><?php echo $name; ?></span>?</p>
                         <?php
                     }

                     ?>


                    <form action="" method="post">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $class_id; ?>">
                        </div>
                        <div class="modal-footer" style="margin-bottom: -10px;">

                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>

                            <?php
                             if($position == 'yes'){
                                  ?>  <input type="submit" class="btn btn-outline-danger" value="Change to hidden" id="submit" name="to_hidden"><?php
                             }else{
                                 ?>
                                 <input type="submit" class="btn btn-outline-success" value="Change to visible" id="submit" name="to_visible">
                                 <?php
                             }

                            ?>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--          Delete teacher modal end -->

<?php
}

//delete teacher script
$redirect = $conn->base_url().'show-position';
if(isset($_POST['to_hidden'])){
    $id = $_POST['id'];
    //sql
    $sql = "UPDATE  classes SET show_position =:hidden WHERE id =:id";
    $conn->query($sql);
    $conn->bind(":id", $id);
    $conn->bind(":hidden", 'no');

    try{
        $conn->execute();
        echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
                    <i class='fas fa-check-circle'></i> Visibility set to hidden successfully.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <span aria-hidden=\"true\">×</span>
                  </button>
                   <meta http-equiv='refresh' content='3; $redirect'>
                  
           </p>";
    }catch (PDOException $err){
        echo $err->getMessage();
    }
}

if(isset($_POST['to_visible'])){
    $id = $_POST['id'];
    //sql
    $sql = "UPDATE  classes SET show_position =:visible WHERE id =:id";
    $conn->query($sql);
    $conn->bind(":id", $id);
    $conn->bind(":visible", 'yes');

    try{
        $conn->execute();
        echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
                    <i class='fas fa-check-circle'></i> Visibility set to visible successfully.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <span aria-hidden=\"true\">×</span>
                  </button>
                   <meta http-equiv='refresh' content='3; $redirect'>
                  
           </p>";
    }catch (PDOException $err){
        echo $err->getMessage();
    }
}
?>

    <script>
        $('[data-toggle ="tooltip"]').tooltip();
    </script>

    <script>
        $(function () {
            $("#class").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "pdf", "print"]
            }).buttons().container().appendTo('#class_wrapper .col-md-6:eq(0)');
        });
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