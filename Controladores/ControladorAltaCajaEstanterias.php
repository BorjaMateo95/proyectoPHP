<?php

include '../DAO/DAOOperaciones.php';
session_start();
              

try{
    $_SESSION['estanterias'] = DAOOperaciones::dameEstanteriasConLejasLibres();
    header('Location: ../Vistas/VistaAltaCaja.php');
} catch (MiException $ex) {
    header('Location: ../Vistas/VistaErrores.php?ex=' . $ex);
}
