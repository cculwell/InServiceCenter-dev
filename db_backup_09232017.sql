-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: amsti_01
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) DEFAULT NULL,
  `book_title` varchar(100) DEFAULT NULL,
  `publisher` varchar(100) DEFAULT NULL,
  `isbn` varchar(25) DEFAULT NULL,
  `cost_per_book` int(11) DEFAULT NULL,
  `study_format` varchar(50) DEFAULT NULL,
  `admin_signature` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`book_id`),
  KEY `books_requests_request_id_fk` (`request_id`),
  CONSTRAINT `books_requests_request_id_fk` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (5,5,'My Book','My Publisher','123455676',10,'round table',NULL),(6,6,'My Book','My Publisher','123455676',10,'round table',NULL),(7,7,'My Book','My Publisher','123455676',10,'round table',NULL),(8,8,'My Book','My Publisher','123455676',10,'round table',NULL),(11,11,'My Book','My Publisher','123455676',10,'round table',NULL),(12,12,'My Book','My Publisher','123455676',10,'round table',NULL),(13,13,'My Book','My Publisher','123455676',10,'round table',NULL),(14,15,'','','',0,'',NULL);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) DEFAULT NULL,
  `contact_role` varchar(50) DEFAULT NULL,
  `contact_name` varchar(50) DEFAULT NULL,
  `contact_phn_nbr` varchar(15) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `contact_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`contact_id`),
  KEY `contacts_requests_request_id_fk` (`request_id`),
  CONSTRAINT `contacts_requests_request_id_fk` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (3,5,'Contact','Rick Milliken','256-653-7440','rick@me.com',NULL),(4,5,'Company','AT&T','205-714-0046','rx5229@att.com',NULL),(5,5,'Facilitator','Heidi','256-653-7700','h@me.com',NULL),(6,6,'Contact','Rick Milliken','256-653-7440','rick@me.com',NULL),(7,6,'Company','AT&T','205-714-0046','rx5229@att.com',NULL),(8,6,'Facilitator','Heidi','256-653-7700','h@me.com',NULL),(9,7,'Contact','Rick Milliken','256-653-7440','rick@me.com',NULL),(10,7,'Company','AT&T','205-714-0046','rx5229@att.com',NULL),(11,7,'Facilitator','Heidi','256-653-7700','h@me.com',NULL),(12,8,'Contact','Rick Milliken','256-653-7440','rick@me.com',NULL),(13,8,'Company','AT&T','205-714-0046','rx5229@att.com',NULL),(14,8,'Facilitator','Heidi','256-653-7700','h@me.com',NULL),(15,11,'Contact','Rick Milliken','256-653-7440','rick@me.com',NULL),(16,11,'Company','AT&T','205-714-0046','rx5229@att.com',NULL),(17,11,'Facilitator','Heidi','256-653-7700','h@me.com',NULL),(18,12,'Contact','Rick Milliken','256-653-7440','rick@me.com',NULL),(19,12,'Company','AT&T','205-714-0046','rx5229@att.com',NULL),(20,12,'Facilitator','Heidi','256-653-7700','h@me.com',NULL),(21,13,'Contact','Rick Milliken','256-653-7440','rick@me.com',NULL),(22,13,'Company','AT&T','205-714-0046','rx5229@att.com',NULL),(23,13,'Facilitator','Heidi','256-653-7700','h@me.com',NULL),(24,15,'Contact','Ric','2566537440','rm@me.com',NULL),(25,15,'Company','AT&T ','2566537440','rickmilliken@me.com',NULL),(26,15,'Facilitator','','','',NULL),(27,16,'Contact','Ric','2566537440','rm@me.com',NULL),(28,16,'Company','AT&T ','2566537440','rickmilliken@me.com',NULL),(29,16,'Facilitator','','','',NULL),(30,17,'Contact','Ric','2566537440','rm@me.com',NULL),(31,17,'Company','AT&T ','2566537440','rickmilliken@me.com',NULL),(32,18,'Contact','Ric','2566537440','rm@me.com',NULL),(33,18,'Company','AT&T ','2566537440','rickmilliken@me.com',NULL),(34,19,'Contact','Ric','2566537440','rm@me.com',NULL),(35,19,'Company','AT&T ','2566537440','rickmilliken@me.com',NULL);
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `date_times`
--

DROP TABLE IF EXISTS `date_times`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `date_times` (
  `request_dt_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `request_start_time` time DEFAULT NULL,
  `request_end_time` time DEFAULT NULL,
  PRIMARY KEY (`request_dt_id`),
  KEY `request_dt_requests_request_id_fk` (`request_id`),
  CONSTRAINT `request_dt_requests_request_id_fk` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `date_times`
--

