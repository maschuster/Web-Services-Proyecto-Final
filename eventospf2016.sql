-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: us-cdbr-azure-west-c.cloudapp.net    Database: eventospf2016
-- ------------------------------------------------------
-- Server version	5.5.45-log

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
-- Table structure for table `eventos`
--

DROP TABLE IF EXISTS `eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eventos` (
  `idEvento` int(11) NOT NULL AUTO_INCREMENT,
  `idAdmin` varchar(100) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `lugar` varchar(250) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idEvento`)
) ENGINE=InnoDB AUTO_INCREMENT=352 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventos`
--

LOCK TABLES `eventos` WRITE;
/*!40000 ALTER TABLE `eventos` DISABLE KEYS */;
INSERT INTO `eventos` VALUES (1,'0','Fiestita','2016-05-29 00:00:00','Yatay 240','ESTO SE VA A DESCONTROLAAAAR','Amigos.jpg'),(2,'0','Asado','2016-06-15 00:00:00','Medrano 232','La entrada al campo sale $45','Macabi.jpg'),(21,'1','Previa','2016-06-23 00:00:00','Corrientes 1456','Lleguen a partir de las 12.','foto.jpg'),(321,'100327683757024','Fiesta en lo de PAtri','2016-08-14 00:00:00','Casa de Patri','Locura','foto.jpg'),(331,'100327683757024','asdasd','2016-08-14 00:00:00','asdasd','asdasd','foto.jpg'),(341,'100327683757024','Fiestaaa','2016-08-14 00:00:00','Casa de PAtria','asdas','foto.jpg'),(351,'100327683757024','Ofgfd','2015-11-11 00:00:00','fdsfsdf','fsdfdsfsdf','foto.jpg');
/*!40000 ALTER TABLE `eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objetos`
--

DROP TABLE IF EXISTS `objetos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `objetos` (
  `idObjeto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `precio` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `idEvento` int(11) NOT NULL,
  `idParticipante` int(11) NOT NULL,
  PRIMARY KEY (`idObjeto`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objetos`
--

LOCK TABLES `objetos` WRITE;
/*!40000 ALTER TABLE `objetos` DISABLE KEYS */;
INSERT INTO `objetos` VALUES (1,'Coca-Cola',25,0,1,0),(2,'Vacio',70,1,1,0),(3,'Huevos',20,0,2,0),(41,'Cerveza',55,0,1,1),(51,'Papas Fritas',50,0,1,1),(61,'Coca Cola',30,1,2,0),(71,'carne',54,1,2,21),(101,'Vino Tinto',50,1,341,361),(111,'Fernet',150,0,341,0),(121,'Carne',3,0,341,321),(131,'Fideos',23,1,341,371),(141,'Coca Cola',53,0,341,321),(151,'Sprite',40,0,341,0);
/*!40000 ALTER TABLE `objetos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participantes`
--

DROP TABLE IF EXISTS `participantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `participantes` (
  `idParticipante` int(11) NOT NULL AUTO_INCREMENT,
  `idFacebook` varchar(250) DEFAULT NULL,
  `idEvento` int(11) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idParticipante`)
) ENGINE=InnoDB AUTO_INCREMENT=372 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participantes`
--

LOCK TABLES `participantes` WRITE;
/*!40000 ALTER TABLE `participantes` DISABLE KEYS */;
INSERT INTO `participantes` VALUES (1,'10209993149855011',1,'Martin Schuster'),(21,'10209993149855011',2,'Martin Schuster'),(42,'AVkCoJMpVVD3UKN4ULl1WCncBPW9_A3JSpmbXmfABkNNnaaeIWM0ysPl9qXzXrSs-fUUhqjaKRvpfrB-vJgiSoRTZIpCMyXZ1d0ioCZQdnAeEw',0,'Marto Gruber'),(141,'personavirtual',1,'biderloco'),(161,'personavirtual',1,'Guivi'),(291,NULL,321,NULL),(301,'100327683757024',331,'Patricia Alaccicggjbdc McDonaldsky'),(311,'105191576602410',331,'Sharon Alaccdgjcdacf Bharambeescu'),(321,'100327683757024',341,'Patricia Alaccicggjbdc McDonaldsky'),(331,'105191576602410',341,'Sharon Alaccdgjcdacf Bharambeescu'),(341,'personavirtual',341,'Magolla'),(351,'100327683757024',351,'Patricia Alaccicggjbdc McDonaldsky'),(361,'personavirtual',341,'Guivi'),(371,'personavirtual',341,'rttg');
/*!40000 ALTER TABLE `participantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preguntas`
--

DROP TABLE IF EXISTS `preguntas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preguntas` (
  `idPregunta` int(11) NOT NULL AUTO_INCREMENT,
  `idEvento` int(11) NOT NULL,
  `pregunta` varchar(100) NOT NULL,
  `afirmativos` int(11) DEFAULT NULL,
  `negativos` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preguntas`
--

LOCK TABLES `preguntas` WRITE;
/*!40000 ALTER TABLE `preguntas` DISABLE KEYS */;
INSERT INTO `preguntas` VALUES (1,341,'¿Compramos Chorizo?',1,0),(11,341,'¿Pepsi en lugar de Coca?',0,0);
/*!40000 ALTER TABLE `preguntas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respuestas`
--

DROP TABLE IF EXISTS `respuestas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `respuestas` (
  `idRespuesta` int(11) NOT NULL AUTO_INCREMENT,
  `idPregunta` int(11) NOT NULL,
  `voto` int(11) NOT NULL,
  `idParticipante` int(11) NOT NULL,
  PRIMARY KEY (`idRespuesta`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respuestas`
--

LOCK TABLES `respuestas` WRITE;
/*!40000 ALTER TABLE `respuestas` DISABLE KEYS */;
INSERT INTO `respuestas` VALUES (1,1,1,321);
/*!40000 ALTER TABLE `respuestas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idFacebook` varchar(250) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`idFacebook`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES ('100327683757024','Patricia Alaccicggjbdc McDonaldsky'),('10209993149855011','Martin Schuster');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-04 22:17:24
