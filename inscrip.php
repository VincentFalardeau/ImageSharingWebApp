<!DOCTYPE html>
<?php include "user-functions.php";?>
<html>
<head>
    <?php $pageTitle="S'inscrire"; include "head.php"; ?>
</head>

<body>
    <div>
        <nav class="navbar navbar-light navbar-expand-md navigation-clean">
            <div class="container">
                <a class="navbar-brand link" href="index.php">Galerie d'images</a>
                <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse"
                    id="navcol-1">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item" role="presentation"></li>
                        <li class="nav-item" role="presentation"></li>
                        <li class="nav-item" role="presentation"><a class="nav-link link" href="login.php">Connexion</a></li>
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
                        <h4 class="card-title">S'inscrire</h4>
                        <hr>
                        <form action="./inscrip.php" method="post">
							<div class="form-group">
								<label class="form-control-label" style="width: 100%;font-size: 16px;">Nom d'utilisateur</label>
								<?php 
									if(isset($_POST['username']) && $_POST['username'] != "") {
                                        echo "<input type=\"text\" class=\"form-control\" name=\"username\" value=\"" . $_POST['username'] . "\">";
                                        if(userNameExists($_POST['username']) !== null){
                                            echo "<strong style=\"color: red;\">Ce nom d'utilisateur existe deja</strong><br>";
                                        }
                                    }
                                    else{
                                        echo "<input type=\"text\" class=\"form-control\" name=\"username\">";
                                    }
                                    if(isset($_POST['username']) && $_POST['username'] == "") {
										echo "<strong style=\"color: red;\">Veuillez entrer un nom d'utilisateur</strong><br>";
									}
									
								?>
							</div>
							<div class="form-group">
								<label class="form-control-label" style="width: 100%;font-size: 16px;">Courriel</label>
								<?php 
									if(isset($_POST['email']) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) !== false){
										echo "<input type=\"email\" class=\"form-control\" name=\"email\" value=\"" . $_POST['email'] . "\">";
									} 
									else{
										echo "<input type=\"email\" class=\"form-control\" name=\"email\">";
									}
									if(isset($_POST['email']) && $_POST['email'] == "") {
										echo "<strong style=\"color: red;\">Veuillez entrer votre courriel</strong><br>";
									}
									else if(isset($_POST['email']) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false){
										echo "<strong style=\"color: red;\">Le courriel est de format invalide</strong><br>";
									}
									
								?>
							</div>
							<div class="row">
								<div class="col">
									<div class="form-group">
										<label class="form-control-label" style="width: 100%;font-size: 16px;">Prénom</label>
										<?php 
											if(isset($_POST['firstname'])) {
												echo "<input type=\"firstname\" class=\"form-control\" name=\"firstname\" value=\"" . $_POST['firstname'] . "\">";
											}
											else{
												echo "<input type=\"text\" class=\"form-control\" name=\"firstname\">";
											}
											if(isset($_POST['firstname']) && $_POST['firstname'] == "") {
												echo "<strong style=\"color: red;\">Veuillez entrer votre prénom</strong><br>";
											}
										?>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label class="form-control-label" style="width: 100%;font-size: 16px;">Nom</label>
										<?php 
											if(isset($_POST['lastname'])) {
												echo "<input type=\"lastname\" class=\"form-control\" name=\"lastname\" value=\"" . $_POST['lastname'] . "\">";
											}
											else{
												echo "<input type=\"text\" class=\"form-control\" name=\"lastname\">";
											}
											if(isset($_POST['lastname']) && $_POST['lastname'] == "") {
												echo "<strong style=\"color: red;\">Veuillez entrer votre nom</strong><br>";
											}
										?>
									</div>
								</div>
							</div>
							<div class="form-group" style="margin: 0px 0px 8px;">
								<hr style="margin: 8px;">
								<label class="form-control-label" style="width: 100%;font-size: 16px;margin: 10px 0px;">
									Mot de passe
								</label>
								<?php 
									if(isset($_POST['password'])) {
										echo "<input type=\"password\" class=\"form-control\" name=\"password\" value=\"" . $_POST['password'] . "\">";
									}
									else{
										echo "<input type=\"password\" class=\"form-control\" name=\"password\">";
									}
									if(isset($_POST['password']) && $_POST['password'] == "") {
										echo "<strong style=\"color: red;\">Veuillez entrer un mot de passe</strong><br>";
									}
								?>
							</div>
							<div class="form-group">
								<label class="form-control-label" style="width: 100%;font-size: 16px;">
									Confirmation du mot de passe
								</label>
								<input type="password" class="form-control" name="passwordconfirmation">
								<?php 
								if(isset($_POST['passwordconfirmation']) && $_POST['passwordconfirmation'] !== $_POST['password']) {
									echo "<strong style=\"color: red;\">La confirmation ne correspond pas au mot de passe</strong><br>";
								}
								?>
							</div>
							<?php
								include "connexion.php";
								if( isset($_POST['username']) && isset($_POST['password']) && isset($_POST['firstname']) && 
									isset($_POST['lastname']) && isset($_POST['email']) && 
									$_POST['username'] !== '' && $_POST['password'] !== '' && $_POST['firstname'] !== '' && 
									$_POST['lastname'] !== '' && $_POST['email'] !== '' && $_POST['passwordconfirmation'] === $_POST['password'] &&
									userNameExists($_POST['username']) === null){

									subscribeUser($_POST['username'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_POST['email']);
									logUser($_POST['username'], $_POST['password']);
								}
							?>
                        <button class="btn btn-primary float-right" type="submit" style="margin: 10px 0px 0px 0px;">
                        S'inscrire
                        </button>
                        </form>
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