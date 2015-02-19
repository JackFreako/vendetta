<?php

require_once('loader.php');

// return json response 
$json = array();

$userName = $_POST["name"];
$userEmail = $_POST["email"];

// GCM Registration ID got from device
$gcmRegID  = $_POST["regId"]; 

/**
 * Registering a user device in database
 * Store reg id in users table
 */
	if(isset($gcmRegID)&& isset($userEmail) && isset($userName )){
		
		$res = storeUser($gcmRegID,$userName,$userEmail);
		$registatoin_ids = array($gcmRegID);
		$message = array("product" => "shirt");
 
		$result = send_push_notification($registatoin_ids, $message);
 
		echo $result;
	}
	
	else{//user detail not found}

?>