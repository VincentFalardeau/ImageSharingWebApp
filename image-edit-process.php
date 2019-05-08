<?php
	include "connexion.php";

	$statement = $db->prepare("update Images set titre = ? where idImage = ?");
    $statement->bindParam(1, $_titre);
    $statement->bindParam(2, $_idImg);
    $_titre = $_POST["titre"];
    if($_titre === ""){
        $_titre = "Sans titre";
    }
    $_idImg = $_GET["id"];
    $statement->execute();
    
    $statement = $db->prepare("update Images set description = ? where idImage = ?");
    $statement->bindParam(1, $_description);
    $statement->bindParam(2, $_idImg);
    $_description = $_POST["description"];
    $_idImg = $_GET["id"];
    $statement->execute();

	header("Location: image-edit.php?titre=" . $_titre  . "&description=" . $_description . "&id=" . $_idImg);
?>