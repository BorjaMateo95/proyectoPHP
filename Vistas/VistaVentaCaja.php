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
                
    </head>
    <body>
    <center>
        
        <?php
        // put your code here
                $opcion = $_REQUEST['opcion'];
        ?>
        
        <h3><?php echo $opcion?> de Caja</h3>

        <div id="contenedor">
            <form name="formularioVentaCaja" action="../Controladores/ControladorVentaCaja.php?opcion="<?php $opcion ?>>

                <label>Codigo</label>
                <input type="text" id="codigo" name="codigo" placeholder="Codigo de la caja" 
                       required="true" onchange="buscaCaja(this.value, <?php $opcion ?>)">
                
                <label id="descripcionCaja">
                    
                </label>
                <br>
                
                <input type="button" value="<?php echo $opcion?> Caja">
                
                </input>

            </form>
        </div>

    </center>

    </body>
</html>
