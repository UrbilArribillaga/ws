<?php 
$esteka = mysqli_connect("localhost", "id2977082_root", "12345", "id2977082_quiz");
if (mysqli_connect_errno()) {
echo ("Konexio hutxegitea MySQLra: " . mysqli_connect_error());
exit();
}
$sql = "INSERT INTO questions VALUES(DEFAULT, '$_POST[korreoa]' , '$_POST[galdera]' , '$_POST[zuzena]' , '$_POST[oker1]' , '$_POST[oker2]' , '$_POST[oker3]' , '$_POST[zailtasuna]' , '$_POST[arloa]' )";
$ema = mysqli_query($esteka, $sql); 
if (!$ema)
{
echo("Errorea query-a gauzatzerakoan: ". mysqli_error($esteka));
mysqli_close($esteka);
echo ('<a href="addQuestion.html">formulariora itzultzeko klikatu hemen</a>');
}
else{
	mysqli_close($esteka);
	echo ('<a href="showQuestions.php">datubaseko datuak ikusteko klikatu hemen</a>');	
}
?>