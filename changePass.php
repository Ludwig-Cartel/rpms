<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/changePass.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/accountVerification.php';
$id = $_SESSION['id'];
$check = new accountVerification($id);
$check->checkAccount();
$check->isAdmin();
if (isset($_POST['submit'])) {
  $edit = new changePass($_GET['aid'],$_POST['pw'],$_POST['cpw']);
  $edit->change();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title></title>
  <!-- custom font here -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  <!-- custom font here  -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="http://code.jquery.com/jquery.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="scss/style.css">
  <link rel="stylesheet" href="resource/css/pagination.css">
      <link href="resource/css/style.css" rel="stylesheet">
</head>
<body>

<nav id="navb" class="navbar navbar-expand-lg navbar-light shadow-sm static-top" style="">
<div class="container">
  <a class="navbar-brand" href="#">
        <img src="scss/logo4.png" alt="" style="height:70px;margin-top:-10px;">
      </a>
  <button id="hamburger" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a  id="navl1" class="nav-link" href="adminHome.php"><i class="fa fa-home"></i> Home</a>
      </li>
      <!-- <li class="nav-item">
        <a  id="navl1" class="nav-link" href="ResearchSubmit.php"><i class="fa fa-sticky-note pr-1"></i>Submit Research</a>
      </li> -->
      <li class="nav-item dropdown">
        <a id="navl1" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user-circle"></i> Work
        </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a id="ddl" class="dropdown-item" href="addResearchAdmin.php"><i class="fa fa-sign-out"></i> Add Research</a>
        <a id="ddl" class="dropdown-item" href="pendingWorkAdmin.php"><i class="fa fa-user"></i> Research Approvals</a>
        <a id="ddl" class="dropdown-item" href="archivesAdmin.php"><i class="fa fa-sign-out"></i> Archives</a>
      </div>
    </li>
    <!--  -->
    <li class="nav-item dropdown">
      <a id="navl1" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-user-circle"></i> Admin Tools
      </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a id="ddl" class="dropdown-item" href="viewAccount.php"><i class="fa fa-sign-out"></i>Account List</a>

    </div>
  </li>
      <li class="nav-item dropdown">
        <a id="navl1" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user-circle"></i> Accounts
        </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a id="ddl" class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
        <a id="ddl" class="dropdown-item" href="adminHome.php?logout"><i class="fa fa-sign-out"></i> Logout</a>
      </div>
    </li>
    </ul>
  </div>
</div>
</nav>
<br>
<br>
<br>
<h2 class="text-center">Change Password</h2>
<hr class="line">
  <body>
    <div class="container-fluid all">
      <div class="row justify-content-center">
        <form method="post">
           <div class="form-group">
             <label for="un">New Password</label>
             <input type="password" class="form-control" id="pw" name="pw" placeholder="Enter New Password">
            </div>
            <!--  -->
            <div class="form-group">
              <label for="pw">Re-type New Password</label>
              <input type="password" class="form-control" id="cpw" name="cpw" placeholder="Re-enter Password">
            </div>
             <!--  -->
           <div class="form-group">
               <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Save Changes">
           </div>
           <!-- <div class="form-group text-center">
              <a href="register.php">Don't have an account yet?</a>
           </div> -->
        </form>
      </div>
    </div>
  </body>
</html>
