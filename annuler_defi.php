<?php
    include_once("./includes/fonctions.php");
	
	redirectConnexion();
	
	deleteDefi($_SESSION["login"],false);
	
	header("Location: defier.php");
	
?>