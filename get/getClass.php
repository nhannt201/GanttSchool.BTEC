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
			  <a class="nav-link" data-toggle="tab" href="#menu1">Manager</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" data-toggle="tab" href="#menu2">My User</a>
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
		  <a class="nav-link" data-toggle="tab" href="#menu1">Manager</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link" data-toggle="tab" href="#menu2">My User</a>
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
	</div>

	<!-- Modal -->
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
	</div>';
	}
	
	private function getNewJob() {
		return '<h3>Create a new job</h3>
			<div class="form-inline">
			  <div class="form-group mb-2">
				<label>New job name</label>
			  </div>
			  <div class="form-group mx-sm-3 mb-2">
				<input type="text" class="form-control" id="nameNewJob" placeholder="Job 1">
			  </div>&nbsp;
			  <button onClick="addNameJobToList()" data-toggle="modal" data-target="#msgbox" class="btn btn-primary mb-2">Add</button>
			</div>
		  '.getHome::getListAdd();
	}
	
	private function getListAdd(){
		return ' <div class="form-group">
				<label for="jobLSAD">Jobs list</label>
				<select class="form-control" id="jobLSAD">
				  <option>1</option>
				  <option>2</option>
				</select>
			  </div>';
	}
	
	
	private function getManagerJob() {
		return '<div class="list-group">
		  <button type="button" class="list-group-item list-group-item-action">
			Cras justo odio
			<span class="badge badge-primary badge-pill">14</span>
		  </button>
		  <button type="button" class="list-group-item list-group-item-action">Dapibus ac facilisis in <span class="badge badge-primary badge-pill">14</span></button>
		  <button type="button" class="list-group-item list-group-item-action">Morbi leo risus</button>
		  <button type="button" class="list-group-item list-group-item-action">Porta ac consectetur ac</button>
		  <button type="button" class="list-group-item list-group-item-action" disabled>Vestibulum at eros</button>
		</div>';
	}
	
	//Phan chung, general
	
	public function getMyUser() {
		return '<div class="float-right"><button onClick="logout()" class="btn btn-danger">Logout</button></div>';
	}
}