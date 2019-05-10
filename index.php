<!DOCTYPE html>
<?php session_start(); ?>
<?php include "user-functions.php"; include "image-functions.php"?>
<html>
<head>
    <?php $pageTitle="Galerie"; include "head.php"; ?>
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
								if(isset($_SESSION["username"])){
									echo "<a class=\"nav-link\" href=\"profile.php\">" . $_SESSION["username"] . "</a>";
								}
								else{
									echo "<a class=\"nav-link\" href=\"login.php\">" . "Connexion" . "</a>";
								}		    
							?>
                        </li>
						<?php
                            if(isset( $_SESSION["username"]) && $_SESSION['username'] === "admin"){
                                echo "<li class=\"nav-item\" role=\"presentation\"><a class=\"nav-link\" href=\"admin.php\">Admin</a></li>";
                            }
						    if(isset( $_SESSION["username"])){
							echo "<li class=\"nav-item\" role=\"presentation\"><a class=\"nav-link\" href=\"logout.php\">Déconnexion</a></li>";
						    }
						?>
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
                            <form style="width: 350px; height: 40px; float: right; margin-right: 20px;" action="index.php" method="post">
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
							<?php injectGalleryContent($_POST['keyword']);?>
                            <?php  if(isset($_SESSION["id"])) : ?>
                                <div class="col-4">
                                    <div class="card">
                                        <div class="card-body shadow-sm" style="height: 400px; background-color: gainsboro;">
                                            <div style="text-align: center;"><strong>Ajouter une image</strong></div>
                                        <form action="./image_upload.php" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label >Titre</label>
                                                <input type="text" class="form-control" name="ImageTitle"></br>
                                                <input type="file" class="form-control-file" name="ImageFile"></br>
                                                <div class="form-group">
                                                <label >Description</label></br>
                                                    <textarea class="form-control" row=3 name="ImageDescription"></textarea>
                                                </div>
                                                <button class="btn btn-primary btn-small float-right" type="submit">Ajouter</button>
                                            </div>
                                    </div>
                                </div>
                            <?php endif;?> 
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