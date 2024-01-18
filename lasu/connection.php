<?php
	$dbcon = mysqli_connect("localhost", "root", "");
	mysqli_select_db($dbcon, "lasu");
?>

<?php
	// Establish a connection to the MySQL database server running on "localhost" with the username "root" and an empty password. 
	$dbcon = mysqli_connect("localhost", "root", "");
	// Select the "lasu" database using the established database connection. 
	mysqli_select_db($dbcon, "lasu");
?>