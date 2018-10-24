<?php

include '../DAO/DAOOperaciones.php';
session_start();
              
$_SESSION['estanterias'] = DAOOperaciones::dameEstanteriasConLejasLibres();
header('Location: ../Vistas/VistaAltaCaja.php');
