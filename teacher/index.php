<?php
session_start();
if(isset($_SESSION['teacher'])){
    $username = $_SESSION['teacher'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include('../admin/includes/styles.php');?>
    <title> Teacher Dashboard | <?php echo $school_name; ?></title>
    <?php
    $month = date('M');
    $term = '';
    switch ($month){
        case 'Jan':
            $term = '2nd term';
            break;
        case 'Feb':
            $term = '2nd term';
            break;
        case 'Mar':
            $term = '2nd term';
            break;
        case 'Apr':
            $term = '2nd term';
            break;
        case 'May':
            $term = '3rd term';
            break;
        case 'Jun':
            $term = '3rd term';
            break;
        case 'Jul':
            $term = '3rd term';
            break;
        case 'Aug':
            $term = '3rd term';
            break;
        case 'Sep':
            $term = '1st term';
            break;
        case 'Oct':
            $term = '1st term';
            break;
        case 'Nov':
            $term = '1st term';
            break;
        case 'Dec':
            $term = '1st term';
            break;
        default:
            $term = 'No active term found';
    }

    ?>

    <?php
    $sql = "SELECT DISTINCT(classesID) FROM student";
    $conn->query($sql);
    $chart_data = '';
    $result_set = $conn->fetchMultiple();

    foreach ($result_set as $student_details){
        //fetch class names
        $sql = "SELECT name FROM classes WHERE id =:classesID";
        $conn->query($sql);
        $conn->bind(":classesID", $student_details->classesID);
        $class_name = $conn->fetchColumn();

        //total number of students per class
        $sql = "SELECT COUNT(classesID) FROM student WHERE classesID =:classID";
        $conn->query($sql);
        $conn->bind(":classID", $student_details->classesID);
        $total_students = $conn->fetchColumn();
        $chart_data .= "{ class:'".$class_name."', students:".$total_students.",}, ";

    }

    $chart_data = substr($chart_data, 0, -2);

    ?>

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
                    <div class="col-sm-8">
                        <h1 class="m-0"> Quick Links </h1>
                        <?php
                        $sql = "SELECT * FROM teachers WHERE username =:username";
                        $conn->query($sql);
                        $conn->bind(":username", $_SESSION['teacher']);
                        $result = $conn->fetchSingle();
                        $teacher_name = $result->name;

                        ?>
                        <p class="m-0">Welcome: <span style='color: green; font-weight: bold; font-size: 18px; text-transform: uppercase;'><?php echo ucwords($teacher_name); ?></span>
                            &nbsp; | &nbsp; Current School Year :  <span style='color: green; font-weight: bold; font-size: 18px; text-transform: uppercase;'>
                  
                                <?php 
                                    $sql = "SELECT current_school_session FROM general_settings";
                                    $conn->query($sql);
                                    $current_school_year = $conn->fetchColumn();
                                    echo $current_school_year;
                                
                                ?>
                  
                               </span>   &nbsp; | &nbsp; Current Term : <span style='color: green; font-weight: bold; font-size: 18px; text-transform: uppercase;'><?php echo $term; ?></span>
                        </p>

                        <?php


                        ?>
                    </div><!-- /.col -->
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <?php include 'includes/home_infos.php'; ?>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-12 connectedSortable">
                        <div class="card">
                            <div class="card-header">
                                Showing total number of active students in all classes
                            </div>
                            <div class="card-body">
                                <div id="chart">

                                </div>
                            </div>
                        </div>


                    </section>
                    <!-- /.Left col -->
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->

                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include '../admin/includes/footer.php'; ?>

    <script>
        var barColorsArray = ['#3498DB', '#34495E','#26B99A', '#DE8244', '#DE4244', '#12B0E8', '#02B290', '#E07C24', '#35BDD0', '#8D3DAF'];
        var colorIndex = 0;
        Morris.Bar({
            element: 'chart',
            data: [<?php echo $chart_data; ?>],
            xkey: 'class',
            ykeys: ['students'],
            labels: ['Students'],
            barColors: function () {
                if(colorIndex < 4)
                    return barColorsArray[++colorIndex];
                else{
                    colorIndex = 0;
                    return barColorsArray[++colorIndex];
                }
            },
            xLabelAngle: 35,
            hideHover: 'auto',
            resize: true

        });

        //$('[data-toggle = "tooltip"]').tooltip();
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
        $base_url = $conn->main_url();
        $redirect = $base_url."/teacher/login";
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
