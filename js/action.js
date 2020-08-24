
	//Phan function
function addNameJobToList() { //Them ten cong viec moi vao danh sach
	var jobName = document.getElementById("nameNewJob");
	var ValueNamejob = document.getElementById("nameNewJob").value;
	var jobStart = document.getElementById("startNewJob");
	var jobEnd = document.getElementById("endNewJob");
	var classroom = document.getElementById("classRM").value;
	var subject = document.getElementById("subCS").value;
	//So sanh date
	var xx = new Date(jobStart.value);
	var y = new Date(jobEnd.value);
	var emptydate = new Date('0000-00-00');
	//Ket thuc ss
	var x = document.getElementById("jobLSAD");
	var option = document.createElement("option");
	var getWarming = document.getElementById("warming");
	if (jobName.value.length < 4) {
		getWarming.innerHTML = 'The job name is too short!';
	} else if (y < xx) { //neu ngay end > start //
		getWarming.innerHTML = 'The end date must be greater than the start date!';
	}  else if ((y || xx) == "Invalid Date") { //neu bo trong ngay 
		getWarming.innerHTML = 'Not be empty date!';
	} else {
		//alert(xx);
		//getWarming.style.display = "block"; //Hide thi warming div
		getWarming.innerHTML = 'New jobs added to the list!.'; 
		//<button onClick="hiddenWarming()" class="btn-sm btn-danger text-center">Close alert</button>
		//Them vao select list
		option.text = jobName.value;
		x.add(option);
		//Add to SQL
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			
		  if (this.readyState == 4 && this.status == 200) {
			option.value = this.responseText;
			x.value = this.responseText;
			//Add list manager
			addButtonManagerLS(ValueNamejob, this.responseText);
		  }
		};
		xhttp.open("POST", "post/teacher.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("namejob=" + jobName.value + "&Sjob=" + jobStart.value + "&Ejob=" + jobEnd.value + "&class=" + classroom + "&sub=" + subject + "&submit=true");
		//Chon tu select
		//option.value = jobName.value;	
		//x.value = jobName.value;
		//Lam moi o nhap job name
		jobName.value= "";
		jobStart.value = "";
		jobEnd.value = "";
		//alert("New jobs added to the list!");
	}
}

function addButtonManagerLS(xxxx, id) {
  //Create an button type dynamically.   
   getReturn("get/getListJob.php" , "lsJobManage");
  var btn = document.createElement("BUTTON");
    var t = document.createTextNode(xxxx);

    btn.setAttribute("class","list-group-item list-group-item-action");
	btn.setAttribute("onclick", "showJobDetaild(" + id + ")");
    btn.appendChild(t);

	document.getElementById("lsJobManage").appendChild(btn);
	 
}



//https://mdbootstrap.com/docs/jquery/modals/basic/ references
function clickSelectJob_AddChildJob() {
	const text_selct_name = document.getElementById("jobLSAD").selectedOptions[0].text; //get Text
	var value_selct_name =  document.getElementById("jobLSAD").value; //job ID
	document.getElementById("needchangonLick").setAttribute("onClick", "clickAddChildJob("+value_selct_name+"); getReturn('get/getChildJob.php?jobIDD="+value_selct_name+"', 'listChildJobClick','','<br>');");
	document.getElementById("select_name").innerHTML = "<label>New job name (<b>" + text_selct_name + "</b>)</label>";
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		
	  if (this.readyState == 4 && this.status == 200) {
		document.getElementById("jobChildLS").innerHTML =  this.responseText;
	  }
	};
	xhttp.open("GET", "get/getChildJob.php?jobID=" + value_selct_name, true);
	xhttp.send();
}

function Manage_AddChildJob(jobID) { //onClick="getReturn(\'get/getChildJob.php?jobIDD='+jobID+'\', \'listChildJobClick\',\'\',\'<br>\');" 
	document.getElementById("change_bt_addJobChild").innerHTML = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>\
			<button type="button" class="btn btn-primary" onClick="clickAddChildJob('+jobID+')">Add</button>';
	var value_selct_name =  jobID; //job ID
	document.getElementById("select_name").innerHTML = "<label>New job name</label>";
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		
	  if (this.readyState == 4 && this.status == 200) {
		document.getElementById("jobChildLS").innerHTML =  this.responseText;
	  }
	};
	xhttp.open("GET", "get/getChildJob.php?jobID=" + value_selct_name, true);
	xhttp.send();
}

