<?php

require ("Baza.class.php");
$bp = new Baza();
$bp->spojiDB();

if (isset($_POST['Posalji'])) {
    $greska = FALSE;
    $znakovi = "#'!?";
    $mail = $_POST['email'];

    $poljeUnosa = array($_POST['ime'], $_POST['prezime'], $_POST['email'], $_POST['korime'], $_POST['lozinka1'], $_POST['lozinka2']);
    foreach ($poljeUnosa as $key => $elementPolja) {
        if (empty($elementPolja)) {
            echo "<font color='red'>Sva polja moraju biti ispunjena!</font>" . '<br/>';
            $greska = TRUE;
            break;
        } elseif (!empty($elementPolja)) {
            for ($i = 0; $i < strlen($elementPolja); $i++) {
                if ($greska == TRUE)
                    break;
                for ($j = 0; $j < strlen($znakovi); $j++) {
                    if ($greska == TRUE)
                        break;

                    if ($elementPolja[$i] == $znakovi[$j]) {
                        echo "<font color='red'>Polje sadrzi nedozvoljene znakove $elementPolja!</font>" . '<br/>';
                        $greska = TRUE;
                        break;
                    }
                }
            }
        }
    }


    if (!preg_match("/^[a-zA-z0-9]+@[a-zA-z0-9]+\.[a-zA-z0-9]{2,4}$/", $mail)) {
        $greska = TRUE;       
        echo "<font color='red'>Email nije ispravnog formata mora biti </font> nesto@nesto.nesto " . '<br/>';
    }

    if ($_POST['lozinka1'] != $_POST['lozinka2']) {
        $greska = TRUE;       
        echo "<font color='red'> Lozinke nisu iste </font> " . '<br/>';
    }

    $mail = $_POST['email'];

    $upitEmail = "SELECT email FROM korisnik WHERE email='$mail'";
    $rezEmail = $bp->selectDB($upitEmail);

    if ($rezEmail->num_rows > 0) {
        echo 'Email vec postoji'. '<br/>';
        $greska = TRUE;
    }

    if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response']) {
        //var_dump($_POST);
        $secret = "6LfbAl0UAAAAAPIopqbLXu4ors3kkE7X4DKBB0eK";
        $captcha = $_POST['g-recaptcha-response'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
        $provjera = json_decode($rsp, TRUE);
        if (!$provjera['success']) {
            echo "reCAPTCHA - nije prošla provjera" . "<br/>";
            $greska = TRUE;
        }
    } else {
        echo "Niste stisnuli provjeru da niste robot!</br>";
        $greska = TRUE;
    }

    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $korime = $_POST['korime'];
    $email = $_POST['email'];
    $lozinka = $_POST['lozinka1'];

    $salt = sha1(date("Y.m.d"));
    $kriptiranaLozinka = sha1($salt . "---" . $lozinka);

    //AKTIVACIJA PUTEM E-MAILA
    $primatelj = $_POST['email'];
    $aktivacijskiKod = '' . date('d.m.Y h:i:s a', time()) . $_POST['korime'];
    $hashedCode = hash("md5", $aktivacijskiKod);
    $vrijeme = $bp->DohvatiVrijemePomaka();
    $datum = date("d.m.Y");
    
    $upitDnevnik3 = "INSERT INTO dnevnik VALUES ('default','Racun je zakljucan','$vrijeme','$korime')";
                        
    
    $upitZaUnos = "INSERT INTO korisnik VALUES (default,'$ime','$prezime','$korime','$email','$lozinka','$kriptiranaLozinka','$datum','0','0','$hashedCode','$vrijeme','3','1')";
    $putanja = "http://barka.foi.hr/WebDiP/2017_projekti/WebDiP2017x080/Aktivacija.php?aktivacijskiKod=" . $hashedCode;

    if ($greska == FALSE) {
        $bp->updateDB($upitZaUnos);
        $bp->updateDB($upitDnevnik3);
        echo 'Uspjesno uneseni podaci.Na mail vam je poslana aktivacija';

        mail($primatelj, "Aktivacijski kod potvrdite unutar 7 sati", $putanja);
        header("Refresh: 5; url=Prijava.php");
    } else {
        echo "Pogreska kod unosa " . $upitZaUnos . "<br>" . $bp->pogreskaDB() . "<br>";
    }
}





$bp->zatvoriDB();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registracija</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Lukas Krištić">
        <meta name="title" content="Projekt">
        <meta name="date" content="25.05.2018">
        <meta name="description" content="Obrazac za registraciju">
        <link href="css/lukkristi.css" rel="stylesheet" type="text/css">       
        <script type="text/javascript" src="lukkristi.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css"> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>              
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> 
        <script type="text/javascript" src="lukkristi.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>

    </head>
    <script type="text/javascript">

        function provjeriKorisnika(val) {
            $.ajax({
                type: "POST",
                url: "ProvjeraKorisnika.php",
                data: 'korime=' + val,
                success: function (data) {
                    $("#greske").html(data);
                }

            });
        }


    </script>
    <body>
        <header>

            <h1 id="pocetak">Registracija</h1>
            <div class="lijevo" >
                <p class="grupa">Izbornik
                    <span class="datum">Datum: 25.05.2018. Vrijeme: 23:58</span>
                </p>
                <a class="desno" href="Prijava.php">Prijava</a>
            </div>
        </header>
        <nav>
            <ul>
                <li><a href="Index.php">Početna</a></li>
                <li><a href="Prijava.php">Prijava</a></li>                                            
            </ul>
        </nav>

        <section id="sadrzaj">
            <h2>Registracija</h2>
            <div id="greske"></div>
            <form id="registracija" method="post" name="registracija" action="Registracija.php">
                <div class="blokForme">
                    <label for="ime">Ime: </label>
                    <input type="text"  id="ime" name="ime"   placeholder="Ime" > <span id="greskaIme"> </span><br>
                </div><br>
                <div class="blokForme">
                    <label for="prezime">Prezime: </label>                
                    <input type="text"  class="" id="prezime" name="prezime"   placeholder="Prezime" ><br>
                </div><br>
                <div class="blokForme">
                    <label for="korime">Korisničko ime: </label>                
                    <input type="text" class="" id="korime" name="korime"   placeholder="korisničko ime" onkeyup="provjeriKorisnika(this.value)" > <span id="greskaKorime"> </span><br>
                </div><br>               
                <div class="blokForme">
                    <label for="email">Email adresa: </label>               
                    <input type="email" id="email" name="email"   placeholder="ime.prezime@posluzitelj.xxx" ><br>                                       
                </div>   <br>                            
                <div class="blokForme"> 
                    <label for="lozinka1">Lozinka: </label> 
                    <input type="password"  id="lozinka1" name="lozinka1"    placeholder="lozinka" > <span id="greskaLozinka"> </span><br>
                </div><br>
                <div class="blokForme">
                    <label for="lozinka2">Ponovi lozinku: </label>
                    <input type="password" id="lozinka2" name="lozinka2"   placeholder="lozinka" ><br>
                </div>
                <br>
                <div> 
                    <input id="Posalji" type="submit" name="Posalji" value="Registriraj se">
                    <a href="Prijava.php">Prijava</a>
                </div><br>

                <div class="g-recaptcha" data-sitekey="6LfbAl0UAAAAAP_V6AVRELwAe4svXHvK3n16B_Mq"></div>

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
