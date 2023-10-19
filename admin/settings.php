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
                            <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <?php
          $sql = "SELECT * FROM general_settings";
          $conn->query($sql);
          $result = $conn->fetchSingle();
          $name = ucwords($result->school_name);
          $school_tagline = $result->school_tagline;
          $phone_no = $result->phone_no;
          $email = $result->email;
          $address = $result->address;
          $footer = $result->footer;
          $next_term_begins = $result->next_term_begins;
          $no_times_school_opens = $result->no_times_school_open;
          $logo = $result->logo;
          $settings_id = $result->id;
          $admin_login_bg = $result->admin_login_bg;
          $student_login = $result->student_login_bg;
          $teacher_login = $result->teacher_login_bg;
          $reg_no_prefix = $result->reg_no_prefix;
          $main_url = $result->main_url;
          $terminal_report_background_image = $result->terminal_report_bg_image;
          $school_website = $result->school_website;
          $principal_name = $result->principal_name;
          $school_stamp = $result->school_stamp;
          $current_school_session = $result->current_school_session;

        ?>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-10">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Manage School General Settings </h3>
                            </div>

                            <form action="" class="form-horizontal" id="general-settings" method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Name of school
                                           <span data-toggle="tooltip" title="Enter your school name" style="font-size: 11px; position:relative; top: -1px;">
                                               <i class="fa fa-question-circle"></i>
                                           </span>
                                        </label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" required name="name" value="<?php echo $name; ?>" data-parsley-trigger ='keyup'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">School Tagline
                                            <span data-toggle="tooltip" title="Enter your school tagline" style="font-size: 11px; color: #fb5d5f; position:relative; top: -1px;">
                                               <i class="fa fa-question-circle"></i>
                                           </span>
                                        </label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" required name="school_tagline" value="<?php echo $school_tagline; ?>" data-parsley-trigger ='keyup'>
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
                                    <label for="email" class="col-sm-3 col-form-label"> System Email <span data-toggle="tooltip" title="Set Organization email address here" style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"> <i class="fa fa-question-circle"></i></span></label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" name="email"
                                               data-parsley-type='email'
                                               data-parsley-trigger="keyup" value="<?php echo $email; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="url" class="col-sm-3 col-form-label">Main URL <span data-toggle="tooltip" title="Please copy and paste your website URL here(every link will be routed via this URL). Don't add the last forward slash(/) in the url." style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"> <i class="fa fa-question-circle"></i></span></label>
                                    <div class="col-sm-9">
                                        <input type="url" class="form-control" id="url" name="main_url"
                                               data-parsley-type='url'
                                               data-parsley-trigger="keyup" value="<?php echo $main_url; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="reg_no_prefix" class="col-sm-3 col-form-label">Registration no Prefix <span data-toggle="tooltip" title="Please add the prefix(E.g: PCIS) that will show before other data in the Auto generated Registration No" style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"> <i class="fa fa-question-circle"></i></span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="reg_no_prefix" name="reg_no_prefix"
                                               data-parsley-trigger="keyup" value="<?php echo $reg_no_prefix; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-sm-3 col-form-label">Address <span data-toggle="tooltip" title="Set Organization address here" style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"> <i class="fa fa-question-circle"></i></span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" data-parsley-trigger="keyup" required>
                                    </div>
                                </div>

                                    <div class="form-group row">
                                        <label for="website" class="col-sm-3 col-form-label">School Website <span data-toggle="tooltip" title="Set School Official website here (e.g: www.example.com)" style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"> <i class="fa fa-question-circle"></i></span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="website" name="website" value="<?php echo $school_website; ?>" data-parsley-trigger="keyup" data-parsley-type='url' placeholder="E.g: www.example.com">
                                        </div>
                                    </div>

                                <div class="form-group row">
                                    <label for="footer" class="col-sm-3 col-form-label">Footer <span data-toggle="tooltip" title="Set Organization footer text here" style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"> <i class="fa fa-question-circle"></i></span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="footer" name="footer" value="<?php echo $footer; ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="no_times" class="col-sm-3 col-form-label">No of times school open <span data-toggle="tooltip" title="Set the number of times school open" style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"> <i class="fa fa-question-circle"></i></span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="no_of_terms_begin" name="no_times" value="<?php echo $no_times_school_opens; ?>">
                                    </div>
                                </div>

                                    <div class="form-group row">
                                        <label for="principal_name" class="col-sm-3 col-form-label">School Principal Name <span data-toggle="tooltip" title="Enter school principal's name" style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"> <i class="fa fa-question-circle"></i></span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="principal_name" name="principal_name" value="<?php echo $principal_name; ?>">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                    <label for="next_term_begin" class="col-sm-3 col-form-label">Next Term Begins <span data-toggle="tooltip" title="Enter the date school will resume" style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"> <i class="fa fa-question-circle"></i></span></label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="next_term_begin" name="next_term_begins" value="<?php echo $next_term_begins; ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="current_school_session" class="col-sm-3 col-form-label">Current School Section<span data-toggle="tooltip" title="Enter the current school session eg. 2022/2023" style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"> <i class="fa fa-question-circle"></i></span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="current_school_session" name="current_school_session" value="<?php echo $current_school_session; ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="logo" class="col-sm-3 col-form-label">Logo <span data-toggle="tooltip" title="Set Organization logo here" style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"> <i class="fa fa-question-circle"></i></span></label>
                                    <div class="col-sm-9">

                                        <?php
                                        if(empty($logo)){
                                            ?>
                                             <span data-toggle="tooltip" title="upload a new logo">
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

                                <div class="form-group row">
                                    <label for="state" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <input type="submit" name="update_settings" value="Update Settings"
                                               class="btn btn-info" id="submit">
                                    </div>
                                </div>

                                <div id="success-msg"></div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-10">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Manage Login Background Image Settings</h3>
                        </div>
                        <div class="card-body">
                           <div class="form-group row">
                               <label for="admin-bg" class="col-sm-3 col-form-label">Admin Login Background Image
                                  <span data-toggle="tooltip" title="Set Admin Login Background Image"
                                        style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"><i class="fa fa-question-circle"></i></span>
                               </label>

                               <div class="col-sm-9">
                                   <?php
                                     if(empty($admin_login_bg)){
                                         ?>
                                           <span data-toggle="tooltip" title="upload a new admin Bg Image">
                                                <i class="fa fa-upload" data-toggle="modal" data-target="#add-admin-bg"></i>
                                           </span>
                                         <?php
                                     }else{
                                         ?>
                                          <span data-toggle="tooltip" title="Change to a new admin Bg Image">
                                                <i class="fa fa-upload" data-toggle="modal" data-target="#add-admin-bg"></i>
                                           </span>
                                             &nbsp;  &nbsp;
                                          <span data-toggle="tooltip" title="View admin Bg Image">
                                                <i class="fa fa-eye" data-toggle="modal" data-target="#view-admin-bg"></i>
                                           </span>

                                         <?php
                                     }
                                   ?>
                               </div>


                           </div>

                            <div class="form-group row">
                                <label for="admin-bg" class="col-sm-3 col-form-label">Teacher Login Background Image
                                    <span data-toggle="tooltip" title="Set Teacher Login Background Image"
                                          style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"><i class="fa fa-question-circle"></i></span>
                                </label>

                                <div class="col-sm-9">
                                    <?php
                                    if(empty($teacher_login)){
                                        ?>
                                        <span data-toggle="tooltip" title="upload a new teacher Bg Image">
                                                <i class="fa fa-upload" data-toggle="modal" data-target="#add-teacher-bg"></i>
                                           </span>
                                        <?php
                                    }else{
                                        ?>
                                        <span data-toggle="tooltip" title="Change to a new teacher Bg Image">
                                                <i class="fa fa-upload" data-toggle="modal" data-target="#add-teacher-bg"></i>
                                           </span>
                                        &nbsp;  &nbsp;
                                        <span data-toggle="tooltip" title="View teacher Bg Image">
                                                <i class="fa fa-eye" data-toggle="modal" data-target="#view-teacher-bg"></i>
                                           </span>

                                        <?php
                                    }
                                    ?>
                                </div>


                            </div>

                            <div class="form-group row">
                                <label for="admin-bg" class="col-sm-3 col-form-label">Student Login Background Image
                                    <span data-toggle="tooltip" title="Set Student Login Background Image"
                                          style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"><i class="fa fa-question-circle"></i></span>
                                </label>

                                <div class="col-sm-9">
                                    <?php
                                    if(empty($student_login)){
                                        ?>
                                        <span data-toggle="tooltip" title="upload a new student Bg Image">
                                                <i class="fa fa-upload" data-toggle="modal" data-target="#add-student-bg"></i>
                                           </span>
                                        <?php
                                    }else{
                                        ?>
                                        <span data-toggle="tooltip" title="Change to a new student Bg Image">
                                                <i class="fa fa-upload" data-toggle="modal" data-target="#add-student-bg"></i>
                                           </span>
                                        &nbsp;  &nbsp;
                                        <span data-toggle="tooltip" title="View student Bg Image">
                                                <i class="fa fa-eye" data-toggle="modal" data-target="#view-student-bg"></i>
                                           </span>

                                        <?php
                                    }
                                    ?>
                                </div>


                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-lg-10">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Terminal Report Background Image Settings</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="admin-bg" class="col-sm-3 col-form-label">Terminal Report Bg Image
                                    <span data-toggle="tooltip" title="Set terminal Report Background Image"
                                          style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"><i class="fa fa-question-circle"></i></span>
                                </label>

                                <div class="col-sm-9">
                                    <?php
                                    if(empty($terminal_report_background_image)){
                                        ?>
                                        <span data-toggle="tooltip" title="upload a new terminal report Bg Image">
                                                <i class="fa fa-upload" data-toggle="modal" data-target="#add-report-bg"></i>
                                           </span>
                                        <?php
                                    }else{
                                        ?>
                                        <span data-toggle="tooltip" title="Change to a new terminal report Bg Image">
                                                <i class="fa fa-upload" data-toggle="modal" data-target="#add-report-bg"></i>
                                           </span>
                                        &nbsp;  &nbsp;
                                        <span data-toggle="tooltip" title="View terminal report Bg Image">
                                                <i class="fa fa-eye" data-toggle="modal" data-target="#view-report-bg"></i>
                                           </span>

                                        <?php
                                    }
                                    ?>
                                </div>


                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-lg-10">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">School Stamp Background Image Settings</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="admin-bg" class="col-sm-3 col-form-label">School Stamp Image
                                    <span data-toggle="tooltip" title="Set school stamp Background Image"
                                          style="font-size: 11px;color: #5b5d5f; position: relative; top: -1px;"><i class="fa fa-question-circle"></i></span>
                                </label>

                                <div class="col-sm-9">
                                    <?php
                                    if(empty($school_stamp)){
                                        ?>
                                        <span data-toggle="tooltip" title="upload a new school stamp Image">
                                                <i class="fa fa-upload" data-toggle="modal" data-target="#add-stamp"></i>
                                           </span>
                                        <?php
                                    }else{
                                        ?>
                                        <span data-toggle="tooltip" title="Change to a new school stamp Image">
                                                <i class="fa fa-upload" data-toggle="modal" data-target="#add-stamp"></i>
                                           </span>
                                        &nbsp;  &nbsp;
                                        <span data-toggle="tooltip" title="View school stamp Image">
                                                <i class="fa fa-eye" data-toggle="modal" data-target="#view-stamp"></i>
                                           </span>

                                        <?php
                                    }
                                    ?>
                                </div>


                            </div>

                        </div>

                    </div>
                </div>

                </div><!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include 'includes/footer.php'; ?>
<!-- Add logo  Modal sart -->
<div class="modal fade" id="add-logo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a new logo</h5>
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

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="submit" name="add_logo" value="Add Logo" class="btn btn-outline-info" id="submit2">
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
                <h5 class="modal-title" id="exampleModalLabel">Viewing your existing logo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <p style="text-align: center;"><img src="<?php echo $conn->base_url()?>/upload/<?php echo $logo; ?>" alt="" width='50%'></p>

                </div>

                <div class="modal-footer" style="margin-bottom: -10px;">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- view logo Modal end -->

<!-- Add Admin Login Background Image  Modal start -->
<div class="modal fade" id="add-admin-bg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a new admin Background Image </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data" id="upload-adminlogin-bg">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="photo" name="new_photo" required>
                                    <label class="custom-file-label" for="photo">Choose photo</label>
                                </div>
                            </div>
                            <p class="text-info">Please use a high resolution image of at least 2000px(width) by 1500px(height) or more.</p>
                        </div>
                    </div>
                    <input type="hidden" name="settings_id" value="<?php echo $settings_id; ?>">

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="submit" name="add_logo" value="Add Login Background Image" class="btn btn-outline-info" id="submit3">
                        </div>
                    </div>

                    <div class="modal-footer" style="margin-bottom: -10px;">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Add Admin Login Background Image Modal end -->

<!-- View Admin Login Background Image  Modal start -->
<div class="modal fade" id="view-admin-bg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Viewing your Admin Login Background Image </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <p style="text-align: center;"><img src="<?php echo $conn->base_url()?>/upload/<?php echo $admin_login_bg; ?>" alt="" width='100%'></p>

                </div>

                <div class="modal-footer" style="margin-bottom: -10px;">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- View Admin Login Background Image  Modal end -->

<!-- Add Teacher Login Background Image  Modal start -->
    <div class="modal fade" id="add-teacher-bg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a new teacher Background Image </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" id="upload-teacherlogin-bg">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="photo" name="new_photo" required>
                                        <label class="custom-file-label" for="photo">Choose photo</label>
                                    </div>
                                </div>
                                <p class="text-info">Please use a high resolution image of at least 2000px(width) by 1500px(height) or more.</p>
                            </div>
                        </div>
                        <input type="hidden" name="settings_id" value="<?php echo $settings_id; ?>">

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="submit" name="add_logo" value="Add Teacher Login Background Image" class="btn btn-outline-info" id="submit4">
                            </div>
                        </div>

                        <div class="modal-footer" style="margin-bottom: -10px;">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Add Teacher Login Background Image Modal end -->

    <!-- View Teacher Login Background Image  Modal start -->
    <div class="modal fade" id="view-teacher-bg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Viewing Teacher Login Background Image </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <p style="text-align: center;"><img src="<?php echo $conn->base_url()?>/upload/<?php echo $teacher_login; ?>" alt="" width='100%'></p>

                    </div>

                    <div class="modal-footer" style="margin-bottom: -10px;">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- View Teacher Login Background Image  Modal end -->

    <!-- Add Student Login Background Image  Modal start -->
    <div class="modal fade" id="add-student-bg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a new student Background Image </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" id="upload-studentlogin-bg">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="photo" name="new_photo" required>
                                        <label class="custom-file-label" for="photo">Choose photo</label>
                                    </div>
                                </div>
                                <p class="text-info">Please use a high resolution image of at least 2000px(width) by 1500px(height) or more.</p>
                            </div>
                        </div>
                        <input type="hidden" name="settings_id" value="<?php echo $settings_id; ?>">

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="submit" name="add_logo" value="Add Student Login Background Image" class="btn btn-outline-info" id="submit5">
                            </div>
                        </div>

                        <div class="modal-footer" style="margin-bottom: -10px;">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Add Student Login Background Image Modal end -->

    <!-- View Student Login Background Image  Modal start -->
    <div class="modal fade" id="view-student-bg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Viewing Student Login Background Image </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <p style="text-align: center;"><img src="<?php echo $conn->base_url()?>/upload/<?php echo $student_login; ?>" alt="" width='100%'></p>

                    </div>

                    <div class="modal-footer" style="margin-bottom: -10px;">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- View Student Login Background Image  Modal end -->

    <!-- Add Terminal Report Background Image  Modal start -->
    <div class="modal fade" id="add-report-bg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a new terminal report Background Image </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" id="upload-report-bg">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="photo" name="new_photo" required>
                                        <label class="custom-file-label" for="photo">Choose photo</label>
                                    </div>
                                </div>
                                <p class="text-info">Please upload a square image of at least 500px(width) by 500px(height) or more. Image should be a bit faint. You can use a larger version of the school logo.</p>
                            </div>
                        </div>
                        <input type="hidden" name="settings_id" value="<?php echo $settings_id; ?>">

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="submit" name="add_logo" value="Add Terminal Report Background Image" class="btn btn-outline-info" id="submit6">
                            </div>
                        </div>

                        <div class="modal-footer" style="margin-bottom: -10px;">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Add Terminal Report  Background Image Modal end -->

    <!-- View terminal report Background Image  Modal start -->
    <div class="modal fade" id="view-report-bg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Viewing Terminal Report Background Image </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <p style="text-align: center;"><img src="<?php echo $conn->base_url()?>/upload/<?php echo $terminal_report_background_image; ?>" alt="" width='100%'></p>

                    </div>

                    <div class="modal-footer" style="margin-bottom: -10px;">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- View terminal report Background Image  Modal end -->

    <!-- Add school stamp Image  Modal start -->
    <div class="modal fade" id="add-stamp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a new school stamp Image </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" id="upload-stamp">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="photo" name="new_photo" required>
                                        <label class="custom-file-label" for="photo">Choose photo</label>
                                    </div>
                                </div>
                                <p class="text-info">Please upload a square image of at least 500px(width) by 500px(height) or more.</p>
                            </div>
                        </div>
                        <input type="hidden" name="settings_id" value="<?php echo $settings_id; ?>">

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="submit" name="add_stamp" value="Add School Stamp Image" class="btn btn-outline-info" id="submit7">
                            </div>
                        </div>

                        <div class="modal-footer" style="margin-bottom: -10px;">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Add school stamp Image Modal end -->

    <!-- view school stamp Image  Modal start  -->
    <div class="modal fade" id="view-stamp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Viewing School Stamp Image </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <p style="text-align: center;"><img src="<?php echo $conn->base_url()?>/upload/<?php echo $school_stamp; ?>" alt="" width='100%'></p>

                    </div>

                    <div class="modal-footer" style="margin-bottom: -10px;">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- view school stamp Image  Modal end -->



<script>
     $('[data-toggle ="tooltip"]').tooltip();
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

<script>
    $('#upload-adminlogin-bg').parsley();
    $('#upload-adminlogin-bg').on('submit', function(event){
        event.preventDefault();
        if($('#upload-adminlogin-bg').parsley().isValid()){
            $.ajax({
                url: "add-admin-login-bg.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#submit3').attr('disabled', 'disabled');
                    $('#submit3').val('Saving details, pls wait ......');

                },
                success:function (data) {
                    $('#upload-adminlogin-bg').parsley().reset();
                    $('#submit3').attr('disabled', false);
                    $('#submit3').val('Add Admin Login Bg Image');
                    $('#success-msg').html(data);
                }
            })
        }

    })
