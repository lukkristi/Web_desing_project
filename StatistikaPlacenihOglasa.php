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
//$StatistikaKlikovaUpit1 = "SELECT tip.naziv,COUNT(o.id)*tip.cijena AS 'naslov' FROM tip_oglasa tip INNER JOIN oglas o ON tip.id=o.tip_oglasa GROUP BY 1 ";
//$rezStatistikaKlikovaUpit1 = $bp->selectDB($StatistikaKlikovaUpit1);
// while ($red3 = $rezStatistikaKlikovaUpit1->fetch_assoc()) {
//     $nazaiv = $red3['naziv'];
//     $iznos = $red3['naslov'];
//     echo $nazaiv."   ".$iznos;
//     
// }

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

                if ($pageOglas1 == "0" || $pageOglas1 == "1") {
                    $dalje2 = 2;
                }
                if ((($pageOglas1 + 10) / 10) + 1 >= $stranice2) {
                    $dalje2 = $stranice2;
                } else {
                    $dalje2 = (($pageOglas1 + 10) / 10) + 1;
                }


                if (isset($_GET['sortiranje1'])) {
                    $sortiranjeTabliceKlikovi = $_GET['sortiranje1'];
                    
                } else {
                    $sortiranjeTabliceKlikovi = "";
                }

                if (!empty($_POST['poTipupretraga'])) {
                    $nazivTipa_oglasa = $_POST['poTipupretraga'];
                } else {
                    $nazivTipa_oglasa = "";
                }

//                if (empty($_POST['poTipupretraga'])) {
//                    $StatistikaKlikovaUpit1 = "SELECT tip.naziv,COUNT(o.id)*tip.cijena AS 'Iznos' FROM tip_oglasa tip, oglas o WHERE tip.id=o.tip_oglasa AND o.status='1' AND tip.naziv LIKE '$nazivTipa_oglasa%'  GROUP BY 1 LIMIT $pageOglas1,10";
//                }


                
                if ($sortiranjeTabliceKlikovi == "Klikovi") {

                    $StatistikaKlikovaUpit1 = "SELECT tip.naziv,COUNT(o.id)*tip.cijena AS 'Iznos' FROM tip_oglasa tip, oglas o WHERE tip.id=o.tip_oglasa AND o.status='1' AND tip.naziv LIKE '$nazivTipa_oglasa%' GROUP BY 1 ORDER BY 2 DESC LIMIT $pageOglas1,10";
                }
                elseif ($sortiranjeTabliceKlikovi == "tipOglasID") {
                       $StatistikaKlikovaUpit1 = "SELECT tip.naziv,COUNT(o.id)*tip.cijena AS 'Iznos' FROM tip_oglasa tip, oglas o WHERE tip.id=o.tip_oglasa AND o.status='1' AND tip.naziv LIKE '$nazivTipa_oglasa%' GROUP BY 1 ORDER BY tip.id ASC LIMIT $pageOglas1,10";
                
                }
                else {
                    $StatistikaKlikovaUpit1 = "SELECT tip.naziv,COUNT(o.id)*tip.cijena AS 'Iznos' FROM tip_oglasa tip, oglas o WHERE tip.id=o.tip_oglasa AND o.status='1' AND tip.naziv LIKE '$nazivTipa_oglasa%'
                            GROUP BY 1 LIMIT $pageOglas1,10";
                }

                        
