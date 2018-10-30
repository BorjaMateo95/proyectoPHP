<?php

class MiException extends Exception{
    
    private $codigo;
    private $mensaje;
    
    function __construct($codigo, $mensaje) {
        $this->codigo = $codigo;
        $this->mensaje = $mensaje;
    }
    
    public function __toString() {
         return $this->mensaje;
    }


}
