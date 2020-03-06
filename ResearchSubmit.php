<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/addResearch.php';
if (isset($_POST['submit'])) {
  $addResearch = new addResearch($_POST['title'],$_POST['researcher'],$_POST['status']);
  $addResearch->submitResearch();
}
?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     <form class="" action="" method="post" enctype="multipart/form-data">
       <input type="text" name="title" value="">
       <input type="text" name="researcher" value="">
       <input type="text" name="status" value="">
       <input type="submit" name="submit" value="submit">
       <input type="file" name="pdf"  accept="application/pdf">
     </form>
   </body>
 </html>
