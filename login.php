<?php
require_once "KoncertBaza.php";
include "nav.php"; 
session_start();

$login = isset($_POST["username"]) && !empty($_POST["username"]) && 
        isset($_POST["pass"]) && !empty($_POST["pass"]);

if ($login) {
    try {
        $query = KonBaza::login($_POST["username"], $_POST["pass"]);
        if(!empty($query)){
            foreach($query as $row):
                $id = $row['id'];
                $geslo = $row['geslo'];
                $admin = $row['admin'];
            endforeach;
            if(password_verify($_POST["pass"], $geslo)) {
                $_SESSION["id"] = $id;
                $_SESSION["admin"] = $admin;
                header("Location: index.php");
            } 
            else{
                $errorMessage = "Napačno uporabniško ime ali geslo";
            }
        }
        else{
            $errorMessage = "Napačno uporabniško ime ali geslo";
        }
    } catch (Exception $e) {
        $errorMessage = "Database error occured: $e";
    }
}
?>
<body class="back">
<div id="prijava" class="win">
    <h2 class="form_header">PRIJAVA</h2>
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post" id="prijava_from">
        <div id="prijava_labels">
        <label for="username" class="loginL">Uporabniško ime:</label><br />
        <label for="pass">Geslo:</label>
        </div>
        <input type="text" name="username" id="username" class="prijava_input" autofocus /> <br/>
        <input type="password" name="pass" id="pass" class="prijava_input" /> <br/>

        <?php if (isset($errorMessage)): ?>
            <p class="error"><?= $errorMessage ?></p>
        <?php endif; ?>

        <button type="submit" class="btn btn-dark" id="prijava_button">Prijava</button>
    </form>
    <p id="nimam">Če še nimate računa se registrirajte <a href="register.php">tukaj</a></p>
</div>
</body>
</html>