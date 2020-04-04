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
    $sql = "SELECT * FROM `user_account_tbl` WHERE `username` = ? AND `account_state` = 'Activated'";
    $data = $pdo->prepare($sql);
    $data->execute([$username]);
    $results = $data->fetchAll(PDO::FETCH_OBJ);

    $count = $data->rowCount();
    foreach ($results as $row) {
      $uname = $row->username;
      $pw = $row->password;
      $id = $row->id;
      $acctype = $row->account_type;
    }
    // $sql2 = "SELECT * FROM `employee_account_tbl` WHERE `username` = ? AND `account_state` = 'Activated'";
    // $data2 = $pdo->prepare($sql2);
    // $data2->execute([$username]);
    // $results2 = $data2->fetchAll(PDO::FETCH_OBJ);
    //
    // foreach ($results2 as $row2) {
    //   $unam2e = $row2->username;
    //   $pw2 = $row->password;
    //   $id2 = $row->id;
    //   $acctype2 = $row->account_type;
    // }

    if ($count != 0) {
      if (!empty($username) && !empty($password)) {
        if(password_verify($password,$pw) && $username == $uname){
          $_SESSION['username'] = $uname;
          $_SESSION['id'] = $id;
          if ($acctype == "user") {
            header('location: userHomePage.php');
          }elseif ($acctype == "rAssistant") {
            header('location: researchAssistantPage.php');
          }else {
            header('location: adminHome.php');
          }
      }else {
        $msg = "incorrect Username or Password";
        echo "<script type='text/javascript'>alert('$msg');</script>";
        // header("Location: index.php");
        // echo "Incorrect Username or Password";
      }
    }
  }else {
    echo "Account is not activated yet or Doesn't Exist";
      // echo "<script type='text/javascript'>alert('$msg');</script>";
  }
 }
}
?>
