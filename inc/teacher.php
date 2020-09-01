<?php //File Post chuc nang
class Teacher extends Init {
	function addNewJob($jobName, $jobStart, $jobEnd, $class, $subject) {
		if (isset($_SESSION['teacher_id'])) {
		$teacherID = $_SESSION['teacher_id']; //Lay la Username lun
		$query_it = "INSERT INTO jobs (jobName, jobStart, jobEnd, teacherID, subID, classID) VALUES ('$jobName', '$jobStart', '$jobEnd', '$teacherID', '$subject', '$class')";
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
			$teacherID = $_SESSION['teacher_id'];
		$query_it = "SELECT jobs.jobName, jobs.jobID, jobs.subID, jobs.jobEnd, classroom.className FROM jobs
		INNER JOIN classroom ON jobs.classID=classroom.classID
		WHERE teacherID='$teacherID'";
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
						$congdon .= ' <button onClick="showJobDetaild('.$row['jobID'].')" class="list-group-item list-group-item-action ">('.$row['subID'].') '.$row['jobName'].' 
						<span id="get_value_'.$row['jobID'].'" class="badge badge-primary badge-pill float-right">'.Teacher::getNumChildJob($row['jobID']).'</span><span class="badge badge-primary badge-pill float-right">'.$row['className'].'</span><span class="badge badge-warning badge-pill float-right">Deadline</span></button>';
					} else {
						$congdon .= ' <button onClick="showJobDetaild('.$row['jobID'].')" class="list-group-item list-group-item-action">('.$row['subID'].') '.$row['jobName'].'
						<span id="get_value_'.$row['jobID'].'" class="badge badge-primary badge-pill float-right">'.Teacher::getNumChildJob($row['jobID']).'</span><span class="badge badge-primary badge-pill float-right">'.$row['className'].'</span></button>';
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
			echo '('.$row['subID'].') '.$row['jobName'];				
		}
	}
	function getJobNameDate($id) {
		$query_it = "SELECT * FROM jobs WHERE jobID='$id'";
		$check = $this->db->query($query_it);
		if ($check->num_rows > 0) { 
			$row = $check->fetch_assoc();
			$date1 = date("d/m/Y", strtotime($row['jobStart']));
			$date2 = date("d/m/Y", strtotime($row['jobEnd']));
			echo '('.$row['subID'].') '.$row['jobName']."<h6>Start: ".$date1."<br>End: ".$date2."</h6>";				
		}
	}
	
	function delJob($id) {
		$query_it = "DELETE FROM jobs WHERE jobID='$id'";
		$query_it2 = "DELETE FROM jobs_details WHERE jobID='$id'";
		$query_it3 = "DELETE FROM student_jobs WHERE jobID='$id'";
		$this->db->query($query_it);
		$this->db->query($query_it2);
		$this->db->query($query_it3);
	}
	
	function delChildJob($id) {
		$query_it = "DELETE FROM jobs_details WHERE details_id='$id'";
		$query_it2 = "DELETE FROM student_jobs WHERE details_id='$id'";
		$this->db->query($query_it);
		$this->db->query($query_it2);
	}
	
