<?php
//questions.xml erakusteko
if(isset($_GET['id'])){
	$id= $_GET['id'];
	$xml = simplexml_load_file("http://localhost:1234/laborategiak/xml/questions.xml");
	echo "<table border = '1'> \n";
	echo "<tr><td>Enuntziatua</td><td>Zailtasuna</td><td>Gaia</td></tr> \n";
	foreach($xml->assessmentItem as $assessmentItem){
		$gaia = $assessmentItem['subject'];
		$zailtasuna = $assessmentItem['complexity'];
		foreach($assessmentItem->children() as $child){
			if($child->getName() == 'itemBody'){
				$enuntziatua = $child->children();
				}
			}
		echo "<tr><td>" . $enuntziatua . "</td><td>" . $zailtasuna . "</td><td>" . $gaia . "</td></tr> \n";
	}
	
	echo('<a href="layout.php?id='.$id.'"> HASIERAKO ORRIRA ITZULTZEKO HEMEN KLIKATU </a></br></br>');
}
?>