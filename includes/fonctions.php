<?php

include_once("./includes/mechanics.php");

	session_start();

	
	
	function getBdd() {
    // Local deployment
    $server = "localhost";
    $username = "admin";
    $password = "secret";
    $db = "megamorpion";
    
    return new PDO("mysql:host=$server;dbname=$db;charset=utf8", "$username", "$password",
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	
	}
	
	$bdd = getBdd();
	
	function isConnected() {
    return isset($_SESSION['login']);
	}
	
	function getPlayer($log)
	{
		global $bdd;
		$req = $bdd->prepare("SELECT * from joueurs WHERE login = :login");
		$req->bindParam(":login",$login);
		
		$login = $log;
		
		$req->execute();
		if($row = $req->fetch())
		{
			return $row;
		}
		
		return false;
	}
	
	function getDefiFrom($from)
	{
		global $bdd;
		$req = $bdd->prepare("SELECT * from defis WHERE asker = :login");
		$req->bindParam(":login",$login);
		
		$login = $from;
		
		$req->execute();
		if($row = $req->fetch())
		{
			return $row;
		}
		
		return false;
	}
	
	function getRank($login)
	{
		global $bdd;
		$req = $bdd->prepare("SELECT COUNT(*) AS rank FROM joueurs WHERE score >= (SELECT score FROM joueurs WHERE login = :login)");
		$req->bindParam(":login",$log);
		$log = $login;
		
		$req->execute();
		if($row = $req->fetch())
		{
			return $row["rank"];
		}
	}
	
	function getAllPlayersExcept($login)
	{
		global $bdd;
		$req = $bdd->prepare("SELECT login,score from joueurs WHERE login <> :login");
		$req->bindParam(":login",$log);
		
		$log = $login;
		
		$req->execute();
		$liste = [];
		while($row = $req->fetch())
		{
			
			array_push($liste,$row);
		}
		
		return $liste;
	}
	
	
	function redirectPartie()// Redirige vers la page de jeu si une partie est en cours
	{
		if(isset($_SESSION["login"]) && getPartie($_SESSION["login"]))
		{
			header("Location: partie.php#message");
			exit();
			return true;
		}
		return false;
	}
	
	
	function redirectConnexion()// Redirige vers la page de connexion si pas connecté
	{
		if(!isConnected())
		{
			header("Location: page_accueil.php");
			return $_SESSION["login"];
		}
		return false;
	}
	
	function redirectDefi()// Redirige vers la page d'attente si un défi est en cours
	{
		if(isset($_SESSION["login"]) && getDefiFrom($_SESSION["login"]) != false)
		{
			header("Location: attente_defi.php");
			return true;
		}
		return false;
	}
	
	function deleteDefi($from,$to)//Supprime les défis de l'intersection de $from et $to
	{
		global $bdd;
		
		$s1 = "";
		$s2 = "";
		$n = "";
		
		if($from)
		{
			$s1 = "asker = :from ";
		}
		
		if($to)
		{
			$s2 = " asked = :to ";
		}
		
		if($from && $to)
		{
			$n = " AND ";
		}
		
		
		$req = $bdd -> prepare("DELETE FROM defis WHERE ".$s1.$n.$s2);
		
		if($from)
		{
		$req -> bindParam(":from",$f);
		}
		
		if($to)
		{
		$req -> bindParam(":to",$t);
		}
		
		$f = $from;
		$t = $to;
		
		$req -> execute();
	}
	
	function getDefi($from,$to)//Obtient les défis de l'intersection de $from et $to
	{
		global $bdd;
		
		$s1 = "";
		$s2 = "";
		$n = "";
		
		if($from)
		{
			$s1 = "asker = :from ";
		}
		
		if($to)
		{
			$s2 = " asked = :to ";
		}
		
		if($from && $to)
		{
			$n = " AND ";
		}
		
		
		$req = $bdd -> prepare("SELECT * FROM defis WHERE ".$s1.$n.$s2);
		
		if($from)
		{
		$req -> bindParam(":from",$f);
		}
		
		if($to)
		{
		$req -> bindParam(":to",$t);
		}
		
		$f = $from;
		$t = $to;
		
		$req -> execute();
		
		$liste = [];
		while($row = $req->fetch())
		{
			
			array_push($liste,$row);
		}
		
		return $liste;
	}
	
?> 
