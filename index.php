<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/login.php';

if (isset($_POST['submit'])) {
  $login = new login($_POST['username'],$_POST['pw']);
  $login->loginUser();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form class="" action="" method="post">
      <input type="text" name="username" value="">
      <input type="password" name="pw" />
      <input type="submit" name="submit" />
    </form>
  </body>
</html>
