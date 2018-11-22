<?php

include_once '../DAO/DAOOperaciones.php';
include_once '../Modelos/Caja.php';
include_once '../Modelos/Ocupacion.php';
include_once '../Excepciones/MiException.php';

//DATOS CAJA
$codigo = $_REQUEST['codigo'];
$altura = $_REQUEST['altura'];
$anchura = $_REQUEST['anchura'];
$profundidad = $_REQUEST['profundidad'];
$material = $_REQUEST['material'];
$color = $_REQUEST['color'];
$contenido = $_REQUEST['contenido'];
$fechaAlta = "";

//ocupacion
$idEstanteria = $_REQUEST['estanteriasDisponibles'];
$numLeja = $_REQUEST['listaLejas'];

$cajaObj = new Caja($codigo, $altura, $anchura, $profundidad, $material, $color, $contenido, $fechaAlta);
$ocupacion = new Ocupacion($idEstanteria, $numLeja);

//transacciones
$conn->autocommit(false);

try{
    $respuestaInsert = DAOOperaciones::insertaCaja($cajaObj, $ocupacion);
    $conn->commit();
    $conn->autocommit(true);
    $conn->close();
    header('Location: ../Vistas/VistaMensaje.php?msg=Caja insertada correctamente');
} catch (MiException $ex) {
    $conn->rollback();
    header('Location: ../Vistas/VistaErrores.php?ex=' . $ex);
}



?>
