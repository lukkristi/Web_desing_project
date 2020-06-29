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

    if ($bazaKorisnik[0] == 1) {
        $korisnik = $_SESSION['korisnik'];
        echo 'Dobro dosli Admine: ' . $korisnik;
        $podaciOKorisnikuUpit = "SELECT ime,prezime,korisnicko_ime,email FROM korisnik WHERE korisnicko_ime = '$korisnik'";
        $rezultatPodataka = $bp->selectDB($podaciOKorisnikuUpit);
        $podaciOkorisniku = $rezultatPodataka->fetch_row();
    } else {
        header("Refresh: 1; url=Index.php");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Početna stranica</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Lukas Krištić">
        <meta name="title" content="Projekt">
        <meta name="date" content="07.06.2018">
        <meta name="description" content="Administrator stranica">
        <link href="css/lukkristi.css" rel="stylesheet" type="text/css">  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    </head>
    <body>

        <header>

            <h1 id="pocetak">Statsitika klikova</h1>
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
                    <li><a href="Moderator.php">Moderator</a></li>
                    <li><a href="Administrator.php">Administrator</a></li>
                    <li><a href="Dokumentacija.html">Dokumentacija</a></li>
                    <li><a href="O_autoru.html">O autoru</a></li>
                    <li><a href="RegistriraniKorisnik.php">Registrirani korisnik</a></li>
                    <li><a href="StatistikaKlikova.php">Statistika Klikova</a></li>
                    <li><a href="StatistikaPlacenihOglasa.php">Statistika Placenih oglasa</a></li>
                    <li><a href="PostaviVrijemeAplikacije.php">Postavi vrijeme</a></li>
                    <li><a href="UnosPomakaUTablicu.php">Unesi vrijeme</a></li>
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
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <div class="Responzivni">
                <?php
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

                $podaciOglasUpit = "SELECT * FROM oglas";
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


                if (isset($_GET['sortiranje1'])) {
                    $sortiranjeTabliceOglas = $_GET['sortiranje1'];
                    if ($sortiranjeTabliceOglas == "oglasID") {

                        $_SESSION['sortiranje1'] = $sortiranjeTabliceOglas;
                    }

                    if ($sortiranjeTabliceOglas == "Klikovi") {
                        $_SESSION['sortiranje1'] = $sortiranjeTabliceOglas;
                    }
                } else {
                    $sortiranjeTabliceOglas = "";
                }

                if (!empty($_POST['poKorisnikuPretraga1'])) {
                    $racuniKorisnik1 = $_POST['poKorisnikuPretraga1'];
                } else {
                    $racuniKorisnik1 = "";
                }

                if (empty($_POST['poKorisnikuPretraga1'])) {
                    $StatistikaKlikovaUpit = "SELECT * FROM oglas ORDER BY '$sortiranjeTabliceOglas' LIMIT $pageOglas1,10";
                }


                if ($sortiranjeTabliceOglas == "oglasID") {

                    $StatistikaKlikovaUpit = "SELECT * FROM oglas ORDER BY id LIMIT $pageOglas1,10";
                }
                if ($sortiranjeTabliceOglas == "Klikovi") {

                    $StatistikaKlikovaUpit = "SELECT * FROM oglas ORDER BY broj_klikova DESC LIMIT $pageOglas1,10";
                } else {
                    $StatistikaKlikovaUpit = "SELECT o.* FROM oglas o,korisnik k WHERE  
			      k.korisnicko_ime LIKE '$racuniKorisnik1%' AND k.id=o.oglas_predlozio ORDER BY o.id LIMIT $pageOglas1,10";
                }


//            $StatistikaKlikovaUpit="SELECT * FROM oglas WHERE status='1' LIMIT $pageOglas1,10";
                $rezStatistikaKlikovaUpit = $bp->selectDB($StatistikaKlikovaUpit);
                echo '<form name="statistika" action="StatistikaKlikova.php" method="POST">
                <table class="smanji" align=center border=6 cellpadding=3>
                    <tr align=center><td colspan=4><h2>Statistika klikova oglasa</h2></td><tr>

                    <tr align=center><td colspan=2>Sortiraj po:</td>
                    <td colspan=2 >Pretražite korisnike</td>                  
                    <tr align=center><td><a class=link  href=StatistikaKlikova.php?sortiranje1=oglasID style=text-decoration:none>ID</a></td>
                    <td><a href=StatistikaKlikova.php?sortiranje1=Klikovi style=text-decoration:none>Klikovi</a></td>
                    <td colspan=2><input type="text" name="poKorisnikuPretraga1" size="15" placeholder="Korisničko ime"></td>                    
                                           
                        <tr>
                        <th width="5%">ID</th>
                        <th width="30%">Naslov</th>                       
                        <th width="60%">Opis</th>
                        <th width="5%">Broj klikova</th>
                        </tr>';

                while ($red2 = $rezStatistikaKlikovaUpit->fetch_assoc()) {


                    $naslov = $red2['naslov'];
                    $id = $red2['id'];
                    $text = $red2['tekst'];
                    $brojKlikova = $red2['broj_klikova'];

                    echo "<tr class=red align=center><td>$id</td>"
                    . "<td>$naslov</td>"
                    . "<td>$text</td>
                <td>$brojKlikova</td>"
                    . "</tr>";
                }
                echo "<tr  align=center><td colspan=4>
                     <a href='StatistikaKlikova.php?stranicenje2=1' >PRVA</a>
                     <a href='StatistikaKlikova.php?stranicenje2=$dalje2' >sljedeća</a>
                     <a href='StatistikaKlikova.php?stranicenje2=$nazad2' >prethodna</a>    
                     <a href='StatistikaKlikova.php?stranicenje2=$stranice2'>ZADNJA</a></td>
                         
            <tr align=center><td><input type=submit value='Pretraži' name='pretraga'></td>
        </form>
    </table>";
                ?>
            </div>

    </body>
</html>
<?php
$bp->zatvoriDB();
?>

