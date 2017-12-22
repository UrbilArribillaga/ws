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
			Erabiltzailea: Anonimoa
		</header>
		<form id="formularioa" name="formularioa" onsubmit="return balidatu()" method="post">
			Erabiltzailea(Hautazkoa)*<input type="text" id="erabiltzailea" name="erabiltzailea" oninput="konprobatuIzena(this.value)"></input>&nbsp
			<label id="izenaEgoera" name="izenaEgoera" style="color:red"></label></br>
			erabiltzailea ez baduzu erabiltzen ez zara erregistraturik egongo
			<input type="submit" value="One-play" id="onePlay" name="onePlay"></input>
			<input type="button" value="Play-by-subject" id="botoia" name="botoia" onclick="linkakLortu()"></input>
			<label id="linkak" name="linkak"></label>
		</form>
		<script>
			var xhro = new XMLHttpRequest();
			xhro.onreadystatechange = function(){
				if(xhro.readyState == 4 && xhro.status==200){
					var emaitza = xhro.responseText;
					if(emaitza == "ondo") document.getElementById('izenaEgoera').innerHTML ="";
					else if(emaitza == "izena jada erregistratua dago") document.getElementById('izenaEgoera').innerHTML =emaitza;
					else document.getElementById('linkak').innerHTML =emaitza;
				}
			}
			function konprobatuIzena(izena){
				xhro.open("POST", "izenaKonprobatu.php", true);
				xhro.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xhro.send("izena="+izena);
			}
			function balidatu(){
				return (document.getElementById('izenaEgoera').innerText == "")
			}
			function linkakLortu(){
				if(document.getElementById('izenaEgoera').innerText == "izena jada erregistratua dago"){
					document.getElementById('linkak').innerHTML ="IZEN BALIOGABEA";
				}
				else{
					xhro.open("POST", "linkakLortu.php", true);
					xhro.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					if(document.getElementById('erabiltzailea').value != "") xhro.send("erab="+document.getElementById('erabiltzailea').value);
					else xhro.send();
				}
			}
		</script>
	</body>
</html>
<?php
	if(isset($_POST['onePlay'])){
		
		if(!empty($_POST['erabiltzailea'])) echo('<script>location.href="Quiz.php?erab='.$_POST['erabiltzailea'].'"</script>');
		else echo('<script>location.href="Quiz.php"</script>');
	}
?>