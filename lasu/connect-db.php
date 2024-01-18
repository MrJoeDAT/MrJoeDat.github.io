<?php
	// Define the server, database, username, and password for the database connection
	$server = "localhost";
	$db = "lasu";
	$user = "root";
	$pass = "";
	
	try {
		// Create a new PDO (PHP Data Objects) instance to establish a database connection
		$pdo = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
		// Set an attribute to handle errors by throwing exceptions
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} 
	catch (PDOException $e) {
		// If a PDOException occurs (connection failure), print an error message
		die("Connection failed: " . $e->getMessage());
	}
?>