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
        
            include_once '../Modelos/Almacen.php';
            session_start();
            
            $almacen = $_SESSION['almacen'];
        ?>
       
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="menu.php"><?php echo $almacen->getNombre(); ?></a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" 
                                            href="#">Cajas <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="../Controladores/ControladorListadoCajas.php">Listado de Cajas</a></li>
                            <li><a href="../Controladores/ControladorAltaCajaEstanterias.php">Insertar Caja</a></li>
                            <li><a href="VistaVentaCaja.php">Vender Caja</a></li>
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
        
        <div class="container" style="width: 50%; margin-top: 7rem;">
            <div class="panel-group">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4><?php echo $almacen->getCodigo() . " " . $almacen->getNombre(); ?></h4>
                    </div>
                    <div class="panel-body">
                        <p><b>Codigo: </b><?php echo $almacen->getCodigo(); ?></p>
                        <p><b>Nombre: </b><?php echo $almacen->getNombre(); ?></p>
                        <p><b>Direccion: </b><?php echo $almacen->getDireccion(); ?></p>
                        <p><b>Pasillos: </b><?php echo $almacen->getDisePasillos(); ?></p>
                        <p><b>Numeros: </b><?php echo $almacen->getNumeros(); ?></p>
                    </div>
                </div>
            </div>
        </div>


    </body>
</html>
