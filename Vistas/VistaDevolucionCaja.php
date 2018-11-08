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
                        
    </head>
    <body>
    <center>
        
        <?php
        // put your code here
                
        ?>
        
        <h3>Devolucion de Caja</h3>

        <div id="contenedor">
            <form name="formularioVentaCaja" action="../Controladores/ControladorDevolucionCaja.php">

                <label>Codigo</label>
                <input type="text" id="codigo" name="codigo" placeholder="Codigo de la caja" 
                       required="true">

                <br>
                
                <input type="submit" value="Devolucion Caja">
                
                </input>

            </form>
        </div>

    </center>

    </body>
</html>

