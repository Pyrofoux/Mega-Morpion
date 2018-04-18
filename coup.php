<?php
 include_once("./includes/fonctions.php");
 
 if(!isset($_GET["coup"]) || !isConnected()) die();
 
 $partie = getPartie($_SESSION["login"]);
 
 if(!$partie)die();
 
 $coup = $_GET["coup"]*1;
 
 array_push($partie["coups"],$coup); 
 
 $partie["tour"]++;
 
$req = $bdd -> prepare("UPDATE parties SET coups = :coups, tour = :tour WHERE j1 = :login OR j2 = :login");
		$req -> bindParam(":login",$labLogin);
		$req -> bindParam(":coups",$labCoups);
		$req -> bindParam(":tour",$labTour);
		
		$labLogin = $_SESSION["login"];
		$labCoups = json_encode($partie["coups"]);
		$labTour =  $partie["tour"]++;
		
		$req -> execute();
 
	header("Location: partie.php#message");
 

?>