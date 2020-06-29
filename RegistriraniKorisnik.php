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
    
    $idKorisnikaUpit = "SELECT id FROM korisnik WHERE korisnicko_ime = '$korisnik'";
    $rezultatIdKorisnika = $bp->selectDB($idKorisnikaUpit);
    $bazaIdKorisnik = $rezultatIdKorisnika->fetch_row();
    
    
        $podaciOKorisnikuUpit = "SELECT ime,prezime,korisnicko_ime,email FROM korisnik WHERE korisnicko_ime = '$korisnik'";
        $rezultatPodataka = $bp->selectDB($podaciOKorisnikuUpit);
        $podaciOkorisniku = $rezultatPodataka->fetch_row();
        $podaciOglasUpit = "SELECT * FROM oglas";
        
        if (isset($_GET['stranicenje2'])) {

                    $pageOglas = $_GET['stranicenje2'];

                    if ($pageOglas <= "1") {
                        $pageOglas1 = 0;
                    } else {
                        $pageOglas1 = ($pageOglas * 10) - 10;
                    }
                } else {
                    $pageOglas1 = 0;
                    $pageOglas = 0;
                }

                
                $podaciOglas = $bp->selectDB($podaciOglasUpit);
                $brojPodatakaOglas = $podaciOglas->num_rows;

                //zaokruzujem na veci broj sa ceil
                $stranice2 = ceil($brojPodatakaOglas / 10);

                if ($pageOglas1 >= 10) {
                    $nazad2 = $pageOglas1 / 10;
                } else {
                    $nazad2 = 0;
                }

//                if ($pageOglas1 == "0" || $pageOglas1 == "1") {
//                    $dalje2 = 2;
//                }
                if ((($pageOglas1 + 10) / 10) + 1 >= $stranice2) {
                    $dalje2 = $stranice2;
                } else {
                    $dalje2 = (($pageOglas1 + 10) / 10) + 1;
                }
        
        

    if ($bazaKorisnik[0] == 1 ) {
        $korisnik1 = $_SESSION['korisnik'];
        echo 'Dobro dosli Admine: ' . $korisnik1;        
        $SviOglasiUpit="SELECT * FROM oglas o, korisnik k WHERE k.id=o.oglas_predlozio LIMIT $pageOglas1,10";
        $podaciOglasUpit = "SELECT * FROM oglas";
        
    }elseif ($bazaKorisnik[0] == 2) {
        $korisnik1 = $_SESSION['korisnik'];
        echo 'Dobro dosli Moderatoru: ' . $korisnik1;        
        $SviOglasiUpit="SELECT * FROM oglas o, korisnik k WHERE k.id=o.oglas_predlozio LIMIT $pageOglas1,10";
        $podaciOglasUpit = "SELECT * FROM oglas";
    }
    elseif ($bazaKorisnik[0] == 3) {
            $korisnik1 = $_SESSION['korisnik'];
            echo 'Dobro dosli Korisnice: ' . $korisnik1;
            $SviOglasiUpit="SELECT o.naslov, o.broj_klikova FROM oglas o, korisnik k WHERE k.id=o.oglas_predlozio AND k.id='$bazaIdKorisnik[0]'";
            $podaciOglasUpit = "SELECT * FROM oglas o, korisnik k WHERE k.id=o.oglas_predlozio AND k.id='$bazaIdKorisnik[0]'";
}
    else {
        header("Refresh: 1; url=Index.php");
    }
    
    
}

