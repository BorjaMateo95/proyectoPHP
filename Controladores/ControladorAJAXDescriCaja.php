<?php

include '../DAO/DAOOperaciones.php';

session_start();
$codcaja = $_REQUEST['codcaja'];

try {
    $resultado = DAOOperaciones::dimeDescripcionUnaCaja($codcaja);
    $_SESSION['caja'] = $resultado;
    header('Location: ../Vistas/VistaDescriCaja.php');
} catch (MiException $ex) {
    header('Location: ../Vistas/VistaErroresDescriCaja.php?ex=' . $ex);
}





