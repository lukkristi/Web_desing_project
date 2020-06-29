<?php
//header("Location: http://barka.foi.hr/WebDiP/pomak_vremena/vrijeme.html");
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
        header("Location: http://barka.foi.hr/WebDiP/pomak_vremena/vrijeme.html");
    } else {
        header("Refresh: 1; url=Index.php");
}}
  
?>
