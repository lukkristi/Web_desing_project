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

            <h1 id="pocetak">ADMINISTRATOR</h1>
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
<!--        <div class="table-responsive" id="pagination_data">
            
        </div>-->
        <div class="Responzivni" >

            <?php
            if (isset($_GET['stranicenje'])) {

                $page = $_GET['stranicenje'];

                if ($page <= "1") {
                    $page1 = 0;
                } else {
                    $page1 = ($page * 10) - 10;
                }
            } else {
                $page1 = 0;
                $page = 0;
            }
            if (isset($_GET['dnevnik'])) {
                $sr = $_GET['dnevnik'];
                
            } else {

                $sr = "";
            }


            if (!empty($_POST['pretragaKorisnik'])) {
                $pretragaKorisnika = $_POST['pretragaKorisnik'];
            } else {
                $pretragaKorisnika = "";
            }

            if (!empty($_POST['pretragaRadnja'])) {
                $pretragaRadnja = $_POST['pretragaRadnja'];
            } else {
                $pretragaRadnja = "";
            }
            if (empty($_POST['pretragaKorisnik']) && empty($_POST['pretragaRadnja'])) {
                $upitPretragaDnevnik = "SELECT * FROM dnevnik ORDER BY '$sr' LIMIT $page1,10";
            }

            if ($sr == "id") {
                $upitPretragaDnevnik = "SELECT * FROM dnevnik WHERE radnja LIKE '$pretragaRadnja%' AND korisnik LIKE '$pretragaKorisnika%' ORDER BY id LIMIT $page1,10";
            }
            elseif ($sr == "radnja") {
                $upitPretragaDnevnik = "SELECT * FROM dnevnik WHERE radnja LIKE '$pretragaRadnja%' AND korisnik LIKE '$pretragaKorisnika%' ORDER BY radnja LIMIT $page1,10";
            } else {
                $upitPretragaDnevnik = "SELECT * FROM dnevnik WHERE radnja LIKE '$pretragaRadnja%' AND korisnik LIKE '$pretragaKorisnika%' LIMIT $page1,10";
            }

            $dnevnikPretraga = $bp->selectDB($upitPretragaDnevnik);

            $podaciDnevnikUpit = "SELECT * FROM dnevnik";
            $podaciDnevnik = $bp->selectDB($podaciDnevnikUpit);
            $brojPodatakaDnevnik = $podaciDnevnik->num_rows;

            //zaokruzujem na veci broj sa ceil
            $stranice = ceil($brojPodatakaDnevnik / 10);

            if ($page1 >= 10) {
                $nazad = $page1 / 10;
            } else {
                $nazad = 0;
            }

//            if ($page1 == "0" || $page1 == "1") {
//                $dalje = 2;
//            }
            if ((($page1 + 10) / 10) + 1 >= $stranice) {
                $dalje = $stranice;
            } else {
                $dalje = (($page1 + 10) / 10) + 1;
            }
            
                     
            echo "<form name='dnevnik' action='Administrator.php' method='POST'>
                <table class='smanji' align=center border=6 cellpadding=3>
                    <tr align=center><td colspan=4><h2>Dnevnik</h2></td><tr>
                    <tr align=left><td colspan=2>Sortiraj po:</td><td>Pretraga korisnik</td>
                    <td>Pretraga radnje</td>
                    <tr align=center><td><a href=Administrator.php?dnevnik=id style=text-decoration:none>ID</a></td>
                    <td><a href=Administrator.php?dnevnik=radnja style=text-decoration:none>Radnja</a></td>
                    <td><input type='text' name='pretragaKorisnik' size='15' placeholder='Korisničko ime'></td>
                    <td><input type='text' name='pretragaRadnja' size='15' placeholder='Radnja'></td>
                    <tr><tr></tr>"."<br>
                    <tr>
                    <th width='10%'>ID</th>
                    <th width='20%'>Korisnik</th>
                    <th width='35%'>Vrijeme</th>
                    <th width='35%'>Radnja</th>
                    </tr>";           
            
