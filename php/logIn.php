<?php
	ini_set("session.use_cookies", 1);
	session_start(); 
?>
<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title> LOG IN </title>
	</head>
	<body>
	<?php 
	
	?>
		<form id="login" name="login" action="" method="post">
			<h1>LOG IN</h1>
			<label>Korreoa</label><input id="korreoa" name="korreoa" type="text"><br/><br/>
			<label>Pasahitza</label><input id="pasahitza" name="pasahitza" type="password"><br/><br/>
			<input id="botoiaLogin" type="submit" value="Log in">
			<input id="botoiAtzera" type="button" value="Bueltatu">
		</form></br>
		<a href="passwordRecovery.php">Ez duzu pasahitza gogoratzen?</a>
		
	</body>
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
	$zenb=1;
	include "configure.php";
	global $esteka;
	$korreoa = $_POST['korreoa'];
	$sql = "SELECT ID, Pasahitza From erabiltzaileak WHERE Korreoa= '$korreoa'"; 
	$result = mysqli_query($esteka, $sql);
	if (mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_assoc($result);
		if(password_verify($_POST['pasahitza'], $row['Pasahitza'])){
			$_SESSION['korreoa']= $korreoa;
			if(strcmp($korreoa, "web000@ehu.es")==0){
				$_SESSION['mota']="irakaslea";
				echo('<script>location.href="reviewingQuizes.php"</script>');
				}
			else{ 
				$_SESSION['mota']="ikaslea";
				echo('<script>location.href="handlingQuizes.php"</script>');
			}
		}
		else{
			echo('<span style="color: red;">PASAHITZAREKIN ARAZOAK</span>');
		}
	}
	else{
		echo('<span style="color: red;">KORREO EDO PASAHITZA OKERRA</span>');
	}
	mysqli_close($esteka);
}
?>