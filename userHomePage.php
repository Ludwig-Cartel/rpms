<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/accountVerification.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/user.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/view.php';
$username = $_SESSION['username'];
$id = $_SESSION['id'];
if(isset($username)){
  $verification = new accountVerification($username);
  $username = new user($id);
  $view = new view;
  $verification->checkAccount();
  $username->getUserName();
}else {
  header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
<?php
$view->viewResearch();
 ?>
  </body>
</html>
