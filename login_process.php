<?php 
$location = './login.php';
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password= $_POST['password'];
   
    try
    {

        // À Remplacer
	    $bd = new PDO('mysql:host=167.114.152.54;dbname=dbequipe14;charset=utf8', 'equipe14', '7klm98u8');
        //
       
        $erreur = 0;
        
        $stm = $bd->prepare("CALL Authentification(?, ?)");

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
            echo "Connection reussi";
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