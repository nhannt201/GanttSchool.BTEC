<?php
class Student extends Init {
	
	
	function getSubjectStudent($studentID, $type=1) {
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
			if ($type == 0) {
				echo $congdon;
			} else {
				return $congdon;
			}
			
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
	
	function getNameChildJob($details_id, $type=1) {
		$query = "SELECT * FROM jobs_details WHERE details_id='$details_id'";
		$check = $this->db->query($query);
		$row = $check->fetch_assoc();
		if ($type == 0):
			echo $row['jobChildName'];
		 else:
			return $row['jobChildName'];
		endif;
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
			$soluong_jobcon = 0;
			$soluong_jobconcomplete = 0;
			while($row = $check->fetch_assoc()) {
				if ($type == 0) {
					$congdon .= '<option value="'.$row['details_id'].'">'.$row['jobChildName'].'</option>';
				}
				if ($type == 1) {
						$deadline = Student::getJobNameDate($jobID, 1);
						
							if (!Student::checkStatusCompleteChildJob($row['details_id'])) {
								if (($deadline == date("Y-m-d")) || ($deadline < date("Y-m-d"))) {
									$congdon .= '<button type="button" id="ls_childnum_'.$row['details_id'].'" class="list-group-item list-group-item-action">
									'.$row['jobChildName'].'<span class="badge badge-warning badge-pill float-right">Deadline</div></button>';
								} else {
									$congdon .= '<button type="button" id="ls_childnum_'.$row['details_id'].'" onClick="clickDoJobChild('.$row['details_id'].')" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#clickDoJobStudent">
									'.$row['jobChildName'].'</button>';
								}
							} else {
								$congdon .= '<button type="button" id="ls_childnum_'.$row['details_id'].'"  class="list-group-item list-group-item-action">
							'.$row['jobChildName'].'<span class="badge badge-primary badge-pill float-right">Completed - '.Student::checkStatusCompleteChildJob($row['details_id'], 0).'</span></button>';
								$soluong_jobconcomplete++;
							}
						
				}
				$soluong_jobcon++;
			}
			$status_now_progress = round($soluong_jobconcomplete/$soluong_jobcon*100);
			echo $congdon."</div><hr><div id=\"status_progress\"><h3>Status: $soluong_jobconcomplete/$soluong_jobcon ($status_now_progress%)</h3></div><div class=\"progress\">
			  <div id=\"progressxuly\" class=\"progress-bar progress-bar-striped progress-bar-animated\" role=\"progressbar\" aria-valuenow=\"$soluong_jobconcomplete\" aria-valuemin=\"0\" aria-valuemax=\"$soluong_jobcon\" style=\"width: $status_now_progress%\"></div>
			</div>";
			echo '<br><div style="visibility:hidden;"><input type="number" id="get_total_pr" value="'.$soluong_jobcon.'" /><input type="number" id="get_now_pr" value="'.$soluong_jobconcomplete.'" /></div>';
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
	
	function addDetailsJobCompletedStudent($jobChildID) {
		if (isset($_SESSION['student_id'])) {
			$studentID =  $_SESSION['student_id'];
			$date = date("Y/m/d");
			$jobID = Student::getJobIDFromJobDetails($jobChildID);
			$query_it = "INSERT INTO student_jobs (details_id, jobID, studentID, jobDateComplete, status) VALUES ('$jobChildID', '$jobID', '$studentID', '$date', 1)";
			$this->db->query($query_it);
			echo Student::checkStatusCompleteChildJob($jobChildID, 0);
		}		
	}
	
	private function getJobIDFromJobDetails($jobdetailsID) {
		$query_it = "SELECT * FROM jobs_details WHERE details_id='$jobdetailsID'";
		$check = $this->db->query($query_it);
		if ($check->num_rows > 0) { 
			$row = $check->fetch_assoc();
			return $row['jobID'];
		}
	}
	
	private function checkStatusCompleteChildJob($details_id, $type=1) {
		if (isset($_SESSION['student_id'])) {
			$studentID =  $_SESSION['student_id'];
			$query_it = "SELECT * FROM student_jobs WHERE details_id='$details_id' and studentID='$studentID'";
			$check = $this->db->query($query_it);		
			if ($type == 0): 
				return date("d/m/Y", strtotime($check->fetch_assoc()['jobDateComplete'])); //Lay ngay thang roi doi thu tu.
			else:
				return ($check->num_rows > 0) ? true : false;
			endif;
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