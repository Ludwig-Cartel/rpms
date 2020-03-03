<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/accountVerification.php';
$username = $_SESSION['username'];
if(!empty($username)){
  echo $username;
  // $verify = new accountVerification($username);
  // $verify->checkAccount();
}else {
  header('location:index.php');
}
 ?>
