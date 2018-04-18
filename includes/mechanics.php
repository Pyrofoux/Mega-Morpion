<?php

$grille = array_fill(0,81,0);
$megagrille = array_fill(0,9,0);
$coups;
$possibles;


function getPartie($log)
	{
		global $bdd;
		$req = $bdd -> prepare("SELECT * from parties WHERE j1 = :login OR j2 = :login");
		$req -> bindParam(":login",$login);
		
		$login = $log;
		
		$req -> execute();
		if($row = $req ->fetch())
		{
			$row["first"] = $row["j1"] == $login; //Vrai si le joueur est considéré comme j1, faux sinon
			$partie = lireGrille($row);
			// $row["jouable"] = 
			return $partie;
		}
		
		return false;
	}

function lireGrille(&$partie)
{
	global $grille;
	global $megagrille;
	global $coups;
	global $possibles;
	
	$coups = $partie["coups"] = json_decode($partie["coups"]);
	
	for($i=0;$i<count($coups);$i++)
	{
		$grille[$coups[$i]] = 1+($i%2);
	}
	
	for($i=0;$i<9;$i++)
	{
		$megagrille[$i] = getState(array_slice($grille,$i*9,9),true);
	}
	
	$partie["final"] = getState($megagrille);
		
	
	$partie["grille"] = $grille;
	$partie["megagrille"] = $megagrille;
	
	//Checker 
	
	$partie["possibles"] = getPossibles($partie);
	
	return $partie;
}


function getState($grille)//0 si pas fini, 1 si victoire 1 , 2 si victoire 2, 3 si égalité
{
	$lignes = [
	$grille[0].$grille[1].$grille[2],
	$grille[3].$grille[4].$grille[5],
	$grille[6].$grille[7].$grille[8],
	$grille[0].$grille[3].$grille[6],
	$grille[1].$grille[4].$grille[7],
	$grille[2].$grille[5].$grille[8],
	$grille[0].$grille[4].$grille[8],
	$grille[2].$grille[4].$grille[6]
	];
	
	$auMoinsVide = false;
	for($i=0;$i<count($lignes);$i++)
	{
		if(strrpos($lignes[$i],"0") !== false)
		{
			$auMoinsVide = true;
		}
		
		if($lignes[$i] == "111")return 1;
		if($lignes[$i] == "222")return 2;
	}
	
	if($auMoinsVide)
	{
		return 0;
	}
	return 3;
}

function getPossibles($partie)
{
	if($partie['final'] > 0) //Pas de coups possible si le jeu est fini
	{
		return [];
	}
	
	
	//Si ce n'est pas le tour du joueur, aucun coup n'est possible
	//À commenter pour les phases de test
	if(!(($partie["first"] && ($partie["tour"]*1)%2 == 0) || (!$partie["first"] && ($partie["tour"]*1)%2 == 1))) //Tour de l'adversaire
	{
		return [];
	}

	
	
	
	global $grille;
	global $megagrille;
	global $coups;
	
	if(count($coups) == 0)//Premier tour, jouer où on veut
	{
		return range(0,80);
	}
	
	$last = $coups[count($coups)-1];
	$mega = $last%9;
	$poss = [];
	
	
	if($megagrille[$mega] > 0)//Jouer n'importe où, sauf dans les cases déjà jouées ou les terrains déjà remplis
	{
		for($i=0;$i<81;$i++)
		{
			if($grille[$i] == 0 && $megagrille[intval($i/9)] == 0)
			{
				array_push($poss,$i);
			}
		}
		return $poss;
	}
	else //Jouer dans lterrain spécifiquement
	{
		for($i=0;$i<9;$i++)
		{
			if($grille[$i+$mega*9] == 0)
			{
				array_push($poss,$i+$mega*9);
			}
		}
		return $poss;
	}
	
	return [];
	
}

function endGame($partie,$state)
{
	global $bdd;
	
	$j1 = getPlayer($partie["j1"]);
	$j2 = getPlayer($partie["j2"]);
	
	
	// Ajout des scores
	
	
	if($state == 3)
	{
		$result1 = "egalites";

		
		$result2 = "egalites";
		
	}else if($state == 1)
	{
		$result1 = "victoires";
		
		$result2 = "defaites";
	}
	else if($state == 2)
	{
		$result2 = "victoires";
		
		$result1 = "defaites";
	}
	
	
	$req1 = $bdd -> prepare("UPDATE joueurs SET score = :score1, ".$result1." = :total1  WHERE login = :login1 ");
		$req1 -> bindParam(":score1",$score1);
		$req1 -> bindParam(":total1",$total1);
		$req1 -> bindParam(":login1",$login1);
		
	$req2 = $bdd -> prepare("UPDATE joueurs SET score = :score2, ".$result2." = :total2  WHERE login = :login2 ");
		$req2 -> bindParam(":score2",$score2);
		$req2 -> bindParam(":total2",$total2);
		$req2 -> bindParam(":login2",$login2);
	
	
	$login1 = $partie["j1"];
	$login2 = $partie["j2"];
	
	if($state == 3)
	{
		$result1 = "egalites";
		$score1 = $j1["score"] + 5;
		
		$result2 = "egalites";
		$score2 = $j2["score"] + 5;
		
	}else if($state == 1)
	{
		$result1 = "victoires";
		$score1 = $j1["score"] + 10;
		
		$result2 = "defaites";
		$score2 = $j2["score"] + 1;
	}
	else if($state == 2)
	{
		$result2 = "victoires";
		$score2 = $j2["score"] + 10;
		
		$result1 = "defaites";
		$score1 = $j1["score"] + 1;
	}
	
	
	$total1 = $j1[$result1]+1;
	$total2 = $j2[$result2]+1;
	
		
		$req1 -> execute();
		$req2 -> execute();
	
	// Archivage de la partie
	$req = $bdd -> prepare("INSERT INTO historique (j1,j2,date,result) VALUES (:login1,:login2,NOW(),$state)");
	$req -> bindParam(":login1",$log1);
	$req -> bindParam(":login2",$log2);
	
	$log1 = $partie["j1"];
	$log2 = $partie["j2"];

	$req -> execute();
	
	$req = $bdd -> prepare("DELETE FROM parties WHERE j1 = :login1 AND j2 = :login2");
	$req -> bindParam(":login1",$l1);
	$req -> bindParam(":login2",$l2);
	
	$l1 = $partie["j1"];
	$l2 = $partie["j2"];

	$req -> execute();
	
	
}


?>