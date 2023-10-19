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
    <title> Add new system admin | <?php echo $school_name; ?></title>
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
                        <h1 class="m-0">Add new System Admin</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">System Admin</li>
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
                     <div class="card card-info">
                         <div class="card-header" style="background: #17a2b8; color: white;">
                             <?php 
                              $sql = 'SELECT type FROM admin WHERE username =:username';
                             $conn->query($sql);
                             $conn->bind(":username", $_SESSION['username']);
                             $user_type = $conn->fetchColumn();

                             if($user_type != 'superadmin'){
                                 ?>  <h3 class="card-title" style="font-size: 15px;"> <i class="fa fa-star"></i> You are not permitted to add new system admin. Only super admin can do that.</h3><?php
                             }else{
                                ?>  <h3 class="card-title" style="font-size: 15px;"> <i class="fa fa-star"></i>Add new system admin </h3><?php
                             }

                             
                             ?>
                         </div>

                        <div class="card-body">
                         <?php 
                             $sql = "SELECT type FROM admin WHERE username =:username";
                             $conn->query($sql);
                             $conn->bind(":username", $_SESSION['username']);
                             $user_type = $conn->fetchColumn();

                             if($user_type == 'superadmin'){

                               ?> 
                                 <form action="" class="form-horizontal" method="post" id="add-admin">
                               <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Name<span style="color: #f00;">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" required data-parsley-trigger="keyup" name="name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                     <label for="username" class="col-sm-3 col-form-label">Username<span style="color: #f00;">*</span></label>
                                     <div class="col-sm-9">
                                         <input type="text" class="form-control" id="username" required data-parsley-trigger="keyup" name="username">
                                     </div>
                                 </div>

                                 <div class="form-group row">
                                     <label for="password" class="col-sm-3 col-form-label">Password<span style="color: #f00;">*</span></label>
                                     <div class="col-sm-9">
                                         <input type="password" name="password" class="form-control" required data-parsley-trigger="keyup" id="password">
                                     </div>
                                 </div>

                                 <div class="form-group row">
                                     <label for="user_type" class="col-sm-3 col-form-label">User Type<span style="color: #f00;">*</span></label>
                                     <div class="col-sm-9">
                                         <select name='user_type' class='form-control' required data-parsley-trigger="keyup" id='user_type'>
                                             <option value=''>Select user type</option>
                                             <option value='admin'>Admin</option>
                                                <option value='superadmin'>Super Admin</option>
                                         </select>
                                     </div>
                                 </div>

                                 <div class="form-group row">
                                     <label for="" class="col-sm-3 col-form-label"></label>
                                     <div class="col-sm-9">
                                         <input type="submit" name="add_admin" value="Add system admin" class="btn btn-info" id="submit">
                                     </div>
                                 </div>

                               </div>

                               <div id="success-msg"></div>

                                 </form>
                               
                               <?php
                             
                         
                         ?>

                        </div>

                       

                     </div>
                 </div>


                </div>


                <?php
       $sql = "SELECT * FROM admin WHERE username !=:username ORDER BY id DESC ";
       $conn->query($sql);
       $conn->bind(":username", $_SESSION['username']);

       if($conn->rowCount() > 0){
          $result = $conn->fetchMultiple();
         
          ?> 
           <div class="card">
               <div class="card-header" style="background: #17a2b8; color: white;">
                    <h3 class="card-title" style="font-size: 15px;"> <i class="fa fa-star"></i>Manage System Admins </h3>
               </div>

               <div class="card-body">
                    <div>
                        <table id="systemadmin" class="table table-bordered table -striped">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Name</th>
                                     <th>Username</th>
                                     <th>Type</th>
                                     <th>Action</th>
                                 </tr>
                             </thead>

                             <tbody>
                                 <?php
                                   $i = 1;
                                   if($conn->rowCount()){
                                    foreach ($result as $admin){
                                        $admin_id = $admin->id;
                                        $username = $admin->username;
                                        $name = $admin->name;
                                        $admin_type = $admin->type;

                                        ?> 
                                         <tr>
                                             <td><?php echo $i++; ?></td>
                                             <td><?php echo $name; ?></td>
                                             <td><?php echo $username; ?></td>
                                             <td><?php echo $admin_type; ?></td>
                                             <td>
                                                <a href="javascript:void();" data-toggle='modal' data-target='#delete-systemadmin<?php echo $admin_id;?>'>
                                                    <i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i>
                                                </a>   
                                             </td>
                                             
                                         </tr>
                                        
                                        <?php




                                    }
                                       
                                   }else{
                                        ?> <tr>
                                        <td colspan="5" class="text-center">No Data in table</td>
                                    </tr><?php
                                   }
                                 
                                 ?>
                            



                             </tbody>

                             <tfoot>
                             <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Type</th>
                                <th>Action</th>
                                 </tr>
                             </tfoot>


                        </table>
                    </div>
               </div>
           </div>
          
          
          
          <?php

       }
    
    ?>



   <?php } ?>



            </div><!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'includes/footer.php'; ?>
<!-- Add logo  Modal start -->

<?php 
 foreach($result as $admin){
    $admin_id = $admin->id;
    $username = $admin->username;
    $name = $admin->name;
   
    ?> 
     
       <!-- Delete member Modal start -->
       <div class="modal fade" id="delete-systemadmin<?php echo $admin_id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Delete Admin <?php echo $name; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4>Are you sure you want to do this?
                            <br><small class="text-warning">This action will delete every details of <?php echo $name ?>.</small></h4>
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $admin_id; ?>">
                                <div class="form-group">
                                </div>
                            </div>

                            <div class="modal-footer" style="margin-bottom: -10px;">
                                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                                <input type="submit" class="btn btn-outline-danger" value="Delete Admin" id="submit" name="delete_admin">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- Delete member Modal end -->

    <?php

 }

 //delete the selected admin

 if(isset($_POST['delete_admin'])){
   $id = $_POST['id'];

   $sql = "DELETE FROM admin WHERE id =:id";
   $conn->query($sql);
   $conn->bind(":id", $id);

   try{
     $conn->execute();
     echo "<script>
              toastr['success']('Admin data deleted successfully.');
             </script><meta http-equiv='refresh' content='3; systemadmin'>";

   }catch(PDOException $err){
    $error = $err->getMessage();

    echo "<script>
              toastr['error']('An error occured. $error');
             </script>";
   }


 }

?>
<script>
    $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        }); 
</script>


<script>
    $('#add-admin').parsley();
    $('#add-admin').on('submit', function(event){
        event.preventDefault();
        if($('#add-admin').parsley().isValid()){
            $.ajax({
                url: "<?php echo $base_url; ?>add-system-admin.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#submit').attr('disabled', 'disabled');
                    $('#submit').val('Adding details, pls wait ......');

                },
                success:function (data) {
                    $('#add-admin').parsley().reset();
                    $('#submit').attr('disabled', false);
                    $('#submit').val('Add System admin');
                    $('#success-msg').html(data);
                }
            })
        }

    })
</script>

<script>
        $(function () {
            $("#systemadmin").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "pdf", "print"]
            }).buttons().container().appendTo('#systemadmin_wrapper .col-md-6:eq(0)');
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