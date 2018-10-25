<?php

include '../DAO/DAOOperaciones.php';

session_start();
$idEstanteria = $_REQUEST['idestanteria'];

$resultado = DAOOperaciones::dimeLejasLibres($idEstanteria);

//$prueba = array();
//$prueba[0] = "Primer";
//$prueba[1] = "Segun";
//$prueba[2] = "Tercer";

$_SESSION['lejas'] = $resultado;

header('Location: ../Vistas/VistaLejasDisponibles.php');


?>
