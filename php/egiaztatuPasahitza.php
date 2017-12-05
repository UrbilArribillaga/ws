<?php 
//nusoap.php klasea gehitzen dugu
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');


//name of the service
$ns="http://localhost:1234/laborategiak/php/egiaztatuPasahitza.php?wsdl";
$server = new soap_server;
$server->configureWSDL('egiaztatu',$ns);
$server->wsdl->schemaTargetNamespace=$ns;

//inplementatu nahi dugun funtzioa erregistratzen dugu
$server->register('bilatu',array('x'=>'xsd:string'),array('z'=>'xsd:string'),$ns);

//funtzioa inplementatzen dugu
function bilatu($x){
	$fitxategia = file_get_contents('../txt/toppasswords.txt');
	if(strpos($fitxategia, $x) !== false) return 'baliogabea';
	else return 'baliozkoa';
}
//nusoap klaseko sevice metodoari dei egiten diogu
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);
?>