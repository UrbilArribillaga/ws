<?php
$zenb=0;
include "configure.php";
global $esteka;
if(isset($_GET['Arloa'])) $sql= "SELECT Galdera, Zuzena, Okerra1, Okerra2, Okerra3 FROM questions WHERE Arloa=$_GET['Arloa']"
else $sql= "SELECT Galdera, Zuzena, Okerra1, Okerra2, Okerra3 FROM questions"
$ema = mysqli_query($esteka, $sql);
if (!$ema) echo("Errorea query-a gauzatzerakoan: ". mysqli_error($esteka));
else{
	//ajax bidez body onloaden galderak kargatuk dira xml batean eta gero erantzun botoia sakatzean, ajax bidez lehenengo adieraziko da ea ondo dagoen eta gero aldatuko da galdera, berri bat kargaturik.
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body onload="galderakKargatu()">
	</body>
</html>