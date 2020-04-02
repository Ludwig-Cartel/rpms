<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/addResearch.php';
if (isset($_POST['submit'])) {
  $addResearch = new addResearch($_POST['title'],$_POST['fname'],$_POST['lname'],$_POST['mi'],$_POST['year'],$_POST['status']);
  $addResearch->submitResearchApproved();
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
               <a id="ddl" class="dropdown-item" href="#"><i class="fa fa-sign-out"></i> Add Research</a>
               <a id="ddl" class="dropdown-item" href="pendingWork.php"><i class="fa fa-user"></i> Research Approvals</a>
               <a id="ddl" class="dropdown-item" href="archivest"><i class="fa fa-sign-out"></i> Archives</a>
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
     <!--  -->
     <br />
     <div class="container">
       <h2 class="text-center">Submit Research</h2>
       <hr>
       <br>
       <form method="post" enctype="multipart/form-data">
         <div class="form-row">
           <div class="form-group col-md-12">
             <label for="fn">Research Title</label>
             <input type="text" class="form-control" id="fn" name="title" placeholder="Enter Research Title" required>
           </div>
         </div>
       <!--  -->
       <div class="form-row">
         <div class="form-group col-md-5">
           <label for="fn">Author's First Name</label>
           <input type="text" class="form-control" id="name" name="fname" placeholder="Enter First Name" required>
         </div>
         <!--  -->
         <div class="form-group col-md-5">
           <label for="fn">Author's Last Name</label>
           <input type="text" class="form-control" id="name" name="lname" placeholder="Enter Last Name" required>
         </div>
         <!--  -->
         <div class="form-group col-md-2">
           <label for="fn">Author's Middle Initial</label>
           <input type="text" class="form-control" id="name" name="mi" placeholder="Enter Middle Initial" required>
         </div>
       </div>
       <div class="form-row">
         <div class="form-group col-md-3">
           <label for="fn">Year</label>
           <input type="text" class="form-control" id="year" name="year" required>
         </div>
         <!--  -->
         <div class="form-group col-md-3">
           <label for="status">Status</label>
           <select class="form-control" name="status" required>
            <option value="Published">Published</option>
             <option value="Not Published">Not Published</option>
           </select>
         </div>
         <!--  -->
         <div class="form-group col-md-3 pt-1">
           <label for="file">File upload (PDF Only)</label>
           <input type="file" id="file" name="pdf" accept="application/pdf" required>
         </div>
       </div>
         <!--  -->
         <input type="submit" class="btn btn-primary" name="submit" value="Submit">
       </div>
     </form>
     </div>
   </body>
 </html>


 <!-- <form class="" action="" method="post" enctype="multipart/form-data">
   <input type="text" name="title" value="">
   <input type="text" name="researcher" value="">
   <input type="text" name="status" value="">
   <input type="submit" name="submit" value="submit">
   <input type="file" name="pdf"  accept="application/pdf">
 </form> -->
