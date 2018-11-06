<?php

include '../DAO/DAOOperaciones.php';

$codigo = $_REQUEST['codigo'];
$opcion = $_REQUEST['opcion'];

try{
    
    if($codigo == "venta") {
       $respuesta = DAOOperaciones::salidaCaja($codigo); 
    }else{
       $respuesta = DAOOperaciones::devolucionCaja($codigo); 
    }
    
    header('Location: ../Vistas/VistaMensaje.php?filas=' . $respuesta . '&id=2');
} catch (Exception $ex) {
    header('Location: ../Vistas/VistaErrores.php?ex=' . $ex);
}
