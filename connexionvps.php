<!DOCTYPE html>

<html>

    <head>

        <title>Notre première instruction a VPS: echo</title>

        <meta charset="utf-8" />

    </head>

    <body>

        <h2>Affichage de texte avec PHP VPS</h2>

        

        <p>

           connexion a la bd.<br />
</p>
  <?php
try
{
	$bdd = new PDO('mysql:host=167.114.152.54;dbname=dbequipe14;charset=utf8', 'equipe14', '7klm98u8');
    echo('connexion reussie');
   }
 
   catch (PDOException $e)
{
       echo('Erreur de connexion: ' . $e->getMessage());
       
       exit();
        
} 
  
$bdd=null;
?>
            

        

    </body>

</html>