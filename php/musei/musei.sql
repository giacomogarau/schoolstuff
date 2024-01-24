-- MySQL dump 10.15  Distrib 10.0.21-MariaDB, for Linux (i686)
--
-- Host: localhost    Database: musei
-- ------------------------------------------------------
-- Server version	10.0.21-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `artisti`
--

DROP DATABASE IF EXISTS `musei`;

CREATE DATABASE `musei`;

USE `musei`;

DROP TABLE IF EXISTS `artisti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artisti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` char(50) NOT NULL,
  `nazione` char(50) NOT NULL,
  `dataNascita` date NOT NULL,
  `dataMorte` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artisti`
--

LOCK TABLES `artisti` WRITE;
/*!40000 ALTER TABLE `artisti` DISABLE KEYS */;
INSERT INTO `artisti` VALUES (1,'Tiziano','Italia','1490-01-01','1576-08-03'),(2,'Caravaggio','Italia','1571-09-29','1610-07-18'),(3,'Botticelli','Italia','1445-03-01','1510-05-17'),(4,'Giotto','Italia','1266-07-08','1337-01-08'),(5,'Fernando Yanez de la Almedina','Spagna','1475-01-02','1537-07-23'),(6,'Hans von Aachen','Germania','1552-11-04','1615-03-04'),(7,'Bernardo Daddi','Italia','1290-04-12','1348-08-18'),(8,'Leonardo da Vinci','Italia','1452-04-15','1519-05-02'),(9,'Raffaello','Italia','1483-06-22','1520-04-06'),(10,'Picasso','Spagna','1881-10-25','1973-04-08');
/*!40000 ALTER TABLE `artisti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `musei`
--

DROP TABLE IF EXISTS `musei`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `musei` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` char(50) NOT NULL,
  `citta` char(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `musei`
--

LOCK TABLES `musei` WRITE;
/*!40000 ALTER TABLE `musei` DISABLE KEYS */;
INSERT INTO `musei` VALUES (1,'National Gallery','Londra'),(2,'Galleria degli Uffizi','Firenze'),(3,'Museo dell\'opera del Duomo','Firenze'),(4,'Palazzo Pitti','Firenze'),(5,'Galleria dell\'Accademia','Firenze'),(6,'Tate Britain','Londra'),(7,'Victoria & Albert Museum','Londra'),(8,'Musée du Louvre','Parigi'),(9,'Museo del Prado','Madrid'),(10,'Fondazione Roberto Longhi','Firenze'),(11,'Kimbell Art Museum','Fort Worth'),(12,'Pinacoteca Ambrosiana','Milano'),(13,'Sanssouci','Potsdam'),(14,'Pinacoteca Vaticana','Citta del Vaticano');
/*!40000 ALTER TABLE `musei` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opere`
--

DROP TABLE IF EXISTS `opere`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` char(50) NOT NULL,
  `museo` int(11) NOT NULL,
  `autore` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `museo` (`museo`),
  KEY `autore` (`autore`),
  CONSTRAINT `opere_ibfk_1` FOREIGN KEY (`museo`) REFERENCES `musei` (`id`),
  CONSTRAINT `opere_ibfk_2` FOREIGN KEY (`autore`) REFERENCES `artisti` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opere`
--

LOCK TABLES `opere` WRITE;
/*!40000 ALTER TABLE `opere` DISABLE KEYS */;
INSERT INTO `opere` VALUES (1,'I bari',2,2),(2,'Flora',2,1),(3,'Ritratto di Ariosto',1,1),(4,'Madonna col bambino',2,5),(5,'Bacco e Arianna',1,1),(6,'Cena in Emmaus',1,2),(7,'Venere e Marte',1,3),(8,'Dittico Wilton',1,NULL);
/*!40000 ALTER TABLE `opere` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personaggi`
--

DROP TABLE IF EXISTS `personaggi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personaggi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` char(50) NOT NULL,
  `descrizione` char(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personaggi`
--

LOCK TABLES `personaggi` WRITE;
/*!40000 ALTER TABLE `personaggi` DISABLE KEYS */;
INSERT INTO `personaggi` VALUES (1,'Cristo','Personaggio centrale della religione cristiana'),(2,'Bacco','Divinita\' romana associata al vino'),(3,'Madonna','Secondo la religione cristiana, madre di Cristo'),(4,'Venere','Divinita\' romana associata all\'amore'),(5,'Marte','Divinita\' romana associata alla guerra'),(6,'San Giovanni','Secondo la religione cristiana,discepolo di Cristo'),(7,'San Francesco','Santo della religione cristiana');
/*!40000 ALTER TABLE `personaggi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presenze`
--

DROP TABLE IF EXISTS `presenze`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `presenze` (
  `personaggio` int(11) NOT NULL,
  `opera` int(11) NOT NULL,
  KEY `personaggio` (`personaggio`),
  KEY `opera` (`opera`),
  CONSTRAINT `presenze_ibfk_1` FOREIGN KEY (`personaggio`) REFERENCES `personaggi` (`id`),
  CONSTRAINT `presenze_ibfk_2` FOREIGN KEY (`opera`) REFERENCES `opere` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presenze`
--

LOCK TABLES `presenze` WRITE;
/*!40000 ALTER TABLE `presenze` DISABLE KEYS */;
INSERT INTO `presenze` VALUES (2,4),(3,5),(4,2),(5,2);
/*!40000 ALTER TABLE `presenze` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-27 10:02:02
