<?php
session_start();

include '../config.php';
include '../functions.php';

if(!isset($_SESSION['username'])){
    
    header('location:login.php');

}else{
  $username = $_SESSION['username'];

  $msg = $pinErr = '';
  
  if (isset($_POST['generate'])) {
      
    $num_of_pin = mysqli_real_escape_string($conn, htmlspecialchars($_POST['number'], ENT_QUOTES, 'utf-8'));
    if (empty($num_of_pin)) {
      $msg = "<div class='w3-red w3-padding-small w3-margin-top w3-round-large' 
              style='width:70%;font-size:16px;'>
              Pls Enter The number of Pins To Generate!
            </div>";
    }elseif($num_of_pin < 0 || $num_of_pin > 100){
      $pinErr = "<div class='error' 
              style='width:70%;font-size:16px;'>
             Number must be between 1 and 100.
            </div>";
    }else{
      $i = 1;

      while ($i <= $num_of_pin) {
        $gen_pin ='CP' . rand(100, 999) . rand(90000, 99999) .'M';
        $i++;
        $date_gen = date('y-m-d');
        $pin_stats = 'open';
        $exp_date = date('2023-04-01');

$sql = "INSERT INTO generated_pins(pin, date_generated, status,exp_date) VALUES('$gen_pin', '$date_gen', '$pin_stats','$exp_date')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
          $msg = "<div class='w3-green w3-padding-small w3-round-large' 
                style='width:70%;'>
                Pin Generated Successfully
                <span><i class='fa fa-spinner w3-text-light-grey w3-large fa-spin fa-fw'></i></span>
                <meta http-equiv='refresh' content='4; generate_pin.php'>
              </div>";
        }else{
          $msg = "<div class='w3-red w3-padding-small w3-round-large' 
              style='width:70%;'>
              An error occured!
            </div>";
        }

      }
      
    }
  }
 

}


?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login</title>
  <link rel="stylesheet" type="text/css" href="../css/w3.css">
  <link rel="stylesheet" type="text/css" href="../css/theme.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="bg-image w3-serif" style="height:100vh;overflow-y: scroll;color: antiquewhite;">
   <section class="w3-padding-small w3-padding-16" style="background:rgba(0, 0, 0, 0.8);">
    <div class="w3-row">
      <div class="w3-margin-bottom"  style="width:98.5%;margin: auto;">
        

        <div class="w3-center my-font p-font-size">Generate Students Pins</div>
         
           <?php echo $msg ;?>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
            <div class="w3-padding-16">
              <div class="w3-margin-top w3-padding-16 w3-padding w3-blue-gray">
                <input type="number" name="number" placeholder="Enter no. of pins to generate.." class="w3-input w3-white">
                <span class="w3-padding-small">Maximum of 100 pins at a time.</span>
                <span class="error"><?php echo "$pinErr";?></span>
              </div>
              <div class="w3-margin-top" style="margin:auto; width: 60%;">
                <input type="submit" name="generate" value="Generate" class="w3-btn w3-block w3-teal">
              </div>
          </form>
        </div>
 
          <div style="overflow-x: scroll;height: auto;">

            <div class="w3-center my-font p-font-size">All Generated Pins</div>

            <table class="w3-table-all" style="width:100%;margin: auto;">
              <thead>
                <tr class="w3-text-black">
                 <th><b>S/N</b></th>
                  <th><b>Pin</b></th>
                  <th><b>Date_Generated</b></th>
                  <th><b>Status</b></th>
                </tr>
              </thead>

              <tbody>
                <?php 

                  $sql2 = "SELECT * FROM generated_pins" ;
                  $query2 = mysqli_query($conn, $sql2);

                  if (mysqli_num_rows($query2) > 0) {
                    
                      $i=1;
                      while($result2 = mysqli_fetch_array($query2)){
                        $id = $result2['id'];

                        $gen_pin = $result2['pin'];
                     
                        $date_gen = $result2['date_generated'];
                        $pin_status = $result2['status'];
                        
                    
                    ?>
                    <tr class="w3-text-dark-grey">
                      <td><?php  echo $i; ?></td>
                      <td><?php  echo $gen_pin; ?></td>
                       <td><?php  echo $date_gen; ?></td>
                       
                      <?php
                        if ($pin_status == 'open') {
                          ?>
                          <td><span class="w3-btn w3-green w3-round-large w3-small"><?php  echo $pin_status; ?></span></td>
                          <?php
                        }else{
                          ?>
                          <td>
                            <span class="w3-btn w3-red w3-round-large w3-small"><?php  echo $pin_status; ?></span>
                            <a href="delete.php?pin=<?=$gen_pin?>&id=<?=$id?>" class="w3-text-red w3-btn  w3-tiny">Delete</a>
                          </td>
                          <?php
                        }
                      ?>
                      

                      
                    </tr>

                    <?php
                    $i++;
                      }

                  }else{

                    ?>
                    <tr class="w3-text-dark-grey">
                      <td colspan="3" class="w3-text-red w3-padding-small"><?php  echo "You have not generated any pin yet."; ?></td>
                    </tr>

                    <?php


                  }
                ?>

              </tbody>
            </table>

          </div>
        </div>

        <div class="w3-third">
           
           <div class="w3-padding-16 w3-margin-top" style="">
              <ul class="w3-ul">
              <li class="w3-hover-teal"><a href="dashboard.php" class="btn">Return to Dashboard</a></li>
              <li class="w3-hover-teal"><a href="logout.php" class="btn">Logout</a></li>
           </ul>
           </div>

        </div>
    </div>

   



    <!-- copyright -->
     <div class="w3-center footer" style="width:100%;color: lightgrey;">
        © 2023 <span class="my-font">CPM Int. School Suleja</span><br> All Rights Reserved
  </div>
    
</section>

  <script>
      if ( window.history.replaceState ) {
          window.history.replaceState( null, null, window.location.href );
      }
  </script>
</body>
</html>