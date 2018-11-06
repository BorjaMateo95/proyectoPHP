<?php

include '../DAO/DAOOperaciones.php';

session_start();
$codcaja = $_REQUEST['codcaja'];
$opcion = $_REQUEST['opcion'];

try {
    $resultado = DAOOperaciones::dimeDescripcionUnaCaja($codcaja, $opcion);
    $_SESSION['caja'] = $resultado;
    header('Location: ../Vistas/VistaDescriCaja.php?opcion=' . $opcion);
} catch (MiException $ex) {
    header('Location: ../Vistas/VistaErrores.php?ex=' . $ex);
}





