<?php
    include_once("./includes/fonctions.php");
	
	redirectConnexion();
	
	if(isset($_GET["adversaire"]))
	{
		$adversaire = $_GET["adversaire"];
		deleteDefi($_GET["adversaire"],$_SESSION["login"]);
	}
	
	header("Location: defis.php");
	
?>