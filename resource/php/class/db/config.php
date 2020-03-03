<?php
session_start();
 class config {
   private $user = 'root';
   private $pass = '';
   public $pdo = null;

   public function connect(){
     try{
       $this->pdo = new PDO('mysql:host=localhost;dbname=rpms', $this->user, $this->pass);
       $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
       $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
     } catch (PDOException $e) {
       print "Error!: " . $e->getMessage() . '<br />';
     }
     return $this->pdo;
   }
 }
?>
