<?php
//$dir = dirname(__FILE__);
//echo "<p>Full path to this dir: " . $dir . "</p>";
//echo "<p>Full path to a .htpasswd file in this dir: " . $dir . "/.htpasswd" . "</p>";
//Kod za putanju u htaccessu

header('Content-Type: text/html; charset=utf-8');
require ("/var/www/webdip.barka.foi.hr/2017_projekti/WebDiP2017x080/Baza.class.php");
$bp = new Baza();
$bp->spojiDB();

if ($bp->pogreskaDB()) {
    $poruka .= "Spajanje sa bazom nije uspješno!";
    $greska = true;
}

$korisnikInfoDaj = "SELECT k.ime, k.prezime, k.korisnicko_ime,k.lozinka, t.naziv FROM korisnik k, tip_korisnika t WHERE k.tip_korisnika=t.id";
$rezultatKorisnik = $bp->selectDB($korisnikInfoDaj);


while ($row = mysqli_fetch_array($rezultatKorisnik)) {
    
    echo "Ime: " . $row['ime'] ."<br>". "Prezime: " . $row['prezime'] ."<br>" . "Korisnicko ime:  " . $row['korisnicko_ime']."<br>". "Lozinka: " .$row['lozinka']."<br>"."Tip korisnika: ".$row['naziv']."<br><br><br>";
}

$bp->zatvoriDB();

//$name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
//echo 'Echo: '. htmlspecialchars($name, ENT_COMPAT, 'UTF-8');
?>
