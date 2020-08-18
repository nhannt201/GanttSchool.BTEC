<?php
class Init { //Khoi tao
	private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "gantt_school";
	public function __construct() {
		//Cau hinh connect SQL
		if(!isset($_SESSION)) {
			session_set_cookie_params(31536000,"/");
			session_start();
		}
		if(!isset($this->db)){
			$t=time();
			$conn = mysqli_connect($this->hostname, $this->username, $this->password,$this->database);
			if (!$conn) {
				die("Database servers are having problems: " . mysqli_connect_error());
			} else {
				 $this->db = $conn;
			}
			
			if (!$conn->set_charset("utf8")) { }

			date_default_timezone_set('Asia/Ho_Chi_Minh');

			if (date_default_timezone_get()) {
			  //  echo 'date_default_timezone_set: ' . date_default_timezone_get() . '';
			}
		}
	}
}

require_once("login.php"); //Import function login
require_once("teacher.php"); 
require_once("student.php"); 