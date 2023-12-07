<?php
class Functions extends Database{
    private $msg;
    private $result;

    public function checkUsername($username)
    {
        //run
        $sql = "SELECT * FROM admin WHERE username = :username";
        $this->query($sql);
        //bind value
        $this->bind(":username", $username);
        //fetch data
        $this->result = $this->fetchSingle();
        //check if data was returned
        if($this->result){
            return true;
        }else{
            return false;
        }

    }

    //password encryption
    public function Password_Encryption($password){
        //hashing technique
        $blowfish_hash_format = "$2y$12$00ok";
        $salt_length = 22;
        $salt = $this->generate_salt($salt_length);
        $formatting_blowfish_with_salt = $blowfish_hash_format.$salt;
        $hash = crypt($password, $formatting_blowfish_with_salt);
        return $hash;
    }

    //generate salt function
    public function generate_salt($length){
        $unique_random_string = md5(uniqid(mt_rand(), true));
        $base64_string = base64_encode($unique_random_string);
        $modified_base64_string = str_replace('+', '_', $base64_string);
        $salt = substr($modified_base64_string, 0, $length);
        return $salt;
    }

    //password password check
    public function password_check($password, $existing_hash){
        $hash = crypt($password, $existing_hash);
        if($hash === $existing_hash){
            return true;
        }else{
            return false;
        }
    }

    //login check

    public function loginCheck($username, $password){
        global $username;
        $sql = "SELECT * FROM admin WHERE username =:username";
        $this->query($sql);
        $this->bind(":username", $username);
        $username = $this->fetchSingle();

        if($username){
            global $existing_hash;
            $existing_hash = $username->password; //password already in database
            //check for password associated with same username
            if($this->password_check($password, $existing_hash)){
                return true;
            }else{
                return null;
            }
        }
    }

    //base url

    public function base_url()
    {
        $sql = "SELECT main_url FROM general_settings";
        $this->query($sql);
        $new_url = $this->fetchColumn()."/admin/";
        return $new_url;
    }

    public function main_url()
    {
        $sql = "SELECT main_url FROM general_settings";
        $this->query($sql);
        $new_url = $this->fetchColumn();
        return $new_url;
    }

    public function student_url()
    {
        $sql = "SELECT main_url FROM general_settings";
        $this->query($sql);
        $new_url = $this->fetchColumn()."/student/";
        return $new_url;
    }

    /*
* slugify($text)
* Function to convert a text
* to slug (url-friendly version)
* @return slug string
*/
    public function slugify($text) {
        // covert to lowercase
        $word = strtolower($text);

        // remove excess whitespace
        $strippedWord = preg_replace('/\s\s+/', ' ', $word);

        // Replace strings
        $out = array(" ", "/", ".", "?", "(", ")", "$", "#", "&", "*", ",", "'", "\"", "“", "”", "\\", "+", "=", "%", "^");
        $slug = str_replace($out, "-", $strippedWord);

        // Remove cases of double "--"
        $newSlug = str_replace("--", "-", $slug);

        // Check if $out string is trailing at the end of the text
        if ( in_array(substr($newSlug, -1), $out) || substr($newSlug, -1) === "-") {
            $cleanedSlug = substr_replace($newSlug, "", -1);
        }
        else {
            $cleanedSlug = $newSlug;
        }

        return $cleanedSlug;
    }

    public function generate_reg_no(){
        $sql = "SELECT reg_no_prefix FROM general_settings";
        $this->query($sql);
        $school_code = $this->fetchColumn()."/";
        $min_no = 001;
        $max_no = 100;
        $year = date('Y');
        $time_seconds = date('s');
        $random_no = rand($min_no, $max_no);
        $result = $school_code.$year."_".$random_no.$time_seconds;
        return $result;

    }
public function Checkpassword($password){
        $password_pattern = preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password);
        if($password_pattern){
            return true;
        }else{
            return false;
        }
    }


    //Students

    public function studentLoginCheck($username, $password){
        global $username;
        $sql = "SELECT * FROM student WHERE username =:username";
        $this->query($sql);
        $this->bind(":username", $username);
        $username = $this->fetchSingle();

        if($username){
            global $existing_hash;
            $existing_hash = $username->password; //password already in database
            //check for password associated with same username
            if($this->password_check($password, $existing_hash)){
                return true;
            }else{
                return true;
            }
        }
    }

    //check for card serial no validity
    public function cardSerial($card_serial){
        $sql = "SELECT * FROM generated_pins WHERE pin = :card_serial"; 
        $this->query($sql);
        $this->bind(":card_serial", $card_serial);
        $row_count = $this->rowCount();
        if($row_count > 0){
           $result = $this->fetchSingle();
           while($result){
                 $dbserial = $result->pin;
                 if($card_serial == $dbserial){
                     return true;
                 }else{
                    return false;
                 }
           }
        }else{
            return false; 
        }
    }

    //check if generated pin is valid or not 
    public function checkGeneratedPin($pin, $username){
        $sql = "SELECT exam_pin FROM student WHERE username = :username";
        $this->query($sql);
        $this->bind(":username", $username);
       $row_count = $this->rowCount(); 
       if($row_count > 0){
          $result = $this->fetchSingle();
          $dbpin = $result->exam_pin;
          if($pin == $dbpin){
            return true;
          }else{
            return false;
          }
       }
    }

    //check if card serial  is available for use(first time use)
    public function ifPinAvailableForUse($card_serial){
      
        $sql = "SELECT * FROM generated_pins WHERE pin = :card_serial && status = :open";
        $this->query($sql);
        $this->bind(":card_serial", $card_serial);
        $this->bind(":open", 'open');
        $row_count = $this->rowCount();
        if($row_count > 0){
            $result = $this->fetchSingle();
            $dbpin = $result->pin;
        
            if($card_serial == $dbpin){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }


   //check if card serial is in use by another user, or the same user and if it hasn't expired
    public function ifPinStillExists($card_serial, $name, $current_date){
        $sql = "SELECT * FROM pins WHERE pin_code = :card_serial && status =:one && used_by = :name AND card_availability =:open";
        $this->query($sql);
        $one = 1;
        $this->bind(":card_serial", $card_serial);
        $this->bind(":one", $one);
        $this->bind(":name", $name);
        $this->bind(":open", 'open');
        $row_count = $this->rowCount();

        if($row_count > 0){
            $result = $this->fetchSingle();
            $dbpin = $result->pin_code;
            $dbName = $result->used_by; 
            $db_card_expired = $result->expire_date;
            if($card_serial == $dbpin && $name == $dbName && $current_date < $db_card_expired){
                return true;
            }else{
                return false;
            }

        }else{
            return false;
        }


    }


    //Teacher Specific Functions

    public function teacherLoginCheck($username, $password){
        global $username;
        $sql = "SELECT * FROM teachers WHERE username =:username";
        $this->query($sql);
        $this->bind(":username", $username);
        $username = $this->fetchSingle();

        if($username){
            global $existing_hash;
            $existing_hash = $username->password; //password already in database
            //check for password associated with same username
            if($this->password_check($password, $existing_hash)){
                return true;
            }else{
                return null;
            }
        }
    }






}

