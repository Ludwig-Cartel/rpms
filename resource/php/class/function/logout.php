<?php
class logout{

  public function userLogOut(){

    if (isset($_GET['logout'])) {
      session_destroy();
      header("Location: index.php");
    }
  }

}
?>
