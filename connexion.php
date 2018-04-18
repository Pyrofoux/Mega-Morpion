<?php
    include_once("./includes/fonctions.php");
    include("./includes/header_accueil.php");
	
	if(isConnected() && !isset($_GET["err"]))
	{
		header('Location: page_connexion.php');
	}
?>
<div class="well well-lg identification">
	<?php
		if(isset($_GET["err"]))
		{
	?>
	<div class="alert   alert-danger">
	  Cette combinaison d'identifiant et de mot de passe ne correspond à aucun utilisateur.
	</div>
		<?php } ?>
    <h2 class="titre"> Se connecter </h2>
    <br/>
<div class="container">
<form method="POST" action="page_connexion.php" class="formulaire">
    <div class="row">
        <div class="form-group col-md-4 col-md-offset-4">
            <label for="login">Identifiant :</label>
            <input type="text" class="form-control" name="login">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4 col-md-offset-4">
            <label for="mdp">Mot de passe :</label>
            <input type="password" class="form-control" name="mdp">
        </div>
    </div>
    <button type="submit" class="btn btn-primary button_form">Se connecter</button>
</form>
</div>
</div>
</html>