<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listado Cajas</title>
        
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
            session_start();
            $cajas = $_SESSION['listadoCajas'];
        ?>
        
    <center>
        
        <h2>Listado de Cajas</h2>
        </br>
        
        <a href="menu.php">
            <button type="button" class="btn btn-primary">Volver al inicio</button>
        </a>
                
        <div class="table-responsive" style="width:80%;">
            <table class="table table-striped table-hover">
                <tr style="background-color:#343a40">
                    <th style="color:#F7F9F9"><b>Código</b></th>
                    <th style="color:#F7F9F9"><b>Altura</b></th>
                    <th style="color:#F7F9F9"><b>Anchura</b></th>
                    <th style="color:#F7F9F9"><b>Profundidad</b></th>
                    <th style="color:#F7F9F9"><b>Material</b></th>
                    <th style="color:#F7F9F9"><b>Color</b></th>
                    <th style="color:#F7F9F9"><b>Contenido</b></th>
                    <th style="color:#F7F9F9"><b>Fecha Alta</b></th>
		</tr>

                <?php
                    foreach($cajas as $objeto){
                        echo '
                            <tr>
                                <td>' . $objeto->getCodigo() . '</td>
                                <td>' . $objeto->getAltura() . '</td>
                                <td>' . $objeto->getAnchura() . '</td>
                                <td>' . $objeto->getProfundidad() . '</td>
                                <td>' . $objeto->getMaterial() . '</td>
                                <td bgcolor=' . $objeto->getColor() . '></td>
                                <td>' . $objeto->getContenido() . '</td>
                                <td>' . date("d/m/Y", strtotime($objeto->getFechaAlta()))  . '</td>
                                                
                            </tr>';
                    }
                ?>
            </table>
        </div>
        </center>
    </body>
</html>
