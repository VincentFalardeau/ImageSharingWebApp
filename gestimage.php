<!DOCTYPE html>
<html>

<style>
.img-holder {
  width: 473px;
  height: 473px;
  position: relative;
  overflow: hidden;
  background-color: black;
}
.img-holder img {
width: 100%;
}
</style>

<?php 
session_start();

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
                                        echo '<div class="img-holder">';
                                         echo  '<img src="./fichiers/' . $_GET['id'] . '.png">';
                                        echo '</div>';
                                        if(isset($_SESSION['id']) && $_SESSION['username'] === $MemberAlias){
                                            echo "<a class=\"card-link\" style=\"float: right;\" href='./image-delete.php?id=". $_GET['id'] . "'>Supprimer</a>";
                                            echo "<a class=\"card-link\" style=\"float: right; margin-right: 20px;\" href='./image-edit.php?id=". $_GET['id'] . "'>Modifier</a>";
                                        }
                                    }?>
                                    </div>
                                </div>
                              
                            </div >
                            
                             <div class="col">
                                <div class="card">
                                    <div class="card-body shadow-sm" style="padding: 10px;">
                                        <div style="width: 100%;height: auto;"><h4>Informations</h4>
                                            <!--Ici, on genere un string dinfos en php-->
                                            <b> Member username: </b><br> <?php echo $MemberAlias ?><br>
                                            <b> Member name: </b><br> <?php echo $MemberFirstname . " " . $MemberLastname ?><br>
                                            <br>
                                            <b>Image description: </b> <br>
                                            <?php echo $ImageDescription ?>


                                        </div>
                                    </div>
                                </div>
                               <br>
                                <div class="card">
                                    <div class="card-body shadow-sm" style="padding: 10px;">
                                        <div style="width: 100%;height: auto"><b>Commentaires</b>
                                            <div id="container-comments"><!--chaque commentaire est generer sous forme dun span suivi dun bouton x et dun br, pour supprimer notre commentaire, on peut appuyer sur le x
                                                on trouvera un systeme pour associer le commentaire au bouton-->
                                               
                                               <?php 
                                                    include "connexion.php";
                                                    $statement_comment = $db->prepare("select idComment, C.idMember, idImage, description, date, firstName, lastName from Comments C INNER JOIN Members M ON C.idMember = M.idMember WHERE idImage = ? ORDER BY date DESC");
                                                    $statement_comment->bindParam(1, $_GET['id']);
                                                    $statement_comment->execute();
                                                    while($donnees_comment = $statement_comment->fetch()){
                                                        $date = strtotime($donnees_comment[4]);

                                                        echo '<div class="card car-body shadow p-2 my-2" id="c-' . $donnees_comment[0] . '"><span><span class="text-muted">' . date('j F Y', $date) . '</span><br> <div class="py-2">' . $donnees_comment[3] . '</div></span><hr><div>' . $donnees_comment[5] . ' ' . $donnees_comment[6]; 
 
                                                        if(isset($_SESSION['id']) && $_SESSION['id'] == $donnees_comment[1]) {
                                                            echo '<button class="btn btn-danger" style="width: 80px; float: right" onclick="deleteComment(' . $donnees_comment[0] . ')" > <span style="color: white">delete</span></button><br></div></div>';
                                                        }else{
                                                            echo '<br></div></div>';
                                                  
                                                        }

                                                    }
        
                                               ?>
                                        
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <br>
                            <?php if(isset($_SESSION['id'])) {
                                 
                                 echo ' <div class="form-group"><input type="text" class="form-control" placeholder="Your comment.." id="newcomment"></div>
                                 <button class="btn btn-primary float-right" type="button" style="margin: 10px 0px 0px 0px; width: 100%" onclick="addNewComment()">
                                    Add comment
                                 </button>';                             
                                 }?>
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

<script>


deleteComment = function(id) {
    if(id != null && id != undefined) {
        $.post( "comment-delete-process.php", { commentid: id})
        .done(function( data ) {
            $('#c-' + id).remove();           
        });
    }
}

addNewComment = function() {

    var new_comment = $('#newcomment').val();
    
    if(new_comment != "" && new_comment != undefined) {
        $.post( "comment-add-process.php", { comment: new_comment, image: <?php echo $_GET['id']?> })
        .done(function( data ) {
            var container = $('#container-comments');
            container.prepend('<div class="card car-body shadow p-2 my-2"><span id="' + data + '"><span class="text-muted"> <?php echo date('j F Y', time()) ?> </span><br> <div class="py-2">' + new_comment + '</div></span><hr><div> <?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] ?> <button class="btn btn-danger" style="width: 80px; float: right" onclick="deleteComment(' + data + ')"> <span style="color: white">delete</span></button><br></div></div>');
           
        });
    }
 
}


</script>