	function getChildJob($type, $jobID) {
		$query_it = "SELECT * FROM jobs_details WHERE jobID='$jobID'";
		$check = $this->db->query($query_it);
		if ($check->num_rows > 0) { 
			$congdon = "";
			$soluong_cauhoi = $check->num_rows;
			$sodenhan = 1;
			$dem = 0;
			$so_hs_ht = 0;
			$total_student = Teacher::getQtyStudentOfClass($jobID);
			$total_cauhoi_need =  $total_student*$soluong_cauhoi;
			$chanhayle = (($total_cauhoi_need % 2) == 0) ? true : false;
			while($row = $check->fetch_assoc()) {
				$get_complete = (Teacher::getAnalyticStudentCompleteFollowJobDetails($row['details_id']) == Teacher::getQtyStudentOfClass($jobID)) ? true : false;
				if ((Teacher::getAnalyticStudentCompleteFollowJobDetails($row['details_id'])) > 0)
				{
					//Tinh so hoc sinh da hoan tat
					$dem += Teacher::getAnalyticStudentCompleteFollowJobDetails($row['details_id']);
					//$dem += ((Teacher::getAnalyticStudentCompleteFollowJobDetails($row['details_id'])) > 0) ? (Teacher::getAnalyticStudentCompleteFollowJobDetails($row['details_id'])) : 0;
					//Phan code loi - ko chay duoc
					//Neu total la so le
					/*if ($chanhayle) {
						if (($soluong_cauhoi % $dem) ==0) {
							$so_hs_ht +=1;
							$sodenhan +=1;
						}
					} else {
						if (($soluong_cauhoi % $dem) !== 0) {
							$so_hs_ht +=1;
							$sodenhan +=1;
						}
					}
					
					if ($dem == ($soluong_cauhoi * $sodenhan)) {
						$so_hs_ht +=1;
						$sodenhan +=1;
					}*/
					//$so_hs_ht += ((($total_cauhoi_need - $dem)%$soluong_cauhoi) == 0) ? 1 : 0;
					
					/*for($i = $soluong_cauhoi; $i <= $total_cauhoi_need; $i+=$i) {
						if ($dem - $i == 0) {
							
							$so_hs_ht +=1;
						}
					}*/
					
				}
				if ($get_complete) {				
					$num_complete = '<span class="badge badge-success badge-pill float-right">'.Teacher::getAnalyticStudentCompleteFollowJobDetails($row['details_id'])."/".Teacher::getQtyStudentOfClass($row['jobID'])."</span>";
				} else {
					$num_complete = '<span class="badge badge-warning badge-pill float-right">'.Teacher::getAnalyticStudentCompleteFollowJobDetails($row['details_id'])."/".Teacher::getQtyStudentOfClass($row['jobID'])."</span>";
				}
				if ($type == 0) {
					$congdon .= '<option value="'.$row['details_id'].'">'.$row['jobChildName'].'</option>';
				}
				if ($type == 1) {
					$congdon .= ' <button type="button" id="ls_childnum_'.$row['details_id'].'" onClick="clickChildLS('.$row['details_id'].', '.$jobID.')" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#deleteWM">'.$row['jobChildName'].'
					'.$num_complete.'</button>';
				}
			}
			echo $congdon;
			//Tinh so hoc sinh da hoan tat - De ben ngoai while moi chay dung!!!!
			/*for($i = $dem; $i > 0; $i-=1) {
						if ($i %  $soluong_cauhoi == 0) {
							
							$so_hs_ht +=1;
						}
			}
			echo "<hr><h5>Statistic: $so_hs_ht/$total_student student completed</h5>";*/
			//Doi thong ke bang so thanh %
			$status_now_progress = round($dem/$total_cauhoi_need*100);
			echo '<div id="updateProgress"><hr><h3>Status: '.$status_now_progress.'%</h3><div id="status_progress"><div class="progress">
			  <div id="progressxuly" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="'.$dem.'" aria-valuemin="0" aria-valuemax="'.$total_cauhoi_need.'" style="width: '.$status_now_progress.'%"></div>
			</div></div>';
		}	
	}
	
	//Lay thong tin progress
	function getInfoProgress($jobID) {
		$query_it = "SELECT * FROM jobs_details WHERE jobID='$jobID'";
		$check = $this->db->query($query_it);
		if ($check->num_rows > 0) { 
			$soluong_cauhoi = $check->num_rows;
			$dem = 0;
			$total_student = Teacher::getQtyStudentOfClass($jobID);
			$total_cauhoi_need =  $total_student*$soluong_cauhoi;
			while($row = $check->fetch_assoc()) {
				$get_complete = (Teacher::getAnalyticStudentCompleteFollowJobDetails($row['details_id']) == Teacher::getQtyStudentOfClass($jobID)) ? true : false;
				if ((Teacher::getAnalyticStudentCompleteFollowJobDetails($row['details_id'])) > 0)
				{
					$dem += Teacher::getAnalyticStudentCompleteFollowJobDetails($row['details_id']);
				}

			}
			//Doi thong ke bang so thanh %
			$status_now_progress = round($dem/$total_cauhoi_need*100);
			echo '<hr><h3>Status: '.$status_now_progress.'%</h3><div id="status_progress"><div class="progress">
			  <div id="progressxuly" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="'.$dem.'" aria-valuemin="0" aria-valuemax="'.$total_cauhoi_need.'" style="width: '.$status_now_progress.'%"></div>
			</div><br>';
		}	
	}
	//Phan nay chi la rieng span da chua so da hoan thanh ra
	function getSpanComplete($details_id) {
		$jobID = Teacher::getJobIDFromChildID($details_id);
		$get_complete = (Teacher::getAnalyticStudentCompleteFollowJobDetails($details_id) == Teacher::getQtyStudentOfClass($jobID)) ? true : false;
		if ($get_complete) {				
			$num_complete = '<span class="badge badge-success badge-pill float-right">'.Teacher::getAnalyticStudentCompleteFollowJobDetails($details_id)."/".Teacher::getQtyStudentOfClass($jobID)."</span>";
		} else {
			$num_complete = '<span class="badge badge-warning badge-pill float-right">'.Teacher::getAnalyticStudentCompleteFollowJobDetails($details_id)."/".Teacher::getQtyStudentOfClass($jobID)."</span>";
		}
		echo  $num_complete;
	}
	
