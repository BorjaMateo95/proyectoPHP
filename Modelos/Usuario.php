<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author BORJA
 */
class Usuario {
    
    private $dni;
    private $nombre;
    private $apellidos;
    private $email;
    private $contrasena;
    
   
    function __construct($dni, $nombre, $apellidos, $email, $contrasena) {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->contrasena = $contrasena;
    }
    
    
    
    function getDni() {
        return $this->dni;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }


    function getEmail() {
        return $this->email;
    }

    function getContrasena() {
        return $this->contrasena;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }


    function setEmail($email) {
        $this->email = $email;
    }

    function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }



    
}
