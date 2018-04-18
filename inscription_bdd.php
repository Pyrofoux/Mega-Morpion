<?php
	include_once("./includes/fonctions.php");
	
	if(isSet($_POST["login"]))
	{
		$login = trim($_POST["login"]);
		
		if(strlen($login) == 0 || strlen($login) > 32)
		{
			fail(1);
		}
		
		
		$p = getPlayer($login);
		
		if($p)fail(2);
		
		if(isSet($_POST["mdp"]))
		{
			$mdp = $_POST["mdp"];
			if(strlen($mdp) == 0)
			{
				fail(3);
			}
			
		$req = $bdd -> prepare("INSERT INTO joueurs (login,password,date,score,victoires,egalites,defaites) VALUES (:login,:password,NOW(),0,0,0,0)");
		$req -> bindParam(":login",$log);
		$req -> bindParam(":password",$pass);
		
		$log = $login;
		$pass = $mdp;
		$score = 0;
		
		$req -> execute();
		
		$row = getPlayer($login);
		
		$_SESSION["login"] = $row["login"];
		$_SESSION["score"] = $row["score"];
		$_SESSION["date"]  = $row["date"];
		
		header("Location: defier.php");
		
		}
		
	}
	else
	{
		fail(0);
	}
	
	
	function fail($err)
	{
		header("Location: inscription.php?err=$err");
		exit();
	}
	
?>