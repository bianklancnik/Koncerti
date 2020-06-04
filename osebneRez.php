<?php
session_start();
if(!isset($_SESSION["id"])){
    throw new Exception("Login required.");
}
require_once "KoncertBaza.php";
include "nav.php";

$delete = isset($_POST["id"]) && !empty($_POST["id"]);

if($delete){
    try {
        KonBaza::izbrisiRezervacijo($_POST["id"]);
        header("Location: osebneRez.php");
    } catch (Exception $e) {
        $errorMessage = "Database error occured: $e";
    }
}
?>
<div id="rezIzpis" class="win">
<h2 id="rezNaslov">MOJE REZERVACIJE</h2>
<hr>
<?php foreach (KonBaza::preberiRezervacije($_SESSION["id"]) as $rezervacija): ?>
    <div class="rezOkno">
        <h3><b><?= $rezervacija["ime"] ?></b></h3>
        <p>Število rezerviranih kart: <?= $rezervacija["stevilo"]?></p> 
        <p>Cena skupaj: <?= $rezervacija["cena"] * $rezervacija["stevilo"]?>€</p>
        <p>Datum dogodka: <?= $rezervacija["datum"] ?></p>
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
            <input type="hidden" name="id" value="<?= $rezervacija["id"] ?>" />
            <button type="submit" onclick="return izbrisiRez();" class="btn btn-danger">Prekliči rezervacijo</button>
        </form>
    </div>
<?php endforeach; ?>
</div>
<script src="script.js"></script>