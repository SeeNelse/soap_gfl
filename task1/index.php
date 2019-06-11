<?php

include 'config.php';
include 'libs/iWSO.php';
include 'libs/CURL.php';
include 'libs/SOAP.php';

$curl = new CURL();
$curl->getData('http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL');


$soap = new SOAP;
$countryList = $soap->getData(false);

$resultSoap = '';
// forEach($countryList as $key => $item) {
//   $countryImages = $soap->getData($item['sISOCode']);
//   $resultSoap .= "
//   <ul>
//     <li><h3>". $item['sName'] ."</h3></li>
//     <li>Flag: <img src=$countryImages></li>
//     <li>sISOCode: ". $item['sISOCode'] ."</li>
//   </ul>
//   ";
// }

include 'templates/index_tmpl.php';