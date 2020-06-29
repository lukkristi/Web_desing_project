<?php
require ("Baza.class.php");
$bp = new Baza();
$bp->spojiDB();

if ($bp->pogreskaDB()) {
    $poruka .= "Spajanje sa bazom nije uspješno!";
    $greska = true;
}
$imeKukija = "prvi_dolazak";
if (isset($_COOKIE['prvi_dolazak'])) {
    
} else {
    setcookie($imeKukija, "prvi dolazak", time() + (86400 * 2));
    echo '<script type="text/javascript">alert("Uvjeti koristenja stranice");</script>';
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
        <meta name="date" content="26.05.2018">
        <meta name="description" content="Početna stranica">
        <link href="css/lukkristi.css" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>        
    </head>
    <body>
        <!-- <div id="google_translate_element"></div>-->

        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({pageLanguage: 'hr'}, 'Prevodjenje_stranice');
            }
        </script>

        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

        <header>

            <h1 id="pocetak">Hotel Royal</h1>
            <div class="lijevo" >
                <p class="grupa">Izbornik
                    <span class="datum">Datum: 17.03.2018. Vrijeme: 18:30</span>
                </p>
                <a class="desno" href="Prijava.php">Prijava</a>
                <br>
                <a class="desno" href="Registracija.php">Registracija</a>
                <div id="Prevodjenje_stranice"></div>
            </div>
        </header>

        <div>
            <nav id="navigacija">
                <ul>
                    <li><a href="index.html">Početna</a></li>
                    <li><a href="Prijava.php">Prijava</a></li>
                    <li><a href="Registracija.php">Registracija</a></li>
                    <li><a href="Index.php">Početna</a></li>                    
                    <li><a href="Moderator.php">Moderator</a></li>
                    <li><a href="Dokumentacija.html">Dokumentacija</a></li>
                    <li><a href="O_autoru.html">O autoru</a></li>
                    <li><a href="RegistriraniKorisnik.php">Registrirani korisnik</a></li>                                       
                </ul>
            </nav>

            <img id="indexSlika" src="slike/lukas.jpg" alt="indexslika"  style="display: inline-block">
            <div>
                <ol type="I" style="display: inline-block">
                    <li>Lukas</li>
                    <li>Krištić</li>
                    <li>lukkristi@foi.hr</li>
                    <li>43434/14-R</li>            
                </ol>
            </div>
        </div>
        <section class="hotel">
            <h2 style="color: black;" id="Proizvodi">Proizvod i usluge</h2>
            <article>
                <h3 style="color: black;" id="usluga">Opcenito</h3>
                <p>Hotel je ustanova namijenjena pružanju usluga najčešće kratkotrajnog smještaja i prehrane svojim gostima, korisnicima usluge.
                    Hoteli, ovisno o željama i potrebama gostiju, pružaju djelomičnu ili 
                    potpunu uslugu koja obuhvaća spavanje, prehranu, zabavu i sve ostalo prilagođeno potrebama gostiju.
                    Hotelske sobe dijele se na jednokrevetne, dvokrevetne ili trokrevetne. Sobe su, ovisno o kategoriji hotela, 
                    opremljene svim potrebnim za potpunu uslugu i odmor svojih gostiju, pa su tako primjerice sobe u višekategornicima 
                    opremljene krevetima, mini barom, televizijskim uređajem sa satelitskim 
                    prijemom kanala, priključkom za brzu internet vezu, telefonskim uređajem, klimatizacijom, kupaonicom sa wc-om itd.

                </p>               
            </article>
            <article>
                <h3>Usluge</h3>
                <p>
                    •  75 luksuzno uređenih soba i apartmana, od kojih većina ima pogled na more 
                    •  Garaža
                    •  Portir i nosač prtljage
                    •  Concierge/Guest Relation
                    •  24-satni Room service
                    •  WLAN internet u javnim prostorima
                    •  ENJOY restoran
                    •  SKY BAR s panoramskom terasom i pogledom na more
                    •  SPLASH! Pool&Lounge – otvoreni bazen lounge karaktera
                    •  PIRATES' ISLAND dječja igraonica
                    •  Babysitting prema raspoloživosti i uz prethodnu najavu
                    •  Konferencijske/banketne dvorane
                    •  Sale za sastanke
                    •  Rent-a-car 
                    •  Usluga pranja rublja
                    •  Sobe za nepušače
                    •  Sobe za osobe s invaliditetom
                    •  Kretanje kroz hotel omogućeno je za osobe s invaliditetom
                </p>               
            </article>
        </section>
        <div class="Responzivni">
            <?php
            $hotelUpit = "SELECT * FROM hotel";
            $rezHotelUpit = $bp->selectDB($hotelUpit);

            echo '<form name="PregledHtela" action="Index.php" method="POST">
                <table class="smanji" align=center border=6 cellpadding=3>
                    <tr align=center><td ><h2>Odaberi hotel</h2></td><tr>
                    <tr>
                        <th width="100%">Naziv hotela</th>
                                                                      
                   </tr>
                    <tr align=center><td><select name="hotel">';
            while ($red4 = $rezHotelUpit->fetch_assoc()) {


                $nazivHotela = $red4['naziv'];
                $idHotela = $red4['id'];

                echo '<option value="' . $idHotela . '">' . $nazivHotela . '</option>';
            }
            echo '</select></td>';

            echo "</tr>
                        <tr align=center><td><input type=submit value='Dodijeli moderatora' name='HotelModerator'></td>
                        </form>
                    </table>";

            if (isset($_POST['HotelModerator'])) {

                $odabraniHotel = $_POST['hotel'];


                $provjeraModeratoraHoteluUpit = "SELECT s.*, COUNT(r.korisnik) AS 'Broj_korisnika'  FROM sobe s, korisnik k , rezervacija r  WHERE s.id=r.sobe AND k.id=r.korisnik AND s.hotel_id='$odabraniHotel' GROUP BY 1";
                $rezProvjeraModeratoraHoteluUpit = $bp->selectDB($provjeraModeratoraHoteluUpit);

                echo '
                    <table class="smanji" align=center border=6 cellpadding=3>
                    <tr align=center><td ><h2>Odaberi hotel</h2></td><tr>
                    <tr>
                        <th width="100%">ID</th>
                        <th width="100%">Broj sobe</th>
                        <th width="100%">Opis</th>
                        <th width="100%">Broj korisnika</th>
                                                                      
                   </tr>';
                while ($red4 = $rezProvjeraModeratoraHoteluUpit->fetch_assoc()) {


                    $id = $red4['id'];
                    $korisnik2 = $red4['broj'];
                    $datumVrijeme = $red4['opis'];
                    $radnja = $red4['Broj_korisnika'];

                    echo "<tr align=center><td>$id</td>
                     <td>$korisnik2</td>
                     <td>$datumVrijeme</td>
                     <td>$radnja</td></tr>"
                    ;
                }
                
                echo "</tr>
                        <tr align=center><td><input type=submit value='Dodijeli moderatora' name='HotelModerator'></td>
                        
                    </table>";
            }
            ?>
        </div>



        <footer>
            <p> 5 sati </p>
            <figure>
                <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2017%2Fzadaca_03%2Flukkristi%2Findex.html">
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