//            <tr align=left><td colspan=2>Sortiranje :</td><td><a href=Administrator.php?dnevnik=radnja style=text-decoration:none>Radnja</a></td>
//			<td><a href=Administrator.php?dnevnik=id style=text-decoration:none>ID</a></td>
//			<tr align=center><td>Pretraga korisnik</td><td><input type='text' name='pretragaKorisnik' size='15' placeholder='Korisničko ime'></td>
//			<td>Pretraga radnje</td><td><input type='text' name='pretragaRadnja' size='15' placeholder='Radnja'></td>
//			<tr align=center><td colspan=4><input type=submit value='Pretraži' name='pretraga'></td>
            while ($red = $dnevnikPretraga->fetch_assoc()) {
               
                $id = $red['id'];
                $korisnik2 = $red['korisnik'];
                $datumVrijeme = $red['vrijeme'];
                $radnja = $red['radnja'];

                echo "<tr align=center><td>$id</td>
                     <td>$korisnik2</td>
                     <td>$datumVrijeme</td>
                     <td>$radnja</td></tr>"
                       ;
            }


            echo "<tr  align=center><td colspan=4>
                     <a   href='Administrator.php?stranicenje=1&dnevnik=$sr' style='text-decoration:none'>PRVA</a>
                     <a   href='Administrator.php?stranicenje=$dalje&dnevnik=$sr' style='text-decoration:none'>sljedeća</a>
                     <a   href='Administrator.php?stranicenje=$nazad&dnevnik=$sr' style='text-decoration:none'>prethodna</a>    
                     <a   href='Administrator.php?stranicenje=$stranice&dnevnik=$sr' style='text-decoration:none'>ZADNJA</a></td>
                ";
                                    
             echo "<tr align=center><td><input type=submit value='Pretraži' name='pretraga'></td>
             </form>
             </table>" . "</br>
                ";            
           
//            <tr align=center><td colspan=4><input type=submit value='Pretraži' name='pretraga'></td>
//            ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//           ?>
            </div>
            
            <div class="Responzivni">

            <?php
//            $BrojPromasajaUpit1="SELECT id,ime,prezime,korisnicko_ime,email,status_potvrde,broj_promasaja FROM korisnik WHERE broj_promasaja>2 OR status_potvrde='0'";
//            $rezBrojPromasajaUpit=$bp->selectDB($BrojPromasajaUpit);
            
            if (isset($_GET['stranicenje1'])) {

                $pageZakljucani = $_GET['stranicenje1'];

                if ($pageZakljucani <= "1") {
                    $pageZakljucani1 = 0;
                } else {
                    $pageZakljucani1 = ($pageZakljucani * 10) - 10;
                }
            } else {
                $pageZakljucani1 = 0;
                $pageZakljucani = 0;
            }
            
            $podaciKorisnikUpit = "SELECT * FROM korisnik";
            $podaciKorisnik = $bp->selectDB($podaciDnevnikUpit);
            $brojPodatakaKorisnik = $podaciDnevnik->num_rows;

            //zaokruzujem na veci broj sa ceil
            $stranice1 = ceil($brojPodatakaKorisnik / 10);
            
            if ($pageZakljucani1 >= 10) {
                $nazad1 = $pageZakljucani1 / 10;
            } else {
                $nazad1 = 0;
            }

            if ($pageZakljucani1 == "0" || $pageZakljucani1 == "1") {
                $dalje1 = 2;
            }
            if ((($pageZakljucani1 + 10) / 10) + 1 >= $stranice1) {
                $dalje1 = $stranice1;
            } else {
                $dalje1 = (($pageZakljucani1 + 10) / 10) + 1;
            }
            
            
            
            
            

            if(isset($_GET['sortiranje'])){
		$sortiranjeTabliceZakljucaj=$_GET['sortiranje'];
		
            }           
            else {
                $sortiranjeTabliceZakljucaj="";           
            }
            
            
            
            
            if(!empty($_POST['poKorisnikuPretraga'])){
		$racuniKorisnik = $_POST['poKorisnikuPretraga'];
            }
            else{
                $racuniKorisnik="";            
            }

            if(!empty($_POST['poPromasajimaPretraga'])){
		$brojPromasaja = $_POST['poPromasajimaPretraga'];
            }
            else{
                $brojPromasaja="";            
            }
