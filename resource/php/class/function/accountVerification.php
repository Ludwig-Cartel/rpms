<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/db/config.php';

class accountVerification{

  public $id;

  public function __construct($id=null){
    $this->id =  $id;
  }

  public function checkAccount(){
    $id = $this->id;
    if(empty($id)){
      header("Location: index.php");
    }
    // $username = $this->username;
    // $config = new config;
    // $pdo = $config->connect();
    // $sql = "SELECT `account_type` FROM `user_account_tbl` WHERE `username` = ?";
    // $data = $pdo->prepare($sql);
    // $data->execute([$username]);
    // $results = $data->fetchAll(PDO::FETCH_OBJ);
    //
    // foreach ($results as $row) {
    //   $acctype = $row->account_type;
    // }
    //
    // if ($acctype == "user") {
    // }else {
    //     if($acctype == "admin"){
    //       header('location:adminHome.php');
    //     }else if ($acctype == "rAssistant" ){
    //       header('location:researchAssistantPage.php');
    //     }
    // }

  }

  public function isUser(){
    $id = $this->id;
    $config = new config;
    $pdo = $config->connect();
    $sql = "SELECT `account_type` FROM `user_account_tbl` WHERE `id` = ?";
    $data = $pdo->prepare($sql);
    $data->execute([$id]);
    $results = $data->fetchAll(PDO::FETCH_OBJ);

    foreach ($results as $row) {
      $acctype = $row->account_type;
    }

    if ($acctype == "user" ) {
    }else {
      if ($acctype == "admin") {
        header("Location: adminHome.php");
      }else {
        header("Location: researchAssistantPage.php");
      }
    }
  }

  public function isResearchAssistant(){
    $id = $this->id;
    $config = new config;
    $pdo = $config->connect();
    $sql = "SELECT `account_type` FROM `user_account_tbl` WHERE `id` = ?";
    $data = $pdo->prepare($sql);
    $data->execute([$id]);
    $results = $data->fetchAll(PDO::FETCH_OBJ);

    foreach ($results as $row) {
      $acctype = $row->account_type;
    }

    if ($acctype == "rAssistant" ) {
    }else {
      if ($acctype == "admin") {
        header("Location: adminHome.php");
      }else {
        header("Location: userHomePage.php");
      }
    }
  }

  public function isAdmin(){
    $id = $this->id;
    $config = new config;
    $pdo = $config->connect();
    $sql = "SELECT `account_type` FROM `user_account_tbl` WHERE `id` = ?";
    $data = $pdo->prepare($sql);
    $data->execute([$id]);
    $results = $data->fetchAll(PDO::FETCH_OBJ);

    foreach ($results as $row) {
      $acctype = $row->account_type;
    }

    if ($acctype == "admin" ) {
    }else {
      if ($acctype == "rAssistant") {
        header("Location: researchAssistantPage.php");
      }else {
        header("Location: userHomePage.php");
      }
    }
  }
  
}
 ?>
