<?php

class SoapRequestResponse 
{

  private $client;
  private $error;

  public function __construct()
  {
    try {
      // $this->client = new SoapClient('http://192.168.0.15/~user8/sub/task2/server/?wsdl', array('cache_wsdl' => WSDL_CACHE_NONE));
      $this->client = new SoapClient('http://localhost/soap_gfl/task2/server/?wsdl', array('cache_wsdl' => WSDL_CACHE_NONE));
    } catch (Exception $e) {
      $this->error = $e;
      return false;
    }
  }

  public function getCarsList() {
    $listArray = [];
    $tempArr = $this->client->getCarsList()->Map;
    forEach($tempArr as $carItemKey => $carItem) {
      forEach($carItem->item as $carPropsKey => $carProps) {
        $listArray[$carItemKey][$carProps->key] = $carProps->value;
      }
    }
    $result = $this->renderListItem($listArray);
    return $result;
  }

  public function getCardById($id) {
    $obj = $this->client->getCarById(['Id' => $id]);
    if ((array)$obj) {
      return $this->renderCarItem($obj);
    } else {
      return false;
    }
  }

  public function getCarName($id) {
    $obj = $this->client->getCarById(['Id' => $id]);
    $htmlStringResult = $obj->brand . ' - ' . $obj->model;
    return $htmlStringResult;
  }

  public function getCarsByParams($obj) {
    $newArray = $this->client->getCarsByParams($obj);
    if ($newArray) {
      $htmlStringResult = '';
      if ($newArray->Map->item) {
        forEach($newArray as $item) {
          $htmlStringResult .= $this->renderAdvancedSearch($item->item);
        }
      } else {
        forEach($newArray->Map as $item) {
          $htmlStringResult .= $this->renderAdvancedSearch($item->item);
        }
      }
      return $htmlStringResult;
    } else {
      return false;
    }
  }

  public function setNewOrder($arr) {
    if ($arr) {
      if ($this->client->setNewOrder($arr) === '') {
        return true;
      } else if ($this->client->setNewOrder($arr) === false) {
        return false;
      }
    } else {
      return false;
    }
  }

  private function renderAdvancedSearch($obj) {
    $listArray = [];
    forEach($obj as $carItem) {
      $listArray[$carItem->key] .=  $carItem->value;
    }
    $htmlResult .= '
        <div class="col-lg-4 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">'.$listArray['model'].'</h5>
              <a href="?carId='.$listArray['id'].'" class="card-link">Подробнее</a>
            </div>
          </div>
        </div>
      ';
    return $htmlResult;
  }

  private function renderCarItem($obj) {
    $htmlResult = '
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <table class="table table-sm table-hover">
              <tbody>
                <tr>
                  <th scope="row">Brand</th>
                  <td>'.$obj->brand.'</td>
                </tr>
                <tr>
                  <th scope="row">Model</th>
                  <td>'.$obj->model.'</td>
                </tr>
                <tr>
                  <th scope="row">Year Production</th>
                  <td>'.$obj->year_production.'</td>
                </tr>
                <tr>
                  <th scope="row">Engine Capacity</th>
                  <td>'.$obj->engine_capacity.'</td>
                </tr>
                <tr>
                  <th scope="row">Max speed</th>
                  <td>'.$obj->max_speed.'</td>
                </tr>
                <tr>
                  <th scope="row">Color</th>
                  <td>'.$obj->color.'</td>
                </tr>
                <tr class="h4">
                  <th scope="row">Price</th>
                  <td>'.$obj->price.'$</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    ';
    return $htmlResult;
  }

  private function renderListItem($array) {
    $htmlResult = "";
    forEach($array as $item) {
      $htmlResult .= '
        <div class="col-lg-4 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">'.$item['model'].'</h5>
              <h6 class="card-subtitle mb-2 text-muted">'.$item['brand'].'</h6>
              <a href="?carId='.$item['id'].'" class="card-link">Подробнее</a>
            </div>
          </div>
        </div>
      ';
    }
    return $htmlResult;
  }

}