//            if(empty($_POST['poKorisnikuPretraga']) && empty($_POST['poPromasajimaPretraga'])){
//		$BrojPromasajaUpit1 = "SELECT * FROM korisnik WHERE broj_promasaja > 2 OR status_potvrde='0' ORDER BY '$sortiranjeTabliceZakljucaj' LIMIT $pageZakljucani1,10";		
//            }
            
            
            
            
            
            if($sortiranjeTabliceZakljucaj=="status"){

		$BrojPromasajaUpit1 = "SELECT * FROM korisnik WHERE broj_promasaja > 2 ORDER BY id LIMIT $pageZakljucani1,10";
				}
            elseif($sortiranjeTabliceZakljucaj=="korisnicko_ime"){

		$BrojPromasajaUpit1 = "SELECT * FROM korisnik WHERE broj_promasaja > 2  
			     AND korisnicko_ime LIKE '$racuniKorisnik%' ORDER BY korisnicko_ime LIMIT $pageZakljucani1,10";
			 }
            else{
		$BrojPromasajaUpit1 = "SELECT * FROM korisnik WHERE broj_promasaja LIKE '$brojPromasaja' OR korisnicko_ime LIKE '$racuniKorisnik%'
				  AND broj_promasaja>2 LIMIT $pageZakljucani1,10";
            }
            $rezBrojPromasajaUpit1=$bp->selectDB($BrojPromasajaUpit1);
            
                       
        echo '<form name="Otkljucavanje" action="Administrator.php" method="POST">
                <table class="smanji" align=center border=6 cellpadding=3>
                    <tr align=center><td colspan=4><h2>Zaključani i neaktivirani računi</h2></td><tr>

                    <tr align=left><td colspan=2>Sortiraj po:</td>
                    <td>Pretražite korisnike</td>
                    <td>Pretražite broj promasaja</td>
                    <tr align=center><td><a   href=Administrator.php?sortiranje=korisnicko_ime style=text-decoration:none>Korisnik</a></td>
                    <td><a   href=Administrator.php?sortiranje=status style=text-decoration:none>ID</a></td>
                    <td><input  type="text" name="poKorisnikuPretraga" size="15" placeholder="Korisničko ime"></td>
                    <td><input  type="text" name="poPromasajimaPretraga" size="15" placeholder="Broj promasaja"></td>
                                           
                        <tr>
                        <th width="20%">Korisnik</th>
                        <th width="10%">ID</th>                       
                        <th width="35%">Otključaj</th>
                        <th width="35%">Zaključaj</th>
                        </tr>';
