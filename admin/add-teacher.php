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
    <title> Add Teacher | <?php echo $school_name; ?></title>
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
                        <h1 class="m-0">Add Teacher </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Add Teacher</li>
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
                             <h3 class="card-title">Enter teacher's data below</h3>
                         </div>

                         <form action="" class="form-horizontal" method="post" id="teacher-add">
                              <div class="card-body">
                                  <div class="form-group row">
                                      <label for="name" class="col-sm-3 col-form-label">Teachers's name <span style="color: #f00;">*</span></label>
                                      <div class="col-sm-9">
                                          <input type="text" class="form-control" id="name" required data-parsley-trigger="keyup" name="name">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label for="Designation" class="col-sm-3 col-form-label">Designation<span style="color: #f00;">*</span></label>
                                      <div class="col-sm-9">
                                          <input type="text" name="designation" class="form-control" required data-parsley-trigger="keyup">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label for="dob" class="col-sm-3 col-form-label">date of birth<span style="color: #f00;">*</span></label>
                                      <div class="col-sm-9">
                                          <input type="date" class="form-control" id="dob" required name="dob" data-parsley-trigger="keyup">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label for="gender" class="col-sm-3 col-form-label">Gender</label>
                                      <div class="col-sm-9">
                                          <select name="gender" id="gender" class="form-control">
                                              <option value="">Select gender</option>
                                              <option value="male">Male</option>
                                              <option value="female">Female</option>

                                          </select>
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label for="religion" class="col-sm-3 col-form-label">Religion</label>
                                      <div class="col-sm-9">
                                          <input type="text" class="form-control" id="religion" name="religion">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label for="email" class="col-sm-3 col-form-label">Email<span style="color: #f00;">*</span></label>
                                      <div class="col-sm-9">
                                          <input type="email" class="form-control" id="email" required name="email"
                                                 data-parsley-type="email" data-parsley-trigger="keyup">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                                      <div class="col-sm-9">
                                          <input type="tel" class="form-control" id="phone" name="phone" data-parsley-type='number'
                                                 maxlength="11" data-parsley-length="[11, 11]" data-parsley-trigger="keyup" pattern="\d{11}">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label for="address" class="col-sm-3 col-form-label">Address</label>
                                      <div class="col-sm-9">
                                          <input type="text" class="form-control" id="address" name="address">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label for="date" class="col-sm-3 col-form-label">Joining date<span style="color: #f00;">*</span></label>
                                      <div class="col-sm-9">
                                          <input type="date" class="form-control" id="date" name="joining_date" required data-parsley-trigger="keyup">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label for="photo" class="col-sm-3 col-form-label">Photo</label>
                                      <div class="col-sm-9">
                                          <div class="input-group">
                                              <div class="custom-file">
                                                  <input type="file" class="custom-file-input" id="photo" name="photo">
                                                  <label class="custom-file-label" for="photo">Choose photo</label>
                                              </div>
                                          </div>
                                      </div>

                                  </div>

                                  <div class="form-group row">
                                      <label for="username" class="col-sm-3 col-form-label">Username <span style="color: #f00;">*</span></label>
                                      <div class="col-sm-9">
                                          <input type="text" class="form-control" id="username" required name="username">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label for="password" class="col-sm-3 col-form-label">Password <span style="color: #f00;">*</span></label>
                                      <div class="col-sm-9">
                                          <input type="password" class="form-control" id="password" required name="password">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label for="state" class="col-sm-3 col-form-label"></label>
                                      <div class="col-sm-9">
                                          <input type="submit" name="add_teacher" value="Add teacher" class="btn btn-info" id="submit">
                                      </div>
                                  </div>

                              </div>

                             <div id="success-msg">
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

<?php include 'includes/footer.php'; ?>
<!-- Add logo  Modal start -->

<script>
    $('[data-toggle ="tooltip"]').tooltip();
</script>

<script>
    $('#teacher-add').parsley();
    $('#teacher-add').on('submit', function(event){
        event.preventDefault();
        if($('#teacher-add').parsley().isValid()){
            $.ajax({
                url: "process-add-teacher.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#submit').attr('disabled', 'disabled');
                    $('#submit').val('Saving details, pls wait ......');

                },
                success:function (data) {
                    $('#teacher-add').parsley().reset();
                    $('#submit').attr('disabled', false);
                    $('#submit').val('Add Teacher');
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