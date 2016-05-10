<?php  // db_connnect.php
class DB_Connect {
     private $con;
 
    // constructor
    function __construct() {
        // connecting to database
            $this->con = $this->connect();
    }
 
    /**
     * Function to connect with database
     */
    private function connect() {
        // import database connection variables
        //require_once __DIR__.'/config.php';
		require_once dirname(__FILE__).'\config.php';
		//require 'config.php';
		require ('config.php');
        try {
            $conn = new PDO('mysql:host='.DB_SERVER .';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
        return $conn;
    }
    
    public function getDbConnection(){
        return $this->con;
    }
}
?>