<?php    // db_functions.php
class DB_Functions {
    private $con;
    // constructor
    function __construct() {
        require_once __DIR__.'/db_connect.php';
        // connecting to database
        $db = new DB_Connect();
        $this->con = $db->getDbConnection();
    }
 
    public function getContacts() {
        try {
			
            $stmt = $this->con->prepare('select id,name,phone,address FROM contacts');
            $params = array(':id' => $id);
            $stmt->execute($params);
            return $stmt;
        } catch(PDOException $e) {
            return '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }
 
    public function otherSQLfunction($parameter) {
        // other sql code
    }
}