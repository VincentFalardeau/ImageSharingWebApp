<?php

    function injectGalleryContent($keyword){
        try{
            include "connexion.php";
            $statement = $db->prepare("call getImagesAndInfos()");
            $statement->execute();
            while($donnees = $statement->fetch()){
                if($keyword === "" || (strpos($donnees[2], $keyword) !== false) || (strpos($donnees[3], $keyword) !== false)){
                    echo "<div class=\"col-4\" style=\"margin-bottom:20px;\">" . 
                    "<div class=\"card\">" . 
                    "<div class=\"card-body shadow-sm\" style=\"padding: 10px;height: 400px; text-align:center; background-color: gainsboro;\">" .
                    "<div style=\"width:100%; height: 150px; line-height: 150px; margin-bottom:20px;\">" .
                    "<a href='./gestimage.php?id=". $donnees[0] ."'>".
                    "<img style=\"max-width: 200px; max-height: 150px;\" src='fichiers/" . $donnees[0] . ".png'>" . 
                    "</a>
                    </div>".
                    "<div style=\"width:100%;\">" . $donnees[2] . "</div>" .
                    "<div style=\"width:100%; text-align:left; height: 120px;background-color: white;\">" . $donnees[3] . "</div>" . 
                    "<div style=\"width:100%;\">Auteur: " . $donnees[4] . " (" . explode(" ", $donnees[5])[0] . ")" . "</div>" . 
                    "<div style=\"width:100%;\">";
                    echo getCommentCount($donnees[0]) . " commentaire(s)</div>";
                    if(isset($_SESSION["id"]) && $_SESSION["id"] === $donnees[1]){
                        echo "<a class=\"card-link link\" href='./image-edit.php?id=". $donnees[0] ."'>Modifier</a>";
                        echo "<a class=\"card-link link\" href='./image-delete.php?id=". $donnees[0] ."'>Supprimer</a>";
                    }
                    else if(isset($_SESSION["id"]) && $_SESSION["id"] !== $donnees[1] && $_SESSION["username"] === "admin"){
                        echo "<a class=\"card-link link\" href='./image-delete.php?id=". $donnees[0] ."'>Supprimer</a>";
                    }
                    echo "</div></div></div>";
                }
            }
            $db = null;
        }catch(PDOException $e){}
    }

    function injectComments($id, $ownerName){
        try{
            include "connexion.php";
            $statement = $db->prepare("call getImageComments(?)");
            $statement->bindParam(1, $_id);
            $_id = $id;
            $statement->execute();
            while($donnees_comment = $statement->fetch()){
                $date = strtotime($donnees_comment[4]);
                echo '<div class="card shadow p-2 my-2" id="c-' . $donnees_comment[0] . 
                    '"><div><div class="text-muted">' . date('j F Y', $date) . 
                    '</div><br> <div class="py-2">' . $donnees_comment[3] . 
                    '</div></div><hr><div>' . $donnees_comment[5] . ' ' . $donnees_comment[6]; 

                if(isset($_SESSION['id']) && ($_SESSION['id'] === $donnees_comment[1] || $_SESSION['username'] === $ownerName)) {
                    echo "<form action=\"comment-delete-process.php?idComment=" .  $donnees_comment[0] . "&id=" . $_GET['id'] . "\" method=\"post\">";
                    echo "<input class=\"btn btn-danger\" type=\"submit\" value=\"Supprimer\" style=\"width: 100px; float: right\"></form>";  
                }  
             echo '<br></div></div>';
            }
            $db = null;  
        }catch(PDOException $e){}
        
    }

    function getCommentCount($id){
        $count = null;
        try{
            include "connexion.php";
            $stm = $db->prepare("call getCommentCount(?)");
            $stm->bindParam(1, $_id);
            $_id = $id;
            $stm->execute();
            $count = $stm->fetch();
            $db = null;
        }catch(PDOException $e){}
        return $count[0];
    }

    function getImageInfo($id){
        $img = null;
        try{
            include "connexion.php";
            $statement = $db->prepare("call getImageInfo(?)");
            $statement->bindParam(1, $_id);
            $_id = $id;
            $statement->execute();
            $img = $statement->fetch();
            $db = null;
        }catch(PDOException $e){}
        return $img;
    }
?>