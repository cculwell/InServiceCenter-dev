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
  `request_break_Time` int(11) DEFAULT NULL,
  `request_dt_note` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`request_dt_id`),
  KEY `request_dt_requests_request_id_fk` (`request_id`),
  CONSTRAINT `request_dt_requests_request_id_fk` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `date_times`
--

LOCK TABLES `date_times` WRITE;
/*!40000 ALTER TABLE `date_times` DISABLE KEYS */;
INSERT INTO `date_times` VALUES (1,7,'2017-10-02','10:00:00','17:00:00',1,'We had a good lunch.'),(2,7,'2017-10-03','09:00:00','15:00:00',2,'We had a long lunch period.');
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
-- Temporary table structure for view `quick_report_data`
--

DROP TABLE IF EXISTS `quick_report_data`;
/*!50001 DROP VIEW IF EXISTS `quick_report_data`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `quick_report_data` AS SELECT 
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
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
INSERT INTO `requests` VALUES (5,'BookStudy','Start Purchase Order','Fairview','Cullman Count','','Teach them to read','Alabama',10,8,20,100,'',NULL,NULL),(6,'General','Under Review','Fairview','Cullman Count','New request Desc','Teach them to read','Alabama',10,8,20,100,'Eval Method is live',NULL,NULL),(7,'General','New','Fairview','Cullman Count','New request Desc','Teach them to read','Alabama',10,8,20,100,'Eval Method is live',NULL,NULL),(8,'General','Under Review','Fairview','Cullman Count','New request Desc','Teach them to read','Alabama',10,8,20,100,'Eval Method is live',NULL,NULL),(11,'General','New','Fairview','Cullman Count','New request Desc','Teach them to read','Alabama',10,8,20,100,'Eval Method is live',NULL,NULL),(12,'General','New','Fairview','Cullman Count','New request Desc','Teach them to read','Alabama',10,8,20,100,'Eval Method is live',NULL,NULL),(13,'General','New','Fairview','Cullman Count','New request Desc','Teach them to read','Alabama',10,8,20,100,'Eval Method is live',NULL,NULL),(15,'BookStudy','New','Cullman','Cullman City','Needs computer','Not enough pC','alabama',10,9,10,1000,'grades',NULL,NULL),(16,'General','New','Cullman','Cullman City','Needs computer','Not enough pC','alabama',10,9,10,1000,'grades',NULL,NULL),(17,'General','New','Cullman','Cullman City','Needs computer','Not enough pC','alabama',10,9,10,1000,'grades',NULL,NULL),(18,'General','New','Cullman','Cullman City','Needs computer','Not enough pC','alabama',10,9,10,1000,'grades',NULL,NULL),(19,'General','New','Cullman','Cullman City','Needs computer','Not enough pC','alabama',10,9,10,1000,'grades',NULL,NULL),(20,NULL,'New',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workshops`
--

LOCK TABLES `workshops` WRITE;
/*!40000 ALTER TABLE `workshops` DISABLE KEYS */;
INSERT INTO `workshops` VALUES (1,7,1,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `workshops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'amsti_01'
--

--
-- Final view structure for view `quick_report_data`
--

/*!50001 DROP VIEW IF EXISTS `quick_report_data`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `quick_report_data` AS select `r`.`request_id` AS `request_id`,`w`.`program_nbr` AS `program_nbr`,`w`.`pd_title` AS `pd_title`,`sdt`.`request_start_date` AS `request_start_date`,`sdt`.`request_start_time` AS `request_start_time`,`edt`.`request_end_date` AS `request_end_date`,`edt`.`request_end_time` AS `request_end_time`,`r`.`request_location` AS `request_location`,`r`.`target_participants` AS `target_participants`,`r`.`enrolled_participants` AS `enrolled_participants`,`w`.`actual_participants` AS `actual_participants` from (((`amsti_01`.`requests` `r` join `amsti_01`.`workshops` `w` on((`r`.`request_id` = `w`.`request_id`))) join (select `d`.`request_id` AS `request_id`,`d`.`request_date` AS `request_start_date`,min(`d`.`request_start_time`) AS `request_start_time` from (`amsti_01`.`date_times` `d` join (select `amsti_01`.`date_times`.`request_id` AS `request_id`,min(`amsti_01`.`date_times`.`request_date`) AS `request_start_date` from `amsti_01`.`date_times` group by `amsti_01`.`date_times`.`request_id`) `a` on(((`d`.`request_id` = `a`.`request_id`) and (`d`.`request_date` = `a`.`request_start_date`)))) group by `d`.`request_id`,`d`.`request_date`) `sdt` on((`r`.`request_id` = `sdt`.`request_id`))) join (select `d`.`request_id` AS `request_id`,`d`.`request_date` AS `request_end_date`,max(`d`.`request_end_time`) AS `request_end_time` from (`amsti_01`.`date_times` `d` join (select `amsti_01`.`date_times`.`request_id` AS `request_id`,max(`amsti_01`.`date_times`.`request_date`) AS `request_end_date` from `amsti_01`.`date_times` group by `amsti_01`.`date_times`.`request_id`) `b` on(((`d`.`request_id` = `b`.`request_id`) and (`d`.`request_date` = `b`.`request_end_date`)))) group by `d`.`request_id`,`d`.`request_date`) `edt` on((`r`.`request_id` = `edt`.`request_id`))) */;
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

-- Dump completed on 2017-10-18 17:43:55