//                $StatistikaKlikovaUpit1 = "SELECT tip.naziv,COUNT(o.id)*tip.cijena AS 'Iznos' FROM tip_oglasa tip, oglas o WHERE tip.id=o.tip_oglasa AND o.status='1' GROUP BY 1 ORDER BY 2 DESC LIMIT $pageOglas1,10";
                $rezStatistikaKlikovaUpit1 = $bp->selectDB($StatistikaKlikovaUpit1);
            
                echo '<form name="statistikaKlikova" action="StatistikaPlacenihOglasa.php" method="POST">
                <table class="smanji" align=center border=6 cellpadding=3>
                    <tr align=center><td colspan=4><h2>Statistika klikova po tipu oglasa</h2></td><tr>

                    <tr align=center><td colspan=2>Sortiraj po:</td>
                    <td colspan=2 >Pretražite po tipu oglasa</td>                  
                    <tr align=center><td><a  href=StatistikaPlacenihOglasa.php?sortiranje1=tipOglasID style=text-decoration:none>ID</a></td>
                    <td><a href=StatistikaPlacenihOglasa.php?sortiranje1=Klikovi style=text-decoration:none>Klikovi</a></td>
                    <td colspan=2><input type="text" name="poTipupretraga" size="15" placeholder="Naziv tipa"></td>                    
                                           
                        <tr>
                        <th width="70%">Naziv kategorije</th>
                        <th width="30%">Iznos</th>                                              
                        </tr>';               
                while ($red3 = $rezStatistikaKlikovaUpit1->fetch_assoc()) {


                    $nazaiv = $red3['naziv'];
                    $iznos = $red3['Iznos'];                   

                    echo "<tr align=center><td>$nazaiv</td>"
                    . "<td>$iznos</td>"
                
                    . "</tr>";
                }
                echo "<tr  align=center><td colspan=4>
                     <a href='StatistikaPlacenihOglasa.php?stranicenje2=1' >PRVA</a>
                     <a href='StatistikaPlacenihOglasa.php?stranicenje2=$dalje2' >sljedeća</a>
                     <a href='StatistikaPlacenihOglasa.php?stranicenje2=$nazad2' >prethodna</a>    
                     <a href='StatistikaPlacenihOglasa.php?stranicenje2=$stranice2'>ZADNJA</a></td>
                         
            <tr align=center><td colspan=2><input type=submit value='Pretraži' name='pretraga'></td>
        </form>
    </table>";
                ?>
            </div>
        
        
        <div class="Responzivni">
                <?php
                
                if (isset($_GET['sortiranje2'])) {
                    $sortiranjeTabliceKlikovi = $_GET['sortiranje2'];
                } else {
                    $sortiranjeTabliceKlikovi = "";
                }

                if (!empty($_POST['brojKorisnika'])) {
                    $brojKorisnika = $_POST['brojKorisnika'];
                } else {
                    $brojKorisnika = 0;
                }
                

               
                if ($sortiranjeTabliceKlikovi == "Iznos") {

                    $StatistikaKlikovaUpit2 = "SELECT k.korisnicko_ime, SUM(tip.cijena) AS 'Iznos' FROM korisnik k, oglas o, tip_oglasa tip WHERE k.id=o.oglas_predlozio AND o.tip_oglasa=tip.id  AND o.status='1' GROUP BY 1 ORDER BY 2 DESC";
                }
                elseif ($sortiranjeTabliceKlikovi == "imena") {
                    $StatistikaKlikovaUpit2 = "SELECT k.korisnicko_ime, SUM(tip.cijena) AS 'Iznos' FROM korisnik k, oglas o, tip_oglasa tip WHERE k.id=o.oglas_predlozio AND o.tip_oglasa=tip.id  AND o.status='1' GROUP BY 1 ORDER BY k.korisnicko_ime";
                }
                else {
                    $StatistikaKlikovaUpit2 = "SELECT k.korisnicko_ime, SUM(tip.cijena) AS 'Iznos' FROM korisnik k, oglas o, tip_oglasa tip WHERE k.id=o.oglas_predlozio AND o.tip_oglasa=tip.id  AND o.status='1' 
                              GROUP BY 1 ORDER BY 2 DESC LIMIT $brojKorisnika";
                }

                        
//              $StatistikaKlikovaUpit1 = "SELECT tip.naziv,COUNT(o.id)*tip.cijena AS 'Iznos' FROM tip_oglasa tip, oglas o WHERE tip.id=o.tip_oglasa AND o.status='1' GROUP BY 1 ORDER BY 2 DESC LIMIT $pageOglas1,10";
                $rezStatistikaKlikovaUpit2 = $bp->selectDB($StatistikaKlikovaUpit2);
            
                echo '<form name="statistikaKupljenigOglasa" action="StatistikaPlacenihOglasa.php" method="POST">
                <table class="smanji" align=center border=6 cellpadding=3>
                    <tr align=center><td colspan=4><h2>Statistika Kupljenih oglasa po korisniku</h2></td><tr>

                    <tr align=center><td colspan=2>Sortiraj po:</td>
                    <td colspan=2 >Broj korisnika</td>                  
                    <tr align=center><td><a  href=StatistikaPlacenihOglasa.php?sortiranje2=imena style=text-decoration:none>Nazivu</a></td>
                    <td><a href=StatistikaPlacenihOglasa.php?sortiranje2=Iznos style=text-decoration:none>Iznosu</a></td>
                    <td colspan=2><input type="text" name="brojKorisnika" size="15" placeholder="Broj korisnika"></td>                    
                                           
                        <tr>
                        <th width="70%">Korisnicko ime</th>
                        <th width="30%">Iznos</th>                                              
                        </tr>';               
                while ($red4 = $rezStatistikaKlikovaUpit2->fetch_assoc()) {


                    $imena = $red4['korisnicko_ime'];
                    $iznos1 = $red4['Iznos'];                   

                    echo "<tr align=center><td>$imena</td>"
                    . "<td>$iznos1</td>"
                
                    . "</tr>";
                }
                echo "
                         
            <tr align=center><td colspan=2><input type=submit value='Pretraži' name='pretraga'></td>
        </form>
    </table>";
                ?>
            </div>

    </body>
</html>
<?php
$bp->zatvoriDB();
?>

