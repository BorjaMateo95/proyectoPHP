<?php

include '../DAO/DAOOperaciones.php';
session_start();

$cajaBackup = $_SESSION['cajaBackup'];
$idEstanteria = $_REQUEST['estanteriasDisponibles'];
$numLeja = $_REQUEST['listaLejas'];

$cajaBackup->setIdEstanteria($idEstanteria);
$cajaBackup->setLeja($numLeja);

$conn->autocommit(false);

try{
    $respuesta = DAOOperaciones::devolucionCaja($cajaBackup);
    $conn->commit();
    $conn->autocommit(true);
    $conn->close();
    header('Location: ../Vistas/VistaMensaje.php?msg=' . $respuesta);
} catch (Exception $ex) {
    $conn->rollback();
    header('Location: ../Vistas/VistaErrores.php?ex=' . $ex);
}
