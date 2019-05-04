<?php 
 session_start();
 if(isset($_FILES["ImageFile"]) && isset($_POST['ImageTitle']) && isset($_POST['ImageDescription'])) {

      $file = $_FILES["ImageFile"];
      if (($_FILES['ImageFile']['type'] == "image/jpeg") ||
      ($_FILES['ImageFile']['type'] == "image/png") ||
      ($_FILES['ImageFile']['type'] == "image/gif")) {
          if (is_uploaded_file($_FILES['ImageFile']['tmp_name'])) {

              include "connexion.php";
              $stm = $db->prepare("INSERT INTO Images (idMember, titre, url, Description) VALUES (?, ?, ?, ?)");
              
              $stm->bindParam(1, $_SESSION['id']);
              $stm->bindParam(2, $_POST['ImageTitle']);
              $stm->bindParam(3, $_FILES['ImageFile']['name']);
              $stm->bindParam(4, $_POST['ImageDescription']);
              
              $stm->execute();

              $id=$db->lastInsertId();

              $rep = 'fichiers/';
              $fich = $rep . basename($_FILES['ImageFile']['name']);

              if (move_uploaded_file($_FILES['ImageFile']['tmp_name'], $fich)) {
                  $nouveau_fich = $rep . $id . '.png';
                  rename($fich, $nouveau_fich);
              } else {
                  // Erreur déplacement
              }
          }else{
                  // Erreur d'upload
          }
      }else {
         // Pas image erreur
      }
  }
  $location =  "./index.php";
  header('Location: '.$location);

?>