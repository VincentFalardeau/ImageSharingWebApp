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
            $_id = $id;
            $stm->execute();
            $member = $stm->fetch();
            $db = null;
        }catch(PDOException $e){}
        return $member;
    }

    function injectAllMembers($keyword){
        try{
            include "connexion.php";
            $statement = $db->prepare("call getMembers()");
            $statement->execute();
            while($donnees = $statement->fetch()){
                if($donnees[1] !== "admin" && ($keyword === "" || 
                    (strpos($donnees[1], $keyword) !== false) || 
                    (strpos($donnees[3], $keyword) !== false) || 
                    (strpos($donnees[4], $keyword) !== false))){
                    echo "<div class=\"col-4\" style=\"margin-bottom:20px;\">" . 
                    "<div class=\"card\">" . 
                    "<div class=\"card-body shadow-sm\" style=\"padding: 10px;height: 100px; text-align:center; background-color: gainsboro;\">" .
                    "<div style=\"width:100%;\">" . $donnees[3] . " " . $donnees[4] . " <b>alias</b> " . $donnees[1] . "</div>";
                                            
                    echo "<a class=\"card-link\"href='./pwd-generate-process.php?id=". $donnees[0] . "'>Générer un mot de passe</a>" .
                        "<a class=\"card-link\" href='./account-delete.php?id=". $donnees[0] ."'>Supprimer</a>";
                    if(isset($_GET['pwd']) && isset($_GET['pwdId']) && $_GET['pwdId'] === $donnees[0]){
                        echo "<br><b style=\"color:green\">Nouveau mot de passe: \"1\" </b>";
                    }
                    echo "</div></div></div>";
                }
            }
            $db = null;
        }catch(PDOException $e){}
    }
?>