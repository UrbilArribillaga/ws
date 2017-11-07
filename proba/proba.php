<?php
$xml = simplexml_load_file('../xml/questions.xml');

$xml->assessmentItem[1]->correctResponse->value='ARGUMENTURIK GABE';
$xml->asXML('../xml/questions.xml'); //aldaketak gordetzen ditugu

echo $xml->asXML(); // fitxategia web-arakatzailean bistaratzen da
?>