<?php

/**
 * Description of EstanteriaConCajas
 */
class EstanteriaConCajas extends Estanteria{
    
    private $arrayCajasConLeja = array();
    
    function __construct($codigo, $numlejas, $pasillo, $numero, $arrayCajasConLeja) {
        parent::__construct($codigo, $numlejas, $pasillo, $numero);
        $this->arrayCajasConLeja = $arrayCajasConLeja;
    }
    
    function getArrayCajasConLeja() {
        return $this->arrayCajasConLeja;
    }

    function setArrayCajasConLeja($arrayCajasConLeja) {
        $this->arrayCajasConLeja = $arrayCajasConLeja;
    }



}
