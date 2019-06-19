<?php

include 'config.php';
include '../ShowRoom.php';

$arr = [
  'year_production' => "2018",
  'model' => '',
  'engine_capacity' => '',
  'max_speed' => '',
  'color' => "black",
  'price' => '',
];

$client = new SoapClient('http://192.168.0.15/~user8/sub/task2/server/?WSDL', array('cache_wsdl' => WSDL_CACHE_NONE));
// echo '<pre>'; echo var_export($client->__getFunctions()); echo'</pre>';
// echo '<pre>'; echo var_export($client->__getTypes()); echo'</pre>';
// $result = $client->getCarsList();
// $result = $client->getCarsDetails();
// $result = $client->getCarById(['Id' => 1]); // обращение к айди
// $result = $client->getCarsByParams($arr);
// echo '<pre>'; echo var_export($result); echo'</pre>';



$obj = new ShowRoom();

// echo '<pre>'; echo var_export($obj->getCarById(1)); echo'</pre>';
// echo '<pre>'; echo var_export($obj->getCarsByParams($arr)); echo'</pre>';

include 'templates/index_tmpl.html';