<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>

        <meta charset="UTF-8">
        <title>Almacen Borja</title>
        <link href="Vistas/Estilos/Estilo.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php
        // put your code here
        ?>
       
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="menu.php">Almacen Borja</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" 
                                            href="#">Cajas <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="../Controladores/ControladorListadoCajas.php">Listado de Cajas</a></li>
                            <li><a href="../Controladores/ControladorAltaCajaEstanterias.php">Insertar Caja</a></li>
                            <li><a href="VistaVentaCaja.php?opcion=Venta">Vender Caja</a></li>
                            <li><a href="VistaDevolucionCaja.php">Devolver Caja</a></li>
                        </ul>
                    </li>
                     <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" 
                                            href="#">Estanterias <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="../Controladores/ControladorListadoEstanterias.php">Listado de Estanterias</a></li>
                            <li><a href="VistaAltaEstanteria.php">Insertar Estanteria</a></li>
                        </ul>
                    </li>
                    <li><a href="../Controladores/ControladorInventario.php">Inventario</a></li>
                </ul>
            </div>
        </nav>


    </body>
</html>
