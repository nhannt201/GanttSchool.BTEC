<?php
require_once("../inc/config.php"); //Co ket noi CSDL
$teacher = new Teacher();
$student = new Student();
$admin = new Admin();
if ((isset($_GET['num'])) || (isset($_POST['num']))) {
	if (isset($_POST['num'])) {
		$num = trim($_POST['num']);
	} else {
		$num = trim($_GET['num']);
	}
	switch ($num) {
		case 0:
			if (isset($_GET['jobID'])) {
				$jobID= $_GET['jobID'];
				$teacher->delJob($jobID);
			}
		break;
		case 1:
			$teacher->getNewJob(0, 3);
		break;
		case 2:
			if (isset($_GET['childjobID'])) {
				$childjobID= $_GET['childjobID'];
				$teacher->delChildJob($childjobID);
			}
		break;
		case 3:
			if (isset($_GET['childjobID'])) {
				$childjobID= $_GET['childjobID'];
				$content= $_GET['content'];
				$teacher->updateChildName($childjobID, $content);
			}
		break;
		//Phan admin
		case 4:
			if (isset($_GET['addclassName'])) {
				$addclassName= $_GET['addclassName'];
				$admin->addNewClass($addclassName);
			}
		break;
		case 5:
			if ((isset($_GET['addsubName'])) && (isset($_GET['addsubID']))) {
				$addsubName= $_GET['addsubName'];
				$addsubID= $_GET['addsubID'];
				$admin->addNewSubject($addsubID, $addsubName);
			}
		break;
		case 6:
			//post
			if (isset($_POST['submit_teach'])) {
				$post_name = $_POST['accName'];
				$post_email = $_POST['accEmail'];
				$post_user = $_POST['accUser'];
				$post_pass = $_POST['accPass'];
				$post_class = $_POST['slcClass'];
				$post_course = $_POST['slcSub'];
				if ((strlen($post_pass) < 1) || (empty($post_pass))) {
					$post_pass = md5("password");
				} else { $post_pass = md5($post_pass); }
				$admin->addNewTeacher($post_name, $post_email, $post_user, $post_pass, $post_class, $post_course);
			}
		break;
		case 7:
			if (isset($_POST['submit_student'])) {
				$post_name = $_POST['accName'];
				$post_email = $_POST['accEmail'];
				$post_user = $_POST['accUser'];
				$post_pass = $_POST['accPass'];
				$post_class = $_POST['slcClass'];
				if ((strlen($post_pass) < 1) || (empty($post_pass))) {
					$post_pass = md5("password");
				} else { $post_pass = md5($post_pass); }
				$admin->addNewStudent($post_name, $post_email, $post_user, $post_pass, $post_class);
			}

		break;
		case 8:
			if (isset($_POST['submit_parent'])) {
				$post_name = $_POST['accName'];
				$post_email = $_POST['accEmail'];
				$post_user = $_POST['accUser'];
				$post_pass = $_POST['accPass'];
				$post_class = $_POST['slcClass'];
				$post_studentID = $_POST['studentID'];
				if ((strlen($post_pass) < 1) || (empty($post_pass))) {
					$post_pass = md5("password");
				} else { $post_pass = md5($post_pass); }
				$admin->addNewParent($post_name, $post_email, $post_user, $post_pass, $post_class, $post_studentID);
			}
		break;
		case 9:
			if ((isset($_GET['class'])) && (isset($_GET['teacherID'])) && (isset($_GET['subID']))) {
				$class = $_GET['class'];
				$teacherID = $_GET['teacherID'];
				$subID = $_GET['subID'];
				$admin->addMoreCourseTeacher($teacherID, $class, $subID);
			}
		break;
		case 10:
			if ((isset($_GET['class'])) && (isset($_GET['studentID']))) {
				$class = $_GET['class'];
				$studentID = $_GET['studentID'];
				$admin->addMoreClassStudent($studentID, $class);
			}
		break;
	}
}

