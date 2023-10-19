<?php
session_start();

include '../config.php';
include '../functions.php';

if(!isset($_SESSION['username'])){
    
    header('location:login.php');

}else{
  $username = $_SESSION['username'];

  $Err = $msg1 = $classErr =$dateErr=$subErr= $msg2='';
  $question1=$question2=$question3=$question4=$question5=$question6=$question7=$question8=$question9=$question10='';

  if (isset($_POST['preview'])) {

    $q1 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['question1'], ENT_QUOTES, 'utf-8'));

    $q2 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['question2'], ENT_QUOTES, 'utf-8'));

    $q3 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['question3'], ENT_QUOTES, 'utf-8'));

    $q4 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['question4'], ENT_QUOTES, 'utf-8'));

    $q5 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['question5'], ENT_QUOTES, 'utf-8'));

    $q6 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['question6'], ENT_QUOTES, 'utf-8'));

    $q7 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['question7'], ENT_QUOTES, 'utf-8'));

    $q8 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['question8'], ENT_QUOTES, 'utf-8'));

    $q9 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['question9'], ENT_QUOTES, 'utf-8'));

    $q10 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['question10'], ENT_QUOTES, 'utf-8'));
    $class = mysqli_real_escape_string($conn, htmlspecialchars($_POST['class'], ENT_QUOTES, 'utf-8'));
    $subject = mysqli_real_escape_string($conn, htmlspecialchars($_POST['subject'], ENT_QUOTES, 'utf-8'));

    $sub_date = mysqli_real_escape_string($conn, htmlspecialchars($_POST['submit_date'], ENT_QUOTES, 'utf-8'));






    if (empty($q1) && empty($q2) && empty($q3)) {
      $Err = "Input at least 3 questions.";
    }elseif (empty($q1) || empty($q2) || empty($q3)) {
      $Err = "Input at least 3 questions.";
    }elseif (empty($class)) {
      $classErr = 'Pls select class.';
    }elseif (empty($subject)) {
      $subErr = 'kindly select subject..';
    }elseif (empty($sub_date)) {
      $dateErr = "Set submission date.";
    }else{
     
      $sql = "INSERT INTO homework (class,subject,one,two,three,four,five,six,sev,eight,nine,ten,sub_date) VALUES('$class','$subject','$q1','$q2','$q3','$q4','$q5','$q6','$q7','$q8','$q9','$q10','$sub_date')";
      $query = mysqli_query($conn,$sql);
      if ($query) {
        $msg1 = "<div class='w3-green w3-padding-small w3-round-large' 
                style='width:70%;'>
                Assignment posted successfully..
                <span><i class='fa fa-spinner w3-text-light-grey w3-large fa-spin fa-fw'></i></span>
                <meta http-equiv='refresh' content='4; submit_homework.php?class=$class&subject=$subject&sub_date=$sub_date
              </div>";

      }else{
        $msg2 = "An error occured, pls try again later..";
      }
      
     
    }

  }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/w3.css">
    <link rel="stylesheet" type="text/css" href="../css/theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body class="bg-image w3-serif" style="height:100vh;overflow-y: scroll;color: antiquewhite;">
    <section class="w3-margin w3-padding-small w3-padding-32" style="background:rgba(0, 0, 0, 0.8);">
      <div class="w3-row-padding" style="height:80vh;overflow-y: scroll;">

          <div class="w3-twothird">

            <h3 class="w3-center">Home Work Portal</h3>
            <!--<p class="w3-text-green">Minimum of three questions and maximum of ten per subject.</p>-->

            <div class="w3-text-red w3-margin-bottom w3-large"><?= $Err ?></div>
             <div class="w3-text-green w3-margin-bottom w3-large"><b><?= $msg1 ?></b></div>
              <div class="w3-text-red w3-margin-bottom w3-large"><b><?= $msg2 ?></b></div>
      
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">

              <div class="w3-margin-bottom w3-margin-top w3-grey w3-padding-small">

                <select name="class" class="w3-select">
                  <option value="">--Select Class--</option>
                  <option value="js1">JS 1</option>
                  <option value="js2">JS 2</option>
                  <option value="js3">JS 3</option>
                  <option value="ss1">SS 1</option>
                  <option value="ss2">SS 2</option>
                  <option value="ss3">SS 3</option>
                </select><br>
                <span class="w3-red"><?= $classErr ?></span>
              </div>

              <div class="w3-margin-bottom w3-grey w3-padding-small">

                <select name="subject" class="w3-select">
                  <option value="">--Select Subject--</option>
                  <option value="english">English Lang.</option>
                  <option value="maths">mathematics</option>
                  <option value="commerce">commerce</option>
                  <option value="government">government</option>
                  <option value="physics">physics</option>
                  <option value="chemistry">chemistry</option>
                  <option value="geography">geography</option>
                  <option value="fishery">fishery</option>
                  <option value="C.R.K">C.R.K</option>
                  <option value="lit. in english">lit. in english</option>
                  <option value="agric">agriculture</option>
                  <option value="economics">economics</option>
                  <option value="biology">biology</option>
                  <option value="civiv">civic</option>
                  <option value="account">account</option>
                  <option value=""></option>
                  <option value=""></option>
                </select>
                <span class="w3-red"><?= $subErr ?></span>
              </div>


              
              <div class="w3-grey w3-padding-small w3-margin-bottom">
                <textarea name="question1" rows="2" style="width: 100%; resize: none;" placeholder="Question 1.."></textarea>
           
              </div>

              <div class="w3-grey w3-padding-small w3-margin-bottom">
                  <textarea name="question2" rows="2" style="width: 100%; resize: none;" placeholder="Question 2.."></textarea>
                
              </div>

              <div class="w3-grey w3-padding-small w3-margin-bottom">
                  <textarea name="question3" rows="2" style="width: 100%; resize: none;" placeholder="Question 3.."></textarea>
                
              </div>

              <div class="w3-grey w3-padding-small w3-margin-bottom">
                  <textarea name="question4" rows="2" style="width: 100%; resize: none;" placeholder="Question 4.."></textarea>
              </div>


              <div class="w3-grey w3-padding-small w3-margin-bottom">
                  <textarea name="question5" rows="2" style="width: 100%; resize: none;" placeholder="Question 5.."></textarea>
              </div>

              <div class="">
                <div class="w3-grey w3-padding-small w3-margin-bottom">
                  <textarea name="question6" rows="2" style="width: 100%; resize: none;" placeholder="Question 6.."></textarea>
                </div>

                <div class="w3-grey w3-padding-small w3-margin-bottom">
                  <textarea name="question7" rows="2" style="width: 100%; resize: none;" placeholder="Question 7.."></textarea>
                </div>

                <div class="w3-grey w3-padding-small w3-margin-bottom">
                  <textarea name="question8" rows="2" style="width: 100%; resize: none;" placeholder="Question 8.."></textarea>
                </div>

                <div class="w3-grey w3-padding-small w3-margin-bottom">
                  <textarea name="question9" rows="2" style="width: 100%; resize: none;" placeholder="Question 9.."></textarea>
                </div>

                <div class="w3-grey w3-padding-small w3-margin-bottom">
                  <textarea name="question10" rows="2" style="width: 100%; resize: none;" placeholder="Question 10.."></textarea>
                </div>
              </div>

        


            <div class="w3-grey w3-padding-small w3-margin-bottom">
              <label for="sub_date">Submission Date</label>
              <input type="date" name="submit_date" id="sub_date" min="2023-01-01"><br>
              <span class="w3-red"><?= $dateErr ?></span>
            </div>

              


              <div class=" w3-large">  
                <input type="submit" name="preview" value="Continue" class="w3-button w3-teal w3-padding">
              </div>
            </form>
        </div>

        <div class="w3-third w3-padding-large">
          <h4 class="w3-large w3-center w3-text-light-grey">PLEASE NOTE</h4>

          <div class="w3-padding-small w3-black" style="margin-top:23px;">
            <p>You are allowed to set minimum of 3 questions and maximum of 10 questions per subject at a time.</p>
          </div>
          <div class="w3-padding-small w3-light-grey w3-border">
            <p>Pls carefully avoid typographical errors while typing in the assignments for there is no room yet to make corrections incase therebe any mistakes.</p>
          </div>
          <div class="w3-padding-small w3-red">
          </div>

          <div class="w3-padding-16 w3-margin-top" style="">
            <ul class="w3-ul">
            <li class="w3-hover-teal"><a href="dashboard.php" class="btn w3-wide">Exit</a></li>
          </ul>
          </div>
        </div>
      </div>
    </section>

    <!--<script type="text/javascript">
      const less = document.querySelector('#less');
      less.addEventListener('click', () => less.style.display = 'none');
    </script>-->
  </body>
  </html>
  <?php
}

?>