<?php
header('Access-Control-Allow-Credentials: true');

header('Access-Control-Max-Age: 86400'); // cache for 1 day

header('Access-Control-Allow-Origin: *');

header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

header('Content-Type: application/json');

?>
