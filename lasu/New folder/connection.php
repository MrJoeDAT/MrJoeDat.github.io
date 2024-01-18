<?php
	// Define the database connection details
	$host = "localhost";
	$user = "id21668675_lasuattdb";   // Your database username
	$pass = "Database.01";            // Your database password
	$db = "id21668675_lasu";          // Your database name
	
	// Establish a connection to the MySQL database server
	$dbcon = mysqli_connect($host, $user, $pass, $db);

	// Check the connection
	if (!$dbcon) {
		die("Connection failed: " . mysqli_connect_error());
	}
?>

