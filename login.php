<!DOCTYPE html>
<?php include "user-functions.php";?>
<html>
<head>
    <?php $pageTitle="Connexion"; include "head.php"; ?>    
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean">
        <div class="container">
            <a class="navbar-brand" href="index.php">Galerie d'images</a>
            <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"></li>
                    <li class="nav-item" role="presentation"></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="inscrip.php">S'inscrire</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" style="height: 293px;margin: 200px auto;">
        <div class="row">
            <div class="col" style="margin: 0px 0px;">
                <div class="card shadow" style="width: 420px;margin: auto;">
                    <div class="card-body" style="margin: auto;width: 425px;padding: 40px;">
                        <h4 class="card-title">Connexion</h4>
                        <hr>
                        <form action="./login.php" method="post">
                            <div class="form-group">
                                <label class="form-control-label" style="width: 100%;font-size: 16px;">Nom d'utilisateur</label>
                                <?php 
                                    if(isset($_POST['username']) && $_POST['username'] != "") {
                                        echo "<input type=\"text\" class=\"form-control\" name=\"username\" value=\"" . $_POST['username'] . "\">";
                                        if(userNameExists($_POST['username']) === null){
                                            echo "<strong style=\"color: red;\">Utilisateur inexistant</strong><br>";
                                        }
                                    }
                                    else{
                                        echo "<input type=\"text\" class=\"form-control\" name=\"username\">";
                                    }
                                ?>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" style="width: 100%;font-size: 16px;">Mot de passe</label>
                                <input class="form-control" name="password" type="password">
                                <?php
                                    if(isset($_POST['username']) && isset($_POST['password'])){
                                        logUser($_POST['username'], $_POST['password']);
                                    }
                                    if(isset($_POST['username']) && userNameExists($_POST['username']) !== null){
                                        echo "<strong style=\"color: red;\">Mot de passe invalide</strong><br>";
                                    }
                                ?>
                            </div>
                            <button class="btn btn-primary float-right" style="margin: 10px 0px 0px 0px;" type="submit">Se connecter</button>
                        </form>
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