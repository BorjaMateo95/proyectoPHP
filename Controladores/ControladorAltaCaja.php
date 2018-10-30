<?php

include '../DAO/DAOOperaciones.php';
include '../Modelos/Caja.php';
include '../Modelos/Ocupacion.php';
include '../Excepciones/MiException.php';

//DATOS CAJA
$codigo = $_REQUEST['codigo'];
$altura = $_REQUEST['altura'];
$anchura = $_REQUEST['anchura'];
$profundidad = $_REQUEST['profundidad'];
$material = $_REQUEST['material'];
$color = $_REQUEST['color'];
$contenido = $_REQUEST['contenido'];

//ocupacion
$idEstanteria = $_REQUEST['estanteriasDisponibles'];
$numLeja = $_REQUEST['listaLejas'];

$caja = new Caja($codigo, $altura, $anchura, $profundidad, $material, $color, $contenido);
$ocupacion = new Ocupacion($idEstanteria, $numLeja);

//transacciones en el controlador tambien se puede controlar en la capa DAO
$conn->autocommit(false);

try{
    $respuestaInsert = DAOOperaciones::insertaCaja($caja, $ocupacion);
    $conn->commit();
    $conn->autocommit(true);
    $conn->close();
    header('Location: ../Vistas/VistaMensaje.php?filas=Caja insertada correctamente' . '&id=2');
} catch (MiException $ex) {
    $conn->rollback();
    header('Location: ../Vistas/VistaErrores.php?ex=' . $ex);
}



?>
