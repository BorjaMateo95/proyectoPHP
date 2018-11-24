<?php

include '../DAO/DAOOperaciones.php';
session_start();

$email = $_REQUEST['email'];
$password = $_REQUEST['password'];

try{
    DAOOperaciones::loginUsuario($email, $password);
    $_SESSION['almacen'] = DAOOperaciones::datosAlmacen();
    header('Location: ../Vistas/menu.php');
} catch (Exception $ex) {
    header('Location: ../Vistas/VistaLoginIncorrecto.php?ex=' . $ex);
}

