<?php //include the database.php file that has the database class
    require_once 'database.php';
    // defin ethe crud class that extends the database class
    class crud extends database{
        public function __construct(){
            parent::__construct();
        }
        public function execute($query){ //check to see if the connection failed
            $result = $this->connection->query($query);
            if($result == false){
                echo "<p>Error: cannot execute the command</p>"; //return if failed
                return false;
            }
            else{
                return true; //if the query execution suceeded, return true
            }
        }
        public function escape_string($value){ 
            return $this->connection->real_escape_string($value);
        }
    }
?>