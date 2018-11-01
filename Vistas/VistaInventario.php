<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inventario</title>
    </head>
    <body>
        <?php
                      
            include_once '../Modelos/Caja.php';
            include_once '../Modelos/Estanteria.php';
            include_once '../Modelos/Inventario.php';
            include_once '../Modelos/CajaConLeja.php';
            include_once '../Modelos/EstanteriaConCajas.php';
            
            session_start();
            
            $inventario = $_SESSION['inventario'];
           
            ?>
        <h2>Inventario con Fecha: <?php echo $inventario->getFecha();?></h2>
        
        <?php

                foreach($inventario->getArrayEstanterias() as $objeto){
                    //var_dump($objeto);
 
                    echo "<b>Codigo: ".$objeto->getCodigo() . " " . "</b>";
                    echo "<b>Numero de lejas: ".$objeto->getNumlejas() . " " . "</b>";
                    echo "<b>Lejas Ocupadas: ".$objeto->getOcupadas() . " " . "</b>";
                    echo "<b>Pasillo: ".$objeto->getPasillo() . " " . "</b>";
                    echo "<b>Numero: ".$objeto->getNumero() . " " . "</b>";
                    
                    echo "<br>";
                    
                    if ($objeto->getArrayCajasConLeja() != null) {
                        foreach ($objeto->getArrayCajasConLeja() as $caja) {
                            echo "Codigo caja: " . $caja->getCodigo() . " ";
                            echo "altura caja: " . $caja->getAltura() . " ";
                            echo "anchura caja: " . $caja->getAnchura() . " ";
                            echo "profundida caja: " . $caja->getProfundidad() . " ";
                            echo "material caja: " . $caja->getMaterial() . " ";
                            echo "Color caja: " . $caja->getColor() . " ";
                            echo "Contenido caja: " . $caja->getContenido() . " ";
                            echo "Leja caja: " . $caja->getLeja() . " ";
                            echo "<br>";
                        }
                    }
                }
            
        ?>
    </body>
</html>
