<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <?php include '../admin/includes/styles.php'; ?>
    <?php
      $conn = new Functions();
      $redirect = $teacher_url."/login";
    ?>
    <title> Logout |  <?php echo $school_name; ?> </title>
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>
<body>
<div class="container" style="margin-top: 20%;">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="section-title text-center">
                <?php session_destroy();?>
                <h6> Logout Successful </h6>
                <div class="spinner-border text-info" role="status">
                    <span class="sr-only">Loading...</span>
                    <meta http-equiv="refresh" content="3; <?php echo $redirect; ?>">
                </div>
                <p>Redirecting to the login  page...</p>
            </div>
        </div>
    </div>
</div>