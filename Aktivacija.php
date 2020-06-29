<?php

require ("Baza.class.php");
$bp = new Baza();
$bp->spojiDB();

if ($bp->pogreskaDB()) {
    $poruka .= "Spajanje sa bazom nije uspješno!";
    $greska = true;
}

$generiraniKod = $_GET['aktivacijskiKod'];
$upitJelAktiviran = "SELECT status_potvrde FROM korisnik WHERE aktivacijski_kod='$generiraniKod';";
$rezultat = $bp->selectDB($upitJelAktiviran);

$jeliAktiviran = $rezultat->fetch_array();

if ($jeliAktiviran[0] == 1) {
    echo "Vec ste aktivirali korisnicki racun i sada cemo vas preusmjeriti na prijavu";
    header("Refresh: 5; url=Prijava.php");
    exit;
}

//$trenutniDatum = date('Y-m-d H:i:s');
$trenutniDatum=$bp->DohvatiVrijemePomaka();
$upitVrijeme = "SELECT vrijeme_prijave FROM korisnik WHERE aktivacijski_kod = '$generiraniKod' AND vrijeme_prijave > DATE_SUB('$trenutniDatum', INTERVAL 7 HOUR)";
$rezultatVrijeme = $bp->selectDB($upitVrijeme);

if ($rezultatVrijeme->num_rows > 0) { //ako postoji
    $promjenaStatusa = "UPDATE korisnik SET status_potvrde = '1' WHERE aktivacijski_kod = '$generiraniKod'";
    $bp->updateDB($promjenaStatusa);

    echo "Uspjesno ste aktivirali korisnicki racun i preusmjeravamo vas na prijavu!";
    header("Refresh: 5; url=Prijava.php");
} else {
    die("Zao nam je, link je istekao. Registrirajte se ponovno.");
    header("Refresh: 5; url=Registracija.php");
}







$bp->zatvoriDB();
?>

