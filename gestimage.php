<!DOCTYPE html>
<?php include "user-functions.php"; include "image-functions.php"?>
<html>
<?php session_start();

if(isset($_GET['id'])) {

    $image = getImageInfo($_GET['id']);
    $member = getMemberById($image[0]);

    $title = $image[2];
    $description = $image[4];
    $username = $member[1];
    $firstName = $member[3];
    $lastName = $member[4];
}
?>
<head>
    <?php $pageTitle=$title; include "head.php"; ?>
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
                                if(isset( $_SESSION["username"])){
                                    echo "<a class=\"nav-link\" href=\"profile.php\">" . $_SESSION["username"] . "</a>";
                                }   
                           ?>
                        </li>
                        <?php
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
                        <h4 class="card-title"><?php echo $title ?></h4>
                        <hr>
                        <div class="row" style="margin: 15px -15px; text-align: center;">
                            <?php 
                                if(isset($_GET['id'])) {
                                    echo '<div style="width:100%;height: 600px; line-height: 600px; margin-bottom:20px;">';
                                    echo  '<img style= "max-width:800px; max-height: 600px;" src="./fichiers/' . $_GET['id'] . '.png"></div>';
                                }
                            ?>
                            <div style="width: 50%;height: auto;">
                                <?php 
                                    if(isset($_SESSION['id']) && $_SESSION['username'] === $username){
                                        echo "<div style=\"width: 100%; text-align:center;\">
                                            <a class=\"card-link\" href='./image-delete.php?id=". $_GET['id'] . "'>Supprimer</a>";
                                        echo "<a class=\"card-link\" margin-right: 20px;\" href='./image-edit.php?id=". $_GET['id'] . 
                                            "'>Modifier</a></div><br>";
                                    }
                                ?>
                                <b> Auteur: </b><?php echo $firstName . " " . $lastName ?> <b>alias</b> <?php echo $username ?><br> 
                                <br>
                                <b>Description: </b><?php echo $description ?>
                                <br>
                                <br>
                                 <form <?php echo " action=\"comment-add-process.php?id=" . $_GET['id'] . "\" "?> method="post">   
                                    <?php 
                                        if(isset($_SESSION['id'])) {
                                 
                                            echo '<input type="text" class="form-control" placeholder="Votre commentaire..." name="comment">
                                                <input class="btn btn-primary" type="submit" value="Commenter" 
                                                style="margin: 10px 0px 0px 0px; width: 100%">';                             
                                        }
                                    ?>
                                 </form>
                            </div>
                            <div style="width: 50%;height: auto; float:right;"><b>Commentaires</b>
                                <div id="container-comments">
                                    <?php 
                                        injectComments($_GET['id']);
                                    ?>
                            </div>
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