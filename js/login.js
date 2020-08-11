	//Khu vuc form log
	var form_log = '<div id="form_log">\
		<div class="form-group text-left">\
		<label>Username</label>\
		<input type="text" name="user" id="username" class="form-control"  autocomplete="off" aria-describedby="userHelp" placeholder="Enter your user">\
		<small id="userHelp" class="form-text text-muted">Accounts provided by your organization.</small>\
	  </div>\
	  <div class="form-group text-left">\
		<label for="password">Password</label>\
		<input type="password" name="pass" id="password" autocomplete="off" class="form-control" id="password" placeholder="Password">\
	  </div>';
  var form_bt1 = '<button onClick="waitLog(1)" name="teacher_log" class="btn btn-primary">Login</button>'; // type="submit"
  var form_bt2 = '<button onClick="waitLog(2)" name="student_log" class="btn btn-primary">Login</button>';
  var form_bt3 = '<button onClick="waitLog(3)" name="parent_log" class="btn btn-primary">Login</button>';
  var form_end = '<button class="btn btn-warning" onClick="logClick(4)">Change</button>\
</div>';
	var log_section = '<div class="text-center">\
					<button type="button" class="btn btn-danger btn-block btn-lg" onClick="logClick(1)">Teacher</button><br>\
					<button type="button" class="btn btn-success btn-block btn-lg" onClick="logClick(2)">Student</button><br>\
					<button type="button" class="btn btn-warning btn-block btn-lg" onClick="logClick(3)">Parents</button>\
				</div>';
	//Khu vuc chuc nang cua student.
	var main_student_tab = '<div class="container mt-3">\
	  <h2>Gantt School</h2>\
	  <div id="welcome_to"></div>\
	  <br>\
	  <ul class="nav nav-tabs">\
		<li class="nav-item">\
		  <a class="nav-link active" data-toggle="tab" href="#home">My Job</a>\
		</li>\
		<li class="nav-item">\
		  <a class="nav-link" data-toggle="tab" href="#menu1">Manager</a>\
		</li>\
		<li class="nav-item">\
		  <a class="nav-link" data-toggle="tab" href="#menu2">My User</a>\
		</li>\
	  </ul>';
	 var tab_s1 = '<div class="tab-content">\
		<div id="home" class="container tab-pane active"><br>\
		 <div class="list-group">\
		  <button type="button" class="list-group-item list-group-item-action">\
			Cras justo odio\
			<span class="badge badge-primary badge-pill">14</span>\
		  </button>\
		  <button type="button" class="list-group-item list-group-item-action">Dapibus ac facilisis in <span class="badge badge-primary badge-pill">14</span></button>\
		  <button type="button" class="list-group-item list-group-item-action">Morbi leo risus</button>\
		  <button type="button" class="list-group-item list-group-item-action">Porta ac consectetur ac</button>\
		  <button type="button" class="list-group-item list-group-item-action" disabled>Vestibulum at eros</button>\
		</div>\
		</div>';
	var tab_s2 = '<div id="menu1" class="container tab-pane fade"><br>\
		  <h3>Menu 1</h3>\
		  <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\
		</div>';
	var tab_s3 = '<div id="menu2" class="container tab-pane fade"><br>\
		  <div class="float-right"><button onClick="logout()" class="btn btn-danger">Logout</button></div>\
		</div>';
	var close_s_tab = '</div>\
	</div>';
	
	//Khu vuc chuc nang cua Teacher.
	var main_teacher_tab = '<div class="container mt-3">\
	  <h2>Gantt School</h2>\
	  <div id="welcome_to"></div>\
	  <br>\
	  <ul class="nav nav-tabs">\
		<li class="nav-item">\
		  <a class="nav-link active" data-toggle="tab" href="#home">New Job</a>\
		</li>\
		<li class="nav-item">\
		  <a class="nav-link" data-toggle="tab" href="#menu1">Manager</a>\
		</li>\
		<li class="nav-item">\
		  <a class="nav-link" data-toggle="tab" href="#menu2">My User</a>\
		</li>\
	  </ul>';
	 var tab_t1 = '<div class="tab-content">\
		<div id="menu1" class="container tab-pane fade"><br>\
		 <div class="list-group">\
		  <button type="button" class="list-group-item list-group-item-action">\
			Cras justo odio\
			<span class="badge badge-primary badge-pill">14</span>\
		  </button>\
		  <button type="button" class="list-group-item list-group-item-action">Dapibus ac facilisis in <span class="badge badge-primary badge-pill">14</span></button>\
		  <button type="button" class="list-group-item list-group-item-action">Morbi leo risus</button>\
		  <button type="button" class="list-group-item list-group-item-action">Porta ac consectetur ac</button>\
		  <button type="button" class="list-group-item list-group-item-action" disabled>Vestibulum at eros</button>\
		</div>\
		</div>';
	var tab_t2 = '<div id="home" class="container tab-pane active"><br>\
		  <h3>Menu 1</h3>\
		  <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\
		</div>';
	var tab_t3 = '<div id="menu2" class="container tab-pane fade"><br>\
		  <div class="float-right"><button onClick="logout()" class="btn btn-danger">Logout</button></div>\
		</div>';
	var close_t_tab = '</div>\
	</div>';

