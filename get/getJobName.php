<?php
require_once("../inc/config.php"); //Co ket noi CSDL
$get = new Teacher();
if (isset($_GET['jobID'])) {
	$idjob = $_GET['jobID'];
	$get->getJobName($idjob); //Cho manage
}
