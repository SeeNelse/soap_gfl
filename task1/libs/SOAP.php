<?php

class SOAP implements iWSO
{
  protected $client;
  function __construct() {
    $this->client = new SoapClient('http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL');
  }

  public function getData($arg)
  {
    $toTemplate = [];
    if (!$arg) {
      $result = $this->client->ListOfCountryNamesByCode()->ListOfCountryNamesByCodeResult->tCountryCodeAndName;
      forEach($result as $key => $item) {
        $toTemplate[$key] = [
          'sISOCode' => $item->sISOCode,
          'sName' => $item->sName,
        ];
      }
      return $toTemplate;
    } else {
      $tempImg = $this->client->CountryFlag(array("sCountryISOCode" => $arg));
      $result = $tempImg->CountryFlagResult;
      return $result;
    }
  }
}