<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'ConexionBD.php';
include_once '../Modelos/Estanteria.php';

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
        $orden = "SELECT * FROM estanterias WHERE ocupadas is null OR numLejas != ocupadas";
        
        global $conn;
        
        $resultado = $conn -> query($orden);
        $arrayEstanterias = array();
        
        if ($resultado) {
            $fila = $resultado->fetch_array();
            while ($fila) {
                $estanteria = new Estanteria($fila['codigo'], $fila['numlejas'], $fila['pasillo'], $fila['numero']);
                $estanteria->setId($fila['id']);
                $estanteria->setOcupadas($fila['ocupadas']);
                array_push($arrayEstanterias, $estanteria);
                $fila = $resultado->fetch_array();
            }
        } else {
            return null;
        }
        $conn->close();
        return $arrayEstanterias;
    }
    
    
    /**
     * dimeLejasLibres(idEstanteria) nos devuelve las lejas libres de una estanteria
     * @global type $conn
     * @param type $idEstanteria
     * @return array
     */
    
    public function dimeLejasLibres($idEstanteria) {
        global $conn;
        
        $sqlEstanteria = "SELECT * FROM estanterias WHERE id = '$idEstanteria'";
        
        $resultadosqlEstanteria = $conn->query($sqlEstanteria);
        $fila = $resultadosqlEstanteria->fetch_array();
        $totalLejasEstanteria = $fila['numlejas'];//tenemos el total de lejas de una estanteria
        
        $totalLejasArray = array();//array con el total de lejas
        for ($i = 1; $i < $totalLejasEstanteria+1; $i++) {
              array_push($totalLejasArray, $i);
        }
                
        $sqlOcupacion = "SELECT * FROM ocupacion WHERE idEstanteria = '" . $idEstanteria . "';";
        $resulSqlOcupacion = $conn->query($sqlOcupacion);
        $numeroFilasDevuelto = $resulSqlOcupacion->num_rows;
        
        if ($numeroFilasDevuelto > 0) {//si tenemos alguna ocupacion de esa estanteria
            $filaOcupacion = $resulSqlOcupacion->fetch_array();//la fila del select de ocupacion
            
            $arrayLejasOcupadas = array();//array con las lejas ocupadas
            while ($filaOcupacion) {
                array_push($arrayLejasOcupadas, $filaOcupacion['nLeja']);
                $filaOcupacion = $resulSqlOcupacion->fetch_array();
            }
            
                                 
            $arrayLejasLibres = array();   
            for ($i = 0; $i < count($totalLejasArray); $i++) {
                               
                $meterAlArray = true;
                
                for($e = 0; $e < count($arrayLejasOcupadas); $e++) {
                    if($totalLejasArray[$i] == $arrayLejasOcupadas[$e]) {
                        $meterAlArray = false;
                        break;
                    }
                    
                }
                    
                    if($meterAlArray) {
                        array_push($arrayLejasLibres, $totalLejasArray[$i]);
                    }
                   
            }
            
            return $arrayLejasLibres;
            
        }else{
            return $totalLejasArray;
        }

    }
    
    
    
}
