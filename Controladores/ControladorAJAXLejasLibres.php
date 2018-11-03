<?php

include '../DAO/DAOOperaciones.php';

session_start();
$idEstanteria = $_REQUEST['idestanteria'];

$resultado = DAOOperaciones::dimeLejasLibres($idEstanteria);


$_SESSION['lejas'] = $resultado;

header('Location: ../Vistas/VistaLejasDisponibles.php');


?>
