<?php
    include("./includes/header_connexion.php");
    include_once("./includes/fonctions.php");
?>
<?php
    $req = $bdd -> prepare("SELECT * FROM joueurs ORDER BY score desc");
    $req -> execute();
?>
<div class="container-fluid bg-1 text-center">
            <div class="row">
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
                <button type="button" class="col-md-2 col-md-offset-1 btn btn-primary btn-lg large-button" active onclick="location.href='./classement.php'">Classement</button>
            </div>
</div>
<div class="container-fluid bg-2">
    <div class="well well-lg overflow">
        <table class="col-md-8 col-md-offset-2">
            <?php
            $i = 1;
            while($row = $req->fetch())
            {
					
            ?>
				<tr>
				<td class="num"> <?php echo ($i) ?> - </td>
				<td> <a href="./profil_joueur.php?joueur=<?php echo htmlspecialchars ($row["login"]) ?>" class="lien"> <?php echo htmlspecialchars ($row["login"]) ?> </a> </td> 
				<td class="text-right"> <?php echo htmlspecialchars ($row["score"]) ?> points</td>
				</tr> 
            <?php
                $i=$i+1;
            }
            ?>
        </table>
    </div>
</div>
<?php
    include("./includes/footer.php")
?>