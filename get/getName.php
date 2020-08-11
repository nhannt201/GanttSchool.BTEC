<?php
require_once("../inc/config.php");
$login = new Get();
if (isset($_SESSION['teacher_log'])) {
	echo $_SESSION['teacher_log'];
}
if (isset($_SESSION['student_log'])) {
	echo $_SESSION['student_log'];
}
if (isset($_SESSION['parent_log'])) {
	echo $_SESSION['parent_log'];
}