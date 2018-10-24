<?php

include '../DAO/DAOOperaciones.php';

session_start();
$idEstanteria = $_REQUEST['idestanteria'];

$resultado = DAOOperaciones::dimeLejasLibres($idEstanteria);


header('Location: ../Vistas/VistaAltaCaja.php?resultado=' . $resultado);


?>
