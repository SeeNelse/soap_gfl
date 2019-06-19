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
    if ($this->dbConnect) {
      $querySend = $this->dbConnect->prepare("SELECT 
                                          ".MYSQL_TABLE_CARS.".id,
                                          ".MYSQL_TABLE_BRAND.".brand,
                                          ".MYSQL_TABLE_CARS.".model,
                                          ".MYSQL_TABLE_CARS.".year_production,
                                          ".MYSQL_TABLE_CARS.".engine_capacity,
                                          ".MYSQL_TABLE_CARS.".max_speed,
                                          ".MYSQL_TABLE_CARS.".color,
                                          ".MYSQL_TABLE_CARS.".price
                                          FROM ".MYSQL_TABLE_CARS." 
                                          LEFT JOIN ".MYSQL_TABLE_BRAND." 
                                          ON ".MYSQL_TABLE_CARS.".brand_id = ".MYSQL_TABLE_BRAND.".id");
      return $this->queryExecute($querySend);
    } else {
      return false;
    }
    
  }

  public function getCarById($id) 
  {
    if($id && $this->dbConnect) {
      $querySend = $this->dbConnect->prepare("SELECT 
                                              ".MYSQL_TABLE_CARS.".id,
                                              ".MYSQL_TABLE_BRAND.".brand,
                                              ".MYSQL_TABLE_CARS.".model,
                                              ".MYSQL_TABLE_CARS.".year_production,
                                              ".MYSQL_TABLE_CARS.".engine_capacity,
                                              ".MYSQL_TABLE_CARS.".max_speed,
                                              ".MYSQL_TABLE_CARS.".color,
                                              ".MYSQL_TABLE_CARS.".price
                                              FROM ".MYSQL_TABLE_CARS." 
                                              INNER JOIN ".MYSQL_TABLE_BRAND." 
                                              ON ".MYSQL_TABLE_CARS.".brand_id = ".MYSQL_TABLE_BRAND.".id 
                                              WHERE ".MYSQL_TABLE_CARS.".id = $id->Id");
      $result = $this->queryExecute($querySend);
      return $result[0];
    } else {
      return false;
    }
  }

  public function getCarsByParams($obj) 
  {
    $tempArray = [
      'year_production' => $obj->year_production,
      'model' => $obj->model,
      'engine_capacity' => $obj->engine_capacity,
      'max_speed' => $obj->max_speed,
      'color' => $obj->color,
      'price' => $obj->price,
    ];
    if ($tempArray['year_production'] && $this->dbConnect) {
      $queryParams = '';
      forEach($tempArray as $key => $item) {
        if ($item) {
          $queryParams .= MYSQL_TABLE_CARS.'.'.$key." = '$item' AND ";
        }
      }
      $queryParams = substr(trim($queryParams), 0, -4);
      $querySend = $this->dbConnect->prepare("SELECT * FROM ".MYSQL_TABLE_CARS." WHERE ".$queryParams);
      $result = $this->queryExecute($querySend);
      return $result[0];
    } else {
      return false;
    }
  }

  private function queryExecute($query) 
  {
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

}