<?php
session_start();
include 'includes/database.php';
include 'includes/functions.php';

$conn = new Functions();

if(!empty($_POST['previous_class']) AND !empty($_POST['new_class'])){

  $previous_class_id = $_POST['previous_class'];
  $new_class_id = $_POST['new_class'];
  $renamed_class_name = trim($_POST['new_class_name']);

  $redirect = $conn->base_url()."promotion";

    //fetch class name based on ID 
    $sql = "SELECT name FROM classes WHERE id = :id";
    $conn->query($sql);
    $conn->bind(":id", $previous_class_id);
    $previous_class_name = $conn->fetchColumn();
    

    $sql = "SELECT name FROM classes WHERE id = :new_id";
    $conn->query($sql);
    $conn->bind(":new_id", $new_class_id);
    $new_class_name = $conn->fetchColumn();


     //check if new class name was entere

     if(empty($renamed_class_name)){

            //update only previous and old class 
      
        if($previous_class_id == $new_class_id){
            echo "<script>
            toastr['error']('You cannot promote to the same class. Please select different classes.');
          </script>";
          return false;
        }else{

            //proceed with updating details 
 
             //update students table with the new class informa

             $sql = "UPDATE student SET classesID =:new_class_id WHERE classesID = :old_class_id"; 
             $conn->query($sql);
             $conn->bind(":new_class_id", $new_class_id);
             $conn->bind(":old_class_id", $previous_class_id);
             $update_students_class = $conn->execute();

                  //fetch new class section based on class ID
 
            $sql = "SELECT id FROM sections WHERE class =:new_class_id"; 
            $conn->query($sql);
            $conn->bind(":new_class_id", $new_class_id);
            $new_class_section_id = $conn->fetchColumn();

                //Update student sections with new section information 
                $sql = "UPDATE student SET sectionid =:new_class_section_id WHERE classesID = :new_class_id";
                $conn->query($sql);
                $conn->bind(":new_class_id", $new_class_id);
                $conn->bind(":new_class_section_id", $new_class_section_id);
                $update_section = $conn->execute();

                if($update_students_class AND $update_section){
                    echo "<script>
                    toastr['success']('You have successfully Promoted Students in $previous_class_name to $new_class_name.');
                   </script><meta http-equiv='refresh' content='4; $redirect'>";
                }else{
                    echo "<script>
                    toastr['error']('An error occurred while promoting classes. Pls try again later.');
                  </script>"; 
                }


        }



     }//end empty rename_class_name condition 

     else{

       //update with updating class name
            /* 
         ** Steps:
         * 1. Update the class name to the new renamed class name 
         * 2. Update existing students classes with the new renamed class name 
        */

        //update the old class name with the new class name 

        $sql = "UPDATE classes SET name =:new_class_name WHERE id =:id";
        $conn->query($sql);
        $conn->bind(":new_class_name", $renamed_class_name);
        $conn->bind(":id", $new_class_id);
        $update_new_class_name = $conn->execute();

         //update students table with the new class information 

         $sql = "UPDATE student SET classesID =:new_class_id WHERE classesID = :old_class_id"; 
         $conn->query($sql);
         $conn->bind(":new_class_id", $new_class_id);
         $conn->bind(":old_class_id", $previous_class_id);
         $update_students_class = $conn->execute();

         //fetch new class section based on class ID
         $sql = "SELECT id FROM sections WHERE class =:new_class_id"; 
         $conn->query($sql);
         $conn->bind(":new_class_id", $new_class_id);
         $new_class_section_id = $conn->fetchColumn();

          //Update student sections with new section information 
          $sql = "UPDATE student SET sectionid =:new_class_section_id WHERE classesID = :new_class_id";
          $conn->query($sql);
          $conn->bind(":new_class_id", $new_class_id);
          $conn->bind(":new_class_section_id", $new_class_section_id);
          $update_section = $conn->execute();

          if($update_new_class_name AND  $update_students_class AND $update_section){
            echo "<script>
            toastr['success']('You have successfully Promoted Students in $previous_class_name to $renamed_class_name.');
           </script><meta http-equiv='refresh' content='4; $redirect'>";
         }else{
            echo "<script>
            toastr['error']('An error occurred while promoting classes. Pls try again later.');
          </script>";
         

     }

    }

}else{

    echo "<script>
    toastr['error']('Field marked asterik(*) are required.');
  </script>";

}