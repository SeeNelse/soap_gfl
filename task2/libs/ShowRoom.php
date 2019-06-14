<?php

class ShowRoom
{
  private $dbConnect;
  private $error;

  public function __construct()
  {
    try {
      $this->dbConnect = new PDO('mysql:host='.MYSQL_SERVER.';dbname='.MYSQL_DB, MYSQL_USER, MYSQL_PASS);
    } catch (PDOException $e) {
      echo $this->error = $e->getMessage();
      return false;
    }
  }

  public function getCarsList() 
  {
    $querySend = $this->dbConnect->prepare("SELECT ".MYSQL_TABLE_CARS.".id, ".MYSQL_TABLE_CARS.".model, ".MYSQL_TABLE_BRAND.".brand FROM ".MYSQL_TABLE_CARS." INNER JOIN ".MYSQL_TABLE_BRAND." ON ".MYSQL_TABLE_BRAND.".id = ".MYSQL_TABLE_CARS.".brand_id");
    return $this->queryExecute($querySend);
  }

  public function getCarsDetails() 
  {
    $querySend = $this->dbConnect->prepare("SELECT * FROM ".MYSQL_TABLE_CARS." INNER JOIN ".MYSQL_TABLE_BRAND." ON ".MYSQL_TABLE_BRAND.".id = ".MYSQL_TABLE_CARS.".brand_id");
    // возвращает не тот id
    return $this->queryExecute($querySend);
  }

  public function getCarById($id) 
  {
    if(is_numeric($id)) {
      $querySend = $this->dbConnect->prepare("SELECT * FROM ".MYSQL_TABLE_CARS." INNER JOIN ".MYSQL_TABLE_BRAND." ON ".MYSQL_TABLE_CARS.".brand_id = ".MYSQL_TABLE_BRAND.".id WHERE ".MYSQL_TABLE_CARS.".id = $id");
      $carResult = $this->queryExecute($querySend);
      $carResult[0]['id'] = $id;
      return $carResult;
    } else {
      return false;
    }
  }

  public function getCarsByParams($year, $model = null, $engine = null, $max_speed = null, $color = null, $price = null) {
    // проверка?
    // model | year_production | engine_capacity | max_speed | color | price
    // $query = '';
    
    // $querySend = $this->dbConnect->prepare("SELECT * FROM ".MYSQL_TABLE_CARS."WHERE ");
    // return $this->queryExecute($querySend);
  }

  private function queryExecute($query) 
  {
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

}