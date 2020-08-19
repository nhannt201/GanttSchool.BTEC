<?php
class Student extends Init {
	
	
	function getSubjectStudent($studentID) {
		//Lay ID lop hoc
		$query_it = "SELECT classroom.className, student_class.studentID, teacher_class.subID, student_class.classID
		FROM classroom
		INNER JOIN student_class ON classroom.classID=student_class.classID
		INNER JOIN teacher_class ON classroom.classID=teacher_class.classID
		WHERE studentID='$studentID'";
		$check = $this->db->query($query_it);
		if ($check->num_rows > 0) { 
		$congdon = "";
			while($row = $check->fetch_assoc()) {
				$subID = $row['subID'];
				$classID = $row['classID'];
				 if (Student::getQtyJobSubject($subID, $classID) > 0) { 
					 $congdon .= " <button type=\"button\" onClick=\"clickJobNameStudent('".$subID."', ".$classID.")\" class=\"list-group-item list-group-item-action\">".Student::getNameSubject($subID)."
					<span class=\"badge badge-primary badge-pill\">".Student::getQtyJobSubject($subID, $classID)."</span></button>";
				 } else {
					  $congdon .= " <button  type=\"button\" class=\"list-group-item list-group-item-action disabled\">".Student::getNameSubject($subID)."
					<span class=\"badge badge-primary badge-pill\">".Student::getQtyJobSubject($subID, $classID)."</span></button>";
				 }
				
			}
			return $congdon;
		} else {
			return '<div class="alert alert-warning">
					  You have not taken any courses yet!
					</div>';
		}
	}
	
	function getQtyJobSubject($subID, $classID) {
		$query_it = "SELECT * FROM jobs WHERE subID='$subID' and classID='$classID'";
		$check = $this->db->query($query_it);
		return $check->num_rows;
	}
	
	function getJobNameClickSubject($subID, $classID) {
		$query_it = "SELECT * FROM jobs WHERE subID='$subID' and classID='$classID'";
		$check = $this->db->query($query_it);
		if ($check->num_rows > 0) {
		$congdon = "<h3>".Student::getNameSubject($subID)."</h3><hr><div class=\"list-group\">";
			 while($row = $check->fetch_assoc()) {
				 $congdon .= " <button type=\"button\" onClick=\"clickChildLS(".$row['jobID'].")\" class=\"list-group-item list-group-item-action\">".($row['jobName'])."
				 <span class=\"badge badge-primary badge-pill\">".Student::getNumChildJob($row['jobID'])."</span></button>";
			 }
		echo $congdon."</div>";
		}
	}
	function getNumChildJob($jobID) {
		$query = "SELECT * FROM jobs_details WHERE jobID='$jobID'";
		$check = $this->db->query($query);
		return $check->num_rows;
	}
	function getNameSubject($subID, $type="") {
		$query_it = "SELECT * FROM subject WHERE subID='$subID'";
		$check = $this->db->query($query_it);
		$row = $check->fetch_assoc();	
		if ($type == 1) {
			echo $row['subName'];
		} else {
			return $row['subName'];
		}
	}

	function getAccountInfo($studentID) {
		$query_it = "SELECT classroom.className, student_class.studentID
		FROM classroom
		INNER JOIN student_class ON classroom.classID=student_class.classID
		WHERE studentID='$studentID'";
		$check = $this->db->query($query_it);
		$row = $check->fetch_assoc();
		$info = "";
		if (isset($row['className'])) {
			$info .= "Your class: <b>".$row['className']."</b><br>";
		}
		if (isset($_SESSION['student_log'])) {
			$info .= "Your name: <b>".$_SESSION['student_log']."</b>";
		}
		return $info;
	}
	
	
	//--------------------------------------------------------------------------------------------------------------
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