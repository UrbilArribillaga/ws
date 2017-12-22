<?php
$zenb=0;
include "configure.php";
global $esteka;
$sql = "SELECT DISTINCT Arloa FROM questions";
$ema = mysqli_query($esteka, $sql);
if (!$ema) echo("Errorea query-a gauzatzerakoan: ". mysqli_error($esteka));
else{
	$link="</br>";
	while ($row = mysqli_fetch_assoc($ema)){ 
		if(isset($_POST['erab'])) $link .= "<a href='Quiz.php?arloa=".$row["Arloa"]."&erab=".$_POST['erab']."'>".$row["Arloa"]."</a></br>";
		else $link .= "<a href='Quiz.php?arloa=".$row["Arloa"]."'>".$row["Arloa"]."</a></br>";
	}
	echo($link);
	mysqli_close($esteka);
}
?>

