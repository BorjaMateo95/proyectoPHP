<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Caja</title>
        
        <script type="text/javascript" src="JS/JSDescripcionCaja.js"></script>
        <link href="Estilos/EstiloAltaEstanteria.css" type="text/css" rel="stylesheet">
                
    </head>
    <body>
    <center>
        <div id="contact-form" style="width: 40%; margin-left: 150px">
            
            <div>
                <h2>Venta de Caja</h2>
            </div>
            
            <form name="formularioVentaCaja" action="../Controladores/ControladorVentaCaja.php">

                <label>Codigo</label>
                <input type="text" id="codigo" name="codigo" placeholder="Codigo de la caja" 
                       required="true" onchange="buscaCaja(this.value)">
                
                <label id="descripcionCaja">
                    
                </label>
                <br>
                
                <div>		           
                    <button name="submit" type="submit" id="submit" >Vender Caja</button> 
                </div>

            </form>
        </div>

    </center>
    </body>
</html>
