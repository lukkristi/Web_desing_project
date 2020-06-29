<?php
require ("Baza.class.php");
$bp = new Baza();
$bp->spojiDB();

if ($bp->pogreskaDB()) {
    $poruka .= "Spajanje sa bazom nije uspješno!";
    $greska = true;
}

if (isset($_POST['slanjeLozinke'])) {

    if (empty($_POST['korisnickoIme1'])) 
    {
        echo "Morate popuniti polje za korisnicko ime";
    } 
    else {

        $korisnickoIme = $_POST['korisnickoIme1'];
        $upitkorime = "SELECT korisnicko_ime, email FROM korisnik WHERE korisnicko_ime = '$korisnickoIme'";
        $rezultatKorime = $bp->selectDB($upitkorime);
        $rezultati = $rezultatKorime->fetch_row();

        if ($rezultati[0] != $korisnickoIme) {
            echo "Pogrešno uneseno korisničko ime";
        } 
        elseif (!empty($_POST['mail']))
        {
            $drugiMail=$_POST['mail'];
            $novaLozinka = mt_rand(100000, 999999999);
            mail($drugiMail, "nova lozinka", $novaLozinka);
            $azurirajLozinku = "UPDATE korisnik SET lozinka = '$novaLozinka' WHERE korisnicko_ime = '$korisnickoIme'";
            $bp->updateDB($azurirajLozinku);

            $vrijeme=$bp->DohvatiVrijemePomaka();
            $dnevnik4 = "INSERT INTO dnevnik VALUES ('default','Nova lozinka','$vrijeme','$korisnickoIme')";
            $bp->updateDB($dnevnik4);
            header("Location: Prijava.php");
        }
        else 
        {
            $novaLozinka = mt_rand(100000, 999999999);
            mail($rezultati[1], "nova lozinka", $novaLozinka);
            $azurirajLozinku = "UPDATE korisnik SET lozinka = '$novaLozinka' WHERE korisnicko_ime = '$korisnickoIme'";
            $bp->updateDB($azurirajLozinku);

            $vrijeme=$bp->DohvatiVrijemePomaka();
            $dnevnik4 = "INSERT INTO dnevnik VALUES ('default','Nova lozinka','$vrijeme','$korisnickoIme')";
            $bp->updateDB($dnevnik4);
            header("Location: Prijava.php");
        }
    }
  
}


$bp->zatvoriDB();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Prijava</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Lukas Krištić">
        <meta name="title" content="Projekt">
        <meta name="date" content="28.05.2018">
        <meta name="description" content="Obrazac za zaboravljenu lozinku">
        <link href="css/lukkristi.css" rel="stylesheet" type="text/css">                               


    </head>
    <body>
        <header>

            <h1 id="pocetak">Zaboravljena lozinka</h1>
            <div class="lijevo" >
                <p class="grupa">Izbornik
                    <span class="datum">Datum: 27.05.2018. Vrijeme: 23:58</span>
                </p>                
            </div>
        </header>
        <nav>
            <ul>
                <li><a href="Index.php">Početna</a></li>                
                <li><a href="Registracija.php">Registracija</a></li>               
            </ul>
        </nav>
        <section>
            <h2>Zaboravljena lozinka</h2>            
            <form id="prijava" method="post" name="ZaboravljenaLozinka" 
                  action="ZaboravljenaLozinka.php">
                <div class="blokForme">
                    <label for="korisnickoIme1">Korisnicko ime: </label>
                    <input type="text"  id="korisnickoIme" name="korisnickoIme1"   placeholder="Korisnicko ime">                     
                </div><br>
                <div class="blokForme">
                    <p>Ako zelite da vam se na drugi mail posalje lozinka onda unesite dole mail inace ostavit prazno</p>
                    <label for="email">Lozinka: </label>                
                    <input type="email"  class="" id="lozinka" name="mail"   placeholder="email" ><br>
                </div><br>                          
                <input type="submit" value="Pošalji" name="slanjeLozinke">                
            </form>

        </section>        
        <footer>                       
            <address><strong>Kontakt: </strong><a href="lukkrsiti.foi.hr">Lukas Krištić</a></address>
            <p><small>&copy; 2018. L.Krištić</small></p>
        </footer>
    </body>
</html>