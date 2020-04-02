<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/user.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/view.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/approval.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/search.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/logout.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/archives.php';
$username = $_SESSION['username'];
$id = $_SESSION['id'];
if(isset($username)){
  $username = new user($id);
  $view = new view;
  $logout = new logout;
  $logout->userLogOut();
}else {
  header('location:index.php');
}
if(isset($_GET['approved'])){
  $approve = new approval($_GET['rid']);
  $approve->approved();
}
if(isset($_GET['archived'])){
  $archive = new archives($_GET['rid']);
  $archive->archivedInAprroval();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
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
            <a  id="navl1" class="nav-link" href="researchAssistantPage.php"><i class="fa fa-home"></i> Home</a>
          </li>
          <!-- <li class="nav-item">
            <a  id="navl1" class="nav-link" href="ResearchSubmit.php"><i class="fa fa-sticky-note pr-1"></i>Submit Research</a>
          </li> -->
          <li class="nav-item dropdown">
            <a id="navl1" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-circle"></i> Work
            </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a id="ddl" class="dropdown-item" href="addResearch.php"><i class="fa fa-sign-out"></i> Add Research</a>
            <a id="ddl" class="dropdown-item" href="pendingWork.php"><i class="fa fa-user"></i> Research Approvals</a>
            <a id="ddl" class="dropdown-item" href="archives"><i class="fa fa-sign-out"></i> Archives</a>
          </div>
        </li>
          <li class="nav-item dropdown">
            <a id="navl1" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-circle"></i> Accounts
            </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a id="ddl" class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
            <a id="ddl" class="dropdown-item" href="userHomePage.php?logout"><i class="fa fa-sign-out"></i> Logout</a>
          </div>
        </li>
        </ul>
      </div>
    </div>
  </nav>
<br />

  <header id="center-header" class="py-2 text-dark">
    <div class="container">
          <h1>Pending Research Approvals</h1>
      </div>
  </header>

  <div class="container search">
    <form class="form-inline float-lg-right float-md-right row float-sm-right row mb-2" method="get">
    <input class="form-control mr-sm-2" type="text" placeholder="Search" name="search" aria-label="Search" required>
        <select class="form-control mr-sm-2" name="criteria" required>
        <option selected="false" disabled="disabled" value="all">Filter By:</option>
        <option value="research_title">Title</option>
        <option value="r_first_name">Author's First Name</option>
        <option value="r_last_name">Author's Last Name</option>
        <option value="year">Year</option>
        <option value="status">Status</option>
      </select>
      <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Search" name="submit">
    </form>
  </div>

<section>
  <?php
  if (isset($_GET['submit'])) {
    $search = new search($_GET['search']);
    $search->searchPending();
  }else {
    $view->viewPendingResearch();
  }
   ?>
</section>

  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
