<?php
if ($_SERVER["HTTPS"] != "on") {

    header("Location: https://barka.foi.hr/WebDiP/2017_projekti/WebDiP2017x080/Prijava.php");
    exit();
}

require ("Baza.class.php");
$bp = new Baza();
$bp->spojiDB();

if ($bp->pogreskaDB()) {
    $poruka .= "Spajanje sa bazom nije uspješno!";
    $greska = true;
}
//$trenutniDatum=$bp->DohvatiVrijemePomaka();
//date_sub($trenutniDatum, INTERVAL 7 HOUR);
if (isset($_POST['slanje'])) {

    if (empty($_POST['korisnickoIme'])) {
        $korisnickoIme = "";
        echo "Nije uneseno korinsičko ime!\n";
    } else {
        $korisnickoIme = $_POST['korisnickoIme'];
        $provjeriKorIme = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime='$korisnickoIme'";
        $rezKorIme = $bp->selectDB($provjeriKorIme);

        if ($rezKorIme->num_rows < 1) {
            echo 'Ne postoji korisnik sa unesenim imenom!';
            
        }

        if ($rezKorIme->num_rows > 0) {
            $upitZaStatus = "SELECT status_potvrde FROM korisnik WHERE korisnicko_ime='$korisnickoIme'";
            $rezultatUpitaStatus = $bp->selectDB($upitZaStatus);
            $redak = $rezultatUpitaStatus->fetch_row();

            if ($redak[0] == 0) {
                echo 'Niste aktivirali racun';
                
            } 
            if ($redak[0]==1) {
                $unesenaLozinka="";
                if (empty($_POST['lozinka'])) {
                    echo 'Niste unijeli lozinku!';
                }
                else {
                    $unesenaLozinka=$_POST['lozinka'];
                }
                
                //Provjere za nastavak  prijave iznad
                
                $promasajiUpit="SELECT broj_promasaja FROM korisnik WHERE korisnicko_ime = '$korisnickoIme'";
                $rezultatPromasaja= $bp->selectDB($promasajiUpit);
                $zakljucan=$rezultatPromasaja->fetch_row();
                
                $lozinkaUpit="SELECT lozinka FROM korisnik WHERE korisnicko_ime = '$korisnickoIme'";
                $rezultatLozinke= $bp->selectDB($lozinkaUpit);
                $ProvjeraLozinke=$rezultatLozinke->fetch_row();
                
                $ulogaUpit="SELECT tip_korisnika FROM korisnik WHERE korisnicko_ime = '$korisnickoIme'";
                $rezultatUloga= $bp->selectDB($ulogaUpit);
                $uloga=$rezultatUloga->fetch_row();
                
                //prijava
                if ($zakljucan[0]<3 && $unesenaLozinka==$ProvjeraLozinke[0]) {
                    
                    session_start();
                    $_SESSION['korisnik']=$_POST['korisnickoIme'];
                    
                    $cookie_ime = "korisnik";
                    $cookie_vrijednos = $_POST['korisnickoIme'];
                    $pomakVrijeme=$bp->DohvatiVrijemePomaka();
                    setcookie($cookie_ime, $cookie_vrijednos, $pomakVrijeme + (86400 * 2), "/"); // 86400 = 1 dan
                    
                   
                    $upitDnevnik1 = "INSERT INTO dnevnik VALUES ('default','Prijava u sustav','$pomakVrijeme','$korisnickoIme')";
                    $bp->updateDB($upitDnevnik1);
                    
                    if ($uloga[0]==1) {
                        header("Location: Administrator.php");
                    }elseif ($uloga[0]==2) {
                        header("Location: Moderator.php");
                    } else {
                       header("Location: RegistriraniKorisnik.php"); 
                    }
                }
                elseif ($zakljucan[0]>=3 && $unesenaLozinka=$ProvjeraLozinke[0]) {
                    echo 'Unijeli ste lozinku 3 puta pogresno i racun vam je zakljucan!';
                
                }
                else {
                    $promasajiUpit="SELECT broj_promasaja FROM korisnik WHERE korisnicko_ime = '$korisnickoIme'";
                    
                    $rezultatUpitaPromasaji= $bp->selectDB($promasajiUpit);
                    
                    $provjeraPromasaja=$rezultatUpitaPromasaji->fetch_row();
                    
                    $brojacPromasaja=$provjeraPromasaja[0];
                    
                    $brojacPromasaja++;
                    
                    $pomakVrijeme=$bp->DohvatiVrijemePomaka();
                    $upitDnevnik2 = "INSERT INTO dnevnik VALUES ('default','Neuspjesna prijava','$pomakVrijeme','$korisnickoIme')";
                    $bp->updateDB($upitDnevnik2);
                    
                    if ($brojacPromasaja==3) {
                        $pomakVrijeme=$bp->DohvatiVrijemePomaka();
                        $upitDnevnik3 = "INSERT INTO dnevnik VALUES ('default','Racun je zakljucan','$pomakVrijeme','$korisnickoIme')";
                        $bp->updateDB($upitDnevnik3);
                    }
                    $updatePromasaja="UPDATE korisnik SET broj_promasaja = '$brojacPromasaja' WHERE korisnicko_ime = '$korisnickoIme'";
                    $bp->updateDB($updatePromasaja);
                    echo 'Pogresna lozinka';
//$db->exec("INSERT INTO foo (id, bar) VALUES (1, 'Test')");
//$stmt = $db->prepare('SELECT bar FROM foo WHERE id=:id');
//$stmt->bindValue(':id', 1, SQLITE3_INTEGER);
//$result = $stmt->execute();
                }
                
            }
        }
    }
}



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
        <meta name="description" content="Obrasci za prijavu">
        <link href="css/lukkristi.css" rel="stylesheet" type="text/css">                               


    </head>
    <body>
        <header>

            <h1 id="pocetak">Prijava</h1>
            <div class="lijevo" >
                <p class="grupa">Izbornik
                    <span class="datum"><?php $time=$bp->DohvatiVrijemePomaka(); echo "Datum i vrijeme virtualno: " . $time;?></span>
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
            <h2>Prijava</h2>            
            <form id="prijava" method="post" name="prijava" 
                  action="Prijava.php">
                <div class="blokForme">
                    <label for="korisnickoIme">Korisnicko ime: </label>
                    <input type="text"  id="korisnickoIme" name="korisnickoIme"   placeholder="Korisnicko ime" 
                           value="<?php if(isset($_COOKIE["korisnik"])) { echo $_COOKIE["korisnik"]; } ?>">  
                    <span id="greskaIme"> </span><br>
                </div><br>
                <div class="blokForme">
                    <label for="lozinka">Lozinka: </label>                
                    <input type="password"  class="" id="lozinka" name="lozinka"   placeholder="Lozinka" ><br>
                </div><br>           
                <a href="ZaboravljenaLozinka.php"<p>Zaboravljena lozinka?</p></a>
                <input type="submit" value=" Prijavi se " name="slanje">                
            </form>

        </section>        
        <footer>
            <p> 3 sata </p>
            <figure>
                <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2017%2Fzadaca_03%2Flukkristi%2FprijavaRegistracija.html">
                    <img src="slike/HTML5.png" width="100" alt="HTML5 validator">
                </a>
                <figcaption>HTML5 validator</figcaption>
            </figure> 
            <figure>
                <a href="https://jigsaw.w3.org/css-validator/validator?uri=http%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2017%2Fzadaca_03%2Flukkristi%2Fcss%2Flukkristi.css&profile=css3svg&usermedium=all&warning=1&vextwarning=&lang=de">
                    <img src="slike/CSS3.png" width="100" alt="CSS3 validator">
                </a>
                <figcaption>CSS3 validator</figcaption>
            </figure> 
            <address><strong>Kontakt: </strong><a href="lukkrsiti.foi.hr">Lukas Krištić</a></address>
            <p><small>&copy; 2018. L.Krištić</small></p>
        </footer>
    </body>
</html>

<?php

$bp->zatvoriDB();
?>