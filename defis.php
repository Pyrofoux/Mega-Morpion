<?php
/*
	- refresh qui s'aligne correctement dans partie

*/


    include_once("./includes/fonctions.php");
	include("./includes/header_connexion.php");
	
	redirectConnexion();
	redirectPartie();
	redirectDefi();
	
	
	$defis = getDefi(false,$_SESSION["login"]);
	
?>
<div class="container-fluid bg-1 text-center">
            <div class="row">
                <button type="button" class="col-md-2 col-md-offset-1 btn btn-primary btn-lg large-button" onclick="location.href='./page_regles.php'">Règles</button>
                <button type="button" class="col-md-4 col-md-offset-1 btn btn-primary btn-lg large-button" style="height:80px" onclick="location.href='./defier.php'">Défier</button>
                <button type="button" class="col-md-2 col-md-offset-1 btn btn-primary btn-lg large-button" onclick="location.href='./classement.php'">Classement</button>
            </div>
</div>
<div class="container-fluid bg-2 text-center">
    <div class="well well-lg overflow">
    
        </br>
		<?php
			if(count($defis))
			{
		?>
		<h2 class="margin text-center"> Demandes de défis : </h2>
        <table class="col-md-8 col-md-offset-2">
            <?php
            for($i=0;$i<count($defis);$i++)
            {
				$d = $defis[$i];
				$p = getPlayer($d["asker"]);
            ?>
				<tr>
				<td> <?php echo htmlspecialchars($d["asker"]); ?> </td>
				<td> <?php echo htmlspecialchars($p["score"]); ?> points </td>
				<td class="text-right"> <a href="./accepter_defi.php?adversaire=<?php echo urlencode($d["asker"]);?>"> <span class="glyphicon glyphicon-ok-sign validation-defi right"></span> </a>
										<span class="tirets">--------</span>
										<a href="./refuser_defi.php?adversaire=<?php echo urlencode($d["asker"]);?>"><span class="glyphicon glyphicon-remove-sign validation-defi wrong"></span></a> </td>
				</tr>
			<?php
			}
			?>
        </table>
		<?php
			}
			else
			{
		?>
				<h2 class="margin text-center">Vous n'avez aucune demande de défis.</h2>
		<?php
			}
		?>
        </br>
    </div>
</div>
<?php
    include("./includes/footer.php")
?>