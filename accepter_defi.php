<?php
    include_once("./includes/fonctions.php");
	
	redirectConnexion();
	
	if(isset($_GET["adversaire"]))
	{
		$adversaire = $_GET["adversaire"];
		$player = $_SESSION["login"];
		$d = getDefi($adversaire,$player);
		if(count($d) != 0)
		{
			deleteDefi($adversaire,$player);
			
			//Création de la partie
			$req = $bdd -> prepare("INSERT INTO parties (j1,j2,date,coups,tour) VALUES (:j1,:j2,NOW(),'[]',0)");
			$req -> bindParam(":j1",$j1);
			$req -> bindParam(":j2",$j2);
			
			//Choix au hasard du j1/j2 
			
			if(rand(1,2) == 1)
			{
				$j1 = $player;
				$j2 = $adversaire;
			}
			else
			{
				$j2 = $adversaire;
				$j1 = $player;
			}
			
			$req -> execute();
			
			header("Location: partie.php");
			exit();
		}
	}
	
	header("Location : defis.php");
	
?>