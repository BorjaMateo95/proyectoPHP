<?php

class CajaBackup extends Caja {
    
    private $fechaVenta;
    private $leja;
    private $codigoEstanteria;
    
    function __construct($codigo, $altura, $anchura, $profundidad, $material, $color, $contenido, $fechaVenta,
            $leja, $codigoEstanteria) {
        parent::__construct($codigo, $altura, $anchura, $profundidad, $material, $color, $contenido);
        $this->fechaVenta = $fechaVenta;
        $this->leja = $leja;
        $this->codigoEstanteria = $codigoEstanteria;
    }
    
    function getFechaVenta() {
        return $this->fechaVenta;
    }

    function getLeja() {
        return $this->leja;
    }

    function getCodigoEstanteria() {
        return $this->codigoEstanteria;
    }

    function setFechaVenta($fechaVenta) {
        $this->fechaVenta = $fechaVenta;
    }

    function setLeja($leja) {
        $this->leja = $leja;
    }

    function setCodigoEstanteria($codigoEstanteria) {
        $this->codigoEstanteria = $codigoEstanteria;
    }


    
}
