<?php

include '../DAO/DAOOperaciones.php';
include '../Modelos/Caja.php';

$codigo = $_REQUEST['codigo'];
$altura = $_REQUEST['altura'];
$anchura = $_REQUEST['anchura'];
$profundidad = $_REQUEST['profundidad'];
$material = $_REQUEST['material'];
$color = $_REQUEST['color'];
$contenido = $_REQUEST['contenido'];

$caja = new Caja($codigo, $altura, $anchura, $profundidad, $material, $color, $contenido);

$respuestaInsert = DAOOperaciones::insertaCaja($caja);
header('Location: ../Vistas/VistaMensaje.php?filas=' . $respuestaInsert . '&id=1');

?>
