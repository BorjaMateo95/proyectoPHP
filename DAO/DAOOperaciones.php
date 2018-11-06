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
include_once '../Excepciones/MiException.php';
include_once '../Modelos/CajaBackup.php';

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
        global $conn;
        
        $sqlEstanterias = "SELECT * FROM estanterias ORDER BY pasillo, numero, codigo";
        $resulEstanterias = $conn->query($sqlEstanterias);
        
        $arrayEstanterias = array();
        
        if ($resulEstanterias) {
            for($e = 0; $e < $resulEstanterias->num_rows; $e++) {
                $fila = $resulEstanterias->fetch_array();
                $estanteriaConCaja = new EstanteriaConCajas($fila['codigo'], $fila['numlejas'],
                                                        $fila['pasillo'], $fila['numero'], null);
                $estanteriaConCaja->setOcupadas($fila['ocupadas']);
                
                array_push($arrayEstanterias, $estanteriaConCaja);
                
                if ($fila['ocupadas'] != null) {
                    //esa estanteria debe de tener cajas
                    $sqlOcupadas = "SELECT * FROM ocupacion WHERE idEstanteria = " . $fila['id'];
                    $resultadoOcupacion = $conn->query($sqlOcupadas);
                    $arrayCajas = array();
                    
                    if ($resultadoOcupacion) {
                        for ($i = 0; $i < $resultadoOcupacion->num_rows; $i++) {
                            $filasOcupacion = $resultadoOcupacion->fetch_array();
                            $sqlCajas = "SELECT * FROM cajas WHERE id = " . $filasOcupacion['idCaja'];
                            $resultadoCajas = $conn->query($sqlCajas);
                            $filaCaja = $resultadoCajas->fetch_array();
                            $cajaConLeja = new CajaConLeja($filaCaja['codigo'], $filaCaja['altura'], 
                                    $filaCaja['anchura'], $filaCaja['profundidad'], $filaCaja['material'],
                                    $filaCaja['color'], $filaCaja['contenido'], $filasOcupacion['nLeja']);
                            
                            array_push($arrayCajas, $cajaConLeja);
                           
 
                        }
                        
                        $estanteriaConCaja->setArrayCajasConLeja($arrayCajas);
                    }           
                }  
            }
            
            $fecha = date("d/m/y");
            
            $inventario = new Inventario($arrayEstanterias, date("F j, Y, g:i a"));
            
            return $inventario;
            
        }else{
            //quitar return y sino tenemos nada sacamos un trhow new Exception.
            return "No hay estanterias para listar";
        }
        
        $conn->close();
        return $array;
                
    }
    
    
    public function dimeDescripcionUnaCaja($codcaja, $opcion) {
        global $conn;
        
        if($opcion == "Venta") {
            $sqlCaja = "SELECT * FROM cajas WHERE codigo = '$codcaja'";
        
            $resultadosqlCaja = $conn->query($sqlCaja);
        
            if($resultadosqlCaja->num_rows > 0) {
            
                $fila = $resultadosqlCaja->fetch_array();
            
                $caja = new Caja($fila['codigo'], $fila['altura'], 
                                    $fila['anchura'], $fila['profundidad'], $fila['material'],
                                    $fila['color'], $fila['contenido']);
            
                return $caja;
         
            }else{
                throw new MiException(1, "Esta caja no existe"); 
            }
        }else{
            $sqlCaja = "SELECT * FROM cajas_backup WHERE codCaja = '$codcaja'";
        
            $resultadosqlCaja = $conn->query($sqlCaja);
        
            if($resultadosqlCaja->num_rows > 0) {
            
                $fila = $resultadosqlCaja->fetch_array();
            
                $caja = new CajaBackup($fila['codCaja'], $fila['altura'], 
                                    $fila['anchura'], $fila['profundidad'], $fila['material'],
                                    $fila['color'], $fila['contenido'], $fila['fechaVenta'],
                                    $fila['leja'], $fila['codigoEstanteria']);
            
                return $caja;
         
            }else{
                throw new MiException(1, "Esta cajaBackup no existe"); 
            }
            
        }

        
    }
    
    public function salidaCaja($codigo) {
        global $conn;
        $sqlDelete = "DELETE FROM cajas WHERE codigo='" . $codigo . "';";
        $respuesta = $conn->query($sqlDelete);
                
        if ($respuesta->affected_rows > 0) {
            return "Caja Vendida Correctamente";
        } else {   
            throw new MiException(1, "No se ha podido vender la caja");
        }
        
        $conn->close();
        
    }
    
    
    public function devolucionCaja($codigo) {
        global $conn;
        
        return "BIIIIEEEN DEVOLUCION CAJAAAA";
        
    }
    
    
    
}
