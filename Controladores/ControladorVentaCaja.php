<?php

include '../DAO/DAOOperaciones.php';

$codigo = $_REQUEST['codigo'];

try{
    $respuesta = DAOOperaciones::salidaCaja($codigo); 
    header('Location: ../Vistas/VistaMensaje.php?msg=' . $respuesta);
} catch (Exception $ex) {
    header('Location: ../Vistas/VistaErrores.php?ex=' . $ex);
}
