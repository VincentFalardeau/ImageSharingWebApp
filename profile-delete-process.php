<?php
    session_start();
	include "connexion.php";
	
	$stm = $db->prepare("delete from Comments where idMember = ?");
	$stm->bindParam(1, $_id);
	$_id=$_SESSION['id'];
	$stm->execute();
	
	$stm = $db->prepare("delete from Images where idMember = ?");
	$stm->bindParam(1, $_id);
	$_id=$_SESSION['id'];
	$stm->execute();
	
	$stm = $db->prepare("delete from Members where idMember = ?");
	$stm->bindParam(1, $_id);
	$_id=$_SESSION['id'];
	$stm->execute();
    
	header('Location: logout.php');
?>