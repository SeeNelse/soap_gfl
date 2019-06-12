<?php

class CURL implements iWSO
{
  protected $url;
  public function __construct() {
    $this->url = curl_init('http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL');
  }

  public function getData($arg) 
  {
    
    if (!$arg) {
      $post = '<?xml version="1.0" encoding="utf-8"?>
      <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
        <soap:Body>
          <ListOfCountryNamesByCode xmlns="http://www.oorsprong.org/websamples.countryinfo">
          </ListOfCountryNamesByCode>
        </soap:Body>
      </soap:Envelope>';
  
      $xml = ['POST /websamples.countryinfo/CountryInfoService.wso HTTP/1.1',
      'Host: webservices.oorsprong.org',
      'Content-Type: text/xml; charset=utf-8',
      'Content-Length:'.strlen($post)];
  
      curl_setopt($this->url, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($this->url, CURLINFO_HEADER_OUT, true);
      curl_setopt($this->url, CURLOPT_POST, true);
      curl_setopt($this->url, CURLOPT_POSTFIELDS, $post);
      curl_setopt($this->url, CURLOPT_HTTPHEADER, $xml);
      $res = curl_exec($this->url);
      $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $res);
      $xml = new SimpleXMLElement($response);
      $xmlObj = $xml->soapBody->mListOfCountryNamesByCodeResponse->mListOfCountryNamesByCodeResult->mtCountryCodeAndName;
      $toTemplate = [];
      forEach($xmlObj as $key => $item) {
        array_push($toTemplate, ['sISOCode' => $item->msISOCode,'sName' => $item->msName]);
      }
      
      return $toTemplate;
    } else {
      
      $post = '<?xml version="1.0" encoding="utf-8"?>
      <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
        <soap:Body>
          <CountryFlag xmlns="http://www.oorsprong.org/websamples.countryinfo">
            <sCountryISOCode>'.$arg.'</sCountryISOCode>
          </CountryFlag>
        </soap:Body>
      </soap:Envelope>';

      $xml = ['POST /websamples.countryinfo/CountryInfoService.wso HTTP/1.1',
      'Host: webservices.oorsprong.org',
      'Content-Type: text/xml; charset=utf-8',
      'Content-Length:'.strlen($post)];

      curl_setopt($this->url, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($this->url, CURLINFO_HEADER_OUT, true);
      curl_setopt($this->url, CURLOPT_POST, true);
      curl_setopt($this->url, CURLOPT_POSTFIELDS, $post);
      curl_setopt($this->url, CURLOPT_HTTPHEADER, $xml);
      $res = curl_exec($this->url);
      $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $res);
      $xml = new SimpleXMLElement($response);
      $xmlImgLink = $xml->soapBody->mCountryFlagResponse->mCountryFlagResult;

      return $xmlImgLink;
    }
  }
}