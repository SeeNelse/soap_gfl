<?php

include 'config.php';
include 'libs/iWSO.php';
include 'libs/CURL.php';
include 'libs/SOAP.php';


function arrsToHtml($array, $obj)
{
  $result = '';
  forEach($array as $key => $item) {
    $countryImages = $obj->getData($item['sISOCode']);
    $result .= "
    <ul>
      <li><h3>". $item['sName'] ."</h3></li>
      <li>Flag: <img src=$countryImages></li>
      <li>sISOCode: ". $item['sISOCode'] ."</li>
    </ul>
    ";
  }
  return $result;
}


$curl = new CURL();
$countryListCURL = $curl->getData(false);

$curl->getData('UA');


$soap = new SOAP;
$countryListSOAP = $soap->getData(false);

$curlResult = arrsToHtml($countryListCURL, $curl);
$soapResult = arrsToHtml($countryListSOAP, $soap);


include 'templates/index_tmpl.php';