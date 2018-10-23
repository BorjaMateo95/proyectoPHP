<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'ConexionBD.php';

class DAOOperaciones {
    
    /**
     * Metodo para insertar Estanterias en la base de datos.
     * Recibe un objeto de tipo Estanteria
     * @return resultado de la query
     */    
    public function insertaEstanteria($estanteria) {
        $orden = "INSERT INTO estanterias VALUES (null, '" . 
                $estanteria->getCodigo() . "', " . $estanteria->getNumLejas()
                . ", null ,'" . $estanteria->getPasillo() . "', " . $estanteria->getNumero() . ");";
            
            global $conn;
            $resultado = $conn -> query($orden);
            
            return $resultado;
    }
    
     /**
     * Metodo para insertar Cajas en lejas de una estanteria.
     * Recibe un objeto de tipo Caja
     * @return resultado de la query
     */    
    public function insertaCaja($caja) {
        $orden = "INSERT INTO cajas VALUES (null, '" . 
                $caja->getCodigo() . "', " . $caja->getAltura()
                . ", " . $caja->getAnchura() . ", " . $caja->getProfundidad()
                . ", '" . $caja->getMaterial() . "', '" . $caja->getColor() . "', '" . $caja->getContenido() . "')";
            
            global $conn;
            $resultado = $conn -> query($orden);
            
            return $resultado;
    }
    
    /**
     * Metodo que devuelve las estanterias que tienen
     * lejas libres para poder insertar cajas
     * @return estanterias libres
     */
    public function dameEstanteriasConLejasLibres() {
        
        $orden = "SELECT * FROM estanterias WHERE ocupadas is null";
        
        global $conn;
        
        $resultado = $conn -> query($orden);
        
        if($resultado->num_rows>0){
         
            $i=0;
        
            while ($array=$resultado->fetch_array()){
                $claves = array_keys($array);
             
                foreach($claves as $clave){
                    $arrayauxliar[$i][$clave]=$array[$clave];
                }           
            
                $i++;
            }
        
                return $arrayauxliar;

            }else{
                return null;
            }
        
        
    }
    
}
