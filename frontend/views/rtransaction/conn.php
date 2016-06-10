<?php
/*
$user_name = "dealt3_raj";  
$password = "5dN5nh&eMd(vCR$dzk";  
$database = "dealt3_raj_test";  
$server = "examplewebserver.CO.UK";  
$db_handle = mysql_connect($server, $user_name, $password);  
$db_found = mysql_select_db($database, $db_handle);  
*/

$dsn = 'db4free.net:port=3306';
$user = 'samissam';
$password = 'Sa449954';
$database='cashierdb';
/*$conn = mysql_connect($dbhost, $dbuser, $dbpass)*/
$conn= mysql_connect($dsn,$user,$password);
mysql_select_db($database);