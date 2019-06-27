<?php

include 'config.php';
include 'libs/SoapRequestResponse.php';



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
} else if ($_GET['order']) { // заявка на машину
  $htmlHead = 'Заказать машину:';
  $orderTemplate = file_get_contents('templates/orderForm.php');
  $idError = '';
  $htmlContent = sprintf($orderTemplate, $idError);
  // $htmlContent = file_get_contents('templates/orderForm.php');
  if (is_null($_POST['car_id']) && 
      is_null($_POST['name']) && 
      is_null($_POST['surname']) && 
      is_null($_POST['payment_type'])) 
  {
    $searchError = '';
  } else if (is_numeric($_POST['car_id']) && 
              is_string($_POST['first_name']) && 
              is_string($_POST['last_name']) && 
              is_numeric($_POST['payment_type'])) 
  {
    $arr = [
      'CarId' => trim($_POST['car_id']),
      'FirstName' => trim($_POST['first_name']),
      'LastName' => trim($_POST['last_name']),
      'PaymentType' => trim($_POST['payment_type'])
    ];
   if ($client->setNewOrder($arr)) {
    $idError = "<div class='alert alert-success' role='alert'>Ваша заявка отправлена!</div>";
    $htmlContent = sprintf($orderTemplate, $idError);
   } else {
    $idError = "<div class='alert alert-danger' role='alert'>Машина с таким id не найдена</div>";
    $htmlContent = sprintf($orderTemplate, $idError);
   }
  } else {
    $idError = "<div class='alert alert-danger' role='alert'>Заполните все поля</div>";
    $htmlContent = sprintf($orderTemplate, $idError);
  }
}



include 'templates/index_tmpl.php';