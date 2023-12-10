<?php 

session_start();
include '../admin/includes/database.php';
include '../admin/includes/functions.php';

$conn = new Functions();

if(!empty($_POST['card_serial']) && !empty($_POST['examyear']) && !empty($_POST['examterm'])){

    $card_serial = $_POST['card_serial'];
    $exam_term = $_POST['examterm'];
    $exam_year = $_POST['examyear'];
    $username = $_POST['username'];
    $student_name = $_POST['student_name'];
    $current_date = $_POST['current_date'];
    $expire_date = $_POST['expire_date'];
    $user_card_usage = $_POST['user_card_usage'];
    $user_card_availability = $_POST['user_card_availability'];
    $card_limit = $_POST['card_limit'];
    $new_student_name = $conn->slugify($student_name);

    if(!$conn->cardSerial($card_serial)){
        echo "<script>
         toastr['error']('Invalid Card Serial no..');
      </script>";
    }elseif($conn->ifPinAvailableForUse($card_serial)){
          
        //update table generated pins table 
        $sql = "UPDATE generated_pins SET status = :close WHERE pin = :card_serial";
        $conn->query($sql);
        $conn->bind(":close", 'close');
        $conn->bind(":card_serial", $card_serial);
        $query1 = $conn->execute();

         //now update students and set card serial to the value of the serial used by the student
         $sql = "UPDATE student SET card_serial_no = :card_serial WHERE username= :username";
         $conn->query($sql);
         $conn->bind(":card_serial", $card_serial);
         $conn->bind(":username", $username);
         $query2 = $conn->execute();

         //insert the pin the user used to the pin table in the database
         $sql = "INSERT INTO pins (pin_code, expire_date, date_issued,  used_by, status, card_usage)
         VALUES (:card_serial, :card_expire_date, :current_date, :name, :one, :one)";
        $conn->query($sql);
        $one = 1;
        $conn->bind(":card_serial", $card_serial);
        $conn->bind(":name", $student_name);
        $conn->bind(":card_expire_date", $expire_date);
        $conn->bind(":current_date", $current_date);
        $conn->bind(":one", $one);
        $query3 = $conn->execute();
        
        if($query3){
           //fetch student result 
           $new_exam_term = $conn->slugify($exam_term);
           echo "<p class='alert alert-success alert-dismissible fade show text-center' role='alert'>
           <i class='fas fa-check-circle'></i>
           We are fetching Result.... Please wait.
           <i class='fas fa-spinner fa-pulse fa-2x'></i>
          
           <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
               <span aria-hidden='true'>×</span>
           </button> 
       </p><meta http-equiv='refresh' content='4; view-result/$card_serial/$new_student_name/$new_exam_term/$exam_year'>";
        
       }

    }elseif($conn->ifPinStillExists($card_serial, $student_name, $current_date)){
           /****
          means that user is using the card for a second time,
          We will go ahead and check how many times the admin allows pins usage against
          the number of times the student has used it before fetching the student result.
          *****/

          if($user_card_usage < $card_limit AND $user_card_availability = 'open'){
            $sql = "UPDATE pins SET card_usage = :card_usage_1 WHERE used_by =:name AND pin_code =:card_serial";
            $conn->query($sql);
            $conn->bind(":card_usage_1", $user_card_usage + 1);
            $conn->bind(":name", $student_name);
            $conn->bind(":card_serial", $card_serial);
            $query = $conn->execute();

            if($query){
                $new_exam_term = $conn->slugify($exam_term);

                echo "<p class='alert alert-success alert-dismissible fade show text-center' role='alert'>
                <i class='fas fa-check-circle'></i>
                We are fetching Result.... Please wait.
                <i class='fas fa-spinner fa-pulse fa-2x'></i>
                
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                </button> 
              </p><meta http-equiv='refresh' content='4; view-result/$card_serial/$new_student_name/$new_exam_term/$exam_year'>";
             
            }else{
                echo "<script>
                toastr['error']('An error occurred while fetching your result.');
               </script>";
            }
          }elseif($user_card_usage == $card_limit AND $user_card_availability == 'open'){

               //update the user pins table and let the user know he/she has exhausted card usage
               $sql = "UPDATE pins SET card_availability = :close WHERE used_by =:name AND pin_code =:card_serial";
               $conn->query($sql);
               $conn->bind(":close", 'close');
               $conn->bind(":name", $student_name);
               $conn->bind(":card_serial", $card_serial);
               $query = $conn->execute();

               if($query){
                echo "<script>
                toastr['error']('You have exhausted the usage of the card $card_serial. Please buy a new card from the school.');
                 </script>";
               }else{
                echo "<script>
                toastr['error']('An error occurred while validating your card.');
                </script>";

               }

          }else{
            echo "<script>
               toastr['error']('We are sorry you cannot use the card $card_serial anymore. pls purchase a new card.');
             </script>";
          }


        
        }else{
            echo "<script>
            toastr['error']('An error occurred while checking your result. Is either you are using a wrong pin, your pin has expired, you have exceeded card usage or the pin does not belong to you. Pls contact the school Admin for assistance.');
          </script>";
        }

    

}else{
    echo "<script>
    toastr['error']('Fields marked (*) are required.');
  </script>";
}
