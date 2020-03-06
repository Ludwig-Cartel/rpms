<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/db/config.php';

class addResearch extends config{

  public $title;
  public $researcher;
  // public $upload;
  public $status;

  public function __construct($title=null,$researcher=null,$status=null){
    $this->title = $title;
    $this->researcher = $researcher;
    // $this->upload = $upload;
    $this->status = $status;
  }

  public function submitResearch(){

    $title = $this->title;
    $researchers = $this->researcher;
    // $upload = $this->upload;
    $status = $this->status;


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
    $sql = "INSERT INTO `research_tbl`(`research_title`,`researchers`,`research_file`,`status`) VALUES (?,?,?,?)";
    $data = $pdo->prepare($sql);
    $data->execute([$title,$researchers,$file,$status]);

  }
}
?>
