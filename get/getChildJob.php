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
if (isset($_GET['childName'])) {
	$idjob = $_GET['childName'];
	$get->getChildName($idjob); //In ten jobChildName
}

