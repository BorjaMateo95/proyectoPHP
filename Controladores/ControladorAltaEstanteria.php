<?php

include_once '../DAO/DAOOperaciones.php';
include_once '../Modelos/Estanteria.php';

$codigo = $_REQUEST['codigo'];
$numLejas = $_REQUEST['nLejas'];
$pasillo = $_REQUEST['pasillo'];
$numero = $_REQUEST['numero'];

$estanteriaObj = new Estanteria($codigo, $numLejas, $pasillo, $numero);

try{
    $respuestaInsert = DAOOperaciones::insertaEstanteria($estanteriaObj);
    header('Location: ../Vistas/VistaMensaje.php?msg=Estanteria insertada correctamente');    
} catch (Exception $ex) {
    header('Location: ../Vistas/VistaErrores.php?ex=' . $ex);
}


?>

