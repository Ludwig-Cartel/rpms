<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/db/config.php';

class addResearch extends config{

  public $title;
  public $fname;
  public $lname;
  public $mi;
  public $year;
  public $status;
  // public $upload;

  public function __construct($title=null,$fname=null,$lname=null,$mi=null,$year=null,$status=null){
    $this->title = $title;
    $this->fname = $fname;
    $this->lname = $lname;
    $this->mi = $mi;
    $this->year = $year;
    $this->status = $status;
    // $this->upload = $upload;
  }

  public function submitResearch(){

    $title = $this->title;
    $fname = $this->fname;
    $lname = $this->lname;
    $mi = $this->mi;
    $year = $this->year;
    $status = $this->status;
    // $upload = $this->upload;


    $allow = array('pdf');
    $file = $_FILES['pdf']['name'];
    $tmp_name = $_FILES['pdf']['tmp_name'];
    $dir = "pdf/";
    move_uploaded_file($tmp_name,$dir.$file);
    // $temp = explode(".", $_FILES['pdf']['name']);
    // $extension = end($temp);
    // $upload_file = $_FILES['pdf']['name'];
    // move_uploaded_file($_FILES['pdf']['tmp_name'],'pdf/'.$_FILES['pdf']['name']);

    // $allow = array('pdf');
    // $pdfName =$_FILES['pdf']['title'];
    // $tmp_name=$_FILES['pdf']['tmp_name'];
    // $pdfSize=$_FILES['pdf']['size'];
    // $dir = 'resource/pdf/';
    // move_uploaded_files($tmp_name,$dir.$pdfName);

    // $pdf = $_FILES['pdf']['name'];
    // $tmp_dir = $_FILES['pdf']['tmp_name'];
    // $pdfSize=$_FILES['pdf']['size'];
    // $upload_dir='resource/';
    // $pdfExt=strtolower(pathinfo($pdf,PATHINFO_EXTENSION));
    // $valid_extensions=array('pdf');
    // $file=rand(1000, 1000000).".".$pdfExt;
    // move_uploaded_file($tmp_dir, $upload_dir.$file);

    // $temp = explode(".",$_FILES['pdf']['title']);
    // $extension = end($temp);
    // $upload_file = $_FILES ['pdf']['title'];
    // move_uploaded_files($_FILES['pdf']['tmp_name'],"resource/pdf/".$_FILES['pdf']['name']);

    $config = new config;
    $pdo = $config->connect();
    $sql = "INSERT INTO `for_research_approval`(`research_title`,`r_first_name`,`r_mi`,`r_last_name`,`year`,`research_file`,`status`) VALUES (?,?,?,?,?,?,?)";
    $data = $pdo->prepare($sql);

    if ($data->execute([$title,$fname,$lname,$mi,$year,$file,$status])){
      echo '<script language="javascript">';
      echo 'alert("Your research has been submitted!")';
      echo '</script>';
    }

  }

  public function submitResearchApproved(){

    $title = $this->title;
    $fname = $this->fname;
    $lname = $this->lname;
    $mi = $this->mi;
    $year = $this->year;
    $status = $this->status;
    // $upload = $this->upload;


    $allow = array('pdf');
    $file = $_FILES['pdf']['name'];
    $tmp_name = $_FILES['pdf']['tmp_name'];
    $dir = "pdf/";
    move_uploaded_file($tmp_name,$dir.$file);
    // $temp = explode(".", $_FILES['pdf']['name']);
    // $extension = end($temp);
    // $upload_file = $_FILES['pdf']['name'];
    // move_uploaded_file($_FILES['pdf']['tmp_name'],'pdf/'.$_FILES['pdf']['name']);

    // $allow = array('pdf');
    // $pdfName =$_FILES['pdf']['title'];
    // $tmp_name=$_FILES['pdf']['tmp_name'];
    // $pdfSize=$_FILES['pdf']['size'];
    // $dir = 'resource/pdf/';
    // move_uploaded_files($tmp_name,$dir.$pdfName);

    // $pdf = $_FILES['pdf']['name'];
    // $tmp_dir = $_FILES['pdf']['tmp_name'];
    // $pdfSize=$_FILES['pdf']['size'];
    // $upload_dir='resource/';
    // $pdfExt=strtolower(pathinfo($pdf,PATHINFO_EXTENSION));
    // $valid_extensions=array('pdf');
    // $file=rand(1000, 1000000).".".$pdfExt;
    // move_uploaded_file($tmp_dir, $upload_dir.$file);

    // $temp = explode(".",$_FILES['pdf']['title']);
    // $extension = end($temp);
    // $upload_file = $_FILES ['pdf']['title'];
    // move_uploaded_files($_FILES['pdf']['tmp_name'],"resource/pdf/".$_FILES['pdf']['name']);

    $config = new config;
    $pdo = $config->connect();
    $sql = "INSERT INTO `approved_research`(`research_title`,`r_first_name`,`r_mi`,`r_last_name`,`year`,`research_file`,`status`) VALUES (?,?,?,?,?,?,?)";
    $data = $pdo->prepare($sql);

    if ($data->execute([$title,$fname,$lname,$mi,$year,$file,$status])){
      echo '<script language="javascript">';
      echo 'alert("Your research has been submitted!")';
      echo '</script>';
    }

  }
}
?>
