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

    if ($bazaKorisnik[0] == 1 ) {
        $korisnik1 = $_SESSION['korisnik'];
        echo 'Dobro dosli Admine: ' . $korisnik1;
        $dohvatiHoteleUpit="SELECT * FROM hotel";
        $rezDohvatiHoteleUpit=$bp->selectDB($dohvatiHoteleUpit);
        
        $dohvatiSobeUpit="SELECT * FROM sobe";
        $rezDohvatiSobeUpit11=$bp->selectDB($dohvatiSobeUpit);
        
        
    }elseif ($bazaKorisnik[0] == 2) {
        $korisnik1 = $_SESSION['korisnik'];
        echo 'Dobro dosli Moderatoru: ' . $korisnik1;
        $dohvatiHoteleUpit="SELECT * FROM hotel h  LEFT OUTER JOIN hotel_moderator hm ON h.id=hm.hotel WHERE hm.moderator='$bazaIdKorisnik[0]'";
        $rezDohvatiHoteleUpit=$bp->selectDB($dohvatiHoteleUpit);
        
        $dohvatiSobeUpit="SELECT * FROM sobe s  LEFT OUTER JOIN hotel h ON s.hotel_id=h.id LEFT OUTER JOIN hotel_moderator hm ON h.id=hm.hotel  WHERE hm.moderator='$bazaIdKorisnik[0]'";
        $rezDohvatiSobeUpit11=$bp->selectDB($dohvatiSobeUpit);
        
    }
    else {
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
        <meta name="description" content="Moderator stranica">
        <link href="css/lukkristi.css" rel="stylesheet" type="text/css">  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    </head>
    <body>

        <header>

            <h1 id="pocetak">Moderator</h1>
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
                    <li><a href="Dokumentacija.html">Dokumentacija</a></li>
                    <li><a href="O_autoru.html">O autoru</a></li>
                    <li><a href="RegistriraniKorisnik.php">Registrirani korisnik</a></li>                    
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
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <div class="Responzivni">
            <?php
//           $dohvatiHoteleUpit="SELECT * FROM hotel h  LEFT OUTER JOIN hotel_moderator hm ON h.id=hm.hotel WHERE hm.moderator='3'";
//            $rezDohvatiHoteleUpit1=$bp->selectDB($dohvatiHoteleUpit);         TESTIRANJE  
            
            echo '<form name="Soba" action="Moderator.php" method="POST">
                <table class="smanji" align=center border=6 cellpadding=3>
                    <tr align=center><td colspan=5><h2>Kreiraj Sobu</h2></td><tr>
                    <tr>
                        <th width="13%">Broj</th>
                        <th width="30%">Slika</th>
                        <th width="30%">Opis</th>
                        <th width="12%">Broj smjestaja</th>
                        <th width="15%">Hotel</th>
                        
                   </tr>
                    <tr align=center>
                    <td><input type="text" name="brojSobe" size="8" placeholder="Broj sobe"></td>
                    <td><input type="file" name="slika" size="10" placeholder="slika"></td>
                    <td><input type="text" name="opis" size="20" placeholder="opis"></td>
                    <td><input type="text" name="velicina" size="5" placeholder="kreveta"></td>                                                           
                                           
                    <td><select name="hotel">';

            while ($red3 = $rezDohvatiHoteleUpit->fetch_assoc()) {

            
            $nazivHotela1 = $red3['naziv'];
            $idHotela1 = $red3['id'];
        
            echo '<option value="'.$idHotela1.'">'.$nazivHotela1.'</option>';        
            }     
            echo "</select></td></tr>
            <tr align=center><td colspan=5><input type=submit value='Dodaj Sobu' name='NovaSoba'></td>
         </form>
            </table>";
        
        
            if (isset($_POST['NovaSoba'])) {
                                
                                        
                    if (empty($_POST['hotel']) || empty($_POST['brojSobe']) || empty($_POST['opis'])|| empty($_POST['velicina']) ) {
                        echo 'Niste unijeli sve podatke!';
                                      
                    } else {
                        
                        $hotel=$_POST['hotel'];
                        $brojSobe=$_POST['brojSobe'];
                        if (empty($_FILES['slika']['tmp_name'])) {
                            $slika=NULL;
                        }
                        else {
                            $slika=addslashes(file_get_contents($_FILES['slika']['tmp_name']));
                        }
                        
                        $opis=$_POST['opis'];
                        $velicina=$_POST['velicina'];
                        
                        $unesiSobuUpit="INSERT INTO sobe VALUES (default,'$brojSobe','$slika','$opis','$velicina','$hotel')";
                        if ($bp->updateDB($unesiSobuUpit)) {
                        echo 'Unijeli ste novu sobu ';
                        $vrijeme=$bp->DohvatiVrijemePomaka();
                        $dnevnik8 = "INSERT INTO dnevnik VALUES ('default','Kreirana nova Soba','$vrijeme','$korisnik')";
                        $bp->updateDB($dnevnik8);
                        }
                    }
            }        
                    
            ?>
        </div>
        <div class="Responzivni">
            <?php
//           $dohvatiHoteleUpit="SELECT * FROM hotel h  LEFT OUTER JOIN hotel_moderator hm ON h.id=hm.hotel WHERE hm.moderator='3'";
            $dohvatiSobeUpit="SELECT * FROM sobe s  LEFT OUTER JOIN hotel h ON s.hotel_id=h.id LEFT OUTER JOIN hotel_moderator hm ON h.id=hm.hotel  WHERE hm.moderator='3'";
            $rezDohvatiHoteleUpit11=$bp->selectDB($dohvatiSobeUpit);           
            $sviKorisniciUpit="SELECT * FROM korisnik WHERE tip_korisnika='3'";
            $rezSviKorisniciUpit=$bp->selectDB($sviKorisniciUpit);
            echo '<form name="Registracija" action="Moderator.php" method="POST">
                <table class="smanji" align=center border=6 cellpadding=3>
                    <tr align=center><td colspan=5><h2>Rezervacija</h2></td><tr>
                    <tr>
                        <th width="20%">Dolazak</th>
                        <th width="20%">Odlazak</th>
                        <th width="20%">Broj dana</th>
                        <th width="20%">Broj sobe</th>
                        <th width="20%">korisnik</th>
                        
                   </tr>
                    <tr align=center>
                    <td><input type="date" name="dolazakDatum" size="10" placeholder="datum"></td>
                    <td><input type="date" name="odlazakDatum" size="10" placeholder="datum"></td>
                    <td><input type="text" name="treajanje" size="10" placeholder="trajanje"></td>
                                                                               
                                           
                    <td><select name="sobe">';

            while ($red6 = $rezDohvatiSobeUpit11->fetch_assoc()) {

            
            $brojSobe1 = $red6['broj'];
            $idSobe = $red6['id'];
        
            echo '<option value="'.$idSobe.'">'.$brojSobe1.'</option>';        
            }     
            echo '</select></td>
                <td><select name="korisnik"> ';
            
            
            
            
             while ($red7 = $rezSviKorisniciUpit->fetch_assoc()) {

            
            $imeKorisnika = $red7['korisnicko_ime'];
            $idkor = $red7['id'];
        
            echo '<option value="'.$idkor.'">'.$imeKorisnika.'</option>';        
            }
            

            echo "</select></td>  <tr align=center><td colspan=5><input type=submit value='Unesi rezervaciju' name='NovaRezervacija'></td>
         </form>
            </table>";
        
        
            if (isset($_POST['NovaRezervacija'])) {
                                
                                        
                    if (empty($_POST['dolazakDatum']) || empty($_POST['odlazakDatum']) || empty($_POST['treajanje'])|| empty($_POST['sobe']) || empty($_POST['korisnik']) ) {
                        echo 'Niste unijeli sve podatke!';
                                      
                    } else {
                        
                        $dolazak=$_POST['dolazakDatum'];
                        $odlazak=$_POST['odlazakDatum'];                       
                        $trajanje=$_POST['treajanje'];
                        $soba=$_POST['sobe'];
                        $korime2=$_POST['korisnik'];
                                                                      
                        
                        $unesiSobuUpit="INSERT INTO rezervacija VALUES ('$korime2','$soba','$dolazak','$odlazak','$trajanje')";
                        if ($bp->updateDB($unesiSobuUpit)) {
                        echo 'Unijeli ste novu rezervaciju';
                        $vrijeme=$bp->DohvatiVrijemePomaka();
                        $dnevnik8 = "INSERT INTO dnevnik VALUES ('default','Nova rezervacija','$vrijeme','$korisnik')";
                        $bp->updateDB($dnevnik8);
                        }
                    }
            }        
                    
            ?>
        </div>
        
        <div class="Responzivni">
            <?php
                       
            echo '<form name="UnosTipaOglasa" action="Moderator.php" method="POST">
                <table class="smanji" align=center border=6 cellpadding=3>
                    <tr align=center><td colspan=6><h2>Dodaj Tip oglasa</h2></td><tr>
                    <tr>
                        <th width="30%">Naziv</th>
                        <th width="11%">Visina</th>
                        <th width="12%">Sirina</th>
                        <th width="12%">Cijena</th>
                        <th width="15%">Trajanje</th>
                        <th width="15%">Brzina izmjene</th>
                   </tr>
                    <tr align=center>
                    <td><input type="text" name="naziv" size="20" placeholder="naziv"></td>
                    <td><input type="text" name="visina" size="5" placeholder="broj"></td>
                    <td><input type="text" name="sirina" size="5" placeholder="broj"></td>
                    <td><input type="text" name="cijena" size="5" placeholder="broj"></td>
                    <td><input type="text" name="trajanje" size="5" placeholder="broj"></td>
                    <td><input type="text" name="brzinaIzmjene" size="5" placeholder="broj"></td>

                  ';
                        
                    echo "</tr>
                        <tr align=center><td colspan=6><input type=submit value='Unesi' name='TipOglasa'></td>
                        </form>
                    </table>";
                    
                    if (isset($_POST['TipOglasa'])) {
            
                    if (empty($_POST['naziv']) || empty($_POST['visina']) || empty($_POST['sirina'])|| empty($_POST['cijena']) || empty($_POST['trajanje']) || empty($_POST['brzinaIzmjene']) ) {
                        echo 'Niste unijeli sve podatke!';
                                      
                    } else {
//                        echo 'evo me u else';
                        $nazivTipa=$_POST['naziv'];
                        $visina=$_POST['visina'];                       
                        $sirina=$_POST['sirina'];
                        $cijena=$_POST['cijena'];
                        $trajanje=$_POST['trajanje'];
                        $brzinaIzmjene=$_POST['brzinaIzmjene'];                                              
                        
                        $unesiTipUpit="INSERT INTO tip_oglasa VALUES ('default','$nazivTipa','$visina','$sirina','$cijena','$trajanje','$brzinaIzmjene')";
                        if ($bp->updateDB($unesiTipUpit)) {
                        echo 'Unijeli ste novi tip oglasa';
                        $vrijeme=$bp->DohvatiVrijemePomaka();
                        $dnevnik8 = "INSERT INTO dnevnik VALUES ('default','Stvorena nova vrsta oglasa','$vrijeme','$korisnik')";
                        $bp->updateDB($dnevnik8);
                        }
                    }
                }
                    
                                                          
            
            ?>
        </div>
        <div class="Responzivni">
        <?php
//            $BrojPromasajaUpit1="SELECT id,ime,prezime,korisnicko_ime,email,status_potvrde,broj_promasaja FROM korisnik WHERE broj_promasaja>2 OR status_potvrde='0'";
//            $rezBrojPromasajaUpit=$bp->selectDB($BrojPromasajaUpit);
            
            
            
           
            $BrojPromasajaUpit1 = "SELECT * FROM oglas WHERE status='0'";
				  
            
            $rezBrojPromasajaUpit1=$bp->selectDB($BrojPromasajaUpit1);
            
                       
        echo '<form name="odobriti status" action="Moderator.php" method="POST">
                <table class="smanji" align=center border=6 cellpadding=3>
                    <tr align=center><td colspan=4><h2>Aktivirati oglas</h2></td><tr>
                   
                                                             
                        <tr>
                        <th width="20%">Korisnik</th>
                        <th width="10%">ID</th>                       
                        <th width="35%">Otključaj</th>
                        <th width="35%">Zaključaj</th>
                        </tr>';

        while ($red1 = $rezBrojPromasajaUpit1->fetch_assoc()) {

            
        $korisnik11 = $red1['naslov'];
        $id = $red1['id'];
        $status = $red1['tekst'];

        echo "<tr  align=center><td>$korisnik11</td>"
                . "<td>$status </td>"
                . "<td><a   href='PrihavtitOglas.php?id_oglas=$id'>Odobri oglas</a></td>
                <td><a   href='PrihavtitOglas.php?status=$status&id_oglas=$id'>odbi oglas</a></td>"
                . "</tr>";        
	}     
        echo "
                         
            <tr align=center><td><input type=submit value='Pretraži' name='pretraga'></td>
        </form>
    </table>";                                                       
            ?>
        
        
       </div>
        
        
        <div class="Responzivni">
        <?php
//            $BrojPromasajaUpit1="SELECT id,ime,prezime,korisnicko_ime,email,status_potvrde,broj_promasaja FROM korisnik WHERE broj_promasaja>2 OR status_potvrde='0'";
//            $rezBrojPromasajaUpit=$bp->selectDB($BrojPromasajaUpit);
            
            
            
           
            $prijavljeniOglasiUpit = "SELECT o.*,po.razlog,k.id AS 'korID' FROM oglas o, korisnik k, prijaveljni_oglas po  WHERE o.id=po.oglas AND k.id=po.korisnik AND o.status='1'";
				  
            
            $rezprijavljeniOglasiUpit=$bp->selectDB($prijavljeniOglasiUpit);
            
                       
        echo '<form name="odobriti status" action="Moderator.php" method="POST">
                <table class="smanji" align=center border=6 cellpadding=3>
                    <tr align=center><td colspan=4><h2>Prijavljeni oglasi</h2></td><tr>
                   
                                                             
                        <tr>
                        <th width="10%">ID</th>
                        <th width="30%">Naslov oglasa</th>                       
                        <th width="40%">Razlog prijave</th>
                        <th width="20%">Blokiraj</th>
                        </tr>';

        while ($red9 = $rezprijavljeniOglasiUpit->fetch_assoc()) {

            
        $oglasNaslov = $red9['naslov'];
        $id5 = $red9['id'];
        $razlog1 = $red9['razlog'];
        $korisnikid=$red9['korID'];

        echo "<tr  align=center><td>$id5</td>"
                . "<td>$oglasNaslov </td>"
                . "<td>$razlog1</td>
                <td><a   href='PrihavtitOglas.php?blokiraj=$razlog1&id_oglas=$id5&id_kor=$korisnikid'>Blokiraj</a></td>"
                . "</tr>";        
	}     
        echo "
                         
            
        </form>
    </table>";                                                       
            ?>
        
        
       </div> 
            
</body>
</html>

<?php
$bp->zatvoriDB();
?>