<?php
require_once("../get/getName.php"); //Co ket noi CSDL
class getHome extends Init{ //Thua ke ket noi CSDL

	//For Admin
	public function getAdmin($admin_user) {
		echo '<div class="container mt-3">
		  <h2>Gantt School</h2>
		  <div id="welcome_to">Hello, '.$admin_user.'!
		  </div>
		  <div id="status_get" style="visibility:hidden;">
		   <div class="progress">
			  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
			</div>
		  </div>
		  <br>
		  <ul class="nav nav-tabs">
			<li class="nav-item">
			  <a class="nav-link active" data-toggle="tab" href="#home">Manage Account</a>
			</li>	
			<li class="nav-item">
			  <a class="nav-link" data-toggle="tab" href="#newacc" onClick="reloadCreateAccount()">New Account</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" data-toggle="tab" href="#newsub">New Course</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" data-toggle="tab" href="#newclass">New Classroom</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" data-toggle="tab" href="#myacc">My Account</a>
			</li>
		  </ul>
		  <div class="tab-content">
			<div id="home" class="container tab-pane active"><br>
				'.getHome::getManageAcc().'
			</div>
			<div id="newsub" class="container tab-pane fade"><br>
			  '.getHome::getNewSubject().'
			</div>
			<div id="newacc" class="container tab-pane fade"><br>
			  '.getHome::getNewAccount().'
			</div>
			<div id="newclass" class="container tab-pane fade"><br>
			  '.getHome::getNewClass().'
			</div>
			<div id="myacc" class="container tab-pane fade"><br>
			  '.getHome::getMyUser().'
			</div></div>
		</div>'.getHome::getMsgbox();
	}
	private function getManageAcc() {
		return '<h3>Manage Account</h3><hr>
			<div class="form-group mx-sm-3 mb-2">
				<label for="selectAccMana">Account</label>
				<select onClick="clickCheckManageAcc();" class="form-control" id="selectAccMana">
					<option value="0">Teacher</option>
					<option value="1">Student</option>
					<option value="2">Parent</option>
				</select>
			  </div><div id="manage_add"></div>';
	}
	private function getNewSubject() {
		$admin = new Admin();
		return '<h3>Create a new course</h3><hr>
			<div class="form-group mx-sm-3 mb-2">
				<label>Course name</label>
				<input type="text" class="form-control" id="nameSubject" placeholder="NETWORKING" required>
			  </div>
			  <div class="form-group mx-sm-3 mb-2">
				<label>Course ID (An abbreviation, 3 characters)</label>
				<input type="text" class="form-control" id="subIDSubject" maxlength="3" placeholder="NET" required>
				<br>
				<button onClick="addNewSubject()" data-toggle="modal" data-target="#msgbox" class="btn btn-primary mb-2 float-right">Add</button>
			  </div><br>
			  <h3>Manage Course</h3><hr>
			  <div class="form-group mx-sm-3 mb-2">
				<label for="CourseCourse">Course</label>
				<select class="form-control" id="CourseCourse">
					'.$admin->getSubject(0).'
				</select><br>
				<button onClick="showActionEditCourse()" data-toggle="modal" data-target="#msgbox" class="btn btn-primary mb-2 float-right">Action</button>
			  </div><div class="space_free"></div>';
	}
	
	private function getNewAccount() {
		$admin = new Admin();
		return '<div id="form_create"><h3>Create a new account</h3><hr>
				<div class="form-group mx-sm-3 mb-2">
				<label for="selectAcc">Account</label>
				<select onclick="checkSlcAcc();" class="form-control" id="selectAcc">
					<option value="0">Teacher</option>
					<option value="1">Student</option>
					<option value="2">Parent</option>
				</select>
			  </div>
			<div class="form-group mx-sm-3 mb-2">
				<label>Full name</label>
				<input type="text" class="form-control" id="accName" value="" placeholder="Le Thi A" required>
			  </div>
			  <div class="form-group mx-sm-3 mb-2">
				<label>Email</label>
				<input type="email" class="form-control" id="accEmail" maxlength="250" value="" placeholder="email@gmail.com" required>
			  </div>
			  <div class="form-group mx-sm-3 mb-2">
				<label>Username</label>
				<input type="text" class="form-control" id="accUser" maxlength="250"  value="" placeholder="myusername" required>
			  </div>
			  <div class="form-group mx-sm-3 mb-2">
				<label>Password</label>
				<input type="password" class="form-control" id="accPass" value="" placeholder="Default password is \'password\'" required>
			  </div>
			  <div class="form-group mx-sm-3 mb-2">
				<label for="slcClass">Classroom</label>
				<select class="form-control" id="slcClass">
						'.$admin->getClassroom(0).'
				</select>
			  </div>
			  <div class="form-group mx-sm-3 mb-2" id="div_teacher">
				<label for="slcSub">Course</label>
				<select class="form-control" id="slcSub">
					'.$admin->getSubject(0).'
				</select>
			  </div>
			  <div class="form-group mx-sm-3 mb-2" id="div_parent" style="display: none;">
				<label for="slcStudent">Student</label>
				<select class="form-control" id="slcStudent">
				</select>
			  </div><br><button id="hidden_bt_acc" onClick="addNewAccount()" data-toggle="modal" data-target="#msgbox" class="btn btn-primary mb-2 float-right">Add</button>
			  <div class="space_free"></div></div>';
	}
	
