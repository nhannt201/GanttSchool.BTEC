<?php
class Student extends Init {
	
	function getSubjectExist($studentID) {
		//Noi hai bang lai voi nhau
		$query_it = "SELECT classroom.className, student_class.studentID
		FROM classroom
		INNER JOIN student_class ON classroom.classID=student_class.classID
		WHERE studentID='$studentID'";
		$check = $this->db->query($query_it);
		if ($check->num_rows > 0) { 
			//$congdon = "";
			while($row = $check->fetch_assoc()) {
				echo $row['className'];
			}
		//	echo $congdon;
		//Hom nay se lam tiep phan Hoc Sinh, sao nay may cai nang cao lam them sau.
		}	
	}
}