<?php

class CajaConLeja extends Caja{
    
    private $leja;
    
    function __construct($codigo, $altura, $anchura, $profundidad, $material, $color, $contenido, $fechaAlta, $leja) {
        parent::__construct($codigo, $altura, $anchura, $profundidad, $material, $color, $contenido, $fechaAlta);
        $this->leja = $leja;
    }
    
    function getLeja() {
        return $this->leja;
    }

    function setLeja($leja) {
        $this->leja = $leja;
    }



}
