<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/db/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/pagination.php';

class view extends config{


  public function viewResearch(){
    $url = basename($_SERVER['SCRIPT_FILENAME']);
    $config = new config;
    $pdo = $config->connect();
    $sql = "SELECT * FROM `approved_research`";
    $data = $pdo->prepare($sql);
    $data->execute();
    $results = $data->fetchAll(PDO::FETCH_OBJ);

    // pagination
    $limit = 5;
    if (!isset($_GET['page'])) {
          $page = 1;
      } else{
          $page = $_GET['page'];
    }

    $start = ($page-1)*$limit;

    $total_results = $data->rowCount();
    $total_pages = ceil($total_results/$limit);

    $sql2 = "SELECT * FROM `approved_research` LIMIT $start,$limit";
    $data2 = $pdo->prepare($sql2);
    $data2->execute();
    $results2 = $data2->fetchAll(PDO::FETCH_OBJ);
    // pagination ends here

    $pageResults = $data2->rowCount();
    echo '<table class="table">';
    echo '<thead class="thead-dark">
        <tr>
          <th scope="col" class=""><i class="fa fa-book"></i><span class="d-none d-sm-block">Title</span></th>
          <th scope="col" class=""><i class="fa fa-users"></i><span class="d-none d-sm-block">Author</span></th>
          <th scope="col"><i class="fa fa-info-circle"></i><span class="d-none d-sm-block">Year</span></th>
          <th scope="col"><i class="fa fa-info-circle"></i><span class="d-none d-sm-block">Status</span></th>
          <th scope="col" colspan="2"><i class="fa fa-exclamation"></i><span class="d-none d-sm-block">Action</span></th>
        </tr>
      </thead>';
    echo '<tbody>';
    foreach ($results2 as $row) {

      $fname = $row->r_first_name;
      $lname = $row->r_last_name;
      $mi = $row->r_mi;
      $fullName = $fname . " " . $lname . " " . $mi;

      echo '<tr>
          <th scope="row">'.$row->research_title.'</th>
          <td class="">'.$fullName.'</td>
          <td class="">'.$row->year.'</td>
          <td class="">'.$row->status.'</td>
          <td><a href="pdf/'.$row->research_file.'" class="btn btn-primary" style="width:95px">View</button></td>
          <td><a href="'.$url.'?archived&rid='.$row->id.'" class="btn btn-danger" style="width:95px">Archive</a></td>
        </tr>';
    }
      echo '</tbody>';
    echo '</table>';

    echo '<div class = "container text-center mb-3 mt-3">';
    if (isset($_GET['page'])) {
      if ($_GET['page'] == 1) {
        echo '<strong>Displaying '.$pageResults.' of '.$total_results.' Results</strong>';
      }else if($_GET['page'] > 1){
        $thispage =  $_GET['page'];
        $x = $limit*$thispage;
        $y = $x - $limit;
        $total = $y + $pageResults;
        echo '<strong>Displaying '.$total.' of '.$total_results.' Results</strong>';
      }
    }else {
      echo '<strong>Displaying '.$pageResults.' of '.$total_results.' Results</strong>';
    }
    echo '</div>';

    echo '<div class="container pagecon p-0 mb-3 mb-3">';
    echo '<div class="page">';

    $pagination = new pagination($total_pages,$page,$url);
    $pagination->paginationAllResearch();
    echo '</div>';
    echo '</div>';
  }

