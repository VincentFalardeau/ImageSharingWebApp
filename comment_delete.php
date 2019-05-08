<?php 
 session_start();
 if(isset($_POST['commentid']) && isset($_SESSION['id'])) {

   $commentid = $_POST['commentid'];
   $userid = $_SESSION['id'];

   include "connexion.php";


   $stm = $db->prepare("DELETE FROM Comments WHERE idMember = ? AND idComment = ?");
              
   $stm->bindParam(1, $userid);
   $stm->bindParam(2, $commentid);
   
   $stm->execute();

   $id=$db->lastInsertId();


   echo $id;
}
?>