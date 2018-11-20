<?php

include '../DAO/DAOOperaciones.php';

$codigo = $_REQUEST['codigo'];

try{
    
    $respuesta = DAOOperaciones::salidaCaja($codigo); 
    header('Location: ../Vistas/VistaMensaje.php?filas=' . $respuesta . '&id=2');
} catch (Exception $ex) {
    header('Location: ../Vistas/VistaErrores.php?ex=' . $ex);
}
