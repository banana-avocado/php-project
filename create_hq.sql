-- MySQL dump 10.13  Distrib 5.6.20, for Win32 (x86)
--
-- Host: localhost    Database: hq
-- ------------------------------------------------------
-- Server version	5.6.20

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
-- Table structure for table `copter`
--

DROP TABLE IF EXISTS `copter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `copter` (
  `copter_ID` int(11) NOT NULL AUTO_INCREMENT,
  `copter_IP` varchar(45) DEFAULT NULL,
  `controlled_by` varchar(100) DEFAULT NULL,
  `connected` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`copter_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `copter`
--

LOCK TABLES `copter` WRITE;
/*!40000 ALTER TABLE `copter` DISABLE KEYS */;
INSERT INTO `copter` VALUES (1,NULL,'abcd',0);
/*!40000 ALTER TABLE `copter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `input`
--

DROP TABLE IF EXISTS `input`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `input` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `x1` double DEFAULT NULL,
  `y1` double DEFAULT NULL,
  `x2` double DEFAULT NULL,
  `y2` double DEFAULT NULL,
  `arm` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `input`
--

LOCK TABLES `input` WRITE;
/*!40000 ALTER TABLE `input` DISABLE KEYS */;
INSERT INTO `input` VALUES (1,-0.05735868215560913,-0.07392990589141846,-0.14671552181243896,0,0);
/*!40000 ALTER TABLE `input` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessionhistory`
--

DROP TABLE IF EXISTS `sessionhistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessionhistory` (
  `session_ID` int(11) NOT NULL AUTO_INCREMENT,
  `datetime_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datetime_stop` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_ID` int(11) NOT NULL,
  `user_IP` varchar(45) NOT NULL,
  `copter_ID` int(11) NOT NULL,
  PRIMARY KEY (`session_ID`),
  KEY `user_ID` (`user_ID`),
  KEY `copter_ID` (`copter_ID`),
  CONSTRAINT `sessionhistory_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`),
  CONSTRAINT `sessionhistory_ibfk_2` FOREIGN KEY (`copter_ID`) REFERENCES `copter` (`copter_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessionhistory`
--

LOCK TABLES `sessionhistory` WRITE;
/*!40000 ALTER TABLE `sessionhistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessionhistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `pass` char(96) NOT NULL,
  `controller_cfg` int(11) NOT NULL DEFAULT '1',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiration_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (85,'abcd','AvWPP1<s5wEOSNd<+P]dz8\"jgE-xT2p2d5d8d841cad243fe7c2f6aad3ae05ea134661319d280592991214be3cd58e753',1,1,'2014-11-27 11:36:23','0000-00-00 00:00:00'),(86,'Admin','dF]bp\"C/*Yb4CkG52ba$Ns;zgLCuz#`5eb085401ab2083fcf81135113c08426b743b9d07c2fc3e36a04db5b80ae59738',1,1,'2014-11-27 11:36:38','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-01 11:09:57
