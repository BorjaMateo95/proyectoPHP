<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'ConexionBD.php';
include_once '../Modelos/Estanteria.php';
include_once '../Modelos/Caja.php';
include_once '../Modelos/CajaConLeja.php';
include_once '../Modelos/EstanteriaConCajas.php';
include_once '../Modelos/Inventario.php';

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
     * Recibe un objeto de tipo Caja y un objeto Ocupacion
     * @return resultado de la query
     */    
    public function insertaCaja($caja, $ocupacion) {        
        global $conn;
        //cajas
        $orden = "INSERT INTO cajas VALUES (null, '" . 
                  $caja->getCodigo() . "', " . $caja->getAltura()
                . ", " . $caja->getAnchura() . ", " . $caja->getProfundidad()
                . ", '" . $caja->getMaterial() . "', '" . $caja->getColor() .
                "', '" . $caja->getContenido() . "')";
        
        $resultado = $conn->query($orden);
        
        if($conn->affected_rows < 1) {//si se cumple no ha insertado caja
            throw new MiException(1, "Error al insertar la caja");       
        }
        
        //ocupacion
        $ocupacion->setIdCaja($conn->insert_id);
        $ordenInsertOcupacion = "INSERT INTO ocupacion VALUES (null, " . $ocupacion->getIdCaja() .
                ", " . $ocupacion->getIdEstanteria() . ", " . $ocupacion->getNumeroLeja() . ")";
        
        $resultado = $conn->query($ordenInsertOcupacion);
        
        if($conn->affected_rows < 1) {
            throw new MiException(1, "Error al insertar ocupación");
        }
        
        //estanteria (sumar uno en ocupacion)
        $ordenSelectEstanteria = "SELECT * FROM estanterias WHERE id = " . $ocupacion->getIdEstanteria();
        $resultado = $conn->query($ordenSelectEstanteria);
        
        if ($resultado) {
            $fila = $resultado->fetch_array();
           
            if($fila['ocupadas'] == null) {
                $nuevaOcupacion = 1;
            }else{
                $nuevaOcupacion = $fila['ocupadas'] + 1;
            }
            
            $updateEstanteria = "UPDATE estanterias SET ocupadas =" . $nuevaOcupacion . " WHERE id =" . $fila['id'];
            $resultado = $conn->query($updateEstanteria);
            
            if($conn->affected_rows < 1) {
                throw new MiException(1, "Error al actualizar la estanteria"); 
            }
                  
        }else{
            throw new MiException(1, "Error consultar la estanteria");
        }      

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
            //SI ESA ESTANTERIA NO ESTA EN OCUPACION NOS DEVUELVE UN ARRAY CON EL TOTAL DE LEJAS
            return $totalLejasArray;
        }

    }
    
    
    public function dameInventario() {
        
    }
    
    
    
}
