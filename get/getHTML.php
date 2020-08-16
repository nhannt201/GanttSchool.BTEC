<?php
require_once("../get/getClass.php");
if (isset($_GET['student'])) {
	getHome::getStudent($name);
}
if (isset($_GET['teacher'])) {
	getHome::getTeacher($name);
}