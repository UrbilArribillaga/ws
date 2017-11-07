<?php
$doc = new DOMDocument();
$doc->load('../xml/questions.xml');
$root = $doc->documentElement;
echo "<table border = '1'> \n";
echo "<tr><td>Enuntziatua</td><td>Zailtasuna</td><td>Gaia</td></tr> \n";
$assessmentItems = $doc->getElementsByTagName('assessmentItem');
foreach($assessmentItems as $assessmentItem){
	$gaia = $assessmentItem->getAttribute('subject');
	$zailtasuna = $assessmentItem->getAttribute('complexity');
	$child = $assessmentItem->firstChild;
	while($child){
		if($child->nodeName == 'itemBody'){
			$child1 = $child->firstChild;
			$enuntziatua = $child1->nodeValue;
		}
		$child = $child->nextSibling;
	}
	echo "<tr><td>" . $enuntziatua . "</td><td>" . $zailtasuna . "</td><td>" . $gaia . "</td></tr> \n";
}
?>