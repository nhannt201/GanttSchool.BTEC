<?php
require_once("../inc/config.php"); //Co ket noi CSDL
$get = new Teacher();
if (isset($_GET['jobID'])) {
	$idjob = $_GET['jobID'];
	$get->getChildJob(0, $idjob); //Cho manage
}
if (isset($_GET['jobIDD'])) {
	$idjob = $_GET['jobIDD'];
	$get->getChildJob(1, $idjob); //In button
}
