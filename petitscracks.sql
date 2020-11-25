CREATE DATABASE  IF NOT EXISTS `petitscracks` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `petitscracks`;
-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: localhost    Database: petitscracks
-- ------------------------------------------------------
-- Server version	8.0.22-0ubuntu0.20.04.2

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
-- Table structure for table `actuality`
--

DROP TABLE IF EXISTS `actuality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `actuality` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext,
  `date` date NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actuality`
--

LOCK TABLES `actuality` WRITE;
/*!40000 ALTER TABLE `actuality` DISABLE KEYS */;
INSERT INTO `actuality` VALUES (1,'Encore un trophée pour notre chère Maya','\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"','2020-11-24',NULL),(2,'Covid19 - Nous restons joignables pendant le confinement','\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"','2020-11-14','5fbe26d8b12a8.jpg'),(4,'95% des Français louent la présence de leur chien pendant le confinement','Une récente étude montre que 95% des Français affirment que la présence de leur chien les a aidés à surmonter le confinement. Une étude sur les changements dans le rythme de vie des chiens et de leurs maîtres pendant la période de confinement nous prouve que les chiens ont grandement contribué au bien-être de leurs propriétaires. Elle a été menée par DogsPlanet.com pendant 8 jours lors du confinement lié au COVID-19 et a collecté 1248 réponses. Il était exigé de spécifier le département de résidence et le nombre de chiens présents dans le foyer. Tous les résultats et toutes les analyses de l\'étude sont disponibles sur cette page : https://www.dogsplanet.com/dossiers/le-chien/etude-quotidien-chien-maitre-confinement-covid-19/. 44% des Français ont effectué plus de 3 sorties quotidiennes avec leur chien pendant cette période de confinement. L\'étude nous montre que les chiens sont une bonne raison pour sortir prendre l\'air. 64% des promenades duraient plus de 15 minutes et 44% des Français ont effectué plus de 3 sorties quotidiennes avec leur chien. (Source Dogsplanet)','2020-11-12','5fbe26e825fae.jpg');
/*!40000 ALTER TABLE `actuality` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `age_category`
--

DROP TABLE IF EXISTS `age_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `age_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(45) NOT NULL,
  `label` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `age_category`
--

LOCK TABLES `age_category` WRITE;
/*!40000 ALTER TABLE `age_category` DISABLE KEYS */;
INSERT INTO `age_category` VALUES (1,'Chiot','puppies'),(2,'Adulte','adult');
/*!40000 ALTER TABLE `age_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `color`
--

DROP TABLE IF EXISTS `color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `color` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dog_color` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `color`
--

LOCK TABLES `color` WRITE;
/*!40000 ALTER TABLE `color` DISABLE KEYS */;
INSERT INTO `color` VALUES (1,'Sable'),(2,'Chocolat'),(3,'Noir'),(4,'Tricolore'),(5,'Fauve'),(6,'Fauve charbonneux');
/*!40000 ALTER TABLE `color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dog`
--

DROP TABLE IF EXISTS `dog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `birthday` date NOT NULL,
  `description` longtext,
  `link_chiendefrance` varchar(255) DEFAULT NULL,
  `lof_number` varchar(100) DEFAULT NULL,
  `is_dna_tested` tinyint DEFAULT NULL,
  `gender_id` int NOT NULL,
  `color_id` int NOT NULL,
  `age_category_id` int NOT NULL,
  `status_id` int NOT NULL,
  `mother_id` int DEFAULT NULL,
  `father_id` int DEFAULT NULL,
  `isOnHomepage` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_idx` (`color_id`),
  KEY `id_idx1` (`age_category_id`),
  KEY `sex_id_idx` (`gender_id`),
  KEY `status_id_idx` (`status_id`),
  KEY `mother_id_idx` (`mother_id`),
  KEY `father_id_idx` (`father_id`),
  CONSTRAINT `age_category_id` FOREIGN KEY (`age_category_id`) REFERENCES `age_category` (`id`),
  CONSTRAINT `color_id` FOREIGN KEY (`color_id`) REFERENCES `color` (`id`),
  CONSTRAINT `father_id` FOREIGN KEY (`father_id`) REFERENCES `dog` (`id`),
  CONSTRAINT `gender_id` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`),
  CONSTRAINT `mother_id` FOREIGN KEY (`mother_id`) REFERENCES `dog` (`id`),
  CONSTRAINT `status_id` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dog`
--

LOCK TABLES `dog` WRITE;
/*!40000 ALTER TABLE `dog` DISABLE KEYS */;
INSERT INTO `dog` VALUES (1,'Rufus du Paradis des Petits Cracks','5fb53d6525128.jpeg','2020-10-07','Il est sympa vraiment très sympa et il mange pas les enfants','','Oui',0,1,2,2,3,NULL,NULL,0),(2,'Maya du Paradis des Petits Cracks','5fbbd6ac77110.jpeg','2018-08-14','Super','','010101010101',0,2,2,2,4,NULL,NULL,0),(7,'Framboise du Paradis des Petits Cracks','5fbbd6c08bada.jpg','2020-11-06','','https://www.chiens-de-france.com/','',0,2,3,1,1,2,NULL,0),(8,'Composition du Paradis des Petits Cracks','5fbbd6d449a7a.png','2019-10-01','','','',0,2,2,2,4,30,1,0),(10,'Blablubli du Paradis des Petits Cracks','5fbbd6e13c396.jpg','2020-11-14','','https://www.chiens-de-france.com/','',0,1,4,2,2,NULL,NULL,0),(12,'Schokobon du Paradis des Petits Cracks','5fbbd6f406083.jpg','2016-11-08','Petit chien plutôt sympa mais pas avec le facteur','','',0,1,1,1,3,25,20,0),(18,'Unlock du Paradis des Petits Cracks','5fbbd78fe5dbc.jpg','2020-11-27','','','',0,1,2,1,2,2,NULL,0),(19,'A effacer du Paradis des Petits cracks','5fbbd7825f313.jpg','2020-12-04','','','',0,2,2,2,4,8,21,0),(20,'Phood du Paradis des Petits Cracks','5fbbd7bb1804c.jpg','2020-08-12','Lorem ipsum','','',0,1,4,2,4,2,NULL,0),(21,'Winter du Paradis des Petits Cracks','5fbbd765706e8.jpg','2016-11-16','','','',0,1,4,2,4,24,21,0),(22,'Geekvape du Paradis des Petits Cracks','5fbbd44c24257.jpg','2018-11-04','','','',0,1,1,2,4,25,22,0),(23,'Cuillère du Paradis des Petits Cracks','5fbbd734f24e1.jpg','2020-11-19','','','',0,2,4,2,5,24,21,0),(24,'Hellfest du Paradis des Petits Cracks','5fbbd7524824a.jpg','2020-11-18','','','',0,2,1,2,3,NULL,NULL,0),(25,'Motocultor du Paradis des Patits Cracks','5fbbd7a3bc3db.jpg','2020-11-10','','','',0,2,5,2,2,2,NULL,0),(29,'A modifier du Paradis des Petits cracks','5fb2e3b087d53.jpg','2020-11-05','','','',0,1,4,1,3,NULL,NULL,0),(30,'A effacer du Paradis des Petits Cracks','5fb53ff1f2d12.jpg','2020-10-30','','','',0,2,3,2,1,2,2,1),(31,'Café au lait du Paradis des Petits Cracks','5fb540485356b.jpg','1987-05-26','','','',0,1,1,1,5,NULL,NULL,1),(32,'Test home du Paradis des Petits Cracks','5fbb96b471053.jpg','2020-11-04','','','',0,2,2,2,4,19,22,1);
/*!40000 ALTER TABLE `dog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gender`
--

DROP TABLE IF EXISTS `gender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender` varchar(10) NOT NULL,
  `label` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gender`
--

LOCK TABLES `gender` WRITE;
/*!40000 ALTER TABLE `gender` DISABLE KEYS */;
INSERT INTO `gender` VALUES (1,'Mâle','male'),(2,'Femelle','female');
/*!40000 ALTER TABLE `gender` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dog_status` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'À vendre'),(2,'Réservé'),(3,'Vendu'),(4,'Reproducteur'),(5,'En retraite'),(6,'Décédé');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-25 10:46:25
