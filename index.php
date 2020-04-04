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
    <link href="vendor/css/bootstrap.min.css" rel="stylesheet">
    <link href="resource/css/login.css" rel="stylesheet">
    <title>RPMS | Login</title>
  </head>
  <body>
    <div class="container-fluid all">
      <div class="row justify-content-center">
        <form method="post">
          <div class="form-group ml-3">
            <img src="scss/logo4.png" height="100" id="logo"/>
          </div>
           <div class="form-group">
             <label for="un">Username</label>
             <input type="text" class="form-control" id="un" name="username" placeholder="Enter Username">
            </div>
            <!--  -->
            <div class="form-group">
              <label for="pw">Password</label>
              <input type="password" class="form-control" id="pw" name="pw" placeholder="Enter Password">
            </div>
             <!--  -->
           <div class="form-group">
               <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Sign In">
           </div>
           <hr />
           <div class="form-group text-center">
              <a href="register.php">Don't have an account yet?</a>
           </div>
        </form>
      </div>
    </div>
  </body>
</html>
