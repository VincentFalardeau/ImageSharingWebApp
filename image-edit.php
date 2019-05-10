<!DOCTYPE html>
<html>
<?php 
session_start();
include "connexion.php";

if(isset($_GET['id'])) {
    $statement = $db->prepare("select titre, description from Images WHERE idImage = ?");
    $statement->bindParam(1, $_GET['id']);
    $statement->execute();
    while($donnees = $statement->fetch()){
        $titre = $donnees[0];
        $description = $donnees[1];
    }
}
?>

<head>
    <?php $pageTitle=$titre; include "head.php"; ?>   
</head>
<body>
    <div>
        <nav class="navbar navbar-light navbar-expand-md navigation-clean">
            <div class="container">
                <a class="navbar-brand" href="index.php">Galerie d'images</a>
                <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon"></span>
                </button>
                 <div class="collapse navbar-collapse"
                    id="navcol-1">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item" role="presentation"></li>
                        <li class="nav-item" role="presentation">
                                <?php
                                if(isset( $_SESSION["username"])){
                                    echo "<a class=\"nav-link\" href=\"profile.php\">" . $_SESSION["username"] . "</a>";
                                }
                                else{echo "<a class=\"nav-link\" href=\"login.php\">" . "Connexion" . "</a>";} ?>
                        </li>
                        <?php
                        if(isset( $_SESSION["username"])){
                            echo "<li class=\"nav-item\" role=\"presentation\"><a class=\"nav-link\" href=\"logout.php\">Déconnexion</a></li>";
                        }?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container" style="height: 293px;margin: 50px auto;">
        <div class="row">
            <div class="col" style="margin: 0px 0px;">
                <div class="card shadow" style="width: 420px;margin: auto;">
                    <div class="card-body" style="margin: auto;width: 425px;padding: 40px; background-color: gainsboro;">
                        <?php
                            echo "<div style=\"width: 100%;height: 298px; text-align:center; line-height: 298px;\">" .
                            "<img style=\"max-width: 298px;max-height: 298px;\" src='fichiers/" . $_GET['id'] . ".png'  ></div>";
                        ?>
                        <div class="row" style="margin: 15px -15px;">
                            <?php 
                            if(isset($_GET["titre"])){
                                echo "<div style=\"color: green; text-align: center; width:100%;\">Informations modifiées avec succès</div><br><br>";
                            }?>
                            <form style="border: solid 1px lightgrey; padding: 10px; width: 100%;"  <?php echo " action=\"image-edit-process.php?id=" . $_GET['id'] . "\" "?> method="post">
                                Titre <input type="text" class="form-control" name="titre"
                                <?php echo " value=\"" . $titre . "\""?>><br>
                                Description<textarea type="text" class="form-control" name="description" style=""><?php echo $description ?></textarea><br>
                                <input class="btn btn-primary float-right" type="submit" value="Modifier">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "footer.php";?>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>