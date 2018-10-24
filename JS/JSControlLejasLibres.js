
function cargaLejasLibres(str) {
    
    var xmlhttp;
    if (str == "") {
        document.getElementById("estanteriasDisponibles").innerHTML = "";
        return;
    }

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("estanteriasDisponibles").innerHTML = xmlhttp.responseText;
            
        }
    }
    
    xmlhttp.open("GET", "../Controladores/ControladorAJAXLejasLibres.php?idestanteria=" + str, true);
    xmlhttp.send();
    
}


