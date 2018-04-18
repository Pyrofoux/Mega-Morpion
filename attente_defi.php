<?php
    include_once("./includes/fonctions.php");
    
	
	redirectConnexion();
	redirectPartie();
	
	$defis = getDefi($_SESSION["login"],false);
	
	if(count($defis) == 0)
	{
		header("Location : defier.php");
	}
	else
	{
		$adversaire = $defis[0]["asked"];
	}
	
	

	include("./includes/header_connexion.php");
?>
<div class="container-fluid bg-1 text-center">
            <div class="row">
                <button type="button" class="col-md-2 col-md-offset-1 btn btn-primary btn-lg large-button" onclick="location.href='./page_regles.php'">Règles</button>
                <button type="button" class="col-md-4 col-md-offset-1 btn btn-primary btn-lg large-button"   active style="height:80px" >Défier</button>
                <button type="button" class="col-md-2 col-md-offset-1 btn btn-primary btn-lg large-button" onclick="location.href='./classement.php'">Classement</button>
            </div>
</div>
<div class="container-fluid bg-2 text-center">
    <div class="well well-lg">
    <h2 class="margin text-center"> En attente de la réponse de <strong><?php echo htmlspecialchars($adversaire) ?></strong>... </h2>
	<br/>
	<button type="button" class="col-md-4 col-md-offset-4 btn btn-primary btn-lg large-button annuler" style="height:80px" onclick="location.href='./annuler_defi.php'">Annuler</button>
        </br>
    </div>
</div>

<script type="text/javascript">
	function autoRefresh()
{
	setTimeout(function(){
   window.location.reload(1);
}, 5000);
}

autoRefresh();
</script>

<?php
    include("./includes/footer.php")
?>