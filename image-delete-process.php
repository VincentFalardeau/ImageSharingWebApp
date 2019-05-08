<?php
    session_start();
	include "connexion.php";

	$stm = $db->prepare("delete from Comments where idImage = ?");
	$stm->bindParam(1, $_id);
	$_id=$_GET['id'];
	$stm->execute();
	
	$stm = $db->prepare("delete from Images where idImage = ?");
	$stm->bindParam(1, $_id);
	$_id=$_GET['id'];
	$stm->execute();

	header('Location: index.php');
?>