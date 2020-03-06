<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rpms/resource/php/class/db/config.php';

class view extends config{

  public function viewResearch(){
    $config = new config;
    $pdo = $config->connect();
    $sql = "SELECT * FROM `research_tbl`";
    $data = $pdo->prepare($sql);
    $data->execute();
    $results = $data->fetchAll(PDO::FETCH_OBJ);

    echo '<table>';
    echo '<tr>';
    echo '<th>Research Title</th> </th> Researchers </th> </th> Actions </th> ';
    echo '</tr>';

    foreach ($results as $row) {
      echo '<tr>';
      echo '<td>'.$row->research_title.'</td>';
      echo '<td>'.$row->researchers.'</td>';
      echo '</tr>';
    }
    echo '</table>';
  }
}
?>
