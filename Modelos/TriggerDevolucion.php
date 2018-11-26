<?php

//Borramos el trigger si existe
$sqlBorrarTrigger = "DROP TRIGGER IF EXISTS `devolucionCaja`";
$resultadoBorraTrigger = $conn->query($sqlBorrarTrigger);//controlar exception

$codigo = $cajaBacup->getCodigo();
$altura = $cajaBacup->getAltura();
$anchura = $cajaBacup->getAnchura();
$profundida = $cajaBacup->getProfundidad();
$color = $cajaBacup->getColor();
$material = $cajaBacup->getMaterial();
$contenido = $cajaBacup->getContenido();
$fechaAlta = $cajaBacup->getFechaAlta();
$idEstanteria = $cajaBacup->getIdEstanteria();
$leja = $cajaBacup->getLeja();

$triggerDevolucionCaja = "CREATE TRIGGER `devolucionCaja`
    BEFORE DELETE ON `cajas_backup` FOR EACH ROW BEGIN
    INSERT INTO cajas VALUES (null, '" . $codigo ."', " . $altura ." , " . $anchura ." , " . $profundida ." ,
    '" . $material ."' , '" . $color ."' , '" . $contenido ."' , '" . $fechaAlta . "');
    INSERT INTO ocupacion VALUES (null, (SELECT id FROM cajas WHERE codigo = '" . $codigo . "') , " . $idEstanteria .","
        . " " . $leja .");
    UPDATE estanterias SET ocupadas = ocupadas +1 WHERE id = " . $idEstanteria . ";"
        . "END";

$resultadoTrigger = $conn->query($triggerDevolucionCaja);

