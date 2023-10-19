<?php
 session_start();
 include 'includes/database.php';
 include 'includes/functions.php';

 $conn = new Functions();

 //fetch school details from database
$sql = "SELECT * FROM general_settings";
$conn->query($sql);
$result = $conn->fetchSingle();
$admin_login_bg = $result->admin_login_bg;
$base_url = $conn->base_url();
$main_url = $conn->main_url();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login | <?php echo $result->school_name; ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>plugins/toastr/toastr.min.css">
    <link rel="icon" href="<?php echo $base_url; ?>upload/<?php echo $result->logo; ?>" type="image/png">
<!--    <link rel="stylesheet" href="">logo-->

    <style>
        body{
            background-image: url('<?php echo $base_url."upload/".$admin_login_bg?>');
            background-position: center;
            -webkit-background-size: cover;
            background-size:cover;
            background-repeat: no-repeat;
            -webkit-background-clip: border-box;
            -moz-background-clip: border-box;
            background-clip: border-box;
        }

        .btn-primary {
            color: #fff;
            background-color: #334722;
            border-color: #334722;
            box-shadow: none;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #517978;
            border-color: #517978;
        }
        .btn-primary.focus, .btn-primary:focus {
            color: #fff;
            background-color: #38582b;
            border-color: #38582b;
            box-shadow: 0 0 0 0 rgba(38,143,255,.5);
        }

        .card-primary.card-outline {
            border-top: 3px solid #b1793e;
        }
        .btn-primary:not(:disabled):not(.disabled):active{
            background-color: #38582b;
            border-color: #38582b;
        }


        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="card card-outline card-primary" style="box-shadow: 0 14px 16px #646161;">
        <div class="card-header text-center">
            <p>
                <i class="fas fa-lock fa-5x" style="background: #1b2626; padding: 30px; -webkit-border-radius: ;-moz-border-radius: ;border-radius: 20px; color: #fff;"></i>
            </p>
            <a href="index" class="h1" style="color: #1b2626;"><b>Restricted Area</b></a>
        </div>

    </div>
   <div class="card">
     <div class="card-body login-card-body">
        <p class="login-box-msg"> Sign in to start your session</p>
        <form action="" method="post" id="login_form">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Username" name="username">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4" style="margin: 0 auto;">
                    <button type="submit" class="btn btn-primary btn-block" style="background: #382521; border-color:#382521 ">Sign In</button>
                </div>
            </div>
        </form>

        <p class="mb-1 mt-2 text-center">
            <a href="<?php echo  $main_url; ?>" style="color: #374923;">Back to Home</a>
        </p>
        <div id="msg"></div>
    </div>
   </div>
</div>

<script src="<?php echo $base_url; ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo $base_url; ?>plugins/toastr/toastr.min.js"></script>
<script src="<?php echo $base_url; ?>dist/js/adminlte.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo $base_url; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
    $(function () {
        $('#login_form').on('submit', function (event) {
            event.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "<?php echo $base_url;?>process-login.php",
                data: formData,
                beforeSend: function () {
                    $('#msg').html("Signing In..... Please wait.");
                },
                success: function (response) {
                    $('#msg').html(response);
                }
            })
        })
    })
</script>

</body>
</html>