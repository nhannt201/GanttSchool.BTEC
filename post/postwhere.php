<?php
require_once("../inc/config.php"); //Co ket noi CSDL
$teacher = new Teacher();
$student = new Student();
if (isset($_GET['num'])) {
	$num = trim($_GET['num']);
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
	}
}
