<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<title>Galderak eguneratu</title>
	<link rel='stylesheet' type='text/css' href='http://uarribillaga.000webhostapp.com/Lab2/estiloak/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='http://uarribillaga.000webhostapp.com/Lab2/estiloak/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'	
		   href='http://uarribillaga.000webhostapp.com/Lab2/estiloak/smartphone.css' />
  </head>
  <body>
		<header class='main' id='h1'>
			<h2>Galderak editatu</h2>
			<?php echo("Erabiltzailea:" . $_SESSION['korreoa']);?>
		</header>
		<table>
			<tbody>
				<tr>
					<th>Zenbakia</th>
					<th>Korreoa</th>
					<th>Galdera</th>
					<th>Erantzun zuzena</th>
					<th>Erantzun okerra 1</th>
					<th>Erantzun okerra 2</th>
					<th>Erantzun okerra 3</th>
					<th>Zailtasuna</th>
					<th>Arloa</th>
					<th>Ekintza</th>
				</tr>

			<?php
				$zenb=1;
				include "configure.php";
				global $esteka;
				$sql = "SELECT * FROM questions";
				$result = mysqli_query($esteka, $sql); 
				WHILE($row=$result->fetch_assoc()){
			?>
				<tr>
					<td><?php echo $row['Zenbakia']; ?></td>
					<td><?php echo $row['Korreoa']; ?></td>
					<td><?php echo $row['Galdera']; ?></td>
					<td><?php echo $row['Zuzena']; ?></td>
					<td><?php echo $row['Okerra1']; ?></td>
					<td><?php echo $row['Okerra2']; ?></td>
					<td><?php echo $row['Okerra3']; ?></td>
					<td><?php echo $row['Zailtasuna']; ?></td>
					<td><?php echo $row['Arloa']; ?></td>
					<td><a href="reviewingQuizes.php?zenb=<?php echo $row['Zenbakia']; ?>"> Aldatu</a></td>
				</tr>
			<?php
				}
				mysqli_close($esteka);
			?>

			</tbody>
		</table></br>
		<input id="botoiEguneratu" type="button" value="Taula eguneratu">

		<h2>Galdera eguneratu</h2>
		<p>Zenbakia =
		<?php 
		if(isset($_GET['zenb'])) echo $_GET['zenb'];
		else echo("Ez duzu galdera aukeratu"); ?></p>

		<form id="galderenF" name="galderenF" action="" method="post">
			<label>Galdera</label> <input id ="galdera" name="galdera" type="text" ><br/><br/>
			<label>Erantzun zuzena</label><input id="zuzena" name="zuzena" type="text" ><br/><br/>
			<label>Erantzun okerra 1</label><input id="oker1" name="oker1" type="text"><br/><br/>
			<label>Erantzun okerra 2</label><input id="oker2" name="oker2" type="text"><br/><br/>
			<label>Erantzun okerra 3</label><input id="oker3" name="oker3" type="text"><br/><br/>
			<label>Galderaren zailtasuna</label><input id="zailtasuna" name="zailtasuna" type="text" ><br/><br/>
			<label>Galderaren gai arloa</label><input id="arloa" name="arloa" type="text"><br/><br/>
			<input id="botoiErantzuna" type="submit" name="botoiErantzuna" value="Galdera eguneratu"/>
			<input id="botoiBorratu" type="submit" name="botoiBorratu" value="Galdera borratu" />
			<input id="botoiAtera" type="submit" name="botoiAtera" value="Hasierako orrialdea"></br></br>
		</form>
	</body>
	
	<script>
		$(document).ready(function(){
			$("#botoiEguneratu").click(function(){
				location.href="reviewingQuizes.php"
			});
		});
	</script>
</html>

