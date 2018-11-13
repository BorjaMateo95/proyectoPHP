<?php

include '../DAO/DAOOperaciones.php';

$email = $_REQUEST['email'];
$password = $_REQUEST['password'];

try{
    $respuesta = DAOOperaciones::loginUsuario($email, $password);
    header('Location: ../index.php?log=' . $respuesta);
} catch (Exception $ex) {
    header('Location: ../Vistas/VistaErrores.php?ex=' . $ex);
}

