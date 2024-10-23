<?php
$GLOBALS['_servername'] = "localhost";
	$GLOBALS['_username'] = "root";
	$GLOBALS['_password'] = "AgbmpG0HHHXwi906";
	$GLOBALS['_dbname'] = "cp_service_sms";
	$GLOBALS['conn'] = new mysqli($GLOBALS['_servername'], $GLOBALS['_username'], $GLOBALS['_password'], $GLOBALS['_dbname']);
	if ($conn->connect_error)
	 {
	    die("Connection failed: " . $conn->connect_error);
	    mysql_error();
	 } 

?>