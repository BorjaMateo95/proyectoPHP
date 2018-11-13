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
        
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
              integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        
        <style>
		.content {
			margin-top: 80px;
		}
                
	</style>
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
        
        <center>
        
        <h2>Inventario con Fecha: <?php echo $inventario->getFecha();?></h2>
        
        <div class="table-responsive" style="width:80%;">
            <table class="table table-striped table-hover">
                                
               <?php

                foreach($inventario->getArrayEstanterias() as $objeto){
                    ?>
                <tr style="background-color:#343a40">
                    <th style="color:#F7F9F9"><b>Código</b></th>
                    <th style="color:#F7F9F9"><b>Lejas</b></th>
                    <th style="color:#F7F9F9"><b>Lejas Ocupadas</b></th>
                    <th style="color:#F7F9F9"><b>Pasillo</b></th>
                    <th style="color:#F7F9F9"><b>Numero</b></th>
		</tr>
                <?php
                        echo '
                            <tr>
                                <td>' . $objeto->getCodigo() . '</td>
                                <td>' . $objeto->getNumlejas() . '</td>
                                <td>' . $objeto->getOcupadas() . '</td>
                                <td>' . $objeto->getPasillo() . '</td>
                                <td>' . $objeto->getNumero() . '</td>                                                
                            </tr>';
                    
                    echo "<br>";
                    
                    if ($objeto->getArrayCajasConLeja() != null) {
                        ?>
                            <tr style="background-color:#566573">
                                <th style="color:#F7F9F9"><b>Código</b></th>
                                <th style="color:#F7F9F9"><b>Altura</b></th>
                                <th style="color:#F7F9F9"><b>Anchura</b></th>
                                <th style="color:#F7F9F9"><b>Profundidad</b></th>
                                <th style="color:#F7F9F9"><b>Material</b></th>
                                <th style="color:#F7F9F9"><b>Color</b></th>
                                <th style="color:#F7F9F9"><b>Contenido</b></th>
                                <th style="color:#F7F9F9"><b>Fecha Alta</b></th>
                                <th style="color:#F7F9F9"><b>Leja</b></th>
                            </tr>
                            
                         <?php
                         
                        foreach ($objeto->getArrayCajasConLeja() as $caja) {
                         echo '
                            <tr>
                                <td>' . $caja->getCodigo() . '</td>
                                <td>' . $caja->getAltura() . '</td>
                                <td>' . $caja->getAnchura() . '</td>
                                <td>' . $caja->getProfundidad() . '</td>
                                <td>' . $caja->getMaterial() . '</td>
                                <td>' . $caja->getColor() . '</td>
                                <td>' . $caja->getContenido() . '</td>
                                <td>' . " " . '</td>
                                <td>' . $caja->getLeja() . '</td>
                                                
                            </tr>';
                        }
                    }
                }
            
        ?>


            </table>
        </div>
        </center>
        
       
    </body>
</html>
