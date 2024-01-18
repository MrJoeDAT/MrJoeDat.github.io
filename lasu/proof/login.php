<?php
	session_start();// session starts here
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login Page</title>
		<link rel="stylesheet" href="css/bootstrap.css" />
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
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">StudentPage</a>
				</div>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.html">Home</a></li>
					<li><a href="register.php">Register</a></li>
					<li class="active"><a href="login.php">Login</a></li>
					<li><a href="member_page.php">Attendance</a></li>
				</ul>
			</div>
		</nav>
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
		
	<footer class="navbar navbar-default navbar-fixed-botton">
		<div class="container">
			<p class="text-center" style="padding: 12px;">We are LASU we are GREAT!</p>
		</div>
	</footer>
		
	</body>
</html>

<?php
	include("connection.php");
	if(isset($_POST['login']))
	{
		$user_email=$_POST['email'];
		$user_password=$_POST['password'];
		
		$check_user="select * from users WHERE user_email='$user_email' AND user_password='$user_password'";
		$run=mysqli_query($dbcon, $check_user);
		
		if(mysqli_num_rows($run))
		{
			echo "<script>window.open('member_page.php', '_self')</script>";
			$_SESSION['email']=$user_email;
		}
		else
		{
			echo "<script>alert('Kindly check your Login Credentials')</script>";
		}
	}
?>