<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listado Estanterias</title>
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
            include_once '../Modelos/Estanteria.php';
            session_start();
            $estanterias = $_SESSION['listadoEstanterias'];
        ?>
           <center>
        
        <h2>Listado de Estanterias</h2>
        </br>
        
        <div class="table-responsive" style="width:80%;">
            <table class="table table-striped table-hover">
                <tr style="background-color:#343a40">
                    <th style="color:#F7F9F9"><b>Código</b></th>
                    <th style="color:#F7F9F9"><b>Lejas</b></th>
                    <th style="color:#F7F9F9"><b>Lejas Ocupadas</b></th>
                    <th style="color:#F7F9F9"><b>Pasillo</b></th>
                    <th style="color:#F7F9F9"><b>Numero</b></th>
		</tr>

                <?php
                    foreach($estanterias as $objeto){
                        echo '
                            <tr>
                                <td>' . $objeto->getCodigo() . '</td>
                                <td>' . $objeto->getNumlejas() . '</td>
                                <td>' . $objeto->getOcupadas() . '</td>
                                <td>' . $objeto->getPasillo() . '</td>
                                <td>' . $objeto->getNumero() . '</td>                                                
                            </tr>';
                    }
                ?>
            </table>
        </div>
        </center>
    </body>
</html>
