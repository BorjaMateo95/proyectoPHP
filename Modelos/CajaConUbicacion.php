<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CajaConUbicacion
 *
 * @author BORJA
 */
class CajaConUbicacion extends Caja{
    
    private $estanteria;
    private $leja;
    
    function __construct($codigo, $altura, $anchura, $profundidad, $material, $color, $contenido, $fechaAlta, 
            $estanteria, $leja) {
        parent::__construct($codigo, $altura, $anchura, $profundidad, $material, $color, $contenido, $fechaAlta);
        $this->leja = $leja;
        $this->estanteria = $estanteria;
    }
    
    function getLeja() {
        return $this->leja;
    }

    function setLeja($leja) {
        $this->leja = $leja;
    }
    
    function getEstanteria() {
        return $this->estanteria;
    }

    function setEstanteria($estanteria) {
        $this->estanteria = $estanteria;
    }



}
