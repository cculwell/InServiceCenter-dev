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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,7,'Book','Pub','1234567890',5,'study format',NULL),(2,8,'Book','Pub','1234567890',5,'study format',NULL),(3,9,'Book','Pub','1234567890',5,'study format',NULL),(4,10,'Book','Pub','1234567890',5,'study format',NULL),(5,11,'Book','Pub','1234567890',5,'study format',NULL),(6,12,'Book','Pub','1234567890',5,'study format',NULL);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bylaws`
--

DROP TABLE IF EXISTS `bylaws`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bylaws` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `current` varchar(10) DEFAULT NULL,
  `file_path` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bylaws`
--

LOCK TABLES `bylaws` WRITE;
/*!40000 ALTER TABLE `bylaws` DISABLE KEYS */;
INSERT INTO `bylaws` VALUES (4,'bylaws1.pdf','yes','../../../Uploads/Bylaws/bylaws1.pdf');
/*!40000 ALTER TABLE `bylaws` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (2,1,'Company','Eight','123-456-0987','support@company.com',''),(7,4,'Contact','John Smtih','098-765-4321','jsmith@company.com',NULL),(9,5,'Contact','John Smtih','098-765-4321','jsmith@company.com',NULL),(11,6,'Contact','John Smtih','098-765-4321','jsmith@company.com',NULL),(12,6,'Company','company','123-456-0987','support@company.com',NULL),(13,7,'Contact','John Smtih','098-765-4321','jsmith@company.com',NULL),(14,7,'Facilitator','Jane Doe','123-456-7890','jdoe@school.com',NULL),(15,8,'Contact','John Smtih','098-765-4321','jsmith@company.com',NULL),(16,8,'Facilitator','Jane Doe','123-456-7890','jdoe@school.com',NULL),(17,9,'Contact','John Smtih','098-765-4321','jsmith@company.com',NULL),(18,9,'Facilitator','Jane Doe','123-456-7890','jdoe@school.com',NULL),(19,10,'Contact','John Smtih','098-765-4321','jsmith@company.com',NULL),(20,10,'Facilitator','Jane Doe','123-456-7890','jdoe@school.com',NULL),(21,11,'Contact','John Smtih','098-765-4321','jsmith@company.com',NULL),(22,11,'Facilitator','Jane Doe','123-456-7890','jdoe@school.com',NULL),(23,12,'Contact','John Smtih','098-765-4321','jsmith@company.com',NULL),(24,12,'Facilitator','Jane Doe','123-456-7890','jdoe@school.com',NULL),(25,13,'Contact','contact','123-456-7890','contact@company.com',NULL),(26,13,'Company','Company','123-456-7890','support@company.com',NULL),(27,14,'Contact','contact','123-456-7890','contact@company',NULL),(28,14,'Company','company','123-456-7890','support@company.com',NULL),(31,3,'Facilitator','Jane Doe','123-456-7890','jdoe@school.com',NULL),(33,2,'Contact','John Smtih','098-765-4321','jsmith@company.com',NULL),(35,3,'Contact','John Smtih','098-765-4321','jsmith@company.com',NULL),(36,4,'Company','company','123-456-0987','support@company.com',NULL),(73,1,'51','John Smtih','098-765-4321','jsmith@company.com',''),(74,1,'5','John Smtih','098-765-4321','jsmith@company.com','1'),(79,1,'5','John Smtih','098-765-4321','jsmith@company.com','6'),(82,1,'Parker','Jon','123-123-1234','j@me.com','123'),(86,1,'parker','Jon','123-123-1223','j@me.com','121212'),(87,1,'Parker','Jon','123-123-1234','j@me.com','124'),(106,18,'Contact','','','',NULL),(107,18,'Company','','','',NULL),(114,22,'Contact','','','',NULL),(115,22,'Company','','','',NULL);
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
  `request_break_Time` int(11) DEFAULT NULL,
  `request_dt_note` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`request_dt_id`),
  KEY `request_dt_requests_request_id_fk` (`request_id`),
  CONSTRAINT `request_dt_requests_request_id_fk` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `date_times`
--

LOCK TABLES `date_times` WRITE;
/*!40000 ALTER TABLE `date_times` DISABLE KEYS */;
INSERT INTO `date_times` VALUES (1,1,'2017-10-30','08:00:00','17:00:00',1,NULL),(2,1,'2017-10-31','08:00:00','17:00:00',1,NULL),(3,2,'2017-10-30','08:00:00','17:00:00',1,NULL),(4,2,'2017-10-31','08:00:00','17:00:00',1,NULL),(5,3,'2017-10-30','08:00:00','17:00:00',1,NULL),(6,3,'2017-10-31','08:00:00','17:00:00',1,NULL),(7,4,'2017-10-30','08:00:00','17:00:00',1,NULL),(8,4,'2017-10-31','08:00:00','17:00:00',1,NULL),(9,5,'2017-10-30','08:00:00','17:00:00',1,NULL),(10,5,'2017-10-31','08:00:00','17:00:00',1,NULL),(11,6,'2017-10-30','08:00:00','17:00:00',1,NULL),(12,6,'2017-10-31','08:00:00','17:00:00',1,NULL),(13,7,'2017-10-30','08:00:00','17:00:00',1,NULL),(14,7,'2017-10-31','08:00:00','17:00:00',1,NULL),(15,8,'2017-10-30','08:00:00','17:00:00',1,NULL),(16,8,'2017-10-31','08:00:00','17:00:00',1,NULL),(17,9,'2017-10-30','08:00:00','17:00:00',1,NULL),(18,9,'2017-10-31','08:00:00','17:00:00',1,NULL),(19,10,'2017-10-30','08:00:00','17:00:00',1,NULL),(20,10,'2017-10-31','08:00:00','17:00:00',1,NULL),(21,11,'2017-10-30','08:00:00','17:00:00',1,NULL),(22,11,'2017-10-31','08:00:00','17:00:00',1,NULL),(23,12,'2017-10-30','08:00:00','17:00:00',1,NULL),(24,12,'2017-10-31','08:00:00','17:00:00',1,NULL),(25,13,'2017-10-31','08:00:00','17:00:00',1,NULL),(26,14,'2017-10-30','08:00:00','05:00:00',1,NULL),(27,18,'2017-11-07','08:30:00','10:00:00',1,NULL),(28,22,'2017-11-07','09:00:00','10:30:00',1,NULL);
/*!40000 ALTER TABLE `date_times` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detailed_report_data`
--

