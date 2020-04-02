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
    <link href="vendor/css/bootstrap.min.css" rel="stylesheet">
    <link href="resource/css/style.css" rel="stylesheet">
    <title>RPMS | Register</title>
  </head>
  <body>
    <nav class="navbar">
      <a class="navbar-brand " href="https://malolos.ceu.edu.ph/">
        <img src="resource/img/logo.jpg" height="70" class="d-inline-block align-top"
          alt="mdb logo"><h3 class="ib">
      </a>
    </nav>
    <div class="container">
      <h2 class="text-center">Register</h2>
      <hr>
      <br>
      <form method="post">
        <div class="form-row">
          <div class="form-group col-md-5">
            <label for="fn">First Name</label>
            <input type="text" class="form-control" id="fn" name="fn" placeholder="First Name">
          </div>
          <!--  -->
          <div class="form-group col-md-5">
            <label for="ln">Last Name</label>
            <input type="text" name="ln" class="form-control" id="inputPassword4" placeholder="Last Name">
          </div>
          <!--  -->
          <div class="form-group col-md-2">
            <label for="inputPassword4">Middle Initial</label>
            <input type="text" name="mi" class="form-control" id="inputPassword4" placeholder="Middle Initial">
          </div>
      </div>
      <!--  -->
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="school_id">School ID</label>
          <input type="text"name="school_id" class="form-control" id="school_id" placeholder="School ID">
        </div>
        <!--  -->
        <div class="form-group col-md-4">
          <label for="department">School Department</label>
          <input type="text"name="department" class="form-control" id="department" placeholder="Department">
        </div>
        <!--  -->
        <div class="form-group col-md-4">
          <label for="course">Course</label>
          <input type="text" name="course" class="form-control" id="course" placeholder="Course">
        </div>
      </div>
      <!--  -->
      <div class="form-row">
        <div class="form-group col-md-3">
          <label for="email">Email Address</label>
          <input type="text"name="email" class="form-control" id="email" placeholder="Email">
        </div>
        <!--  -->
        <div class="form-group col-md-3">
          <label for="username">Username</label>
          <input type="text"name="username" class="form-control" id="username" placeholder="Mi">
        </div>
        <!--  -->
        <div class="form-group col-md-3">
          <label for="pass">Password</label>
          <input type="password" name="pw" class="form-control" id="pass">
        </div>
        <!--  -->
        <div class="form-group col-md-3">
          <label for="cpw">Confirm Password</label>
          <input type="password" name="cpw" class="form-control" id="cpass">
        </div>
      </div>
      <!--  -->
      <input type="submit" class="btn btn-primary" name="submit" value="Sign Up">
      <a href="index.php" class="float-right pt-4">Already have an account?</a>
    </form>
    </div>
  </body>
</html>

<!-- <form class="" action="" method="post">
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
</form> -->
