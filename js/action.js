function addNameJobToList() { //Them ten cong viec moi vao danh sach
	var jobName = document.getElementById("nameNewJob");
	var x = document.getElementById("jobLSAD");
	var option = document.createElement("option");
	var getWarming = document.getElementById("warming");
	if (jobName.value.length < 4) {
		//getWarming.style.display = "block"; //Hien thi warming div
		getWarming.innerHTML = 'The job name is too short!';
	} else {
		//getWarming.style.display = "block"; //Hide thi warming div
		getWarming.innerHTML = 'New jobs added to the list!.'; 
		//<button onClick="hiddenWarming()" class="btn-sm btn-danger text-center">Close alert</button>
		//Them vao select list
		option.text = jobName.value;
		x.add(option);
		//Chon tu select
		option.value = jobName.value;	
		x.value = jobName.value;
		//Lam moi o nhap job name
		jobName.value= "";
		//alert("New jobs added to the list!");
	}
}

