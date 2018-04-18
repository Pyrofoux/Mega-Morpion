        <?php
			include_once("./includes/fonctions.php");
			
			if(isset($_GET["deco"]))
			{
				session_destroy();
			}
			
			include("./includes/header_accueil.php");
        ?>
        <div class="container-fluid bg-1 text-center">
                <button type="button" class="col-md-3 col-md-offset-2 btn btn-primary btn-lg large-button" style="height:80px" onclick="location.href='./inscription.php'">S'inscrire</button>
                <button type="button" class="col-md-3 col-md-offset-2 btn btn-primary btn-lg large-button" style="height:80px" onclick="location.href='./connexion.php'">Se connecter</button>
        </div>
        <?php
            include("./includes/description.php")
        ?>
        <p class="text-center">
                <br/>
				Inscris-toi et viens affronter des dizaines de joueurs !
				<br/>
			</p>
		</div>
	</div>
</div>
        <?php
            include("./includes/footer.php")
        ?>
