function logClick(number) {
	var form_action = '<form id="form_post" method="post" autocomplete="off">';
	var form_log = '<form  method="post" autocomplete="off">\
	<div class="form-group text-left">\
    <label>Username</label>\
    <input type="text" name="user" class="form-control"  autocomplete="off" aria-describedby="userHelp" placeholder="Enter your user">\
    <small id="userHelp" class="form-text text-muted">Accounts provided by your organization.</small>\
  </div>\
  <div class="form-group text-left">\
    <label for="password">Password</label>\
    <input type="password" name="pass" autocomplete="off" class="form-control" id="password" placeholder="Password">\
  </div>';
  var form_bt1 = '<button type="submit" name="teacher_log" class="btn btn-primary">Login</button>';
  var form_bt2 = '<button type="submit" name="student_log" class="btn btn-primary">Login</button>';
  var form_bt3 = '<button type="submit" name="parent_log" class="btn btn-primary">Login</button>';
  var form_end = '<button class="btn btn-warning" onClick="logClick(4)">Change</button>\
</form>';
	var log_section = '<div class="text-center">\
					<button type="button" class="btn btn-danger btn-block btn-lg" onClick="logClick(1)">Teacher</button><br>\
					<button type="button" class="btn btn-success btn-block btn-lg" onClick="logClick(2)">Student</button><br>\
					<button type="button" class="btn btn-warning btn-block btn-lg" onClick="logClick(3)">Parents</button>\
				</div>';
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

//Post login

 
