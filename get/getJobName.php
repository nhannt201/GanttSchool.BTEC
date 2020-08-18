<?php
require_once("../inc/config.php"); //Co ket noi CSDL
$get = new Teacher();
if (isset($_GET['jobID'])) {
	$idjob = $_GET['jobID'];
	$get->getJobName($idjob); //lay ten cua JobName manage
}
if (isset($_GET['jobIDD'])) {
	$idjob = $_GET['jobIDD'];
	$get->getJobNameDate($idjob); //get date cua jobName
}