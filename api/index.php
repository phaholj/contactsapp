<?php
/*

*/
require_once __DIR__.'\config.php';

require 'Slim/Slim.php';

$app = new Slim();

$app->get('/contacts', 'getContacts');
$app->get('/contacts/:id', 'getContact');
$app->post('/contacts', 'addContact');
$app->put('/contacts/:id', 'updateContact');
$app->delete('/contacts/:id', 'deleteContact');

$app->run();


// Get Database Connection
function DB_Connection() {	
    $dbh = new PDO('mysql:host='.DB_SERVER .';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}


//Get contacts Details
function getContacts() {
	$sql = "call GetContacts";
	try {
		$db = DB_Connection();
		$stmt = $db->query($sql);  
		$list = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($list);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

// Add new contact to the Database
function addContact() {
	$request = Slim::getInstance()->request();
	$cont = json_decode($request->getBody());

	$sql = "call AddContact(:p_name, :p_phone, :p_address)";
	try {
		$db = DB_Connection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam(':p_name',$cont->name,PDO::PARAM_STR,30);
		$stmt->bindParam(':p_phone',$cont->phone,PDO::PARAM_STR,15);
		$stmt->bindParam(':p_address',$cont->address,PDO::PARAM_STR,100);
		$stmt->execute();
		$db = null;
		echo json_encode($cont); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

// GET One contact Details
function getContact($id) {
	$sql = "call GetContact(:p_Id)";
	try {
		$db = DB_Connection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam(':p_Id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		$db = null;
		echo json_encode($result);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

//Update contact Details
function updateContact($id) {
	$request = Slim::getInstance()->request();
	$cont = json_decode($request->getBody());

	$sql = "call UpdateContact(:p_Id, :p_name, :p_phone, :p_address)";
	try {
		$db = DB_Connection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam(':p_Id', $id, PDO::PARAM_INT);
		$stmt->bindParam(':p_name',$cont->name,PDO::PARAM_STR,30);
		$stmt->bindParam(':p_phone',$cont->phone,PDO::PARAM_STR,15);
		$stmt->bindParam(':p_address',$cont->address,PDO::PARAM_STR,100);
		$stmt->execute();
		$db = null;
		echo json_encode($cont); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

//DELETE contact From the Database
function deleteContact($id) {
	
	$sql = "call DeleteContact(:p_Id)";
	try {
		$db = DB_Connection();
		$stmt = $db->prepare($sql); 
		$stmt->bindParam(':p_Id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$db = null;
		echo json_encode($id);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

?>