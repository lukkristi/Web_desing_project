<?php
require ("Baza.class.php");
$bp = new Baza();
$bp->spojiDB();

if ($bp->pogreskaDB()) {
    $poruka .= "Spajanje sa bazom nije uspješno!";
    $greska = true;
}

if(empty($_GET['status'])){
	$idKorisnik=$_GET['id_korisnik'];
	$otkljucajKorisnika = "UPDATE korisnik SET broj_promasaja = '0' WHERE id = '$idKorisnik' ";
	$bp->updateDB($otkljucajKorisnika);
        echo 'JA radim da otkljucam';
        header("Refresh: 3; url=Administrator.php");
}

if(isset($_GET['status'])){

	$idKorisnik=$_GET['id_korisnik'];

	$zakljucajKorisnika = "UPDATE korisnik SET broj_promasaja = '3' WHERE id = '$idKorisnik' ";
	$bp->updateDB($zakljucajKorisnika);
        echo 'JA radim da zakljucam';
        header("Refresh: 3; url=Administrator.php");
}


$bp->zatvoriDB();

?>

