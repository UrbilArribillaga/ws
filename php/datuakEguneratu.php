<?php 
session_start();
if(isset($_SESSION['korreoa'], $_SESSION['mota']) && $_SESSION['mota']== "ikaslea"){
	$zenb=1;
	include "configure.php";
	global $esteka;
	$sql ="SELECT * FROM questions";
	$ema= mysqli_query($esteka, $sql);
	if(!$ema){
		echo('<span style="color: red;">ERROREA DATUAK LORTZERAKOAN</span></br>');
	}
	else{
		$galderakop = mysqli_num_rows($ema);
		$korreoa = $_SESSION['korreoa'];
		$sql ="SELECT * FROM questions WHERE Korreoa= '$korreoa' ";
		$ema= mysqli_query($esteka, $sql);
		if(!$ema){
			echo('<span style="color: red;">ERROREA DATUAK LORTZERAKOAN</span></br>');
		}
		else{
			$niregalderakop = mysqli_num_rows($ema);
		}
	}
	echo("nik egindako galderak/galdera guztiak: ".$niregalderakop . "/" . $galderakop );
}
else{
	echo('<script>location.href="layout.php"</script>');
}
?>