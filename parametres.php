<?php
    include("./includes/header_connexion.php")
?>
<div class="container-fluid bg-1 text-center">
                <button type="button" class="col-md-2 col-md-offset-1 btn btn-primary btn-lg large-button" onclick="location.href='./page_regles.php'">Règles</button>
                <?php if(isConnected() && getPartie($_SESSION["login"]))
				{
				?>
					<button type="button" class="col-md-4 col-md-offset-1 btn btn-primary btn-lg large-button" style="height:80px" onclick="location.href='./partie.php'">Retourner en jeu</button>
				<?php
				}
				else
				{
				?>
					<button type="button" class="col-md-4 col-md-offset-1 btn btn-primary btn-lg large-button" style="height:80px" onclick="location.href='./defier.php'">Défier</button>
				<?php
				}
				?>
                <button type="button" class="col-md-2 col-md-offset-1 btn btn-primary btn-lg large-button" onclick="location.href='./classement.php'">Classement</button>
</div>
<div class="well well-lg identification">
            <h2 class="titre"> Changer de mot de passe : </h2>
            <br/>
            <div class="container">
                <form method="POST" action="parametres.php" class="formulaire">
                    <div class="row">
                        <div class="form-group col-md-4 col-md-offset-4">
                            <label for="mdp">Ancien mot de passe :</label>
                            <input type="password" class="form-control" name="pwd">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4 col-md-offset-4">
                            <label for="mdp">Nouveau mot de passe : </label>
                            <input type="password" class="form-control" name="new_pdw">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4 col-md-offset-4">
                            <label for="mdp">Confirmez le nouveau mot de passe : </label>
                            <input type="password" class="form-control" name="new_pdw2">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary button_form">Confirmer</button>
                </form>
            </div>
</div>
<?php
    include("./includes/footer.php")
?>