  public function viewPendingResearch(){
    $url = basename($_SERVER['SCRIPT_FILENAME']);
    $config = new config;
    $pdo = $config->connect();
    $sql = "SELECT * FROM `for_research_approval`";
    $data = $pdo->prepare($sql);
    $data->execute();
    $results = $data->fetchAll(PDO::FETCH_OBJ);

    // pagination
    $limit = 5;
    if (!isset($_GET['page'])) {
          $page = 1;
      } else{
          $page = $_GET['page'];
    }

    $start = ($page-1)*$limit;

    $total_results = $data->rowCount();
    $total_pages = ceil($total_results/$limit);

    $sql2 = "SELECT * FROM `for_research_approval` LIMIT $start,$limit";
    $data2 = $pdo->prepare($sql2);
    $data2->execute();
    $results2 = $data2->fetchAll(PDO::FETCH_OBJ);
    // pagination ends here

    $pageResults = $data2->rowCount();
    echo '<table class="table">';
    echo '<thead class="thead-dark">
        <tr>
          <th scope="col" class=""><i class="fa fa-book"></i><span class="d-none d-sm-block">Title</span></th>
          <th scope="col" class=""><i class="fa fa-users"></i><span class="d-none d-sm-block">Author</span></th>
          <th scope="col"><i class="fa fa-info-circle"></i><span class="d-none d-sm-block">Year</span></th>
          <th scope="col"><i class="fa fa-info-circle"></i><span class="d-none d-sm-block">Status</span></th>
          <th scope="col" colspan="2"><i class="fa fa-exclamation"></i><span class="d-none d-sm-block">Action</span></th>
        </tr>
      </thead>';
    echo '<tbody>';

    foreach ($results2 as $row) {

      $fname = $row->r_first_name;
      $lname = $row->r_last_name;
      $mi = $row->r_mi;
      $fullName = $fname . " " . $lname . " " . $mi;

      // <td><a href="pdf/'.$row->research_file.'" class="btn btn-primary" style="width:95px">View</button></td>
      echo '<tr>
          <th scope="row">'.$row->research_title.'</th>
          <td class="">'.$fullName.'</td>
          <td class="">'.$row->year.'</td>
          <td class="">'.$row->status.'</td>
          <td><a href="'.$url.'?approved&rid='.$row->id.'" class="btn btn-primary" style="width:95px">Approve</a></td>
          <td><a href="'.$url.'?archived&rid='.$row->id.'" class="btn btn-danger" style="width:95px">Archive</a></td>
        </tr>';
     }
     echo '</tbody>';
    echo '</table>';
    echo '<div class = "container text-center mb-3 mt-3">';
    if (isset($_GET['page'])) {
      if ($_GET['page'] == 1) {
        echo '<strong>Displaying '.$pageResults.' of '.$total_results.' Results</strong>';
      }else if($_GET['page'] > 1){
        $thispage =  $_GET['page'];
        $x = $limit*$thispage;
        $y = $x - $limit;
        $total = $y + $pageResults;
        echo '<strong>Displaying '.$total.' of '.$total_results.' Results</strong>';
      }
    }else {
      echo '<strong>Displaying '.$pageResults.' of '.$total_results.' Results</strong>';
    }
    echo '</div>';

    echo '<div class="container pagecon p-0 mb-3 mb-3">';
    echo '<div class="page">';

    $pagination = new pagination($total_pages,$page,$url);
    $pagination->paginationAllResearch();
    echo '</div>';
    echo '</div>';
  }

  public function viewArchived(){
    $url = basename($_SERVER['SCRIPT_FILENAME']);
    $config = new config;
    $pdo = $config->connect();
    $sql = "SELECT * FROM `research_archives`";
    $data = $pdo->prepare($sql);
    $data->execute();
    $results = $data->fetchAll(PDO::FETCH_OBJ);

    // pagination
    $limit = 5;
    if (!isset($_GET['page'])) {
          $page = 1;
      } else{
          $page = $_GET['page'];
    }

    $start = ($page-1)*$limit;

    $total_results = $data->rowCount();
    $total_pages = ceil($total_results/$limit);

    $sql2 = "SELECT * FROM `research_archives` LIMIT $start,$limit";
    $data2 = $pdo->prepare($sql2);
    $data2->execute();
    $results2 = $data2->fetchAll(PDO::FETCH_OBJ);
    // pagination ends here

    $pageResults = $data2->rowCount();
    echo '<table class="table">';
    echo '<thead class="thead-dark">
        <tr>
          <th scope="col" class=""><i class="fa fa-book"></i><span class="d-none d-sm-block">Title</span></th>
          <th scope="col" class=""><i class="fa fa-users"></i><span class="d-none d-sm-block">Author</span></th>
          <th scope="col"><i class="fa fa-info-circle"></i><span class="d-none d-sm-block">Year</span></th>
          <th scope="col"><i class="fa fa-info-circle"></i><span class="d-none d-sm-block">Status</span></th>
          <th scope="col" colspan="2"><i class="fa fa-exclamation"></i><span class="d-none d-sm-block">Action</span></th>
        </tr>
      </thead>';
    echo '<tbody>';
    foreach ($results2 as $row) {

      $fname = $row->r_first_name;
      $lname = $row->r_last_name;
      $mi = $row->r_mi;
      $fullName = $fname . " " . $lname . " " . $mi;

      echo '<tr>
          <th scope="row">'.$row->research_title.'</th>
          <td class="">'.$fullName.'</td>
          <td class="">'.$row->year.'</td>
          <td class="">'.$row->status.'</td>
          <td><a href="pdf/'.$row->research_file.'" class="btn btn-primary" style="width:95px">View</button></td>
          <td><a href="'.$url.'?approved&rid='.$row->id.'" class="btn btn-primary" style="width:95px">Approve</a></td>
        </tr>';
    }
      echo '</tbody>';
    echo '</table>';

    echo '<div class = "container text-center mb-3 mt-3">';
    if (isset($_GET['page'])) {
      if ($_GET['page'] == 1) {
        echo '<strong>Displaying '.$pageResults.' of '.$total_results.' Results</strong>';
      }else if($_GET['page'] > 1){
        $thispage =  $_GET['page'];
        $x = $limit*$thispage;
        $y = $x - $limit;
        $total = $y + $pageResults;
        echo '<strong>Displaying '.$total.' of '.$total_results.' Results</strong>';
      }
    }else {
      echo '<strong>Displaying '.$pageResults.' of '.$total_results.' Results</strong>';
    }
    echo '</div>';

    echo '<div class="container pagecon p-0 mb-3 mb-3">';
    echo '<div class="page">';

    $pagination = new pagination($total_pages,$page,$url);
    $pagination->paginationAllResearch();
    echo '</div>';
    echo '</div>';
  }
}
?>