?>
<html>
    <head>
        <title>Početna stranica</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Lukas Krištić">
        <meta name="title" content="Projekt">
        <meta name="date" content="07.06.2018">
        <meta name="description" content="Registrirani korisnik">
        <link href="css/lukkristi.css" rel="stylesheet" type="text/css">  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    </head>
    <body>

        <header>

            <h1 id="pocetak">Registrirani Korisnik</h1>
            <div class="lijevo" >
                <p class="grupa">Izbornik
                    <span class="datum">Datum: 17.03.2018. Vrijeme: 18:30</span>
                </p>
                <a class="desno" href="Odjava.php">Odjava</a>
                <br>                
            </div>
        </header>

        <div>
            <nav id="navigacija">
                <ul>
                    <li><a href="Index.php">Početna</a></li>                                       
                    <li><a href="Dokumentacija.html">Dokumentacija</a></li>
                    <li><a href="O_autoru.html">O autoru</a></li>
                    <li><a href="Odjava.php">Odjava</a></li>                    
                </ul>
            </nav>
            <div>
                <ol type="I" style="display: inline-block">
                    <li> <?php echo $podaciOkorisniku[0]; ?></li>
                    <li><?php echo $podaciOkorisniku[1]; ?></li>
                    <li><?php echo $podaciOkorisniku[2]; ?></li>
                    <li><?php echo $podaciOkorisniku[3]; ?></li>            
                </ol>
            </div>
        </div>
        <br><br><br><br><br><br><br>
        <div class="Responzivni">
            <?php
            $oglasiUpit = "SELECT * FROM oglas WHERE status = '1' ";
            $rezOglasiUpit = $bp->selectDB($oglasiUpit);            
            
            echo '<form name="PrijaviOglas" action="RegistriraniKorisnik.php" method="POST">
                <table class="smanji" align=center border=6 cellpadding=3>
                    <tr align=center><td colspan=2><h2>Prijavi oglas</h2></td><tr>
                    <tr>
                        <th width="50%">Razlog</th>
                        <th width="50%">Naziv oglasa</th>                                              
                   </tr>
                    <tr align=center><td><input type="text" name="razlog" size="30" placeholder="razlog"></td>
                    
                        
                    <td><select name="nazivOglasa">';

                    while ($red5 = $rezOglasiUpit->fetch_assoc()) {

            
                    $naslovOglasa = $red5['naslov'];
                    $idOglasa = $red5['id'];
        
                    echo '<option value="'.$idOglasa.'">'.$naslovOglasa.'</option>';        
                    }     
                    echo "</select></td></tr>
                        <tr align=center><td colspan=2><input type=submit value='Posalji' name='PrijavaOglasa'></td>
                        </form>
                    </table>";
                    
                    if (isset($_POST['PrijavaOglasa'])) {
                        
                        if (empty($_POST['nazivOglasa']) || empty($_POST['razlog']) ) {
                        echo 'Niste unijeli sve podatke!';
                                      
                    } else {
                        
                        $odabraniOglas=$_POST['nazivOglasa'];
                        $razlog=$_POST['razlog'];
                                                                      
                        
                        $unesiPrijavuUpit="INSERT INTO prijaveljni_oglas VALUES ('$bazaIdKorisnik[0]','$odabraniOglas','$razlog')";
                        if ($bp->updateDB($unesiPrijavuUpit)) {
                        echo 'Prijavili ste oglas';
                        $vrijeme=$bp->DohvatiVrijemePomaka();
                        $dnevnik8 = "INSERT INTO dnevnik VALUES ('default','Prijava oglasa','$vrijeme','$korisnik')";
                        $bp->updateDB($dnevnik8);
                        }
                    }
                                                                                                               
                }                                                                                        
            ?>
        </div>
        <div class="Responzivni">
                <?php
