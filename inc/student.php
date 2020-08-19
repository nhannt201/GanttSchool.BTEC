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
					<span class=\"badge badge-primary badge-pill float-right\">".Student::getQtyJobSubject($subID, $classID)."</span></button>";
				 } else {
					  $congdon .= " <button  type=\"button\" class=\"list-group-item list-group-item-action disabled\">".Student::getNameSubject($subID)."
					<span class=\"badge badge-primary badge-pill float-right\">".Student::getQtyJobSubject($subID, $classID)."</span></button>";
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
				 $datecheck = ($row['jobEnd']);
				 if (($datecheck == date("Y-m-d")) || ($datecheck < date("Y-m-d"))) { //disabled
					$congdon .= " <button type=\"button\" onClick=\"clickShowJobDetails_Tab(".$row['jobID'].")\" class=\"list-group-item list-group-item-action\"><mark>Deadline</mark> ".($row['jobName'])."
					 (".Student::getJobNameDate($row['jobID'], 1).")<span class=\"badge badge-primary badge-pill float-right\">".Student::getNumChildJob($row['jobID'])."</span></button>";
				 } else {
					 $congdon .= " <button type=\"button\" onClick=\"clickShowJobDetails_Tab(".$row['jobID'].")\" class=\"list-group-item list-group-item-action\">".($row['jobName'])."
					 (".Student::getJobNameDate($row['jobID'], 1).")<span class=\"badge badge-primary badge-pill float-right\">".Student::getNumChildJob($row['jobID'])."</span></button>";
				 }
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
	
	function getChildJob($type, $jobID) {
		$query_it = "SELECT * FROM jobs_details WHERE jobID='$jobID'";
		$check = $this->db->query($query_it);
		if ($check->num_rows > 0) { 
			$congdon = "<h3>".Student::getJobName($jobID)."</h3>".Student::getJobNameDate($jobID, 2)."<hr><div class=\"list-group\" id=\"lsJobManageStudent\">";
			while($row = $check->fetch_assoc()) {
				if ($type == 0) {
					$congdon .= '<option value="'.$row['details_id'].'">'.$row['jobChildName'].'</option>';
				}
				if ($type == 1) {
					$congdon .= ' <button type="button" id="ls_childnum_'.$row['details_id'].'" onClick="clickChildLS('.$row['details_id'].')" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#check_complete">
					'.$row['jobChildName'].'</button>';
				}
			}
			echo $congdon."</div>";
		}	else {
			echo '<div class="alert alert-warning">
					  No child jobs!
					</div>';
		}
	}
	
	function getJobName($id) {
		$query_it = "SELECT * FROM jobs WHERE jobID='$id'";
		$check = $this->db->query($query_it);
		if ($check->num_rows > 0) { 
			$row = $check->fetch_assoc();
			return '('.$row['subID'].') '.$row['jobName'];				
		}
	}
	
	function getJobNameDate($jobID, $date) {
		$query_it = "SELECT * FROM jobs WHERE jobID='$jobID'";
		$check = $this->db->query($query_it);
		if ($check->num_rows > 0) { 
			$row = $check->fetch_assoc();
			$date1 = date("d/m/Y", strtotime($row['jobStart']));
			$date2 = date("d/m/Y", strtotime($row['jobEnd']));
			//echo '('.$row['subID'].') '.$row['jobName']."<h6>Start: ".$date1."<br>End: ".$date2."</h6>";	
			switch ($date) {
				case 0:
				return $date1;
				break;
				case 1:
				return $date2;
				break;
				case 2:
				return "<h6>Start: ".$date1."<br>End: ".$date2."</h6>";
				break;
			}
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