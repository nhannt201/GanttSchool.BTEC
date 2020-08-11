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
     <div class="container" id="full_page">
    
		  <div class="card-body">
		  <div class="text-center">
			<h1>Gantt School</h1><label>Work according to schedule</label>
			<hr>
			<div id="main_app">
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
			</div>
		  </div><hr>
		  <div class=" text-center">© 2020 Gantt School</div>
			<?php
		session_start();
		if (isset($_SESSION['teacher_log'])) {
			echo '<script type="text/javascript">
			document.getElementById("full_page").innerHTML =  main_teacher_tab + tab_t1 + tab_t2 + tab_t3 + close_t_tab;
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				
			  if (this.readyState == 4 && this.status == 200) {
				document.getElementById("welcome_to").innerHTML = "Welcome, " + this.responseText + "!";
			  }
			};
			xhttp.open("GET", "get/getName.php", true);
			xhttp.send();
			</script>';
		}
		
		if (isset($_SESSION['student_log'])) {
			echo '<script type="text/javascript">
			document.getElementById("full_page").innerHTML =  main_student_tab + tab_s1 + tab_s2 + tab_s3 + close_s_tab;
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				
			  if (this.readyState == 4 && this.status == 200) {
				document.getElementById("welcome_to").innerHTML = "Welcome, " + this.responseText + "!";
			  }
			};
			xhttp.open("GET", "get/getName.php", true);
			xhttp.send();
			</script>';
		}
		if (isset($_SESSION['parent_log'])) {
			
		}
	?>

      
	  </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
  </body>
</html>