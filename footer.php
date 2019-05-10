<div class="footer">
    <br><br>
    <a href="index.php">La galerie d'images</a>
    <br><br>
    <?php
        if(isset($_SESSION['id'])){
            echo $_SESSION['firstName'] . " " . $_SESSION['lastName'] . " " .
            "<a href=\"profile.php\" style=\"margin-right: 20px; margin-left: 20px;\">Votre profil</a>";
            
            if($_SESSION['username'] === "admin"){
                echo "<a href=\"admin.php\" style=\"margin-right: 20px;\">Admin</a>";
            }
            echo "<a href=\"logout.php\">Déconnexion</a>";
        }
        else{
            echo  "<a href=\"login.php\" style=\"margin-right: 20px;\">Connexion</a>" . "<a href=\"inscrip.php\">S'inscrire</a>";
        }
        
    ?>
    <br><br><br><br>
    Auteurs du site web: Vincent Falardeau, Émile Ménard
    <br><br>
</div>