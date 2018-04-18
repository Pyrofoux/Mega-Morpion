
<?php include_once("fonctions.php"); ?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="./css/style.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <title> MegaMorpion </title>
    </head>
        <body class="body">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class ="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-target">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="page_connexion.php">
                                <img src="./images/megamorpion.png" alt="image titre" style="width:400px;">
                            </a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="defis.php"> <span class="glyphicon glyphicon-tower"></span> Mes défis<?php
							if(isConnected())
							{
								$defis = getDefi(false,$_SESSION["login"]);
								$num = count($defis);
								if($num != 0)
								{
									echo " <strong>($num)</strong>";
								}
							}
							
							?></a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <span class="glyphicon glyphicon-user"></span>
								<?php
								if(isConnected())
								{
									echo htmlspecialchars($_SESSION["login"]);
								}
								?>
                                <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="profil_joueur.php?joueur=<?php echo htmlspecialchars($_SESSION["login"]) ?>"> Mon profil</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="parametres.php"> Paramètres</a></li>
                                </ul>
                            </li>
                            <li><a href="page_accueil.php?deco=1"><span class="glyphicon glyphicon-off"></span> Déconnexion</a></li>
                    </div>
                </div>
            </nav>
