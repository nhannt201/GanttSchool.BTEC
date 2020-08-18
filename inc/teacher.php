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
					//Bo sung them cong viec con sau.
					$congdon .= ' <button onClick="showJobDetaild('.$row['jobID'].')" class="list-group-item list-group-item-action">'.$row['jobName'].'
					<span class="badge badge-primary badge-pill">'.Teacher::getNumChildJob($row['jobID']).'</span></button>';
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
	
	function delJob($id) {
		$query_it = "DELETE FROM jobs WHERE jobID='$id'";
		$query_it2 = "DELETE FROM jobs_details WHERE jobID='$id'";
		$this->db->query($query_it);
		$this->db->query($query_it2);
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
					$congdon .= ' <button type="button" onClick="'.$row['details_id'].'" class="list-group-item list-group-item-action">'.$row['jobChildName'].'</button>';
				}
			}
			echo $congdon;
		}	
	}
}