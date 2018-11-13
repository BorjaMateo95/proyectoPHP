<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">

        <title>Proyecto Cajas</title>

        <link href="Vistas/Estilos/Estilo.css" type="text/css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
              integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    </head>
    <body>
        
        <?php
        // put your code here
            session_start();
            //$valorLogin = $_SESSION['login'];
            $log = $_GET['log'];
            //$log = 1;
            if($log == null) {
                header('Location:./Vistas/VistaLogin.php');
                $login = true;
            }else{
                $login = true;
            }
        ?>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            
            <div>
                <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Menu</a>
            </div>
            
            <div class="container">
                <a class="navbar-brand" href="./"><b>Almacen Borja</b></a>
                <button class="navbar-toggler" type="button"  aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav mr-auto">

                    </ul>
                        <a class="btn btn-outline-success d-lg-inline-block mb-3 mb-md-0 ml-md-3" href="">Iniciar Sesion</a>
              
                </div>

            </div>

        </nav>
        
      
        <div class="container">
            <h1>Bienvenido a Almacen Borja</h1>
        </div>
        <div id="wrapper">
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand">
                        <a href="#">
                            Almacen Borja
                        </a>
                    </li>
                    <li>
                        <a href="Vistas/VistaAltaEstanteria.php">Alta Estanteria</a>
                    </li>
                    <li>
                        <a href="Controladores/ControladorAltaCajaEstanterias.php">Alta Caja</a>
                    </li>
                    <li>
                        <a href="Controladores/ControladorInventario.php">Inventario</a>
                    </li>
                    <li>
                        <a href="Vistas/VistaVentaCaja.php?opcion=Venta">Vender Caja</a>
                    </li>
                    <li>
                        <a href="Vistas/VistaDevolucionCaja.php">Devolver Caja</a>
                    </li>
                    <li>
                        <a href="Controladores/ControladorListadoCajas.php">Listado Cajas</a>
                    </li>
                    
                    <li>
                        <a href="Controladores/ControladorListadoEstanterias.php">Listado Estanterias</a>
                    </li>
                    
                </ul>
            </div>
        </div>

   <script>
       $("#menu-toggle").click(function(e) {
           e.preventDefault();
           $("#wrapper").toggleClass("toggled");
       });
        </script>
        
    </body>
</html>
