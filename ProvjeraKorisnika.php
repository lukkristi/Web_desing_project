<?php

require ("Baza.class.php");
$bp = new Baza();
$bp->spojiDB();

if ($bp->pogreskaDB()) {
    $poruka .= "Spajanje sa bazom nije uspješno!";
    $greska = true;
}

$korime=$_POST['korime'];

$upitKorime = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime='$korime'";
$korimeRez = $bp->selectDB($upitKorime);
$numberow = $korimeRez->num_rows;
if ($numberow > 0) {
    echo "<font color='red'>KORISNICKO IME POSTOJI VEC! PROMJENI TE GA</font>";
} else {
    echo "<font color='green'>Korisnicko ime je uredu</font>";
}


$bp->zatvoriDB();
?>


