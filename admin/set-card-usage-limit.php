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
    <title> Set Card Usage Limit | <?php echo $school_name; ?></title>
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
                        <h1 class="m-0 text-center"> Set Card Usage Limit </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active text-center">Set Card Usage Limit</li>
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
                 <div class="col-md-8 offset-md-2">
                     <div class="card card-info">
                         <div class="card-header">
                             <h3 class="card-title">Enter or update the number of times below </h3>
                         </div>

                         <!-- /.card-header -->
                         <!-- form start -->

                         <div class="card-body">
                             <form class="form-horizontal" method="post" id="grade-add">
                                 <?php
                                 $sql = "SELECT * FROM card_usage_limit WHERE card_limit > 0";
                                 $conn->query($sql);
                                 $rowCount = $conn->rowCount();

                                 if($rowCount > 0){
                                     $result = $conn->fetchSingle();
                                     $card_usage_limit = $result->card_limit;
                                     ?>
                                     <div class="form-group row">
                                         <label for="name" class="col-sm-3 col-form-label">Number of Times <span style="color: #f00;">*</span></label>
                                         <div class="col-sm-9">
                                             <input type="number" class="form-control" id="name" required data-parsley-trigger="keyup" name="number" value="<?php echo $card_usage_limit; ?>">
                                             <span class="text-info">Set the number of times a card can be used.</span>
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label for="" class="col-sm-3 col-form-label"></label>
                                         <div class="col-sm-9">
                                             <input type="submit" name="update" value="UPDATE" class="btn btn-info" id="submit">
                                         </div>
                                     </div>

                                     <?php
                                 }else{
                                     ?>
                                     <div class="form-group row">
                                         <label for="name" class="col-sm-3 col-form-label">Number of Times <span style="color: #f00;">*</span></label>
                                         <div class="col-sm-9">
                                             <input type="number" class="form-control" id="name" required data-parsley-trigger="keyup" name="number" value="">
                                             <span class="text-info">Set the number of times a card can be used.</span>
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label for="" class="col-sm-3 col-form-label"></label>
                                         <div class="col-sm-9">
                                             <input type="submit" name="insert" value="INSERT" class="btn btn-info" id="submit">
                                         </div>
                                     </div>

                                     <?php
                                 }

                                 ?>




                             </form>
                         </div>
                     </div>


                     <!-- /.card-body -->
                     <!-- /.card-footer -->

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

    <?php

    if(isset($_POST['insert'])){
        $card_usage =$_POST['number'];

        if(empty($card_usage)){
            echo "<script>
              toastr['error']('Pls enter usage limit.');
        </script>";
        }elseif(!$card_usage > 0 || $card_usage > 8 ){
            echo "<script>
              toastr['error']('Number must be between 1 and 8.');
        </script>";
        }else{
            //insert details into database
            $sql = "INSERT INTO card_usage_limit(card_limit) VALUES(:card_usage)";
            $conn->query($sql);
            $conn->bind(":card_usage", $card_usage);
            $query = $conn->execute();

            if($query){
                echo "<script>
              toastr['success']('Limit Inserted Successfully...');
        </script> <meta http-equiv='refresh' content='3; set-card-usage-limit'>";

            }else{
                echo "<script>
              toastr['error']('Error inserting data.');
        </script>";
            }


        }

    }elseif(isset($_POST['update'])){
        $card_usage = $_POST['number'];

        //check if the number of pins is at least greater than 1 and less than 8
        if(empty($card_usage)){
            echo "<script>
              toastr['error']('Pls enter usage limit.');
        </script>";
        }elseif(!$card_usage > 0 || $card_usage > 8 ){
            echo "<script>
              toastr['error']('Number must be between 1 and 8');
        </script>";
        }else{

            //insert details into database
            $sql = "UPDATE card_usage_limit SET card_limit = :card_usage";
            $conn->query($sql);
            $conn->bind(":card_usage", $card_usage);
            $query = $conn->execute();
            if($query){
                echo "<script>
              toastr['success']('Limit Updated Successfully...');
        </script> <meta http-equiv='refresh' content='3; set-card-usage-limit'>";

            }else{
                echo "<script>
              toastr['error']('Error updating data.');
        </script>";
            }

        }

    }


    ?>


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