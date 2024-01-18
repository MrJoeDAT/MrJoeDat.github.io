<!DOCTYPE html>
<html>
	<head>
		<!-- Title of the web page -->
		<title>Register Page</title>
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
				</div>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.html">Home</a></li>
					<li class="active"><a href="register.php">Register</a></li>
					<li><a href="login.php">Login</a></li>
					<li><a href="member_page.php">Attendance</a></li>
				</ul>
			</div>
		</nav>
		<!-- Section with background image and white text -->
		<section id="home" style="background: url(images/reg.png); background-size: 100% 100%;" class="cl_white text-center">
			<div class="container">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="page-header"><h3> Register</h3></div>
						<form class="col-md-8 col-md-offset-2" role="form" method="post" action="./registration.php">
							<div class="form-group"> Name:
								<input class="form-control" placeholder="Full Name" name="name" type="text">
							</div>
							<div class="form-group"> Matric:
								<input class="form-control" placeholder="Your Matric Number" name="username" type="number">
							</div>
							<div class="form-group"> Email:
								<input class="form-control" placeholder="Your Mail" name="email" type="email">
							</div>
							<div class="form-group"> Password:
								<input class="form-control" placeholder="Password" name="password" type="password">
							</div>
							<div class="form-group"><input class="btn btn-success btn-block" value="Register" name="register" type="submit"></div>
						</form>
					</div>
					<div class="col-md-3"></div>
				</div>
			</div>
		</section>
		
	<!-- Footer section -->
	<footer class="navbar navbar-default navbar-fixed-botton">
		<div class="container">
			<p class="text-center" style="padding: 12px;">We are LASU we are GREAT</p>
		</div>
	</footer>
		
	</body>
</html>