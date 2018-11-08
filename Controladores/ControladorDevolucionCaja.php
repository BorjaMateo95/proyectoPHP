<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../DAO/DAOOperaciones.php';
session_start();

$codigo = $_REQUEST['codigo'];

try{

    $_SESSION['cajaBackup'] = DAOOperaciones::dameCajaDevolucion($codigo);
    $_SESSION['estanterias'] = DAOOperaciones::dameEstanteriasConLejasLibres();
    
    header('Location: ../Vistas/VistaDevolucionCajaMuestra.php');
    
} catch (Exception $ex) {
    header('Location: ../Vistas/VistaErrores.php?ex=' . $ex);
}
