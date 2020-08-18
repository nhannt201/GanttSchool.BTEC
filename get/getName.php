<?php //Dung lay ten da luu trong Session
require_once("../inc/config.php");
$init = new Init();
if (isset($_SESSION['teacher_log'])) {
	$name = $_SESSION['teacher_log'];
}
if (isset($_SESSION['student_log'])) {
	$name = $_SESSION['student_log'];
}
if (isset($_SESSION['parent_log'])) {
	$name = $_SESSION['parent_log'];
}