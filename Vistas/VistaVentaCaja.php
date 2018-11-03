<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Venta de caja</title>
        
        <script type="text/javascript" src="JS/JSDescripcionCaja.js"></script>
                
    </head>
    <body>
    <center>
        <h3>Venta de Caja</h3>

        <div id="contenedor">
            <form name="formularioVentaCaja" action="../Controladores/ControladorVentaCaja.php">

                <label>Codigo</label>
                <input type="text" id="codigo" name="codigo" placeholder="Codigo de la caja" required="true" onchange="buscaCaja(this.value)">
                
                <label id="descripcionCaja">
                    
                </label>
                <br>
                
                <input type="button" value="Vender Caja">
                
                </input>

            </form>
        </div>

    </center>
        <?php
        // put your code here
        ?>
    </body>
</html>
