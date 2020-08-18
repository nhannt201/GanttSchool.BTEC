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
	}
}