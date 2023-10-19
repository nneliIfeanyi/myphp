<?php
error_reporting(0);
session_start();
//error_reporting(0);
if(isset($_SESSION['username'])){

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include('includes/styles.php');?>
    <title> Student  | <?php echo $school_name; ?></title>
    <style>
            .card-title a {
            font-size: 16px;
            border-bottom: 1px solid #707478;
            color: #707478;
        }
        .card-title a:hover{
            border-bottom: 1px solid #1A2229;
            color: #1A2229;
        }
        .btn-app:first-child{
            margin-left:0 !important;
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
                        <h1 class="m-0">Student </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Student</li>
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
                     <div class="card">
                         <div class="card-header" style="background: #17a2b8; color: #fff;">
                             <h3 class="card-title" style="font-size: 15px;">
                                     <i class="fa fa-star"></i>
                                 Manage Students
                             </h3>
                         </div>
                         <div class="card-header">
                             <h3 class="card-title">
                                 <a href="<?php echo $conn->base_url(); ?>add-student">Add a student
                                   <i class="fa fa-plus"></i>
                                 </a>
                             </h3>
                         </div>
                         <div class="card-body">
                             <h3 class="card-title text-center" style="font-size: 15px;">
                                 Please select a class to view available students
                                 <i class="fa fa-info-circle" data-toggle="tooltip" title="N:B: Only classes with students added
                                        are clickable"></i>

                             </h3>
                             <br><br>
                             <div>
                                 <?php
                                  $sql = "SELECT * FROM classes";
                                  $conn->query($sql);
                                  $result = $conn->fetchMultiple();
                                  $n = 0;

                                  foreach ($result as $class){
                                      $class_name = strtolower($conn->slugify($class->name));
                                      $class_id = $class->id;

                                      //badge color array
                                      $badge_color = array('bg-success', 'bg-purple', 'bg-warning', 'bg-info', 'bg-danger', 'bg-teal');
                                      //fetch available section data in class
                                      $sql = "SELECT COUNT(studentID) FROM student WHERE classesID =:class_id";
                                      $conn->query($sql);
                                      $conn->bind(":class_id", $class_id);
                                      $students_available = $conn->fetchColumn();
                                      //enable or disable link on number of available sections
                                      $link = $base_url."student/$class_id";

                                      ?>
                                      <a class="btn btn-app" style="min-width:120px; height: 90px;" <?php
                                         if($students_available != 0){
                                             echo "href='$link'";
                                         }
                                      ?>> <span class="badge <?php echo $badge_color[$n];?>" data-toggle="tooltip"
                                                title="<?php echo $students_available; ?> student(s) available in class <?php echo $class_name; ?>">
                                             <?php echo $students_available; ?>
                                          </span>
                                         <i class="fas fa-users" style="font-size: 50px;"> </i>
                                          <?php echo ucwords(str_replace('-', ' ', $class_name));?>
                                      </a>
                                      <?php
                                      $n++;
                                  }

                                 ?>
                             </div>

                             <?php
                              if(isset($_GET['class'])){
                                  $class = ucwords(str_replace('-', ' ', $_GET['class']));
                                  $sql = "SELECT * FROM student WHERE classesID = :class";
                                  $conn->query($sql);
                                  $conn->bind(":class", $class);
                                  $result = $conn->fetchMultiple();

                                  $sql = "SELECT name FROM classes WHERE id =:id";
                                  $conn->query($sql);
                                  $conn->bind(":id", $class);
                                  $class_name = $conn->fetchColumn();

                                  ?>
                                  <div class="card-header" style="background: #c3570f; color: #fff; margin: 20px 0 2px;">
                                      <h3 class="card-title" style="font-size: 15px;">
                                          <i class="fa fa-star"></i>
                                          Viewing Students details for class <?php echo $class_name; ?>
                                      </h3>
                                  </div>

                                  <table id="subject" class="table table-bordered table-striped">
                                      <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Photo</th>
                                          <th>Name</th>
                                          <th>Username</th>
                                          <th>Reg No</th>
                                          <th>Section</th>
                                          <th>status</th>
                                          <th>Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                                      $i = 1;
                                      if($conn->rowCount() > 0){
                                          foreach ($result as $student_details):
                                              $name = $student_details->name;
                                              $username= $student_details->username;
                                              $photo = $student_details->photo;
                                              $student_id = $student_details->studentID;
                                              $sex= $student_details->sex;
                                              $reg_no = $student_details->registerNO;
                                              $status = $student_details->status;
                                              $sectionid = $student_details->sectionid;

                                              //fetch student section
                                              $sql = "SELECT name FROM sections WHERE class =:id AND id =:sectionid";
                                              $conn->query($sql);
                                              $conn->bind(":id", $class);
                                              $conn->bind(":sectionid", $sectionid);
                                              $sectionName = $conn->fetchColumn();

                                              ?>
                                              <tr>
                                                  <td><?php echo $i++; ?></td>
                                                  <td>
                                                      <?php
                                                      if(empty($photo)){
                                                          ?> <img src="<?php echo $base_url; ?>images/default.png" alt="default" width="48" height="48"><?php
                                                      }else{
                                                          ?> <img src="<?php echo $base_url; ?>upload/<?php echo $photo;?>" alt="photo" width="48" height="48"><?php
                                                      }
                                                      ?>
                                                  </td>
                                                  <td><?php echo $name;?></td>
                                                  <td><?php echo $username;?></td>
                                                  <td><?php echo $reg_no;?></td>
                                                  <td><?php echo $sectionName;?></td>
                                                  <td>
                                                      <?php
                                                      if($status == 'on'){
                                                          ?> <i class="fa fa-check-circle" style="font-size: 20px; color: #085d3d; cursor:pointer;" data-toggle="tooltip" title="Active"></i> <?php
                                                      }else{
                                                          ?> <i class="fa fa-check-circle" style="font-size: 20px; color: #6c757d; cursor:pointer;" data-toggle="tooltip" title="Inactive"></i> <?php
                                                      }
                                                      ?>
                                                  </td>
                                                  <td>
                                                      <a href="<?php echo $base_url; ?>view-student/<?php echo $username;?>" data-toggle="tooltip" title="View">
                                                          <i class="fa fa-check-square"></i>
                                                      </a>&nbsp;
                                                      <a href="<?php echo $base_url; ?>edit-student/<?php echo $username;?>"  data-toggle="tooltip" title="Edit">
                                                          <i class="fa fa-edit"></i>
                                                      </a>&nbsp;

                                                      <a href="javascript:void();" data-toggle='modal' data-target='#delete-student<?php echo $username;?>'>
                                                          <i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i>
                                                      </a>

                                                  </td>
                                              </tr>
                                          <?php endforeach; ?>
                                          <?php
                                      }else{
                                          ?>
                                          <tr>
                                              <td colspan="8" class="text-center">No Data in table</td>
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
                                          <th>Username</th>
                                          <th>Reg No</th>
                                          <th>Section</th>
                                          <th>status</th>
                                          <th>Action</th>
                                      </tr>
                                      </tfoot>

                                  </table>


                                  <?php
                              }

                             ?>

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
      foreach ($result as $student_details){
        $name = $student_details->name;
        $username= $student_details->username;

    ?>
<!--          Delete subject modal start-->
          <div class="modal fade" id="delete-student<?php echo $username; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-md" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Delete student <?php echo $name; ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <h4>Are you sure you want to do this?
                              <br><small class="text-warning">This action cannot be undone.</small>
                          </h4>
                          <form action="" method="post">
                            <div class="form-group">
                                <input type="hidden" name="username" value="<?php echo $username; ?>">
                            </div>
                          <div class="modal-footer" style="margin-bottom: -10px;">

                              <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                              <input type="submit" class="btn btn-outline-danger" value="Delete student" id="submit" name="delete_student">
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

    if(isset($_POST['delete_student'])){
          $username = $_POST['username'];
          //sql
        $sql = "DELETE FROM student WHERE username=:username";
        $conn->query($sql);
        $conn->bind(":username", $username);
        $redirect = $base_url.'student';

        try{
            $conn->execute();
            echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
                    <i class='fas fa-check-circle'></i>Student's data deleted successfully.
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
            $("#subject").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "pdf", "print"]
            }).buttons().container().appendTo('#subject_wrapper .col-md-6:eq(0)');
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