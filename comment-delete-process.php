<?php 
session_start();
if(isset($_GET['idComment'])) {

   $commentid = $_GET['idComment'];

   include "connexion.php";

   $stm = $db->prepare("DELETE FROM Comments WHERE idComment = ?");
              
   $stm->bindParam(1, $commentid);
   
   $stm->execute();

   header("Location: gestimage.php?id=" . $_GET['id']);
}
?>