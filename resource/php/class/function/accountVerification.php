<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/db/config.php';

class accountVerification extends config{

  public $username;

  public function __construct($username=null){
    $this->username =  $username;
  }

  public function checkAccount(){
    $username = $this->username;
    $config = new config;
    $pdo = $config->connect();
    $sql = "SELECT `account_type` FROM `user_account_tbl` WHERE `username` = ?";
    $data = $pdo->prepare($sql);
    $data->execute([$username]);
    $results = $data->fetchAll(PDO::FETCH_OBJ);

    foreach ($results as $row) {
      $acctype = $row->account_type;
    }

    if ($acctype == "user") {
    }else {
        if($acctype == "admin"){
          header('location:adminHome.php');
        }else if ($acctype == "rAssistant" ){
          header('location:researchAssistantPage.php');
        }
    }
  }
}
 ?>