function clickAddChildJob(jobID=0) {
	if (jobID.length == 0) {
		var value_selct_name =  document.getElementById("jobLSAD").value; //job ID
	} else {
		var value_selct_name =  jobID;
	}
	//Tai lai thong ke neu nhu da click xem thong ke
	var get_z = document.getElementById("getDetailsStatist").innerHTML;
	if (get_z.length > 0) {
		getStatistT(value_selct_name);
	} //ket thuc update thong ke
	updateProgressTeacher(value_selct_name);
	var jobChildName = document.getElementById("nameNewJobChild");
	var x = document.getElementById("jobChildLS");
	var option = document.createElement("option");
	if (jobChildName.value.length < 4) {
		//getWarming.innerHTML = 'The job name is too short!';
	} else {
		//Them vao select list
		option.text = jobChildName.value;
		x.add(option);
		//Add to SQL
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			
		  if (this.readyState == 4 && this.status == 200) {
			option.value = this.responseText;
			x.value = this.responseText;
			getReturn('get/getChildJob.php?jobIDD=' + jobID, 'listChildJobClick','','<br>');
			if (document.getElementById("get_value_" + jobID)) {
			document.getElementById("get_value_" + jobID).innerHTML = Number(document.getElementById("get_value_" + jobID).innerHTML) + 1; 
			}
			
		  }
		};
		xhttp.open("POST", "post/teacher.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("namejob=" + jobChildName.value + "&jobID=" + value_selct_name + "&submit_child=true");
		jobChildName.value= "";
	}

}


function showJobDetaild(jobID) {
	document.getElementById("lsJobManage").innerHTML = '<div id="jobNameClick"></div>\
	<div id="listChildJobClick"></div><input type="text" style="display:none;" id="idJob" value="'+jobID+'"/>\
	<div class="form-group mx-sm-3 mb-2 "><button onClick="Manage_AddChildJob('+jobID+')" data-toggle="modal" data-target="#addjobchild" class="btn btn-primary float-right ml-1">Add job child</button>&nbsp;\
	<button class="btn btn-warning  float-right ml-1" onClick="getReturn(\'get/getListJob.php\', \'lsJobManage\')">Change Job</button>\
	<button class="btn btn-success  float-right ml-1" onClick="getStatistT('+jobID+')" >Detailed statistics</button>\
	<button class="btn btn-danger  float-right ml-1" onClick="getWMD('+jobID+')" data-toggle="modal" data-target="#deleteWM" >Delete this job</button></div><br><div id="getDetailsStatist"></div>';
	document.getElementById("listChildJobClick").innerHTML = "<p>Loading, please wait ...</p>";
	 getReturn("get/getJobName.php?jobIDD=" + jobID, "jobNameClick", "<h3>", "</h3><hr>");
	 getReturn("get/getChildJob.php?jobIDD=" + jobID, "listChildJobClick", '<div class="list-group" id="lsJobManage">', "</div><br>");
	//Set time check if cannot load.
	  myVar = setTimeout(checkEmptyLoadingFor_showJobDetaild, 500);

}

function getStatistT(jobID) {
	getReturn("get/getGeneral.php?num=5&jobID=" + jobID,"getDetailsStatist");
}

function getJCStudentCompleted(jobID, studentID) {
	loading(1);
	getReturn("get/getGeneral.php?num=6&studentID=" + studentID,"thongbaone");
	getReturn("get/getGeneral.php?num=7&studentID=" + studentID + "&jobID=" + jobID, "warming");
}

function checkEmptyLoadingFor_showJobDetaild() {
  var lsdChild = document.getElementById("listChildJobClick").innerHTML;
   var jobNameClick = document.getElementById("jobNameClick").value;
  if (lsdChild == "<p>Loading, please wait ...</p>") {
	  getReturn("get/getChildJob.php?jobIDD=" + jobID, "listChildJobClick", '<div class="list-group" id="lsJobManage">', "</div><br>");
  }
  if (jobNameClick == "") {
	  getReturn("get/getJobName.php?jobIDD=" + jobID, "jobNameClick", "<h3>", "</h3><hr>");
  }
}

