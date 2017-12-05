<?php 
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');
if(isset($_POST['korreoa'])){
	$soapclient = new nusoap_client('http://ehusw.es/rosa/webZerbitzuak/egiaztatuMatrikula.php?wsdl', true);
	$soapclient->call('egiaztatuE', array('x'=>$_POST['korreoa']));
	$doc = new DOMDocument();
	$doc->loadXML(strstr($soapclient->response, '<'));
	$mezua = $doc->getElementsByTagName('z');
	if($mezua[0]->nodeValue=="BAI")echo "KEgokia";
	else echo "KDesegokia";
	
}
else if(isset($_POST['pasahitza'])){
	$soapclient = new nusoap_client('http://localhost:1234/laborategiak/php/egiaztatuPasahitza.php?wsdl', true);
	$soapclient->call('bilatu', array('x'=>$_POST['pasahitza']));
	$doc = new DOMDocument();
	$doc->loadXML(strstr($soapclient->response, '<'));
	$mezua = $doc->getElementsByTagName('z');
	if($mezua[0]->nodeValue=="baliozkoa")echo "PEgokia";
	else echo "PDesegokia";
}
?>