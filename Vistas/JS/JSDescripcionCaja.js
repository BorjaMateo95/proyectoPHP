
function buscaCaja(str, opcion) {
    
var xmlhttp;
    if (str == "") {
        document.getElementById("codigo").innerHTML = "";
        return;
    }

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("descripcionCaja").innerHTML = xmlhttp.responseText;
            
        }
    }
    
    xmlhttp.open("GET", "../Controladores/ControladorAJAXDescriCaja.php?codcaja=" + str + "&opcion=" + opcion, true);
    xmlhttp.send();


}