<!DOCTYPE html>
<html>
<?php 
    session_start();

    if(isset($_GET['id'])) {
        include "connexion.php";
        $statement = $db->prepare("select titre from Images WHERE idImage = ?");
        $statement->bindParam(1, $_SESSION['img-id']);
        $statement->execute();
        $ImageTitle = $statement->fetch();
    }
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo "Supprimer " . $ImageTitle ?></title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="background-color: rgb(244,245,247);">
    <div class="overlay">
        <div class="container" style="height: 293px;margin: 80px auto;">
            <div class="row">
                <div class="col" style="margin: 0px 0px;">
                    <div class="card shadow" style="width: 1100px;margin: auto;">
                        <div class="card-body" style="margin: auto;width: 1100px;padding: 40px;">
                            <h4 class="card-title"><?php echo $ImageTitle ?></h4>
                            <hr>
                            <div class="row" style="margin: 15px -15px;">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body shadow-sm" style="padding: 10px;">
                                        <?php 
                                            if(isset($_GET['id'])) {
                                                echo  '<img style="width: 100%;" src="./fichiers/' . $_GET['id'] . '.png">';
                                            }?>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col">
                                    <div class="card">
                                        <div class="card-body shadow-sm" style="padding: 10px;">
                                            <div style="width: 100%;height: 150px;"></div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body shadow-sm" style="padding: 10px;">
                                            <div style="width: 100%;height: 236.5px;"></div>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean popup">
        <div class="container">
            <span class="navbar-brand white-hover">Êtes-vous certain de vouloir supprimer cette image?</span>
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
                        <?php echo "<a class=\"nav-link unstyled-link\" href=\"image-delete-process.php?id=" . $_GET['id'] . "\">Oui</a>" ?>
                    </li>
                    <li class="nav-item" role="presentation">
                        <?php echo "<a class=\"nav-link unstyled-link\" href=\"gestimage.php?id=" . $_GET['id'] . "\">Non</a>" ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>