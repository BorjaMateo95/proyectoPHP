<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Alta Estanteria</title>
        
        <link href="../Estilos/EstiloAltaEstanteria.css" type="text/css" rel="stylesheet">

    </head>
    <body>
        <center>
        <h3>Alta de Estanteria</h3>

        <div id="contenedor">
            <form name="formularioAltaEstanteria" action="../Controladores/ControladorAltaEstanteria.php">
                
                <label>Codigo</label>
                <input type="text" id="codigo" name="codigo" placeholder="Codigo" required="true"><br>

                <label>Numero de Lejas</label>
                <input type="text" id="nLejas" name="Numero de Lejas" placeholder="Numero de Lejas" required="true"><br>
                
                <label>Pasillo</label>
                <input type="text" id="pasillo" name="pasillo" placeholder="Pasillo" required="true"><br>
                
                <label>Numero</label>
                <input type="number" id="numero" name="Numero" placeholder="Numero" required="true"><br>
                
                <input type="submit" value="Guardar" id="guardar">
                
            </form>
        </div>
        
        </center>
        <?php
        // put your code here
        ?>
    </body>
</html>
