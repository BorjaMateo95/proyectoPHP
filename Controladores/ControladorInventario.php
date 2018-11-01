<?php


include '../DAO/DAOOperaciones.php';
include_once '../Modelos/Inventario.php';

session_start();

//try catch
$_SESSION['inventario'] = DAOOperaciones::dameInventario();
header('Location: ../Vistas/VistaInventario.php');


