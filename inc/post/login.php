<?php
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
			echo '<script> alert("Login with '.$row['name'].'!");</script>';
		} else {
			//Can't login, do something...
			echo '<script> alert("Fail!");</script>';
		}
	}
}