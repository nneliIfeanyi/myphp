<?php
// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
// error_reporting(E_ALL);
session_start();
if(isset($_SESSION['student'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include('../admin/includes/styles.php');?>
    <title> Check Result | <?php echo $school_name; ?></title>

    <?php
    $dt1 = new DateTime();
    $current_date = $dt1->format('Y-m-d');
    $sql = "SELECT * FROM card_expire_date WHERE expire_date != ''";
    $conn->query($sql);
    $result_set = $conn->fetchSingle();
    $card_expire_date= $result_set->expire_date;

    //fetch the card usage limit
    $sql = "SELECT * FROM card_usage_limit";
    $conn->query($sql);
    $result_set = $conn->fetchSingle();
    $card_limit = $result_set->card_limit;

    $username = $_SESSION['student'];
    //select user's information from the database
    $sql = "SELECT * FROM student WHERE username = :username";
    $conn->query($sql);
    $conn->bind(":username", $username);
    $query = $conn->rowCount();
    if ($query) {
        $result = $conn->fetchSingle();
        $name = $result->name;
        $exam_pin = $result->exam_pin;
        $card_usage = 1;
    }

    //fetch student's card usage status

    $sql = "SELECT * FROM pins WHERE used_by = :name AND card_availability =:open";
    $conn->query($sql);
    $conn->bind(":name", $name);
    $conn->bind(":open", 'open');
    $result_set = $conn->fetchSingle();
    $user_card_usage = $result_set->card_usage;
    $user_card_availability = $result_set->card_availability;
    $current_card = $result_set->pin_code;



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
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Check Result </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $conn->student_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Check Result </li>
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
                                <h3 class="card-title">Complete the form below to check result </h3>
                            </div>

                            <form action="" class="form-horizontal" method="post" id="result-check">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="card_serial" class="col-sm-3 col-form-label">Card Pin no<span style="color: #f00;">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="card_serial" required data-parsley-trigger="keyup" name="card_serial" placeholder="Scratch card to reveal pin">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="pin" class="col-sm-3 col-form-label">Generated Pin <span style="color: #f00;">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="number" name="pin" class="form-control" required data-parsley-trigger="keyup" id="pin" placeholder="Please look below for generated pin">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="exam_year" class="col-sm-3 col-form-label">Examination Year <span style="color: #f00;">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="examyear" id="exam_year" class="form-control select2" required>
                                                <option value="">Select year</option>
                                                <?php
                                                $sql = "SELECT DISTINCT school_year  FROM results";
                                                $conn->query($sql);
                                                $result = $conn->fetchMultiple();
                                                foreach ($result as $year){
                                                    $school_year = $year->school_year;
                                                    ?>
                                                    <option value="<?php echo $school_year; ?>"><?php echo $school_year; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="exam_term" class="col-sm-3 col-form-label">Exam<span style="color: #f00;">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="examterm" id="exam_term" class="form-control select2" required>
                                                <option value="">Select Exam</option>
                                                <?php
                                                //fetch all teachers information
                                                $sql = "SELECT * FROM exams";
                                                $conn->query($sql);
                                                $rowcount = $conn->rowCount();

                                                if($rowcount > 0){
                                                    $result = $conn->fetchMultiple();
                                                    foreach ($result as $exam) {
                                                        ?>  <option value="<?php echo $exam->name; ?>"><?php echo $exam->name; ?></option><?php
                                                    }
                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <input type="hidden" name="username" value="<?php echo $username; ?>">
                                    <input type="hidden" name="student_name" value="<?php echo $name; ?>">
                                    <input type="hidden" name="current_date" value="<?php echo $current_date; ?>">
                                    <input type="hidden" name="expire_date" value="<?php echo $card_expire_date; ?>">
                                    <input type="hidden" name="user_card_usage" value="<?php echo $user_card_usage; ?>">
                                    <input type="hidden" name="user_card_availability" value="<?php echo $user_card_availability; ?>">
                                    <input type="hidden" name="card_limit" value="<?php echo $card_limit; ?>">


                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <input type="submit" name="check_result" value="Check Result" class="btn btn-info" id="submit">
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <p style="text-align: left; margin-top: 10px;">Your generated pin no is:  <span style="color: mediumvioletred; font-weight: bold;"><?php echo $exam_pin; ?></span></p>
                                        </div>
                                    </div>

                                </div>

                                <div id="success-msg"></div>

                            </form>

                        </div>

                        <div class="callout callout-danger" style="margin-top: 30px;">
                            <p>Note: You need to have an active card to check result. </p>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card card-info">
                            <div class="card-header" style="background: #17a2b8;">
                                <h3 class="card-title">Card Usage Status</h3>
                            </div>

                            <div class="card-body">
                                <?php
                                  if($user_card_usage){
                                     //fetch admin card limit set
                                      ?>
                                       <p style="text-align: left;">
                                           Your Card Usage Status: <span style="color: mediumvioletred; font-weight: bold;">
                                              <?php echo $user_card_usage; ?> / <?php echo $card_limit; ?>
                                           </span>
                                       </p>
                                      <?php
                                  }

                                //fetch card expiration date status
                                ?>
                                <p style="text-align: left;">Your Cards Expiration Date:  <span style="color: mediumvioletred; font-weight: bold;"><?php echo $card_expire_date; ?></span>
                                </p>

                                <?php

                                ?>

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

<?php include '../admin/includes/footer.php'; ?>
<!-- Add logo  Modal start -->

<script>
    $(document).ready(function(){
        $('.select2').select2();
    })

</script>

<script>
    $('#result-check').parsley();
    $('#result-check').on('submit', function(event){
        event.preventDefault();
        if($('#result-check').parsley().isValid()){
            $.ajax({
                url: "<?php echo $conn->student_url(); ?>process-check-result.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#submit').attr('disabled', 'disabled');
                    $('#submit').val('Checking Result Details, pls wait ......');

                },
                success:function (data) {
                    $('#result-check').parsley().reset();
                    $('#submit').attr('disabled', false);
                    $('#submit').val('Submit');
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

    <?php include '../admin/includes/styles.php'; ?>

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
                    <meta http-equiv='refresh' content='3; <?php echo $student_login_link; ?>'>
                </div>
                <p>Redirecting to the login  page...</p>
            </div>
        </div>
    </div>
</div>

<?php

}

?>
