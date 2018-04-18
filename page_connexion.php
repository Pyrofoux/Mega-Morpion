<?php

	include("./includes/fonctions.php");
	
	
	if(!isConnected())
	{
		if(isset($_POST["login"]) && isset($_POST["mdp"]))
		{
			
			$row = getPlayer($_POST["login"]);
			
			if($row && $row["password"] == $_POST["mdp"])
			{
				$_SESSION["login"] = $row["login"];
				$_SESSION["score"] = $row["score"];
				$_SESSION["date"] = $row["date"];
			}
			else
			{
				fail();
			}
			
			
		}
		else
		{
			// print("PAS SET");
			fail();
		}
	}
	else
	{
		// header('Location: defier.php');
	}
	
    include("./includes/header_connexion.php");
	
	
	function fail()
	{
		header('Location: connexion.php?err=1');
	}
	
?>
<div class="container-fluid bg-1 text-center">
                <button type="button" class="col-md-2 col-md-offset-1 btn btn-primary btn-lg large-button" onclick="location.href='./page_regles.php'">Règles</button>
                <button type="button" class="col-md-4 col-md-offset-1 btn btn-primary btn-lg large-button" style="height:80px" onclick="location.href='./defier.php'">Défier</button>
                <button type="button" class="col-md-2 col-md-offset-1 btn btn-primary btn-lg large-button classement" onclick="location.href='./classement.php'">Classement </button>
</div>
<?php
    include("./includes/description.php")
?>
			<p class="text-center">
				Merci de nous avoir rejoint !
				<br/>
				Nous espérons que MEGA MORPION vous apportera joie et divertissement !
			</p>
		</div>
	</div>
</div>
<?php
    include("./includes/footer.php")
?>