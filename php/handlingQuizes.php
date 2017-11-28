<!DOCTYPE html>
<?php session_start(); ?>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Galderak gehitu</title>
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
		
		</header>
		<form id="galderenF" name="galderenF" action="" method="post">
			<header class='main' id='h1'>
				<h2>galderak maneiatu</h2>
			</header>
			<span><input type="button" id="botoiGehitu" name="botoiGehitu" onclick="galderaSartu()" value=" addQuestion"></input>
			<input type="button" id="botoiErakutsi" name="botoiErakutsi" onclick="datuakEskatu()" value="showQuestions"></input></span><br/><br/>
			<label >Galdera</label> <input id ="galdera" name="galdera" type="text" ><br/><br/>
			<label>Erantzun zuzena </label><input id="zuzena" name="zuzena" type="text" ><br/><br/>
			<label>Erantzun okerra 1</label><input id="oker1" name="oker1" type="text"><br/><br/>
			<label>Erantzun okerra 2</label><input id="oker2" name="oker2" type="text" ><br/><br/>
			<label>Erantzun okerra 3</label><input id="oker3" name="oker3" type="text" ><br/><br/>
			<label>Galderaren zailtasuna</label><input id="zailtasuna" name="zailtasuna" type="text" ><br/><br/>
			<label>Galderaren gai arloa</label><input id="arloa" name="arloa" type="text" ><br/><br/><br/>
			<input id="botoiAtera" type="submit" name="botoiAtera" value="Hasierako orrialdea"></br></br>
			<span id="egoera"></span>
			<div id="emaitza"></div>
		</form>
</body>
<script language = "javascript">
    var xhro= new XMLHttpRequest();
	xhro.onreadystatechange = function(){
		switch(xhro.readyState){
			case 0: document.getElementById('egoera').innerHTML = "Hasi gabe ..."; break;
			case 1: document.getElementById('egoera').innerHTML = "<b>Kargatzen ...</b>"; break;
			case 2: document.getElementById('egoera').innerHTML = "<b>Kargatzen2 ...</b>"; break;
			case 3: document.getElementById('egoera').innerHTML = "Elkarrekintza ..."; break;
			case 4: document.getElementById('egoera').innerHTML = "<b>AMAITUA</b>"; 
					if(xhro.status==200) document.getElementById('emaitza').innerHTML = xhro.responseText;
		}
		
	}
	function datuakEskatu(){
		xhro.open("POST", "showQuestionsAJAX.php", true);
		xhro.send();
	}
	function galderaSartu(){
		xhro.open("POST", "addQuestionAJAX.php", true);
		xhro.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		var galdera = document.getElementById('galdera').value;
		var zuzena = document.getElementById('zuzena').value;
		var oker1 = document.getElementById('oker1').value;
		var oker2 = document.getElementById('oker2').value;
		var oker3 = document.getElementById('oker3').value;
		var arloa = document.getElementById('arloa').value;
		var zailtasuna = document.getElementById('zailtasuna').value;
		xhro.send("galdera="+galdera+"&zuzena="+zuzena+"&oker1="+oker1+"&oker2="+oker2+"&oker3="+oker3+"&arloa="+arloa+"&zailtasuna="+zailtasuna);
	}
</script>
</html>

<?php 

if(!isset($_SESSION['id'], $_SESSION['mota']) || $_SESSION['mota']==="irakaslea"){
	echo '<style type="text/css">
	body {
		display:none;
	}
	</style>';
}
}
if(isset($_POST['botoiAtera'])){
	echo('<script>location.href="layout.php"</script>');
}
	
?>
