<?php
session_start();
if(!isset($_SESSION["id"]) || $_SESSION["admin"] != "1"){
    throw new Exception("Login required or user not admin.");
}

require_once ("KoncertBaza.php");
include ("nav.php"); 

$uredi = isset($_POST["ime"]) && !empty($_POST["ime"]) && 
        isset($_POST["datum"]) && !empty($_POST["datum"]) && 
        isset($_POST["cena"]) && !empty($_POST["cena"]) && 
        isset($_POST["opis"]) && !empty($_POST["opis"]) &&
        isset($_POST["zvrst"]) && !empty($_POST["zvrst"]) &&
        isset($_POST["kraj"]) && !empty($_POST["kraj"]);

$delete = isset($_POST["id"]) && !empty($_POST["id"]) && 
        isset($_POST["delete"]) && !empty($_POST["delete"]);


if ($uredi) {
    try {
        KonBaza::uredi($_POST["id"], $_POST["ime"], $_POST["datum"], $_POST["cena"], $_POST["opis"], $_POST["zvrst"], $_POST["kraj"]);
        header("Location: index.php");
    } catch (Exception $e) {
        $errorMessage = "Database error occured: $e";
    }
}
else if($delete){
    try {
        KonBaza::izbrisi($_POST["id"]);
        header("Location: index.php");
    } catch (Exception $e) {
        $errorMessage = "Database error occured: $e";
    }
}

?>
<div id="dodajDogodek" class="win">
    <?php $koncert = KonBaza::preberi($_GET["id"]) ?>
    <h2 class="naslov admin">Uredi dogodek: <?= $koncert["ime"]?></h2>
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
        <div id="prijava_labels">
            <label class="add">Ime dogodka:</label><br />
            <label class="add">Datum dogodka:</label><br />
            <label class="add">Cena:</label><br />
            <label class="add">Opis dogodka:</label><br />
            <label class="add">Zvrst dogodka:</label><br />
            <label class="add">Kraj dogodka:</label><br />
        </div>
        <input type="hidden" name="id" value="<?= $koncert["id"] ?>" />

        <input type="text" name="ime" id="ime" class="addIn" value="<?= $koncert["ime"] ?>" autofocus /><br />
        
        <input type="date" name="datum" id="datum" class="addIn" min="2020-05-31" value="<?= $koncert["datum"] ?>"/><br />
        
        <input type="number" name="cena" id="cena" class="addIn inputadd" min="1" value="<?= $koncert["cena"] ?>"  /><br />
        
        <input type="text" name="opis" id="opis" class="addIn" value="<?= $koncert["opis"] ?>"  /><br />
        
        <select id="zvrst" name="zvrst" class="addIn">
        <?php foreach (KonBaza::getZvrsti() as $zvrst) : ?>
            <option value="<?= $zvrst["ime"] ?>" <?php if($zvrst["ime"] == $koncert["zvrst"]) :  ?> selected="selected" <?php endif; ?>><?= $zvrst["ime"] ?></option>
        <?php endforeach; ?>
        </select><br />
        
        <select id="kraj" name="kraj" class="addIn">
        <?php foreach (KonBaza::getKraji() as $kraj) : ?>
            <option value="<?= $kraj["ime"] ?>" <?php if($kraj["ime"] == $koncert["kraj"]) :  ?> selected="selected" <?php endif; ?>><?= $kraj["ime"] ?></option>
        <?php endforeach; ?>
        </select><br />
        <button type="submit" class="btn btn-primary" id="prijava_button">Potrdi</button>
    </form>
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
        <input type="hidden" name="id" value="<?= $koncert["id"] ?>" />
        <input type="hidden" name="delete" value="1" />
        <button type="submit" onclick="return izbrisi();" class="btn btn-danger" id="deleteGumb">Izbriši</button>
    </form>
</div>

<script src="script.js"></script>