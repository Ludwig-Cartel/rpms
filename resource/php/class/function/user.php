<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/db/config.php';

class user extends config{

  public $id;

  public function __construct($id=null){
    $this->id = $id;
  }

  public function getUserName(){
    $id =  $this->id;
    $config = new config;
    $pdo = $config->connect();
    $sql = "SELECT * FROM `user_account_tbl` WHERE `id` = ?";
    $data = $pdo->prepare($sql);
    $data->execute([$id]);
    $results = $data->fetchAll(PDO::FETCH_OBJ);

    foreach ($results as $row) {
      $firstName = $row->firstname;
      $lastName = $row->lastname;
      $mi = $row->mi;
      $fullName = $firstName . " " . $mi . " " . $lastName;
      echo $fullName;
    }
  }


}
?>
