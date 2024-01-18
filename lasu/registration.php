<?php
	// Include the "connection.php" file to establish a database connection.
	include ("connection.php");
	
	// Check if the "register" action has been initiated through a submit button.
	if(isset($_POST['register']))
	{
		// Retrieve data from the submitted form and store it in variables.
		// Variable declaration.
		$name=$_POST['name'];
		$matric=$_POST['username'];
		$user_email=$_POST['email'];
		$user_password=$_POST['password'];
		
		// Perform data validation for each input field.
		if($name=='') // Check if the name field is empty
		{
			echo "<script>alert ('check for errors pls')</script>";
			echo "<script>window.open('register.php','_self')</script>";
			exit();
		}
		// Check if the matric field is empty
		if($matric=='')
		{
			echo "<script>alert ('check for errors pls')</script>";
			echo "<script>window.open('register.php','_self')</script>";
			exit();
		}
		// Check if the email field is empty
		if($user_email=='')
		{
			echo "<script>alert ('check for errors pls')</script>";
			echo "<script>window.open('register.php','_self')</script>";
			exit();
		}
		// Check if the password field is empty
		if($user_password=='')
		{
			echo "<script>alert ('check for errors pls')</script>";
			echo "<script>window.open('register.php','_self')</script>";
			exit();
		}
		// Check if the provided email already exists in the database.
		$check_email_query = "SELECT * FROM users WHERE user_email = '$user_email'";
		$run_query = mysqli_query($dbcon, $check_email_query);
		// If a row is found, it means the email is already in use.
		if (mysqli_num_rows($run_query) > 0)
		{
			echo "<script>alert('Email $user_email is already in the database')</script>";
			exit();
		}
		// Insert the user's data into the database.
		$insert_user = "INSERT INTO users(name, matric, user_email, user_password) VALUES ('$name', '$matric', '$user_email', '$user_password')";
		// If the insertion is successful
		if(mysqli_query($dbcon,$insert_user))
		{
			// Redirect to the login page upon successful registration.
			echo "<script>window.open('login.php', '_self')</script>";
		}
	}
?>