DROP TABLE IF EXISTS `detailed_report_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detailed_report_data` (
  `request_id` int(10) NOT NULL,
  `program_nbr` varchar(10) DEFAULT NULL,
  `program_title` varchar(100) DEFAULT NULL,
  `request_start_date` date DEFAULT NULL,
  `request_start_time` time DEFAULT NULL,
  `request_end_date` date DEFAULT NULL,
  `request_end_time` time DEFAULT NULL,
  `request_location` varchar(100) DEFAULT NULL,
  `max_participants` int(100) DEFAULT NULL,
  `enrolled_participants` int(100) DEFAULT NULL,
  `workflow_state` varchar(100) DEFAULT NULL,
  `support_initiative` varchar(50) DEFAULT NULL,
  `sessions` int(10) DEFAULT NULL,
  `target_audience` varchar(100) DEFAULT NULL,
  `curriculum_area` varchar(50) DEFAULT NULL,
  `av_description` varchar(100) DEFAULT NULL,
  `staff_notes` varchar(500) DEFAULT NULL,
  `consultant_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detailed_report_data`
--

LOCK TABLES `detailed_report_data` WRITE;
/*!40000 ALTER TABLE `detailed_report_data` DISABLE KEYS */;
INSERT INTO `detailed_report_data` VALUES (1,'17-1-001','Another Exciting Program','2017-10-05','13:00:00','2017-10-05','16:00:00','Athens State University AMSTI/In-Service Center',10,9,'New','ASIM',2,'K-12','Mathematics','None','They did all the things','SomeGuy'),(2,'17-1-002','This Program Was Canceled :(','2017-10-20','13:00:00','2017-10-20','17:00:00','Athens State University AMSTI/In-Service Center',10,10,'Canceled','RIC',1,'High School','English','Projector','They didn\'t do all of the things','Dude'),(3,'17-1-040','An Exciting Program','2017-10-18','13:00:00','2017-10-18','16:00:00','Athens State University AMSTI/In-Service Center',10,8,'New','AMSTI',2,'Middle School','Social Studies','None','They did some more things','Another Dude');
/*!40000 ALTER TABLE `detailed_report_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) DEFAULT NULL,
  `expense_type` text,
  `expense_amount` float DEFAULT NULL,
  `expense_note` text,
  PRIMARY KEY (`expense_id`),
  KEY `expenses_requests_request_id_fk` (`request_id`),
  CONSTRAINT `expenses_requests_request_id_fk` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` VALUES (1,1,'faciltator',10,'test1'),(5,1,'asdf',10,'note'),(6,1,'test',30,'asdf');
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `financial_report_data`
--

DROP TABLE IF EXISTS `financial_report_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `financial_report_data` (
  `request_id` int(10) NOT NULL,
  `program_nbr` varchar(10) DEFAULT NULL,
  `program_title` varchar(100) DEFAULT NULL,
  `request_start_date` date DEFAULT NULL,
  `request_start_time` time DEFAULT NULL,
  `request_end_date` date DEFAULT NULL,
  `request_end_time` time DEFAULT NULL,
  `request_location` varchar(100) DEFAULT NULL,
  `max_participants` int(100) DEFAULT NULL,
  `enrolled_participants` int(100) DEFAULT NULL,
  `workflow_state` varchar(100) DEFAULT NULL,
  `support_initiative` varchar(50) DEFAULT NULL,
  `sessions` int(10) DEFAULT NULL,
  `target_audience` varchar(100) DEFAULT NULL,
  `consultant_fee` decimal(5,2) DEFAULT NULL,
  `misc_fee` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `financial_report_data`
--

LOCK TABLES `financial_report_data` WRITE;
/*!40000 ALTER TABLE `financial_report_data` DISABLE KEYS */;
INSERT INTO `financial_report_data` VALUES (1,'17-1-001','Another Exciting Program','2017-10-06','17:00:00','2017-10-06','19:44:00','Athens State University AMSTI/In-Service Center',10,9,'New','ASIM',2,'K-12',100.00,100.00),(2,'17-1-002','This Program Was Canceled :(','2017-10-13','19:00:00','2017-10-13','23:00:00','Athens State University AMSTI/In-Service Center',10,10,'Canceled','RIC',1,'High School',100.00,200.00),(3,'17-1-040','An Exciting Program','2017-10-10','13:00:00','2017-10-10','14:00:00','Athens State University AMSTI/In-Service Center',10,8,'New','AMSTI',2,'Middle School',100.00,50.00);
/*!40000 ALTER TABLE `financial_report_data` ENABLE KEYS */;
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
-- Table structure for table `newsletters`
--

DROP TABLE IF EXISTS `newsletters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletters` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `current` varchar(10) DEFAULT NULL,
  `file_path` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletters`
--

LOCK TABLES `newsletters` WRITE;
/*!40000 ALTER TABLE `newsletters` DISABLE KEYS */;
INSERT INTO `newsletters` VALUES (3,'current-newsletter.pdf','yes','../../../Uploads/Newsletters/current-newsletter.pdf');
/*!40000 ALTER TABLE `newsletters` ENABLE KEYS */;
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
-- Table structure for table `quick_report_data`
--

DROP TABLE IF EXISTS `quick_report_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quick_report_data` (
  `request_id` int(10) NOT NULL,
  `program_nbr` varchar(10) DEFAULT NULL,
  `program_title` varchar(100) DEFAULT NULL,
  `request_start_date` date DEFAULT NULL,
  `request_start_time` time DEFAULT NULL,
  `request_end_date` date DEFAULT NULL,
  `request_end_time` time DEFAULT NULL,
  `request_location` varchar(100) DEFAULT NULL,
  `max_participants` int(100) DEFAULT NULL,
  `enrolled_participants` int(100) DEFAULT NULL,
  `workflow_state` varchar(100) DEFAULT NULL,
  `support_initiative` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quick_report_data`
--

LOCK TABLES `quick_report_data` WRITE;
/*!40000 ALTER TABLE `quick_report_data` DISABLE KEYS */;
INSERT INTO `quick_report_data` VALUES (1,'17-1-040','An Exciting Program','2017-10-23','10:00:00','2017-10-23','13:00:00','Athens State University AMSTI/In-Service Center ',10,8,'New','AMSTI'),(3,'17-1-001','Another Exciting Program','2017-10-25','10:00:00','2017-10-25','12:00:00','Athens State University AMSTI/In-Service Center ',10,9,'New','ASIM'),(14,'17-1-002','This Program Was Canceled :(','2017-10-27','12:00:00','2017-10-27','17:00:00','Athens State University AMSTI/In-Service Center ',10,10,'Canceled','RIC');
/*!40000 ALTER TABLE `quick_report_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `quick_report_data_orig`
--

DROP TABLE IF EXISTS `quick_report_data_orig`;
/*!50001 DROP VIEW IF EXISTS `quick_report_data_orig`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `quick_report_data_orig` AS SELECT 
 1 AS `request_id`,
 1 AS `program_nbr`,
 1 AS `pd_title`,
 1 AS `request_start_date`,
 1 AS `request_start_time`,
 1 AS `request_end_date`,
 1 AS `request_end_time`,
 1 AS `request_location`,
 1 AS `target_participants`,
 1 AS `enrolled_participants`,
 1 AS `actual_participants`*/;
SET character_set_client = @saved_cs_client;

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
  `request_desc` text,
  `request_just` text,
  `request_location` varchar(100) DEFAULT NULL,
  `target_participants` int(11) DEFAULT NULL,
  `enrolled_participants` int(11) DEFAULT NULL,
  `total_hours` int(11) DEFAULT NULL,
  `total_cost` int(11) DEFAULT NULL,
  `eval_method` varchar(255) DEFAULT NULL,
  `stipd` varchar(3) DEFAULT NULL,
  `workshop` varchar(3) DEFAULT NULL,
  `report_date` date DEFAULT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
INSERT INTO `requests` VALUES (1,'General','New','Fairview High School','Cullman County','desc','just','location',10,5,NULL,100,'eval',NULL,NULL,NULL),(2,'General','New','Hanceville High School','Cullman County','desc','just','location',10,5,NULL,200,'eval',NULL,NULL,NULL),(3,'General','New','Cullman High School','Cullman City','desc','just','location',10,5,NULL,500,'eval',NULL,NULL,NULL),(4,'General','New','East Elementary','Cullman City','desc','just','location',10,5,NULL,100,'eval',NULL,NULL,NULL),(5,'General','New','West Elementary','Cullman City','desc','just','location',10,5,NULL,100,'eval',NULL,NULL,NULL),(6,'General','New','East Elementary','Cullman City','desc','just','location',10,5,NULL,50,'eval',NULL,NULL,NULL),(7,'BookStudy','New','East Elementary','Cullman City','desc','just','location',10,5,NULL,50,'eval',NULL,NULL,NULL),(8,'BookStudy','New','West Elementary','Cullman City','desc','just','location',10,5,NULL,50,'eval',NULL,NULL,NULL),(9,'BookStudy','New','Cullman High School','Cullman City','desc','just','location',10,5,NULL,50,'eval',NULL,NULL,NULL),(10,'BookStudy','New','Fairview High School','Cullman County','desc','just','location',10,5,NULL,50,'eval',NULL,NULL,NULL),(11,'BookStudy','New','Hanceville High School','Cullman County','desc','just','location',10,5,NULL,50,'eval',NULL,NULL,NULL),(12,'BookStudy','New','Hanceville High School','Cullman County','desc','just','location',10,5,NULL,50,'eval',NULL,NULL,NULL),(13,'General','New','Fairview High School','Cullman County','Desc','Just','location',10,5,NULL,300,'eval',NULL,NULL,NULL),(14,'General','New','Decatur High School','Decatur City','Desc','Just','location',10,5,NULL,500,'eval',NULL,NULL,NULL),(18,'General','New',NULL,NULL,'sadf','asdf','',0,0,NULL,0,'',NULL,NULL,NULL),(22,'General','New','One','One','','','',0,0,NULL,0,'',NULL,NULL,NULL);
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservationDate_Time`
--

DROP TABLE IF EXISTS `reservationDate_Time`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservationDate_Time` (
  `reservationDateTime_ID` int(11) NOT NULL AUTO_INCREMENT,
  `reservationID` int(11) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `startTime` time DEFAULT NULL,
  `endTime` time DEFAULT NULL,
  `preTime` time DEFAULT NULL,
  PRIMARY KEY (`reservationDateTime_ID`),
  KEY `reservationID` (`reservationID`),
  CONSTRAINT `reservationDate_Time_ibfk_1` FOREIGN KEY (`reservationID`) REFERENCES `reservations` (`reservationID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservationDate_Time`
--

LOCK TABLES `reservationDate_Time` WRITE;
/*!40000 ALTER TABLE `reservationDate_Time` DISABLE KEYS */;
INSERT INTO `reservationDate_Time` VALUES (1,1,'2017-10-28','09:00:00','11:00:00','08:00:00'),(2,1,'2017-11-07','16:00:00','18:00:00','15:00:00'),(3,2,'2017-10-26','09:00:00','11:00:00','08:00:00'),(4,2,'2017-10-30','16:00:00','18:00:00','15:00:00'),(5,3,'2017-10-31','08:00:00','14:30:00','07:30:00'),(6,3,'2017-11-22','08:00:00','14:30:00','07:30:00'),(7,4,'2017-10-31','13:00:00','15:30:00','12:30:00');
/*!40000 ALTER TABLE `reservationDate_Time` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservations` (
  `reservationID` int(11) NOT NULL AUTO_INCREMENT,
  `programName` varchar(50) DEFAULT NULL,
  `programPerson` varchar(75) DEFAULT NULL,
  `programGroup` varchar(75) DEFAULT NULL,
  `programDescription` varchar(256) DEFAULT NULL,
  `room` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `bookedStatus` varchar(10) DEFAULT NULL,
  `sm_board` varchar(3) DEFAULT NULL,
  `ex_cord` varchar(3) DEFAULT NULL,
  `projector` varchar(3) DEFAULT NULL,
  `document_camera` varchar(3) DEFAULT NULL,
  `av_needs` varchar(3) DEFAULT NULL,
  `num_events` int(3) DEFAULT NULL,
  PRIMARY KEY (`reservationID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (1,'In-Service Showing Update','Justin Wynn','Athens State University','This is an example of reserving a spot for the room.','Conference','jtwynn@example.com','(256)841-9951','booked','Yes','Yes','Yes','No','Yes',34),(2,'Another Inservice Example','Justin Wynn','Athens State University','This will be another example description.','Room B','jtwynn@example.com','(256)841-9951','booked','Yes','Yes','No','No','Yes',34),(3,'Some Program','John Smith','Example School','This is a description of the event.','Conference','jsmith@mail.com','(555)555-5555','canceled','No','No','Yes','Yes','Yes',24),(4,'Inservice Test','Justin Wynn','Inservice Team','This even is to test the reservation form.','Room C','jtwynn@example.com','(555)555-5555','Pending','Yes','Yes','No','Yes','Yes',12);
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `school_and_system_report_data`
--

DROP TABLE IF EXISTS `school_and_system_report_data`;
/*!50001 DROP VIEW IF EXISTS `school_and_system_report_data`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `school_and_system_report_data` AS SELECT 
 1 AS `system`,
 1 AS `system_count`,
 1 AS `total`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscribers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscribers`
--

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
INSERT INTO `subscribers` VALUES (3,'jas@company.com');
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
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
  `support_initiative` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`workshop_id`),
  KEY `workshops_requests_request_id_fk` (`request_id`),
  CONSTRAINT `workshops_requests_request_id_fk` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workshops`
--

LOCK TABLES `workshops` WRITE;
/*!40000 ALTER TABLE `workshops` DISABLE KEYS */;
INSERT INTO `workshops` VALUES (1,1,100,'program title testing to see how a longer title will work.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `workshops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'amsti_01'
--

--
-- Final view structure for view `quick_report_data_orig`
--

/*!50001 DROP VIEW IF EXISTS `quick_report_data_orig`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `quick_report_data_orig` AS select `r`.`request_id` AS `request_id`,`w`.`program_nbr` AS `program_nbr`,`w`.`pd_title` AS `pd_title`,`sdt`.`request_start_date` AS `request_start_date`,`sdt`.`request_start_time` AS `request_start_time`,`edt`.`request_end_date` AS `request_end_date`,`edt`.`request_end_time` AS `request_end_time`,`r`.`request_location` AS `request_location`,`r`.`target_participants` AS `target_participants`,`r`.`enrolled_participants` AS `enrolled_participants`,`w`.`actual_participants` AS `actual_participants` from (((`amsti_01`.`requests` `r` join `amsti_01`.`workshops` `w` on((`r`.`request_id` = `w`.`request_id`))) join (select `d`.`request_id` AS `request_id`,`d`.`request_date` AS `request_start_date`,min(`d`.`request_start_time`) AS `request_start_time` from (`amsti_01`.`date_times` `d` join (select `amsti_01`.`date_times`.`request_id` AS `request_id`,min(`amsti_01`.`date_times`.`request_date`) AS `request_start_date` from `amsti_01`.`date_times` group by `amsti_01`.`date_times`.`request_id`) `a` on(((`d`.`request_id` = `a`.`request_id`) and (`d`.`request_date` = `a`.`request_start_date`)))) group by `d`.`request_id`,`d`.`request_date`) `sdt` on((`r`.`request_id` = `sdt`.`request_id`))) join (select `d`.`request_id` AS `request_id`,`d`.`request_date` AS `request_end_date`,max(`d`.`request_end_time`) AS `request_end_time` from (`amsti_01`.`date_times` `d` join (select `amsti_01`.`date_times`.`request_id` AS `request_id`,max(`amsti_01`.`date_times`.`request_date`) AS `request_end_date` from `amsti_01`.`date_times` group by `amsti_01`.`date_times`.`request_id`) `b` on(((`d`.`request_id` = `b`.`request_id`) and (`d`.`request_date` = `b`.`request_end_date`)))) group by `d`.`request_id`,`d`.`request_date`) `edt` on((`r`.`request_id` = `edt`.`request_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `school_and_system_report_data`
--

/*!50001 DROP VIEW IF EXISTS `school_and_system_report_data`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `school_and_system_report_data` AS select `r`.`system` AS `system`,count(`r`.`system`) AS `system_count`,sum(`r`.`total_cost`) AS `total` from (`requests` `r` join `quick_report_data` `q` on((`r`.`request_id` = `q`.`request_id`))) group by `r`.`system` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-10  4:06:13
