<?php

class SOAP implements iWSO
{
  protected $client;
  function __construct() {
    $this->client = new SoapClient('http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL');
  }

  public function getData($agr)
  {
    $toTemplate = [];
    if (!$agr) {
      $result = $this->client->ListOfCountryNamesByCode()->ListOfCountryNamesByCodeResult->tCountryCodeAndName;
      forEach($result as $key => $item) {
        $toTemplate[$key] = [
          'sISOCode' => $item->sISOCode,
          'sName' => $item->sName,
        ];
      }
      return $toTemplate;
    } else {
      $tempImg = $this->client->CountryFlag(array("sCountryISOCode" => $agr));
      $result = $tempImg->CountryFlagResult;
      return $result;
    }
  }
}