	private function getJobIDFromChildID($jobDetails) {
		$query_it = "SELECT * FROM jobs_details WHERE details_id='$jobDetails'";
		$check = $this->db->query($query_it);
		//Chi tra ve so luong da lam, khong cho biet cu the la ai. Nhung se phan loai theo lop hoc
		return $check->fetch_assoc()['jobID'];
	}
	//Kiem tra so luong jobs detail hoc sinh da hoan tat.
	function getAnalyticStudentCompleteFollowJobDetails($jobDetails) {
		$query_it = "SELECT * FROM student_jobs WHERE details_id='$jobDetails'";
		$check = $this->db->query($query_it);
		//Chi tra ve so luong da lam, khong cho biet cu the la ai. Nhung se phan loai theo lop hoc
		return $check->num_rows;
	}
	

	//So luong hs trong lop
	function getQtyStudentOfClass($jobID) {
		$query_it = "SELECT student_class.classID FROM jobs
		INNER JOIN student_class ON student_class.classID = jobs.classID
		WHERE jobID='$jobID'";
		$check = $this->db->query($query_it);
		return $check->num_rows;
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
	
	function getClassroom($type, $teacherID) {
		$query_it = "SELECT classroom.className,teacher_class.classID
		FROM classroom
		INNER JOIN teacher_class ON classroom.classID=teacher_class.classID
		WHERE teacherID='$teacherID'";
		$check = $this->db->query($query_it);
		if ($check->num_rows > 0) { 
			$congdon = "";
			while($row = $check->fetch_assoc()) {
				if ($type == 0) {
					$congdon .= '<option value="'.$row['classID'].'">'.$row['className'].'</option>';
				}
				if ($type == 1) {
					//$congdon .= ' <button type="button" id="ls_childnum_'.$row['details_id'].'" onClick="clickChildLS('.$row['details_id'].')" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#deleteWM">'.$row['jobChildName'].'</button>';
				}
			}
			return $congdon;
		}	
	}
	
	function getSubjects($type, $teacherID) {
		$query_it = "SELECT subject.subName,teacher_subs.subID
		FROM subject
		INNER JOIN teacher_subs ON subject.subID=teacher_subs.subID
		WHERE teacherID='$teacherID'";
		$check = $this->db->query($query_it);
		if ($check->num_rows > 0) { 
			$congdon = "";
			while($row = $check->fetch_assoc()) {
				if ($type == 0) {
					$congdon .= '<option value="'.$row['subID'].'">'.$row['subName'].'</option>';
				}
				if ($type == 1) {
					//$congdon .= ' <button type="button" id="ls_childnum_'.$row['details_id'].'" onClick="clickChildLS('.$row['details_id'].')" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#deleteWM">'.$row['jobChildName'].'</button>';
				}
			}
			return $congdon;
		}	
	}
	//Thong ke
	function getDetailsStatist($jobID) {
		$query = "SELECT student_class.studentID, student.name
		FROM jobs
		INNER JOIN student_class ON jobs.classID = student_class.classID
		INNER JOIN student ON student_class.studentID = student.studentID
		WHERE jobID='$jobID'";
		$check = $this->db->query($query);
		if ($check->num_rows >0) {
			echo '<h3>Detailed statistics</h3><hr><div class="list-group">';
			while($row = $check->fetch_assoc()) {
				//echo "Student: ".$row['name']."<br>";
				if ((Teacher::checkStudentCompleted($jobID, $row['studentID'])) == Teacher::getQtyJobsChild($jobID)) {
					$complete = '<span class="badge badge-success badge-pill float-right">Completed</span>';
					$color = "success";
				} else {$complete="";$color="warning";}
				echo ' <button data-toggle="modal" data-target="#msgbox" class="list-group-item list-group-item-action" onClick="getJCStudentCompleted(\''.$jobID.'\', \''.$row['studentID'].'\')">'.$row['name'].'
				'.$complete.'<span class="badge badge-'.$color.' badge-pill float-right">'.Teacher::checkStudentCompleted($jobID, $row['studentID']).'/'.Teacher::getQtyJobsChild($jobID).'</span></button>';
			}
			echo '</div>';
		}
			
	}
	//get Student Jobs Details completed and compar...
	function getJSDCompleted($studentID, $jobID) { 
		//$student = new Student();
		$query = "SELECT *
		FROM jobs_details
		WHERE jobID='$jobID'";
		$check = $this->db->query($query);
		if ($check->num_rows > 0) {
			echo '<div class="list-group" id="accordion">';
			while($row=$check->fetch_assoc()) {
				if (Teacher::checkStudentCompletedWhere($row['details_id'], $studentID)) {
					echo '<button class="list-group-item list-group-item-action" data-toggle="collapse" href="#answer_'.$row['details_id'].'">'.$row['jobChildName'].'
					<span class="badge badge-success badge-pill float-right">Completed</span></button>';
					echo ' <div id="answer_'.$row['details_id'].'" class="collapse" data-parent="#accordion">
							  <div class="card">
								<div class="card-body">
							   '.Teacher::getAnswerStudent($row['details_id'], $studentID).'
								</div>
							  </div>
							 </div>    ';
				} else {
					echo '<button class="list-group-item list-group-item-action">'.$row['jobChildName'].'</button>';
				}
			}
			echo '</div>';
		}
	}
	//Get answer student
	function getAnswerStudent($details_id, $student_id) {
			$query_it = "SELECT * FROM student_jobs WHERE details_id='$details_id' and studentID='$student_id'";
			$check = $this->db->query($query_it);
			if ($check->num_rows >0) {
				return $check->fetch_assoc()['answer'];
			}
	}
	//Check job child da hoan tat.
	function checkStudentCompletedWhere($details_id, $studentID) {
		$query = "SELECT * FROM student_jobs WHERE details_id='$details_id' and studentID = '$studentID'";
		$check = $this->db->query($query);
		if ($check->num_rows > 0) {
		if (($check->fetch_assoc()['status']) == 1 ) {
			return true;
		} else {return false;}
		} else {return false;}
	}
	//Check so luong job child da hoan tat.
	function checkStudentCompleted($jobID, $studentID) {
		$query = "SELECT * FROM student_jobs WHERE jobID='$jobID' and studentID = '$studentID'";
		$check = $this->db->query($query);
		return $check->num_rows;
	}
	//Lay so cong viec Job Child
	function getQtyJobsChild($jobID) {
		$query = "SELECT * FROM jobs_details WHERE jobID='$jobID'";
		$check = $this->db->query($query);
		return $check->num_rows;
	}
	
	//Account
	function getAccountInfo($teachID) {
		$query = "SELECT * FROM teacher WHERE teacherID = '$teachID'";	
		$check = $this->db->query($query);
		if ($check->num_rows > 0){
			$row = $check->fetch_assoc();
			return '<p>Your name: <b>'.$row['name'].'</b><br>Your class: <b>'.Teacher::getClassStudy($teachID)."</b>";
		} 
	}
	private function getClassStudy($teachID) {
		$query = "SELECT teacher_class.classID, classroom.className FROM teacher_class
		INNER JOIN classroom ON teacher_class.classID = classroom.classID
		WHERE teacherID = '$teachID'";
		$check = $this->db->query($query);
		$array_teach[] = array();
		if ($check->num_rows > 0){
			$count = 0;
			$addd = "";
			while($row = $check->fetch_assoc()) {
				$count++;
				$classIDD = $row['classID'];
				if  (!array_key_exists($classIDD, $array_teach)) {
						$array_teach[$classIDD] = 0;
					if ($check->num_rows == 1) {
							$addd .= $row['className'];
					} elseif ($count == $check->num_rows) {
							$addd .= $row['className'];
					} else {	
						if (strlen(trim($row['className'])) > 0) {
							$addd .= $row['className']." ";	
						}							
					}	
			}				
			}
			return $addd;
		} 
	}
}