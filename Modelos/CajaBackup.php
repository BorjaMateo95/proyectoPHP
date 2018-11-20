<?php

class CajaBackup extends Caja {
    
    private $fechaVenta;
    private $leja;
    private $idEstanteria;
    
    function __construct($codigo, $altura, $anchura, $profundidad, $material, $color, $contenido, $fechaAlta, $fechaVenta,
            $leja, $idEstanteria) {
        parent::__construct($codigo, $altura, $anchura, $profundidad, $material, $color, $contenido, $fechaAlta);
        $this->fechaVenta = $fechaVenta;
        $this->leja = $leja;
        $this->idEstanteria = $idEstanteria;
    }
    
    function getFechaVenta() {
        return $this->fechaVenta;
    }

    function getLeja() {
        return $this->leja;
    }


    function getIdEstanteria() {
        return $this->idEstanteria;
    }

    function setIdEstanteria($idEstanteria) {
        $this->idEstanteria = $idEstanteria;
    }

    
    function setFechaVenta($fechaVenta) {
        $this->fechaVenta = $fechaVenta;
    }

    function setLeja($leja) {
        $this->leja = $leja;
    }

  


    
}
