<?php
    session_start();
	include "connexion.php";
	if(isset($_POST["titre"]) && $_POST["titre"] !== ""){
    	$statement = $db->prepare("update Images set titre = ? where idImage = ?");
    	$statement->bindParam(1, $_titre);
    	$statement->bindParam(2, $_idImg);
    	$_titre = $_POST["titre"];
    	$_idImg = $_GET["id"];
    	$statement->execute();
	}
	header("Location: image-edit.php?titre=" . $_titre  . "&id=" . $_idImg);
?>