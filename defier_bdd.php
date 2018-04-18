<?php
	include_once("./includes/fonctions.php");
	
	
	if(!isConnected())fail(0);
	
	if(isSet($_GET["adversaire"]))
	{
		$adversaire = $_GET["adversaire"];
		
		if(!getPlayer($adversaire))fail(1);
		if(getDefiFrom($_SESSION["login"]))fail(2);
		
		
			
		$req = $bdd -> prepare("INSERT INTO defis (asker,asked,date) VALUES (:asker,:asked,NOW())");
		$req -> bindParam(":asker",$asker);
		$req -> bindParam(":asked",$asked);
		
		$asker = $_SESSION["login"];
		$asked = $adversaire;
		
		$req -> execute();
		
		header("Location: defier.php?done");
		
		
		
		
		
		
	}
	else
	{
		fail(0);
	}
	
	
	function fail($err)
	{
		header("Location: defier.php?err=$err");
		exit();
	}
	
?>