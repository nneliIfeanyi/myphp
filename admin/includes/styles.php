<?php
include "database.php";
include "functions.php";

$conn = new Functions();
$base_url = $conn->base_url();

//fetch school details
$sql = "SELECT * FROM general_settings";
$conn->query($sql);
$school_details = $conn->fetchSingle();
$logo = $school_details->logo;
$school_name = $school_details->school_name;
$main_url = $school_details->main_url;
$footer = $school_details->footer;
global $school_name;
$student_login_link = $main_url."/student/login";
$student_url = $main_url."/student";
$teacher_url = $main_url."/teacher";
?>

<link rel="shortcut icon" href="<?php echo $base_url; ?>upload/<?php echo $logo; ?>">
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo $base_url; ?>plugins/select2/css/select2.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo $base_url; ?>dist/css/adminlte.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="<?php echo $base_url; ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo $base_url; ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo $base_url; ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo $base_url; ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo $base_url; ?>plugins/toastr/toastr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">


<style>
    .alert, .alert-success{
        position: fixed !important;
        top: 10% !important;
        right: 0 !important;
        z-index: 99999 !important;
        width: 30%;
    }

    #show-msg{
        position: fixed !important;
        top: 10% !important;
        right: 0 !important;
        z-index: 99999 !important;
        width: 30%;
    }

    .modal-header{
        border-top: 12px solid #0c515c !important;
    }
    [class*=sidebar-dark] .brand-link {
        border-bottom: none;
    }
    .img-circle {
        border-radius: 0;
    }
    .brand-link .brand-image {
        max-height: 38px;
    }
    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
        background-color: #17a2b8;
    }
    .card-info:not(.card-outline)>.card-header {
        background-color: #f06001;
    }
    .btn-info {
        background-color: #f06001;
        border-color: #f06001;
    }
    .parsley-required, .parsley-pattern{color: #f00 !important;}
    .parsley-error{background: #f0b2b2;}
    .parsley-{basuccessckground: #b8eeb8;}
    .fa-trash{
        background:  #ff5b57;
        padding: 5px;
        border-radius: 2px;
        color: white;
        font-size: 11px;
    }
    .fa-edit{
        background: #f59c1a;
        padding: 5px;
        border-radius: 2px;
        color: white;
        font-size: 11px;
    }
    .fa-check-square{
        background:  #709561;
        padding: 5px;
        border-radius: 2px;
        color: white;
        font-size: 11px;
    }

    .delete-button:focus{
        border: none !important;
    }
    .img-circles{
        width: 50px !important;
        height: 50px !important;
        margin-left: 25% !important;
        margin-bottom: -20px;
    }

    .fa-eye-slash{
        background: #b83825;
        padding: 5px;
        border-radius: 2px;
        color: white;
        font-size: 11px;
    }

    .fa-info-circle:before {
        content: "\f05a";
        color: orange;
    }

    .fa-info{
        background: #0adcff;
        padding: 5px;
        border-radius: 2px;
        color: white;
        font-size: 11px;
    }


</style>

