<!DOCTYPE html>

<?php
    // initialisation de la session
    session_start();
    $_SESSION["username"] = "Vincent";
    $_SESSION["id"] = 2;
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo $_SESSION["username"];?></title>
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
                <a class="navbar-brand" href="main.php">Galerie d'images</a>
                <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse"
                    id="navcol-1">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item" role="presentation"></li>
                        <li class="nav-item" role="presentation"></li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="profile-delete.html">Supprimer mon compte</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container" style="height: 10px;margin-top: 20px;margin-bottom: -60px; text-align: center;">
       
    </div>
    <div class="container" style="height: 293px;margin: 100px auto;">
        <div class="row">
            <div class="col" style="margin: 0px 0px;">
                <div class="card shadow" style="width: 420px;margin: auto;">
                    <div class="card-body" style="margin: auto;width: 425px;padding: 40px; text-align: center;">
                        <?php
                            include "connexion.php";
                            if(isset($_POST["email"])){
                                if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) !== false){
                                    $statement = $db->prepare("update Members set email = ? where idMember = ?");
                                    $statement->bindParam(1, $_email);
                                    $statement->bindParam(2, $_idMember);
                                    $_email = $_POST["email"];
                                    $_idMember = $_SESSION["id"];
                                    $statement->execute();
                                }
                                else{
                                    echo "<strong style=\"color: red;\">Le courriel est de format invalide</strong><br><br>";
                                }
                            }

                            $statement = $db->prepare("select * from Members where idMember = ?");
                            $statement->bindParam(1, $_idMember);
                            $_idMember = $_SESSION["id"];
                            $statement->execute();

                            while($donnees = $statement->fetch()){
                                $Member = array($donnees[0], $donnees[1], $donnees[2], $donnees[3], $donnees[4], $donnees[5]);
                            }
                        ?>
                        <h4 class="card-title">
                            <?php echo $Member[3] . " " . $Member[4] ;?>
                        </h4>
                        <hr>
                        <div class="row" style="margin: 15px -15px;">
                            Courriel<br>
                            <form style="border: solid 1px lightgrey; padding: 10px;"  action="profile.php" method="post">
                                <?php echo $Member[5] . "<br>";?><br>
                                <input type="text" class="form-control" name="email" style="width: 250px; float: left; margin-right: 15px;">
                                <input class="btn btn-primary float-right" type="submit" value="Modifier">
                            </form>
                        </div>
                        <div class="row" style="margin: 15px -15px;">
                            Mot de passe<br>
                            <form  style="border: solid 1px lightgrey; padding: 10px;"  action="profile.php" method="post">
                                <input type="text" class="form-control" name="password" style="width: 250px; float: left; margin-right: 15px;" placeholder="Nouveau mot de passe">

                                <input type="text" class="form-control" name="confirm-password" style="width: 250px; float: left; margin-right: 15px;"placeholder="Confirmation">
                                <input class="btn btn-primary float-right" type="submit" value="Modifier">
                            </form>
                        </div>
                        <!-- <div class="row" style="margin: 15px -15px;">
                            <div class="form-group">
                                <label class="form-control-label" style="width: 100%;font-size: 16px;">Courriel</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row" style="margin: 15px -15px;">

                        </div>
                        <div class="row" style="margin: 15px -15px;">
                             <div class="form-group" style="margin: 0px 0px 8px;">
                                <hr style="margin: 8px;">
                                <label class="form-control-label" style="width: 100%;font-size: 16px;margin: 10px 0px;">
                                Nouveau mot de passe
                                </label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" style="width: 100%;font-size: 16px;">
                                Confirmation du nouveau mot de passe
                                </label>
                                <input type="text" class="form-control">
                            </div>
                        </div> -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>