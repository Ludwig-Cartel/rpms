<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/register.php';
if(isset($_POST['submit'])){
  $register = new register($_POST['fn'],$_POST['ln'],$_POST['mi'],$_POST['school_id'],$_POST['department'],$_POST['course'],$_POST['email'],$_POST['username'],$_POST['pw'],$_POST['cpw']);
  $register->registerUser();
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
      <input type="text" name="fn" />
      <input type="text" name="ln"/>
      <input type="text" name="mi">
      <input type="text" name="school_id">
      <input type="text" name="department">
      <input type="text" name="course">
      <input type="email" name="email">
      <input type="text" name="username">
      <input type="password" name="pw">
      <input type="password" name="cpw">
      <input type="submit" name="submit" value="submit">
    </form>
  </body>
</html>
