<?php

include '../DAO/DAOOperaciones.php';

$respuestaInventario = DAOOperaciones::dameInventario();
header('Location: ../Vistas/VistaInventario.php?inventario=' . $respuestaInventario);


