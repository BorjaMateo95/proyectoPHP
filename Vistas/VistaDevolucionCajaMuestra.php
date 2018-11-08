<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Devolucion Caja</title>
        
        <link href="Estilos/EstiloAltaEstanteria.css" type="text/css" rel="stylesheet">
        
        <script type="text/javascript" src="JS/JSControlLejasLibres.js"></script>
    </head>
    <body>
        <?php
              include_once '../Modelos/Caja.php';
              include_once '../Modelos/CajaBackup.php';
              include_once '../Modelos/Estanteria.php';
                                          
              session_start();
              
              $cajaBackup = $_SESSION['cajaBackup'];
              $estanteriasLibres = $_SESSION['estanterias'];
              
        ?>
        
        <center>
        <h3>Devolucion caja</h3>
        

        <div id="contenedor">
            <form name="formularioAltaCaja" action="../Controladores/ControladorDevolucionCajaMuestra.php">
                
                <label>Codigo</label>
                <input type="text" id="codigo" name="codigo" value="<?php echo $cajaBackup->getCodigo()?>" required="true" readonly="true"><br>

                <label>Altura</label>
                <input type="number" id="altura" name="altura" value="<?php echo $cajaBackup->getAltura()?>"  required="true" readonly="true"><br>
                
                <label>Anchura</label>
                <input type="number" id="anchura" name="anchura" value="<?php echo  $cajaBackup->getAnchura()?>" required="true" readonly="true"><br>
                
                <label>Profundidad</label>
                <input type="number" id="profundidad" name="profundidad" value="<?php echo $cajaBackup->getProfundidad()?>" readonly="true" required="true"><br>
                
                <label>Material</label>
                <input type="text" id="material" name="material" value="<?php echo $cajaBackup->getMaterial()?>" readonly="true" required="true"><br>
                
                <label>Color</label>
                <input type="text" id="color" name="color" value="<?php echo $cajaBackup->getColor()?>" readonly="true" required="true"><br>
                
                <label>Contenido</label>
                <input type="text" id="contenido" name="contenido" value="<?php echo $cajaBackup->getContenido()?>" readonly="true" required="true"><br>
                
        <?php
 
              echo "<label>Estanterias con lejas libres </label>";
              
              echo "<select id='estanteriasDisponibles' name='estanteriasDisponibles' onchange='cargaLejasLibres(this.value)'>";
              echo "<option value=0>Selecciona Estanteria</option>";
              for ($i = 0; $i < count($estanteriasLibres); $i++){
                    echo "<option value=". $estanteriasLibres[$i]->getId() .">Codigo " . $estanteriasLibres[$i]->getCodigo() . "</option>";
              }
              
              echo "</select>";
               
        ?>     
                
                
                <label>Lejas libres</label>
                <select id="listaLejas" name="listaLejas">
                   

                </select>
                
                <br>
                <input type="submit" value="Devolver" id="guardar">
                
            </form>
        </div>
        
        </center>
    </body>
</html>
