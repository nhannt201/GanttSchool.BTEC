<?php
require_once("../inc/config.php"); //Co ket noi CSDL
$student = new Student();
$teacher = new Teacher();
if (isset($_GET['num'])) {
	$num = trim($_GET['num']);
	switch ($num) {
		case 0:
			if ((isset($_GET['subID'])) && (isset($_GET['classID']))) {
				$subID = $_GET['subID'];
				$classID = $_GET['classID'];
				$student->getJobNameClickSubject($subID, $classID);
			}		
		break;
		case 1:
			if ((isset($_GET['subID']))) {
				$subID = $_GET['subID'];
				$student->getNameSubject($subID, 1);
			}		
		break;//getSubjectStudent
		case 2:
			//if ((isset($_GET['studentID']))) {
				$studentID = $_SESSION['student_id'];
				$student->getSubjectStudent($studentID , 0);
			//}	
		break;
		case 3:
			if ((isset($_GET['detail_id']))) {
				$detail_id = $_GET['detail_id'];
				$student->getNameChildJob($detail_id , 0);
			}	
		break;
		case 4:
			if ((isset($_GET['confirm_doChildJob']))) {
				$confirm_doChildJob = $_GET['confirm_doChildJob'];
				$student->addDetailsJobCompletedStudent($confirm_doChildJob);
			}	
		break;
		case 5:
			if ((isset($_GET['jobID']))) {
				$jobID = $_GET['jobID'];
				$teacher->getDetailsStatist($jobID);
			}	
		break;
		case 6:
			if ((isset($_GET['studentID']))) {
				$studentID = $_GET['studentID'];
				$student->getStudentName($studentID);
			}
		break;
		case 7:
			if ((isset($_GET['studentID'])) && (isset($_GET['jobID']))) {
				$studentID = $_GET['studentID'];
				$jobID = $_GET['jobID'];
				$teacher->getJSDCompleted( $studentID, $jobID);
			}
		break;
	}
}
