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
        <title> Grades | <?php echo $school_name; ?></title>
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
                        <h1 class="m-0">Exam </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Grades</li>
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
                        <a href="<?php echo $conn->base_url(); ?>add-grade"> <button class="btn btn-outline-success">Add a grade </button></a>
                    </section>

                    <section class="col-lg-12 connectedSortable">
                        <?php
                        $sql = "SELECT * FROM grade ORDER BY grade_name ASC";
                        $conn->query($sql);
                        $rowCount = $conn->rowCount();
                        $result = $conn->fetchMultiple();
                        ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Manage Exam Grades</h3>
                            </div>
                            <div class="card-body">
                                <table id="class" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Grade Name</th>
                                        <th>Grade Point</th>
                                        <th>Mark From</th>
                                        <th>Mark Upto</th>
                                        <th>Note</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    if($rowCount > 0){
                                        foreach ($result as $grades):
                                            $grade_name = $grades->grade_name;
                                            $grade_point = $grades->grade_point;
                                            $markfrom = $grades->mark_from;
                                            $mark_upto = $grades->mark_upto;
                                            $note = $grades->note;
                                            $grade_id = $grades->id;

                                            ?>
                                            <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $grade_name;?></td>
                                            <td><?php echo $grade_point;?></td>
                                            <td><?php echo $markfrom;?></td>
                                            <td><?php echo $mark_upto;?></td>
                                            <td><?php echo $note;?></td>
                    
                                                <td>
                                                    <a href="<?php echo $base_url;?>edit-grade/<?php echo $grade_id;?>" data-toggle="tooltip" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>&nbsp;
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#delete-grade<?php echo $grade_id;?>">
                                                        <i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php
                                    }else{
                                        ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No Data in table</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Grade Name</th>
                                        <th>Grade Point</th>
                                        <th>Mark From</th>
                                        <th>Mark Upto</th>
                                        <th>Note</th>
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
foreach ($result as $grades){
    $grade_name = $grades->grade_name;
    $grade_point = $grades->grade_point;
    $markfrom = $grades->mark_from;
    $mark_upto = $grades->mark_upto;
    $grade_id = $grades->id;
?>
    <!--          Delete teacher modal start-->
    <div class="modal fade" id="delete-grade<?php echo $grade_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete grade <?php echo $grade_name; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Are you sure you want to delete <span style="color: #f00; text-transform: uppercase;"><?php echo $grade_name; ?></span></h4>
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $grade_id; ?>">
                        </div>
                        <div class="modal-footer" style="margin-bottom: -10px;">

                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                            <input type="submit" class="btn btn-outline-danger" value="Delete grade" id="submit" name="delete_grade">
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
$redirect = $conn->base_url().'grade';

if(isset($_POST['delete_grade'])){
    $id = $_POST['id'];
    //sql
    $sql = "DELETE FROM grade WHERE id =:id";
    $conn->query($sql);
    $conn->bind(":id", $id);
    
    try{
        $conn->execute();
        echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
                    <i class='fas fa-check-circle'></i> Grade data deleted successfully.
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
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });
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