<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/db/config.php';

class registerEmployee extends config{

  public $firstname;
  public $lastname;
  public $mi;
  public $employee_id;
  public $department;
  public $email;
  public $username;
  public $password;
  public $cpassword;

  public function __construct($firstname=null,$lastname=null,$mi=null,$employee_id=null,$department=null,$email=null,$username=null,$password=null,$cpassword=null){
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->mi = $mi;
    $this->employee_id = $school_id;
    $this->department = $department;
    $this->email =  $email;
    $this->username = $username;
    $this->password = $password;
    $this->cpassword = $cpassword;
  }

  public function registerEmployee(){

    $firstname = $this->firstname;
    $lastname = $this->lastname;
    $mi = $this->mi;
    $employee_id = $this->employee_id;
    $department = $this->department;
    $email = $this->email;
    $username = $this->username;
    $password =  $this->password;
    $cpassword = $this->cpassword;
    $acc_type = "rAssistant";

    $config = new config;
    $pdo = $config->connect();
    if ($password != $cpassword) {
      echo "Please check your passwords";
    }else {
      $userConfigQuery = "SELECT `username` FROM `user_account_tbl`";
      $config = $pdo->prepare($userConfigQuery);
      $config->execute();
      $results = $config->fetchAll(PDO::FETCH_OBJ);
      foreach ($results as $row) {
        $existingUsername = $row->username;
      }
      if ($existingUsername == $username) {
        echo "Username already exits";
      }else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql =  "INSERT INTO `user_account_tbl`(`firstname`,`lastname`,`mi`,`school_id`,`department`,`email`,`username`,`password`,`cpassword`,`account_type`) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $data = $pdo->prepare($sql);
        if ($data->execute([$firstname,$lastname,$mi,$employee_id,$department,$email,$username,$hash,$hash,$acc_type])) {
          $msg = "You have succesfullt registered your accout";
          echo "<script type='text/javascript'>alert('$msg');</script>";
          header('location: index.php');
        }
      }
    }
  }
}
?>
