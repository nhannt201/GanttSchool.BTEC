function logClick(number) {
	var form_action = '<form action="" id="form_post" method="post" autocomplete="off">';
	var form_log = '<form action="" method="post" autocomplete="off">\
	<div class="form-group text-left">\
    <label>Username</label>\
    <input type="text" class="form-control"  autocomplete="off" aria-describedby="userHelp" placeholder="Enter your user">\
    <small id="userHelp" class="form-text text-muted">Accounts provided by your organization.</small>\
  </div>\
  <div class="form-group text-left">\
    <label for="password">Password</label>\
    <input type="password" autocomplete="off" class="form-control" id="password" placeholder="Password">\
  </div>\
  <button type="submit" class="btn btn-primary">Login</button>\
  <button class="btn btn-warning" onClick="logClick(4)">Change</button>\
</form>';
	var log_section = '<div class="text-center">\
					<button type="button" class="btn btn-danger btn-block btn-lg" onClick="logClick(1)">Teacher</button><br>\
					<button type="button" class="btn btn-success btn-block btn-lg" onClick="logClick(2)">Student</button><br>\
					<button type="button" class="btn btn-warning btn-block btn-lg" onClick="logClick(3)">Parents</button>\
				</div>';
	switch (number) {
		case 1:
			document.getElementById("login_home").innerHTML = form_action + form_log;
			break;
		case 2:
			document.getElementById("login_home").innerHTML = form_action + form_log;
			break;
		case 3:
			document.getElementById("login_home").innerHTML = form_action + form_log;
			break;
		case 4:
			document.getElementById("login_home").innerHTML = log_section;
			break;
	}
	
}

//Post login

 
