<?php

include('includes/database.php');
include('includes/functions.php');

$conn = new Functions();

if(!empty($_POST['name'])){
    $name = $_POST['name'];
    $tagline = $_POST['school_tagline'];
    $phone_no = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $footer = $_POST['footer'];
    $next_term_begins = $_POST['next_term_begins'];
    $no_times_school_open = $_POST['no_times'];
    $settings_id = $_POST['settings_id'];
    $main_url = $_POST['main_url'];
    $reg_no_prefix = $_POST['reg_no_prefix'];
    $principal_name = $_POST['principal_name'];
    $school_website= $_POST['website'];
    $current_school_session = $_POST['current_school_session'];

    //perform validations

    $sql = "SELECT * FROM general_settings WHERE school_name =:schoolname AND school_name != '' AND id !=:settings_id";
    $conn->query($sql);
    $conn->bind(":schoolname", $name);
    $conn->bind(":settings_id", $settings_id);
    if($conn->rowCount() > 0){
        echo "<script>
                toastr['error']('Name of school already exists.');
             </script>";
        return false;
    }

    $sql = "SELECT * FROM general_settings WHERE phone_no =:phoneno AND phone_no != ''  AND id !=:settings_id";
    $conn->query($sql);
    $conn->bind(":phoneno", $phone_no);
    $conn->bind(":settings_id", $settings_id);
    if($conn->rowCount() > 0){
        echo "<script>
              toastr['error']('Phone number already exists.');
             </script>";
        return false;
    }

    //check if email already exists
    $sql = "SELECT * FROM general_settings WHERE email =:email AND email != '' AND id !=:settings_id";
    $conn->query($sql);
    $conn->bind(":email", $email);
    $conn->bind(":settings_id", $settings_id);
    if($conn->rowCount() > 0){
        echo "<script>
              toastr['error']('Administrative email already exists.');
             </script>";
        return false;
    }else{

        //process  updating of data into database
        $sql = "UPDATE general_settings SET school_name =:schoolname, school_tagline =:school_tagline, phone_no =:phoneno, email =:email,
               address =:address, footer =:footer, next_term_begins =:next_term_begins, 
               no_times_school_open =:no_times, main_url =:main_url,
                reg_no_prefix =:reg_no_prefix, principal_name =:principal_name, school_website =:website, 
                current_school_session =:current_school_session";
        $conn->query($sql);
        $conn->bind(":schoolname", ucwords($name));
        $conn->bind(":school_tagline", $tagline);
        $conn->bind(":phoneno", $phone_no);
        $conn->bind(":email", $email);
        $conn->bind(":main_url", $main_url);
        $conn->bind(":reg_no_prefix", $reg_no_prefix);
        $conn->bind(":address", $address);
        $conn->bind(":footer", $footer);
        $conn->bind(":next_term_begins", $next_term_begins);
        $conn->bind(":no_times", $no_times_school_open);
        $conn->bind(":principal_name", $principal_name);
        $conn->bind(":website", $school_website);
        $conn->bind(":current_school_session", $current_school_session);

        $send = $conn->execute();
        if ($send) {
            echo "<script>
                 toastr['success']('Settings have been updated successfully.');
             </script><meta http-equiv='refresh' content='3; settings'>";

        } else {
            echo "<script>
                toastr['error']('An error occurred while updating data');
             </script><meta http-equiv='refresh' content='3; settings'>";
        }



    }


}else{
    echo "<script>
                toastr['error']('All fields are required.');
             </script>";
}