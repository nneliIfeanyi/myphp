<?php
session_start();
if(isset($_SESSION['teacher'])){

    $username = $_SESSION['teacher'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include('../admin/includes/styles.php');?>
    <title> Settings | <?php echo $school_name; ?></title>
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
                        <h1 class="m-0">General Settings </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $teacher_url; ?>">Home</a></li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <?php
          $sql = "SELECT * FROM teachers WHERE username =:username";
          $conn->query($sql);
          $conn->bind(":username", $username);
          $result = $conn->fetchSingle();
          $name = $result->name;
          $designation = $result->designation;
          $phone_no = $result->phone;
          $email = $result->email;
          $dob = $result->dob;
          $gender = $result->gender;
          $religion = $result->religion;
          $address = $result->address;
          $username = $result->username;
          $photo = $result->photo;
          $settings_id = $result->id;

        ?>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-10">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Update Information </h3>
                            </div>

                            <form action="" class="form-horizontal" id="general-settings" method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Name of teacher
                                           <span data-toggle="tooltip" title="Your Name" style="font-size: 11px; position:relative; top: -1px;">
                                               <i class="fa fa-question-circle"></i>
                                           </span>
                                        </label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" required name="name" value="<?php echo $name; ?>" data-parsley-trigger ='keyup'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="designation" class="col-sm-3 col-form-label"> Designation <span data-toggle="tooltip" title="Your Designation." style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"> <i class="fa fa-question-circle"></i></span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="designation" required
                                                    name="designation" value="<?php echo $designation; ?>" data-parsley-trigger="keyup">
                                        </div>
                                    </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-sm-3 col-form-label">Phone No <span data-toggle="tooltip" title="Enter the primary phone no of your school" style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"> <i class="fa fa-question-circle"></i></span></label>
                                    <div class="col-sm-9">
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                               data-parsley-type='number'
                                               maxlength="11" data-parsley-length="[11,11]"
                                               data-parsley-trigger="keyup" pattern="\d{11}" value="<?php echo $phone_no; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email Address <span data-toggle="tooltip" title="Your email address" style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"> <i class="fa fa-question-circle"></i></span></label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" name="email"
                                               data-parsley-type='email'
                                               data-parsley-trigger="keyup" value="<?php echo $email; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="gender" class="col-sm-3 col-form-label">Gender <span data-toggle="tooltip" title="Enter your gender E.G (Male or Female)" style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"> <i class="fa fa-question-circle"></i></span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="gender" name="gender"
                                               data-parsley-trigger="keyup" value="<?php echo $gender; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-sm-3 col-form-label">Address <span data-toggle="tooltip" title="Enter your address" style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"> <i class="fa fa-question-circle"></i></span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="address" name="address"
                                               data-parsley-trigger="keyup" value="<?php echo $address; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="religion" class="col-sm-3 col-form-label">Religion<span data-toggle="tooltip" title="Set your religion" style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"> <i class="fa fa-question-circle"></i></span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="religion" name="religion" value="<?php echo $religion; ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 col-form-label">Username <span data-toggle="tooltip" title="Your Username (Note: Username cannot be changed)" style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"> <i class="fa fa-question-circle"></i></span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" readonly disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="dob" class="col-sm-3 col-form-label">Date of birth <span data-toggle="tooltip" title="Your date of birth" style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"> <i class="fa fa-question-circle"></i></span></label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $dob; ?>">
                                    </div>
                               </div>

                                <div class="form-group row">
                                    <label for="photo" class="col-sm-3 col-form-label">Photo <span data-toggle="tooltip" title="upload a new photo" style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"> <i class="fa fa-question-circle"></i></span></label>
                                    <div class="col-sm-9">

                                        <?php
                                        if(empty($photo)){
                                            ?>
                                             <span data-toggle="tooltip" title="upload a new photo">
                                                         <i class="fa fa-upload" data-toggle="modal" data-target="#add-logo"></i>
                                                </span>

                                            <?php
                                        }else{
                                            ?>
                                             <span data-toggle="tooltip" title="change to a new logo">
                                                         <i class="fa fa-upload" data-toggle="modal" data-target="#add-logo"></i>
                                                         </span>
                                               &nbsp; &nbsp;
                                            <span data-toggle="tooltip" title="View Logo">
                                                <i class="fa fa-eye" data-toggle="modal" data-target="#view-logo"></i>
                                               </span>
                                            <?php
                                        }
                                        ?>

                                    </div>

                                </div>
                                <input type="hidden" name="settings_id" value="<?php echo $settings_id; ?>">
                                <input type="hidden" name="username" value="<?php echo $username; ?>">

                                <div class="form-group row">
                                    <label for="state" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <input type="submit" name="update_profile" value="Update Profile"
                                               class="btn btn-info" id="submit">
                                    </div>
                                </div>

                                <div id="success-msg"></div>

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

    <?php include '../admin/includes/footer.php'; ?>
<!-- Add logo  Modal sart -->
<div class="modal fade" id="add-logo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a new photo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data" id="upload-logo">

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="photo" name="new_photo" required>
                                    <label class="custom-file-label" for="photo">Choose photo</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="settings_id" value="<?php echo $settings_id; ?>">
                    <input type="hidden" name="username" value="<?php echo $username; ?>">

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="submit" name="add_logo" value="Add Photo" class="btn btn-outline-info" id="submit2">
                        </div>
                    </div>

                    <div class="modal-footer" style="margin-bottom: -10px;">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Add logo end -->

<!-- View logo  Modal start -->
<div class="modal fade" id="view-logo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Viewing your existing photo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <p style="text-align: center;"><img src="<?php echo $conn->base_url()?>/upload/<?php echo $photo; ?>" alt="" width='50%'></p>

                </div>

                <div class="modal-footer" style="margin-bottom: -10px;">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- view logo Modal end -->



<script>
     $('[data-toggle = "tooltip"]').tooltip();
</script>

<script>
    $('#upload-logo').parsley();
    $('#upload-logo').on('submit', function(event){
        event.preventDefault();
        if($('#upload-logo').parsley().isValid()){
            $.ajax({
                url: "add-site-logo.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#submit2').attr('disabled', 'disabled');
                    $('#submit2').val('Saving details, pls wait ......');

                },
                success:function (data) {
                    $('#upload-logo').parsley().reset();
                    $('#submit2').attr('disabled', false);
                    $('#submit2').val('Update Settings');
                    $('#success-msg').html(data);
                }
            })
        }

    })
</script>

<script>
    $('#general-settings').parsley();
    $('#general-settings').on('submit', function(event){
        event.preventDefault();
        if($('#general-settings').parsley().isValid()){
             $.ajax({
                 url: "update-general-settings.php",
                 method: "POST",
                 data: new FormData(this),
                 contentType: false,
                 processData: false,
                 beforeSend: function () {
                     $('#submit').attr('disabled', 'disabled');
                     $('#submit').val('Updating details, pls wait ......');

                 },
                 success:function (data) {
                     $('#general-settings').parsley().reset();
                     $('#submit').attr('disabled', false);
                     $('#submit').val('Update Settings');
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