<?php
    include("./includes/header_connexion.php")
?>
<div class="container-fluid bg-1 text-center">
            <div class="row">
                <button type="button" class="col-md-2 col-md-offset-1 btn btn-primary btn-lg large-button" onclick="location.href='./page_regles.php'">Règles</button>
                <button type="button" class="col-md-4 col-md-offset-1 btn btn-primary btn-lg large-button" active style="height:80px" onclick="location.href='./defier.php'">Défier</button>
                <button type="button" class="col-md-2 col-md-offset-1 btn btn-primary btn-lg large-button" onclick="location.href='./classement.php'">Classement</button>
            </div>
</div>
<div class="container-fluid bg-2 text-center">
    <div class="well well-lg">
        <h2 class="margin text-center"> Quel niveau souhaitez-vous que votre adversaire ait ? </h2>
        </br>
        <button type="button" class="col-md-3 btn btn-primary btn-lg large-button btn-defi" onclick="location.href='./proposition_defi.php?mode=0'">Plus faible que le mien</button>
        <button type="button" class="col-md-3 btn btn-primary btn-lg large-button btn-defi" onclick="location.href='./proposition_defi.php?mode=1'">Similaire au mien</button>
        <button type="button" class="col-md-3 btn btn-primary btn-lg large-button btn-defi" onclick="location.href='./proposition_defi.php?mode=2'">Plus fort que le mien</button>
        </br>
    </div>
</div>
<?php
    include("./includes/footer.php")
?>