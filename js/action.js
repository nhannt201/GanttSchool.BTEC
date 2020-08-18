
	//Phan function
function addNameJobToList() { //Them ten cong viec moi vao danh sach
	var jobName = document.getElementById("nameNewJob");
	var ValueNamejob = document.getElementById("nameNewJob").value;
	var jobStart = document.getElementById("startNewJob");
	var jobEnd = document.getElementById("endNewJob");
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
		xhttp.send("namejob=" + jobName.value + "&Sjob=" + jobStart.value + "&Ejob=" + jobEnd.value + "&submit=true");
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

function clickAddChildJob() {
	var value_selct_name =  document.getElementById("jobLSAD").value; //job ID
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
	<div class="form-group mx-sm-3 mb-2"><button class="btn btn-warning" onClick="getReturn(\'get/getListJob.php\', \'lsJobManage\')">Change Job</button>\
	<button class="btn btn-danger" onClick="getWMD('+jobID+')" data-toggle="modal" data-target="#deleteWM" >Delete this job</button></div>';	
	 getReturn("get/getJobName.php?jobID=" + jobID, "jobNameClick", "<h3>", "</h3><hr>");
	 getReturn("get/getChildJob.php?jobIDD=" + jobID, "listChildJobClick", '<div class="list-group" id="lsJobManage">', "</div><br>");
}

function getWMD(jobID) {
	 getReturn("get/getJobName.php?jobID=" + jobID, "warming_del", "Are you sure delete '<b>", "</b>'?");
}
function getReturn(url_get, idget, start="", end="") {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		
	  if (this.readyState == 4 && this.status == 200) {	
			document.getElementById(idget).innerHTML =  start + this.responseText + end;
	  }
	};
	xhttp.open("GET", url_get, true);
	xhttp.send();
}

function delJobName() {
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

