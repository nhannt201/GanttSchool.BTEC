<?php
require_once("../inc/config.php"); //Co ket noi CSDL
$post = new Teacher();
if (isset($_GET['num'])) {
	$num = trim($_GET['num']);
	switch ($num) {
		case 0:
			if (isset($_GET['jobID'])) {
				$jobID= $_GET['jobID'];
				$post->delJob($jobID);
			}
		break;
		case 1:
			$post->getNewJob(0, 3);
		break;
		case 2:
			if (isset($_GET['childjobID'])) {
				$childjobID= $_GET['childjobID'];
				$post->delChildJob($childjobID);
			}
		break;
		case 3:
			if (isset($_GET['childjobID'])) {
				$childjobID= $_GET['childjobID'];
				$content= $_GET['content'];
				$post->updateChildName($childjobID, $content);
			}
		break;
	}
}