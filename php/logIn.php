<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title> LOG IN </title>
	</head>
	<body>
		<form id="login" name="login" action="" method="post">
			<h1>LOG IN</h1>
			<label>Korreoa</label><input id="korreoa" name="korreoa" type="text"><br/><br/>
			<label>Pasahitza</label><input id="pasahitza" name="pasahitza" type="password"><br/><br/>
			<input id="botoiaLogin" type="submit" value="Log in">
			<input id="botoiAtzera" type="button" value="bueltatu">
			</body>
		</form>
		<script>
			$(document).ready(function(){
				$("#botoiAtzera").click(function(){
					location.href="layout.php"
				});
			});
		</script>
</html>
<?php
if (isset($_POST['korreoa']) && isset($_POST['pasahitza'])){
	$esteka = mysqli_connect("localhost", "id2977082_root", "12345", "id2977082_quiz");
	if (mysqli_connect_errno()) {
		echo ("Konexio hutxegitea MySQLra: " . mysqli_connect_error());
		exit();
	}
	$korreoa = $_POST['korreoa'];
	$sql = "SELECT ID, Pasahitza From erabiltzaileak WHERE Korreoa= '$korreoa'"; 
	$result = mysqli_query($esteka, $sql);
	if (mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_assoc($result);
		if(strcmp($row['Pasahitza'], $_POST['pasahitza']) == 0){
			echo('<script>location.href="layout.php?id='.$row['ID'].'"</script>');
			exit();
		}
		else{
			echo('<span style="color: red;">KORREO EDO PASAHITZA OKERRA</span>');
		}
	}
	else{
		echo('<span style="color: red;">KORREO EDO PASAHITZA OKERRA</span>');
	}
	mysqli_close($esteka);
}
?>