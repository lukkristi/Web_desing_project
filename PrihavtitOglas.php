<?php
require ("Baza.class.php");
$bp = new Baza();
$bp->spojiDB();

if ($bp->pogreskaDB()) {
    $poruka .= "Spajanje sa bazom nije uspješno!";
    $greska = true;
}

if(empty($_GET['status'])){
	$idOglas1=$_GET['id_oglas'];
	$otkljucajKorisnika = "UPDATE oglas SET status = '1' WHERE id = '$idOglas1' ";
	$bp->updateDB($otkljucajKorisnika);
        echo 'JA radim da dopustim oglas';
        header("Refresh: 3; url=Moderator.php");
}

if(isset($_GET['status'])){

	$idOglas1=$_GET['id_oglas'];

	$zakljucajKorisnika = "UPDATE oglas SET status = '99' WHERE id = '$idOglas1' ";
	$bp->updateDB($zakljucajKorisnika);
        echo 'JA radim da odbijem oglas';
        header("Refresh: 3; url=Moderator.php");
}

if(isset($_GET['blokiraj'])){

	$idOglas1=$_GET['id_oglas'];
        $id_kor=$_GET['id_kor'];
        $upitKor="SELECT email FROM korisnik WHERE id='$id_kor'";
        $rezupitKor = $bp->selectDB($upitKor);
        $bazaIdKorisnik = $rezupitKor->fetch_row();
       
        mail($bazaIdKorisnik[0], "OGLAS VAM JE BLOKIRAN","Zbog prijava smo vma blokirali oglas");
        

	$zakljucajKorisnika = "UPDATE oglas SET status = '99' WHERE id = '$idOglas1' ";
	$bp->updateDB($zakljucajKorisnika);
        echo 'JA radim da blokiram prijavljeni oglas';
        header("Refresh: 3; url=Moderator.php");
}


$bp->zatvoriDB();
?>