	private function getNewClass() {
		$admin  = new Admin();
		return '<h3>Create a new classroom</h3><hr>
			<div class="form-group mx-sm-3 mb-2">
				<label>Classroom name</label>
				<input type="text" class="form-control" id="nameClassroom" placeholder="IT-1709" required><br>
				<button onClick="addNewClass()" data-toggle="modal" data-target="#msgbox" class="btn btn-primary mb-2 float-right">Add</button>
			  </div>
			  
			  <h3>Manage Classroom</h3><hr>
			  <div class="form-group mx-sm-3 mb-2">
				<label for="ClassroomAv">Classroom</label>
				<select class="form-control" id="ClassroomAv">
					'.$admin->getClassroom(0).'
				</select><br>
				<button onClick="showActionEditClass()" data-toggle="modal" data-target="#msgbox" class="btn btn-primary mb-2 float-right">Action</button>
			  </div><div class="space_free"></div>';
	}
	//For Parent
	public function getParent($name_parent) {
		//$student = new Student();
		//if (isset($_SESSION['student_id'])) {
		//	$studentID = $_SESSION['student_id'];
		//}
		echo '<div class="container mt-3">
		  <h2>Gantt School</h2>
		  <div id="welcome_to">Welcome, '.$name_parent.'!
		  </div>
		  <div id="status_get" style="visibility:hidden;">
		   <div class="progress">
			  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
			</div>
		  </div>
		  <br>
		  <ul class="nav nav-tabs">
			<li class="nav-item">
			  <a class="nav-link active" data-toggle="tab" href="#home">Student</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" data-toggle="tab" href="#menu1">Follow</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" data-toggle="tab" href="#menu2">Account</a>
			</li>
		  </ul>
		  <div class="tab-content">
			<div id="home" class="container tab-pane active"><br>
			<div id="lstCourseStudent">
			 <div class="list-group">
		
			</div>
			</div>
			</div>
			<div id="menu1" class="container tab-pane fade"><br>
			  
			</div>
			<div id="menu2" class="container tab-pane fade"><br>
			  '.getHome::getMyUser().'
			</div></div>
		</div>'.getHome::getMsgbox();
	}
	//For Student
	public function getStudent($name_student) {
		$student = new Student();
		if (isset($_SESSION['student_id'])) {
			$studentID = $_SESSION['student_id'];
		}
		echo '<div class="container mt-3">
		  <h2>Gantt School</h2>
		  <div id="welcome_to">Welcome, '.$name_student.'!
		  </div>
		  <div id="status_get" style="visibility:hidden;">
		   <div class="progress">
			  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
			</div>
		  </div>
		  <br>
		  <ul class="nav nav-tabs">
			<li class="nav-item">
			  <a class="nav-link active" data-toggle="tab" href="#home">Course</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" data-toggle="tab" href="#menu1">Jobs</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" data-toggle="tab" href="#menu2">Account</a>
			</li>
		  </ul>
		  <div class="tab-content">
			<div id="home" class="container tab-pane active"><br>
			<div id="lstCourseStudent">
			 <div class="list-group">
			  '.$student->getSubjectStudent($studentID).'
			</div>
			</div>
			</div>
			<div id="menu1" class="container tab-pane fade"><br>
			  '.getHome::Manage_Jobs().'
			</div>
			<div id="menu2" class="container tab-pane fade"><br>
			  '.getHome::getMyUser().'<br>'.$student->getAccountInfo($studentID).'
			</div></div>
		</div>'.getHome::getMsgbox();
	}
	
