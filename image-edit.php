<!DOCTYPE html>
<html>
<?php 
session_start();

include "connexion.php";

if(isset($_GET['id'])) {
    include "connexion.php";
    $statement = $db->prepare("select titre, description from Images WHERE idImage = ?");
    $statement->bindParam(1, $_GET['id']);
    $statement->execute();
    while($donnees = $statement->fetch()){
        $imgTitle = $donnees[0];
        $imgDescription = $donnees[1];
    }
    
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo "Modification de: " . $imgTitle; ?></title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="background-color: rgb(244,245,247);">
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
    <div class="container" style="height: 293px;margin: 100px auto;">
        <div class="row">
            <div class="col" style="margin: 0px 0px;">
                <div class="card shadow" style="width: 420px;margin: auto;">
                    <div class="card-body" style="margin: auto;width: 425px;padding: 40px; text-align: center;">
                        <h4 class="card-title">
                            <?php
                                if(isset($_GET["titre"])){
                                    echo "<strong style=\"color: green;\">Titre changé avec succès</strong><br><br>";
                                }
                                if(isset($_GET["description"])){
                                    echo "<strong style=\"color: green;\">Description changée avec succès</strong><br><br>";
                                }
                                echo  $imgTitle . "<br>"."<br>";
                                echo "<img style=\"width: 298px;height: 298px;\" src='fichiers/" . $_GET['id'] . ".png'  >";
                            ?>
                        </h4>
                        <hr>
                        <div class="row" style="margin: 15px -15px;">
                            Titre<br>
                            <form style="border: solid 1px lightgrey; padding: 10px;"  <?php echo " action=\"image-edit-title-process.php?id=" . $_GET['id'] . "\" "?> method="post">
                                <?php echo $imgTitle . "<br>";?><br>
                                <input type="text" class="form-control" name="titre" style="width: 250px; float: left; margin-right: 15px;">
                                <input class="btn btn-primary float-right" type="submit" value="Modifier">
                            </form>
                        </div>
                        <div class="row" style="margin: 15px -15px;">
                            Description<br>
                            <form  style="border: solid 1px lightgrey; padding: 10px;" <?php echo " action=\"image-edit-desc-process.php?id=" . $_GET['id'] . "\" "?> method="post">
                                <?php echo $imgDescription . "<br>";?><br>
                                <textarea type="text" class="form-control" name="description"></textarea><br>
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