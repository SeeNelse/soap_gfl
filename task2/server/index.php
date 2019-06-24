<?php
ini_set('soap.wsdl_cache_enabled', 0); 
ini_set('soap.wsdl_cache_ttl', 0);
include('config.php');
include('../ShowRoom.php');

$server = new SoapServer("http://192.168.0.15/~user8/sub/task2/server/soapServer.wsdl");
$server->setClass("ShowRoom");
$server->handle();