</script>

    <script>
        $('#upload-teacherlogin-bg').parsley();
        $('#upload-teacherlogin-bg').on('submit', function(event){
            event.preventDefault();
            if($('#upload-teacherlogin-bg').parsley().isValid()){
                $.ajax({
                    url: "add-teacher-login-bg.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#submit4').attr('disabled', 'disabled');
                        $('#submit4').val('Saving details, pls wait ......');

                    },
                    success:function (data) {
                        $('#upload-teacherlogin-bg').parsley().reset();
                        $('#submit4').attr('disabled', false);
                        $('#submit4').val('Add Teacher Login Background Image');
                        $('#success-msg').html(data);
                    }
                })
            }

        })
    </script>

    <script>
        $('#upload-studentlogin-bg').parsley();
        $('#upload-studentlogin-bg').on('submit', function(event){
            event.preventDefault();
            if($('#upload-studentlogin-bg').parsley().isValid()){
                $.ajax({
                    url: "add-student-login-bg.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#submit5').attr('disabled', 'disabled');
                        $('#submit5').val('Saving details, pls wait ......');

                    },
                    success:function (data) {
                        $('#upload-studentlogin-bg').parsley().reset();
                        $('#submit4').attr('disabled', false);
                        $('#submit4').val('Add Student Login Background Image');
                        $('#success-msg').html(data);
                    }
                })
            }

        })
    </script>

    <script>
        $('#upload-report-bg').parsley();
        $('#upload-report-bg').on('submit', function(event){
            event.preventDefault();
            if($('#upload-report-bg').parsley().isValid()){
                $.ajax({
                    url: "add-terminal-report-bg.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#submit6').attr('disabled', 'disabled');
                        $('#submit6').val('Saving details, pls wait ......');

                    },
                    success:function (data) {
                        $('#upload-report-bg').parsley().reset();
                        $('#submit6').attr('disabled', false);
                        $('#submit6').val('Add terminal report Background Image');
                        $('#success-msg').html(data);
                    }
                })
            }

        })
    </script>

    <script>
        $('#upload-stamp').parsley();
        $('#upload-stamp').on('submit', function(event){
            event.preventDefault();
            if($('#upload-stamp').parsley().isValid()){
                $.ajax({
                    url: "upload-stamp-image.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#submit7').attr('disabled', 'disabled');
                        $('#submit7').val('Saving details, pls wait ......');

                    },
                    success:function (data) {
                        $('#upload-stamp').parsley().reset();
                        $('#submit7').attr('disabled', false);
                        $('#submit7').val('Upload School Stamp Image');
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