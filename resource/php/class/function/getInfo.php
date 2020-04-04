<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/db/config.php';

class getInfo extends config{

  public $aid;
  public $firstname;
  public $lastname;
  public $mi;
  public $school_id;
  public $department;
  public $email;
  public $username;
  public $course;

  function __construct($aid=null){
    $this->aid = $aid;
  }

  public function accountInfo(){
    $aid = $this->aid;
    $config = new config;
    $pdo = $config->connect();

    $sql = "SELECT * FROM `user_account_tbl` WHERE `id` = ?";
    $data = $pdo->prepare($sql);
    $data->execute([$aid]);
    $results = $data->fetchAll(PDO::FETCH_OBJ);

    foreach ($results as $row) {

      $this->firstname = $row->firstname;
      $this->lastname = $row->lastname;
      $this->mi = $row->mi;
      $this->school_id =$row->school_id;
      $this->department =$row->department;
      $this->username = $row->username;
      $this->course = $row->course;
      $this->email = $row->email;
    }
  }

}
?>
