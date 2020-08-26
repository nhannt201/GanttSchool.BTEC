<?php
class Admin extends Init {
	//Add
	function addNewTeacher() {
		
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
	function addNewStudent() {
		
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