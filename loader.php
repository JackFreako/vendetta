<?php

/*This file will include the config.php and function.php and create a connection to the DB*/

require_once('config.php');
require_once('function.php');

$conn = mysql_connect(DB_HOST, DB_USER,DB_PASSWORD);

if(!mysql_select_db(DB_DATABASE)){
	print "Not connected with DB!";
}

?>