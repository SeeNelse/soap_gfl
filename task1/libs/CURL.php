<?php

class CURL implements iWSO
{
  public function __construct() {
  }

  public function getData($agr) 
  {
    $url = curl_init($agr);
    $post = '<?xml version="1.0" encoding="utf-8"?>'.
        '<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">'.
          '<soap:Body>'.
            '<ListOfCountryNamesByCode xmlns="http://www.oorsprong.org/websamples.countryinfo">'.
            '</ListOfCountryNamesByCode>'.
          '</soap:Body>'.
        '</soap:Envelope>';

    $xml = ['POST /websamples.countryinfo/CountryInfoService.wso HTTP/1.1',
    'Host: webservices.oorsprong.org',
    'Content-Type: text/xml; charset=utf-8',
    'Content-Length:'.strlen($post)];

    
    curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($url, CURLINFO_HEADER_OUT, true);
    curl_setopt($url, CURLOPT_POST, true);
    curl_setopt($url, CURLOPT_POSTFIELDS, $post);
    
    curl_setopt($url, CURLOPT_HTTPHEADER, $xml);
    $res = curl_exec($url);

    $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $res);
    $xml = new SimpleXMLElement($response);
    $xmlObj = $xml->soapBody->mListOfCountryNamesByCodeResponse->mListOfCountryNamesByCodeResult->mtCountryCodeAndName;
    $toTemplate = [];
    forEach($xmlObj as $key => $item) {
      array_push($toTemplate, ['sISOCode' => $item->msISOCode,'sName' => $item->msName]);
    }
    
    var_dump($toTemplate);

    return true;
  }
}