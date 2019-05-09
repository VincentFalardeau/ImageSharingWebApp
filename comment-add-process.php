<?php 
session_start();
if(isset($_POST['comment']) && isset($_GET['id']) && isset($_SESSION['id'])) {

   include "connexion.php";

   $stm = $db->prepare("INSERT INTO Comments (idMember, idImage, description, date) VALUES (?, ?, ?, ?)");

   $stm->bindParam(1, $userId);
   $stm->bindParam(2,  $imageId);
   $stm->bindParam(3, $comment);
   $stm->bindParam(4, $date);

   $date = date('Y-m-d H:i:s');
   $comment = $_POST['comment'];
   $imageId = $_GET['id'];
   $userId = $_SESSION['id'];
   
   $stm->execute();

   header("Location: gestimage.php?id=" . $imageId);
}
?>