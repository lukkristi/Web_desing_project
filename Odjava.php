<?php

session_start();

require ("Baza.class.php");
$bp = new Baza();
$bp->spojiDB();

if ($bp->pogreskaDB()) {
    $poruka .= "Spajanje sa bazom nije uspješno!";
    $greska = true;
}

$korisnik = $_SESSION['korisnik'];

$vrijeme=$bp->DohvatiVrijemePomaka();
$upitDnevnik = "INSERT INTO dnevnik VALUES ('default','Odjava sa sustava','$vrijeme','$korisnik')";
$bp->updateDB($upitDnevnik);

$bp->zatvoriDB();

session_destroy();
echo 'Uspjesna odjava';
header("Location: Prijava.php");
?>

