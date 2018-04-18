<?php
    include("./includes/header_connexion.php")
?>
<div class="container-fluid bg-1 text-center">
            <div class="row">
                <button type="button" class="col-md-2 col-md-offset-1 btn btn-primary btn-lg large-button" active onclick="location.href='./page_regles.php'">Règles</button>
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
</div>
<?php
    include("./includes/regles.php")
?>
<?php
    include("./includes/footer.php")
?>