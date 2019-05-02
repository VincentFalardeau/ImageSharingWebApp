<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Connexion</title>
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
                        <li class="nav-item" role="presentation"></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="inscrip.php">S'inscrire</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
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
                                <input type="text" class="form-control" name="username">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" style="width: 100%;font-size: 16px;">Mot de passe</label>
                                <input class="form-control" name="password" type="password">
                            </div>
							<?php
								include "connexion.php";
								if(isset($_POST['username']) && isset($_POST['password'])){
									include "connexion.php";
									$stm = $db->prepare("select idMember from Members where alias = ? and password = ?");
									$stm->bindParam(1, $param_username);
									$stm->bindParam(2, $param_password);
									$param_username=$_POST['username'];
									$param_password=$_POST['password'];
									$stm->execute();
									$id = $stm->fetch();
									if($id[0] !== null){
										session_start();
										$_SESSION['username'] = $_POST['username'];
										$_SESSION['id'] = $id[0];
										$location = "index.php";
										header('Location: ' . $location);
										echo $id[0];
									} 
									else{
										echo "<br><strong style=\"color: red;\">Nom d'utilisateur et/ou mot de passe invalide</strong><br>";
									}
								}
							?>
                            <button class="btn btn-primary float-right" style="margin: 10px 0px 0px 0px;" type="submit">
                                Se connecter
                            </button>
                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>