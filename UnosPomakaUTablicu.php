<?php
require ("Baza.class.php");
$bp = new Baza();
$bp->spojiDB();

if ($bp->pogreskaDB()) {
    $poruka .= "Spajanje sa bazom nije uspješno!";
    $greska = true;
}

if (!isset($_SESSION['korisnik'])) {
    session_start();
    $korisnik = $_SESSION['korisnik'];

    $provjeraKorisnikaUpit = "SELECT tip_korisnika FROM korisnik WHERE korisnicko_ime = '$korisnik'";
    $rezultatKorisnika = $bp->selectDB($provjeraKorisnikaUpit);
    $bazaKorisnik = $rezultatKorisnika->fetch_row();

    if ($bazaKorisnik[0] == 1) {
        $korisnik = $_SESSION['korisnik'];
        echo 'Dobro dosli Admine: ' . $korisnik;

        $url = "http://barka.foi.hr/WebDiP/pomak_vremena/pomak.php?format=xml";

        if (!($fp = fopen($url, 'r'))) {
            echo "Problem: nije moguće otvoriti url: " . $url;
            exit;
        }

// XML data
        $xml_string = fread($fp, 10000);
        fclose($fp);

// create a DOM object from the XML data
        $domdoc = new DOMDocument;
        $domdoc->loadXML($xml_string);

        $params = $domdoc->getElementsByTagName('brojSati');
        $sati = 0;

        if ($params != NULL) {
            $sati = $params->item(0)->nodeValue;

            //UNOSIO VRIJEME U BAZU
//    $vrijeme_servera1 = time();
//    $vrijeme_sustavaNovo = $vrijeme_servera1 + ($sati * 60 * 60);
//
//    $parsiranje= date('Y-m-d H:i:s', $vrijeme_sustavaNovo);    
            $upitPomak = "INSERT INTO konfiguracija_sustava VALUES (default,'$sati')";
            $bp->updateDB($upitPomak);
            header("Refresh: 5; url=Administrator.php");
        }
    } else {
        header("Refresh: 1; url=Index.php");
    }
}
//$url = "http://barka.foi.hr/WebDiP/pomak_vremena/pomak.php?format=xml";
//
//if (!($fp = fopen($url, 'r'))) {
//    echo "Problem: nije moguće otvoriti url: " . $url;
//    exit;
//}
//
//// XML data
//$xml_string = fread($fp, 10000);
//fclose($fp);
//
//// create a DOM object from the XML data
//$domdoc = new DOMDocument;
//$domdoc->loadXML($xml_string);
//
//$params = $domdoc->getElementsByTagName('brojSati');
//$sati = 0;
//
//if ($params != NULL) {
//    $sati = $params->item(0)->nodeValue;
//    
//    //UNOSIO VRIJEME U BAZU
////    $vrijeme_servera1 = time();
////    $vrijeme_sustavaNovo = $vrijeme_servera1 + ($sati * 60 * 60);
////
////    $parsiranje= date('Y-m-d H:i:s', $vrijeme_sustavaNovo);    
//    $upitPomak="INSERT INTO konfiguracija_sustava VALUES (default,'$sati')";
//    $bp->updateDB($upitPomak);
//}
//$vrijeme_servera1 = time();
//$vrijeme_sustavaNovo = $vrijeme_servera + ($sati * 60 * 60);
//$upitPomak="INSERT INTO konfiguracija_sustava VALUES (default,'$vrijeme_sustavaNovo')";
//$bp->updateDB($upitPomak);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Virtualno vrijeme sustava</title>
        <meta charset="utf-8">
    </head>
<?php
$vrijeme_servera = time();
$vrijeme_sustava = $vrijeme_servera + ($sati * 60 * 60);
echo "Stvarno vrijeme servera: " . date('d.m.Y H:i:s', $vrijeme_servera) . "<br>";
echo "Virtualno vrijeme sustava: " . date('d.m.Y H:i:s', $vrijeme_sustava) . "<br>";
?>
</body>
</html>
