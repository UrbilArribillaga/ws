<?php
session_start();
//questions.xml erakusteko
if(isset($_SESSION['korreoa'], $_SESSION['mota']) && $_SESSION['mota']==="ikaslea"){
	$xml = simplexml_load_file("../xml/questions.xml");
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
	
	}
	else{
		echo('<script>location.href="layout.php"</script>');
	}
?>