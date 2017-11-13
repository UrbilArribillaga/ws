<?php
	if($id==0){
		$esteka = mysqli_connect("localhost", "root", "", "quiz");
	}
	else{
		$esteka = mysqli_connect("localhost", "id2977082_root", "12345", "id2977082_quiz");
	
	}
	if (mysqli_connect_errno()) {
		echo ("Konexio hutxegitea MySQLra: " . mysqli_connect_error());
		exit();
	}

?>