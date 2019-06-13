<?php

class SqlQuerys
{
  private $addData;
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
    $this->addData = [];
  }

  public function getCars() {
    try {
      $querySend = $this->dbConnect->prepare("SELECT * FROM ".MYSQL_TABLE_CARS);
      $querySend->execute();
      $arrTemp = $querySend->fetchAll(PDO::FETCH_ASSOC);
      var_dump($arrTemp);
      return $arrTemp;
    } catch (PDOException $e) {
      echo $this->error = $e->getMessage();
      return false;
    }
  }

}