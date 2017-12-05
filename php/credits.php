<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <meta charset="utf-8">
        <title>Kredituak</title>
		<link rel='stylesheet' type='text/css' href='http://uarribillaga.000webhostapp.com/Lab2/estiloak/style.css' />
		<link rel='stylesheet' 
			   type='text/css' 
			   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
			   href='http://uarribillaga.000webhostapp.com/Lab2/estiloak/wide.css' />
		<link rel='stylesheet' 
			   type='text/css' 
			   media='only screen and (max-width: 480px)'
			   href='http://uarribillaga.000webhostapp.com/Lab2/estiloak/smartphone.css' />
        <style>
            body {
                font-family: Arial, sans-serif;
                background: rgb(222, 253, 255);
            }
			#botoiAtera {
				border: 2px solid #4CAF50;
				 box-shadow: 0 5px #666;
				 cursor: pointer;	 
			}
			#botoiAtera:active {
				background-color: #3e8e41;
				box-shadow: 0 5px #666;
				transform: translateY(4px);
}
			#botoiAtera:hover {background-color: #3e8e41}
			h1 {
				font-family: "Times New Roman", Times, serif;
			}
        </style>
         
    </head>
    <body>
	<header class='main' id='h1'>
	
      <span class="right" style="display:none;"><a href="/logout">LogOut</a> </span>
		<h2>Quiz: crazy questions</h2>
		<?php if(isset($_SESSION['korreoa'])) {
		echo("Erabiltzailea:" . $_SESSION['korreoa']);
		}
		else echo("Erabiltzailea: Anonimoa");
			?>
		</header>
		<form id="credits", name="credits", action="" method="post"
        <h1>Egileak: Jokin Indias eta Urbil Arribillaga</h1>
        <h2>Software ingeniaritza, 3.maila</h2>
        <img src=" https://raw.githubusercontent.com/UrbilArribillaga/ws/master/irudiak/homer.jpg" height="450" width="300"/></br></br>
		<input id="botoiAtera" type="submit" value="atzera" name="botoiAtera">
		</form>
    </body>
</html>
<?php
/*
if(isset($_SESSION['id'], $_POST['botoiAtera'])){
	$id=$_GET['id'];
	echo('<script>location.href="layout.php?id="</script>');
}*/
if(isset($_POST['botoiAtera'])){
	echo('<script>location.href="layout.php"</script>');
}
?>