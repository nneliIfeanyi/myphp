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
    <title> Generate Pins | <?php echo $school_name; ?></title>
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
                        <h1 class="m-0 text-center"> Generate Pins </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active text-center">Generate Pins </li>
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
                             <h3 class="card-title">Enter the number of pins to generate below </h3>
                         </div>

                         <!-- /.card-header -->
                         <!-- form start -->

                         <div class="card-body">
                             <form class="form-horizontal" method="post" id="grade-add">
                                 <div class="form-group row">
                                     <label for="name" class="col-sm-3 col-form-label">Number of Pins <span style="color: #f00;">*</span></label>
                                     <div class="col-sm-9">
                                         <input type="number" class="form-control" id="name" required data-parsley-trigger="keyup" name="number" value="">
                                         <span class="text-info">Maximum number you can generate at a go is 100.</span>
                                     </div>
                                 </div>
                                 <div class="form-group row">
                                     <label for="" class="col-sm-3 col-form-label"></label>
                                     <div class="col-sm-9">
                                         <input type="submit" name="generate_pins" value="GENERATE PIN" class="btn btn-info" id="submit">
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>


                     <!-- /.card-body -->
                     <!-- /.card-footer -->

                     </div>

                    <!--    DISPLAY GENERATED PINS TABLE-->

                    <div class="col-md-8 offset-md-2">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">View Generated Pins and Status</h3>
                            </div>
                            <div class="card-body">
                                <?php
                                $i = 1;
                                $sql = "SELECT * FROM generated_pins ORDER BY id DESC";
                                $conn->query($sql);
                                $result = $conn->fetchMultiple();

                                ?>

                                <table id="teacher" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pin No</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                    if($conn->rowCount() > 0){
                                        foreach ($result as $pins ){
                                            $id = $pins->id;
                                            $pin = $pins->pin;
                                            $status = $pins->status;

                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $pin; ?></td>
                                                <td>
                                                    <?php
                                                    if($status == 'open'){
                                                        ?>
                                                        <span class="btn btn-success"><?php  echo $status; ?></span>
                                                        <?php
                                                    }elseif($status == ''){
                                                        ?>
                                                        <span class="btn btn-success"><?php  echo 'open'; ?></span>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <span class="btn btn-danger"><?php  echo $status; ?></span>
                                                        <?php
                                                    }

                                                    ?>
                                                </td>
                                            </tr>

                                            <?php

                                        }
                                    }else{
                                        ?> <tr>
                                            <td colspan="3" class="text-center">No Data in table</td>
                                        </tr><?php
                                    }

                                    ?>

                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Pin No</th>
                                        <th>Status</th>
                                    </tr>
                                    </tfoot>


                                </table>
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
<!-- Add logo  Modal start -->

    <script>
        $(function () {
            $("#teacher").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "pdf", "print"]
            }).buttons().container().appendTo('#teacher_wrapper .col-md-6:eq(0)');
        });
    </script>

    <?php

    if(isset($_POST['generate_pins'])){
        $no_of_pins = $_POST['number'];
        if(empty($no_of_pins)){
            echo "<script>
              toastr['error']('Pls enter a valid number for the no of pins to generate.');
        </script>";
        }elseif(!$no_of_pins > 0 || $no_of_pins > 100){
            echo "<script>
              toastr['error']('Number must be between 1 and 100.');
        </script>";
        }else{
            //generate pins
            $i = 1;
            $success_msg = '';
            while($i <= $no_of_pins){
                $generate_pins = 'CP'.rand(10000,99999).rand(90000,99999).'M';
                $date_generated = date("Y-m-d h:ia");
                //insert the generated pin into database
                $sql = "INSERT INTO generated_pins(pin, date_generated) 
                    VALUES(:generate_pins, :date_generated)";
                $conn->query($sql);
                $conn->bind(":generate_pins", $generate_pins);
                $conn->bind(":date_generated", $date_generated);
                $query = $conn->execute();
                if($query){
                    $success_msg =  "<script>
              toastr['success']('Pin Generated Successfully...');
                </script> <meta http-equiv='refresh' content='3; generate-pins'>";

                }else{
                    echo "<script>
              toastr['error']('Error generating pin.');
        </script>";
                }
                $i++;

            }

            echo $success_msg;



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