<?php

/**
 * Description of Almacen
 *
 * @author BORJA
 */
class Almacen {
    
    private $id;
    private $codigo;
    private $nombre;
    private $direccion;
    private $disePasillos;
    private $numeros;
    
    function __construct($codigo, $nombre, $direccion, $disePasillos, $numeros) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->disePasillos = $disePasillos;
        $this->numeros = $numeros;
    }
    
    function getId() {
        return $this->id;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getDisePasillos() {
        return $this->disePasillos;
    }

    function getNumeros() {
        return $this->numeros;
    }


    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setDisePasillos($disePasillos) {
        $this->disePasillos = $disePasillos;
    }

    function setNumeros($numeros) {
        $this->numeros = $numeros;
    }



}
