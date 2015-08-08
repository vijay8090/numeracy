<?php
header ( 'Access-Control-Allow-Credentials: true' );

header ( 'Access-Control-Max-Age: 86400' ); // cache for 1 day

header ( 'Access-Control-Allow-Origin: *' );

header ( "Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept" );

header ( 'Content-Type: application/json' );

?>

<?php

//ob_start ();


$data = json_decode ( file_get_contents ( "php://input" ) );

$myusername = $data->username;

$mypassword = $data->password;

/* $myusername = stripslashes ( $myusername );

$mypassword = stripslashes ( $mypassword );

$myusername = mysql_real_escape_string ( $myusername );

$mypassword = mysql_real_escape_string ( $mypassword ); */


if ($myusername == 'admin@numeracy.com'  && $mypassword=='Zaq12wsx') {
	
	echo '{"message":" Login Success ' . $myusername . '"}';
	
} 

else {
	
	echo '{"message":"Wrong Username or Password"}';
}

//ob_end_flush ();

?>

