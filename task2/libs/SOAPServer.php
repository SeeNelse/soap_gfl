<?php
ini_set("soap.wsdl_cache_enabled", "0");
include('libs/ShowRoom.php');

$server = new SoapServer("http://192.168.0.15/~user8/sub/task2/soapServer.wsdl");
$server->setClass("ShowRoom");
$server->handle();