<?php
    include("./includes/header_connexion.php");
    $joueur=getPlayer($_GET['joueur']);
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
<div class="container-fluid bg-2 text-center">
    <div class="well well-lg overflow">
        <div class="well well-sm col-md-4 col-md-offset-4">
            <h3 class="margin text-center login"> <span class="glyphicon glyphicon-user"> <?php echo($_GET['joueur']) ?> </h3>
        </div>
        </br>
        </br>
        </br>
        <h3 class="margin text-center"> Incrit depuis le <?php echo($joueur['date']) ?> </h3>
        </br>
        <div class="well well-md col-md-8 col-md-offset-2">
            <h3 class="col-md-offset-1"> <strong>Score :</strong> <?php echo($joueur['score']) ?> points </h3>
            <h3 class="col-md-offset-1"> <strong>Classement :  </strong><?php echo(getRank($_GET['joueur'])) ?></h3>
        </div>
        </br>
        </br>
        </br>
        </br>
        </br>
        <button type="button" class="col-md-8 col-md-offset-2 btn btn-primary btn-lg large-button" onclick="location.href='./historique.php?joueur=<?php echo urlencode($_GET['joueur']); ?>'">Afficher l'historique des parties</button>
        </br>
        </br>
        </br>
        <div class="well well-md col-md-8 col-md-offset-2">
            <h3 class="margin text-center"> <strong>Statistiques :</strong></h3>
            <h4 class="margin"> <?php echo($joueur['victoires']+$joueur['defaites']+$joueur['egalites']) ?> <strong>parties jouées</strong></h2>
            <h4 class="margin"> <?php echo($joueur['victoires']) ?> <strong>parties gagnées</strong></h4>
            <h4 class="margin"> <?php echo($joueur['defaites']) ?> <strong>parties perdues</strong></h4>
            <h4 class="margin"> <?php echo($joueur['egalites']) ?> <strong>égalités</strong></h4>
        </div>
        </br>
        </br>
        </br>
    </div>
    </br>
</div>
</br>
<?php
    include("./includes/footer.php")
?>