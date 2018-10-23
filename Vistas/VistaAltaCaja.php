<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Alta Caja</title>
        
        <link href="../Estilos/EstiloAltaEstanteria.css" type="text/css" rel="stylesheet">

    </head>
    <body>
        <center>
        <h3>Alta de Caja</h3>

        <div id="contenedor">
            <form name="formularioAltaCaja" action="../Controladores/ControladorAltaCaja.php">
                
                <label>Codigo</label>
                <input type="text" id="codigo" name="codigo" placeholder="Codigo" required="true"><br>

                <label>Altura</label>
                <input type="number" id="altura" name="altura" placeholder="Altura" required="true"><br>
                
                <label>Anchura</label>
                <input type="number" id="anchura" name="anchura" placeholder="Anchura" required="true"><br>
                
                <label>Profundidad</label>
                <input type="number" id="profundidad" name="profundidad" placeholder="Profundidad" required="true"><br>
                
                <label>Material</label>
                <input type="text" id="material" name="material" placeholder="Material" required="true"><br>
                
                <label>Color</label>
                <input type="text" id="color" name="color" placeholder="Color" required="true"><br>
                
                <label>Contenido</label>
                <input type="text" id="contenido" name="contenido" placeholder="Contenido" required="true"><br>
                
        <?php
              include '../DAO/DAOOperaciones.php';
              
              $estanteriasLibres = DAOOperaciones::dameEstanteriasConLejasLibres();
              
              
              echo "<label>Estanterias con lejas libres </label>";
              
              echo "<select name='estanteriasDisponibles'>";
              for ($i = 0; $i < count($estanteriasLibres); $i++){
                    echo "<option value=". $i ."'>Codigo " . $estanteriasLibres[$i][1] . "</option>";
              }
              echo "</select>";
              echo "</br>";
               
        ?>          
                <input type="submit" value="Guardar" id="guardar">
                
            </form>
        </div>
        
        </center>
  
    </body>
</html>
