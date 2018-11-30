<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CajaBackupSegui
 *
 * @author BORJA
 */
class CajaBackupSegui extends Caja {
    
    private $fechaVenta;
    private $leja;
    private $idEstanteria;
    private $vecesDevuelta;
    
    function __construct($codigo, $altura, $anchura, $profundidad, $material, $color, $contenido, $fechaAlta, $fechaVenta,
            $leja, $idEstanteria, $vecesDevuelta) {
        parent::__construct($codigo, $altura, $anchura, $profundidad, $material, $color, $contenido, $fechaAlta);
        $this->fechaVenta = $fechaVenta;
        $this->leja = $leja;
        $this->idEstanteria = $idEstanteria;
        $this->vecesDevuelta = $vecesDevuelta;
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
    
    function getVecesDevuelta() {
        return $this->vecesDevuelta;
    }

    function setVecesDevuelta($vecesDevuelta) {
        $this->vecesDevuelta = $vecesDevuelta;
    }


}
