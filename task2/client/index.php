<?php

include 'config.php';
include 'libs/ShowRoom.php';
// include 'libs/SOAPServer.php';
// include 'libs/Client.php';

// $client = new Client;
// $client->getData();

// $sql = new ShowRoom;
// $sql->getCarsList();
// $sql->getCarsDetails();
// $sql->getCarById(1);
// $sql->getCarsByParams(100);



$client = new SoapClient('http://localhost/soap_gfl/task2/server/?WSDL', array('cache_wsdl' => WSDL_CACHE_NONE));
echo '<pre>'; echo var_export($client->__getFunctions()); echo'</pre>';
echo '<pre>'; echo var_export($client->__getTypes()); echo'</pre>';
// print_r($client);
$result = $client->getCarById(["Id" => 2]);
echo '<pre>'; echo var_export($result); echo'</pre>';



// $obj = new ShowRoom();
// $arr = [
//   'year_production' => "2018",
//   'model' => '',
//   'engine_capacity' => '',
//   'max_speed' => '',
//   'color' => "black",
//   'price' => '',
// ];
// echo '<pre>'; echo var_export($obj->getCarById(1)); echo'</pre>';
// echo '<pre>'; echo var_export($obj->getCarsDetails()); echo'</pre>';