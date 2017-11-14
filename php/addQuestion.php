<!DOCTYPE html>
<html>
  <head>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Galderak gehitu</title>
  </head>
  <body>
		<form id="galderenF" name="galderenF" action="" method="post">
			<!--<label>Korreoa</label><input id="korreoa" name="korreoa" type="text"><br/><br/>-->
			<label >Galdera</label> <input id ="galdera" name="galdera" type="text" ><br/><br/>
			<label>Erantzun zuzena </label><input id="zuzena" name="zuzena" type="text" ><br/><br/>
			<label>Erantzun okerra 1</label><input id="oker1" name="oker1" type="text"><br/><br/>
			<label>Erantzun okerra 2</label><input id="oker2" name="oker2" type="text" ><br/><br/>
			<label>Erantzun okerra 3</label><input id="oker3" name="oker3" type="text" ><br/><br/>
			<label>Galderaren zailtasuna</label><input id="zailtasuna" name="zailtasuna" type="text" ><br/><br/>
			<label>Galderaren gai arloa</label><input id="arloa" name="arloa" type="text" ><br/><br/><br/>
			<input id="botoiErantzuna" type="submit" name="botoiErantzuna" value="erantzuna sartu">
			<input id="botoiAtera" type="submit" name="botoiAtera" value="Hasierako orrialdea"></br></br>
		</form>
</body>
<script>
    
    $(document).ready(function(){
        $("#botoiErantzuna").click(function(){
		
            /*var emailRegex = /^[a-z]{3,}[0-9][0-9][0-9]+@ikasle\.ehu\.(?:eus|es)$/
            var zailtasunaRegex = /^[1-5]{1}$/
            var korreo = $("#korreoa").val().match(emailRegex) ==  $("#korreoa").val() 
            var zailtasun = $("#zailtasuna").val().match(zailtasunaRegex) == $("#zailtasuna").val()
            var gald = $.trim($("#galdera").val()).length > 10
            var zuzen = $.trim($("#zuzena").val()).length > 0
            var ok1 = $.trim($("#oker1").val()).length >0
            var ok2 = $.trim($("#oker2").val()).length >0
            var ok3 = $.trim($("#oker3").val()).length >0
            var arlo =$.trim($("#arloa").val()).length >0
  var boolean = true
           if(!korreo){
               boolean =false
               $("#korreoa").css("background-color", "red")
           }
		   else $("#korreoa").css("background-color", "white")
           if(!gald){
               boolean =false
               $("#galdera").css("background-color", "red")
           }
		   else $("#galdera").css("background-color", "white")
           if(!zailtasun){
               boolean =false
               $("#zailtasuna").css("background-color", "red")
           }
		   else $("#zailtasuna").css("background-color", "white")
           if(!zuzen){
               boolean =false
               $("#zuzena").css("background-color", "red")
           }
		   else $("#zuzena").css("background-color", "white")
           if(!ok1){
               boolean =false
               $("#oker1").css("background-color", "red")
           }
		   else $("#oker1").css("background-color", "white")
           if(!ok2){
               boolean =false
               $("#oker2").css("background-color", "red")
           }
		   else $("#oker2").css("background-color", "white")
           if(!ok3){
               boolean =false
               $("#oker3").css("background-color", "red")
           }
		   else $("#oker3").css("background-color", "white")
           if(!arlo){
               boolean = false
               $("#arloa").css("background-color", "red")
           }
		   else $("#arloa").css("background-color", "white")
           
           if(boolean){
               location.href="http://localhost:1234/laborategiak/html/layout.html"
           }
		*/});
		$("#botoiAtera").click(function(){
		 location.href="layout.php"
		});
        
    });
</script>
</html>

<?php 
if (isset($_POST['galdera'], $_POST['zuzena'], $_POST['oker1'], $_POST['oker2'], $_POST['oker3'], $_POST['zailtasuna'], $_POST['arloa'], $_POST['botoiErantzuna'], $_GET['id'] ))
    {
$id=$_GET['id'];
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
echo ('<a href="addQuestion.php?id=$id">formulariora itzultzeko klikatu hemen</a>');
}
$row = mysqli_fetch_assoc($ema);
$korreoa= $row['Korreoa'];
/*if(!preg_match('/[a-z]{3,}[0-9][0-9][0-9]+@ikasle\.ehu\.(?:eus|es)/', $_POST['korreoa'])){
$balioztatu = False;
$errorea .= " [Korreoa]"; 
}*/
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
echo ('<a href="addQuestion.php?id=$id">formulariora itzultzeko klikatu hemen</a>');
}
else{
	echo('DATUAK ONDO GORDE DIRA</br></br>');
	echo ('<a href="showQuestions.php?id='.$id.'">datubaseko datuak ikusteko klikatu hemen</a></br></br>');	
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
	echo('<a href="showXMLQuestions.php?id='.$id.'"> XML ikusteko hemen klikatu </a></br></br>');
}

	}
else{
	echo('<span style="color: red;">DATUAK EZ DIRA XML FITXATEGIAN SARTU</span></br>');
}	
	}
if(isset($_POST['botoiAtera'], $_GET['id'])){
	$id=$_GET['id'];
	echo('<script>location.href="layout.php?id='.$id.'"</script>');
}







	
?>