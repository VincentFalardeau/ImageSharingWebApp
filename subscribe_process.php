<?php 
$location = './login.php';
if(isset($_POST['username']) 
&& isset($_POST['email']) 
&& isset($_POST['firstname']) 
&& isset($_POST['lastname'])
&& isset($_POST['password'])
&& isset($_POST['passwordconfirmation']) ){

    $username= $_POST['username'];
    $password= $_POST['email'];
    $password= $_POST['firstname'];
    $password= $_POST['lastname'];
    $password= $_POST['password'];
    $password= $_POST['passwordconfirmation'];

    try
    {
        include "connexion.php";
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