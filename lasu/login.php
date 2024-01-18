<?php
	// Start a new PHP session, which is used to store and manage user data across multiple pages.
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Title of the web page -->
		<title>Login Page</title>
		<!-- Link to the Bootstrap CSS stylesheet -->
		<link rel="stylesheet" href="css/bootstrap.css" />
		<!-- JavaScript libraries for Bootstrap and jQuery -->
		<script src ="js/bootstrap.js"></script>
		<script src ="js/jquery.js"></script>
	</head>
	<style>
		.cl_white{
			color: white;
		}
	section {
		width: 100vw;
		height: 100vh;
		padding: 50px;
	}
	</style>
	
	<body>
		<!-- Navigation bar -->
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">StudentPage</a> <!-- Brand name in the navigation bar -->
					<div class="divider"></div> <!-- Add a decorative divider -->
				</div>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.html">Home</a></li> <!-- Navigation links -->
					<li><a href="register.php">Register</a></li>
					<li class="active"><a href="login.php">Login</a></li>
					<li><a href="member_page.php">Attendance</a></li>
				</ul>
			</div>
		</nav>
		<!-- Section with background image and white text -->
		<section id="home" style="background: url(images/lg.png); background-size: 100% 100%;" class="cl_white text-center">
			<div class="container">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="page-header"><h3> Login</h3></div>
						<form role="form" action="login.php" method="post" class="col-md-8 col-md-offset-2">
							<div class="form-group"> Email:
								<input class="form-control" placeholder="Your email" name="email" type="email">
							</div>
							<div class="form-group"> Password:
								<input class="form-control" placeholder="Password" name="password" type="password">
							</div>
							<div class="form-group"><input class="btn btn-success btn-block" value="Login" name="login" type="submit"></div>
						</form>
					</div>
					<div class="col-md-3"></div>
				</div>
			</div>
		</section>
		
	<!-- Footer section -->
	<footer class="navbar navbar-default navbar-fixed-botton">
		<div class="container">
			<p class="text-center" style="padding: 12px;">We are LASU we are GREAT!</p>
		</div>
	</footer>
		
	</body>
</html>

<?php
	// Include a PHP script named "connection.php" to establish a database connection.
	include("connection.php");
	// Check if the "login" form has been submitted.
	if(isset($_POST['login']))
	{
		// Get the user's email and password from the form.
		$user_email=$_POST['email'];		
		$user_password=$_POST['password'];
		
		// Construct a SQL query to check if a user with the provided email and password exists in the database.
		$check_user="select * from users WHERE user_email='$user_email' AND user_password='$user_password'";
		// Execute the SQL query.
		$run=mysqli_query($dbcon, $check_user);
		
		// Check if there are any rows returned from the database query, indicating a successful login.
		if(mysqli_num_rows($run))
		{
			// Redirect the user to "member_page.php" upon successful login.
			echo "<script>window.open('member_page.php', '_self')</script>";
			// Store the user's email in a session variable for later use.
			$_SESSION['email']=$user_email;
		}
		else
		{
			// Display an alert if the login credentials are incorrect.
			echo "<script>alert('Kindly check your Login Credentials')</script>";
		}
	}
?>