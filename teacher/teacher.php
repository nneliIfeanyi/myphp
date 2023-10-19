<?php
session_start();
if(isset($_SESSION['teacher'])){

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include('../admin/includes/styles.php');?>
    <title> Teachers  | <?php echo $school_name; ?></title>
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
                        <h1 class="m-0">Teachers </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $teacher_url; ?>">Home</a></li>
                            <li class="breadcrumb-item active">Teachers</li>
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
                          $sql = "SELECT * FROM teachers";
                          $conn->query($sql);
                          $rowCount = $conn->rowCount();
                          $result = $conn->fetchMultiple();
                        ?>
                     <div class="card">
                         <div class="card-header">
                             <h3 class="card-title">Manage Teachers</h3>
                         </div>
                         <div class="card-body">
                             <table id="teacher" class="table table-bordered table-striped">
                                 <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>Photo</th>
                                       <th>Name</th>
                                       <th>Email</th>
                                       <th>Status</th>
                                       <th>Action</th>
                                   </tr>
                                 </thead>
                                  <tbody>
                                    <?php
                                      $i = 1;
                                      if($rowCount > 0){
                                          foreach ($result as $teacher):
                                              $name = $teacher->name;
                                              $email = $teacher->email;
                                              $photo = $teacher->photo;
                                              $status = $teacher->status;

                                              ?>
                                               <tr>
                                                   <td><?php echo $i++; ?></td>
                                                   <td>
                                                       <?php
                                                         if(empty($photo)){
                                                            ?> <img src="<?php echo $base_url;?>images/default.png" alt="" width="32" height="32"><?php
                                                         }else{
                                                             ?> <img src="<?php echo $base_url;?>upload/<?php echo $photo;?>" alt="" width="32" height="32"><?php
                                                         }
                                                       ?>
                                                   </td>
                                                   <td><?php echo $name; ?></td>
                                                   <td><?php echo $email; ?></td>
                                                   <td>
                                                       <?php
                                                         if($status == 'on'){
                                                             ?> <i class="fa fa-check-circle" style="font-size: 20px; color: #085d3d; cursor: pointer;" data-toggle="tooltip" title="Active"></i><?php
                                                         }else{
                                                             ?> <i class="fa fa-check-circle" style="font-size: 20px; color: #6c757d; cursor: pointer;" data-toggle="tooltip" title="Inactive"></i><?php
                                                         }
                                                       ?>
                                                   </td>
                                                   <td>
                                                       <a href="<?php echo $teacher_url;?>/view-teacher/<?php echo $teacher->username;?>" data-toggle="tooltip" title="View">
                                                           <i class="fa fa-check-square"></i>
                                                       </a>&nbsp;
                                                   </td>
                                               </tr>
                                              <?php endforeach; ?>
                                              <?php
                                      }else{
                                          ?>
                                          <tr>
                                              <td colspan="6" class="text-center">No Data in table</td>
                                          </tr>
                                          <?php
                                      }
                                    ?>
                                  </tbody>

                                 <tfoot>
                                 <tr>
                                     <th>#</th>
                                     <th>Photo</th>
                                     <th>Name</th>
                                     <th>Email</th>
                                     <th>Status</th>
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

    <?php include '../admin/includes/footer.php'; ?>

<script>
     $('[data-toggle ="tooltip"]').tooltip();
</script>

    <script>
        $(function () {
            $("#teacher").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "pdf", "print"]
            }).buttons().container().appendTo('#teacher_wrapper .col-md-6:eq(0)');
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