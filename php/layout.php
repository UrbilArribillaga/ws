<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quizzes</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
  <form id="layout" name="layout" action="" method="post">
  </br>
  <input id="botoiErregistratu" type="button" value="Erregistratu">
  <input id="botoiLogin" type="button" value="LogIn">
  <input id="botoiAtera" type="button" value="LogOut"></input></br></br>
  <div id='page-wrap'>
	<header class='main' id='h1'>
	
      <span class="right" style="display:none;"><a href="/logout">LogOut</a> </span>
	<h2>Quiz: crazy questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Home</a></span>
		<span><input id="credits" name="credits" type= "submit" value="Credits"></span>
		<span><input id="handlingQuizes" name="handlingQuizes" type="submit" value="handlingQuizes"></span>
		<span><input id="reviewingQuizes" type="submit" name="reviewingQuizes" value="reviewingQuizes"></span>
		<span><input id="jokatu" type="button" name="jokatu" value="jokatu"></span>
	</nav>
    <section class="main" id="s1">
    
	
	<div>
	Quizzes and credits will be displayed in this spot in future laboratories ...
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</form>
<script>
$(document).ready(function(){
        $("#botoiErregistratu").click(function(){
		location.href="signUp.php"
		});
		$("#botoiLogin").click(function(){
		location.href="logIn.php"
		});
		$("#botoiAtera").click(function(){
		location.href="logOut.php"
		});
        
    });
</script>
</body>
</html>
<?php
if(!isset($_SESSION['id'], $_SESSION['mota'])){
	echo '<style type="text/css">
        #handlingQuizes, #reviewingQuizes, #botoiAtera{
			display:none;
		} 
        </style>';		
}
else {
	if ($_SESSION['mota']=="ikaslea"){
		echo '<style type="text/css">
			#reviewingQuizes, #botoiLogin, #botoiErregistratu, #jokatu {
				display: none;
			}
			</style>';
}
	else{
		echo '<style type="text/css">
			#handlingQuizes, #botoiLogin, #botoiErregistratu,#jokatu {
				display: none;
			}
			</style>';
}
}
if(isset($_POST['reviewingQuizes'])) echo('<script>location.href="reviewingQuizes.php"</script>');
if(isset($_POST['handlingQuizes'])) echo('<script>location.href="handlingQuizes.php"</script>');
if(isset($_POST['credits'])) echo('<script>location.href="credits.php"</script>');
?>
