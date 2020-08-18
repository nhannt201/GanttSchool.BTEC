<?php //File Post chuc nang
class Teacher extends Init {
	function addNewJob($jobName, $jobStart, $jobEnd) {
		if (isset($_SESSION['teacher_user'])) {
		$teacherID = $_SESSION['teacher_user']; //Lay la Username lun
		$query_it = "INSERT INTO jobs (jobName, jobStart, jobEnd, teacherID) VALUES ('$jobName', '$jobStart', '$jobEnd', '$teacherID')";
		$this->db->query($query_it);
		echo $this->db->insert_id; //echo ID jobs
		}		
	}
	function addNewChildJob($jobID, $jobChildName) {
		if (isset($_SESSION['teacher_user'])) {
		$teacherID = $_SESSION['teacher_user']; //Lay la Username lun
		$query_it = "INSERT INTO jobs_details (jobID, jobChildName) VALUES ('$jobID', '$jobChildName')";
		$this->db->query($query_it);
		echo $this->db->insert_id; //echo ID jobs
		}		
	}
	function getNewJob($type, $inko="") {
		//if (isset($_SESSION['teacher_user'])) {
		$query_it = "SELECT * FROM jobs";
		$check = $this->db->query($query_it);
		if ($check->num_rows > 0) { 
			$congdon = "";
			while($row = $check->fetch_assoc()) {
				if ($type == 0) {
					$congdon .= '<option value="'.$row['jobID'].'">'.$row['jobName'].'</option>';
				}
				if ($type == 1) {
					$datecheck = ($row['jobEnd']);
					if (($datecheck == date("Y-m-d")) || ($datecheck < date("Y-m-d"))) { //disabled
						$congdon .= ' <button onClick="showJobDetaild('.$row['jobID'].')" class="list-group-item list-group-item-action ">'.$row['jobName'].' <mark>Deadline</mark>
						<span class="badge badge-primary badge-pill">'.Teacher::getNumChildJob($row['jobID']).'</span></button>';
					} else {
						$congdon .= ' <button onClick="showJobDetaild('.$row['jobID'].')" class="list-group-item list-group-item-action">'.$row['jobName'].'
						<span class="badge badge-primary badge-pill">'.Teacher::getNumChildJob($row['jobID']).'</span></button>';
					}
				}
			}
			if ($inko == 3) {
				echo $congdon;
			} else {
				return $congdon;
			}
		}
		//}		
	}
	function getNumChildJob($jobID) {
		$query = "SELECT * FROM jobs_details WHERE jobID='$jobID'";
		$check = $this->db->query($query);
		return $check->num_rows;
	}
	
	function getJobName($id) {
		$query_it = "SELECT * FROM jobs WHERE jobID='$id'";
		$check = $this->db->query($query_it);
		if ($check->num_rows > 0) { 
			$row = $check->fetch_assoc();
			echo $row['jobName'];				
		}
	}
	function getJobNameDate($id) {
		$query_it = "SELECT * FROM jobs WHERE jobID='$id'";
		$check = $this->db->query($query_it);
		if ($check->num_rows > 0) { 
			$row = $check->fetch_assoc();
			$date1 = date("d/m/Y", strtotime($row['jobStart']));
			$date2 = date("d/m/Y", strtotime($row['jobEnd']));
			echo $row['jobName']."<h6>Start: ".$date1."<br>End: ".$date2."</h6>";				
		}
	}
	
	function delJob($id) {
		$query_it = "DELETE FROM jobs WHERE jobID='$id'";
		$query_it2 = "DELETE FROM jobs_details WHERE jobID='$id'";
		$this->db->query($query_it);
		$this->db->query($query_it2);
	}
	
	function delChildJob($id) {
		$query_it = "DELETE FROM jobs_details WHERE details_id='$id'";
		$this->db->query($query_it);
	}
	
	function getChildJob($type, $jobID) {
		$query_it = "SELECT * FROM jobs_details WHERE jobID='$jobID'";
		$check = $this->db->query($query_it);
		if ($check->num_rows > 0) { 
			$congdon = "";
			while($row = $check->fetch_assoc()) {
				if ($type == 0) {
					$congdon .= '<option value="'.$row['details_id'].'">'.$row['jobChildName'].'</option>';
				}
				if ($type == 1) {
					$congdon .= ' <button type="button" id="ls_childnum_'.$row['details_id'].'" onClick="clickChildLS('.$row['details_id'].')" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#deleteWM">'.$row['jobChildName'].'</button>';
				}
			}
			echo $congdon;
		}	
	}
	
	function getChildName($jobchildID) {
		$query_it = "SELECT * FROM jobs_details WHERE details_id='$jobchildID'";
		$check = $this->db->query($query_it);
		if ($check->num_rows > 0) { 
			$row = $check->fetch_assoc();
					echo $row['jobChildName'];
		}	
	}
	
	function updateChildName($jobchildID, $content) {
		$query_it = "UPDATE jobs_details SET jobChildName='$content' WHERE details_id='$jobchildID'";
		$this->db->query($query_it);		
	}
}