<!DOCTYPE html>
<?php
	// initialisation de la session
	session_start();
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Ajouter une image</title>
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
                <a class="navbar-brand" href="main.html">Galerie d'images</a>
                <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse"
                    id="navcol-1">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item" role="presentation"></li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="profile.html"><? $_SESSION['username'] ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container" style="height: 293px;margin: 100px auto;">
        <div class="row">
            <div class="col" style="margin: 0px 0px;">
                <div class="card shadow" style="width: 420px;margin: auto;">
                    <div class="card-body" style="margin: auto;width: 425px;padding: 40px;">
                        <form >

                            <div class="form-group">
                                <label class="form-control-label" style="width: 100%;font-size: 16px;">Titre</label>
                                <input type="text" class="form-control" name="ImageTitle">
                            </div>
                            <div class="card">
                                <div class="card-body shadow-sm" style="padding: 10px;">
                                    <img style="width: 100%;height: 298px;" >
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label class="form-control-label" style="width: 100%;font-size: 16px;">Description</label>
                                <textarea type="text" class="form-control" name="ImageDescription"></textarea>
                            </div>
                        
                            <button class="btn btn-primary float-right" type="button" style="margin: 10px 0px 0px 0px;">
                                <a href="main.html" class="unstyled-link">Ajouter l'image</a>
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