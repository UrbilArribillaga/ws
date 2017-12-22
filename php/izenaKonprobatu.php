<?php
if(!isset($_POST['izena'])){
	$zenb=0;
	include "configure.php";
	global $esteka;
	$izena = $_POST['izena'];
	$sql = "SELECT * FROM jokalariak";
	$ema = mysqli_query($esteka, $sql);
	if (!$ema) echo("Errorea query-a gauzatzerakoan: ". mysqli_error($esteka));
	else {
		if(mysqli_num_rows($ema)==0) echo("ondo");
		else echo("izena jada erregistratua dago");
	}
	mysqli_close($esteka);
}
else{
	echo('<script>location.href="layout.php"</script>');
}
?>