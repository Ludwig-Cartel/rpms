<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/db/config.php';

class approval extends config{

  public $rid;

  function __construct($rid=null){
    $this->rid = $rid;
  }

  public function approved(){
    $rid = $this->rid;
    $config = new config;
    $pdo = $config->connect();
    $sql = "SELECT * FROM `for_research_approval` WHERE `id` = ?";
    $data = $pdo->prepare($sql);

    if($data->execute([$rid])) {
      $results = $data->fetchAll(PDO::FETCH_OBJ);
      foreach($results as $row) {
        $title = $row->research_title;
        $fname = $row->r_first_name;
        $lname = $row->r_last_name;
        $mi = $row->r_mi;
        $year = $row->year;
        $file = $row->research_file;
        $status = $row->status;
      }
      $sql2 = "INSERT INTO `approved_research` (`research_title`,`r_first_name`,`r_mi`,`r_last_name`,`year`,`research_file`,`status`) VALUES (?,?,?,?,?,?,?)";
      $data2 = $pdo->prepare($sql2);

      if ($data2->execute([$title,$fname,$mi,$lname,$year,$file,$status])) {
        $sql3 = "DELETE FROM `for_research_approval` WHERE `id` = ?";
        $data3 = $pdo->prepare($sql3);

        if($data3->execute([$rid])) {
          header("location: pendingWork.php");
        }

      }
    }
  }

  public function approvedArchived(){
    $url = basename($_SERVER['SCRIPT_FILENAME']);
    $rid = $this->rid;
    $config = new config;
    $pdo = $config->connect();
    $sql = "SELECT * FROM `research_archives` WHERE `id` = ?";
    $data = $pdo->prepare($sql);

    if($data->execute([$rid])) {
      $results = $data->fetchAll(PDO::FETCH_OBJ);
      foreach($results as $row) {
        $title = $row->research_title;
        $fname = $row->r_first_name;
        $lname = $row->r_last_name;
        $mi = $row->r_mi;
        $year = $row->year;
        $file = $row->research_file;
        $status = $row->status;
      }
      $sql2 = "INSERT INTO `approved_research` (`research_title`,`r_first_name`,`r_mi`,`r_last_name`,`year`,`research_file`,`status`) VALUES (?,?,?,?,?,?,?)";
      $data2 = $pdo->prepare($sql2);

      if ($data2->execute([$title,$fname,$mi,$lname,$year,$file,$status])) {
        $sql3 = "DELETE FROM `research_archives` WHERE `id` = ?";
        $data3 = $pdo->prepare($sql3);

        if($data3->execute([$rid])) {
          header("location: archives.php");
        }

      }
    }
  }
}
?>