LOCK TABLES `date_times` WRITE;
/*!40000 ALTER TABLE `date_times` DISABLE KEYS */;
/*!40000 ALTER TABLE `date_times` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history` (
  `hist_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) DEFAULT NULL,
  `hist_txt` text,
  `hist_dt` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`hist_id`),
  KEY `history_requests_request_id_fk` (`request_id`),
  CONSTRAINT `history_requests_request_id_fk` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `office_uses`
--

DROP TABLE IF EXISTS `office_uses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `office_uses` (
  `ou_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) DEFAULT NULL,
  `director_name` varchar(50) DEFAULT NULL,
  `board_approval` varchar(3) DEFAULT NULL,
  `amt_sponsored` int(11) DEFAULT NULL,
  `inservice_order` varchar(25) DEFAULT NULL,
  `payment_type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ou_id`),
  KEY `ous_requests_request_id_fk` (`request_id`),
  CONSTRAINT `ous_requests_request_id_fk` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Official Uses';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `office_uses`
--

LOCK TABLES `office_uses` WRITE;
/*!40000 ALTER TABLE `office_uses` DISABLE KEYS */;
/*!40000 ALTER TABLE `office_uses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_type` varchar(25) DEFAULT NULL,
  `workflow_state` varchar(50) DEFAULT NULL,
  `school` varchar(50) DEFAULT NULL,
  `system` varchar(50) DEFAULT NULL,
  `request_desc` varchar(255) DEFAULT NULL,
  `request_just` varchar(255) DEFAULT NULL,
  `request_location` varchar(100) DEFAULT NULL,
  `target_participants` int(11) DEFAULT NULL,
  `enrolled_participants` int(11) DEFAULT NULL,
  `total_hours` int(11) DEFAULT NULL,
  `total_cost` int(11) DEFAULT NULL,
  `eval_method` varchar(255) DEFAULT NULL,
  `stipd` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
INSERT INTO `requests` VALUES (5,'BookStudy','New','Fairview','Cullman Count','','Teach them to read','Alabama',10,8,20,100,'',NULL),(6,'General','New','Fairview','Cullman Count','New request Desc','Teach them to read','Alabama',10,8,20,100,'Eval Method is live',NULL),(7,'General','New','Fairview','Cullman Count','New request Desc','Teach them to read','Alabama',10,8,20,100,'Eval Method is live',NULL),(8,'General','New','Fairview','Cullman Count','New request Desc','Teach them to read','Alabama',10,8,20,100,'Eval Method is live',NULL),(11,'General','New','Fairview','Cullman Count','New request Desc','Teach them to read','Alabama',10,8,20,100,'Eval Method is live',NULL),(12,'General','New','Fairview','Cullman Count','New request Desc','Teach them to read','Alabama',10,8,20,100,'Eval Method is live',NULL),(13,'General','New','Fairview','Cullman Count','New request Desc','Teach them to read','Alabama',10,8,20,100,'Eval Method is live',NULL),(15,'BookStudy','New','Cullman','Cullman City','Needs computer','Not enough pC','alabama',10,9,10,1000,'grades',NULL),(16,'General','New','Cullman','Cullman City','Needs computer','Not enough pC','alabama',10,9,10,1000,'grades',NULL),(17,'General','New','Cullman','Cullman City','Needs computer','Not enough pC','alabama',10,9,10,1000,'grades',NULL),(18,'General','New','Cullman','Cullman City','Needs computer','Not enough pC','alabama',10,9,10,1000,'grades',NULL),(19,'General','New','Cullman','Cullman City','Needs computer','Not enough pC','alabama',10,9,10,1000,'grades',NULL);
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workshops`
--

DROP TABLE IF EXISTS `workshops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workshops` (
  `workshop_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) DEFAULT NULL,
  `program_nbr` int(11) DEFAULT NULL,
  `pd_title` varchar(100) DEFAULT NULL,
  `pd_desc` varchar(255) DEFAULT NULL,
  `standards_covered` varchar(100) DEFAULT NULL,
  `target_group` varchar(50) DEFAULT NULL,
  `actual_participants` int(11) DEFAULT NULL,
  `consultant_fee` int(11) DEFAULT NULL,
  `travel` varchar(3) DEFAULT NULL,
  `other_info` varchar(255) DEFAULT NULL,
  `stipd` varchar(3) DEFAULT NULL,
  `room_res_needed` varchar(3) DEFAULT NULL,
  `sti_title_nbr` int(11) DEFAULT NULL,
  `folder_completed` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`workshop_id`),
  KEY `workshops_requests_request_id_fk` (`request_id`),
  CONSTRAINT `workshops_requests_request_id_fk` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workshops`
--

LOCK TABLES `workshops` WRITE;
/*!40000 ALTER TABLE `workshops` DISABLE KEYS */;
/*!40000 ALTER TABLE `workshops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'amsti_01'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-23 15:04:26
