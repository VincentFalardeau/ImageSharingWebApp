<?php
    session_start();
	include "connexion.php";

	$stm = $db->prepare("update Members set password = ? where idMember = ?");
	$stm->bindParam(1, $_pwd);
	$stm->bindParam(2, $_id);
	$_pwd= "1";
	$_id=$_GET['id'];
	$stm->execute();

	header('Location: admin.php?pwd=' . $_pwd . "&pwdId=" . $_id);
?>