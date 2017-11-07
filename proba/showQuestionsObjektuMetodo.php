<?php 
if(isset($_GET['id'])){
	$id= $_GET['id'];
$niremysqli = new mysqli("localhost", "root", "", "quiz");
if ($niremysqli->errno) {
echo ("Konexio hutxegitea MySQLra: " . $niremysqli->errno);
exit();
}
$sql = "SELECT * FROM questions";
$result = $niremysqli->query($sql); 

if ($result->num_rows > 0) {
echo "<table border = '1'> \n"; 
echo "<tr><td>Zenbakia</td><td>Korreoa</td><td>Galdera</td><td>Erantzun zuzena</td><td>Erantzun okerra</td><td>Erantzun okerra 2</td><td>Erantzun okerra 3</td><td>Zailtasuna</td><td>Arloa</td></tr> \n"; 

for ($zenb = $result->num_rows-1; $zenb >=0; $zenb--){ 
		$result->data_seek($zenb);
		$row = $result->fetch_assoc();
		echo "<tr><td>" . $row["Zenbakia"]. "</td><td>" . $row["Korreoa"]. "</td><td>" . $row["Galdera"]. "</td><td>" . $row["Zuzena"]. " </td><td>" . $row["Okerra1"]. "</td><td> " . $row["Okerra2"]. "</td><td>" . $row["Okerra3"]. "</td><td>" . $row["Zailtasuna"]. "</td><td>" . $row["Arloa"]. "</td></tr> \n"; 
}
}
else{
	echo "0 lerro taulan";
}
if (!$result)
{
echo("Errorea query-a gauzatzerakoan: ". $niremysqli->errno);

}
echo('<a href="layout.php?id='.$id.'"> HASIERAKO ORRIRA ITZULTZEKO HEMEN KLIKATU </a></br></br>');
$niremysqli->close();
}
?>