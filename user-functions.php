<?php

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
            $db = null;
    	}catch(PDOException $e){}
    	return $user;
    }

    function subscribeUser($username, $password, $firstName, $lastName, $email){
        try{
            include "connexion.php";
            $stm = $db->prepare("insert into Members values(null, ?, ?, ?, ?, ?)");
            $stm->bindParam(1, $param_username);
            $stm->bindParam(2, $param_password);
            $stm->bindParam(3, $param_firstName);
            $stm->bindParam(4, $param_lastName);
            $stm->bindParam(5, $param_email);
            $param_username=$username;
            $param_password=$password;
            $param_firstName=$firstName;
            $param_lastName=$lastName;
            $param_email=$email;
            $stm->execute();
            $db = null;
        }catch(PDOException $e){}
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
            $db = null;
   		}catch(PDOException $e){}
        return $result[0];
    }

    function updateEmail($id, $email){
         try{
            include "connexion.php";
            $stm = $db->prepare("update Members set email = ? where idMember = ?");
            $stm->bindParam(1, $_email);
            $stm->bindParam(2, $_idMember);
            $_email = $email;
            $_idMember = $id;
            $stm->execute();
            $db = null;
        }catch(PDOException $e){}
    }

    function updatePassword($id, $password){
         try{
            include "connexion.php";
            $stm = $db->prepare("update Members set password = ? where idMember = ?");
            $stm->bindParam(1, $_password);
            $stm->bindParam(2, $_idMember);
            $_password = $password;
            $_idMember = $id;
            $stm->execute();
            $db = null;
        }catch(PDOException $e){}
    }

    function getMemberById($id){
        $member = null;
         try{
            include "connexion.php";
            $stm = $db->prepare("call getMemberById(?)");
            $stm->bindParam(1, $_id);
            $_id = $id;;
            $stm->execute();
            $member = $stm->fetch();
            $db = null;
        }catch(PDOException $e){}
        return $member;
    }
?>