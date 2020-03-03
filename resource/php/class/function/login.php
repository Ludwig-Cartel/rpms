<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/db/config.php';

class login extends config{

  public $username;
  public $password;

  public function __construct($username=null,$password=null){
    $this->username = $username;
    $this->password = $password;
  }

  public function loginUser(){
    $username = $this->username;
    $password = $this->password;

    $config = new config;
    $pdo = $config->connect();
    $sql = "SELECT * FROM `user_account_tbl` WHERE `username` = ?";
    $data = $pdo->prepare($sql);
    $data->execute([$username]);
    $results = $data->fetchAll(PDO::FETCH_OBJ);

    foreach ($results as $row) {
      $uname = $row->username;
      $pw = $row->password;
      $acctype = $row->account_type;
    }
    if (!empty($username) && !empty($password)) {
      if(password_verify($password,$pw) && $username == $uname){
        $_SESSION['username'] = $uname;
        // $_SESSION['acctype'] = $acctype;
        header('location: userHomePage.php');
      }else {
        echo "Incorrect Username or Password";
      }
    }else {
      $msg = "Please fill in the following fields";
      echo "<script type='text/javascript'>alert('$msg');</script>";
    }
  }
}
?>
