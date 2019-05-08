<?php
    session_start();
	include "connexion.php";
    if(isset($_POST["description"]) && $_POST["description"] !== ""){
        $statement = $db->prepare("update Images set description = ? where idImage = ?");
        $statement->bindParam(1, $_description);
        $statement->bindParam(2, $_idImg);
        $_description = $_POST["description"];
        $_idImg = $_GET["id"];
        $statement->execute();
    }
	header("Location: image-edit.php?description=" . $_description . "&id=" . $_idImg);
?>