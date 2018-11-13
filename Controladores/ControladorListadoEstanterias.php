<?php

include_once '../DAO/DAOOperaciones.php';

session_start();

try{
    $_SESSION['listadoEstanterias'] = DAOOperaciones::listadoEstanterias();
    header('Location: ../Vistas/VistaListadoEstanterias.php');  
} catch (MiException $ex) {
    header('Location: ../Vistas/VistaErrores.php?ex=' . $ex);
}

