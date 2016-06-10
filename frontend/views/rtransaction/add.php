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

if(isset($_POST['phone'])){
require 'conn.php';


// Create connection
$conn = new mysqli($dns, $user, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


	  /*$customerName=$connection->createCommand("SELECT CustomerName,CustomerAddress from customer WHERE CustomerPhone=".$_POST['phone'])->queryAll();*/
	  $quary=mysql_query("SELECT CustomerName,CustomerAddress from rcustomer WHERE CustomerPhone='". mysql_real_escape_string(trim($_POST['phone']))."'");
	 // $result = $conn->query($sql);

	  
	 /*echo (mysql_num_rows($quary)!=0) ? mysql_result($quary, 0,'CustomerName') : "Name not fond";*/
if(mysql_num_rows($quary) > 0){
	
//echo "find";

}else{
	$add="INSERT INTO rcustomer VALUES (' ','". mysql_real_escape_string(trim($_POST['name']))."','". mysql_real_escape_string(trim($_POST['phone']))."','". mysql_real_escape_string(trim($_POST['address']))."'".')';

	if (mysqli_query($conn, $add)) {
  //  echo "New record created successfully";
} else {
 // echo "Error: " . $add . "<br>" . mysqli_error($conn);
/*
if ($conn->query($add) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $add . "<br>" . $conn->error;
}


$conn->close();
*/

}
}



}