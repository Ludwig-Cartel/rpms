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
      $sql = "SELECT * FROM `research_tbl` WHERE `approval` = 'approved' AND `$criteria` LIKE '%$search%'";
    }else {
      $sql = "SELECT * FROM `research_tbl` WHERE `approval` = 'approved' AND `research_title` LIKE '%$search%' OR `r_first_name` LIKE '%$search%' OR `r_last_name` LIKE '%$search%' OR `year` LIKE '%$search%' OR `status` LIKE '%$search%'";
    }

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
    // pagination ends here

    if (!empty($_GET['criteria'])) {
      $criteria =$_GET['criteria'];
      $sql2 = "SELECT * FROM `research_tbl` WHERE `approval` = 'approved' AND `$criteria` LIKE '%$search%' LIMIT $start,$limit";
    }else {
      $sql2 = "SELECT * FROM `research_tbl` WHERE `approval` = 'approved' AND `research_title` LIKE '%$search%' OR `r_first_name` LIKE '%$search%' OR `r_last_name` LIKE '%$search%' OR `year` LIKE '%$search%' OR `status` LIKE '%$search%' LIMIT $start,$limit";
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
      $sql = "SELECT * FROM `research_tbl` WHERE `approval` = 'for_approval' AND `$criteria` LIKE '%$search%'";
    }else {
      $sql = "SELECT * FROM `research_tbl` WHERE `approval` = 'for_approval' AND `research_title` LIKE '%$search%' OR `r_first_name` LIKE '%$search%' OR `r_last_name` LIKE '%$search%' OR `year` LIKE '%$search%' OR `status` LIKE '%$search%'";
    }

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
    // pagination ends here

    if (!empty($_GET['criteria'])) {
      $criteria =$_GET['criteria'];
      $sql2 = "SELECT * FROM `research_tbl` WHERE `approval` = 'for_approval' AND `$criteria` LIKE '%$search%' LIMIT $start,$limit";
    }else {
      $sql2 = "SELECT * FROM `research_tbl` WHERE `approval` = 'for_approval' AND `research_title` LIKE '%$search%' OR `r_first_name` LIKE '%$search%' OR `r_last_name` LIKE '%$search%' OR `year` LIKE '%$search%' OR `status` LIKE '%$search%' LIMIT $start,$limit";
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
      $sql = "SELECT * FROM `research_tbl` WHERE `approval` = 'archived' AND `$criteria` LIKE '%$search%'";
    }else {
      $sql = "SELECT * FROM `research_tbl` WHERE `approval` = 'archived' AND `research_title` LIKE '%$search%' OR `r_first_name` LIKE '%$search%' OR `r_last_name` LIKE '%$search%' OR `year` LIKE '%$search%' OR `status` LIKE '%$search%'";
    }

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
    // pagination ends here

    if (!empty($_GET['criteria'])) {
      $criteria =$_GET['criteria'];
      $sql2 = "SELECT * FROM `research_tbl` WHERE `approval` = 'archived' AND `$criteria` LIKE '%$search%' LIMIT $start,$limit";
    }else {
      $sql2 = "SELECT * FROM `research_tbl` WHERE `approval` = 'archived' AND `research_title` LIKE '%$search%' OR `r_first_name` LIKE '%$search%' OR `r_last_name` LIKE '%$search%' OR `year` LIKE '%$search%' OR `status` LIKE '%$search%' LIMIT $start,$limit";
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


  public function searchAccounts(){
    $url = basename($_SERVER['SCRIPT_FILENAME']);
    $search = $this->search;
    $config = new config;
    $pdo = $config->connect();

    if (!empty($_GET['criteria'])) {
      $criteria =$_GET['criteria'];
      $sql = "SELECT * FROM `user_account_tbl` WHERE `$criteria` LIKE '%$search%'";
    }else {
      $sql = "SELECT * FROM `user_account_tbl` WHERE `firstname` LIKE '%$search%' OR `lastname` LIKE '%$search%' OR `school_id` LIKE '%$search%' OR `username` LIKE '%$search%' OR `department` LIKE '%$search%'";
    }

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
    // pagination ends here

    if (!empty($_GET['criteria'])) {
      $criteria =$_GET['criteria'];
      $sql2 = "SELECT * FROM `user_account_tbl` WHERE `$criteria` LIKE '%$search%' LIMIT $start,$limit";
    }else {
      $sql2 = "SELECT * FROM `user_account_tbl` WHERE `firstname` LIKE '%$search%' OR `lastname` LIKE '%$search%' OR `school_id` LIKE '%$search%' OR `username` LIKE '%$search%' OR `department` LIKE '%$search%' LIMIT $start,$limit";
    }

    $data2 = $pdo->prepare($sql2);
    $data2->execute();
    $results2 = $data2->fetchAll(PDO::FETCH_OBJ);

    $pageResults = $data2->rowCount();
    echo '<table class="table">';
    echo '<thead class="thead-dark">
    <tr>
      <th scope="col" class=""><i class="fa fa-book"></i><span class="d-none d-sm-block">Name</span></th>
      <th scope="col" class=""><i class="fa fa-users"></i><span class="d-none d-sm-block">School ID</span></th>
      <th scope="col"><i class="fa fa-info-circle"></i><span class="d-none d-sm-block">Department</span></th>
      <th scope="col"><i class="fa fa-info-circle"></i><span class="d-none d-sm-block">Username</span></th>
      <th scope="col"><i class="fa fa-info-circle"></i><span class="d-none d-sm-block">Account State</span></th>
      <th scope="col"><i class="fa fa-info-circle"></i><span class="d-none d-sm-block">Actions</span></th>
    </tr>
      </thead>';
    echo '<tbody>';

    foreach ($results2 as $row) {
      $fname = $row->firstname;
      $lname = $row->lastname;
      $mi = $row->mi;
      $fullName = $fname . " " . $mi . ". " . $lname;

      echo '<tr>';
      echo '
      <th scope="row">'.$fullName.'</th>
      <td class="">'.$row->school_id.'</td>
      <td class="">'.$row->department.'</td>
      <td class="">'.$row->username.'</td>
      ';
      if ($row->account_state == 'Deactivated') {
        echo '<td><a href="'.$url.'?'.'&state='.$row->account_state.'&aid='.$row->id.'" class="btn btn-danger" style="width:110px">'.$row->account_state.'</a></td>';
      }else {
          echo '<td><a href="'.$url.'?'.'&state='.$row->account_state.'&aid='.$row->id.'" class="btn btn-success" style="width:110px">'.$row->account_state.'</a></td>';
      }
      echo '<td><a href="editAccount.php?&aid='.$row->id.'" class="btn btn-primary" style="width:95">Edit</a></td>';
      echo '</tr>';
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
