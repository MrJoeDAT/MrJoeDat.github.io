<?php
	include ("connection.php"); //where we make connection
	
	if(isset($_POST['register']))//notifies action initiated through submit button
	{
		//variable declaration
		$name=$_POST['name'];
		$matric=$_POST['username'];
		$user_email=$_POST['email'];
		$user_password=$_POST['password'];
		
		//validation
		if($name=='')
		{
			echo "<script>alert ('check for errors pls')</script>";
			echo "<script>window.open('register.php','_self')</script>";
			exit();
		}
		if($matric=='')
		{
			echo "<script>alert ('check for errors pls')</script>";
			echo "<script>window.open('register.php','_self')</script>";
			exit();
		}
		if($user_email=='')
		{
			echo "<script>alert ('check for errors pls')</script>";
			echo "<script>window.open('register.php','_self')</script>";
			exit();
		}
		if($user_password=='')
		{
			echo "<script>alert ('check for errors pls')</script>";
			echo "<script>window.open('register.php','_self')</script>";
			exit();
		}
		//checking for double registration
		$check_email_query = "SELECT * FROM users WHERE user_email = '$user_email'";
		$run_query = mysqli_query($dbcon, $check_email_query);
		if (mysqli_num_rows($run_query) > 0)
		{
			echo "<script>alert('Email $user_email is already in the database')</script>";
			exit();
		}
		//now we insert our values in the database
		$insert_user = "INSERT INTO users(name, matric, user_email, user_password) VALUES ('$name', '$matric', '$user_email', '$user_password')";
		if(mysqli_query($dbcon,$insert_user))
		{
			echo "<script>window.open('login.php', '_self')</script>";
		}
	}
?>