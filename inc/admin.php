<?php
class Admin extends Init {
	//Add
	function addNewTeacher($teacherName, $teachEmail, $teachUser, $teachPass, $teachClass, $teachSub) {
		$qr_ck = "SELECT * FROM teacher WHERE username='$teachUser'";
		$check = $this->db->query($qr_ck);
		if ($check->num_rows > 0 ) {
			echo 'Username already exists!'; 
		} else {
			//add user
			$query = "INSERT INTO teacher (name, email, username, password) VALUES ('$teacherName', '$teachEmail', '$teachUser', '$teachPass')";
			$check = $this->db->query($query);
			$teacherID = $this->db->insert_id;
			//add class
			$query_class = "INSERT INTO teacher_class (teacherID, classID, subID) VALUES ('$teacherID', '$teachClass', '$teachSub')";
			$check2 = $this->db->query($query_class);
			//add sub class
			$query_sub = "INSERT INTO teacher_subs (teacherID, subID) VALUES ('$teacherID', '$teachSub')";
			$check3 = $this->db->query($query_sub);
			echo 'Add new Teacher user success!'; 
		}
	}
	function addNewStudent($name, $email, $user, $pass, $class) {
		$qr_ck = "SELECT * FROM student WHERE username='$user'";
		$check = $this->db->query($qr_ck);
		if ($check->num_rows > 0 ) {
			echo 'Username already exists!'; 
		} else {
			//add user
			$query = "INSERT INTO student (name, email, username, password) VALUES ('$name', '$email', '$user', '$pass')";
			$check = $this->db->query($query);
			$studentID = $this->db->insert_id;
			//add class
			$query_class = "INSERT INTO student_class (studentID, classID) VALUES ('$studentID', '$class')";
			$check2 = $this->db->query($query_class);
			echo 'Add new Student user success!';
		}
	}
	function addNewParent($name, $email, $user, $pass, $class, $studentID) {
		$qr_ck = "SELECT * FROM parent WHERE username='$user'";
		$check = $this->db->query($qr_ck);
		if ($check->num_rows > 0 ) {
			echo 'Username already exists!'; 
		} else {
			//add user
			$query = "INSERT INTO parent (name, email, username, password, studentID) VALUES ('$name', '$email', '$user', '$pass', '$studentID')";
			$check = $this->db->query($query);
			$studentID = $this->db->insert_id;
			echo 'Add new Parent user success!';
		}
	}
	function addNewSubject($subID, $subName) {
		$qr_ck = "SELECT * FROM subject WHERE subID='$subID'";
		$check = $this->db->query($qr_ck);
		if ($check->num_rows > 0 ) {
			echo 'Course ID already exists!'; //Ten lop da ton tai
		} else {
			$query = "INSERT INTO subject (subID, subName) VALUES ('$subID', '$subName')";
			$check_success = $this->db->query($query);
			echo 'Add new course success!'; //Them ten lop moi
		}
	}

	function addNewClass($classname) {
		$qr_ck = "SELECT * FROM classroom WHERE className='$classname'";
		$check = $this->db->query($qr_ck);
		if ($check->num_rows > 0 ) {
			echo 'Class name already exists!'; //Ten lop da ton tai
		} else {
			$query = "INSERT INTO classroom (className) VALUES ('$classname')";
			$check_success = $this->db->query($query);
			echo 'Add new class success!'; //Them ten lop moi
		}
		
	}
	//Get
	function getClassroom($type) {
		$query = "SELECT * FROM classroom";
		$check = $this->db->query($query);
		if ($check->num_rows >0) {
			$congdon = "";
			while ($row=$check->fetch_assoc()) {
				$congdon .= '<option value="'.$row['classID'].'">'.$row['className'].'</option>';
			}
			if ($type == 1) {
				echo $congdon;
			} 
			if ($type == 0) {
				return $congdon;
			}
		} else {
				
				if ($type == 1) {
				echo '<option value="-1">No Clasroom</option>';
				} 
				if ($type == 0) {
					return '<option value="-1">No Clasroom</option>';
				}
		}
	}
	function getNameClass($classname) {
		$query = "SELECT * FROM classroom WHERE className='$classname'";
		$check = $this->db->query($query);
		if ($check->num_rows >0) {
			$row=$check->fetch_assoc();
			echo $row['classID'];
		}
	}
	
