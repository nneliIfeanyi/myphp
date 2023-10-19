<?php ob_start(); ?>
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
        <title> Edit Student | <?php echo $school_name; ?></title>

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
        <?php

        $back_to_student = $teacher_url."/student";
        ?>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include('includes/notifications.php');?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->

        <?php include('includes/sidebar.php');?>
        <?php
        if(isset($_GET['student'])){
        $student_username = $_GET['student'];
        $sql = "SELECT * FROM student WHERE username =:username";
        $conn->query($sql);
        $conn->bind(":username", $student_username);
        $result = $conn->fetchSingle();
        $db_username = $result->username;
        if($student_username == $db_username){
        $student_name = $result->name;

        $classid = $result->classesID;
        $sectionid = $result->sectionid;

        //fetch class name
        $sql = "SELECT name FROM classes WHERE id =:id";
        $conn->query($sql);
        $conn->bind(":id", $classid);
        $className = $conn->fetchColumn();

        //fetch student section

        $sql = "SELECT name FROM sections WHERE class =:id AND id =:sectionid";
        $conn->query($sql);
        $conn->bind(":id", $classid);
        $conn->bind(":sectionid", $sectionid);
        $sectionName = $conn->fetchColumn();



        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Editing <?php echo $student_name; ?> </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo $teacher_url; ?>">Home</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo $teacher_url;?>/student">All students</a></li>
                                <li class="breadcrumb-item active"><?php echo $student_name; ?></li>
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
                                    <h3 class="card-title">Editing student's data</h3>
                                </div>
                                <form action="" class="form-horizontal" method="post" id="student-edit">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label"> Name <span style="color: #f00;">*</span></label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="name" required="true" name="name" value="<?php echo $student_name; ?>">
                                            </div>
                                            <label for="dob" class="col-sm-2 col-form-label">date of birth</label>
                                            <div class="col-sm-4">
                                                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $result->dob; ?>">
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label for="db_group" class="col-sm-2 col-form-label">Sex <span style="color: #f00;">*</span></label>
                                            <div class="col-sm-4">
                                                <select name="sex" id="b_group" class="form-control" required="true">
                                                    <option value="<?php echo $result->sex; ?>" selected><?php echo $result->sex; ?></option>
                                                    <option value="male">male</option>
                                                    <option value="female">female</option>
                                                </select>
                                            </div>

                                            <label for="religion" class="col-sm-2 col-form-label">Religion</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="religion" name="religion" value="<?php echo $result->religion; ?>">
                                            </div>

                                        </div>


                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-4">
                                                <input type="email" class="form-control" id="email" name="email" data-parsley-type="email" data-parsley-trigger="keyup" value="<?php echo $result->email; ?>">
                                            </div>

                                            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-4">
                                                <input type="tel" class="form-control" id="phone" name="phone" data-parsley-type='number'
                                                       maxlength="11" data-parsley-length="[11,11]" data-parsley-trigger="keyup" pattern="\d{11}" value="<?php echo $result->phone; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="address" name="address" value="<?php echo $result->address; ?>">
                                            </div>


                                            <label for="state" class="col-sm-2 col-form-label">State</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="state" name="state" value="<?php echo $result->state; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="db_group" class="col-sm-2 col-form-label">Class <span style="color: #f00;">*</span></label>
                                            <div class="col-sm-4">
                                                <select name="class" id="classID" class="form-control" required="true">
                                                    <option value="<?php echo $classid; ?>" selected><?php echo $className; ?></option>
                                                </select>
                                            </div>

                                            <label for="db_group" class="col-sm-2 col-form-label">Section <span style="color: #f00;">*</span></label>
                                            <div class="col-sm-4">
                                                <select name="section" id="section" class="form-control" required="true">
                                                    <option value="<?php echo $sectionid; ?>" selected><?php echo $sectionName; ?> </option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="state" class="col-sm-2 col-form-label">Country</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="country" name="country" value="<?php echo $result->country; ?>" placeholder='Type country name'>
                                            </div>
                                            <label for="reg_no" class="col-sm-2 col-form-label">Reg No.<span style="color: #f00;">*</span></label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="reg_no" required name="reg_no" value="<?php echo $result->registerNO; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="height" class="col-sm-2 col-form-label">Height (m)</label>
                                            <div class="col-sm-4">
                                                <input type="number" class="form-control" id="height" name="height" value="<?php echo $result->height; ?>" placeholder='Height'>
                                            </div>
                                            <label for="weight" class="col-sm-2 col-form-label">Weight (kg)</label>
                                            <div class="col-sm-4">
                                                <input type="number" class="form-control" id="weight" required name="weight" value="<?php echo $result->weight; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="username" class="col-sm-2 col-form-label">Username <span style="color: #f00;">*</span></label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="username" required name="username" value="<?php echo $result->username; ?>" style="cursor: not-allowed;" readonly data-toggle='tooltip' title='Username cannot be changed'>
                                            </div>

                                            <label for="state" class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-4">
                                                <input type="submit" name="update_student" value="Update" class="btn btn-success" id="submit">
                                            </div>


                                        </div>

                                    </div>
                                    <div id="success-msg">
                                    </div>

                                </form>

                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card card-info">
                                <div class="card-header" style="background: #343a40;">
                                    <h3 class="card-title">Profile picture</h3>
                                </div>
                                <div>
                                    <?php
                                    if(empty($result->photo)){
                                        ?> <p style="text-align: center;">
                                        <img src="<?php echo $conn->base_url(); ?>images/default.png" alt="No image set">
                                        </p><?php
                                    }else{
                                        ?> <p style="text-align: center;">
                                        <img src="<?php echo $conn->base_url(); ?>upload/<?php echo $result->photo; ?>" alt="<?php echo $result->photo; ?>" width="60%">
                                        </p><?php
                                    }
                                    ?>
                                </div>
                                <form action="" method="post" enctype="multipart/form-data" id="change-photo">
                                    <div class="form-group row">
                                        <label for="photo" class="col-sm-8 offset-md-2 col-form-label">Change photo</label>
                                        <div class="col-sm-8 offset-md-2">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="photo" name="new_photo">
                                                    <label class="custom-file-label" for="photo">Choose photo</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="username" value="<?php echo $result->username; ?>">
                                    <div class="form-group row">
                                        <label for="image" class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <input type="submit" name="update_photo" value="Update Image" class="btn btn-outline-info" id="submit2">
                                        </div>
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
    header("Location: $back_to_student");
}
    ?>
<?php }else{
    //redirect back to the teacher's page
    header("Location: $back_to_student");
}
?>

