<?php
session_start();
if(isset($_SESSION['id'], $_SESSION['mota']) && $_SESSION['mota'] == "irakaslea"){
	echo("oso ondo</br>");
	echo('<a href="layout.php">Layoutera buelta</a>');
}
else{
	echo("eres un pillo");
}

 ?>