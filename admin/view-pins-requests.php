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
        <title> View Students Pins Requests | <?php echo $school_name; ?></title>
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
                        <h1 class="m-0">View Pins Requests</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">View Pins Requests</li>
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

                    <section class="col-lg-12 connectedSortable">
                        <?php
                        $sql = "SELECT * FROM pins ORDER BY id DESC";
                        $conn->query($sql);
                        $result = $conn->fetchMultiple();
                        ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> Manage Pins Requests <i class="fa fa-info-circle" data-toggle="tooltip" title="If a user misplaces his/her card(pin) and is requesting for a new card(pin), you have to close every existing(open) pins of user before issuing a new one." style="cursor:pointer;"></i></h3>
                            </div>
                            <div class="card-body">
                                <table id="pins" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>pin</th>
                                        <th>Date Issued</th>
                                        <th>Expiry Date</th>
                                        <th>Card Usage</th>
                                        <th>Card Availability</th>
                                        <th>Used By</th>
                                        <th>Action</th
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    if($conn->rowCount() > 0){
                                        foreach ($result as $pins):
                                            $pin = $pins->pin_code;
                                            $date_issued= $pins->date_issued;
                                            $expiry_date= $pins->expire_date;
                                            $used_by= $pins->used_by;
                                            $card_usage = $pins->card_usage;
                                            $card_availability = $pins->card_availability;
                                            $pin_id = $pins->id

                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $pin;?></td>
                                                <td><?php echo $date_issued;?></td>
                                                <td><?php echo $expiry_date;?></td>
                                                <td><?php echo $card_usage;?></td>
                                                <td><?php echo $card_availability;?></td>
                                                <td><?php echo $used_by;?></td>
                                                <td>

                                                    <?php
                                                    if($card_availability != 'close'){
                                                        ?> <a href="javascript:void();" data-toggle='modal' data-target='#close-pin<?php echo $pin_id;?>'>
                                                            <i class="fa fa-edit" data-toggle="tooltip" title="Set pin status to close"></i>
                                                        </a><?php
                                                    }else{
                                                        ?> <a href="javascript:void();">
                                                            <i class="fa fa-info" data-toggle="tooltip" title="Pin is closed"></i>
                                                        </a><?php
                                                    }
                                                    ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php
                                    }else{
                                        ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No Data in table</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>pin</th>
                                        <th>Date Issued</th>
                                        <th>Expiry Date</th>
                                        <th>Card Usage</th>
                                        <th>Card Availability</th>
                                        <th>Used By</th>
                                        <th>Action</th
                                    </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </div>


                    </section>

                </div>



            </div><!-- /.row (main row) -->
        </section>
    </div><!-- /.container-fluid -->
    <!-- /.content -->

    <!-- /.content-wrapper -->

<?php include 'includes/footer.php'; ?>
<?php
foreach ($result as $pins){
$pin_id = $pins->id;
$used_by= $pins->used_by;
$pin = $pins->pin_code;
?>
    <!--          Delete teacher modal start-->
    <div class="modal fade" id="close-pin<?php echo $pin_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Close Pin<?php echo $pin; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Are you sure you want to set the pin  <span style="color: #f00; text-transform: uppercase;"><?php echo $pin; ?>to close?</span></h4>
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $pin_id; ?>">
                        </div>
                        <div class="modal-footer" style="margin-bottom: -10px;">

                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                            <input type="submit" class="btn btn-outline-danger" value="Proceed" id="submit" name="close_pin">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--          Delete teacher modal end -->

<?php
}

//run set pin status to close


if(isset($_POST['close_pin'])){
    $link = $conn->base_url().'view-pin-requests';
    $id = $_POST['id'];

    //delete teacher from database

    $sql = "UPDATE pins SET card_availability =:close WHERE id =:id";
    $conn->query($sql);
    $conn->bind(":id", $id);
    $conn->bind(":close", 'close');
    try{

        $conn->execute();
        echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
                    <i class='fas fa-check-circle'></i> Pin status was set to close successfully.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <span aria-hidden=\"true\">×</span>
                  </button>
                   <meta http-equiv='refresh' content='3; $link'>
                  
           </p>";

    }catch(PDOException $err){

        echo $err->getMessage();

    }


}



?>

    <script>
        $('[data-toggle ="tooltip"]').tooltip();
    </script>

    <script>
        $(function () {
            $("#pins").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "pdf", "print"]
            }).buttons().container().appendTo('#class_wrapper .col-md-6:eq(0)');
        });
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