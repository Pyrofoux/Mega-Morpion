<?php
    include_once("./includes/fonctions.php");

	redirectConnexion();
	redirectPartie();
	redirectDefi();

    $req = $bdd -> prepare("SELECT * FROM joueurs WHERE login <> ? ORDER BY login" );
    $req -> execute(array($_SESSION["login"]));
	
	include("./includes/header_connexion.php")
?>
<div class="container-fluid bg-1 text-center">
            <div class="row">
                <button type="button" class="col-md-2 col-md-offset-1 btn btn-primary btn-lg large-button" onclick="location.href='./page_regles.php'">Règles</button>
                <button type="button" class="col-md-4 col-md-offset-1 btn btn-primary btn-lg large-button" active style="height:80px">Défier</button>
                <button type="button" class="col-md-2 col-md-offset-1 btn btn-primary btn-lg large-button" onclick="location.href='./classement.php'">Classement</button>
            </div>
</div>
<div class="container-fluid bg-2">
    <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <input class="form-control" id="myInput" type="text" style="height:80px" placeholder="Rechercher un joueur...">
            <br>
            <ul class="list-group" id="myList">
                <?php
                $i = 1;
                while($row=$req->fetch())
                {
                ?>
                <li class="list-group-item"><strong><?php echo htmlspecialchars ($row["login"]) ?></strong><span> (</span><?php echo htmlspecialchars ($row["score"]) ?><span> points)</span><button type="button" class="btn btn-primary pull-right btn-defier" onclick="location.href='./defier_bdd.php?adversaire=<?php echo urlencode($row["login"]) ?>'" >Défier</button></li>
                <?php    
                }
                ?>
            </ul>
        </div>
        <button type="button" class="col-md-1 btn btn-primary btn-lg large-button text-left" active style="height:80px" onclick="./defi_aleatoire.php">OU</button>
        <button type="button" class="col-md-4 btn btn-primary btn-lg large-button defi-aleatoire" style="height:80px" onclick="location.href='./defi_aleatoire.php'">Défier un joueur aléatoire</button>
    </div>
</div>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myList li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<?php
    include("./includes/footer.php")
?>