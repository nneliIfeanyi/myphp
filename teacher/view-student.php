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
        <title> view Student | <?php echo $school_name; ?></title>

        <?php
          $back_to_student = $teacher_url."/student";
        ?>
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

        //get class name
        $sql = "SELECT name FROM classes WHERE id =:id";
        $conn->query($sql);
        $conn->bind(":id", $classid);
        $className = $conn->fetchColumn();

        //fetch section name
        $sql = "SELECT name FROM sections WHERE id =:sectionid AND class =:classid";
        $conn->query($sql);
        $conn->bind(":sectionid", $sectionid);
        $conn->bind(":classid", $classid);
        $sectionName = $conn->fetchColumn();



        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Viewing <?php echo $student_name; ?> </h1>
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
                        <div class="col-lg-12">
                            <div class="card card-info card-tabs">
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                        <li class="nav-item">
                                            <a href="#details" class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false">
                                                Student Details
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="#profile" class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">
                                                Profile Picture
                                            </a>
                                        </li>
                                    </ul>

                                </div>

                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        <div class="tab-pane fade active show" id="details" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                            <!--                                    student form-->
                                            <form action="" class="form-horizontal" id="" method="post">
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="name" class="col-sm-2 col-form-label"> Name <span
                                                                style="color: #f00;">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" id="name" required="true" name="name"
                                                                   value="<?php echo $student_name; ?>">
                                                        </div>

                                                        <label for="dob" class="col-sm-2 col-form-label">date of birth</label>
                                                        <div class="col-sm-4">
                                                            <input type="date" class="form-control" id="dob" name="dob"
                                                                   value="<?php echo $result->dob; ?>">
                                                        </div>

                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="db_group" class="col-sm-2 col-form-label">Sex <span style="color: #f00;">*</span></label>
                                                        <div class="col-sm-4">
                                                            <select name="sex" id="b_group" class="form-control" required="true">
                                                                <option value="<?php echo $result->sex; ?>"
                                                                        selected><?php echo $result->sex; ?></option>
                                                            </select>
                                                        </div>
                                                        <label for="religion" class="col-sm-2 col-form-label">Religion</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" id="religion" name="religion"
                                                                   value="<?php echo $result->religion; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                                        <div class="col-sm-4">
                                                            <input type="email" class="form-control" id="email" name="email" data-parsley-type="email"
                                                                   data-parsley-trigger="keyup" value="<?php echo $result->email; ?>">
                                                        </div>

                                                        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                                        <div class="col-sm-4">
                                                            <input type="tel" class="form-control" id="phone" name="phone" data-parsley-type='number'
                                                                   maxlength="11" data-parsley-length="[11,11]" data-parsley-trigger="keyup"
                                                                   pattern="\d{11}" value="<?php echo $result->phone; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" id="address" name="address"
                                                                   value="<?php echo $result->address; ?>">
                                                        </div>

                                                        <label for="state" class="col-sm-2 col-form-label">State</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" id="state" name="state"
                                                                   value="<?php echo $result->state; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="db_group" class="col-sm-2 col-form-label">Class <span
                                                                style="color: #f00;">*</span></label>
                                                        <div class="col-sm-4">
                                                            <select name="class" id="classID" class="form-control" required="true">
                                                                <option value="<?php echo $classid; ?>" selected><?php echo $className; ?></option>
                                                            </select>
                                                        </div>

                                                        <label for="db_group" class="col-sm-2 col-form-label">Section <span
                                                                style="color: #f00;">*</span></label>
                                                        <div class="col-sm-4">
                                                            <select name="section" id="section" class="form-control" required="true">
                                                                <option value="<?php echo $sectionid; ?>"
                                                                        selected><?php echo $sectionName; ?> </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="state" class="col-sm-2 col-form-label">Country</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" id="country" name="country"
                                                                   value="<?php echo $result->country; ?>">
                                                        </div>

                                                        <label for="reg_no" class="col-sm-2 col-form-label">Registration No<span style="color: #f00;">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" id="reg_no" required name="reg_no"
                                                                   value="<?php echo $result->registerNO; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="username" class="col-sm-2 col-form-label">Username <span
                                                                style="color: #f00;">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" id="username" required name="username"
                                                                   value="<?php echo $result->username; ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>

                                        </div>

                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                            <div>
                                                <?php
                                                if(empty($result->photo)){
                                                    ?> <p style="text-align: left;">
                                                    <img src="<?php echo $conn->base_url(); ?>images/default.png" alt="No images set">
                                                    </p><?php
                                                }else{
                                                    ?>  <p style="text-align: left;"><img
                                                        src="<?php echo $conn->base_url(); ?>upload/<?php echo $result->photo; ?>"
                                                        alt="<?php $result->photo; ?>" width='300' height='300' style='border-radius: 50%;'>
                                                    </p><?php
                                                }

                                                ?>

                                            </div>



                                        </div>

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

<?php include '../admin/includes/footer.php'; ?>
    <!-- Add logo  Modal start -->

    <script>
        $('[data-toggle ="tooltip"]').tooltip();
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