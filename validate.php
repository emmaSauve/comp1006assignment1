<?php
    class validate{
        public function checkIfBlank($data, $fields){ //check for if one of the fields is left blank
            $input = null;
            foreach ($fields as $value){
                if(empty($data[$value])){
                    $input .= "<p>$value field cannot be left blank</p>"; //display to the user that it cannot be blank
                }
            }
            return $input;
        }

        public function checkValidateGrade($grade){ // grades entered must be between 100 and 0 and cannot be negative
            if(preg_match("/^(?:100|[1-9]?\d)$/", $grade)){
                return true;
            }
            return false;
        }
        

        public function checkValidateEmail($emailAddress){ //ensure that the email is valid
            if (filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
                return true;
            }
            return false;
        }
        
        public function checkValidateStudentId($stuid){ //student ids can only be numbers and cannot be negative
            if (preg_match("/^[0-9]+$/", $stuid)) {
                return true;
            }
            return false;
        }
        



    }

?>