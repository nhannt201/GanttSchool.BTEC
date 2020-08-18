<?php
require_once("../get/getName.php"); //Co ket noi CSDL
class getHome extends Init{ //Thua ke ket noi CSDL
	
	public function getStudent($name_student) {
		echo '<div class="container mt-3">
		  <h2>Gantt School</h2>
		  <div id="welcome_to">Welcome, '.$name_student.'!
		  </div>
		  <br>
		  <ul class="nav nav-tabs">
			<li class="nav-item">
			  <a class="nav-link active" data-toggle="tab" href="#home">My Job</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" data-toggle="tab" href="#menu1">Manage</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" data-toggle="tab" href="#menu2">Account</a>
			</li>
		  </ul>
		  <div class="tab-content">
			<div id="home" class="container tab-pane active"><br>
			 <div class="list-group">
			  <button type="button" class="list-group-item list-group-item-action">
				Cras justo odio
				<span class="badge badge-primary badge-pill">14</span>
			  </button>
			  <button type="button" class="list-group-item list-group-item-action">Dapibus ac facilisis in <span class="badge badge-primary badge-pill">14</span></button>
			  <button type="button" class="list-group-item list-group-item-action">Morbi leo risus</button>
			  <button type="button" class="list-group-item list-group-item-action">Porta ac consectetur ac</button>
			  <button type="button" class="list-group-item list-group-item-action" disabled>Vestibulum at eros</button>
			</div>
			</div>
			<div id="menu1" class="container tab-pane fade"><br>
			  <h3>Menu 1</h3>
			  <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			</div>
			<div id="menu2" class="container tab-pane fade"><br>
			  '.getHome::getMyUser().'
			</div></div>
		</div>';
	}
	//Phan nay danh xu ly cho giao vien
	public function getTeacher($name) {
		echo '<div class="container mt-3">
	  <h2>Gantt School</h2>
	  <div id="welcome_to">Welcome, '.$name.'!
	  </div>
	  <br>
	  <ul class="nav nav-tabs">
		<li class="nav-item">
		  <a class="nav-link active" data-toggle="tab" href="#home">New Job</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link" data-toggle="tab" href="#menu1">Manage</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link" data-toggle="tab" href="#menu2">Account</a>
		</li>
	  </ul>
	  
	  <div class="tab-content">
		<div id="menu1" class="container tab-pane fade"><br>
		 '.getHome::getManagerJob().'
		</div>
		<div id="home" class="container tab-pane active"><br>
		  '.getHome::getNewJob().'
		</div>
		<div id="menu2" class="container tab-pane fade"><br>
		  '.getHome::getMyUser().'
		</div>
		</div>
	</div>'.getHome::getMsgbox();
	}
	
	private function getNewJob() {
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
		  </div>
		  <div class="modal-footer">
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
			<h5 class="modal-title" id="xoacv">Warming!</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body" id="warming_del">
		  
		  </div>
		  <div class="modal-footer">
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
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary" onClick="clickAddChildJob()">Add</button>
		  </div>
		</div>
	  </div>
	</div>';
	}
}