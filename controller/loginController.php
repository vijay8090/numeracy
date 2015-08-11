<?php

//session_start(); // Starting Session

include_once '../util/CrossBrowserHead.php';
include_once '../util/DbUtil.php';

use com\numeracy\util\DbUtil;


$error='test'; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['inputEmail']) || empty($_POST['inputPassword'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['inputEmail'];
$password=$_POST['inputPassword'];

$username = stripslashes($username);
$password = stripslashes($password);
//$username = mysql_real_escape_string($username);
//$password = mysql_real_escape_string($password);
$tableName = "";

$pdo = DbUtil::connect();

$sql = "SELECT M14LOGINID, USERNAME, PASSWORD, CREATEDON, CREATEDBY, MODIFIEDON, MODIFIEDBY FROM M14_LOGIN where username='".$username."' AND password= '".$password."' ORDER BY M14LOGINID DESC ";

//$sql = "select * from login where username='".$username."' AND password= '".$password."' ";


//$sql = "select table_name from information_schema.tables where table_schema='numeracy'";
	
//$sql ="DESCRIBE   numeracy.m01_user";

$values= $pdo->query($sql) ;

/* $stmt = $pdo->prepare($sql);

$stmt->execute(array($username,$password));

$row = $stmt->fetch(PDO::FETCH_ASSOC); */
if($values != null){
	
	if (is_array($values) || is_object($values))
	{
			
		foreach ($values as $row) {
				
			$tableName = $row['USERNAME'];
			
		}
		
	}
	
	
	
if ($tableName == $username) {
	$_SESSION['login_user']=$username; // Initializing Session
	header("location: ../view/index.php"); // Redirecting To Other Page
} else {
	$error = "Username or Password is invalid";
}
}  else {
	$error = "Username or Password is invalid";
}


DbUtil::disconnect();


/* 
//$error = "Username or Password is invalid".$password.$password;
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "vijay", "Zaq12wsx");
// To protect MySQL injection for Security purpose

// Selecting Database
$db = mysql_select_db("company", $connection);
// SQL query to fetch information of registerd users and finds user match.
$query = mysql_query(, $connection); */
/* $rows = mysql_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session
header("location: ../view/index.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
mysql_close($connection); // Closing Connection */
}
}

echo $error;

?>