//                    <td><a  href=admin.php?sortiranje=korisnicko_ime style=text-decoration:none>Korisnik</a></td>
//                    <td><a  href=admin.php?sortiranje=status style=text-decoration:none>ID</a></td>
//                    <tr align=center><td>Pretražite korisnike</td>
//                    <td><input  type="text" name="poKorisnikuPretraga" size="15" placeholder="Korisničko ime"></td>
//                    <td>Pretražite statuse</td>
//                    <td><input  type="text" name="poPromasajimaPretraga" size="15" placeholder="Broj promasaja"></td>
        while ($red1 = $rezBrojPromasajaUpit1->fetch_assoc()) {

            
        $korisnik11 = $red1['korisnicko_ime'];
        $id = $red1['id'];
        $status = $red1['broj_promasaja'];

        echo "<tr  align=center><td>$korisnik11</td>"
                . "<td>$id - $status </td>"
                . "<td><a   href='OtkljucavanjeZakljucavanje.php?id_korisnik=$id'>Otključaj račun</a></td>
                <td><a   href='OtkljucavanjeZakljucavanje.php?status=$status&id_korisnik=$id'>Blokiraj račun</a></td>"
                . "</tr>";        
	}     
        echo "<tr  align=center><td colspan=4>
                     <a   href='Administrator.php?stranicenje1=1' >PRVA</a>
                     <a   href='Administrator.php?stranicenje1=$dalje1' >sljedeća</a>
                     <a   href='Administrator.php?stranicenje1=$nazad1' >prethodna</a>    
                     <a   href='Administrator.php?stranicenje1=$stranice1'>ZADNJA</a></td>
                         
            <tr align=center><td><input type=submit value='Pretraži' name='pretraga'></td>
        </form>
    </table>";                                                       
            ?>
        </div>       
        <div class="Responzivni">
            <?php
            $moderatoriUpit = "SELECT * FROM korisnik WHERE tip_korisnika = '2' ";
            $rezModeratoriUpit = $bp->selectDB($moderatoriUpit);           
            
            echo '<form name="statistika" action="Administrator.php" method="POST">
                <table class="smanji" align=center border=6 cellpadding=3>
                    <tr align=center><td colspan=2><h2>Kreiraj Hotel</h2></td><tr>
                    <tr>
                        <th width="50%">Naziv hotela</th>
                        <th width="50%">Moderator</th>                                              
                   </tr>
                    <tr align=center><td><input type="text" name="nazivHotela" size="15" placeholder="Naziv Hotela"></td>                                        
                                           
                    <td><select name="moderator">';

        while ($red3 = $rezModeratoriUpit->fetch_assoc()) {

            
        $korisnickoImeModerator = $red3['korisnicko_ime'];
        $idModeratora = $red3['id'];
        
        echo '<option value="'.$idModeratora.'">'.$korisnickoImeModerator.'</option>';        
	}     
        echo "</select></td></tr>
            <tr align=center><td colspan=2><input type=submit value='Dodaj hotel' name='NoviHotel'></td>
         </form>
            </table>";
        
        
        if (isset($_POST['NoviHotel'])) {
            
                    $noviHotel=$_POST['nazivHotela'];
                    $odabraniModerator=$_POST['moderator'];
                    
                    $unesiHotelUpit="INSERT INTO hotel VALUES (default,'$noviHotel')";
                    if ($bp->updateDB($unesiHotelUpit)) {
                        echo 'Unijeli ste novi hotel i';
                        $vrijeme=$bp->DohvatiVrijemePomaka();
                        $dnevnik6 = "INSERT INTO dnevnik VALUES ('default','Kreiran novi Hotel','$vrijeme','$korisnik')";
                        $bp->updateDB($dnevnik6);
                    }
                    $idHotelaNovogUpit="SELECT id FROM hotel WHERE naziv='$noviHotel' ";
                    $rezIdHotelaNovogUpit=$bp->selectDB($idHotelaNovogUpit);
                    $idHotelaNovog=$rezIdHotelaNovogUpit->fetch_row();
                    
                    $DodjeliModeratoraUpit= "INSERT INTO hotel_moderator VALUES ('$idHotelaNovog[0]','$odabraniModerator')";
                    if ($bp->updateDB($DodjeliModeratoraUpit)) {
                       echo '<br>'.'Dodali ste moderatora tom hotelu';
                    }
                    
        
            
        }
            ?>
        </div>
        <div class="Responzivni">
            <?php
            $moderatoriUpit1 = "SELECT * FROM korisnik WHERE tip_korisnika = '2' ";
            $rezModeratoriUpit1 = $bp->selectDB($moderatoriUpit1);
            $hotelUpit="SELECT * FROM hotel";
            $rezHotelUpit=$bp->selectDB($hotelUpit);
            
            echo '<form name="DodajModeratora" action="Administrator.php" method="POST">
                <table class="smanji" align=center border=6 cellpadding=3>
                    <tr align=center><td colspan=2><h2>Dodaj Moderatora</h2></td><tr>
                    <tr>
                        <th width="50%">Naziv hotela</th>
                        <th width="50%">Moderator</th>                                              
                   </tr>
                    <tr align=center><td><select name="hotel">';
                    while ($red4 = $rezHotelUpit->fetch_assoc()) {

            
                    $nazivHotela = $red4['naziv'];
                    $idHotela = $red4['id'];
        
                    echo '<option value="'.$idHotela.'">'.$nazivHotela.'</option>';        
                    }
                    echo '</select></td>
                        
                    <td><select name="moderator1">';

                    while ($red5 = $rezModeratoriUpit1->fetch_assoc()) {

            
                    $korisnickoImeModerator1 = $red5['korisnicko_ime'];
                    $idModeratora1 = $red5['id'];
        
                    echo '<option value="'.$idModeratora1.'">'.$korisnickoImeModerator1.'</option>';        
                    }     
                    echo "</select></td></tr>
                        <tr align=center><td colspan=2><input type=submit value='Dodijeli moderatora' name='HotelModerator'></td>
                        </form>
                    </table>";
                    
                    if (isset($_POST['HotelModerator'])) {
            
                    $odabraniHotel=$_POST['hotel'];
                    $odabraniModerator1=$_POST['moderator1'];
                    
                    $provjeraModeratoraHoteluUpit="SELECT * FROM hotel_moderator WHERE hotel='$odabraniHotel' AND moderator='$odabraniModerator1'";
                    $rezProvjeraModeratoraHoteluUpit=$bp->selectDB($provjeraModeratoraHoteluUpit);
                    if ($rezProvjeraModeratoraHoteluUpit->num_rows>0) {
                        echo 'Moderator vec moderira taj hotel!';
                    }
                    else {
                        $dodjelaModeratoraHoteluUpit= "INSERT INTO hotel_moderator VALUES ('$odabraniHotel','$odabraniModerator1')";
                        $bp->updateDB($dodjelaModeratoraHoteluUpit);
                        
                        $vrijeme=$bp->DohvatiVrijemePomaka();
                        $dnevnik5 = "INSERT INTO dnevnik VALUES ('default','Dodjela moderatora hotelu','$vrijeme','$korisnik')";
                        $bp->updateDB($dnevnik5);                        
                    }}
                    
                                                          
            
            ?>
        </div>
    </body>
</html>
<script> 
//$(document).ready(function(){
//    load_data();
//    function load_data(page){
//        $.ajax({
//                type: "POST",
//                url: "Stranicenje.php",
//                data: {page:page},
//                success: function (data) {
//                    $("#pagination_data").html(data);
//                }
//        });
//    }
//    
//    $(document).on('click','.pagination_link',function(){
//        
//        var page=$(this).attr("id");
//        load_data(page);
//    });   
//});
//$("form").submit(function(){
//    var da=$("#pretragaKorisnik").val();
//    function pretraziKorisnika($da) {
//            $.ajax({
//                type: "POST",
//                url: "Stranicenje.php",
//                data: 'pretragaKorisnik=' + $da,
//                success: function (data) {
//                    $("#pagination_data").html(data);
//                }
//
//            });
//        }
//});

//function pretraziKorisnika(val) {
//            $.ajax({
//                type: "POST",
//                url: "Stranicenje.php",
//                data: 'pretragaKorisnik=' + val,
//                success: function (data) {
//                    $("#pagination_data").html(data);
//                }
//
//            });
//        }





</script>
<?php
$bp->zatvoriDB();
?>
