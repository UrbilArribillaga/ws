<?php 
if(isset($_GET['id'])){
	$id= $_GET['id'];
	$zenb=1;
	include "configure.php";
	global $esteka;
	$sql = "SELECT * FROM questions";
	$result = mysqli_query($esteka, $sql); 
if (mysqli_num_rows($result) > 0) {
echo "<table border = '1'> \n"; 
echo "<tr><td>Zenbakia</td><td>Korreoa</td><td>Galdera</td><td>Erantzun zuzena</td><td>Erantzun okerra</td><td>Erantzun okerra 2</td><td>Erantzun okerra 3</td><td>Zailtasuna</td><td>Arloa</td></tr> \n"; 

while ($row = mysqli_fetch_assoc($result)){ 
       echo "<tr><td>" . $row["Zenbakia"]. "</td><td>" . $row["Korreoa"]. "</td><td>" . $row["Galdera"]. "</td><td>" . $row["Zuzena"]. " </td><td>" . $row["Okerra1"]. "</td><td> " . $row["Okerra2"]. "</td><td>" . $row["Okerra3"]. "</td><td>" . $row["Zailtasuna"]. "</td><td>" . $row["Arloa"]. "</td></tr> \n"; 
}
}
else{
	echo "0 lerro taulan";
}
if (!$result)
{
echo("Errorea query-a gauzatzerakoan: ". mysqli_error($esteka));

}
echo('<a href="layout.php?id='.$id.'"> HASIERAKO ORRIRA ITZULTZEKO HEMEN KLIKATU </a></br></br>');
mysqli_close($esteka);
}
?>