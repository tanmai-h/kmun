<?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'kmun18user');
	define('DB_PASSWORD', 'kmun!@#$');
	define('DB_NAME', 'kmun18');
	define('LOGIN_TABLE', 'users');
	
	try {
		$pdo = new PDO("mysql:host=" .DB_SERVER. "; dbname=" .DB_NAME, DB_USERNAME, DB_PASSWORD);
		$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
		
	}
	catch(PDOException $error) {
		echo $error->getMessage();
	}
	//$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);	
?>