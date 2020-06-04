<?php
require_once ("KoncertBaza.php");
$output = '';
$vrednost = $_POST["vrednost"];
if($vrednost == "brez"){
    foreach (KonBaza::preberiVse() as $koncert) {
        $output .= '
        <div class="koncertOkno">
                    <h2 class="naslov"> '. $koncert["ime"] .'</h2>
                    <div class="podatki">
                        <p><b>Zvrst glasbe:</b> '.$koncert["zvrst"].'</p>
                        <p><b>Kraj dogodka:</b> '.$koncert["kraj"].'</p>
                        <p><b>Datum dogodka:</b> '.$koncert["datum"].' </p>
                        <p><b>Karta:</b> '.$koncert["cena"].'€</p>
                    </div>
                    <div class="gumbi">
                        <a type="button" class="btn btn-dark" href="podrobnosti.php?id='.$koncert["id"].'">Podrobnosti</a>
                    </div>
                </div>';
    }
}
else if($vrednost == "zvrst") {
    foreach (KonBaza::orderZvrst() as $koncert) {
        $output .= '
        <div class="koncertOkno">
                    <h2 class="naslov">'. $koncert["ime"] .'</h2>
                    <div class="podatki">
                        <p><b>Zvrst glasbe:</b>  '.$koncert["zvrst"].' </p>
                        <p><b>Kraj dogodka:</b>  '.$koncert["kraj"].' </p>
                        <p><b>Datum dogodka:</b> '.$koncert["datum"].' </p>
                        <p><b>Karta:</b> '.$koncert["cena"].'€</p>
                    </div>
                    <div class="gumbi">
                        <a type="button" class="btn btn-dark" href="podrobnosti.php?id='.$koncert["id"].'">Podrobnosti</a>
                    </div>
                </div>';
    }
}
else if($vrednost == "kraj") {
    foreach (KonBaza::orderKraj() as $koncert) {
        $output .= '
        <div class="koncertOkno">
                    <h2 class="naslov">'. $koncert["ime"] .'</h2>
                    <div class="podatki">
                        <p><b>Zvrst glasbe:</b>  '.$koncert["zvrst"].' </p>
                        <p><b>Kraj dogodka:</b>  '.$koncert["kraj"].' </p>
                        <p><b>Datum dogodka:</b> '.$koncert["datum"].' </p>
                        <p><b>Karta:</b> '.$koncert["cena"].'€</p>
                    </div>
                    <div class="gumbi">
                        <a type="button" class="btn btn-dark" href="podrobnosti.php?id='.$koncert["id"].'">Podrobnosti</a>
                    </div>
                </div>';
    }
}
echo $output;