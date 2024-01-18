<?php
	session_start();
	if(!$_SESSION['email'])
	{
		header('Location:login.php');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Attendance Page</title>
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
					<a class="navbar-brand" href="#">CSC</a>
				</div>
				<div class="container">
					<ul class="nav navbar-nav navbar-right">
					<li><a href="index.html">Home</a></li>
					<a class="btn btn-danger active" href="./logout.php" target="_self" role="button">Logout</a>
					</ul>
				</div>
			</div>
		</nav>
		<section id="home" style="background: url(images/att.png); background-size: 100% 100%;" class="cl_white text-center">
			<h1>Student's Page</h1>
			<p>Welcome
			<?php
				if (isset($_SESSION["student_name"])) 
				{
					echo $_SESSION["student_name"];
				}
            ?>
			</p>
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="page-header">
								<h4> Attendance </h4>
							</div>
							<form class="col-md-8 col-md-offset-2" role="form" action="" method="post">
								<div class="form-group"> Student Name:
									<input class="form-control" type="text" id="student_name" name="student_name">
								</div>
								<div class="form-group"> Matric:
									<input class="form-control" type="number" id="matric" name="matric">
								</div>
								<div class="form-group"> Course:
									<input class="form-control" type="text" id="course" name="course">
								</div>								
								<div class="form-group"><input class="btn btn-success btn-block" name="submit" type="submit"></div>
							</form>							
						</div>						
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
// Create a connection
include("connect-db.php");

if (isset($_POST['submit'])) {
    $student_name = htmlspecialchars($_POST["student_name"]);
    $matric = htmlspecialchars($_POST["matric"]);
    $course = htmlspecialchars($_POST["course"]);    

    if ($student_name == '' || $matric == '') {
        $server = "Error: please enter your name and matric number";
    } else {
        $stmt = $pdo->prepare("INSERT INTO attendance (student_name, matric, course) VALUES (?, ?, ?)");

        try {
            $stmt->execute([$student_name, $matric, $course]);
            echo "<script>alert('Attendance Taken')</script>";
        } catch (PDOException $e) {
            echo "Error: please try again" . $e->getMessage();
        }
    }
    // } else {
//     renderForm('', '', '');
// 
}
?>