function getWMD(jobID) {
	document.getElementById("title_warming_del").innerHTML = "Waring!";
	document.getElementById("warming_del").innerHTML = "Loading...";
	document.getElementById("change_bt_del").innerHTML = '<button type="button" onClick="delJobName()" class="btn btn-danger" data-dismiss="modal">Sure</button>';
	 getReturn("get/getJobName.php?jobID=" + jobID, "warming_del", "Are you sure delete '<b>", "</b>'?");
}
function getReturn(url_get, idget="", start="", end="") {
	loading(1);
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		
	  if (this.readyState == 4 && this.status == 200) {	
			if (idget.length > 0) {
				document.getElementById(idget).innerHTML =  start + this.responseText + end;
				loading(0);
			} else {loading(0);}
	  }
	};
	xhttp.open("GET", url_get, true);
	xhttp.send();
}

function updateProgressTeacher(jobID) {
	getReturn("get/getGeneral.php?num=9&jobID=" + jobID,"updateProgress");
}
function clickChildLS(id_child,jobID=0) {
	//Thay the button xoa childName
	document.getElementById("title_warming_del").innerHTML = "Details";
	document.getElementById("warming_del").innerHTML = "Loading...";
	document.getElementById("change_bt_del").innerHTML ='<button type="button" onClick="delChildJobName('+id_child+', '+jobID+')" class="btn btn-danger" data-dismiss="modal">Delete</button>\
	<button type="button" onClick="changeNamejobChild('+id_child+')" class="btn btn-primary" data-dismiss="modal">Change</button>';
	getReturn("get/getChildJob.php?childName=" + id_child, "warming_del", '<label>Change child job name</label><br><input type=\"text\" class=\"form-control\" id=\"changeNameChildJob\" placeholder=\"Change name child job\" value=\"',
	'" required/>');
} 
function changeNamejobChild(id_jobchild) {
	loading(1);
	var getContent =  document.getElementById("changeNameChildJob").value;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		
	  if (this.readyState == 4 && this.status == 200) {	
			//document.getElementById("ls_childnum_" +id_jobchild).innerHTML = getContent;
			//Hien thi span so luong da xong/ so hoc sinh
			getReturn("get/getGeneral.php?num=8&details_id=" + id_jobchild , "ls_childnum_" +id_jobchild, getContent);
			loading(0);
	  }
	};
	xhttp.open("GET", "post/postwhere.php?num=3&childjobID=" + id_jobchild + "&content=" + getContent, true);
	xhttp.send();
}
function delChildJobName(id_child, jobID=0) {
	loading(1);
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (jobID > 0) {
			updateProgressTeacher(jobID);
			var get_z = document.getElementById("getDetailsStatist").innerHTML;
			if (get_z.length > 0) {
				getStatistT(jobID);
			}
		}
		
	  if (this.readyState == 4 && this.status == 200) {	
			document.getElementById("ls_childnum_" +id_child).style.display = "none";
			loading(0);
	  }
	};
	xhttp.open("GET", "post/postwhere.php?num=2&childjobID=" + id_child, true);
	xhttp.send();
}
function loading(num) {
	switch (num) {
		case 0:
			document.getElementById("status_get").style.visibility = "hidden";
		break;
		case 1:
			document.getElementById("status_get").style.visibility = "visible";
		break;	
	}
}

function delJobName() {
	loading(1);
	var jobID = document.getElementById("idJob").value;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		
	  if (this.readyState == 4 && this.status == 200) {	
			 getReturn("get/getListJob.php", "lsJobManage");
			 getReturn("post/postwhere.php?num=1", "jobLSAD");
			
	  }
	};
	xhttp.open("GET", "post/postwhere.php?num=0&jobID=" + jobID, true);
	xhttp.send();
}

//Student processing
function clickJobNameStudent(subID, classID) {
	//Chuyen Tab
	//  $('.nav-tabs a[href="#menu1"]').tab('show');
	getReturn("get/getGeneral.php?num=0&subID=" +subID+ "&classID=" +classID, "lstCourseStudent", "", "<br>\
	<button type=\"button\"  onClick=\"clickChangeCourse()\" class=\"btn btn-primary\">Change Course</button>");
	//getReturn("get/getGeneral.php?num=1&subID=" +subID, "nameSubjectClick","<h3>","</h3>");
}
function clickChangeCourse() { //Click get lai Cac khoa hoc hien co.
	getReturn("get/getGeneral.php?num=2", "lstCourseStudent");
}

