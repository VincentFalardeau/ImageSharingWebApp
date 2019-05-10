<!DOCTYPE html>
<?php session_start();?>
<?php include "user-functions.php";?>
<html>
<head>
    <?php $pageTitle=$_SESSION["username"]; include "head.php"; ?>
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
                        <li class="nav-item" role="presentation"></li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="profile-delete.php">Supprimer mon compte</a>
                        </li>
						<li class="nav-item" role="presentation">
                            <a class="nav-link" href="logout.php">Déconnexion</a>
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
                            if(isset($_POST["email"]) && $_POST["email"] !== ""){
                                if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) !== false){
                                    updateEmail($_SESSION['id'], $_POST["email"]);
                                    echo "<strong style=\"color: green;\">Courriel changé avec succès</strong><br><br>";
                                }
                                else{
                                    echo "<strong style=\"color: red;\">Le courriel est de format invalide</strong><br><br>";
                                }
                            }
							if(isset($_POST["password"]) && $_POST["password"] !== ""){
								if($_POST["password"] !== $_POST["confirm-password"]){
									echo "<strong style=\"color: red;\">La confirmation ne correspond pas au mot de passe</strong><br><br>";
								}
								else{
                                    updatePassword($_SESSION['id'], $_POST["password"]);
                                    echo "<strong style=\"color: green;\">Mot de passe changé avec succès</strong><br><br>";
                                }
                            }

                            $member = getMemberById($_SESSION["id"]);
                        ?>
                        <h4 class="card-title">
                            <?php echo $member[3] . " " . $member[4] ;?>
                        </h4>
                        <hr>
                        <div class="row" style="margin: 15px -15px;">
                            Courriel<br>
                            <form style="border: solid 1px lightgrey; padding: 10px;"  action="profile.php" method="post">
                                <?php echo $member[5]?><br><br>
                                <input type="text" class="form-control" name="email" style="width: 250px; float: left; margin-right: 15px;">
                                <input class="btn btn-primary float-right" type="submit" value="Modifier">
                            </form>
                        </div>
                        <div class="row" style="margin: 15px -15px;">
                            Mot de passe<br>
                            <form  style="border: solid 1px lightgrey; padding: 10px;"  action="profile.php" method="post">
                                <input type="password" class="form-control" name="password" 
                                style="width: 250px; float: left; margin-right: 15px;" placeholder="Nouveau mot de passe">
                                <input type="password" class="form-control" name="confirm-password" 
                                style="width: 250px; float: left; margin-right: 15px;"placeholder="Confirmation">
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