function logClick(number) {
	//var form_action = '<form id="form_post" method="post" autocomplete="off">';
	switch (number) {
		case 1:
			document.getElementById("login_home").innerHTML =  form_log + form_bt1 + form_end;
			break;
		case 2:
			document.getElementById("login_home").innerHTML = form_log + form_bt2 + form_end;
			break;
		case 3:
			document.getElementById("login_home").innerHTML =  form_log + form_bt3 + form_end;
			break;
		case 4:
			document.getElementById("login_home").innerHTML = log_section;
			break;
	}
	
}
function reload() {
	location.reload();
}
function logout() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		
	  if (this.readyState == 4 && this.status == 200) {
		reload();
	  }
	};
	xhttp.open("GET", "get/outlog.php", true);
	xhttp.send();
}
function waitLog(type) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
	 var res = this.responseText;
	 switch (res) {
		case '0':
			document.getElementById("main_app").innerHTML =  "<h3>Cannot login!</h3><br><button class='btn btn-warning btn-block btn-lg' onClick='reload()'>Try</button>";
			break;
		case '1':
			//document.getElementById("full_page").innerHTML =  main_student;//"Login success full!";
			reload();
			break;
	 }
    } else {
		//document.getElementById("main_app").innerHTML =  "<h3>Cannot login!</h3><br><button class='btn btn-warning btn-block btn-lg' onClick='reload()'>Try</button>";
	}
  };
  xhttp.open("POST", "post/login.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var username = document.getElementById("username");
  var passs = document.getElementById("password");
  if ((username) && (passs)) {
	   var username = document.getElementById("username").value;
	   var passs = document.getElementById("password").value;
  switch (type) {
	  case 1:
		xhttp.send("user=" + username + "&pass=" + passs + "&teacher_log=submit");
		break;
	case 2:
		xhttp.send("user=" + username + "&pass=" + passs + "&student_log=submit");
		break;
	case 3:
		xhttp.send("user=" + username + "&pass=" + passs + "&parent_log=submit");
		break;
  }
  }
}
//Post login

//Json ready
/*
  var myObj = JSON.parse(this.responseText);
    document.getElementById("demo").innerHTML = myObj.pets[0].name;
*/
 
 //Main Function
 function getName() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		
	  if (this.readyState == 4 && this.status == 200) {
		document.getElementById("main_app").innerHTML = "Welcome, " + this.responseText + "!";
	  }
	};
	xhttp.open("GET", "get/getName.php", true);
	xhttp.send();
}
