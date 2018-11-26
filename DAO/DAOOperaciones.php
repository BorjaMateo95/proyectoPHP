<?php

include 'ConexionBD.php';
include_once '../Modelos/Estanteria.php';
include_once '../Modelos/Caja.php';
include_once '../Modelos/CajaConLeja.php';
include_once '../Modelos/EstanteriaConCajas.php';
include_once '../Modelos/Inventario.php';
include_once '../Excepciones/MiException.php';
include_once '../Modelos/CajaBackup.php';
include_once '../Modelos/Usuario.php';
include_once '../Modelos/Almacen.php';

class DAOOperaciones {
    
    /**
     * Metodo para insertar Estanterias en la base de datos.
     * Recibe un objeto de tipo Estanteria
     * @return resultado de la query
     */    
    public function insertaEstanteria($estanteria) {
        global $conn;
        
        $ins = "INSERT INTO estanterias VALUES (null, ?, ?, ?, ?, ?)";
        $pre = $conn->prepare($ins);
        
        $codigo = $estanteria->getCodigo();
        $numLejas = $estanteria->getNumLejas();
        $ocupadas = 0;
        $pasillo = $estanteria->getPasillo();
        $numero = $estanteria->getNumero();
        
        $pre->bind_param("siisi", $codigo, $numLejas,$ocupadas, $pasillo, $numero);
        $resultado = $pre->execute();
        
        if($conn->affected_rows < 1) {
            throw new MiException(1, "Error al insertar la Estanteria"); 
        }

    }
    
     /**
     * Metodo para insertar Cajas en lejas de una estanteria.
     * Recibe un objeto de tipo Caja y un objeto Ocupacion
     * @return resultado de la query
     */    
    public function insertaCaja($caja, $ocupacion) {        
        global $conn;
        
        //cajas
        $codigo = $caja->getCodigo();
        $altura = $caja->getAltura();
        $anchura = $caja->getAnchura();
        $profundiad = $caja->getProfundidad();
        $material = $caja->getMaterial();
        $color = $caja->getColor();
        $contenido = $caja->getContenido();
        $fechaAlta = $caja->getFechaAlta();
                
        $sqlP = $conn->prepare("SELECT * FROM cajas_backup WHERE codCaja =?");
        $sqlP->bind_param("s", $codigo);
        $sqlP->execute();
        $resultadoCB = $sqlP->get_result();
        
        if($resultadoCB->num_rows > 0){
            throw new MiException(1, "Error este codigo ya existe en Caja_backup");    
        }
 
        $orden = "INSERT INTO cajas (codigo, altura, anchura, profundidad, material,
                color, contenido, fechaAlta) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $pre = $conn->prepare($orden);
        $pre->bind_param("siiissss", $codigo, $altura, $anchura, $profundiad, $material, $color, $contenido, $fechaAlta);
        $resultado = $pre->execute();
     
        if($conn->affected_rows < 1) {//si se cumple no ha insertado caja
            throw new MiException(1, "Error al insertar la caja");       
        }
        
        //ocupacion
        $ocupacion->setIdCaja($conn->insert_id);
        
        $idCaja = $ocupacion->getIdCaja();
        $idEstanteria = $ocupacion->getIdEstanteria();
        $numeroLeja = $ocupacion->getNumeroLeja();
        
        $ordenInsertOcupacion = "INSERT INTO ocupacion VALUES (null, ?, ?, ?)";
        $preDos = $conn->prepare($ordenInsertOcupacion);
        
        $preDos->bind_param("iii", $idCaja, $idEstanteria, $numeroLeja);
        
