<?php
session_start();
if(!isset($_SESSION["id"])){
    throw new Exception("Login required.");
}
require_once "KoncertBaza.php";
include "nav.php"; 

try {
    $query = KonBaza::profilEdit($_SESSION["id"]);
    foreach($query as $row):
        $ime = $row['ime'];
        $priimek = $row['priimek'];
        $username = $row['uporabnisko_ime'];
    endforeach;
}
catch (Exception $e) {
    $errorMessage = "Database error occured: $e";
}
?>
<body class="back">
<?php if(isset($errorMessage)) : ?>
    <p><?= $errorMessage ?></p>
<?php endif; ?>

<div id="profil" class="win">
    <img src="avatar.png" alt="" id="avatar">
    <p>Ime: <?= $ime ?></p>
    <p>Priimek: <?= $priimek ?></p>
    <p>Uporabniško ime: <?= $username ?></p>
    <p>Admin: <?php if($_SESSION["admin"] == "1") { echo "Da"; } else { echo "Ne"; }?> </p>
    <a type="button" class="btn btn-dark" href="osebneRez.php">Moje rezervacije</a>
</div>
</body>