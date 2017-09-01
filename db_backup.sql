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
  `book_title` varchar(255) DEFAULT NULL,
  `isbn` varchar(25) DEFAULT NULL,
  `cost_per_book` int(11) DEFAULT NULL,
  `facilitator_name` varchar(255) DEFAULT NULL,
  `facilitator_email` varchar(255) DEFAULT NULL,
  `sti_pd` varchar(1) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`book_id`),
  KEY `books_requests_request_id_fk` (`request_id`),
  CONSTRAINT `books_requests_request_id_fk` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `school` varchar(255) DEFAULT NULL,
  `system` varchar(255) DEFAULT NULL,
  `request_desc` text,
  `request_just_area` text,
  `target_participants` int(11) DEFAULT NULL,
  `enrolled_participants` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `total_hours` int(11) DEFAULT NULL,
  `request_tot_cost` int(11) DEFAULT NULL,
  `format_or_eval` varchar(255) DEFAULT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(15) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `ou_director` varchar(255) DEFAULT NULL,
  `ou_board_approval` varchar(255) DEFAULT NULL,
  `ou_amt_sponsored` int(11) DEFAULT NULL,
  `ou_inservice_order` varchar(255) DEFAULT NULL,
  `ou_reimburse_sys` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblGeneralRequest`
--

DROP TABLE IF EXISTS `tblGeneralRequest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblGeneralRequest` (
  `vcSchool` varchar(255) DEFAULT NULL,
  `vcSystem` varchar(255) DEFAULT NULL,
  `vcRequest` varchar(255) DEFAULT NULL,
  `vcJustification` varchar(255) DEFAULT NULL,
  `dtDate01` date DEFAULT NULL,
  `dtDate02` date DEFAULT NULL,
  `dtTime01` time DEFAULT NULL,
  `dtTime02` time DEFAULT NULL,
  `vcLocation` varchar(255) DEFAULT NULL,
  `iTotalHours` int(11) DEFAULT NULL,
  `vcTargetPartic` varchar(255) DEFAULT NULL,
  `iNumPartic` int(11) DEFAULT NULL,
  `vcEvalMethod` varchar(255) DEFAULT NULL,
  `vcCompany` varchar(255) DEFAULT NULL,
  `vcContactInfo` varchar(255) DEFAULT NULL,
  `fAmount` varchar(255) DEFAULT NULL,
  `vcContact` varchar(255) DEFAULT NULL,
  `vcPhone` varchar(255) DEFAULT NULL,
  `vcEmail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblGeneralRequest`
--

LOCK TABLES `tblGeneralRequest` WRITE;
/*!40000 ALTER TABLE `tblGeneralRequest` DISABLE KEYS */;
INSERT INTO `tblGeneralRequest` VALUES ('1','1','1','1','2017-11-17','2017-11-18','08:00:00','17:00:00','1',1,'1',1,'1','1','1','1','1','1','test@att.com');
/*!40000 ALTER TABLE `tblGeneralRequest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'amsti_01'
--
/*!50003 DROP PROCEDURE IF EXISTS `add_book` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`dbuser`@`localhost` PROCEDURE `add_book`(
  IN p_request_id           INT,
  IN p_book_title           VARCHAR(255),
  IN p_publisher            VARCHAR(225),
  IN p_isbn                 VARCHAR(25) ,
  IN p_cost_per_book        INT         ,
  IN p_facilitator_name     VARCHAR(255),
  IN p_facilitator_email    VARCHAR(255),
  IN p_sti_pd               VARCHAR(255)
)
BEGIN
    INSERT INTO books (
      request_id        ,
      book_title        ,
      publisher         ,
      isbn              ,
      cost_per_book     ,
      facilitator_name  ,
      facilitator_email ,
      sti_pd
    )
    VALUES (
      p_request_id        ,
      p_book_title        ,
      p_publisher         ,
      p_isbn              ,
      p_cost_per_book     ,
      p_facilitator_name  ,
      p_facilitator_email  ,
      p_sti_pd
    );
  END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `add_request` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`dbuser`@`localhost` PROCEDURE `add_request`(
  IN p_school                VARCHAR(255),
  IN p_system                VARCHAR(255),
  IN p_request_desc          TEXT        ,
  IN p_request_just_area     TEXT        ,
  IN p_target_participants   INT         ,
  IN p_enrolled_participants INT         ,
  IN p_location              VARCHAR(255),
  IN p_total_hours           INT         ,
  IN p_request_tot_cost      INT         ,
  IN p_format_or_eval        VARCHAR(255),
  IN p_contact_name          VARCHAR(255),
  IN p_contact_phone         VARCHAR(15) ,
  IN p_contact_email         VARCHAR(255),
  IN p_ou_director           VARCHAR(255),
  IN p_ou_board_approval     VARCHAR(255),
  IN p_ou_amt_sponsored      INT         ,
  IN p_ou_inservice_order    VARCHAR(255),
  IN p_ou_reimburse_sys      VARCHAR(255)
)
BEGIN
    INSERT INTO requests (
        school                ,
        system                ,
        request_desc          ,
        request_just_area     ,
        target_participants   ,
        enrolled_participants ,
        location              ,
        total_hours           ,
        request_tot_cost      ,
        format_or_eval        ,
        contact_name          ,
        contact_phone         ,
        contact_email         ,
        ou_director           ,
        ou_board_approval     ,
        ou_amt_sponsored      ,
        ou_inservice_order    ,
        ou_reimburse_sys
    )
    VALUES(
        p_school                ,
        p_system                ,
        p_request_desc          ,
        p_request_just_area     ,
        p_target_participants   ,
        p_enrolled_participants ,
        p_location              ,
        p_total_hours           ,
        p_request_tot_cost      ,
        p_format_or_eval        ,
        p_contact_name          ,
        p_contact_phone         ,
        p_contact_email         ,
        p_ou_director           ,
        p_ou_board_approval     ,
        p_ou_amt_sponsored      ,
        p_ou_inservice_order    ,
        p_ou_reimburse_sys
    );
  END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_request` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`dbuser`@`localhost` PROCEDURE `delete_request`(IN p_request_id INT)
BEGIN
    delete from books where request_id = p_request_id;
    delete from requests where request_id = p_request_id;
  END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-01  1:16:23
