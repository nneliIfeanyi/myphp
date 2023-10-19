<?php

session_start();
//error_reporting('0');
if(isset($_SESSION['student']) && isset($_GET['result_pin']) && isset($_GET['name'])
   && isset($_GET['term']) && isset($_GET['year'])){
    
?> 

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <?php include '../admin/includes/styles.php'; ?>
    <title>View Terminal Report | <?php echo $school_name; ?></title>
 </head>
 <body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">
       <!-- Navbar -->
       <?php include 'includes/notifications.php'; ?>
    <!-- /.navbar -->

       <!-- Main Sidebar Container -->
       <?php include "includes/sidebar.php";?>



       <?php 
        $name = $_SESSION['student'];
        $exam_year = $_GET['year'];
        $exam_term = $_GET['term'];
        $card_serial = $_GET['result_pin'];

         //get users information from the database

         $sql = "SELECT * FROM student WHERE username = :name";
         $conn->query($sql);
         $conn->bind(":name", $name);
         $row_count = $conn->rowCount();
         $result = $conn->fetchSingle();

         $class_id = $result->classesID;
         $section_id = $result->sectionid;

         if($row_count > 0){
             
            $student_name = $result->name;
             //proceed with querying the pins table to authenticate users pin
             $sql = "SELECT * FROM pins WHERE used_by = :name AND pin_code =:card_serial AND card_availability =:open";
             $conn->query($sql);
             $conn->bind(":name", $student_name);
             $conn->bind(":card_serial", $card_serial);
             $conn->bind(":open", 'open');
             $row_count = $conn->rowCount();

             if($row_count > 0){
                 
                $result = $conn->fetchSingle();
                $pin = $result->pin_code;
                $user_card_availability = $result->card_availability;
                $user_card_usage = $result->card_usage;
                //go ahead and fetch result information for the user.

                $new_exam_term = str_replace('-', ' ', $exam_term);
                $result_sql = "SELECT * FROM results WHERE name_of_student =:student AND exam=:exam_term  
                        AND school_year =:exam_year";
                 $conn->query($result_sql);
                 $conn->bind(":student", $student_name);
                 $conn->bind(":exam_year", $exam_year);
                 $conn->bind(":exam_term", $new_exam_term); 


                  //result is displayed in the HTML table below.

             }else{
                echo "<script>
                toastr['error']('You have exceeded your card usage limit.');
              </script>";
             }

         }else{
            echo "<script>
            toastr['error']('an error occurred. pls try again.');
           </script> <meta http-equiv='refresh' content='2; index'>";
         }
       
       
       
       ?>

       <div class="content-wrapper">

 <!-- Content Header (Page header) -->
 <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">View Terminal Report</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">View Terminal Report </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->


        <section class="content">

         <div class="content-fluid">
            <div class="row">
                <section class="col-lg-12 contentSortable">

                  <div class="card">
                  <div class="card-header" style="background: #17a2b8; color: white;">
                        <h3 class="card-title" style="font-size: 15px;"> <i class="fa fa-star"></i> Showing <?php echo $student_name ."'s"; ?> terminal report for year <?php echo $exam_year; ?>, <?php echo $exam_term?>.</h3>
                       </div>

                       <div class="card-body">
                          <table id="teacher" class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Exam Year</th>
                                <th>Exam Term</th>
                                <th>Action</th> 
                                </tr>
                            </thead>

                            <tbody>

                             <?php 
                              $row_count = $conn->rowCount(); 

                              if($row_count > 0){
                               //show users results in the HTML table below.

                               $result_show = $conn->fetchSingle();
                               $user_id = $result_show->id;
                                $studentName = $conn->slugify($result_show->name_of_student);
                                $year = $result_show->school_year;
                                $term = $conn->slugify($result_show->exam);
                                // $class = $conn->slugify($result_show->class);
                                // $section = $conn->slugify($result_show->section);


                         //fetch student class name
                            $sql = "SELECT name FROM classes WHERE id =:class_id";
                            $conn->query($sql);
                            $conn->bind(":class_id", $class_id);
                            $db_class = $conn->fetchColumn();
                            $class = $conn->slugify($db_class);

                            //fetch student section name
                            $sql = "SELECT name FROM sections WHERE id =:section_id";
                            $conn->query($sql);
                            $conn->bind(":section_id", $section_id);
                            $db_section = $conn->fetchColumn();
                            $section = $conn->slugify($db_section);

                                ?> 
                                 <tr>
                                   <td><?= $user_id; ?></td>
                                   <td><?= $studentName; ?></td>
                                   <td><?= $year; ?></td>
                                   <td><?= $term; ?></td>
                                   <td>
                                     <form action="<?php echo $conn->student_url();?>generate-report" method='post'>
                                     <input type="hidden" name="name" value="<?php echo $studentName; ?>"> 
                                     <input type="hidden" name="exam" value="<?php echo $term; ?>">
                                     <input type="hidden" name="year" value="<?php echo $year; ?>">
                                     <input type="hidden" name="section" value="<?php echo $section; ?>">
                                     <input type="hidden" name="class" value="<?php echo $class; ?>"> 
                                     <input type="submit" name="generate-report" value="View Result" class="btn btn-success" title="View Result" formtarget="_blank">
                                    
                                    </form>
                                   </td>


                                 </tr>
                                
                                
                                
                                
                                <?php

                              }else{

                                ?>
                                    <tr>
                                        <td colspan="5" class="text-center"> <?php echo "No result found for user $student_name. Pls check back later." ?></td>
                                    </tr>
                                
                                <?php
                              }
                             
                             
                             ?>
                             <tfoot>
                                <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Exam Year</th>
                                <th>Exam Term</th>
                                <th>Action</th> 
                                </tr>
                             </tfoot>
                            </tbody>
                          </table>
                            

                       </div>
                  </div>
                </section>
            </div>

         </div>

        </section>

       
       </div>

    </div>

  </div>
    
  <?php include '../admin/includes/footer.php'; ?>



  <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
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


?>


<?php 

   }else{
    ?> 
    
     <!DOCTYPE html>
     <html lang="en">
     <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include '../admin/includes/style.php'; ?>
        <title>Login to continue | <?php echo $school_name; ?></title>
     </head>
     <body>
          
        <div class="container" style='margin-top: 20%;'>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="section-title text-center">
                        <h6>You need to login to continue. </h6>
                        <div class="spinner-border text-info" role='status'>
                            <span class='sr-only'>Loading....</span>
                            <meta htt-equiv='refresh' content='3; <?php $student_login_link; ?>'>
                             <p>Redireting to the login page ...</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

     </body>
     </html>
    
    <?php
     

   }
?>

