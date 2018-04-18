<?php
    include("./includes/header_accueil.php")
?>
<div class="well well-lg identification">
    <h2 class="titre"> S'inscrire </h2>
    <br/>
<div class="container">
<?php

	$errs = ["","Veuillez rentrer un nom d'utilsiateur.","Ce nom d'utilisateur est déjà utilisé.","Veuillez rentrer un mot de passe."];

		if(isset($_GET["err"]))
		{
	?>
	<div class="alert alert-danger">
	 <?php print $errs[$_GET["err"]]; ?>
	</div>
		<?php } ?>
<form method="POST" action="inscription_bdd.php" class="formulaire">
    <div class="row">
        <div class="form-group col-md-4 col-md-offset-4">
            <label for="login">Entrer un nom d'utilisateur :</label>
            <input type="text" class="form-control" name="login" maxlength="32">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4 col-md-offset-4">
            <label for="mdp">Entrer un mot de passe :</label>
            <input type="password" class="form-control" name="mdp" maxlength="32">
        </div>
    </div>
    <button type="submit" class="btn btn-primary button_form">S'inscrire</button>
</form>
</div>
</div>
</html>
