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
    <title> Set Card Expire Date | <?php echo $school_name; ?></title>
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
                        <h1 class="m-0 text-center"> Set Card Expire Date </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active text-center">Set Card Expire Date </li>
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
                             <h3 class="card-title">Enter or update the card expiration date below</h3>
                         </div>

                         <!-- /.card-header -->
                         <!-- form start -->

                         <div class="card-body">
                             <form class="form-horizontal" method="post" id="grade-add">
                                 <?php
                                 $sql = "SELECT * FROM card_expire_date WHERE expire_date != ''";
                                 $conn->query($sql);
                                 $rowCount = $conn->rowCount();

                                 if($rowCount > 0){
                                     $result = $conn->fetchSingle();
                                     $dbcard_expire_date = $result->expire_date;
                                     ?>
                                     <div class="form-group row">
                                         <label for="name" class="col-sm-3 col-form-label">Expiration Date <span style="color: #f00;">*</span></label>
                                         <div class="col-sm-9">
                                             <input type="date" class="form-control" id="name" required data-parsley-trigger="keyup" name="expire_date" value="<?php echo $dbcard_expire_date; ?>">
                                             <span class="text-info"> Set the expiration date of the card</span>
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
                                         <label for="name" class="col-sm-3 col-form-label">Expiration Date <span style="color: #f00;">*</span></label>
                                         <div class="col-sm-9">
                                             <input type="date" class="form-control" id="name" required data-parsley-trigger="keyup" name="expire_date" value="">
                                             <span class="text-info"> Set the expiration date of the card.</span>
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
        $card_expire = $_POST['expire_date'];

        if(empty($card_expire)){
            echo "<script>
              toastr['error']('Pls enter card expiration date.');
        </script>";
        }else{
            //insert details into database
            $sql = "INSERT INTO card_expire_date(expire_date) VALUES(:card_expire)";
            $conn->query($sql);
            $conn->bind(":card_expire", $card_expire);
            $query = $conn->execute();

            if($query){
                echo "<script>
              toastr['success']('Card Expiration Date Inserted Successfully...');
        </script> <meta http-equiv='refresh' content='3; set-card-expire-date'>";

            }else{
                echo "<script>
              toastr['error']('Error inserting data.');
        </script>";
            }


        }

    }elseif(isset($_POST['update'])){
        $card_expire =$_POST['expire_date'];

        //check if the number of pins is at least greater than 1 and less than 8
        if(empty($card_expire)){
            echo "<script>
              toastr['error']('Pls enter card expiration date.');
        </script>";
        }else{

            //insert details into database
            $sql = "UPDATE card_expire_date SET expire_date = :card_expire";
            $conn->query($sql);
            $conn->bind(":card_expire", $card_expire);
            $query = $conn->execute();
            if($query){
                echo "<script>
              toastr['success']('Card Expiration Date Updated Successfully...');
        </script> <meta http-equiv='refresh' content='3; set-card-expire-date'>";

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