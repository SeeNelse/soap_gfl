<?php

include 'config.php';
include '../ShowRoom.php';
include 'libs/SoapRequestResponse.php';


$arr = [
  'year_production' => "2015",
  'model' => '',
  'engine_capacity' => '',
  'max_speed' => '',
  'color' => "",
  'price' => '',
];
// $client = new SoapClient('http://localhost/soap_gfl/task2/server/?WSDL', array('cache_wsdl' => WSDL_CACHE_NONE));
// echo '<pre>'; echo var_export($client->__getFunctions()); echo'</pre>';
// echo '<pre>'; echo var_export($client->__getTypes()); echo'</pre>';
// $result = $client->getCarsByParams($arr);
// echo '<pre>'; echo var_export($result); echo'</pre>';



$obj = new ShowRoom();

// echo '<pre>'; echo var_export($obj->getCarsList()); echo'</pre>';
// echo '<pre>'; echo var_export($obj->getCarsByParams($arr)); echo'</pre>';
// 

// echo '<pre>'; echo var_export($_GET); echo'</pre>';
// echo '<pre>'; echo var_export($_POST); echo'</pre>';

$client = new SoapRequestResponse();
$htmlError = '<h3>Not Found</h3>';
$htmlContent = '';
if (!$_GET) { // Главная
  $htmlHead = 'Машины:';
  $htmlContent = $client->getCarsList();
} else if ($_GET['carId'] || $_GET['searchCarId']) { // Страницы поиска по айди и страница машины
  if ($_GET['carId']) {
    $getResponseId =  $_GET['carId'];
  } else if ($_GET['searchCarId']) {
    $getResponseId =  $_GET['searchCarId'];
  }
  $dataParse = $client->getCardById($getResponseId);
  if ($dataParse) {
    $htmlContent = $dataParse;
    $htmlHead = $client->getCarName($getResponseId);
  } else {
    $htmlContent = $htmlError;
  }
} else if ($_GET['advancedSearch']) { // Расширенный поиск
  $htmlHead = 'Расширенный поиск:';
  $htmlContent = file_get_contents('templates/advancedForm.php');
  if (is_null($_POST['year_production'])) {
    $searchError = '';
  } else if (!$_POST['year_production']) {
    $searchError = 'border-danger';
    $htmlContent = sprintf($htmlContent, $searchError);
  } else if (is_numeric($_POST['year_production'])) {
    $searchArray = [
      'year_production' => $_POST['year_production'],
      'model' => $_POST['model'],
      'engine_capacity' => $_POST['engine_capacity'],
      'max_speed' => $_POST['max_speed'],
      'color' => $_POST['color'],
      'price' => $_POST['price'],
    ];
    $advancedSearchResponse = $client->getCarsByParams($searchArray);
    if ($advancedSearchResponse) {
      $htmlHead = 'Результаты:';
      $htmlContent = $advancedSearchResponse;
    } else {
      $htmlContent = $htmlError;
    }
  }
} else if ($_GET['order']) {
  $htmlHead = 'Заказать машину:';
  $htmlContent = file_get_contents('templates/orderForm.php');
  if (is_null($_POST['car_id']) && 
      is_null($_POST['name']) && 
      is_null($_POST['surname']) && 
      is_null($_POST['payment_type'])) 
  {
    $searchError = '';
  } else if (is_numeric($_POST['car_id']) && is_string($_POST['name']) && is_string($_POST['surname']) && $_POST['payment']) {
    $arr = [
      'car_id' => $_POST['car_id'],
      'name' => $_POST['name'],
      'surname' => $_POST['surname'],
      'payment' => $_POST['payment']
    ];
    $obj->setOrderData($arr);
    // $client->setNewOrder($arr);
  }
}






include 'templates/index_tmpl.php';