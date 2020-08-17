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
	function getNewJob($type) {
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
					$congdon .= ' <button type="button" onClick="'.$row['jobID'].'" class="list-group-item list-group-item-action">'.$row['jobName'].'</button>';
				}
			}
			return $congdon;
		}
		//}		
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