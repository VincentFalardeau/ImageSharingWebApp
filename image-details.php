<!DOCTYPE html>
<html>

<?php 
if(isset($_GET['id'])) {

    $ImageTitle = null;
    $ImageDescription = null;
    $ImageUrl = null;
    $MemberAlias = null;
    $MemberFirstname = null;
    $MemberLastname = null;
    include "connexion.php";
    $statement = $db->prepare("select titre, description, url, alias, firstname, lastname from Images I Inner Join Members M ON I.idMember = M.idMember WHERE idImage = ?");

    $statement->bindParam(1, $_GET['id']);

    $statement->execute();
    while($donnees = $statement->fetch()){
        $ImageTitle = $donnees[0];
        $ImageDescription = $donnees[1];
        $ImageUrl = $donnees[2];
        $MemberAlias = $donnees[3];
        $MemberFirstname = $donnees[4];
        $MemberLastname = $donnees[5];
    }
    
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo $ImageTitle ?></title>
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
                            <a class="nav-link" href="profile.html">*Nom d'utilisateur*</a>
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
                        <h4 class="card-title"><?php echo $ImageTitle ?></h4>
                        <hr>
                        <div class="row" style="margin: 15px -15px;">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body shadow-sm" style="padding: 10px;">
                                    <?php 
                                    if(isset($_GET['id'])) {
                                         echo  '<img style="width: 100%;height: 473px;" src="./fichiers/' . $_GET['id'] . '.png">';
                                       
                                        }?>
                                    
                                        <a class="card-link" style="float: right;" href="image-delete.html">Supprimer</a>
                                        <a class="card-link" style="float: right; margin-right: 20px" href="image-edit.html">
                                            Modifier
                                        </a>
                                    </div>
                                </div>
                            </div>
                             <div class="col">
                                <div class="card">
                                    <div class="card-body shadow-sm" style="padding: 10px;">
                                        <div style="width: 100%;height: 150px;"><b>Informations</b><br>
                                            <!--Ici, on genere un string dinfos en php-->
                                            Member username: <?php echo $MemberAlias ?><br>
                                            Member name: <?php echo $MemberFirstname . " " . $MemberLastname ?><br>
                                            <br>
                                            Image description: <br>
                                            <?php echo $ImageDescription ?>


                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body shadow-sm" style="padding: 10px;">
                                        <div style="width: 100%;height: 236.5px;"><b>Commentaires</b>
                                            <div><!--chaque commentaire est generer sous forme dun span suivi dun bouton x et dun br, pour supprimer notre commentaire, on peut appuyer sur le x
                                                on trouvera un systeme pour associer le commentaire au bouton-->
                                                <span>Hey belle photo (12:23_23/4/2019)</span><button>x</button><br>
                                                <span>Superbe! (12:25_23/4/2019)</span><button>x</button><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><input type="text" class="form-control"></div>
                                    <button class="btn btn-primary float-right" type="button" style="margin: 10px 0px 0px 0px;">
                                        <a href="image-details.html" class="unstyled-link">Commenter</a>
                                    </button>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>