<?php
class Student extends Init {
	
	
	function getSubjectStudent($studentID) {
		//Lay ID lop hoc
		$query_it = "SELECT classroom.className, student_class.studentID, teacher_class.subID
		FROM classroom
		INNER JOIN student_class ON classroom.classID=student_class.classID
		INNER JOIN teacher_class ON classroom.classID=teacher_class.classID
		WHERE studentID='$studentID'";
		$check = $this->db->query($query_it);
		if ($check->num_rows > 0) { 
		$congdon = "";
			while($row = $check->fetch_assoc()) {
				$congdon .= " <button type=\"button\" class=\"list-group-item list-group-item-action\">".Student::getNameSubject($row['subID'])."</button>";
			}
			return $congdon;
		}
	}
	
	function getNameSubject($subID) {
		$query_it = "SELECT * FROM subject WHERE subID='$subID'";
		$check = $this->db->query($query_it);
		$row = $check->fetch_assoc();
		return $row['subName'];
	}
	
	function getAccountInfo($studentID) {
		$query_it = "SELECT classroom.className, student_class.studentID
		FROM classroom
		INNER JOIN student_class ON classroom.classID=student_class.classID
		WHERE studentID='$studentID'";
		$check = $this->db->query($query_it);
		$row = $check->fetch_assoc();
		$info = "";
		$info .= "Your class: <b>".$row['className']."</b><br>";
		if (isset($_SESSION['student_log'])) {
			$info .= "Your name: <b>".$_SESSION['student_log']."</b>";
		}
		return $info;
	}
	//Cai function nay chi de test thoi.
	function getSubjectExist($studentID) {
		//Noi hai bang lai voi nhau
		$query_it = "SELECT classroom.className, student_class.studentID, teacher_class.teacherID
		FROM classroom
		INNER JOIN student_class ON classroom.classID=student_class.classID
		INNER JOIN teacher_class ON classroom.classID=teacher_class.classID
		WHERE studentID='$studentID'";
		
		$check = $this->db->query($query_it);
		if ($check->num_rows > 0) { 
			$teacherID = array();
			//La ID giao vien dang day lop hoc cua StudentID
			while($row = $check->fetch_assoc()) {
				array_push($teacherID, $row['teacherID']);
			}
			foreach ($teacherID as $ID) {
				//Dung IDGV de xac dinh dang day mon gi trong lop do.
				$query_it2 = "SELECT subject.subName, teacher_subs.subID
					FROM subject
					INNER JOIN teacher_subs ON subject.subID=teacher_subs.subID
					WHERE teacherID='$ID'";
					$monhoc_hienco = array();
					$check2 = $this->db->query($query_it2);
					while($row2 = $check2->fetch_assoc()) {
						array_push($monhoc_hienco, $row2['subName']);
					}
					//Xoa cac mon hoc bi lap lai
					$monhoc_hienco = array_unique($monhoc_hienco);
					print_r($monhoc_hienco);
			}
			//print_r( $teacherID);
		//Hom nay se lam tiep phan Hoc Sinh, sao nay may cai nang cao lam them sau.
		}	
	}
}