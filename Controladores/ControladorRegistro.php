<?php

include_once '../DAO/DAOOperaciones.php';
include_once '../Modelos/Usuario.php';

$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$dni = $_REQUEST['dni'];
$email = $_REQUEST['email'];
$password1 = $_REQUEST['password1'];
$password2 = $_REQUEST['password2'];

$usuario = new Usuario($dni, $nombre, $apellidos, $email, $password1);

try{
    DAOOperaciones::registroUsuario($usuario, $password2);
    header('Location: ../index.php');
} catch (Exception $ex) {
    header('Location: ../Vistas/VistaRegistroIncorrecto.php?ex=' . $ex);
}

