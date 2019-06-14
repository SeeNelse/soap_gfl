<?php

include 'config.php';
// include 'libs/ShowRoom.php';
// include 'libs/SOAPServer.php';
// include 'libs/Client.php';

// $client = new Client;
// $client->getData();

// $sql = new ShowRoom;
// $sql->getCarsList();
// $sql->getCarsDetails();
// $sql->getCarById(1);
// $sql->getCarsByParams(100);



$client = new SoapClient('http://192.168.0.15/~user8/sub/task2/?WSDL');
print_r($client->__getFunctions());
// print_r($client);
$result = $client;
var_dump($result);