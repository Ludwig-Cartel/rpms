<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/edit.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/getInfo.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/logout.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/accountVerification.php';
$id = $_SESSION['id'];
$check = new accountVerification($id);
$check->checkAccount();
$check->isAdmin();
$info = new getInfo($_GET['aid']);
$info->accountInfo();

if(isset($_POST['submit'])){
  $edit = new edit($_POST['fn'],$_POST['ln'],$_POST['mi'],$_POST['school_id'],$_POST['department'],$_POST['course'],$_POST['email'],$_POST['username']);
  $edit->editAccount();
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
    <div class="container">
      <h2 class="text-center">Edit Account</h2>
      <hr>
      <br>
      <form method="post">
        <div class="form-row">
          <div class="form-group col-md-5">
            <label for="fn">First Name</label>
            <input type="text" class="form-control" id="fn" name="fn"  value="<?php echo $info->firstname; ?>">
          </div>
          <!--  -->
          <div class="form-group col-md-5">
            <label for="ln">Last Name</label>
            <input type="text" name="ln" class="form-control" id="inputPassword4" value="<?php echo $info->lastname; ?>">
          </div>
          <!--  -->
          <div class="form-group col-md-2">
            <label for="inputPassword4">Middle Initial</label>
            <input type="text" name="mi" class="form-control" id="inputPassword4" value="<?php echo $info->mi; ?>">
          </div>
      </div>
      <!--  -->
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="school_id">School ID</label>
          <input type="text"name="school_id" class="form-control" id="school_id" value="<?php echo $info->school_id; ?>">
        </div>
        <!--  -->
        <div class="form-group col-md-4">
          <label for="department">School Department</label>
          <input type="text"name="department" class="form-control" id="department" value="<?php echo $info->department; ?>">
        </div>
        <!--  -->
        <div class="form-group col-md-4">
          <label for="course">Course</label>
          <input type="text" name="course" class="form-control" id="course" value="<?php echo $info->course; ?>">
        </div>
      </div>
      <!--  -->
      <div class="form-row">
        <div class="form-group col-md-3">
          <label for="email">Email Address</label>
          <input type="text"name="email" class="form-control" id="email"value="<?php echo $info->email; ?>">
        </div>
        <!--  -->
        <div class="form-group col-md-3">
          <label for="username">Username</label>
          <input type="text"name="username" class="form-control" id="username" value="<?php echo $info->username; ?>">
        </div>
        <!--  -->
      </div>
      <!--  -->
      <input type="submit" class="btn btn-primary" name="submit" value="Save Changes">
      <a href="<?php echo 'changePass.php?aid='.$info->aid.''; ?>" class="float-right pt-4">Change Password</a>
    </form>
    </div>
  </body>
</html>
