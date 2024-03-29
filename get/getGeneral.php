<?php
require_once("../inc/config.php"); //Co ket noi CSDL
$student = new Student();
$teacher = new Teacher();
$admin = new Admin();
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
			if ((isset($_GET['confirm_doChildJob'])) && (isset($_GET['answer']))) {
				$confirm_doChildJob = $_GET['confirm_doChildJob'];
				$content = htmlspecialchars($_GET['answer']);
				$student->addDetailsJobCompletedStudent($confirm_doChildJob, $content);
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
		case 8:
			if (isset($_GET['details_id'])) {
				$details_id = $_GET['details_id'];
				$teacher->getSpanComplete($details_id);
			}
		break;
		case 9:
			if (isset($_GET['jobID'])) {
				$jobID = $_GET['jobID'];
				$teacher->getInfoProgress($jobID);
			}
		break;
		case 10: //Get cau tra loi cua sv
			if (isset($_GET['details_id'])) {
				$details_id = $_GET['details_id'];
				$student->getAnswerStudent($details_id);
			}
		break;
		case 11: //Get cau tra loi cua sv
			if (isset($_GET['checkDesEx'])) {
				$checkDesEx = $_GET['checkDesEx'];
				$student->checkDetailsExist($checkDesEx);
			}
		break;
		case 12:
			if (isset($_GET['getclassName'])) {
				$getclassName= $_GET['getclassName'];
				$admin->getNameClass($getclassName);
			}
		break;
		case 13:
			if ((isset($_GET['upclassName'])) && isset($_GET['classNameID'])) {
				$upclassName= $_GET['upclassName'];
				$classNameID = $_GET['classNameID'];
				$admin->upNameClass($upclassName, $classNameID);
			}
		break;
		case 14: // get subject
			if ((isset($_GET['getsub']))) {
				$admin->getSubject(1);
			}
		break;
		case 15: // get subject name
			if ((isset($_GET['getsubIDName']))) {
				$getSubName = $_GET['getsubIDName'];
				$admin->getNameSubject($getSubName);
			}
		break;
		case 16: // change name
			if ((isset($_GET['getChangSubName'])) && (isset($_GET['getChangSubID']))) {
				$getChangSubName = $_GET['getChangSubName'];
				$getChangSubID = $_GET['getChangSubID'];
				$admin->upNameSubject($getChangSubName, $getChangSubID);
			}
		break;
		case 17: 
			if ((isset($_GET['getClass']))) {
				$admin->getClassroom(1);
			}
		break;
		case 18: 
			if ((isset($_GET['getSubject']))) {
				$admin->getSubject(1);
			}
		break;
		case 19: 
			if ((isset($_GET['getStudentClass']))) {
				$getStudentClass = $_GET['getStudentClass'];
				$admin->getStudentFollowClass($getStudentClass);
			}
		break;
		case 20: 
			if ((isset($_GET['getAllTeacher']))) {
				$class = $_GET['getAllTeacher'];
				$admin->getAllTeacher($class, 1);
			}
		break;
		case 21: 
			if ((isset($_GET['getAllStudent']))) {
				$class = $_GET['getAllStudent'];
				$admin->getAllStudent($class, 1);
			}
		break;
		case 22: 
			if ((isset($_GET['getAllParent']))) {
				$class = $_GET['getAllParent'];
				$admin->getAllParent($class, 1);
			}
		break;
		case 23: 
			if ((isset($_GET['class'])) && (isset($_GET['teacherID']))) {
				$class = $_GET['class'];
				$teacherID = $_GET['teacherID'];
				$admin->getCourseTeaching($class, $teacherID);
			}
		break;
		case 24: 
			if ((isset($_GET['teacherID']))) {
				$teacherID = $_GET['teacherID'];
				$admin->delTeacher($teacherID);
			}
		break;
		case 25: 
			if ((isset($_GET['studentID']))) {
				$studentID = $_GET['studentID'];
				$admin->getClassStudent($studentID);
			}
		break;
		case 26: 
			if ((isset($_GET['studentID']))) {
				$studentID = $_GET['studentID'];
				$admin->delStudent($studentID);
			}
		break;
	}
}
