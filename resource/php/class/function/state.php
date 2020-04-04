<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/db/config.php';

class state extends config{

  public $aid;
  public $state;

  function __construct($aid=null,$state=null){
    $this->aid = $aid;
    $this->state = $state;
  }

  public function accountActivation(){
    $state = $this->state;
    $aid = $this->aid;
    $config = new config;
    $pdo = $config->connect();

    if ($state == 'Deactivated') {
      $sql = "UPDATE `user_account_tbl` SET `account_state` = 'Activated' WHERE `id` = ?";
    }else {
      $sql = "UPDATE `user_account_tbl` SET `account_state` = 'Deactivated' WHERE `id` = ?";
    }
    $data = $pdo->prepare($sql);

    if($data->execute([$aid])) {
      header("viewAccount.php");
    }
  }

}
?>
