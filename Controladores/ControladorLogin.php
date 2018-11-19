<?php

include '../DAO/DAOOperaciones.php';

$email = $_REQUEST['email'];
$password = $_REQUEST['password'];

try{
    DAOOperaciones::loginUsuario($email, $password);
    header('Location: ../Vistas/menu.php');
} catch (Exception $ex) {
    header('Location: ../Vistas/VistaErrores.php?ex=' . $ex);
}

