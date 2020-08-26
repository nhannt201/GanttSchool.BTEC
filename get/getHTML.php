<?php
require_once("../get/getClass.php");
if (isset($_GET['student'])) {
	getHome::getStudent($name);
}
if (isset($_GET['teacher'])) {
	getHome::getTeacher($name);
}
if (isset($_GET['admin'])) {
	getHome::getAdmin($name);
}
if (isset($_GET['parent'])) {
	getHome::getParent($name);
}