//                if (isset($_GET['stranicenje2'])) {
//
//                    $pageOglas = $_GET['stranicenje2'];
//
//                    if ($pageOglas <= "1") {
//                        $pageOglas1 = 0;
//                    } else {
//                        $pageOglas1 = ($pageOglas * 10) - 10;
//                    }
//                } else {
//                    $pageOglas1 = 0;
//                    $pageOglas = 0;
//                }
//
//                
//                $podaciOglas = $bp->selectDB($podaciOglasUpit);
//                $brojPodatakaOglas = $podaciOglas->num_rows;
//
//                //zaokruzujem na veci broj sa ceil
//                $stranice2 = ceil($brojPodatakaOglas / 10);
//
//                if ($pageOglas1 >= 10) {
//                    $nazad2 = $pageOglas1 / 10;
//                } else {
//                    $nazad2 = 0;
//                }
//
////                if ($pageOglas1 == "0" || $pageOglas1 == "1") {
////                    $dalje2 = 2;
////                }
//                if ((($pageOglas1 + 10) / 10) + 1 >= $stranice2) {
//                    $dalje2 = $stranice2;
//                } else {
//                    $dalje2 = (($pageOglas1 + 10) / 10) + 1;
//                }


                if (isset($_GET['sortiranje1'])) {
                    $sortiranjeTabliceKlikovi = $_GET['sortiranje1'];
                    
                } else {
                    $sortiranjeTabliceKlikovi = "";
                }

                




                if ($bazaKorisnik[0] == 3){
                    if ($sortiranjeTabliceKlikovi == "Klikovi") {

                        $SviOglasiUpit = "SELECT o.naslov, o.broj_klikova FROM oglas o, korisnik k WHERE k.id=o.oglas_predlozio AND k.id='$bazaIdKorisnik[0]' ORDER BY 2 LIMIT $pageOglas1,10";
                    }
                    if (!empty($_POST['poTipupretraga'])) {
                        $nazivTipa_oglasa = $_POST['poTipupretraga'];
                        $SviOglasiUpit="SELECT o.naslov, o.broj_klikova FROM oglas o, korisnik k, tip_oglasa tip WHERE k.id=o.oglas_predlozio AND o.tip_oglasa=tip.id AND tip.naziv LIKE '$nazivTipa_oglasa%' AND k.id='13' ORDER BY 2"; 
                    
                    } 
                }        

                  $rezStatistikaKlikovaUpit1 = $bp->selectDB($SviOglasiUpit);
            
                echo '<form name="statistikaKlikova" action="RegistriraniKorisnik.php" method="POST">
                <table class="smanji" align=center border=6 cellpadding=3>
                    <tr align=center><td colspan=2><h2>Moji Oglasi</h2></td><tr>
                    
                    <tr align=center><td>Sortiraj po:</td>
                    <td colspan=2 >Pretaga po tipu</td>                                     
                    <tr><td><a href=RegistriraniKorisnik.php?sortiranje1=Klikovi style=text-decoration:none>Klikovi</a></td>
                    <td colspan=2><input type="text" name="poTipupretraga" size="15" placeholder="Naziv tipa"></td>                    
                                           
                        <tr>
                        <th width="70%">Naziv Oglasa</th>
                        <th width="30%">Broj Klikova</th>                                              
                        </tr>';               
                while ($red3 = $rezStatistikaKlikovaUpit1->fetch_assoc()) {


                    $nazaiv = $red3['naslov'];
                    $brojklik = $red3['broj_klikova'];                   

                    echo "<tr align=center><td>$nazaiv</td>"
                    . "<td>$brojklik</td>"
                
                    . "</tr>";
                }
                echo "<tr  align=center><td colspan=4>
                     <a href='RegistriraniKorisnik.php?stranicenje2=1' >PRVA</a>
                     <a href='RegistriraniKorisnik.php?stranicenje2=$dalje2' >sljedeća</a>
                     <a href='RegistriraniKorisnik.php?stranicenje2=$nazad2' >prethodna</a>    
                     <a href='RegistriraniKorisnik.php?stranicenje2=$stranice2'>ZADNJA</a></td>
                         
            <tr align=center><td colspan=2><input type=submit value='Pretraži' name='pretragaPoKorisniku'></td>
        </form>
    </table>";
                ?>
            </div>
        
        
        
        
        </body>
</html>

<?php
$bp->zatvoriDB();
?>
