function unosElemenata() {
    var ime = document.getElementById("ime").value;
    var prezime = document.getElementById("prezime").value;
    var korime = document.getElementById("korime").value;
    var email = document.getElementById("email").value;
    var lozinka1 = document.getElementById("lozinka1").value;
    var lozinka2 = document.getElementById("lozinka2").value;
    if (ime === "" || prezime === "" || korime === "" ||
            email === "" || lozinka1 === "" || lozinka2 === "") {
        alert("Svi tekstualni podaci mroaju biti uneseni!");
        event.preventDefault();

    }

}
window.addEventListener("submit", unosElemenata);

//Ime mora poceti velikim slovom
function provjeraIme() {
    var ime = document.getElementById("ime").value;
    var imeGreska = document.getElementById("greskaIme");
    if (ime[0] === ime[0].toLowerCase())
    {
        imeGreska.innerHTML = "Ime ne pocima sa velikim slovom!";
        document.getElementById("greskaIme").style.color = "#ff0000";
        event.preventDefault();
        //alert("radi velko");
    } else {
        imeGreska.innerHTML = "";
    }
}
//window.addEventListener("input", provjeraOpisaUsluge);
window.addEventListener("focusout", provjeraIme);


function duzinaLozinke() {
    var lozinka1 = document.getElementById("lozinka1").value;
    var lozinkaGreska = document.getElementById("greskaLozinka");

    if (lozinka1.length < 5) {
        lozinkaGreska.innerHTML = "Lozinka  mora imati barem 6 znakova";
        //alert("radi brojac");
        document.getElementById("greskaLozinka").style.color = "#ff0000";
        event.preventDefault();
    } else {
        lozinkaGreska.innerHTML = "";
    }
}
//window.addEventListener("input", provjeraOpisaUsluge);
window.addEventListener("focusout", duzinaLozinke);


$(document).ready(function () {
    $("#korime").keyup(function () {
//        alert("radi korime");
        var korime = document.getElementById("korime").value;
        var korimeGreska = document.getElementById("greskaKorime");
        if (4 >= korime.length) {
            $("#korime").addClass("pogresno");
            $("#korime").removeClass("tocno");
            korimeGreska.innerHTML = "Korisnicko ime mora imati barem 5 znakova";
            
            document.getElementById("greskaKorime").style.color = "#ff0000";
            event.preventDefault();
        } else {
            korimeGreska.innerHTML = "";
            $("#korime").removeClass("pogresno");
            $("#korime").addClass("tocno");
            

        }
    });
});

$(document).ready(function () {
    $("#prezime").keyup(function () {
        var prezime = document.getElementById("prezime").value;
        if (prezime[0] === prezime[0].toLowerCase()) {
            $("#prezime").addClass("pogresno");
            $("#prezime").removeClass("tocno");
//            alert("radi prevent prezime");
            event.preventDefault();
        } else {
            $("#prezime").removeClass("pogresno");
            $("#prezime").addClass("tocno");

        }
    });
});