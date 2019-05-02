<?php 
$location = './login.php';
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password= $_POST['password'];
   
    try
    {
	    include "connexion.php";
        $erreur = 0;		
		
        $stm = $db->prepare("CALL Authentification(?, ?)");

        $stm->bindParam(1, $param_username);
        $stm->bindParam(2, $param_password);

        $param_username=$username;
        $param_password=$password;

        $reussi = $stm->execute();
        $total = $stm->fetch();
        
        if($total[0] == 0) {
            header('Location: '.$location . '?error=true');
        }else{
            session_start();
            $_SESSION['username'] = $username;
			$_SESSION['id'] = $total[0];
			
			$location = "index.php";
			header('Location: '.$location);
        }
    }
 
    catch (PDOException $e)
    {
       echo('Erreur de connexion: ' . $e->getMessage());
       exit();
    } 
  



}else {
    header('Location: '.$location);
}

?>