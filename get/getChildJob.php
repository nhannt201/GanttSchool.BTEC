<?php
require_once("../inc/config.php"); //Co ket noi CSDL
$get = new Teacher();
if (isset($_GET['jobID'])) {
	$idjob = $_GET['jobID'];
	$get->getChildJob(0, $idjob); //Cho manage
}
