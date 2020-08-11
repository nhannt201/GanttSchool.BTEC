<?php
//File post nay de danh cho JS
require_once("../inc/config.php");
$login = new Login();
if (isset($_POST['teacher_log'])) {
	$user = isset($_POST['user']) ? $_POST['user'] : '';
	$pass = isset($_POST['pass']) ? $_POST['pass'] : '';
	$login->checklog(1, $user, $pass);
}
if (isset($_POST['student_log'])) {
	$user = isset($_POST['user']) ? $_POST['user'] : '';
	$pass = isset($_POST['pass']) ? $_POST['pass'] : '';
	$login->checklog(2, $user, $pass);
}
if (isset($_POST['parent_log'])) {
	$user = isset($_POST['user']) ? $_POST['user'] : '';
	$pass = isset($_POST['pass']) ? $_POST['pass'] : '';
	$login->checklog(3, $user, $pass);
}