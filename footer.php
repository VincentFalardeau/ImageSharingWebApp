<div class="footer">
    <br><br>
    <a class="link" href="index.php">La galerie d'images</a>
    <br><br>
    <?php
        if(isset($_SESSION['id'])){
            echo $_SESSION['firstName'] . " " . $_SESSION['lastName'] . " " .
            "<a class=\"link\" href=\"profile.php\" style=\"margin-right: 20px; margin-left: 20px;\">Votre profil</a>";
            
            if($_SESSION['username'] === "admin"){
                echo "<a class=\"link\" href=\"admin.php\" style=\"margin-right: 20px;\">Admin</a>";
            }
            echo "<a class=\"link\" href=\"logout.php\">Déconnexion</a>";
        }
        else{
            echo  "<a class=\"link\" href=\"login.php\" style=\"margin-right: 20px;\">Connexion</a>" . "<a class=\"link\" href=\"inscrip.php\">S'inscrire</a>";
        }
        
    ?>
    <br><br><br><br>
    Auteurs du site web: Vincent Falardeau, Émile Ménard
    <br><br>
</div>