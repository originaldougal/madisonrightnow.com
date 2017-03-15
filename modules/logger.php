<?php

include_once('functions.php');

//ASSIGN VARIABLES TO USER INFO
$time = date("M j G:i:s Y"); 
$ip = getenv('REMOTE_ADDR');
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$userAgent = getenv('HTTP_USER_AGENT');
$referrer = getenv('HTTP_REFERER');
$query = getenv('QUERY_STRING');
 
//COMBINE VARS INTO OUR LOG ENTRY
$msg = $hostname . "\t" . $ip . "\t" . $time . "\t" . $referrer . "\t" . $query . "\t" . $userAgent;
 
//CALL OUR LOG FUNCTION
writeToLogFile($msg);

?>