<?php
require_once "KoncertBaza.php";
include "nav.php"; 

$reg = isset($_POST["username"]) && !empty($_POST["username"]) && 
        isset($_POST["name"]) && !empty($_POST["name"]) && 
        isset($_POST["surname"]) && !empty($_POST["surname"]) && 
        isset($_POST["pass"]) && !empty($_POST["pass"]);

if ($reg) {
    try {
        $check = KonBaza::checkuser($_POST["username"]);
        if($check["stevilo"] > 0){
            $errorMessage = "Uporabniško ime že obstaja";
        }
        else{
            $password = $_POST["pass"];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            KonBaza::newuser($_POST["name"], $_POST["surname"], $_POST["username"], $hashed_password);
            header("Location: index.php");
        }
    } catch (Exception $e) {
        $errorMessage = "Database error occured: $e";
    }
}
?>
<body class="back">
<div id="registracija" class="win">
    <h2 class="form_header">REGISTRACIJA</h2>
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post" id="prijava_from">
        <div id="reg_labels">
        <p><label for="name">Ime:</label></p>
        <p><label for="surname">Priimek:</label></p>
        <p><label for="username">Uporabniško ime:</label></p>
        <p><label for="pass">Geslo:</label></p>
        </div>
        <input type="text" name="name" id="name" class="reg_input" value="<?php if(isset($errorMessage)){echo($_POST["name"]);}?>" autofocus required /> <br/>
        <input type="text" name="surname" id="surname" class="reg_input" value="<?php if(isset($errorMessage)){echo($_POST["surname"]);}?>" required /> <br/>
        <input type="text" name="username" id="username" class="reg_input" value="<?php if(isset($errorMessage)){echo($_POST["username"]);}?>" required /> <br/>
        <input type="password" name="pass" id="pass" class="reg_input" minlength="8" required /> <br/>
        <button type="submit" class="btn btn-dark" id="reg_button">Registracija</button>
        <?php if (isset($errorMessage)): ?>
            <p class="error"><?= $errorMessage ?></p>
        <?php endif; ?>
    </form>
</div>
</body>
</html>