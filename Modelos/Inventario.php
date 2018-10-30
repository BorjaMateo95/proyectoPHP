<?php

class Inventario {
    
    private $arrayEstanterias = array();
    private $fecha;
    
    function __construct($arrayEstanterias, $fecha) {
        $this->arrayEstanterias = $arrayEstanterias;
        $this->fecha = $fecha;
    }
    
    function getArrayEstanterias() {
        return $this->arrayEstanterias;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setArrayEstanterias($arrayEstanterias) {
        $this->arrayEstanterias = $arrayEstanterias;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }



    
}
