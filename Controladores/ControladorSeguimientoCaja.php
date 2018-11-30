<?php

include_once '../DAO/DAOOperaciones.php';
include_once '../Excepciones/MiException.php';
session_start();

$codigo = $_REQUEST['codigo'];

try{
    $resultado = DAOOperaciones::seguimientoCaja($codigo);
    $nombreClase = get_class($resultado);
    $_SESSION['caja'] = $resultado;
    
    if($nombreClase == 'CajaConUbicacion') {
       header('Location: ../Vistas/VistaCajaConUbicacion.php');
    }else{
       header('Location: ../Vistas/VistaCajaBackupSegui.php'); 
    }

} catch (MiException $ex) {
    header('Location: ../Vistas/VistaErrores.php?ex=' . $ex);
}