function clickShowJobDetails_Tab(jobID) {
	$('.nav-tabs a[href="#menu1"]').tab('show');
	//document.getElementById("select_manage_job").innerHTML = "";
	 getReturn("get/getChildJob.php?jobID_Student=" + jobID, "select_manage_job");
}

function clickDoJobChild(job_details_id) {
	var get_check;
	loading(1);
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {	
				get_check = this.responseText;
				loading(0);
				if (get_check == 0) { //kiem tra details job nay co bi xoa khong?
					document.getElementById("sv_click").innerHTML = "Waring";
					document.getElementById("content_dojob").innerHTML = "This job child has been deleted by Teacher!";
					document.getElementById("bt_dojob").innerHTML = '<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>';	
					document.getElementById("ls_childnum_"+job_details_id).style.display = "none";
				} else {
				document.getElementById("bt_dojob").innerHTML = '<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>\
						<button type="button" onClick="clickConfirmCompletedChildJob('+job_details_id+')" class="btn btn-primary">Confirm</button>';
					getReturn("get/getGeneral.php?num=3&detail_id=" + job_details_id, "content_dojob", "<div id=\"warning_ans\"></div><div class=\"form-group\">\
				  <label for=\"answerChildJob\">Answer (Max: 1500 characters)</label>\
				  <textarea class=\"form-control\" rows=\"5\" id=\"answerChildJob\" maxlength=\"1500\"></textarea>\
				</div><hr>Were you sure certain completed '<b>","</b>'?<br>After you had confirmed, you cannot change status!");
				}
	  }
	};
	xhttp.open("GET", "get/getGeneral.php?num=11&checkDesEx=" + job_details_id, true);
	xhttp.send();
	
}

function clickConfirmCompletedChildJob(job_details_id) { //confirm_doChildJob
	//Check noi dung cau tra loi
	var get_length_content = document.getElementById("answerChildJob").value;
	if (get_length_content.length < 5) {
		document.getElementById("warning_ans").innerHTML = '<div class="alert alert-warning">\
    <strong>Warning!</strong> The answer is too short, must be more than 5 characters!\
  </div>';
	} else if (get_length_content.length > 1500) {
		document.getElementById("warning_ans").innerHTML = '<div class="alert alert-warning">\
    <strong>Warning!</strong> Answers must be less than 1500 characters\
  </div>';
	} else {
	//Xu ly phu
	document.getElementById("warning_ans").innerHTML= "";
	$('#clickDoJobStudent').modal('hide');
	//$('#myModal').on('hidden.bs.modal', function () {
		// do something…
	//});
	//Phan xu ly chinh
	document.getElementById("ls_childnum_"+job_details_id).className = ("list-group-item list-group-item-action");
	document.getElementById("ls_childnum_"+job_details_id).setAttribute("onClick", "viewAnswer("+job_details_id+")");
	document.getElementById("ls_childnum_"+job_details_id).setAttribute("data-toggle", "modal");
	document.getElementById("ls_childnum_"+job_details_id).setAttribute("data-target", "#clickDoJobStudent");

	var getTextofLS = document.getElementById("ls_childnum_"+job_details_id).innerHTML;
	getReturn("get/getGeneral.php?num=4&confirm_doChildJob=" +job_details_id + "&answer=" + get_length_content, "ls_childnum_"+job_details_id, getTextofLS + "<span class=\"badge badge-success badge-pill float-right\">Completed - ", "</span>");
	//Xuly progress
	var get_total_pr = Number(document.getElementById("get_total_pr").value);
	var get_now_pr = Number(document.getElementById("get_now_pr").value) + 1; //Tang len 1 gtri
	document.getElementById("get_now_pr").value = get_now_pr;
	var now_prs = Math.round((get_now_pr/get_total_pr)*100);
	document.getElementById("progressxuly").setAttribute("style", "width: "+now_prs+"%");
	document.getElementById("progressxuly").setAttribute("aria-valuenow", get_now_pr);
	document.getElementById("status_progress").innerHTML = "<h3>Status: "+get_now_pr+"/" +get_total_pr+" ("+now_prs+"%)</h3>";
	}
}

function viewAnswer(job_details_id) {
		//Sua li thong tin msg
	document.getElementById("content_dojob").innerHTML = "";
	document.getElementById("sv_click").innerHTML = "My Answer";
	document.getElementById("bt_dojob").innerHTML = '<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>';
	getReturn("get/getGeneral.php?num=10&details_id=" + job_details_id, "content_dojob");
}
