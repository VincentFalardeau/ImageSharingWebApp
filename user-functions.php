<?php
    function authentifyUser($username, $password){
    	$user = null;
    	try{
    		include "connexion.php";
    		$stm = $db->prepare("call Authentifier(?,?)");
        	$stm->bindParam(1, $_username);
        	$stm->bindParam(2, $_password);
        	$_username = $username;
        	$_password = $password;
        	$stm->execute();
        	$user = $stm->fetch();
    	}catch(PDOException $e){}
    	return $user;
    }
    function logUser($username, $password){
    	$user = authentifyUser($username, $password);
    	if($user[0] !== null){
    		session_start();
    		$_SESSION['id'] = $user[0];
    		$_SESSION['username'] = $user[1];
    		$_SESSION['firstName'] = $user[2];
    		$_SESSION['lastName'] = $user[3];
    		$location = "index.php";
    		header("Location: " . $location);
    	}
    }

    function userNameExists($username){
    	$result = null;
   		try{
   			include "connexion.php";
        	$stm = $db->prepare("call aliasExists(?)");
        	$stm->bindParam(1, $_username);
        	$_username=$username;
        	$stm->execute();
        	$result = $stm->fetch();
   		}catch(PDOException $e){}
        return $result[0];
    }
?>