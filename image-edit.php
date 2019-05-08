<!DOCTYPE html>
<html>
<?php 
session_start();

include "connexion.php";
if(isset($_POST["titre"]) && $_POST["titre"] !== ""){
    $statement = $db->prepare("update Images set titre = ? where idMember = ?");
    $statement->bindParam(1, $_titre);
    $statement->bindParam(2, $_idMember);
    $_titre = $_POST["titre"];
    $_idMember = $_SESSION["id"];
    $statement->execute();
}

if(isset($_POST["description"]) && $_POST["description"] !== ""){
    $statement = $db->prepare("update Images set description = ? where idMember = ?");
    $statement->bindParam(1, $_description);
    $statement->bindParam(2, $_idMember);
    $_description = $_POST["description"];
    $_idMember = $_SESSION["id"];
    $statement->execute();
}

if(isset($_GET['id']) || isset($_SESSION['image-id'])) {

    if(isset($_GET['id'])){
        $_SESSION['image-id'] = $_GET['id'];
    }
    else{
        $_GET['id'] = $_SESSION['image-id'];
    }

    $ImageTitle = null;
    $ImageDescription = null;
    $ImageUrl = null;
    $MemberAlias = null;
    $MemberFirstname = null;
    $MemberLastname = null;
    include "connexion.php";
    $statement = $db->prepare("select titre, description, url, alias, firstname, lastname from Images I Inner Join Members M ON I.idMember = M.idMember WHERE idImage = ?");


    $statement->bindParam(1, $_GET['id']);

    $statement->execute();
    while($donnees = $statement->fetch()){
        $ImageTitle = $donnees[0];
        $ImageDescription = $donnees[1];
        $ImageUrl = $donnees[2];
        $MemberAlias = $donnees[3];
        $MemberFirstname = $donnees[4];
        $MemberLastname = $donnees[5];
    }
    
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo "Modification de: " . $ImageTitle; ?></title>
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
                                    echo "<a class=\"nav-link\" href=\"profile.php\">";
                                    echo $_SESSION["username"] . "</a>";
                                }
                                else{
                                    echo "<a class=\"nav-link\" href=\"login.php\">";
                                    echo "Connexion" . "</a>";
                                }
                                    
                                ?>
                        </li>
                        <?php
                        if(isset( $_SESSION["username"])){
                            echo "<li class=\"nav-item\" role=\"presentation\">
                                    <a class=\"nav-link\" href=\"logout.php\">Déconnexion</a>
                                    </li>";
                        }

                        ?>
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
                                if(isset($_POST["titre"]) && $_POST["titre"] !== ""){
                                    echo "<strong style=\"color: green;\">Titre changé avec succès</strong><br><br>";
                                }
                                if(isset($_POST["description"]) && $_POST["description"] !== ""){
                                    echo "<strong style=\"color: green;\">Description changée avec succès</strong><br><br>";
                                }
                                echo  $ImageTitle . "<br>"."<br>";
                                echo "<img style=\"width: 298px;height: 298px;\" src='fichiers/" . $_GET['id'] . ".png'  >";
                            ?>
                        </h4>
                        <hr>
                        <div class="row" style="margin: 15px -15px;">
                            Titre<br>
                            <form style="border: solid 1px lightgrey; padding: 10px;"  action="image-edit.php" method="post">
                                <?php echo $ImageTitle . "<br>";?><br>
                                <input type="text" class="form-control" name="titre" style="width: 250px; float: left; margin-right: 15px;">
                                <input class="btn btn-primary float-right" type="submit" value="Modifier">
                            </form>
                        </div>
                        <div class="row" style="margin: 15px -15px;">
                            Description<br>
                            <form  style="border: solid 1px lightgrey; padding: 10px; width: 100%;"  action="image-edit.php" method="post">
                                <?php echo $ImageDescription . "<br>";?><br>
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