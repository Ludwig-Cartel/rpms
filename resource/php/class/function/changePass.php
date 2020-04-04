<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/db/config.php';

class changePass extends config{

  public $aid;
  public $pw;
  public $cpw;

  function __construct($aid=null,$pw=null,$cpw=null){
    $this->aid = $aid;
    $this->pw = $pw;
    $this->cpw = $cpw;
  }

  public function change(){
    $aid = $this->aid;
    $pw = $this->pw;
    $cpw = $this->cpw;
    $config = new config;
    $pdo = $config->connect();

    if ($pw != $cpw) {
      echo "Passwords must be matched";
    }else {
      $hash = password_hash($pw, PASSWORD_DEFAULT);
      $sql = "UPDATE `user_account_tbl` SET `password` = ?, `cpassword` = ? WHERE `id` = ?";
      $data = $pdo->prepare($sql);

      if ($data->execute([$hash,$hash,$aid])) {
        header("Location: viewAccount.php");
      }
    }
  }

}
?>
