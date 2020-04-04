<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/db/config.php';

class edit extends config{

  public $firstname;
  public $lastname;
  public $mi;
  public $school_id;
  public $department;
  public $email;
  public $username;
  public $password;
  public $cpassword;

  public function __construct($firstname=null,$lastname=null,$mi=null,$school_id=null,$department=null,$course=null,$email=null,$username=null){
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->mi = $mi;
    $this->school_id = $school_id;
    $this->department = $department;
    $this->course = $course;
    $this->email =  $email;
    $this->username = $username;
  }

  public function editAccount(){
    $aid = $_GET['aid'];
    $firstname = $this->firstname;
    $lastname = $this->lastname;
    $mi = $this->mi;
    $school_id = $this->school_id;
    $department = $this->department;
    $course = $this->course;
    $email = $this->email;
    $username = $this->username;

    $config = new config;
    $pdo = $config->connect();
    $userConfigQuery = "SELECT `username` FROM `user_account_tbl` WHERE `id` != '$aid'";
    $config = $pdo->prepare($userConfigQuery);
    $config->execute();
    $results = $config->fetchAll(PDO::FETCH_OBJ);

    foreach ($results as $row) {
      $existingUsername = $row->username;
    }

    if ($existingUsername == $username) {
      echo "Username already exists";
    }else {
      $sql = "UPDATE `user_account_tbl` SET `firstname` = '$firstname', `lastname` = '$lastname', `mi` = '$mi', `school_id` = '$school_id', `department` = '$department', `course` = '$course', `email` = '$email', `username` = '$username' WHERE `id` = '$aid'";
      $data = $pdo->prepare($sql);
      if ($data->execute()) {
        header("Location: viewAccount.php");
      }
    }


  }
}
?>
