<?php //File Post chuc nang
class Login extends Init {
	function checklog($type, $user, $pass) {
		//Check type login (Teacher, Student, Parent)
		if ($type == 1) { //Login with Teacher
		$check_log = $this->db->query("SELECT * FROM teacher WHERE username = '$user' and password = '$pass'");
		}
		if ($type == 2) { //Login with Student
		$check_log = $this->db->query("SELECT * FROM student WHERE username = '$user' and password = '$pass'");
		}
		if ($type == 3) { //Login with Parents
		$check_log = $this->db->query("SELECT * FROM parent WHERE username = '$user' and password = '$pass'");
		}
		if($check_log->num_rows == 1) {
			//Login success, do something...
			$row = $check_log->fetch_assoc();	
			//echo '<script> alert("Login with '.$row['name'].'!");</script>';
			//echo '<script>document.getElementById("main_app").innerHTML =  "Hello";</script>';
			switch ($type) {
				case 1:
					if (!isset($_SESSION['teacher_log'])) {
						$_SESSION['teacher_log'] = $row['name'];
						$_SESSION['teacher_user'] = $row['username'];
					}
					break;
				case 2:
					if (!isset($_SESSION['student_log'])) {
						$_SESSION['student_log'] = $row['name'];
						$_SESSION['student_log'] = $row['username'];
					}
					break;
				case 3:
					if (!isset($_SESSION['parent_log'])) {
						$_SESSION['parent_log'] = $row['name'];
						$_SESSION['parent_log'] = $row['username'];
					}
					break;
			}
			echo 1;
			//Khuc nay se echo Javascript
		} else {
			//Can't login, do something...
			echo 0;
		}
	}
}