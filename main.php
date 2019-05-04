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
    <title>Galerie</title>
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
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="profile.php">
							    <?php
								    echo $_SESSION["username"];
							    ?>
							</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container" style="height: 293px;margin: 80px auto;">
        <div class="row">
            <div class="col" style="margin: 0px 0px;">
                <div class="card shadow" style="width: 1100px;margin: auto;">
                    <div class="card-body" style="margin: auto;width: 1100px;padding: 40px;">
                        <h4 class="card-title">
                            Galerie
                            <button class="btn btn-primary float-right" type="button">
                                <a class="unstyled-link" href="image-add.html">Ajouter une image</a>
                            </button>
                            <form style="width: 350px; height: 40px; float: right; margin-right: 20px;" action="main.php" method="post">
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
								$statement = $db->prepare("select idImage, idMember, titre, description from Images");
								$statement->execute();
								while($donnees = $statement->fetch()){
                                    if($_POST["keyword"] === "" || (strpos($donnees[2], $_POST["keyword"]) !== false) || (strpos($donnees[3], $_POST["keyword"]) !== false)){
    									echo "<div class=\"col-4\">" . "<div class=\"card mt-2\">" . "<div class=\"card-body shadow-sm\" style=\"padding: 10px;\">" .
    									"<img style=\"width: 298px;height: 298px;\">" . 
    									"<a class=\"card-link\" href=\"image-details.html\">" . $donnees[2] . "</a>";
    									 if(isset($_SESSION["id"]) && (string)$_SESSION["id"] == (string)$donnees[1]){
    										echo "<a class=\"card-link\" style=\"float: right;\" href=\"image-delete.html\">Supprimer</a>" .
                                            "<a class=\"card-link\" style=\"float: right;\" href=\"image-edit.html\">Modifier</a>";
    									} 
                                        echo "<div>" . $donnees[3] . "</div>";
    									echo "</div></div></div>";
                                    }
								}
                            ?>
                          
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>