	private function Manage_Jobs() {
		return "<div id=\"select_manage_job\"><div class=\"alert alert-warning\">
					  You have not selected a Job.
					</div></div>";
	}
	//Phan nay danh xu ly cho giao vien
	public function getTeacher($name) {
		$get = new Teacher();
		$teacherID = isset($_SESSION['teacher_id']) ? $_SESSION['teacher_id'] : '';
		echo '<div class="container mt-3">
	  <h2>Gantt School</h2>
	  <div id="welcome_to">Welcome, '.$name.'!
	  </div>
	  <div id="status_get" style="visibility:hidden;">
		   <div class="progress">
			  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
			</div>
	  </div>
	  <br>
	  <ul class="nav nav-tabs">
		<li class="nav-item">
		  <a class="nav-link active" data-toggle="tab" href="#home">New Job</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link" data-toggle="tab" onClick="getReturn(\'get/getListJob.php\', \'lsJobManage\');" href="#menu1">Manage</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link" data-toggle="tab" href="#menu2">Account</a>
		</li>
	  </ul>
	  
	  <div class="tab-content">
		<div id="menu1" class="container tab-pane fade"><br>
		 '.getHome::getManagerJob().'<div class="space_free"></div>
		</div>
		<div id="home" class="container tab-pane active"><br>
		  '.getHome::getNewJob().'
		</div>
		<div id="menu2" class="container tab-pane fade"><br>
		  '.getHome::getMyUser().'<br>'.$get->getAccountInfo($teacherID).'
		</div>
		</div>
	</div>'.getHome::getMsgbox();
	}
	
	private function getNewJob() {
		$get = new Teacher();
		$teacherID = isset($_SESSION['teacher_id']) ? $_SESSION['teacher_id'] : '';
		return '<h3>Create a new job</h3>
			  <div class="form-group mx-sm-3 mb-2">
				<label>New job name</label>
				<input type="text" class="form-control" id="nameNewJob" placeholder="Job 1" required>
			  </div>
			  <div class="form-group mx-sm-3 mb-2">
				<label>Job start day</label>
				<input type="date" class="form-control" id="startNewJob" required>
			  </div>
			  <div class="form-group mx-sm-3 mb-2">
				<label>Job end day</label>
				<input type="date" class="form-control" id="endNewJob" placeholder="" required>
			  </div>
			  <div class="form-group mx-sm-3 mb-2">
				<label for="classRM">Classroom</label>
				<select class="form-control" id="classRM">
					'.$get->getClassroom(0, $teacherID).'
				</select>
			  </div>
			  <div class="form-group mx-sm-3 mb-2">
				<label for="subCS">Subject</label>
				<select class="form-control" id="subCS">
					'.$get->getSubjects(0, $teacherID).'
				</select>
			  </div>
			  <div class="form-group mx-sm-3 mb-2">
				<button onClick="addNameJobToList()" data-toggle="modal" data-target="#msgbox" class="btn btn-primary mb-2 float-right">Add</button>
			   </div>
		  '.getHome::getListAdd();
	}
	
	private function getListAdd(){
		$get = new Teacher();
		return '<br><h3>Add job child</h3> <div class="form-group mx-sm-3 mb-2">
				<label for="jobLSAD">Jobs list (Choose a job)</label>
				<select class="form-control" id="jobLSAD"> <!--onClick="clickSelectJob()"-->
					'.$get->getNewJob(0).'
				</select>
			  </div>
			  <!--<div id="chosening"></div>-->
			  <div class="form-group mx-sm-3 mb-2">
			  <button onClick="clickSelectJob_AddChildJob()" data-toggle="modal" data-target="#addjobchild" class="btn btn-primary mb-2 float-right">Add job child</button>
			  </div>';
	}
	
	
	private function getManagerJob() {
		$get = new Teacher();
		return '<div class="list-group" id="lsJobManage">'.$get->getNewJob(1).'</div>'; //<span class="badge badge-primary badge-pill">14</span>
	}
	
	//Phan chung, general
	
	public function getMyUser() {
		return '<div class="float-right"><button onClick="logout()" class="btn btn-danger">Logout</button></div>';
	}
	
	public function getMsgbox() {
		return '<!-- Modal Msgbox-->
	<div class="modal fade" id="msgbox" tabindex="-1" role="dialog" aria-labelledby="thongbaone"
	  aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="thongbaone">Notification</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body" id="warming">
			Loading...
		  </div>
		  <div class="modal-footer" id="can_changeBT">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
	<!-- Modal Delete Job-->
	<div class="modal fade" id="deleteWM" tabindex="-1" role="dialog" aria-labelledby="xoacv"
	  aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="xoacv"><div id="title_warming_del">Warning!</div></h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body" id="warming_del">
			Loading...
		  </div>
		  <div class="modal-footer" id="change_bt_del">
			<button type="button" onClick="delJobName()" class="btn btn-danger" data-dismiss="modal">Sure</button>
		  </div>
		</div>
	  </div>
	</div>
	<!-- Modal Add job child-->
	<div class="modal fade" id="addjobchild" tabindex="-1" role="dialog" aria-labelledby="inoutnhap"
	  aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="inoutnhap">Add job child</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
				<!--Content-->
					<div class="form-group mx-sm-3 mb-2">
				<div id="select_name"></div>
				<input type="text" class="form-control" id="nameNewJobChild" placeholder="Do something...more than 4 characters" required>
				<br><label for="jobLSAD">Jobs child list</label>
				<select class="form-control" id="jobChildLS">
				</select>
			  </div>
				<!--End content-->
		  </div>
		  <div class="modal-footer" id="change_bt_addJobChild">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary" id="needchangonLick" onClick="clickAddChildJob(0)">Add</button>
		  </div>
		</div>
	  </div>
	</div>
	<!--Check_Do_SV-->
	<div class="modal fade" id="clickDoJobStudent" tabindex="-1" role="dialog" aria-labelledby="sv_click"
	  aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="sv_click"><div>Confirm Completed</div></h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body" id="content_dojob">
			Loading...
		  </div>
		  <div class="modal-footer" id="bt_dojob">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			<!--<button type="button" onClick="clickConfirmCompletedChildJob()" class="btn btn-primary" data-dismiss="modal">Confirm</button>-->
		  </div>
		</div>
	  </div>
	</div>';
	}
}