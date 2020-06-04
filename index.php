<?php
require_once ("KoncertBaza.php");
session_start();
include ("nav.php"); 
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Koncerti</title>
</head>
<body id="index">
    <div id="koncerti">
        <?php foreach (KonBaza::preberiVse() as $koncert): ?>
            <div class="koncertOkno">
                <h2 class="naslov"><?= $koncert["ime"] ?></h2>
                <div class="podatki">
                    <p><b>Zvrst glasbe:</b> <?= $koncert["zvrst"] ?></p>
                    <p><b>Kraj dogodka:</b> <?= $koncert["kraj"] ?></p>
                    <p><b>Datum dogodka:</b> <?= $koncert["datum"] ?></p>
                    <p><b>Karta:</b> <?= $koncert["cena"] ?>€</p>
                </div>
                <div class="gumbi">
                    <a type="button" class="btn btn-dark" href="podrobnosti.php?id=<?= $koncert["id"]?>">Podrobnosti</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div id="sort">
        <div id="isci">
            <label>Poiščite dogodek:</label>
            <input id="search" type="text" placeholder="Isci..">
        </div>
        <div id="isci">
            <label>Filtriraj dogodke:  </label>
            <select id="order">
                <option value="brez" select="selected">Brez</option>
                <option value="zvrst">Zvrst glasbe</option>
                <option value="kraj">Kraj dogodka</option>
            </select>
        </div>
        <?php if(isset($_SESSION["id"])) : ?>
        <?php if($_SESSION["admin"] == "1") : ?>
            <a id="dodajDog" type="button" class="btn btn-primary" href="dodaj.php">Dodaj nov dogodek</a>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="script.js"></script>
