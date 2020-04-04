<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/db/config.php';

class approval extends config{

  public $rid;

  function __construct($rid=null){
    $this->rid = $rid;
  }

  public function approved(){
    $rid = $this->rid;
    $config = new config;
    $pdo = $config->connect();
    $sql = "UPDATE `research_tbl` SET `approval` = 'approved' WHERE `id` = ?";
    $data = $pdo->prepare($sql);

    if($data->execute([$rid])) {
      header("pendingWork.php");
    }
  }

  public function approvedArchived(){
    $rid = $this->rid;
    $config = new config;
    $pdo = $config->connect();
    $sql = "UPDATE `research_tbl` SET `approval` = 'approved' WHERE `id` = ?";
    $data = $pdo->prepare($sql);

    if($data->execute([$rid])) {
      header("archives.php");
    }
  }
}
?>
