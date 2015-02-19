<?php

// THIS FUNCTION WILL STORE THE USER DETAILS IN THE DB and RETURN THE
// DETAILS OF THE USER (name, email and registrationID)

function storeUser($gcm_reg_id,$name,$email){

	//Insert into the Database
	$result = mysql_query(
				"INSERT INTO
			 	gcm_users 
			 	(gcm_regid,name,email,created_at)
				VALUES 
				('$gcm_reg_id','$name','$email',NOW())"
			);

			
	//Check for a successful commit into the DB
	if($result){
		//Get user details
		$id = mysql_insert_id();  //This gives us the last committed id of a user
		$result = mysql_query(
					"SELECT * FROM gcm_users
					WHERE id='$id'") or die(mysql_error());
						
						
		if(mysql_num_rows($result) > 0){
			return mysql_fetch_array($result);
		}
		else{
			return false;
		}
		
	}
	else{
			return false;
	}
}



// SEND PUSH NOTIFICATION FROM THE SERVER TO A REGISTERED DEVICE
function sendPushNotificaiton($registation_id,$message){

		// Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';
		
		$fields = array(
            'registration_id' => $registation_id,
            'data' => $message,
        );
		
		$headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
		
		// Open connection
        $ch = curl_init();
 
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		
		//Execute POST
		// Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
 
        // Close connection
        curl_close($ch);
        echo $result;
}

/* 
*  These are utility functions
*  	1. Get All Users From the Database
*  	2. Checking if a user RegID is already stored in the DB
*   3. Get user detail using email
*/


//Get all Registered User in the DB
function getAllUsers(){

$result = mysql_query(
					"SELECT * FROM gcm_users"					
					) or die(mysql_error());
return $result;			
}


/* Check if a user is already registered using his email */
function isUserInDatabase($email){

$result = mysql_query(
					"SELECT * FROM gcm_users
					WHERE email='$email'"
					) or die(mysql_error());
					
	$numOfRows = mysql_num_rows($result);
	if($numOfRows > 0){
		//user Exists
		return true;
	}
	else{
		//user does not exist
		return false;
	}
}

/*
*  Get user by email
*/
function getUserByEmail($email){

$result = mysql_query(
					"SELECT * FROM gcm_users
					WHERE email='$email' LIMIT 1"
					) or die(mysql_error());
return $result;					
}

?>