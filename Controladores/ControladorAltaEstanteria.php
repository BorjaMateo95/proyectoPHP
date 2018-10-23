<?php

include '../DAO/DAOOperaciones.php';
include '../Modelos/Estanteria.php';

$codigo = $_REQUEST['codigo'];
$numLejas = $_REQUEST['nLejas'];
$pasillo = $_REQUEST['pasillo'];
$numero = $_REQUEST['numero'];

$estanteria = new Estanteria($codigo, $numLejas, $pasillo, $numero);

$respuestaInsert = DAOOperaciones::insertaEstanteria($estanteria);
header('Location: ../Vistas/VistaMensaje.php?filas=' . $respuestaInsert . '&id=1');

?>

