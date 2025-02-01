<?php
    class database{ // add the private variables
        private $host = 'localhost'; 
        private $username = 'root';
        private $password = 'mysql';
        private $database = 'assignmentone'; //name of the database
        protected $connection;

        public function __construct(){
            if(!isset($this->connection)){
                $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
                if(!$this->connection){ // when it cant make the connectiom
                    echo "<p>Cannot connect to the database</p>";
                    exit();
                }
            }
            return $this->connection; //return when the connction is made
        }
    }
?>