        $resultado = $preDos->execute();
        
        
        if($conn->affected_rows < 1) {
            throw new MiException(1, "Error al insertar ocupación");
        }
        
        
        $sqlP2 = $conn->prepare("SELECT * FROM estanterias WHERE id =?");
        $sqlP2->bind_param("i", $ocupacion->getIdEstanteria());
        $sqlP2->execute();
        $resultado = $sqlP2->get_result();
        
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
        
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_array();
            while ($fila) {
                $estanteria = new Estanteria($fila['codigo'], $fila['numlejas'],
                        $fila['pasillo'], $fila['numero']);
                $estanteria->setId($fila['id']);
                $estanteria->setOcupadas($fila['ocupadas']);
                array_push($arrayEstanterias, $estanteria);
                $fila = $resultado->fetch_array();
            }
        } else {
            throw new MiException(1, "No hay estanterias con lejas libres, añada una estanteria");
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
                
        $sqlP = $conn->prepare("SELECT * FROM estanterias WHERE id =?");
        $sqlP->bind_param("i", $idEstanteria);
        $sqlP->execute();
        $resultadosqlEstanteria = $sqlP->get_result();
                
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
            $filaOcu = $resulSqlOcupacion->fetch_array();
            
            $aLejasOc = array();//array con las lejas ocupadas
            for($r = 0; $r < count($filaOcu); $r++) {
                array_push($aLejasOc, $filaOcu['nLeja']);
                $filaOcu = $resulSqlOcupacion->fetch_array();
            }
                          
            $arrayLejasLibres = array();
            for ($i = 0; $i < count($totalLejasArray); $i++) {
                               
                $meterAlArray = true;
                
                for($e = 0; $e < count($aLejasOc); $e++) {
                    if($totalLejasArray[$i] == $aLejasOc[$e]) {
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
    
    
   
   /**
    * dameInventario
    * @global type $conn
    * @return Inventario
    * @throws MiException
    */ 
    public function dameInventario() {
        global $conn;
        
        $sqlEstanterias = "SELECT * FROM estanterias ORDER BY pasillo, numero, codigo";
        $resulEstanterias = $conn->query($sqlEstanterias);
        
        $arrayEstanterias = array();
        
        if ($resulEstanterias) {
            if($resulEstanterias->num_rows > 0){
            for($e = 0; $e < $resulEstanterias->num_rows; $e++) {
                $fila = $resulEstanterias->fetch_array();
                $estanteriaConCaja = new EstanteriaConCajas($fila['codigo'], $fila['numlejas'],
                                                        $fila['pasillo'], $fila['numero'], null);
                $estanteriaConCaja->setOcupadas($fila['ocupadas']);
                
                array_push($arrayEstanterias, $estanteriaConCaja);
                
                if ($fila['ocupadas'] != 0) {
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
                                    $filaCaja['color'], $filaCaja['contenido'], $filaCaja['fechaAlta'],
                                    $filasOcupacion['nLeja']);
                            
                            array_push($arrayCajas, $cajaConLeja);
                           
                        }
                        
                        $estanteriaConCaja->setArrayCajasConLeja($arrayCajas);
                    }           
                }  
            }
                        
            $inventario = new Inventario($arrayEstanterias, date("d-m-Y, H:i"));
            
            return $inventario;
            
            }else{
                throw new MiException(1, "No hay estanterias para listar"); 
            }
            
        }else{
            throw new MiException(1, "No hay estanterias para listar"); 
        }
        
        $conn->close();
                
    }
    
    
    /**
     * listadoCajas devuelve todas las cajas que tenemos en la BD ordenadas por codigo
     * @global type $conn
     * @return array
     * @throws MiException
     */
    
    public function listadoCajas() {
        global $conn;
        
        $sqlCajas = "SELECT * FROM cajas ORDER BY codigo";
        $resulCajas = $conn->query($sqlCajas);
        
        $arrayCajas = array();
        
        if($resulCajas) {
            if($resulCajas->num_rows > 0){
            for($e = 0; $e < $resulCajas->num_rows; $e++) {
                $fila = $resulCajas->fetch_array();
                
                $caja = new Caja($fila['codigo'], $fila['altura'], 
                                    $fila['anchura'], $fila['profundidad'], $fila['material'],
                                    $fila['color'], $fila['contenido'], $fila['fechaAlta']);
                            
                array_push($arrayCajas, $caja);
            }
            
            return $arrayCajas;
            
            }else{
                throw new MiException(1, "No hay cajas para listar"); 
            }
        }else{
            throw new MiException(1, "No hay cajas para listar"); 
        }
        
        
    }
    
     /**
     * listadoEstanterias devuelve todas las estanterias que tenemos en la BD ordenadas por codigo
     * @global type $conn
     * @return array
     * @throws MiException
     */
    
    public function listadoEstanterias() {
        global $conn;
        
        $sqlEstanterias = "SELECT * FROM estanterias ORDER BY codigo";
        $resulEstanterias = $conn->query($sqlEstanterias);
        
        $arrayEstanterias = array();
        
        if($resulEstanterias) {
            if($resulEstanterias->num_rows > 0){
               
            for($e = 0; $e < $resulEstanterias->num_rows; $e++) {
                $fila = $resulEstanterias->fetch_array();
                
                $estanteria = new Estanteria($fila['codigo'], $fila['numlejas'], 
                                    $fila['pasillo'], $fila['numero']);
                $estanteria->setOcupadas($fila['ocupadas']);
                            
                array_push($arrayEstanterias, $estanteria);
            }
                        
            return $arrayEstanterias;
            
            }else{
                throw new MiException(1, "No hay estanterias para listar"); 
            }
            
        }else{
            throw new MiException(1, "No hay estanterias para listar"); 
        }
        
    }
    
     /**
     * dimeDescripcionUnaCaja devuelve un objeto Caja
     * @global type $conn
     * @param type $codcaja
     * @return Caja
     * @throws MiException
     */
    public function dimeDescripcionUnaCaja($codcaja) {
        global $conn;
       
        $sqlP = $conn->prepare("SELECT * FROM cajas WHERE codigo =?");
        $sqlP->bind_param("s", $codcaja);
        $sqlP->execute();
        $resultadosqlCaja = $sqlP->get_result();

        if ($resultadosqlCaja->num_rows > 0) {

            $fila = $resultadosqlCaja->fetch_array();

            $caja = new Caja($fila['codigo'], $fila['altura'], $fila['anchura'], 
                    $fila['profundidad'], $fila['material'], $fila['color'], 
                    $fila['contenido'], $fila['fechaAlta']);

            return $caja;
        } else {
            throw new MiException(1, "Esta caja no existe");
        }
    }
    
    
     /**
     * descripcionCajaBackup devuelve un objeto CajaBackup
     * @global type $conn
     * @param type $codcaja
     * @return CajaBackup
     * @throws MiException
     */
    public function descripcionCajaBackup($codcaja) {
         global $conn;
         
        $sqlP = $conn->prepare("SELECT * FROM cajas_backup WHERE codCaja =?");
        $sqlP->bind_param("s", $codcaja);
        $sqlP->execute();
        $resultadosqlCaja = $sqlP->get_result();
                
            if($resultadosqlCaja->num_rows > 0) {
            
                $fila = $resultadosqlCaja->fetch_array();
            
                $caja = new CajaBackup($fila['codCaja'], $fila['altura'], 
                                    $fila['anchura'], $fila['profundidad'], $fila['material'],
                                    $fila['color'], $fila['contenido'], $fila['fechaAlta'], $fila['fechaVenta'],
                                    $fila['leja'], $fila['codigoEstanteria']);
            
                return $caja;
         
            }else{
                throw new MiException(1, "Esta cajaBackup no existe"); 
            }
    }
    
    
    /**
     * salidaCaja borra la Caja $codigo, se ejecuta un disparador que incluye la caja borrada
     * en CajaBackup 
     * @global type $conn
     * @param type $codigo
     * @return string
     * @throws MiException
     */
    public function salidaCaja($codigo) {
        global $conn;
        
        $sqlP = $conn->prepare("DELETE FROM cajas WHERE codigo =?");
        $sqlP->bind_param("s", $codigo);
        $resultadoDelete = $sqlP->execute();
        
        if ($conn->affected_rows > 0) {
            return "Caja Vendida Correctamente";
        } else {   
            throw new MiException(1, "No se ha podido vender la caja");
        }
        
        $conn->close();
        
    }
    
    /**
     * devolucionCaja elimina una cajaBackup y la inserta de nuevo en Caja.
     * @global type $conn
     * @param type $cajaBacup
     * @return string
     * @throws MiException
     */
    public function devolucionCaja($cajaBacup) {
        global $conn;
        
        include_once '../Modelos/TriggerDevolucion.php';
        
        $sqlP = $conn->prepare("DELETE FROM cajas_backup WHERE codCaja =?");
        $sqlP->bind_param("s", $cajaBacup->getCodigo());
        $resultadoDelete = $sqlP->execute();
        
        if(!$resultadoDelete) {
            throw new MiException(1, "ERROR en el delete cajasbackup");
        }
        
        if(!$resultadoBorraTrigger){
            throw new MiException(1, "ERROR al borrar trigger"); 
        }
        
        if(!$resultadoTrigger) {
            throw new MiException(1, "ERROR en el trigger");
        }
                
        return "Caja devuelta correctamente!";
    }
    


    /**
     * dameCajaDevolucion devuelve una cajaBackup.
     * @global type $conn
     * @param type $codigo
     * @return \CajaBackup
     * @throws MiException
     */
    public function dameCajaDevolucion($codigo) {
        global $conn;
                
        $sqlP = $conn->prepare("SELECT * FROM cajas_backup WHERE codCaja =?");
        $sqlP->bind_param("s", $codigo);
        $sqlP->execute();
        $resultadosqlCaja = $sqlP->get_result();
        
            if($resultadosqlCaja->num_rows > 0) {
            
                $fila = $resultadosqlCaja->fetch_array();
            
                $caja = new CajaBackup($fila['codCaja'], $fila['altura'], 
                                    $fila['anchura'], $fila['profundidad'], $fila['material'],
                                    $fila['color'], $fila['contenido'], $fila['fechaAlta'], $fila['fechaVenta'],
                                    $fila['leja'], $fila['codigoEstanteria']);
            
                return $caja;
         
            }else{
                throw new MiException(1, "Esta caja_backup no existe"); 
            }
        
    }
    
    
    /**
     * Control de login usuario.
     * @global type $conn
     * @param type $email
     * @param type $password
     * @return boolean
     * @throws MiException
     */
    public function loginUsuario($email, $password) {
        global $conn;
        
        $sqlP = $conn->prepare("SELECT * FROM usuario WHERE email =?");
        $sqlP->bind_param("s", $email);
        $sqlP->execute();
        $resultadoUsuario = $sqlP->get_result();
                
        if($resultadoUsuario->num_rows > 0) {
            $fila = $resultadoUsuario->fetch_array();
            
            $verificarPass = password_verify($password, $fila['contrasena']);
            
            if($verificarPass) {
                return true;
            }else{
                throw new MiException(1, "Contraseña incorrecta");
            }
                        
        }else{
            throw new MiException(1, "Email o contraseña incorrectos"); 
        }
        
    }
    
    
    /**
     * registroUsuario registra un nuevo usuario en la BD
     * @global type $conn
     * @param type $usuario
     * @param type $password2
     * @throws MiException
     */
    
    public function registroUsuario($usuario, $password2) {
        global $conn;
                       
        if($usuario->getContrasena() != $password2) {
            throw new MiException(1, "Las contraseñas no son iguales");
        }
        
        $resultadoUsuario = $conn->query("SELECT * FROM usuario");
        if($resultadoUsuario->num_rows > 0) {
            throw new MiException(1, "Solo podemos tener un usuario.");
        }
        
        
        $passwordEncriptada = password_hash($password2, PASSWORD_BCRYPT);
        
        $ins = "INSERT INTO usuario VALUES (null, ?, ?, ?, ?, ?)";
        $pre = $conn->prepare($ins);
        
        $dni = $usuario->getDni();
        $nombre = $usuario->getNombre();
        $apellidos = $usuario->getApellidos();
        $email = $usuario->getEmail();
        
        $pre->bind_param("sssss", $dni, $nombre, $apellidos, $email, $passwordEncriptada);
        $resultado = $pre->execute();
        
        if(!$resultado) {
            throw new MiException(1, "Error al registrar el Usuario");
        }
    
        
    }
    
    
    /**
     * datosAlmacen devuelve los datos de nuestro almacen.
     * @global type $conn
     * @return Almacen
     * @throws MiException
     */
    public function datosAlmacen() {
        global $conn;
        
        $sql = "SELECT * FROM almacen";
        $resultadoAlmacen = $conn->query($sql);
        
        if($resultadoAlmacen->num_rows > 0) {
            $fila = $resultadoAlmacen->fetch_array();
            return new Almacen($fila['codigo'], $fila['nombre'], $fila['direccion'], 
                    $fila['disePasillos'], $fila['numeros']);
        }else{
            throw new MiException(1, "El almacén no esta cargado en la Base de Datos");
        }
        
        
        
    }
    
    
    
}
