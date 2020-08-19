<?php
require_once("../inc/config.php"); //Co ket noi CSDL
$student = new Student();
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
		break;
	}
}
