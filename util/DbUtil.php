<?php

namespace com\numeracy\util;

use PDO;
/*
 * As you can see, we are using PDO for database access. There are a lot of benefits of using PDO. One of the most significant benefits is that it provides a uniform method of access to multiple databases.

To use this class, you will need to supply correct values for $dbName, $dbHost, $dbUsername, $dbUserPassword.

$dbName: Database name which you use to store 'customers' table.
$dbHost: Database host, this is normally "localhost".
$dbUsername: Database username.
$dbUserPassword: Database user's password.

Let us take a look at three functions of this class:

__construct(): This is the constructor of class Database. Since it is a static class, initialization of this class is not allowed. To prevent misuse of the class, we use a "die" function to remind users.

connect: This is the main function of this class. It uses singleton pattern to make sure only one PDO connection exist across the whole application. Since it is a static method. We use Database::connect() to create a connection.

disconnect: Disconnect from database. It simply sets connection to NULL. We need to call this function to close connection.


 */

/**
 * 
 * @author avijaya8
 *
 */
class DbUtil {
	
	private static $dbName = 'numeracy' ;
	private static $dbHost = 'localhost' ;
	private static $dbUsername = 'vijay';
	private static $dbUserPassword = 'Zaq12wsx';
	private static $cont = null;

	/**
	 * 
	 */
	public function __construct() {
		die('Init function is not allowed');
	}

	/**
	 * 
	 * @return COnnection object  ($cont)
	 */
	public static function connect() {
		// One connection through whole application
		if ( null == self::$cont ) {
			try { 
				self::$cont = new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
				
				self::$cont->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		} 
		
		return self::$cont;
	} 
	
	/**
	 * 
	 */
	public static function disconnect() {
		self::$cont = null;
	}
	
} 

?>

