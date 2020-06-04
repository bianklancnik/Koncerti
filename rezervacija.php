<?php
session_start();
if(!isset($_SESSION["id"])){
    throw new Exception("Login required.");
}
require_once ("KoncertBaza.php");
include ("nav.php"); 
$rez = isset($_POST["quantity"]) && !empty($_POST["quantity"]);
if ($rez) {
    try {
        KonBaza::karta($_POST["quantity"], $_POST["id"], $_SESSION["id"]);
        header("Location: profil.php");
    } catch (Exception $e) {
        $errorMessage = "Database error occured: $e";
    }
}
?>
<body class="back">
<?php $koncert = KonBaza::preberi($_GET["id"]) ?>
<div id="pod" class="win">
    <h2 class="naslovPod"><?= $koncert["ime"] ?></h2>
    <h3><b>Cena karte: </b><?= $koncert["cena"] ?>€</h3><br />
    <input type="hidden" id="hiddencontainer" name="hiddencontainer" value="<?=$koncert["cena"]?>"/>
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
    <input type="hidden" name="id" value="<?= $koncert["id"] ?>"  />
    <h3>Število kart:</h3>
    <input type="number" id="quantity" name="quantity" min="1" value="1"><br />
    <p id="cenaSkupaj">Cena skupaj: €</p>
    <button type="submit" onclick="return clicked();" class="btn btn-dark" id="rezGumb">Rezerviraj!</button>
    </form>
</div>

<script src="script.js"></script>
<script>
$(":input").bind('keyup mouseup', function () {
    var stevilo = document.getElementById("quantity").value;
    var cena = document.getElementById("hiddencontainer").value;
    document.getElementById("cenaSkupaj").innerText = "Cena skupaj: " + stevilo * cena + "€";
});
</script>