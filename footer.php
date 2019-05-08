<div class="footer">
    <br><br>
    <a href="index.php">La galerie d'images</a>
    <br><br>
    <?php
        if(isset($_SESSION['username'])){
            $statement = $db->prepare("select * from Members where idMember = ?");
            $statement->bindParam(1, $_idMember);
            $_idMember = $_SESSION["id"];
            $statement->execute();

            while($donnees = $statement->fetch()){
                $Member = array($donnees[0], $donnees[1], $donnees[2], $donnees[3], $donnees[4], $donnees[5]);
            }
            echo $Member[3] . " " . $Member[4] . " " .
            "<a href=\"profile.php\" style=\"margin-right: 20px; margin-left: 20px;\">Votre profil</a>" . 
            "<a href=\"logout.php\">Déconnexion</a>";
        }
        else{
            echo  "<a href=\"login.php\" style=\"margin-right: 20px;\">Connexion</a>" . 
            "<a href=\"inscrip.php\" style=\"margin-right: 20px;\">S'inscrire</a>";
        }
        
    ?>
    <br><br><br><br>
    Auteurs du site web: Vincent Falardeau, Émile Ménard
    <br><br>
</div>