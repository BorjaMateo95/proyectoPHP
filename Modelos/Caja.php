<?php

/**
 * Description of Caja
 *
 * @author BORJA
 */
class Caja {
    private $id;
    private $codigo;
    private $altura;
    private $anchura;
    private $profundidad;
    private $material;
    private $color;
    private $contenido;
    
    function __construct($codigo, $altura, $anchura, $profundidad, $material, $color, $contenido) {
        $this->codigo = $codigo;
        $this->altura = $altura;
        $this->anchura = $anchura;
        $this->profundidad = $profundidad;
        $this->material = $material;
        $this->color = $color;
        $this->contenido = $contenido;
    }
    
    function getId() {
        return $this->id;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getAltura() {
        return $this->altura;
    }

    function getAnchura() {
        return $this->anchura;
    }

    function getProfundidad() {
        return $this->profundidad;
    }

    function getMaterial() {
        return $this->material;
    }

    function getColor() {
        return $this->color;
    }

    function getContenido() {
        return $this->contenido;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setAltura($altura) {
        $this->altura = $altura;
    }

    function setAnchura($anchura) {
        $this->anchura = $anchura;
    }

    function setProfundidad($profundidad) {
        $this->profundidad = $profundidad;
    }

    function setMaterial($material) {
        $this->material = $material;
    }

    function setColor($color) {
        $this->color = $color;
    }

    function setContenido($contenido) {
        $this->contenido = $contenido;
    }
 




}
