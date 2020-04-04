<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/db/config.php';

class archivesAdmin extends config{

  public $rid;

  function __construct($rid=null){
    $this->rid = $rid;
  }

  public function archivedInAprroval(){
    $rid = $this->rid;
    $config = new config;
    $pdo = $config->connect();
    $sql = "UPDATE `research_tbl` SET `approval` = 'archived' WHERE `id` = ?";
    $data = $pdo->prepare($sql);

    if($data->execute([$rid])) {
      header("pendingWorkAdmin.php");
    }
  }

  public function archivedInAprroved(){
    $rid = $this->rid;
    $config = new config;
    $pdo = $config->connect();
    $sql = "UPDATE `research_tbl` SET `approval` = 'archived' WHERE `id` = ?";
    $data = $pdo->prepare($sql);

    if($data->execute([$rid])) {
      header("adminHome.php");
    }
  }
}
?>
