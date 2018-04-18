<?php
	include_once("./includes/fonctions.php");
	redirectConnexion();
	
	$player = $_SESSION["login"];
	$score = getPlayer($player)["score"];
	$mode = $_GET["mode"]*1;
	
	$list = getAllPlayersExcept($player);
	
	if($mode < 0 || $mode > 2)
	{
		header("Location : defier.php");
		exit();
	}
	
	$candidats = [];
	if($mode == 0)
	{
		for($i=0; $i<count($list); $i++)
		{
			if($list[$i]["score"] <= $score)
			{
				array_push($candidats,$list[$i]["login"]);
			}
		}
	}
	else if($mode == 2)
	{
		for($i=0; $i<count($list); $i++)
		{
			if($list[$i]["score"] >= $score)
			{
				array_push($candidats,$list[$i]["login"]);
			}
		}
	}else if($mode == 1)
	{
		for($i=0; $i<count($list); $i++)
		{
			if(abs($list[$i]["score"]-$score) <= 20)
			{
				array_push($candidats,$list[$i]["login"]);
			}
		}
	}
	
	$un = true;
	if(count($candidats) == 0)$un = false;
	
	$candidat = $candidats[array_rand($candidats)];
	


    include("./includes/header_connexion.php");
?>
<div class="container-fluid bg-1 text-center">
            <div class="row">
                <button type="button" class="col-md-2 col-md-offset-1 btn btn-primary btn-lg large-button" onclick="location.href='./page_regles.php'">Règles</button>
                <button type="button" class="col-md-4 col-md-offset-1 btn btn-primary btn-lg large-button"  style="height:80px" onclick="location.href='./defier.php'">Défier</button>
                <button type="button" class="col-md-2 col-md-offset-1 btn btn-primary btn-lg large-button" onclick="location.href='./classement.php'">Classement</button>
            </div>
</div>
<div class="container-fluid bg-2 text-center">
    <div class="well well-lg">
	<?php if($un)
	{
		?>
    <h2 class="margin text-center"> Acceptez-vous de défier <strong><?php echo htmlspecialchars($candidat);?></strong>? </h2>
        </br>
        <p class="margin text-center">
        <a href='./defier_bdd.php?adversaire=<?php echo urlencode($candidat) ?>'>
          <span class="glyphicon glyphicon-ok-sign validation-defi right"></span>
        </a>
        <span class="tirets"> --------</span>
        <a href="./defi_aleatoire.php">
          <span class="glyphicon glyphicon-remove-sign validation-defi wrong"  ></span>
        </a>
        </p>
		<?php 
	}
	else
	{
		?>
	<h2 class="margin text-center">Personne ne correspond à ces critères.<br/>
	Vous êtes trop fort ! (ou trop faible)</h2>
	<?php
	}
	?>
        </br>
    </div>
</div>
<?php
    include("./includes/footer.php")
?>