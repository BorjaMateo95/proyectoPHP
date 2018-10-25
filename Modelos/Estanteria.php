<?php

/**
 * Description of Estanteria
 *
 * @author BORJA
 */
class Estanteria {
    
    private $id;
    private $codigo;
    private $numlejas;
    private $ocupadas;
    private $pasillo;
    private $numero;
    
    function __construct($codigo, $numlejas, $pasillo, $numero) {
        $this->codigo = $codigo;
        $this->numlejas = $numlejas;
        $this->pasillo = $pasillo;
        $this->numero = $numero;
    }
    
    function setId($id) {
        $this->id = $id;
    }

         
    
    function getId() {
        return $this->id;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getNumlejas() {
        return $this->numlejas;
    }

    function getOcupadas() {
        return $this->ocupadas;
    }

    function getPasillo() {
        return $this->pasillo;
    }

    function getNumero() {
        return $this->numero;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNumlejas($numlejas) {
        $this->numlejas = $numlejas;
    }

    function setOcupadas($ocupadas) {
        $this->ocupadas = $ocupadas;
    }

    function setPasillo($pasillo) {
        $this->pasillo = $pasillo;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }


}
