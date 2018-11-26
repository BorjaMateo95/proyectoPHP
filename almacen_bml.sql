-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.31-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para bd_almacen_bml
DROP DATABASE IF EXISTS `bd_almacen_bml`;
CREATE DATABASE IF NOT EXISTS `bd_almacen_bml` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bd_almacen_bml`;

-- Volcando estructura para tabla bd_almacen_bml.almacen
DROP TABLE IF EXISTS `almacen`;
CREATE TABLE IF NOT EXISTS `almacen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `disePasillos` varchar(50) NOT NULL,
  `numeros` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla bd_almacen_bml.almacen: ~1 rows (aproximadamente)
DELETE FROM `almacen`;
/*!40000 ALTER TABLE `almacen` DISABLE KEYS */;
INSERT INTO `almacen` (`id`, `codigo`, `nombre`, `direccion`, `disePasillos`, `numeros`) VALUES
	(1, 'A01', 'ALMACEN BORJA', 'C/CANTARRANAS', 'A-Z', '1-100');
/*!40000 ALTER TABLE `almacen` ENABLE KEYS */;

-- Volcando estructura para tabla bd_almacen_bml.cajas
DROP TABLE IF EXISTS `cajas`;
CREATE TABLE IF NOT EXISTS `cajas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `altura` int(11) NOT NULL,
  `anchura` int(11) NOT NULL,
  `profundidad` int(11) NOT NULL,
  `material` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `contenido` varchar(50) NOT NULL,
  `fechaAlta` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla bd_almacen_bml.cajas: ~0 rows (aproximadamente)
DELETE FROM `cajas`;
/*!40000 ALTER TABLE `cajas` DISABLE KEYS */;
/*!40000 ALTER TABLE `cajas` ENABLE KEYS */;

-- Volcando estructura para tabla bd_almacen_bml.cajas_backup
DROP TABLE IF EXISTS `cajas_backup`;
CREATE TABLE IF NOT EXISTS `cajas_backup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codCaja` varchar(50) NOT NULL DEFAULT '0',
  `altura` int(11) NOT NULL DEFAULT '0',
  `anchura` int(11) NOT NULL DEFAULT '0',
  `profundidad` int(11) NOT NULL DEFAULT '0',
  `color` varchar(50) NOT NULL DEFAULT '0',
  `material` varchar(50) NOT NULL DEFAULT '0',
  `contenido` varchar(50) NOT NULL DEFAULT '0',
  `fechaAlta` date NOT NULL,
  `fechaVenta` date NOT NULL,
  `leja` varchar(50) NOT NULL DEFAULT '0',
  `codigoEstanteria` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `codCaja` (`codCaja`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla bd_almacen_bml.cajas_backup: ~0 rows (aproximadamente)
DELETE FROM `cajas_backup`;
/*!40000 ALTER TABLE `cajas_backup` DISABLE KEYS */;
/*!40000 ALTER TABLE `cajas_backup` ENABLE KEYS */;

-- Volcando estructura para tabla bd_almacen_bml.estanterias
DROP TABLE IF EXISTS `estanterias`;
CREATE TABLE IF NOT EXISTS `estanterias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `numlejas` int(11) NOT NULL,
  `ocupadas` int(11) DEFAULT NULL,
  `pasillo` varchar(50) NOT NULL,
  `numero` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  UNIQUE KEY `pasillo` (`pasillo`,`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla bd_almacen_bml.estanterias: ~0 rows (aproximadamente)
DELETE FROM `estanterias`;
/*!40000 ALTER TABLE `estanterias` DISABLE KEYS */;
/*!40000 ALTER TABLE `estanterias` ENABLE KEYS */;

-- Volcando estructura para tabla bd_almacen_bml.ocupacion
DROP TABLE IF EXISTS `ocupacion`;
CREATE TABLE IF NOT EXISTS `ocupacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCaja` int(11) NOT NULL DEFAULT '0',
  `idEstanteria` int(11) NOT NULL DEFAULT '0',
  `nLeja` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idEstanteria_nLeja` (`idEstanteria`,`nLeja`),
  UNIQUE KEY `idCaja` (`idCaja`),
  CONSTRAINT `FK_ocupacion_cajas` FOREIGN KEY (`idCaja`) REFERENCES `cajas` (`id`),
  CONSTRAINT `FK_ocupacion_estanterias` FOREIGN KEY (`idEstanteria`) REFERENCES `estanterias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla bd_almacen_bml.ocupacion: ~0 rows (aproximadamente)
DELETE FROM `ocupacion`;
/*!40000 ALTER TABLE `ocupacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `ocupacion` ENABLE KEYS */;

-- Volcando estructura para tabla bd_almacen_bml.usuario
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(15) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla bd_almacen_bml.usuario: ~0 rows (aproximadamente)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Volcando estructura para disparador bd_almacen_bml.devolucionCaja
DROP TRIGGER IF EXISTS `devolucionCaja`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `devolucionCaja` BEFORE DELETE ON `cajas_backup` FOR EACH ROW BEGIN
    INSERT INTO cajas VALUES (null, 'C08', 1 , 1 , 1 ,
    'PLASTICO' , '#000000' , 'TORNILLOS' , '2018-11-26');
    INSERT INTO ocupacion VALUES (null, (SELECT id FROM cajas WHERE codigo = 'C08') , 30, 1);
    UPDATE estanterias SET ocupadas = ocupadas +1 WHERE id = 30;END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador bd_almacen_bml.disparadorCaja
DROP TRIGGER IF EXISTS `disparadorCaja`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `disparadorCaja` BEFORE DELETE ON `cajas` FOR EACH ROW BEGIN
INSERT INTO cajas_backup VALUES (null, OLD.codigo, OLD.altura, OLD.anchura, OLD.profundidad,
OLD.color, OLD.material, OLD.contenido, OLD.fechaAlta, SYSDATE(),
(SELECT nLeja FROM ocupacion WHERE idCaja = OLD.id),
(SELECT codigo FROM estanterias WHERE id = (SELECT idEstanteria FROM ocupacion WHERE idCaja = OLD.id)));
UPDATE estanterias SET ocupadas = ocupadas -1 WHERE id = (SELECT idEstanteria FROM ocupacion WHERE idCaja = OLD.id);
DELETE FROM ocupacion WHERE idCaja = OLD.id;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