<?php 
	if(!isset($_SESSION['korreoa'], $_SESSION['mota']) || $_SESSION['mota']==="ikaslea"){
	echo '<style type="text/css">
	body {
		display:none;
	}
	</style>';
	echo('<script>location.href="layout.php"</script>');
	}
	else {
	echo '<style type="text/css">
        #botoiEguneratu {
            display: none;
        }
        </style>';		
	
	if(isset($_POST['botoiErantzuna'])){
		if(isset($_GET['zenb'])){
			if (!empty($_POST['galdera']) and !empty($_POST['zuzena']) and !empty($_POST['oker1']) and !empty($_POST['oker2']) and !empty($_POST['oker3']) and !empty($_POST['zailtasuna']) and !empty($_POST['arloa'])){
				$errorea = "GAIZKI SARTUTAKO DATUAK: ";
				$balioztatu = True;
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
					$zenb=1;
					include "configure.php";
					global $esteka;
					$zenbakia = $_GET['zenb'];
					$sql = "UPDATE questions SET Galdera='$_POST[galdera]', Zuzena='$_POST[zuzena]', Okerra1='$_POST[oker1]', Okerra2='$_POST[oker2]', Okerra3='$_POST[oker3]', Zailtasuna='$_POST[zailtasuna]', Arloa='$_POST[arloa]' WHERE Zenbakia=$zenbakia";
					$result = mysqli_query($esteka, $sql);
					if(!$result){
						echo('<span style="color: red;">ERROREA DATUAK SARTZERAKOAN</span></br>');
					}
					else{
						echo('<span style="color: black;">DATUAK ONDO GORDE DIRA</span></br>');
						$assessmentItems = simplexml_load_file("../xml/questions.xml");
						foreach($assessmentItems->assessmentItem as $assessmentItem){
								if($assessmentItem['id'] == $_GET['zenb']){
									$dom=dom_import_simplexml($assessmentItem);
									$dom->parentNode->removeChild($dom);
								}
							}
						$assessmentItems->asXML("../xml/questions.xml");
							$assessmentItem = $assessmentItems->addChild('assessmentItem');
							$assessmentItem->addAttribute('complexity',$_POST['zailtasuna']);
							$assessmentItem->addAttribute('subject',$_POST['arloa']);
							$assessmentItem->addAttribute('id', $zenbakia);
							$itemBody = $assessmentItem->addChild('itemBody');
							$itemBody->addChild('p',$_POST['galdera']);
							$correctResponse = $assessmentItem->addChild('correctResponse');
							$correctResponse->addChild('value',$_POST['zuzena']);
							$incorrectResponses = $assessmentItem->addChild('incorrectResponses');
							$incorrectResponses-> addChild('value',$_POST['oker1']);
							$incorrectResponses-> addChild('value',$_POST['oker2']);
							$incorrectResponses-> addChild('value',$_POST['oker3']);
							$xmlError = $assessmentItems->asXML('../xml/questions.xml');
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
					mysqli_close($esteka);
					echo '<style type="text/css">
						#botoiEguneratu {
							display: initial;
						}
						</style>';	
				}
				else{
					$errorea = '<span style="color: red;">' . $errorea; 
					$errorea .= "</span></br>";
					echo($errorea);
					echo('<span style="color: red;">DATUAK EZ DIRA DATU BASEAN SARTU</span></br>');
				}
			}
			else{
				echo('<span style="color: red;">DATU GUZTIAK BETE BEHAR DIRA</span></br>');
			}
		}
		else{
			echo('<span style="color: red;">GALDERA BAT AUKERATU BEHAR DUZU</span></br>');
		}
	}
	if(isset($_POST['botoiBorratu'], $_GET['zenb'])){
		$zenb=1;
		include "configure.php";
		global $esteka;
		$zenbakia = $_GET['zenb'];
		$sql = "DELETE FROM questions WHERE Zenbakia=$zenbakia";
		if(mysqli_query($esteka, $sql)){
			echo('<span style="color: black;">GALDERA ONDO BORRATU DA</span></br>');
			$assessmentItems = simplexml_load_file("../xml/questions.xml");
			foreach($assessmentItems->assessmentItem as $assessmentItem){
				if($assessmentItem['id'] == $_GET['zenb']){
					$dom=dom_import_simplexml($assessmentItem);
					$dom->parentNode->removeChild($dom);
					}
				}
			$assessmentItems->asXML("../xml/questions.xml");
		}
		else{
			echo('<span style="color: red;">ERROREA GALDERA BORRATZERAKOAN span></br>');
		}
		mysqli_close($esteka);
		echo '<style type="text/css">
			#botoiEguneratu {
			display: initial;
			}
			</style>';	
	}
	else{
		echo('<span style="color: red;">GALDERA BAT AUKERATU BEHAR DUZU</span></br>');
	}
	}
	if(isset($_POST['botoiAtera'])){
		echo('<script>location.href="layout.php"</script>');
	}
?>