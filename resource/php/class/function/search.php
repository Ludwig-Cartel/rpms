<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/db/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/function/paginationSearch.php';

class search extends config{

  public $search;

  public function __construct($search=null){
    $this->search = $search;
  }

  public function searchUser(){
    $url = basename($_SERVER['SCRIPT_FILENAME']);
    $search = $this->search;
    $config = new config;
    $pdo = $config->connect();

    if (!empty($_GET['criteria'])) {
      $criteria =$_GET['criteria'];
      $sql = "SELECT * FROM `approved_research` WHERE `$criteria` LIKE '%$search%'";
    }else {
      $sql = "SELECT * FROM `approved_research` WHERE `research_title` LIKE '%$search%' OR `r_first_name` LIKE '%$search%' OR `r_last_name` LIKE '%$search%' OR `year` LIKE '%$search%' OR `status` LIKE '$search%'";
    }

    $data = $pdo->prepare($sql);
    $data->execute();
    $results = $data->fetchAll(PDO::FETCH_OBJ);

    // pagination
    $limit = 2;
    if (!isset($_GET['page'])) {
          $page = 1;
      } else{
          $page = $_GET['page'];
    }

    $start = ($page-1)*$limit;

    $total_results = $data->rowCount();
    $total_pages = ceil($total_results/$limit);
    // pagination ends here

    if (!empty($_GET['criteria'])) {
      $criteria =$_GET['criteria'];
      $sql2 = "SELECT * FROM `approved_research` WHERE `$criteria` LIKE '%$search%' LIMIT $start,$limit";
    }else {
      $sql2 = "SELECT * FROM `approved_research` WHERE `research_title` LIKE '%$search%' OR `r_first_name` LIKE '%$search%' OR `r_last_name` LIKE '%$search%' OR `year` LIKE '%$search%' OR `status` LIKE '$search%' LIMIT $start,$limit";
    }

    $data2 = $pdo->prepare($sql2);
    $data2->execute();
    $results2 = $data2->fetchAll(PDO::FETCH_OBJ);

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
          <td><a href="researchAssistantPage.php?archived&rid='.$row->id.'" class="btn btn-danger" style="width:95px">Archive</a></td>
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

    $pagination = new paginationSearch($total_pages,$page,$url,$search);

    if(empty($_GET['criteria'])){
      $pagination->searchPaging();
    }else {
      $pagination->searchPagingWithCriteria();
    }
    echo '</div>';
    echo '</div>';
  }

  public function searchPending(){
    $url = basename($_SERVER['SCRIPT_FILENAME']);
    $search = $this->search;
    $config = new config;
    $pdo = $config->connect();

    if (!empty($_GET['criteria'])) {
      $criteria =$_GET['criteria'];
      $sql = "SELECT * FROM `for_research_approval` WHERE `$criteria` LIKE '%$search%'";
    }else {
      $sql = "SELECT * FROM `for_research_approval` WHERE `research_title` LIKE '%$search%' OR `r_first_name` LIKE '%$search%' OR `r_last_name` LIKE '%$search%' OR `year` LIKE '%$search%' OR `status` LIKE '$search%'";
    }

    $data = $pdo->prepare($sql);
    $data->execute();
    $results = $data->fetchAll(PDO::FETCH_OBJ);

    // pagination
    $limit = 2;
    if (!isset($_GET['page'])) {
          $page = 1;
      } else{
          $page = $_GET['page'];
    }

    $start = ($page-1)*$limit;

    $total_results = $data->rowCount();
    $total_pages = ceil($total_results/$limit);
    // pagination ends here

    if (!empty($_GET['criteria'])) {
      $criteria =$_GET['criteria'];
      $sql2 = "SELECT * FROM `for_research_approval` WHERE `$criteria` LIKE '%$search%' LIMIT $start,$limit";
    }else {
      $sql2 = "SELECT * FROM `for_research_approval` WHERE `research_title` LIKE '%$search%' OR `r_first_name` LIKE '%$search%' OR `r_last_name` LIKE '%$search%' OR `year` LIKE '%$search%' OR `status` LIKE '$search%' LIMIT $start,$limit";
    }

    $data2 = $pdo->prepare($sql2);
    $data2->execute();
    $results2 = $data2->fetchAll(PDO::FETCH_OBJ);

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
          <td><a href="pendingWork.php?approved&rid='.$row->id.'" class="btn btn-primary" style="width:95px">Approve</a></td>
          <td><a href="pendingWork.php?archived&rid='.$row->id.'" class="btn btn-danger" style="width:95px">Archive</a></td>
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

    $pagination = new paginationSearch($total_pages,$page,$url,$search);

    if(empty($_GET['criteria'])){
      $pagination->searchPaging();
    }else {
      $pagination->searchPagingWithCriteria();
    }
    echo '</div>';
    echo '</div>';
  }

  public function searchArchived(){
    $url = basename($_SERVER['SCRIPT_FILENAME']);
    $search = $this->search;
    $config = new config;
    $pdo = $config->connect();

    if (!empty($_GET['criteria'])) {
      $criteria =$_GET['criteria'];
      $sql = "SELECT * FROM `research_archives` WHERE `$criteria` LIKE '%$search%'";
    }else {
      $sql = "SELECT * FROM `research_archives` WHERE `research_title` LIKE '%$search%' OR `r_first_name` LIKE '%$search%' OR `r_last_name` LIKE '%$search%' OR `year` LIKE '%$search%' OR `status` LIKE '$search%'";
    }

    $data = $pdo->prepare($sql);
    $data->execute();
    $results = $data->fetchAll(PDO::FETCH_OBJ);

    // pagination
    $limit = 2;
    if (!isset($_GET['page'])) {
          $page = 1;
      } else{
          $page = $_GET['page'];
    }

    $start = ($page-1)*$limit;

    $total_results = $data->rowCount();
    $total_pages = ceil($total_results/$limit);
    // pagination ends here

    if (!empty($_GET['criteria'])) {
      $criteria =$_GET['criteria'];
      $sql2 = "SELECT * FROM `research_archives` WHERE `$criteria` LIKE '%$search%' LIMIT $start,$limit";
    }else {
      $sql2 = "SELECT * FROM `research_archives` WHERE `research_title` LIKE '%$search%' OR `r_first_name` LIKE '%$search%' OR `r_last_name` LIKE '%$search%' OR `year` LIKE '%$search%' OR `status` LIKE '$search%' LIMIT $start,$limit";
    }

    $data2 = $pdo->prepare($sql2);
    $data2->execute();
    $results2 = $data2->fetchAll(PDO::FETCH_OBJ);

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
          <td><a href="archives.php?approved&rid='.$row->id.'" class="btn btn-primary" style="width:95px">Approve</a></td>
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

    $pagination = new paginationSearch($total_pages,$page,$url,$search);

    if(empty($_GET['criteria'])){
      $pagination->searchPaging();
    }else {
      $pagination->searchPagingWithCriteria();
    }
    echo '</div>';
    echo '</div>';
  }
}

?>
