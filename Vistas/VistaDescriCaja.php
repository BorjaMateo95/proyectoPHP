<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            include_once '../Modelos/Caja.php';
            include_once '../Modelos/CajaBackup.php';
            
            session_start();
            $caja = $_SESSION["caja"];
            
            ?>
                    <label>
                        
                        <?php echo "Codigo: " .$caja->getCodigo() . " Material: " . $caja->getMaterial()
                                . " Contenido: " . $caja->getContenido() . " Fecha Alta: " . $caja->getFechaAlta(); ?>
                    </label>
             <?php
            
        ?>
    </body>
</html>
