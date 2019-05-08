<?php 
session_start();
if(isset($_POST['comment']) && isset($_POST['image']) && isset($_SESSION['id'])) {

   $comment = $_POST['comment'];
   $image = $_POST['image'];
   $userid = $_SESSION['id'];

   include "connexion.php";

   $stm = $db->prepare("INSERT INTO Comments (idMember, idImage, description, date) VALUES (?, ?, ?, ?)");

   $stm->bindParam(1, $userid);
   $stm->bindParam(2,  $image);
   $stm->bindParam(3, $comment);
   $stm->bindParam(4, date('Y-m-d H:i:s'));
   
   $stm->execute();

   $id=$db->lastInsertId();

   echo $id;
}
?>