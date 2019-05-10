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
    <?php $pageTitle="Supprimer: " . $ImageTitle; include "head.php"; ?>   
</head>

<body>
    <div class="overlay">
        <div class="container" style="height: 293px;margin: 80px auto;">
            <div class="row">
                <div class="col" style="margin: 0px 0px;">
                    <div class="card shadow" style="width: 1100px;margin: auto;">
                        <div class="card-body" style="margin: auto;width: 1100px;padding: 40px;">
                            <h4 class="card-title"><?php echo $ImageTitle ?></h4>
                            <hr>
                            <div class="row" style="margin: 15px -15px;  text-align: center;">
                                <?php 
                                if(isset($_GET['id'])) {
                                    echo '<div style="width:100%;height: 600px; line-height: 600px; margin-bottom:20px;">';
                                    echo  '<img style= "max-width:800px; max-height: 600px;" src="./fichiers/' . $_GET['id'] . '.png">';
                                    
                                    echo '</div>';
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