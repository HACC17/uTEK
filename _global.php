<?php
date_default_timezone_set('Pacific/Honolulu');

$sqlHost = 'localhost';
$sqlUser = 'thtse_hacc'; 
$sqlPass = 'fk230230';
$sqlDatabase = 'thtse_hacc'; 

$conn = mysql_connect($sqlHost, $sqlUser, $sqlPass)
	or die("Couldn't connect to MySQL server on $sqlHost: " . mysql_error() . '.');

$db = mysql_select_db($sqlDatabase, $conn)
	or die("Couldn't select database $sqlDatabase: " . mysql_error() . '.');
	
?>