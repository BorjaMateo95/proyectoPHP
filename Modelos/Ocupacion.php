<?php

/**
 * Description of Ocupacion
 *
 * @author BORJA
 */
class Ocupacion {
    
    private $id;
    private $idCaja;
    private $idEstanteria;
    private $numeroLeja;
    
    function __construct($idEstanteria, $numeroLeja) {
        $this->idEstanteria = $idEstanteria;
        $this->numeroLeja = $numeroLeja;
    }
    
    function getId() {
        return $this->id;
    }

    function getIdCaja() {
        return $this->idCaja;
    }

    function getIdEstanteria() {
        return $this->idEstanteria;
    }

    function getNumeroLeja() {
        return $this->numeroLeja;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdCaja($idCaja) {
        $this->idCaja = $idCaja;
    }

    function setIdEstanteria($idEstanteria) {
        $this->idEstanteria = $idEstanteria;
    }

    function setNumeroLeja($numeroLeja) {
        $this->numeroLeja = $numeroLeja;
    }



    
}
