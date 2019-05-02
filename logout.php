<?php
	session_start();
	session_destroy();                // supprime le fichier de session
	session_unset();                  // supprime le tableau des variables
	setcookie("PHPSESSID", null, -1); // supprime le cookie
	header('Location: index.php');
?>