<?php include('../admin/includes/footer.php');?>
    <!-- Add logo  Modal start -->

    <script>
        $('[data-toggle ="tooltip"]').tooltip();

        //select 2
        $(function(){
            $('#section').select2();
            $('#classID').select2();
        })
    </script>

    <script>
        $('#student-edit').parsley();
        $('#student-edit').on('submit', function(event){
            event.preventDefault();
            if($('#student-edit').parsley().isValid()){
                $.ajax({
                    url: "<?php echo $conn->main_url(); ?>/teacher/process-edit-student.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#submit').attr('disabled', 'disabled');
                        $('#submit').val('Updating student details, pls wait ......');

                    },
                    success:function (data) {
                        $('#student-edit').parsley().reset();
                        $('#submit').attr('disabled', false);
                        $('#submit').val('Update');
                        $('#success-msg').html(data);
                    }
                })
            }

        })
    </script>

    <script>
        $('#change-photo').parsley();
        $('#change-photo').on('submit', function(event){
            event.preventDefault();
            if($('#change-photo').parsley().isValid()){
                $.ajax({
                    url: "<?php echo $conn->main_url(); ?>/teacher/update_student_photo.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#submit2').attr('disabled', 'disabled');
                        $('#submit2').val('Updating student photo, pls wait ......');

                    },
                    success:function (data) {
                        $('#change-photo').parsley().reset();
                        $('#submit2').attr('disabled', false);
                        $('#submit2').val('Update Image');
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
        $conn = new Functions();
        $base_url = $conn->main_url()."/teacher/";
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