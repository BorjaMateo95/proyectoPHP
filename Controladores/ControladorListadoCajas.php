<?php

include_once '../DAO/DAOOperaciones.php';
session_start();

try{
    $_SESSION['listadoCajas'] = DAOOperaciones::listadoCajas();
    header('Location: ../Vistas/VistaListadoCajas.php');
} catch (MiException $ex) {
    header('Location: ../Vistas/VistaErrores.php?ex=' . $ex);
}

