<?php
require_once("inc/config.php");
$login = new Login();
if (isset($_POST['teacher_log'])) {
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$login->checklog(1, $user, $pass);
}
if (isset($_POST['student_log'])) {
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$login->checklog(2, $user, $pass);
}
if (isset($_POST['parent_log'])) {
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$login->checklog(3, $user, $pass);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/theme.css">
	<title>Gantt School</title>
	<script type="text/javascript" src="js/login.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

  </head>
  <body>
     <div class="container">
    
      
		<!--<nav class="navbar navbar-expand-md bg-dark navbar-dark">
		  Brand 
		  <a class="navbar-brand" href="#">Gantt School</a>

		  Toggler/collapsibe Button 
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		  </button>

		   Navbar links
		  <div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav">
			  <li class="nav-item">
				<a class="nav-link" href="#">Link</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="#">Link</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="#">Link</a>
			  </li>
			</ul>
		  </div>
		</nav>-->
          <!--<div class="col-4 text-center">
          aaa
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
            aaaa
          </div>-->
		<!--<div class="card">
		  <div class="card-header">SkyNet App</div>-->
		  <div class="card-body">
		  <div class="text-center">
			<h1>Gantt School</h1><label>Work according to schedule</label>
			<hr>
			<div class="row">
			<div class="col-12 chieucao_tudong">	
			<h3>Sign in</h3><br>
				<div id="login_home">
				<div class="text-center">
					<button type="button" class="btn btn-danger btn-block btn-lg" onClick="logClick(1)">Teacher</button><br>
					<button type="button" class="btn btn-success btn-block btn-lg" onClick="logClick(2)">Student</button><br>
					<button type="button" class="btn btn-warning btn-block btn-lg" onClick="logClick(3)">Parents</button>
				</div>
				</div>
			</div>
			</div>
		  </div><hr>
		  <div class=" text-center">© 2020 Gantt School</div>
		

      
	  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
  </body>
</html>