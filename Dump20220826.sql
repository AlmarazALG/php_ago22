-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: php_curso_ago22
-- ------------------------------------------------------
-- Server version	8.0.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cat_contacto`
--

DROP TABLE IF EXISTS `cat_contacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cat_contacto` (
  `id_cat_contacto` int(11) NOT NULL,
  `Tipo_de_dato` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_cat_contacto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_contacto`
--

LOCK TABLES `cat_contacto` WRITE;
/*!40000 ALTER TABLE `cat_contacto` DISABLE KEYS */;
/*!40000 ALTER TABLE `cat_contacto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(85) DEFAULT NULL,
  `paterno` varchar(45) DEFAULT NULL,
  `materno` varchar(45) DEFAULT NULL,
  `nacimiento` date DEFAULT NULL,
  `domicilio` varchar(250) DEFAULT NULL,
  `genero` enum('h','m') DEFAULT NULL,
  PRIMARY KEY (`id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,'Kike','Hernandez','Zuñiga','1990-01-01','otra calle de cdmx','h'),(2,'Róman','Martinez','Lopez','1990-03-04','una calle de cdmx','h'),(3,'Luis','Almaraz','Aguilar','1996-08-21','Av. Francisco Morazán','h'),(4,'Juan','Castillo','Ramós','1991-05-28','una calle diferente de cdmx','h');
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado_contacto`
--

DROP TABLE IF EXISTS `empleado_contacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleado_contacto` (
  `id_empleado_contacto` int(11) NOT NULL AUTO_INCREMENT,
  `contacto` varchar(500) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `id_cat_contacto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_empleado_contacto`),
  KEY `id_empleado_idx` (`id_empleado`),
  KEY `id_cat_empleado_idx` (`id_cat_contacto`),
  CONSTRAINT `id_cat_empleado` FOREIGN KEY (`id_cat_contacto`) REFERENCES `cat_contacto` (`id_cat_contacto`),
  CONSTRAINT `id_empleado` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado_contacto`
--

LOCK TABLES `empleado_contacto` WRITE;
/*!40000 ALTER TABLE `empleado_contacto` DISABLE KEYS */;
/*!40000 ALTER TABLE `empleado_contacto` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-26 11:07:47
