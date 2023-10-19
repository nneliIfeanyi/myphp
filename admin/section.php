<?php
session_start();
error_reporting(0);
if(isset($_SESSION['username'])){

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include('includes/styles.php');?>
    <title> Sections  | <?php echo $school_name; ?></title>
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
                        <h1 class="m-0">Sections </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Sections</li>
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
                                 Manage Sections
                             </h3>
                         </div>
                         <div class="card-header">
                             <h3 class="card-title">
                                 <a href="<?php echo $conn->base_url(); ?>add-section">Add section
                                   <i class="fa fa-plus"></i>
                                 </a>
                             </h3>
                         </div>
                         <div class="card-body">
                             <h3 class="card-title text-center" style="font-size: 15px;">
                                 Please select a class to view the section
                                 <i class="fa fa-info-circle" data-toggle="tooltip" title="N:B: Only classes with sections added
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
                                      $sql = "SELECT COUNT(id) FROM sections WHERE class =:class_id";
                                      $conn->query($sql);
                                      $conn->bind(":class_id", $class_id);
                                      $section_available = $conn->fetchColumn();
                                      //enable or disable link on number of available sections
                                      $link = $base_url."section/$class_id";

                                      ?>
                                      <a class="btn btn-app" style="min-width:120px; height: 90px;" <?php
                                         if($section_available != 0){
                                             echo "href='$link'";
                                         }
                                      ?>> <span class="badge <?php echo $badge_color[$n];?>" data-toggle="tooltip"
                                                title="<?php echo $section_available; ?> section(s) available in class <?php echo $class_name; ?>">
                                             <?php echo $section_available; ?>
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
                              if(isset($_GET['section'])){
                                  $section = ucwords(str_replace('-', ' ', $_GET['section']));
                                  $sql = "SELECT * FROM sections WHERE class = :section";
                                  $conn->query($sql);
                                  $conn->bind(":section", $section);
                                  $result = $conn->fetchMultiple();

                                  $sql = "SELECT name FROM classes WHERE id =:id";
                                  $conn->query($sql);
                                  $conn->bind(":id", $section);
                                  $class_name = $conn->fetchColumn();

                                  ?>
                                  <div class="card-header" style="background: #c3570f; color: #fff; margin: 20px 0 2px;">
                                      <h3 class="card-title" style="font-size: 15px;">
                                          <i class="fa fa-star"></i>
                                          Viewing Section details for class <?php echo $class_name; ?>
                                      </h3>
                                  </div>

                                  <table id="section" class="table table-bordered table-striped">
                                      <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Section</th>
                                          <th>Capacity</th>
                                          <th>Category</th>
                                          <th>Teacher Name</th>
                                          <th>Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                                      $i = 1;
                                      if($conn->rowCount() > 0){
                                          foreach ($result as $section_details):
                                              $name = $section_details->name;
                                              $capacity = $section_details->capacity;
                                              $category = $section_details->category;
                                              $teacher_name = $section_details->teacher_name;
                                              $section_id = $section_details->id;


                                              ?>
                                              <tr>
                                                  <td><?php echo $i++; ?></td>
                                                  <td><?php echo $name; ?></td>
                                                  <td><?php echo $capacity; ?></td>
                                                  <td><?php echo $category; ?></td>
                                                  <td><?php echo $teacher_name; ?></td>
                                                  <td>
                                                      <a href="<?php echo $base_url;?>edit-section/<?php echo $section_id;?>" data-toggle="tooltip" title="Edit">
                                                          <i class="fa fa-edit"></i>
                                                      </a>&nbsp;
                                                      <a href="javascript:void(0);" data-toggle="modal" data-target="#delete-section<?php echo $section_id;?>">
                                                          <i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i>
                                                      </a>
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
                                          <th>Section</th>
                                          <th>Capacity</th>
                                          <th>Category</th>
                                          <th>Teacher Name</th>
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
      foreach ($result as $section_details){
            $name = $section_details->name;
            $capacity = $section_details->capacity;
            $category = $section_details->category;
            $teacher_name = $section_details->teacher_name;
            $section_id = $section_details->id;
          ?>
<!--          Delete teacher modal start-->
          <div class="modal fade" id="delete-section<?php echo $section_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-md" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Delete section <?php echo $name; ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <h4>Are you sure you want delete section <span style="color: #f00; text-transform: uppercase;"><?php echo $name; ?></span></h4>
                          <form action="" method="post">
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $section_id; ?>">
                            </div>
                          <div class="modal-footer" style="margin-bottom: -10px;">

                              <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                              <input type="submit" class="btn btn-outline-danger" value="Delete section" id="submit" name="delete_section">
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

    if(isset($_POST['delete_section'])){
          $id = $_POST['id'];
          //sql
        $sql = "DELETE FROM sections WHERE id =:id";
        $conn->query($sql);
        $conn->bind(":id", $id);
        $redirect = $base_url.'section';

        try{
            $conn->execute();
            echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
                    <i class='fas fa-check-circle'></i>Section data deleted successfully.
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
            $("#section").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "pdf", "print"]
            }).buttons().container().appendTo('#section_wrapper .col-md-6:eq(0)');
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