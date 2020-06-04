<?php
session_start();
if(!isset($_SESSION["id"]) || $_SESSION["admin"] != "1"){
    throw new Exception("Login required or user not admin.");
}

require_once ("KoncertBaza.php");
include ("nav.php"); 

$add = isset($_POST["ime"]) && !empty($_POST["ime"]) && 
        isset($_POST["datum"]) && !empty($_POST["datum"]) && 
        isset($_POST["cena"]) && !empty($_POST["cena"]) && 
        isset($_POST["opis"]) && !empty($_POST["opis"]) &&
        isset($_POST["zvrst"]) && !empty($_POST["zvrst"]) &&
        isset($_POST["kraj"]) && !empty($_POST["kraj"]);

if ($add) {
    try {
        KonBaza::dodaj($_POST["ime"], $_POST["datum"], $_POST["cena"], $_POST["opis"], $_POST["zvrst"], $_POST["kraj"]);
        header("Location: dodaj.php");
    } catch (Exception $e) {
        $errorMessage = "Database error occured: $e";
    }
}
?>
<div id="dodajDogodek" class="win">
    <h2 class="naslov admin">Dodaj dogodek</h2>
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
        <div id="prijava_labels">
            <label class="add">Ime dogodka:</label><br />
            <label class="add">Datum dogodka:</label><br />
            <label class="add">Cena:</label><br />
            <label class="add">Opis dogodka:</label><br />
            <label class="add">Zvrst dogodka:</label><br />
            <label class="add">Kraj dogodka:</label><br />
        </div>
        <input type="text" name="ime" id="ime" class="addIn" autofocus /><br />
        
        <input type="date" name="datum" id="datum" class="addIn" min="2020-05-31" /><br />
        
        <input type="number" name="cena" id="cena" class="addIn inputadd" min="1" value="1"  /><br />
        
        <input type="text" name="opis" id="opis" class="addIn"  /><br />
        
        <select id="zvrst" name="zvrst" class="addIn">
        <?php foreach (KonBaza::getZvrsti() as $zvrst) : ?>
            <option value="<?= $zvrst["ime"] ?>"><?= $zvrst["ime"] ?></option>
        <?php endforeach; ?>
        </select><br />
        
        <select id="kraj" name="kraj" class="addIn">
        <?php foreach (KonBaza::getKraji() as $kraj) : ?>
            <option value="<?= $kraj["ime"] ?>"><?= $kraj["ime"] ?></option>
        <?php endforeach; ?>
        </select><br />
        <button type="submit" class="btn btn-primary" id="prijava_button">Dodaj</button>
    </form>
</div>