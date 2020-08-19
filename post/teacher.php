<?php
//File post nay de danh cho JS
require_once("../inc/config.php");
$add = new Teacher();
if (isset($_POST['submit'])) {
	$name = $_POST['namejob'];
	$dtS = $_POST['Sjob'];
	$dtE = $_POST['Ejob'];
	$sub = $_POST['sub'];
	$class = $_POST['class'];
	$add->addNewJob($name, $dtS, $dtE, $class, $sub);
}
if (isset($_POST['submit_child'])) {
	$name = $_POST['namejob'];
	$jobID = $_POST['jobID'];
	$add->addNewChildJob($jobID, $name);
}