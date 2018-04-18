<?php
    include("./includes/fonctions.php");
    include("./includes/header_connexion.php");
	
	if(isset($_GET["joueur"]))
	{
		$joueur = $_GET["joueur"];
	}
	
	$req = $bdd -> prepare("SELECT * FROM historique WHERE j1 = :joueur OR j2 = :joueur ORDER BY date ");
	$req->bindParam(":joueur",$joueur);
    $req -> execute();
	
?>
<div class="container-fluid bg-1 text-center">
                <button type="button" class="col-md-2 col-md-offset-1 btn btn-primary btn-lg large-button" onclick="location.href='./page_regles.php'">Règles</button>
                <button type="button" class="col-md-4 col-md-offset-1 btn btn-primary btn-lg large-button" style="height:80px" onclick="location.href='./defier.php'">Défier</button>
                <button type="button" class="col-md-2 col-md-offset-1 btn btn-primary btn-lg large-button" onclick="location.href='./classement.php'">Classement</button>
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
					<td><?php
						if($row["result"] == 0)
						{
							print("Égalité");
						}
						else if(($row["result"] == 1))
						{
							if($row["j1"] == $joueur)
							{
								print("Victoire");
								$name = $row["j2"];
							}
							else
							{
								print("Défaite");
								$name = $row["j1"];
							}
						}
						else
						{
							if($row["j2"] == $joueur)
							{
								print("Victoire");
								$name = $row["j1"];
							}
							else
							{
								print("Défaite");
								$name = $row["j2"];
							}
						}
						
						
					?> contre <a href="./profil_joueur.php?joueur=<?php echo urlencode($name); ?>"><?php echo htmlspecialchars($name); ?></a>
					</td>
					<td class="text-right"> <?php echo htmlspecialchars($row["date"]); ?> </td> 
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