	function getSubject($type) {
		$query = "SELECT * FROM subject";
		$check = $this->db->query($query);
		if ($check->num_rows >0) {
			$congdon = "";
			while ($row=$check->fetch_assoc()) {
				$congdon .= '<option value="'.$row['subID'].'">'.$row['subName'].'</option>';
			}
			if ($type == 1) {
				echo $congdon;
			} 
			if ($type == 0) {
				return $congdon;
			}
		}
	}
	function getNameSubject($subname) {
		$query = "SELECT * FROM subject WHERE subName='$subname'";
		$check = $this->db->query($query);
		if ($check->num_rows >0) {
			$row=$check->fetch_assoc();
			echo $row['subID'];
		}
	}
	function getStudentFollowClass($classID) {
		$query = "SELECT student.name, student.studentID
		FROM student_class
		INNER JOIN student ON student_class.studentID = student.studentID
		where classID='$classID'";
		$check = $this->db->query($query);
		if ($check->num_rows >0) {
			$congdon = "";
			while ($row=$check->fetch_assoc()) {
				$congdon .= '<option value="'.$row['studentID'].'">'.$row['name'].'</option>';
			}
				echo $congdon;
		} else {
			echo '<option value="-1">(No student)</option>';
		}
	}
	function getAllTeacher($class, $type) {
		$query = "SELECT teacher.name, teacher.teacherID
		FROM teacher
		INNER JOIN teacher_class ON teacher_class.teacherID = teacher.teacherID
		WHERE classID='$class'";
		$check = $this->db->query($query);
		if ($check->num_rows >0) {
			$congdon = "";
			$array_teach[] = null;
			while ($row=$check->fetch_assoc()) {
				if  (!array_key_exists($row['teacherID'], $array_teach)) {
					array_push($array_teach, $row['teacherID']);
					$congdon .= '<option value="'.$row['teacherID'].'">'.$row['name'].'</option>';
				}		
			}
			//print_r ($array_teach);
			if ($type == 1) {
				echo $congdon;
			} 
			if ($type == 0) {
				return $congdon;
			}
		} else {
			if ($type == 1) {
				echo '<option value="-1">No Teacher</option>';
			} 
			if ($type == 0) {
				return '<option value="-1">No Teacher</option>';
			}
		}
	}
	
	function getAllStudent($class, $type) {
		$query = "SELECT * FROM student";
		$check = $this->db->query($query);
		if ($check->num_rows >0) {
			$congdon = "";
			while ($row=$check->fetch_assoc()) {
				$congdon .= '<option value="'.$row['studentID'].'">'.$row['name'].'</option>';
			}
			if ($type == 1) {
				echo $congdon;
			} 
			if ($type == 0) {
				return $congdon;
			}
		} else {
			if ($type == 1) {
				echo '<option value="-1">No Student</option>';
			} 
			if ($type == 0) {
				return '<option value="-1">No Student</option>';
			}
		}
	}
	function getAllParent($class, $type) {
		$query = "SELECT * FROM parent";
		$check = $this->db->query($query);
		if ($check->num_rows >0) {
			$congdon = "";
			while ($row=$check->fetch_assoc()) {
				$congdon .= '<option value="'.$row['parentID'].'">'.$row['name'].'</option>';
			}
			if ($type == 1) {
				echo $congdon;
			} 
			if ($type == 0) {
				return $congdon;
			}
		} else {
			if ($type == 1) {
				echo '<option value="-1">No Student</option>';
			} 
			if ($type == 0) {
				return '<option value="-1">No Student</option>';
			}
		}
	}
	
	//Update
	function upNameClass($classname, $idClass) {
		$query = "UPDATE classroom SET className='$classname' WHERE classID='$idClass'";
		$check = $this->db->query($query);
		Admin::getClassroom(1);
	}
	function upNameSubject($subName, $idSub) {
		$query = "UPDATE subject SET subName='$subName' WHERE subID='$idSub'";
		$check = $this->db->query($query);
		Admin::getSubject(1);
	}
}