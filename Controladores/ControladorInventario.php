<?php


include '../DAO/DAOOperaciones.php';
include_once '../Modelos/Inventario.php';

session_start();

try {
    $_SESSION['inventario'] = DAOOperaciones::dameInventario();
    header('Location: ../Vistas/VistaInventario.php');
} catch (MiException $ex) {
    header('Location: ../Vistas/VistaErrores.php?ex=' . $ex);
}
