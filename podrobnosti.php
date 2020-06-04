<?php
require_once ("KoncertBaza.php");
session_start();
include ("nav.php"); 
?>
<body class="back">
<?php $koncert = KonBaza::preberi($_GET["id"]) ?>
<div id="pod" class="win">
    <h2 class="naslovPod"><?=$koncert["ime"]?></h2>
    <p><b>Zvrst glasbe: </b><?=$koncert["zvrst"]?></p>
    <p><b>Kraj dogodka: </b><?=$koncert["kraj"]?></p>
    <p><b>Datum dogodka: </b><?=$koncert["datum"]?></p>
    <p><b>Cena: </b><?=$koncert["cena"]?>€</p>
    <p><b>Opis dogodka: </b><?=$koncert["opis"]?></p>
    <div id="podGumb">
        <?php if(isset($_SESSION["id"])) : ?>
        <a type="button" class="btn btn-dark" href="rezervacija.php?id=<?= $koncert["id"]?>">Rezerviraj karte</a>
        <?php if($_SESSION["admin"] == "1") : ?>
        <a type="button" class="btn btn-primary" href="uredi.php?id=<?= $koncert["id"]?>">Uredi</a>
        <?php endif; ?>
        <?php else : ?>
        <p><b>Postanite naš uporabnik in rezervirajte karte za koncerte. Registrirajte se <a href="register.php">tukaj</a>!</b></p>
        <?php endif; ?>
    </div>
</div>