-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: localhost    Database: tecumsehalarmes63112
-- ------------------------------------------------------
-- Server version	8.0.21-0ubuntu0.20.04.4

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
-- Table structure for table `equipamento_falhas`
--

DROP TABLE IF EXISTS `equipamento_falhas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipamento_falhas` (
  `id_equipamento` int NOT NULL,
  `id_falha` int NOT NULL,
  `observacao` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `criado` datetime DEFAULT NULL,
  `editado` datetime DEFAULT NULL,
  PRIMARY KEY (`id_falha`,`id_equipamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipamento_falhas`
--

LOCK TABLES `equipamento_falhas` WRITE;
/*!40000 ALTER TABLE `equipamento_falhas` DISABLE KEYS */;
INSERT INTO `equipamento_falhas` VALUES (4,5,'teste 1','2020-08-23 10:22:09',NULL);
/*!40000 ALTER TABLE `equipamento_falhas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipamentos`
--

DROP TABLE IF EXISTS `equipamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipamentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tag` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `equipamento` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `criado` datetime DEFAULT NULL,
  `editado` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_UNIQUE` (`tag`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipamentos`
--

LOCK TABLES `equipamentos` WRITE;
/*!40000 ALTER TABLE `equipamentos` DISABLE KEYS */;
INSERT INTO `equipamentos` VALUES (4,'EQUP1','EQUIPAMENTO 1','2020-08-15 13:33:46',NULL),(5,'EQUP2','EQUIPAMENTO 2','2020-08-15 13:33:56',NULL),(6,'ABC','nOME eQUIP','2020-08-17 08:49:31',NULL),(7,'CT10','CORREIA TRANSPORTADORA 10','2020-08-17 08:53:35','2020-08-17 09:07:58');
/*!40000 ALTER TABLE `equipamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `falha_procedimentos`
--

DROP TABLE IF EXISTS `falha_procedimentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `falha_procedimentos` (
  `id_falha` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ordem` int NOT NULL,
  `procedimento` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `criado` datetime DEFAULT NULL,
  `editado` datetime DEFAULT NULL,
  PRIMARY KEY (`id_falha`,`ordem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `falha_procedimentos`
--

LOCK TABLES `falha_procedimentos` WRITE;
/*!40000 ALTER TABLE `falha_procedimentos` DISABLE KEYS */;
INSERT INTO `falha_procedimentos` VALUES ('5',1,'fazer','2020-08-23 10:22:21',NULL);
/*!40000 ALTER TABLE `falha_procedimentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `falhas`
--

DROP TABLE IF EXISTS `falhas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `falhas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tag` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `falha` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `criado` datetime DEFAULT NULL,
  `editado` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_UNIQUE` (`tag`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `falhas`
--

LOCK TABLES `falhas` WRITE;
/*!40000 ALTER TABLE `falhas` DISABLE KEYS */;
INSERT INTO `falhas` VALUES (5,'FLH1','FALHA 1','2020-08-15 13:34:09','2020-08-23 11:04:50'),(6,'FLH2','FALHA 2','2020-08-15 13:34:19',NULL),(8,'DEMER','FALHA DE EMERGENCIA LOCAL','2020-08-17 08:54:11','2020-08-17 09:08:41');
/*!40000 ALTER TABLE `falhas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `senha` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1234567890',
  `criado` datetime DEFAULT NULL,
  `editado` datetime DEFAULT NULL,
  `permissao` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (11,'lz','lz','2020-08-15 11:40:15','2020-08-23 10:59:27',0),(12,'rn','rn','2020-08-16 12:23:38',NULL,1),(14,'la','la','2020-08-16 17:38:09',NULL,0),(15,'RM','RM','2020-08-17 09:00:24',NULL,0);
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

-- Dump completed on 2020-08-23 11:17:04
