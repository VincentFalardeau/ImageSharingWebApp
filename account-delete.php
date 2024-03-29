<!DOCTYPE html>
<?php session_start();?>
<html>
<head>
    <?php $pageTitle="Suppression de compte"; include "head.php"; ?>
</head>

<body>
    <div  class="overlay">
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
    

        <div class="container" style="height: 293px;margin: 80px auto;">
            <div class="row">
                <div class="col" style="margin: 0px 0px;">
                    <div class="card shadow" style="width: 1100px;margin: auto;">
                        <div class="card-body" style="margin: auto;width: 1100px;padding: 40px;">
                            <h4 class="card-title">
                                Comptes
                                <form style="width: 350px; height: 40px; float: right; margin-right: 20px;" action="admin.php" method="post">
                                    <?php
                                        if(!isset($_POST["keyword"])){
                                            $_POST["keyword"] = "";
                                        }
                                        echo "<input type=\"text\" class=\"form-control\" name=\"keyword\" value=\"" . $_POST["keyword"] .
                                        "\" style=\"width: 250px; float: left\">"
                                    ?>
                                    <input class="btn btn-primary float-right" type="submit" value="Chercher">
                                </form>
                            </h4>
                            <hr>
                            <div class="row" style="margin: 15px -15px;">
    							<?php
    								include "connexion.php";
    								$statement = $db->prepare("select * from Members where idMember != ?");
                                    $statement->bindParam(1, $_id);
                                    $_id = $_SESSION['id'];
    								$statement->execute();
    								while($donnees = $statement->fetch()){
                                        if($_POST["keyword"] === "" || (strpos($donnees[1], $_POST["keyword"]) !== false) || (strpos($donnees[3], $_POST["keyword"]) !== false) || (strpos($donnees[4], $_POST["keyword"]) !== false)){
        									echo "<div class=\"col-4\" style=\"margin-bottom:20px;\">" . 
                                            "<div class=\"card\">" . 
                                            "<div class=\"card-body shadow-sm\" style=\"padding: 10px;height: 100px; text-align:center; background-color: gainsboro;\">" .
                                            "<div style=\"width:100%;\">" . $donnees[3] . " " . $donnees[4] . " <b>alias</b> " . $donnees[1] . "</div>";
                                            
        									echo "<a class=\"card-link\"href='./pwd-generate.php?id=". $donnees[0] . "'>Générer un mot de passe</a>" .
                                                "<a class=\"card-link\" href='./account-delete.php?id=". $donnees[0] ."'>Supprimer</a>";
        									echo "</div></div></div>";
                                        }
    								}
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean popup">
        <div class="container">
            <span class="navbar-brand white-hover">Êtes-vous certain de vouloir supprimer ce compte?</span>
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
                        <?php echo "<a class=\"nav-link unstyled-link\" href=\"account-delete-process.php?id=" . $_GET['id'] . "\">Oui</a>" ?>
                    </li>
                    <li class="nav-itemt" role="presentation">
                        <a class="nav-link unstyled-link" href="admin.php">Non</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>