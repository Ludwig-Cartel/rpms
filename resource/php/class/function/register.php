<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/db/config.php';

class register extends config{

  public $firstname;
  public $lastname;
  public $mi;
  public $school_id;
  public $department;
  public $course;
  public $email;
  public $username;
  public $password;
  public $cpassword;

  public function __construct($firstname=null,$lastname=null,$mi=null,$school_id=null,$department=null,$course=null,$email=null,$username=null,$password=null,$cpassword=null){
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->mi = $mi;
    $this->school_id = $school_id;
    $this->department = $department;
    $this->course = $course;
    $this->email =  $email;
    $this->username = $username;
    $this->password = $password;
    $this->cpassword = $cpassword;
  }

  public function registerUser(){

    $firstname = $this->firstname;
    $lastname = $this->lastname;
    $mi = $this->mi;
    $school_id = $this->school_id;
    $department = $this->department;
    $course = $this->course;
    $email = $this->email;
    $username = $this->username;
    $password =  $this->password;
    $cpassword = $this->cpassword;

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
        $sql =  "INSERT INTO `user_account_tbl`(`firstname`,`lastname`,`mi`,`school_id`,`department`,`course`,`email`,`username`,`password`,`cpassword`) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $data = $pdo->prepare($sql);
        $data->execute([$firstname,$lastname,$mi,$school_id,$department,$course,$email,$username,$hash,$hash]);
      }
    }
  }
}
?>
