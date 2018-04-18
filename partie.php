<?php
	include_once("./includes/fonctions.php");

	if(!isConnected())
	{
		header("Location: page_accueil.php");
	}

    include("./includes/header_connexion.php");
	
	$partie = getPartie($_SESSION["login"]);
	
	if($partie == false)
	{
		header("Location: defier.php");
	}
	
	$final = $partie["final"]; 
	if($final > 0)
	{
		endGame($partie,$final);
	}
	
	if(isset($_GET["ragequit"]))
	{
		if($partie["first"])
		{
			$final = $partie["final"] = 2;
			endgame($partie,2);
		}
		else
		{
			$final = $partie["final"] = 1;
			endgame($partie,1);
		}
	}
	
	
?>

<script type="text/javascript">

var partie = 
<?php 
	
	echo json_encode($partie);
	
?>
;
</script>

<div class="container-fluid bg-1 text-center">
            <div class="row">
                <button type="button" class="col-md-2 col-md-offset-1 btn btn-primary btn-lg large-button" onclick="location.href='./page_regles.php'">Règles</button>
				<?php if($final == 0)
				{
				?>
					<button type="button" class="col-md-4 col-md-offset-1 btn btn-primary btn-lg large-button" active style="height:80px">Partie en cours</button>
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
<div class="container-fluid bg-2 text-center">
    <div class="well well-lg">
		<h4 class="margin text-center" id="message" > [...] </h4>
		
		<?php include("./includes/jeu/index.html"); ?>
		
		<button type="button" class="col-md-2 col-md-offset-5 btn btn-primary btn-lg annuler"  style="height:80px" onclick="location.href='./partie.php?ragequit=1'">Abandonner</button>
		<br/>
		<br/>
		
    </div>
	
	
	
	
</div>
<?php
    include("./includes/footer.php")
?>