-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: localhost    Database: modelo_login
-- ------------------------------------------------------
-- Server version	8.0.21

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
-- Table structure for table `entidade_governamental_cargo`
--

DROP TABLE IF EXISTS `entidade_governamental_cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `entidade_governamental_cargo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `entidade_governamental_id` int NOT NULL,
  `cargo_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  PRIMARY KEY (`id`,`entidade_governamental_id`,`cargo_id`,`usuario_id`),
  KEY `fk_entidade_governamental_cargo_entidade_governamental1_idx` (`entidade_governamental_id`),
  KEY `fk_entidade_governamental_cargo_cargo1_idx` (`cargo_id`),
  KEY `fk_entidade_governamental_cargo_usuario1_idx` (`usuario_id`),
  CONSTRAINT `fk_entidade_governamental_cargo_cargo1` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`id`),
  CONSTRAINT `fk_entidade_governamental_cargo_entidade_governamental1` FOREIGN KEY (`entidade_governamental_id`) REFERENCES `entidade_governamental` (`id`),
  CONSTRAINT `fk_entidade_governamental_cargo_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Localização do usuário\\n';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entidade_governamental_cargo`
--

LOCK TABLES `entidade_governamental_cargo` WRITE;
/*!40000 ALTER TABLE `entidade_governamental_cargo` DISABLE KEYS */;
/*!40000 ALTER TABLE `entidade_governamental_cargo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-06 15:32:12
