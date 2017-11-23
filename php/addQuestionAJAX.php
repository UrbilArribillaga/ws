<?php 
session_start();
if (isset($_POST['galdera'], $_POST['zuzena'], $_POST['oker1'], $_POST['oker2'], $_POST['oker3'], $_POST['zailtasuna'], $_POST['arloa'], $_SESSION['id'], $_SESSION['mota']) && $_SESSION['mota']==="ikaslea")
{
	$id= $_POST['id'];
	$zenb=0;
	include "configure.php";
	global $esteka;
$errorea = "GAIZKI SARTUTAKO DATUAK: ";
$balioztatu = True;

$sql = "SELECT Korreoa FROM erabiltzaileak WHERE ID='$id'";
$ema = mysqli_query($esteka, $sql);
if (!$ema)
{
echo("Errorea query-a gauzatzerakoan: ". mysqli_error($esteka));
}
$row = mysqli_fetch_assoc($ema);
$korreoa= $row['Korreoa'];
if(strlen(preg_replace('/\s+/', '', $_POST['galdera'])) < 10){
	$balioztatu = False;
	$errorea .= " [Galdera]";
}
if(strlen(preg_replace('/\s+/', '', $_POST['zuzena'])) < 1){
	$balioztatu = False;
	$errorea .= " [zuzena]";
}
if(strlen(preg_replace('/\s+/', '', $_POST['oker1'])) < 1){
	$balioztatu = False;
	$errorea .= " [oker1]";
}
if(strlen(preg_replace('/\s+/', '', $_POST['oker2'])) < 1){
	$balioztatu = False;
	$errorea .= " [oker2]";
}
if(strlen(preg_replace('/\s+/', '', $_POST['oker3'])) < 1){
	$balioztatu = False;
	$errorea .= " [oker3]";
}

if(!preg_match('/^[1-5]{1}$/', $_POST['zailtasuna'])){
	$balioztatu = False;
	$errorea .= " [Zailtasuna]";
}

if(strlen(preg_replace('/\s+/', '', $_POST['arloa'])) < 1){
	$balioztatu = False;
	$errorea .= " [arloa]";
}
if($balioztatu){
$sql = "INSERT INTO questions VALUES(DEFAULT, '$korreoa' , '$_POST[galdera]' , '$_POST[zuzena]' , '$_POST[oker1]' , '$_POST[oker2]' , '$_POST[oker3]' , '$_POST[zailtasuna]' , '$_POST[arloa]' )";
$ema = mysqli_query($esteka, $sql); 
if (!$ema)
{
echo("Errorea query-a gauzatzerakoan: ". mysqli_error($esteka));
}
else{
	echo('DATUAK ONDO GORDE DIRA</br></br>');
}
	
}

else{
	$errorea = '<span style="color: red;">' . $errorea; 
	$errorea .= "</span></br>";
	echo($errorea);
	echo('<span style="color: red;">DATUAK EZ DIRA DATU BASEAN SARTU</span></br>');
}

mysqli_close($esteka);

//XML fitxategian datuak txertatu
if($balioztatu){
$xml = simplexml_load_file("../xml/questions.xml");

$assessmentItem = $xml->addChild('assessmentItem');
$assessmentItem->addAttribute('complexity',$_POST['zailtasuna']);
$assessmentItem->addAttribute('subject',$_POST['arloa']);

$itemBody = $assessmentItem->addChild('itemBody');
$itemBody->addChild('p',$_POST['galdera']);

$correctResponse = $assessmentItem->addChild('correctResponse');
$correctResponse->addChild('value',$_POST['zuzena']);

$incorrectResponses = $assessmentItem->addChild('incorrectResponses');
$incorrectResponses-> addChild('value',$_POST['oker1']);
$incorrectResponses-> addChild('value',$_POST['oker2']);
$incorrectResponses-> addChild('value',$_POST['oker3']);
$xmlError = $xml->asXML('../xml/questions.xml');
if (!$xmlError){
	$errorea = '<span style="color: red;">' . $errorea; 
	$errorea .= "</span></br>";
	echo($errorea);
	echo('<span style="color: red;">DATUAK EZ DIRA XML FITXATEGIAN SARTU</span></br>');
}
else{
	echo('<span style="color: red;">DATUAK XML FITXATEGIAN ONDO GORDE DIRA</span></br>');
}
}
else{
	echo('<span style="color: red;">DATUAK EZ DIRA XML FITXATEGIAN SARTU</span></br>');
}
	
	}
	else{
			echo('<span style="color: red;">EZ DIRA DATU GUZTIAK SARTU</span></br>');	
	}
?>