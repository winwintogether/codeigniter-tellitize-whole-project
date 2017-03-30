-- MySQL dump 10.11
--
-- Host: 50.63.106.154    Database: tellidbase1212
-- ------------------------------------------------------
-- Server version	5.0.92-log

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
-- Table structure for table `admin_login`
--

DROP TABLE IF EXISTS `admin_login`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `admin_login` (
  `id` int(100) NOT NULL auto_increment,
  `admin_username` varchar(200) NOT NULL,
  `admin_password` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `admin_login`
--

LOCK TABLES `admin_login` WRITE;
/*!40000 ALTER TABLE `admin_login` DISABLE KEYS */;
INSERT INTO `admin_login` VALUES (2,'admin','c2a0a225947dff616703b7aa78426a42');
/*!40000 ALTER TABLE `admin_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `badwords_list`
--

DROP TABLE IF EXISTS `badwords_list`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `badwords_list` (
  `id` tinyint(1) NOT NULL,
  `words` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `badwords_list`
--

LOCK TABLES `badwords_list` WRITE;
/*!40000 ALTER TABLE `badwords_list` DISABLE KEYS */;
INSERT INTO `badwords_list` VALUES (1,'fat,,retarded,epilepsy\nseizures\nseizure\nepileptic,epilepsy, seizures, seizure, epileptic,\n');
/*!40000 ALTER TABLE `badwords_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `category` (
  `cid` int(11) NOT NULL auto_increment,
  `cate_name` varchar(200) NOT NULL,
  `cate_description` varchar(400) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY  (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'None','None',1),(2,'Reveal a Crush','Crush',1),(3,'Apologize to Somebody','apologies',1),(4,'Send a Compliment','Send a Compliment',1),(5,'Confessions','Get something off your mind',1),(6,'Say I Love You','I love yous',1),(7,'Expose a Cheater','Tell a friend or family they are being cheated on ',1),(8,'Bluntly Speaking','Tell them how it is',1),(9,'Find Somebody You Met','Met somebody cant remember their name cant stop thinking of them',1),(10,'Send a Thank You','Say thank you to somebody',1),(11,'Make an Announcement','Public Announcements',1),(12,'Celebrity News','Celebrity Gossip and Breaking News',1),(13,'Todays News Topics','Todays Breaking news',1),(14,'Generally Speaking','Things in General',1),(15,'Send Condolences','Send condolences to those who have lost a loved one',1);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discussionplace_userlist`
--

DROP TABLE IF EXISTS `discussionplace_userlist`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `discussionplace_userlist` (
  `id` int(11) NOT NULL auto_increment,
  `placeid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `emailid` varchar(200) NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `discussionplace_userlist`
--

LOCK TABLES `discussionplace_userlist` WRITE;
/*!40000 ALTER TABLE `discussionplace_userlist` DISABLE KEYS */;
INSERT INTO `discussionplace_userlist` VALUES (1,1,3,'Dhanya','dhanya.p@breezegoindia.com',3),(2,2,3,'Dhanya','dhanya.p@breezegoindia.com',3),(5,4,2,'Barry','dicksonbarry39@gmail.com',2),(6,4,4,'Ashish Tripathi','tripathiashish_85_2006@yahoo.co.in',2),(11,5,5,'Doug','Fuelcreed89@yahoo.com',5),(12,5,0,'Art Spicer','doug.goodman@fmr.com',5),(13,1,0,'Dhany','',3),(14,6,12,'nitesh','kirtisharmapce@gmail.com',12),(15,1,0,'dhanya','',3),(16,1,0,'dhany','',3),(18,8,3,'Dhanya P','dhanya.p@breezegoindia.com',3),(21,8,19,'Sreeji S','sreeji@breezegoindia.com',3),(22,9,15,'Cameron Brand','doug.goodman@fmr.com',15),(26,8,23,'Vidya L','vidya.l@breezegoindia.com',3),(27,8,0,'aparna','',3),(28,11,2,'Barry XXXX Dickson','dicksonbarry39@gmail.com',2),(29,10,5,'Tony Gonzalez','fuelcreed89@yahoo.com',5),(34,10,0,'Leigh Raia','',5),(35,10,0,'Makayla London','',5),(38,10,0,'Chelsea Hensley','',5),(39,10,0,'Aaron Hicks','',5);
/*!40000 ALTER TABLE `discussionplace_userlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_list`
--

DROP TABLE IF EXISTS `group_list`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `group_list` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `group_name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `group_list`
--

LOCK TABLES `group_list` WRITE;
/*!40000 ALTER TABLE `group_list` DISABLE KEYS */;
INSERT INTO `group_list` VALUES (1,2,'First Group','Cool First Group','2012-11-02'),(2,3,'Friends','friendship ','2012-11-02'),(3,4,'Hello World Group','This Group is for whole world','2012-11-04'),(4,4,'Check Check','Hello Check Group','2012-11-06'),(5,5,'Viewmyact','Viewmyact Talent Group','2012-11-06'),(6,28,'Colnovation','Hello','2012-11-07'),(7,2,'Brothers ','best friends Group','2012-11-07'),(9,5,'Fidelity Investments Covington','Fidelity Investments Covington Kentucky','2012-11-09'),(12,3,'Best Friends','hi','2012-11-12'),(14,2,'Barry\'s','My Group','2012-11-13'),(15,2,'Barrys','Barrys Group','2012-11-13'),(17,53,'hi','fg','2012-11-14'),(18,5,'John Jonsin','Music Producer','2012-11-15'),(19,5,'Senabi Infotech Ltd','Professional Web Development and Design','2012-11-20'),(20,5,'Goodman Family','Goodman Family','2012-11-21'),(21,68,'Test GRP','test description','2012-11-28');
/*!40000 ALTER TABLE `group_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_userlist`
--

DROP TABLE IF EXISTS `group_userlist`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `group_userlist` (
  `id` int(11) NOT NULL auto_increment,
  `groupid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `emailid` varchar(200) NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `group_userlist`
--

LOCK TABLES `group_userlist` WRITE;
/*!40000 ALTER TABLE `group_userlist` DISABLE KEYS */;
INSERT INTO `group_userlist` VALUES (1,1,2,'Barry','dicksonbarry39@gmail.com',2),(2,2,3,'Dhanya P','dhanya.p@breezegoindia.com',3),(3,3,4,'Ashish','tripathiashish_85_2006@yahoo.co.in',4),(4,3,2,'Barry Dickson','dicksonbarry39@gmail.com',4),(5,1,0,'ashish','',2),(6,2,0,'Dhanya','',3),(8,1,0,'Mr X','',2),(9,1,0,'Mr X','',2),(10,4,4,'Ashish','tripathiashish_85_2006@yahoo.co.in',4),(11,4,2,'Barry Dickson','dicksonbarry39@gmail.com',4),(12,5,5,'Doug','Fuelcreed89@yahoo.com',5),(13,5,0,'Cory Hecht','cory@dumpstercentral.com',5),(15,2,4,'Ashish Tripathi','tripathiashish_85_2006@yahoo.co.in',26),(16,2,0,'dhanya','',3),(18,6,28,'Ashish Tripathi','',28),(19,7,2,'Barry XXXX','dicksonbarry39@gmail.com',2),(20,7,0,'Sid','',2),(21,5,4,'Ashish Tripathi','tripathiashish_85_2006@yahoo.co.in',5),(27,9,5,'Doug Good','Fuelcreed89@yahoo.com',5),(28,2,0,'aparna','',3),(33,12,3,'Dhanya P','dhanya.p@breezegoindia.com',3),(34,12,19,'Sreeji S','sreeji@breezegoindia.com',19),(36,14,2,'Barry XXXX Dickson','dicksonbarry39@gmail.com',2),(37,15,2,'Barry XXXX Dickson','dicksonbarry39@gmail.com',2),(39,9,41,'TelliTize ','',41),(43,7,4,'Ashish Tripathi','tripathiashish_85_2006@yahoo.co.in',4),(44,2,0,'Dhanu','',3),(45,2,19,'Sreeji S','sreeji@breezegoindia.com',3),(47,17,53,'dhan\'s dhanya','tester1@mail.com',53),(48,18,5,'Tony Gonzalez','fuelcreed89@yahoo.com',5),(49,19,5,'Tony Gonzalez','fuelcreed89@yahoo.com',5),(50,19,0,'Abi Sen','abisen99@gmail.com',5),(51,20,5,'T Gonz','fuelcreed89@yahoo.com',5),(52,20,59,'Carrie Goodman','',5),(54,21,68,'Test FN Test LN','testmail.senabi@gmail.com',68),(56,21,0,'SenTest','senabi.test04@gmail.com',68);
/*!40000 ALTER TABLE `group_userlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mail_status`
--

DROP TABLE IF EXISTS `mail_status`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `mail_status` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `emailid` varchar(200) NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `date_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=242 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `mail_status`
--

LOCK TABLES `mail_status` WRITE;
/*!40000 ALTER TABLE `mail_status` DISABLE KEYS */;
INSERT INTO `mail_status` VALUES (1,1,'anishkris@gmail.com','register','2012-11-02 10:36:19'),(2,2,'dicksonbarry39@gmail.com','register','2012-11-02 11:27:22'),(3,3,'dhanya.p@breezegoindia.com','register','2012-11-02 11:59:03'),(4,4,'tripathiashish_85_2006@yahoo.co.in','register','2012-11-02 12:23:26'),(5,3,'dhanya.p@breezegoindia.com','','2012-11-02 12:36:15'),(6,0,'',' ','2012-11-02 14:06:26'),(7,3,'dhanya.p@breezegoindia.com','','2012-11-02 14:19:29'),(8,3,'dhanya.p@breezegoindia.com','','2012-11-02 14:22:38'),(9,5,'Fuelcreed89@yahoo.com','register','2012-11-02 15:49:45'),(10,2,'tripathiashish_85_2006@yahoo.co.in','','2012-11-02 19:51:43'),(11,0,'',' ','2012-11-02 22:27:55'),(12,6,'fuelcreed89@yahoo.com','','2012-11-02 23:58:07'),(13,5,'cory@dumpstercentral.com','','2012-11-03 02:18:35'),(14,5,'','','2012-11-03 02:22:48'),(15,5,'','','2012-11-03 02:24:53'),(16,5,'','','2012-11-03 02:28:09'),(17,5,'nicholas.chalfin@gmail.com','','2012-11-03 02:31:43'),(18,5,'info@tellitize.com','','2012-11-03 03:22:00'),(19,5,'','','2012-11-03 03:33:17'),(20,5,'cagoodman77@gmail.com','','2012-11-03 04:32:37'),(21,5,'','','2012-11-03 04:37:09'),(22,5,'','','2012-11-03 04:42:54'),(23,0,'',' ','2012-11-04 01:19:59'),(24,4,'tripathiashish_85_2006@yahoo.co.in','','2012-11-04 19:04:58'),(25,4,'','','2012-11-04 19:17:01'),(26,4,'discksonbarry39@gmail.com',' ','2012-11-04 19:23:11'),(27,4,'ashish.tripathi@colnovation.org',' ','2012-11-04 19:23:53'),(28,4,'ashish.tripathi@colnovation.org',' ','2012-11-04 19:24:15'),(29,4,'dicksonbarry39@gmail.com','','2012-11-04 19:31:14'),(30,4,'dicksonbarry39@gmail.com','','2012-11-04 19:31:20'),(31,5,'fuelcreed89@yahoo.com','','2012-11-05 03:39:47'),(32,3,'','','2012-11-05 05:53:12'),(33,3,'','','2012-11-05 05:54:07'),(34,8,'','register','2012-11-05 05:55:08'),(35,3,'','','2012-11-05 05:58:14'),(36,3,'','','2012-11-05 05:58:40'),(37,3,'dhanya.p@breezegoindia.com','','2012-11-05 05:58:56'),(38,3,'','','2012-11-05 06:00:45'),(39,3,'dhanya.p@breezegoindia.com','','2012-11-05 06:54:18'),(40,3,'dhanya.p@breezegoindia.com','','2012-11-05 07:01:09'),(41,3,'dhanya.p@breezegoindia.com','','2012-11-05 08:24:38'),(42,2,'nitesh.bhardwaj@colnovation.org','','2012-11-05 09:37:47'),(43,11,'sdfsf2354356@yahoo.com','register','2012-11-05 10:00:54'),(44,12,'kirtisharmapce@gmail.com','register','2012-11-05 10:02:34'),(45,13,'kirtisharmapce@yahoo.com','register','2012-11-05 10:32:48'),(46,12,' kirtisharmapce@yahoo.com',' ','2012-11-05 10:34:56'),(47,13,'kirtisharmapce@yahoo.com','','2012-11-05 10:42:59'),(48,3,' dhanya.p@breezegoindia.com',' ','2012-11-05 10:46:14'),(49,12,'kirtisharmapce@yahoo.com','','2012-11-05 11:11:25'),(50,2,'ashishtripathi85@hotmail.com','','2012-11-05 12:42:13'),(51,5,'doug.goodman@fmr.com',' ','2012-11-05 14:21:48'),(52,5,'art.spicer@fmr.com','','2012-11-05 14:30:36'),(53,5,'art.spicer@fmr.com',' ','2012-11-05 14:32:09'),(54,5,'doug.goodman@fmr.com','','2012-11-05 14:51:48'),(55,5,'nicholas.chalfin@gmail.com',' ','2012-11-05 15:13:26'),(56,5,'scelam@yahoo.com','','2012-11-05 15:21:32'),(57,5,'cagoodman77@gmail.com','','2012-11-05 15:44:08'),(58,15,'doug.goodman@fmr.com','register','2012-11-05 16:09:40'),(59,15,'nicholas.chalfin@gmail.com','','2012-11-05 16:45:42'),(60,5,'matt.bernhardt@onbinvestments.com','','2012-11-05 17:08:55'),(61,16,'skaylee12@yahoo.com','register','2012-11-05 19:51:19'),(62,19,'sreeji@breezegoindia.com','register','2012-11-06 06:23:36'),(63,2,'ashishtripathi85@hotmail.com','','2012-11-06 06:40:09'),(64,20,'','register','2012-11-06 08:24:47'),(65,21,'trainee@breezegoindia.com','register','2012-11-06 09:06:06'),(66,22,'trainee@breezegoindia.com','register','2012-11-06 09:08:35'),(67,23,'vidya.l@breezegoindia.com','register','2012-11-06 09:10:25'),(68,3,'dhanya.p@breezegoindia.com','','2012-11-06 09:21:55'),(69,5,'fuelcreed89@yahoo.com',' ','2012-11-06 13:13:47'),(70,5,'cory@dumpstercentral.com',' ','2012-11-06 15:29:33'),(71,5,'cory@dumpstercentral.com','','2012-11-06 15:31:42'),(72,5,'doug.goodman@fmr.com','','2012-11-06 15:32:04'),(73,5,'doug.goodman@fmr.com',' ','2012-11-06 15:58:56'),(74,5,'doug.goodman@fmr.com',' ','2012-11-06 16:05:23'),(75,5,'doug.goodman@fmr.com','','2012-11-06 18:43:13'),(76,5,'fuelcreed89@yahoo.com','','2012-11-06 21:47:53'),(77,5,'doug.goodman@fmr.com',' ','2012-11-06 21:49:53'),(78,5,'doug.goodman@fmr.com','','2012-11-06 21:52:09'),(79,25,'skaylee12@yahoo.com','','2012-11-06 23:29:48'),(80,3,'dhanya.p@breezegoindia.com',' ','2012-11-07 04:17:00'),(81,3,'dhanya.p@breezegoindia.com',' ','2012-11-07 05:07:36'),(82,3,'dhanya.p@breezegoindia.com','','2012-11-07 05:39:28'),(83,26,'tripathiashish_85_2006@yahoo.co.in','','2012-11-07 05:45:20'),(84,27,'','register','2012-11-07 13:55:42'),(85,0,'',' ','2012-11-08 00:37:02'),(86,29,'','register','2012-11-08 01:48:04'),(87,19,'dhanya.p@breezegoindia.com','','2012-11-08 07:50:09'),(88,2,'ashish.tripathi@colnovation.org','','2012-11-08 08:27:24'),(89,3,'sreeji@breezegoindia.com','','2012-11-08 09:27:46'),(90,3,'sreeji@breezegoindia.com','','2012-11-08 09:28:11'),(91,5,'fuelcreed89@yahoo.com',' ','2012-11-08 15:44:38'),(92,5,'cagoodman77@gmail.com',' ','2012-11-08 15:44:57'),(93,5,'susieq7491@yahoo.com',' ','2012-11-08 15:45:11'),(94,15,'doug.goodman@fmr.com','reset-password','2012-11-08 16:13:48'),(95,15,'fuelcreed89@yahoo.com','','2012-11-08 16:24:45'),(96,15,'doug.goodman@fmr.com',' ','2012-11-08 16:31:27'),(97,15,'james.elam@me.com','','2012-11-08 17:21:42'),(98,5,'scelam@yahoo.com','','2012-11-08 19:56:44'),(99,14,'fuelcreed89@yahoo.com','','2012-11-09 00:08:41'),(100,5,'susieq7491@yahoo.com',' ','2012-11-09 03:39:02'),(101,0,'',' ','2012-11-09 05:36:12'),(102,31,'anish@brizgo.net','register','2012-11-09 07:14:33'),(103,32,'','register','2012-11-09 07:19:44'),(104,3,'dhanya.p@breezegoindia.com','','2012-11-09 11:15:00'),(105,5,'scelam@yahoo.com','','2012-11-09 14:28:10'),(106,5,'doug.goodman@fmr.com','','2012-11-09 14:59:07'),(107,5,'doug.goodman@fmr.com','','2012-11-09 15:01:07'),(108,5,'Fuelcreed89@yahoo.com','','2012-11-09 15:01:39'),(109,5,'Fuelcreed89@yahoo.com','','2012-11-09 15:03:16'),(110,5,'tripathiashish_85_2006@yahoo.co.in','','2012-11-09 15:06:46'),(111,5,'scelam@yahoo.com','','2012-11-09 15:12:23'),(112,5,'brian@alphaland.org','','2012-11-09 16:47:47'),(113,5,'amy.brookbank@yahoo.com','','2012-11-09 16:51:15'),(114,5,'elliseh1011@yahoo.com','','2012-11-09 19:51:36'),(115,5,'jeff@wkrq.com ','','2012-11-09 20:28:44'),(116,15,'fuelcreed89@yahoo.com','','2012-11-09 21:18:31'),(117,5,'cory@dumpstercentral.com','','2012-11-09 21:45:19'),(118,36,'','register','2012-11-10 09:49:37'),(119,0,'',' ','2012-11-10 09:50:22'),(120,0,'',' ','2012-11-11 04:34:35'),(121,0,'',' ','2012-11-11 05:05:05'),(122,0,'',' ','2012-11-11 12:42:25'),(123,0,'',' ','2012-11-11 12:45:09'),(124,0,'',' ','2012-11-11 12:47:09'),(125,37,'','register','2012-11-11 13:47:12'),(126,0,'',' ','2012-11-11 18:44:46'),(127,0,'',' ','2012-11-11 22:21:46'),(128,0,'',' ','2012-11-12 00:44:55'),(129,0,'',' ','2012-11-12 00:50:14'),(130,3,'dhanya.p@breezegoindia.com','','2012-11-12 06:48:50'),(131,3,'dhanya.p@breezegoindia.com','','2012-11-12 06:53:22'),(132,3,'dhanya.p@breezegoindia.com','','2012-11-12 06:59:28'),(133,0,'',' ','2012-11-12 16:33:08'),(134,3,'vidya.l@breezegoindia.com','','2012-11-13 09:10:48'),(135,5,'Fuelcreed89@yahoo.com','','2012-11-13 17:26:10'),(136,2,'dicksonbarry39@gmail.com','','2012-11-13 20:43:50'),(137,2,'dicksonbarry39@gmail.com','','2012-11-13 20:44:10'),(138,0,'',' ','2012-11-13 21:46:48'),(139,5,'dougcgood@facebook.com',' ','2012-11-14 01:46:20'),(140,5,'dougcgood@facebook.com',' ','2012-11-14 01:47:06'),(141,5,'fuelcreed89@yahoo.com',' ','2012-11-14 01:49:23'),(142,5,'dougcgood@facebook.com',' ','2012-11-14 01:59:30'),(143,14,'jenna.watkins.775@facebook.com','','2012-11-14 03:06:54'),(144,14,'dougcgood@facebook.com','','2012-11-14 03:16:36'),(145,41,'clos.mr@gmail.com','','2012-11-14 03:24:10'),(146,41,'ethan_sexy23@hotmail.com','','2012-11-14 03:26:37'),(147,41,'sabrina123@myemail.com','','2012-11-14 03:29:06'),(148,42,'test@th.com','register','2012-11-14 05:22:32'),(149,43,'tesst@th.com','register','2012-11-14 05:24:05'),(150,44,'fddfd@fg.fg','register','2012-11-14 06:25:44'),(151,45,'dhanysa.p@breezegoindia.com','register','2012-11-14 06:29:17'),(152,46,'sa.p@breezegoindia.com','register','2012-11-14 06:30:31'),(153,47,'dhadnya@gmail.com','register','2012-11-14 06:33:18'),(154,48,'dhadnya@gmail.com','register','2012-11-14 06:33:50'),(155,49,'dhadnya@gmail.com','register','2012-11-14 06:34:46'),(156,50,'dhadnya@gmail.com','register','2012-11-14 06:35:39'),(157,51,'dhanya1p@breezegoindia.com','register','2012-11-14 08:47:49'),(158,53,'tester1@mail.com','register','2012-11-14 11:34:21'),(159,5,'amyjo.schalk@facebook.com','','2012-11-14 19:28:50'),(160,0,'',' ','2012-11-15 02:58:56'),(161,3,'dhanya.p@breezegoindia.com',' ','2012-11-15 06:29:23'),(162,3,'dhanya.p@breezegoindia.com',' ','2012-11-15 07:03:32'),(163,3,'dhanya.p@breezegoindia.com',' ','2012-11-15 07:06:17'),(164,3,'dhanya.p@breezegoindia.com',' ','2012-11-15 07:10:48'),(165,3,'dhanya.p@breezegoindia.com',' ','2012-11-15 07:12:14'),(166,3,'dhanya.p@breezegoindia.com',' ','2012-11-15 07:12:50'),(167,3,'dhanya.p@breezegoindia.com','','2012-11-15 07:18:21'),(168,3,'dhanya.p@breezegoindia.com','','2012-11-15 07:19:06'),(169,3,'dhanya.p@breezegoindia.com','','2012-11-15 07:20:06'),(170,2,'dicksonbarry39@gmail.com',' ','2012-11-15 12:12:56'),(171,2,'dicksonbarry39@gmail.com',' ','2012-11-15 12:12:56'),(172,5,'doug.goodman@fmr.com',' ','2012-11-15 15:39:36'),(173,5,'fuelcreed89@yahoo.com',' ','2012-11-15 15:50:59'),(174,5,'fuelcreed89@yahoo.com',' ','2012-11-15 15:54:47'),(175,5,'fuelcreed89@yahoo.com','','2012-11-15 16:18:17'),(176,5,'fuelcreed89@yahoo.com','','2012-11-15 20:23:12'),(177,0,'',' ','2012-11-16 03:36:32'),(178,15,'bencgoodman1@yahoo.com','','2012-11-16 18:20:07'),(179,5,'pnallette@gmail.com','','2012-11-16 18:32:51'),(180,5,'fuelcreed89@yahoo.com',' ','2012-11-16 18:34:06'),(181,5,'pnallette@gmail.com',' ','2012-11-16 18:51:21'),(182,5,'bencgoodman2@yahoo.com','','2012-11-17 03:02:46'),(183,5,'aisa.daniels@rocketmail.com','','2012-11-20 01:47:21'),(184,5,'tayla101@gmail.com','','2012-11-20 01:53:43'),(185,5,'melissa.picquet@yahoo.com','','2012-11-20 02:20:07'),(186,5,'doug.goodman@fmr.com',' ','2012-11-20 15:51:22'),(187,5,'doug.goodman@fmr.com',' ','2012-11-20 15:51:51'),(188,5,'fuelcreed89@yahoo.com',' ','2012-11-20 15:52:53'),(189,57,'abisen99@gmail.com','register','2012-11-20 22:44:50'),(190,5,'abisen99@gmail.com','','2012-11-20 23:12:02'),(191,5,'abisen99@gmail.com',' ','2012-11-20 23:14:29'),(192,5,'fuelcreed89@yahoo.com',' ','2012-11-20 23:15:12'),(193,5,'pnallette@gmail.com','','2012-11-21 18:42:06'),(194,5,'8596409345@vtext.com',' ','2012-11-21 19:05:53'),(195,5,'8594096327@mms.mycricket.com',' ','2012-11-21 19:12:45'),(196,5,'8594096327@mms.mycricket.com',' ','2012-11-21 19:13:48'),(197,5,'8599924355@messaging@sprintpcs.com','','2012-11-21 19:20:32'),(198,5,'8595479641@gocbw.com','','2012-11-21 19:27:25'),(199,15,'doug.goodman@fmr.com','reset-password','2012-11-21 19:31:07'),(200,58,'rhys1993@ymail.com','register','2012-11-22 01:41:43'),(201,59,'cagoodman77@gmail.com','register','2012-11-22 03:18:33'),(202,60,'','register','2012-11-22 03:41:48'),(203,61,'raia.leigh@yahoo.com','register','2012-11-22 03:42:58'),(204,5,'raia.leigh@yahoo.com','','2012-11-22 03:54:20'),(205,5,'raia.leigh@yahoo.com','','2012-11-22 03:55:44'),(206,5,'5136527330@tmomail.net','','2012-11-22 04:12:14'),(207,5,'8597509177@gocbw.com','','2012-11-22 04:23:21'),(208,5,'8596287443@gocbw.com','','2012-11-22 04:25:46'),(209,5,'2623492201@vtext.com','','2012-11-22 04:35:31'),(210,5,'8594867138@messaging.sprintpcs.com','','2012-11-22 04:37:49'),(211,5,'8598660911@tmomail.net','','2012-11-22 04:40:43'),(212,5,'8597507364@gocbw.com','','2012-11-22 04:43:44'),(213,60,'','reset-password','2012-11-22 05:19:25'),(214,0,'',' ','2012-11-23 11:41:58'),(215,5,'raia.leigh@yahoo.com',' ','2012-11-23 13:07:16'),(216,5,'doug.goodman@fmr.com',' ','2012-11-23 13:07:27'),(217,5,'raia.leigh@yahoo.com',' ','2012-11-23 13:08:04'),(218,5,'doug.goodman@fmr.com',' ','2012-11-23 13:08:23'),(219,5,'doug.goodman@fmr.com',' ','2012-11-23 13:08:23'),(220,5,'fuelcreed89@yahoo.com',' ','2012-11-23 13:14:49'),(221,5,'fuelcreed89@yahoo.com','','2012-11-23 13:31:32'),(222,62,'heather2016@gmail.com','register','2012-11-24 00:38:08'),(223,62,'HEATHER2016@GMAIL.COM','reset-password','2012-11-24 00:45:26'),(224,63,'imjustme110@hotmail.com','register','2012-11-24 02:21:33'),(225,65,'uthopson7@gmail.com','register','2012-11-24 05:29:30'),(226,0,'suzys1952@aol.com','reset-password','2012-11-25 01:41:26'),(227,0,'suzys1952@aol.com','reset-password','2012-11-25 01:41:40'),(228,66,'suzys1952@aol.com','register','2012-11-25 01:45:01'),(229,67,'doggystyle@gmail.com','register','2012-11-26 00:52:07'),(230,68,'testmail.senabi@gmail.com','register','2012-11-27 10:08:55'),(231,69,'senabi.test01@gmail.com','register','2012-11-27 13:44:13'),(232,70,'lk66711@hotmail.com','register','2012-11-27 20:29:23'),(233,70,'blondroni@yahoo.com','','2012-11-27 20:38:31'),(234,5,'fuelcreed89@yahoo.com','','2012-11-27 22:23:20'),(235,68,'senabi.test04@gmail.com','','2012-11-28 08:22:31'),(236,5,'fuelcreed89@yahoo.com','','2012-11-28 15:45:48'),(237,71,'info@tellitize.com','register','2012-11-29 19:57:58'),(238,71,'fuelcreed89@yahoo.com','','2012-11-29 20:00:41'),(239,71,'fuelcreed89@yahoo.com',' ','2012-11-29 20:01:29'),(240,5,'fuelcreed89@yahoo.com','','2012-11-30 01:26:55'),(241,73,'kritigupta02@gmail.com','register','2012-11-30 06:20:22');
/*!40000 ALTER TABLE `mail_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL auto_increment,
  `to_user` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  `read_status` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,68,69,'hello','2012-11-27',0),(2,68,69,'hii','2012-11-27',0);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification_for_group_or_pod`
--

DROP TABLE IF EXISTS `notification_for_group_or_pod`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `notification_for_group_or_pod` (
  `id` int(11) NOT NULL auto_increment,
  `notification_id` int(11) NOT NULL,
  `userlist_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `notification_for_group_or_pod`
--

LOCK TABLES `notification_for_group_or_pod` WRITE;
/*!40000 ALTER TABLE `notification_for_group_or_pod` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification_for_group_or_pod` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL auto_increment,
  `notify_id` int(11) NOT NULL COMMENT ' if notification_on is :reply->notify_id=id in post_replies,  like_post->notify_id=id in post_likes, like_reply->notify_id=id in reply_likes,add-to-pod/group :group userlist list id /placeusrlist id',
  `notification_on` enum('reply','like_post','like_reply','group','pod','add-to-group','add-to-pod','join-pod','join-group') NOT NULL,
  `userid` int(11) NOT NULL,
  `date` date NOT NULL,
  `read_status` tinyint(4) NOT NULL default '0' COMMENT '0->unread,1->read',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,4,'add-to-pod',0,'2012-11-03',1),(2,4,'add-to-group',2,'2012-11-04',1),(3,5,'reply',4,'2012-11-04',1),(4,6,'reply',4,'2012-11-04',1),(5,6,'add-to-pod',4,'2012-11-04',1),(6,7,'add-to-pod',0,'2012-11-04',1),(7,8,'add-to-pod',4,'2012-11-04',1),(8,8,'like_post',6,'2012-11-04',1),(9,8,'like_post',6,'2012-11-04',1),(10,10,'reply',9,'2012-11-04',1),(11,11,'like_post',9,'2012-11-05',1),(12,5,'like_reply',10,'2012-11-05',1),(13,12,'reply',9,'2012-11-05',1),(14,13,'reply',9,'2012-11-05',1),(15,5,'add-to-group',0,'2012-11-05',1),(16,14,'reply',5,'2012-11-05',1),(17,7,'like_reply',12,'2012-11-05',1),(18,12,'like_post',5,'2012-11-05',1),(19,12,'like_post',5,'2012-11-05',1),(20,8,'like_reply',5,'2012-11-05',1),(21,13,'like_post',5,'2012-11-05',1),(22,15,'reply',5,'2012-11-05',1),(23,13,'like_post',5,'2012-11-05',1),(24,13,'like_post',5,'2012-11-05',1),(25,16,'reply',12,'2012-11-05',1),(26,17,'like_post',5,'2012-11-05',1),(27,18,'like_post',5,'2012-11-05',1),(28,9,'',5,'2012-11-05',1),(29,17,'reply',5,'2012-11-05',1),(30,6,'add-to-group',0,'2012-11-05',1),(31,7,'add-to-group',19,'2012-11-05',1),(32,8,'add-to-group',0,'2012-11-06',1),(33,9,'add-to-group',0,'2012-11-06',1),(34,11,'add-to-group',2,'2012-11-06',1),(35,10,'add-to-pod',0,'2012-11-06',1),(36,13,'add-to-group',0,'2012-11-06',1),(37,14,'add-to-group',0,'2012-11-06',1),(38,12,'add-to-pod',0,'2012-11-06',1),(39,27,'like_post',25,'2012-11-06',1),(40,28,'like_post',25,'2012-11-06',1),(41,21,'reply',5,'2012-11-06',1),(42,15,'add-to-group',4,'2012-11-06',1),(43,13,'add-to-pod',0,'2012-11-06',1),(44,11,'like_reply',5,'2012-11-06',1),(45,17,'add-to-group',0,'2012-11-07',1),(46,19,'add-to-pod',19,'2012-11-08',1),(47,20,'add-to-pod',0,'2012-11-08',1),(48,21,'add-to-pod',19,'2012-11-08',1),(49,20,'add-to-group',0,'2012-11-08',1),(50,33,'like_post',5,'2012-11-08',1),(51,35,'like_post',5,'2012-11-08',1),(52,36,'like_post',15,'2012-11-08',1),(53,37,'like_post',5,'2012-11-08',1),(54,39,'like_post',15,'2012-11-08',1),(55,41,'like_post',5,'2012-11-08',1),(56,42,'like_post',14,'2012-11-08',1),(57,14,'like_reply',14,'2012-11-08',1),(58,43,'like_post',15,'2012-11-08',1),(59,44,'like_post',15,'2012-11-08',1),(60,45,'like_post',15,'2012-11-08',1),(61,46,'like_post',5,'2012-11-08',1),(62,48,'like_post',15,'2012-11-09',1),(63,21,'add-to-group',4,'2012-11-09',1),(64,23,'add-to-group',0,'2012-11-09',1),(65,24,'add-to-group',0,'2012-11-09',1),(66,25,'add-to-group',0,'2012-11-09',1),(67,26,'add-to-group',0,'2012-11-09',1),(68,15,'like_reply',14,'2012-11-09',1),(69,50,'like_post',5,'2012-11-09',1),(70,52,'like_post',5,'2012-11-09',1),(71,28,'add-to-group',0,'2012-11-11',1),(72,30,'add-to-group',19,'2012-11-12',1),(73,24,'',19,'2012-11-12',1),(74,23,'reply',3,'2012-11-12',1),(75,32,'',3,'2012-11-12',1),(76,34,'join-group',3,'2012-11-12',1),(77,25,'join-pod',19,'2012-11-12',1),(78,26,'add-to-pod',23,'2012-11-13',1),(79,27,'add-to-pod',0,'2012-11-13',1),(80,39,'join-group',5,'2012-11-13',1),(81,40,'add-to-group',0,'2012-11-13',1),(82,41,'add-to-group',0,'2012-11-13',1),(83,42,'join-group',2,'2012-11-13',1),(84,43,'join-group',2,'2012-11-13',1),(85,44,'add-to-group',0,'2012-11-13',1),(86,45,'add-to-group',19,'2012-11-13',1),(87,46,'join-group',2,'2012-11-14',1),(88,29,'join-pod',2,'2012-11-14',1),(89,56,'like_post',41,'2012-11-14',1),(90,58,'like_post',5,'2012-11-15',1),(91,24,'reply',5,'2012-11-15',1),(92,25,'reply',2,'2012-11-15',1),(93,17,'like_reply',54,'2012-11-16',1),(94,62,'like_post',15,'2012-11-16',1),(95,69,'like_post',5,'2012-11-20',1),(96,50,'add-to-group',0,'2012-11-20',1),(97,70,'like_post',5,'2012-11-20',1),(98,26,'reply',5,'2012-11-20',1),(99,18,'like_reply',57,'2012-11-20',1),(100,72,'like_post',5,'2012-11-20',1),(101,27,'reply',5,'2012-11-21',1),(102,75,'like_post',5,'2012-11-21',1),(103,76,'like_post',5,'2012-11-21',1),(104,30,'add-to-pod',0,'2012-11-21',1),(105,31,'add-to-pod',0,'2012-11-21',1),(106,32,'add-to-pod',0,'2012-11-21',1),(107,77,'like_post',15,'2012-11-21',1),(108,28,'reply',15,'2012-11-21',1),(109,78,'like_post',5,'2012-11-21',1),(110,79,'like_post',5,'2012-11-21',1),(111,19,'like_reply',15,'2012-11-21',1),(112,80,'like_post',5,'2012-11-21',1),(113,33,'add-to-pod',0,'2012-11-21',1),(114,34,'add-to-pod',0,'2012-11-21',1),(115,35,'add-to-pod',0,'2012-11-21',1),(116,36,'add-to-pod',0,'2012-11-21',1),(117,37,'add-to-pod',0,'2012-11-21',1),(118,52,'add-to-group',0,'2012-11-21',1),(120,53,'add-to-group',59,'2012-11-21',1),(121,38,'add-to-pod',0,'2012-11-21',1),(122,39,'add-to-pod',0,'2012-11-21',1),(123,82,'like_post',5,'2012-11-22',1),(124,83,'like_post',62,'2012-11-23',1),(125,31,'reply',62,'2012-11-23',1),(126,33,'reply',62,'2012-11-23',1),(127,84,'like_post',62,'2012-11-24',1),(128,35,'reply',5,'2012-11-27',1),(129,36,'reply',5,'2012-11-27',1),(130,85,'like_post',70,'2012-11-27',1),(131,86,'like_post',70,'2012-11-27',1),(132,55,'add-to-group',0,'2012-11-28',1),(133,56,'add-to-group',0,'2012-11-28',1),(134,88,'like_post',5,'2012-11-29',1),(135,88,'like_post',5,'2012-11-29',1);
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `place_of_discussion`
--

DROP TABLE IF EXISTS `place_of_discussion`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `place_of_discussion` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `place` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `place_of_discussion`
--

LOCK TABLES `place_of_discussion` WRITE;
/*!40000 ALTER TABLE `place_of_discussion` DISABLE KEYS */;
INSERT INTO `place_of_discussion` VALUES (4,2,'Barclays','A good bank																		','2012-11-04'),(5,5,'Fidelity Investments','Fidelity Investments','2012-11-06'),(9,15,'Fidelity Investments Covington','Fidelity Investments Group Covington Kentucky','2012-11-08'),(10,5,'Scott High School','Taylor Mill, KY																																				','2012-11-21');
/*!40000 ALTER TABLE `place_of_discussion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_details`
--

DROP TABLE IF EXISTS `post_details`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `post_details` (
  `postid` int(11) NOT NULL,
  `post_about` enum('person','place','other','group','pod') NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `place` varchar(200) NOT NULL,
  `other_description` varchar(200) NOT NULL,
  `group_post_about` int(11) NOT NULL default '0' COMMENT 'userid',
  PRIMARY KEY  (`postid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `post_details`
--

LOCK TABLES `post_details` WRITE;
/*!40000 ALTER TABLE `post_details` DISABLE KEYS */;
INSERT INTO `post_details` VALUES (1,'other','','','','','Tellitize',0),(4,'person','Wel','-Come','tripathiashish_85_2006@yahoo.co.in','','',0),(5,'other','','','','','Tellitize Welcomes You',0),(6,'other','','','','','Thanks for the great Dumpser Rental Service',0),(7,'person','Kenny','Rouse','','','',0),(8,'person','Samantha','Monger','','','',0),(9,'person','Greg','Tillett','','','',0),(10,'person','Nick','Chalfin','nicholas.chalfin@gmail.com','','',0),(11,'other','','','','','Tellitize',0),(12,'other','','','','','Need name of girl I met at Dicmans',0),(14,'person','Haley','Sicking','','','',0),(15,'other','','','','','hulk hogan sex video scandal',0),(17,'place','','','','World','',0),(18,'group','Barry Dickson','','dicksonbarry39@gmail.com','','',2),(19,'group','Barry Dickson','','dicksonbarry39@gmail.com','','',2),(20,'other','','','','','Tellitize Website',0),(21,'other','','','','','Hi',0),(22,'other','','','','','hi',0),(23,'other','','','','','cv',0),(24,'other','','','','','xx',0),(25,'other','','','','','xxdfd',0),(26,'other','','','','','hjh',0),(27,'other','','','','','new',0),(28,'other','','','','','new',0),(29,'other','','','','','FB',0),(34,'other','','','','','nit',0),(37,'other','','','','','hi',0),(38,'other','','','','','Hi',0),(39,'other','','','','','hi',0),(40,'other','','','','','h',0),(42,'other','','','','','Hello People',0),(43,'person','Art','Spicecake','art.spicer@fmr.com','','',0),(45,'person','Scott','Elererman','','','',0),(46,'person','Scott','Elerman','scelam@yahoo.com','','',0),(47,'person','Carrie','Johnson','cagoodman77@gmail.com','','',0),(48,'other','','','','','Nicks Poopie Yard',0),(49,'person','Matt','Berns','matt.bernhardt@onbinvestments.com','','',0),(50,'other','','','','','How To Become Famous',0),(51,'other','','','','','Long Island Classifieds',0),(52,'place','','','','Long Island Classifieds','',0),(53,'other','','','','','Please fix Facebook Share Link',0),(54,'person','Kristen','Stewart','','','',0),(55,'person','Kristen','Stewart','','','',0),(58,'other','','','','','can\'t',0),(59,'other','','','','','I\'m',0),(60,'other','','','','','ok',0),(61,'other','','','','','A  A',0),(62,'other','','','','','Going to Work',0),(63,'group','Cory Hecht','','cory@dumpstercentral.com','','',0),(65,'person','Lyn','Vijayendran','','','',0),(66,'other','','','','','Aguilera On Jimmy Fallon',0),(67,'other','','','','','Taylor Swift We Are Never Getting Back Together About Jake Gyllenhaal',0),(68,'other','','','','','Taylor Swift Dear John Song About John Mayer',0),(69,'other','','','','','Presidential Election 2012',0),(70,'other','','','','','NBC',0),(71,'person','Jenny','Brand','','','',0),(72,'other','','','','','Mark Cuban For President',0),(73,'pod','Art Spicer','','doug.goodman@fmr.com','','',15),(74,'other','','','','','iphones are amazing',0),(75,'person','Jesse','Magdaleno','','','',0),(76,'person','SAMMY','SWEETHEART','','','',0),(77,'person','Justin','Bieber','fuelcreed89@yahoo.com','','',0),(78,'place','','','','Fidelity Investments','',0),(79,'person','Nikki','Minaj','','','',0),(80,'person','Kaylee','Smith','skaylee12@yahoo.com','','',0),(81,'other','','','','','test',0),(85,'group','Ashish Tripathi','','tripathiashish_85_2006@yahoo.co.in','','',4),(91,'group','','','ashish.tripathi@colnovation.org','','',0),(93,'person','Christina ','Aguilera','','','',0),(94,'other','','','','','Christi',0),(95,'group','Sreeji S','','sreeji@breezegoindia.com','','',19),(96,'group','Sreeji S','','sreeji@breezegoindia.com','','',19),(101,'other','','','','','Cheryl Burke Bachelorette',0),(102,'person','Ashton','Kutcher','fuelcreed89@yahoo.com','','',0),(103,'person','Ronald','Poland','','','',0),(104,'person','Ron','Poland','','','',0),(105,'person','James','Elam','james.elam@me.com','','',0),(106,'person','Scott','Elerman','scelam@yahoo.com','','',0),(108,'person','Cara','Stoody','','','',0),(109,'person','Cara','Stoody','','','',0),(121,'pod','Art Spicer','','doug.goodman@fmr.com','','',15),(122,'pod','Art Spicer','','doug.goodman@fmr.com','','',15),(125,'group','Ashish Tripathi','','tripathiashish_85_2006@yahoo.co.in','','',4),(126,'group','','','scelam@yahoo.com','','',0),(127,'person','Brian','Markus','brian@alphaland.org','','',0),(128,'person','Amy','Brookbank','amy.brookbank@yahoo.com','','',0),(129,'person','Beth','Middleton','elliseh1011@yahoo.com','','',0),(130,'other','','','','','Jeff and Jenn Show Q102',0),(131,'person','Archie','Goodwin','fuelcreed89@yahoo.com','','',0),(132,'place','','','','Dumpster Central Pod and Dumpster Rentals','',0),(136,'other','','','','','Twitter',0),(137,'other','','','','','Twitter',0),(138,'other','','','','','Twitter character limiting when sharing posts',0),(139,'other','','','','','Twitter 140 character limit break ',0),(142,'other','','','','','James Elam:Sorry buddy for being better looking than you all of these years.  You are right behind me in the lo... http://www.tellitize.com/James-Elam/105James Elam:Sorry buddy for being better lookin',0),(146,'other','','','','','Ron Poland:Love and miss you Uncle Ronnie.  You were loved by so many people.  Will never forget you.... http://www.tellitize.com/Ron-Poland/104Ron Poland:Love and miss you Uncle Ronnie.  You were lov',0),(147,'other','','','','','Ron Poland:Love and miss you Uncle Ronnie.  You were loved by so many people.  Will never forget you.... http://www.tellitize.com/Ron-Poland/104Ron Poland:Love and miss you Uncle Ronnie.  You were lov',0),(148,'other','','','','','It appears that the new twitter share link can be used to break the  140 character limit. Basically in Firefox you can do this:   1) In the URL bar enter http://twitter.com/share?url=Some over 140  ch',0),(149,'pod','Vidya L','','vidya.l@breezegoindia.com','','',23),(174,'person','Jenna','Watkins','jenna.watkins.775@facebook.com','','',0),(175,'person','Timothy','Akins','dougcgood@facebook.com','','',0),(176,'person','Michael','Rudolph','clos.mr@gmail.com','','',0),(177,'person','Ethan','Gay','ethan_sexy23@hotmail.com','','',0),(178,'person','Sabrina','Nichols','sabrina123@myemail.com','','',0),(179,'other','','','','','hi',0),(180,'other','','','','','cvv',0),(181,'other','','','','','t',0),(182,'other','','','','','t',0),(183,'other','','','','','test',0),(184,'other','','','','','t',0),(185,'other','','','','','test',0),(186,'other','','','','','hi',0),(187,'other','','','','','hi',0),(188,'other','','','','','fg',0),(189,'person','Amy','Schalk','amyjo.schalk@facebook.com','','',0),(190,'other','','','','','test',0),(191,'person','Dhanya','p','dhanya.p@breezegoindia.com','','',0),(192,'group','Dhanya P','','dhanya.p@breezegoindia.com','','',3),(193,'other','','','','','hi',0),(194,'other','','','','','test',0),(195,'other','','','','','Hi',0),(196,'group','Tony Gonzalez','','fuelcreed89@yahoo.com','','',5),(197,'person','David','Fritz','fuelcreed89@yahoo.com','','',0),(198,'person','Thomas','Spiller','','','',0),(199,'other','','','','','Kardashians',0),(200,'other','','','','','QuadD',0),(201,'person','Patti','Mallette','pnallette@gmail.com','','',0),(202,'person','Ben','Goodman','bencgoodman2@yahoo.com','','',0),(203,'person','Carrie','Smith','','','',0),(204,'person','Aisa','Daniels','aisa.daniels@rocketmail.com','','',0),(205,'person','Taylor','Brokaw','tayla101@gmail.com','','',0),(206,'person','Melissa','Picquet','melissa.picquet@yahoo.com','','',0),(207,'other','','','','','Say Anything',0),(208,'other','','','','','hi',0),(209,'group','Abi Sen','','abisen99@gmail.com','','',57),(210,'other','','','','','Facebook is Fake',0),(211,'person','Kyler','Jenkins','','','',0),(212,'person','Pattie','Mallette','pnallette@gmail.com','','',0),(213,'person','Makayla','London','8599924355@messaging@sprintpcs.com','','',0),(214,'person','Leigh','Raia','8595479641@gocbw.com','','',0),(215,'other','','','','','Club Baja',0),(216,'pod','Hailey Williams','','','','',6),(217,'group','Carrie Goodman','','','','',6),(218,'pod','','','raia.leigh@yahoo.com','','',61),(219,'pod','','','raia.leigh@yahoo.com','','',61),(220,'pod','Leigh Raia','','','','',6),(221,'pod','Chelsea Hensley','','','','',6),(222,'pod','','','5136527330@tmomail.net','','',0),(223,'pod','Aaron Hicks','','','','',6),(224,'person','Aaron','Hicks','','','',0),(225,'person','Ben','Loveless','8597509177@gocbw.com','','',0),(226,'person','Brianna','Daniels','8596287443@gocbw.com','','',0),(227,'person','Cardell','Bonslater','2623492201@vtext.com','','',0),(228,'person','Jeremey ','Sloan','8594867138@messaging.sprintpcs.com','','',0),(229,'person','Lexey','Brackens','8598660911@tmomail.net','','',0),(230,'person','Tabatha','Toll','8597507364@gocbw.com','','',0),(231,'person','Sandra','Henderson','fuelcreed89@yahoo.com','','',0),(232,'person','Katie','Haddad','','','',0),(233,'person','Nick','Smiley','','','',0),(234,'person','veronica','marchiondo','blondroni@yahoo.com','','',0),(235,'person','veronica','marchiondo','','','',0),(236,'person','Kyle','Davison','fuelcreed89@yahoo.com','','',0),(237,'person','jim','croman','','','',0),(238,'person','Test FN','Test LN','','','',0),(239,'group','SenTest','','senabi.test04@gmail.com','','',0),(240,'other','','','','','My Job',0),(241,'person','Lindsay','Lohan','fuelcreed89@yahoo.com','','',0),(242,'person','Hector','Camacho','fuelcreed89@yahoo.com','','',0),(243,'other','','','','','Am I Mean',0);
/*!40000 ALTER TABLE `post_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_likes`
--

DROP TABLE IF EXISTS `post_likes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `post_likes` (
  `id` int(11) NOT NULL auto_increment,
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `like_status` tinyint(4) NOT NULL COMMENT '0->dislike,1->like',
  `date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `post_likes`
--

LOCK TABLES `post_likes` WRITE;
/*!40000 ALTER TABLE `post_likes` DISABLE KEYS */;
INSERT INTO `post_likes` VALUES (1,1,3,1,'2012-11-02'),(2,5,6,1,'2012-11-02'),(3,6,5,1,'2012-11-02'),(4,8,5,1,'2012-11-02'),(5,10,5,1,'2012-11-02'),(6,15,5,0,'2012-11-02'),(7,16,4,0,'2012-11-04'),(8,5,3,1,'2012-11-04'),(9,28,3,1,'2012-11-04'),(10,30,3,1,'2012-11-05'),(11,29,3,1,'2012-11-05'),(12,11,13,1,'2012-11-05'),(13,11,3,1,'2012-11-05'),(14,7,5,1,'2012-11-05'),(15,46,5,1,'2012-11-05'),(16,47,5,1,'2012-11-05'),(17,47,15,1,'2012-11-05'),(18,46,15,0,'2012-11-05'),(19,48,15,1,'2012-11-05'),(20,0,0,0,'2012-11-05'),(21,65,5,0,'2012-11-06'),(22,67,5,1,'2012-11-06'),(23,72,5,1,'2012-11-06'),(24,75,5,1,'2012-11-06'),(25,78,5,1,'2012-11-06'),(26,79,25,1,'2012-11-06'),(27,80,16,1,'2012-11-06'),(28,79,16,1,'2012-11-06'),(29,83,3,1,'2012-11-06'),(30,86,3,1,'2012-11-06'),(31,98,3,1,'2012-11-08'),(32,101,5,1,'2012-11-08'),(33,101,15,1,'2012-11-08'),(34,102,15,0,'2012-11-08'),(35,8,15,1,'2012-11-08'),(36,105,5,1,'2012-11-08'),(37,106,14,1,'2012-11-08'),(38,107,14,1,'2012-11-08'),(39,105,14,0,'2012-11-08'),(40,109,14,1,'2012-11-08'),(41,72,17,1,'2012-11-08'),(42,109,17,1,'2012-11-08'),(43,105,17,0,'2012-11-08'),(44,104,17,1,'2012-11-08'),(45,102,17,1,'2012-11-08'),(46,101,17,1,'2012-11-08'),(47,110,31,1,'2012-11-09'),(48,104,5,1,'2012-11-09'),(49,130,5,1,'2012-11-09'),(50,130,15,1,'2012-11-09'),(51,131,15,0,'2012-11-09'),(52,77,15,1,'2012-11-09'),(53,132,5,1,'2012-11-09'),(54,174,14,1,'2012-11-13'),(55,176,41,1,'2012-11-13'),(56,176,5,1,'2012-11-14'),(57,197,5,0,'2012-11-15'),(58,197,54,1,'2012-11-15'),(59,199,15,1,'2012-11-16'),(60,201,5,1,'2012-11-16'),(61,77,5,1,'2012-11-16'),(62,199,5,0,'2012-11-16'),(63,202,5,1,'2012-11-16'),(64,205,5,1,'2012-11-19'),(65,204,5,0,'2012-11-19'),(66,189,5,1,'2012-11-19'),(67,207,5,1,'2012-11-20'),(68,208,57,1,'2012-11-20'),(69,132,57,1,'2012-11-20'),(70,209,57,1,'2012-11-20'),(71,209,5,1,'2012-11-20'),(72,210,17,1,'2012-11-20'),(73,211,5,0,'2012-11-21'),(74,214,5,1,'2012-11-21'),(75,213,15,1,'2012-11-21'),(76,212,15,1,'2012-11-21'),(77,215,17,1,'2012-11-21'),(78,213,17,1,'2012-11-21'),(79,214,17,1,'2012-11-21'),(80,212,17,1,'2012-11-21'),(81,224,5,1,'2012-11-21'),(82,230,17,1,'2012-11-22'),(83,233,5,1,'2012-11-23'),(84,233,17,0,'2012-11-24'),(85,235,5,0,'2012-11-27'),(86,234,5,0,'2012-11-27'),(87,242,5,1,'2012-11-29'),(88,230,73,0,'2012-11-29');
/*!40000 ALTER TABLE `post_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_replies`
--

DROP TABLE IF EXISTS `post_replies`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `post_replies` (
  `id` int(11) NOT NULL auto_increment,
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `post_replies`
--

LOCK TABLES `post_replies` WRITE;
/*!40000 ALTER TABLE `post_replies` DISABLE KEYS */;
INSERT INTO `post_replies` VALUES (1,1,3,'wishes..','2012-11-02'),(2,6,5,'yeah ive used dumpster central before.  they do provide A1 service when it comes to construction site cleanup dumpsters and pod rentals','2012-11-02'),(4,19,4,'Yes..Hello','2012-11-04'),(5,17,7,'My Commet from Twitter Account!!','2012-11-04'),(6,16,7,'I cannot see the comment on this one!! www.google.com','2012-11-04'),(7,17,4,'Second Comment','2012-11-04'),(8,20,5,'http://www.tellitize.com/Campbell-County-High-School','2012-11-04'),(10,29,10,'tweet','2012-11-04'),(14,11,12,'Let me know  :)','2012-11-05'),(16,35,5,'hello Nitesh!  how\'s it going','2012-11-05'),(17,47,15,'Is not','2012-11-05'),(19,56,2,'can\'t','2012-11-05'),(20,65,5,'misdemeanor?','2012-11-06'),(22,109,14,'Cara is amazingly hot o licious','2012-11-08'),(24,197,54,'You are doing great!  Just dont let it happen again:)','2012-11-15'),(25,195,34,'Hi','2012-11-15'),(26,209,57,'thank you very much','2012-11-20'),(27,213,15,'Makayla is a dork:)','2012-11-21'),(28,215,17,'its me..meet me at the same part of the club tonight!','2012-11-21'),(29,0,0,'','2012-11-22'),(30,0,0,'','2012-11-22'),(31,233,5,'aww.  I hope he is your best friend someday too','2012-11-23'),(32,233,62,'thanks for agreeing and are you being serious?','2012-11-23'),(33,233,5,'of course im serious!','2012-11-23'),(34,233,62,'thanks for being so nice and thoughtful','2012-11-23');
/*!40000 ALTER TABLE `post_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `public_post`
--

DROP TABLE IF EXISTS `public_post`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `public_post` (
  `postid` int(11) NOT NULL auto_increment,
  `cid` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `placeid` int(11) NOT NULL default '0',
  `from` varchar(200) NOT NULL,
  `comment` text NOT NULL,
  `post_date` date NOT NULL,
  `location` varchar(200) NOT NULL,
  `userid` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL default '0' COMMENT 'report_abused:1',
  PRIMARY KEY  (`postid`)
) ENGINE=InnoDB AUTO_INCREMENT=244 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `public_post`
--

LOCK TABLES `public_post` WRITE;
/*!40000 ALTER TABLE `public_post` DISABLE KEYS */;
INSERT INTO `public_post` VALUES (5,1,0,0,'6','Welcome to Tellitize!','2012-11-02',' Louisville, KY\r\n, UNITED STATES (US)\r\n',6,0),(6,4,0,0,'0','www.dumpstercentral.com','2012-11-02',' Louisville, KY\r\n, UNITED STATES (US)\r\n',5,0),(7,4,0,0,'0','Kenny is a super nice guy.  Always seems to be happy.  Joy to be around','2012-11-02',' Louisville, KY\r\n, UNITED STATES (US)\r\n',5,0),(8,4,0,0,'0','Samantha is such a sweetheart.  She looks flippin hot in that orange outfit she is wearing on Facebook!','2012-11-02',' Louisville, KY\r\n, UNITED STATES (US)\r\n',5,0),(9,8,0,0,'0','Noticed that Greg and I were no longer Facebook friends.  Upon looking at his friend list, I noticed that he Defriended every guy.  He has nothing but female Facebook friends.  lol  Bet that makes his wife feel good.','2012-11-02',' Louisville, KY\r\n, UNITED STATES (US)\r\n',5,0),(10,4,0,0,'5','Love going out with Nick!  we have a blast!','2012-11-02',' Louisville, KY\r\n, UNITED STATES (US)\r\n',5,0),(11,1,0,0,'0','Whats up Tellitize?','2012-11-02',' Louisville, KY\r\n, UNITED STATES (US)\r\n',5,0),(12,2,0,0,'0','Met a girl Friday Nov 2, 2012 at Dicmans in Ft Wright KY.  My name is Dan.  She was wearing a black top with the frilly stuff dangling off of it.  Small tat on ankle that said Love.  If this is you or you know her please message me here on Tellitize by commenting on this post','2012-11-02',' Louisville, KY\r\n, UNITED STATES (US)\r\n',5,0),(13,6,0,0,'5','Thanks for dinner tonight babe!','2012-11-02',' Louisville, KY\r\n, UNITED STATES (US)\r\n',5,0),(14,4,0,0,'0','Not sure how I know this girl, but she looks so pretty.  Looks like the biggest sweetheart in the world.  Thanks for being my Facebook friend..lol','2012-11-02',' Louisville, KY\r\n, UNITED STATES (US)\r\n',5,0),(15,7,0,0,'0','Hulk caught cheating in a sex video.  This was why he was married to Linda Hogan.','2012-11-02',' Louisville, KY\r\n, UNITED STATES (US)\r\n',5,0),(43,4,0,0,'0','My favorite supervisor!','2012-11-05',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(46,8,0,0,'0','Scott E cannot manage a fantasy football team to save his life','2012-11-05',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(47,7,0,0,'0','Carrie Johnson from Los Angeles is a cheating lying b','2012-11-05',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(48,3,0,0,'15','Sorry Nick, my dog pooped in your yard','2012-11-05',' Durham, NC\r\n, UNITED STATES (US)\r\n',15,0),(49,4,0,0,'0','Matt Berns is a very a cool person super happy and super nice.','2012-11-05',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(50,11,0,0,'5','Learn how to become famous and use ViewMyAct to get gigs in the entertainment industry www.viewmyact.com','2012-11-05',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(51,11,0,0,'0','View post and interact on www.yeahbuddy.com the new video classifieds website long island classified section as well','2012-11-05',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(55,11,0,0,'0','I cant wait to be a mom, but like, no. I can wait she told Us Weekly. I think that it might be something that you are born with or not born with. That was one of my favorite things about the story. It was one aspect of [Bella] that I was really excited to play','2012-11-05',' Louisville, KY\r\n, UNITED STATES (US)\r\n',5,0),(62,8,0,0,'5','i don\'t wanna go to work today:)','2012-11-06',' Louisville, KY\r\n, UNITED STATES (US)\r\n',5,0),(63,1,5,0,'5','Cory, let me know when you get online','2012-11-06',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(64,1,5,0,'0','Hey, let me know when you get online too','2012-11-06',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(65,1,0,0,'0','Lyn Vijayendran, 36, of California, wiped away a tear as the clerk announced jurors found her guilty of a misdemeanor for not reporting possible child abuse by a teacher last year as principal at O.B. Whaley Elementary School in San Jose.','2012-11-06',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(67,1,0,0,'0','Taylor Swift Red song We are never getting back together about Jake Gyllenhaal','2012-11-06',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(68,1,0,0,'5','Who is taylor swifts song Dear John about','2012-11-06',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(69,13,0,0,'5','go Mitt Romney.  hopefully we get a good fair election and we can make great progress the next 4 years','2012-11-06',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(70,8,0,0,'0','You can add your place of employment here and anonymously speak your mind about your co-workers?  wow...game on!!','2012-11-06',' Durham, NC\r\n, UNITED STATES (US)\r\n',15,0),(71,4,0,0,'15','Thanks for the white castle last night hunnie:)','2012-11-06',' Durham, NC\r\n, UNITED STATES (US)\r\n',15,0),(72,4,0,0,'5','Mark Cuban for president!  I did not know who Mark Cuban was until I seen him spatting with Chip Bayless.  Cuban tore him a new rear end.  Cuban is a super witty person who I now admire greatly.  I wish I could be half as cool and smart as him','2012-11-06',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(73,4,0,5,'0','Art is cool','2012-11-06',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(74,4,0,0,'0','iphones are amazing. if you are looking to get a new smartphone, you will not regret buying the iphone.  amazing technology!','2012-11-06',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(75,4,0,0,'0','J magdaleno is a great boxer and will be huge household name soon for years to come','2012-11-06',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(76,7,0,0,'0','Hey Sammy Sweetheart, Ronnie cheated on you','2012-11-06',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(77,4,0,0,'5','I think Justin Bieber is scrappy.  If you mess with him you may get the shit kicked out of you.  Papz leave him alone.  That stuff gets dangerous.  Look back at the Princess Diana incident','2012-11-06',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(78,4,0,0,'0','Fidelity Investments is hands down the best place to invest your money.  Privately owned, superior customer service, and by far the most stable and secure.','2012-11-06',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(79,4,0,0,'0','Nikki Minaj is not fake. She loves her fans and we have seen this girl grow up from absolutely nothing','2012-11-06',' Louisville, KY\r\n, UNITED STATES (US)\r\n',25,0),(80,4,0,0,'0','Kaylee looks great in her senior photos.  She is available for modeling shoots  ','2012-11-06',' Louisville, KY\r\n, UNITED STATES (US)\r\n',25,0),(85,3,2,0,'0','Apologize to somebody','2012-11-06',' (Unknown City?)\r\n, (Unknown Country?) (XX)\r\n',26,0),(101,12,0,0,'0','I think Burke as Bachorlette would be a disaster.  She does not have the public appeal that would grab the viewers.  No viewers equal no ratings equal end of the Bachelor shows altogether.  IMHO','2012-11-08',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(102,4,0,0,'15','How is Two and a Half Men not doing well with Ashton?  Everything this guy gets involved with turns to gold!  Twitter, Punk\'d, etc!','2012-11-08',' Durham, NC\r\n, UNITED STATES (US)\r\n',15,0),(104,15,0,0,'15','Love and miss you Uncle Ronnie.  You were loved by so many people.  Will never forget you.','2012-11-08',' Durham, NC\r\n, UNITED STATES (US)\r\n',15,0),(105,4,0,0,'0','Sorry buddy for being better looking than you all of these years.  You are right behind me in the looks department though...got you a babe for a fiance.  But still a tad behind me:)','2012-11-08',' Durham, NC\r\n, UNITED STATES (US)\r\n',15,0),(106,8,0,0,'0','This guy has no business sense whatsoever.  Doesn\'t know a good investment when it\'s right in front of his face.','2012-11-08',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(109,4,0,0,'0','Workin on my Stoody Booty squats lunges beast mode at VICTORY MMA  BRAZILIAN JIU JITSU MUAY THAI','2012-11-08',' Louisville, KY\r\n, UNITED STATES (US)\r\n',14,0),(126,4,8,0,'0','I love my daddy','2012-11-09',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(127,3,0,0,'0','Sorry for not making your wedding Brian.  I think you know who this is.   I will never forgive myself for this, I hope you do.','2012-11-09',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(128,4,0,0,'0','Amy, how the heck do you still look like you are 20 yrs old?  You look great girl!','2012-11-09',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(129,4,0,0,'0','I think Beth Middleton is super sweet, a very hard worker, and somebody who carries herself with an abundance of class.  Will quickly climb the corporate ranks within her company.','2012-11-09',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(130,4,0,0,'0','Listening to Jeff on Q102 from Jeff and Jenn show.  This guy\'s voice is captivating.  I think it\'s the best radio or TV voice I have ever heard.  He is very witty as well.  This guy needs to move up to bigger and better things.','2012-11-09',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(131,14,0,0,'15','Archie Goodwin is a 18 year old 6 foot 5 inch 195 lb SG. He is currently projected as pick 10 in round 1 of the 2013 NBA Draft. Scrappy and excellent shooter as well as ball handler.  My pick to emerge as star of 2012 KY team.  Any thoughts?','2012-11-09',' Durham, NC\r\n, UNITED STATES (US)\r\n',15,0),(132,14,0,0,'0','Dumpster rental at it\'s best!  Quick, reliable, customer service orientated dumpster and pod rental company Dumpster Central nationwide service call 877-573-8233 to speak to our friendly staff or visit us at www.dumpstercentral.com for your waste management needs','2012-11-09',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(170,4,0,5,'5','Nice guy','2012-11-13',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(174,4,0,0,'0','smoking hot lil aussie','2012-11-13',' Louisville, KY\r\n, UNITED STATES (US)\r\n',14,0),(175,8,0,0,'0','Timothy really needs to grow up.  Acts like he is still 12 yrs old','2012-11-13',' Louisville, KY\r\n, UNITED STATES (US)\r\n',14,0),(177,4,0,0,'0','Ethan Gay can sing.  Seems pretty talented and should never give up on his dream','2012-11-13',' Louisville, KY\r\n, UNITED STATES (US)\r\n',41,0),(178,2,0,0,'0','Don\'t know Sabrina that well but have heard some things about her.   Will keep them on the DL for now:)','2012-11-13',' Louisville, KY\r\n, UNITED STATES (US)\r\n',41,0),(189,4,0,0,'0','Amy is one of the sweetest people I know.  I have known her for years and she has always been so loving and caring.  Very beautiful girl as well','2012-11-14',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(196,6,18,0,'0','whats up guys','2012-11-15',' Durham, NC\r\n, UNITED STATES (US)\r\n',5,0),(197,5,0,0,'0','I quit smoking on April 10, 2012. As of Nov 10th, 2012, (7months) I had not taken one puff of a cigarette.  I cannot say that now. I\'m so disappointed in myself.  Only took two puffs of a cigarette and threw it down. But still, I feel like I\'m starting over.','2012-11-15','BOSTON,MASSACHUSETTS,UNITED STATES',5,0),(198,4,0,0,'0','I think I\'m cool','2012-11-15','CINCINNATI,OHIO,UNITED STATES',5,0),(199,8,0,0,'15','Can\'t the Kardashians be off TV already?  Sick of hearing about them..ughhh.  It was a great fun run but bye bye','2012-11-16','BOSTON,MASSACHUSETTS,UNITED STATES',15,0),(200,8,0,0,'0','QuadD you are going down this week.  6-5 record','2012-11-16','BOSTON,MASSACHUSETTS,UNITED STATES',15,0),(204,2,0,0,'0','Aisa is a hottie.  Wanna get wit her.  If she down she so preety','2012-11-19','CINCINNATI,OHIO,UNITED STATES',5,0),(205,3,0,0,'0','Sorry Taylor.  Hope You forgive me for being mean.  I\'m sure you know who this is.  ','2012-11-19','CINCINNATI,OHIO,UNITED STATES',5,0),(206,4,0,0,'0','You are such a sweetie Melissa','2012-11-19','CINCINNATI,OHIO,UNITED STATES',5,0),(207,8,0,0,'0','Yeah whats up Tellitize...I can say whatever I want here.  Nice bit of relief from Fakebook!  Fakebook, where you can only say what everybody else wants to hear.  Tellitize, where you can say whatever the heck you want and not be judged','2012-11-20','BOSTON,MASSACHUSETTS,UNITED STATES',5,0),(209,4,19,0,'5','Abi is a super nice person','2012-11-20',' Louisville, KY\r\n, UNITED STATES (US)\r\n',5,0),(210,8,0,0,'0','Screw Fakebook.  Some times people want to say what is on their mind without being judged by all the lying people on Facebook who act like their lives are so hunky gory happy','2012-11-20','CINCINNATI,OHIO,UNITED STATES',5,0),(211,7,0,0,'0','Kyler Jenkins is the biggest cheating lying dog you will ever come across.  Do not trust him.  We dated for 1 year and he slept with my best friend, tried to get with my sister but she said no, and is now pursuing my co-worker.  Don\'t trust him girls.  Oh, and Kyler, I\'m emailing this to your mom too.  She thinks you are an angel.','2012-11-21','BOSTON,MASSACHUSETTS,UNITED STATES',5,0),(212,4,0,0,'0','pattie mallette is so pretty!  seen the photos of her as justin\'s date.  either she is really short or justin is getting really tall. love both of them!  she is a great mom and he is very loving always kissing on his little sister and little kids. ','2012-11-21','BOSTON,MASSACHUSETTS,UNITED STATES',5,0),(213,8,0,0,'0','Sometimes I swear you are nuts! But you are still one of my favorites. I love how crazy and silly you are. I have so much fun with you all the time. Never change, you are so beautiful and so much fun to be with!','2012-11-21','CINCINNATI,OHIO,UNITED STATES',5,0),(214,8,0,0,'0','One of the prettiest and talented girls in Northern Kentucky. Amazing singer, dancer, and pretty enough to model. Definite potential to be famous one day! Also one of the sweetest girls you will ever met.','2012-11-21','CINCINNATI,OHIO,UNITED STATES',5,0),(215,9,0,0,'15','If you are the girl in red that was at Club Baja last night, reply to this post.  I lost your number','2012-11-21','BOSTON,MASSACHUSETTS,UNITED STATES',15,0),(217,4,20,0,'5','I\'m not going tomorrow','2012-11-21',' Louisville, KY\r\n, UNITED STATES (US)\r\n',5,0),(220,2,0,10,'0','You single yet Leigh?','2012-11-21',' Louisville, KY\r\n, UNITED STATES (US)\r\n',5,0),(221,4,0,10,'0','Chelsea makes me smile on my worst of days :)','2012-11-21',' Louisville, KY\r\n, UNITED STATES (US)\r\n',5,0),(223,8,0,10,'0','Aaron you loudmouth chill sometimes ha. You rock dude ','2012-11-21',' Louisville, KY\r\n, UNITED STATES (US)\r\n',5,0),(224,14,0,0,'0','Aaron you loudmouth chill sometimes ha. You rock dude ','2012-11-21','CINCINNATI,OHIO,UNITED STATES',5,0),(225,4,0,0,'0','Ben is always willing to help anyone out with anything and is one of the funniest and easiest person to talk to.','2012-11-21','CINCINNATI,OHIO,UNITED STATES',5,0),(226,4,0,0,'0','Brianna always looks extremely pretty when she dresses for church on Wednesdays. :)','2012-11-21','CINCINNATI,OHIO,UNITED STATES',5,0),(227,8,0,0,'0','Cardell has come a long way since his days on Nancy Grace. Britney must be a good influence.','2012-11-21','CINCINNATI,OHIO,UNITED STATES',5,0),(228,8,0,0,'0','Jeremey is always the life of the party!! Keeps everyone entertained.','2012-11-21','CINCINNATI,OHIO,UNITED STATES',5,0),(229,4,0,0,'0','Lexey is someone who doesn\'t know how to be mean. Don\'t think I\'ve ever even seen her mad.','2012-11-21','CINCINNATI,OHIO,UNITED STATES',5,0),(230,4,0,0,'0','I can\'t wait for Tabatha to have her baby. She\'s already matured so much, can\'t wait to see how nice she will be when she is a mom.','2012-11-21','CINCINNATI,OHIO,UNITED STATES',5,0),(231,7,0,0,'0','I cannot believe you had the nerve to do this to me Sandra.  Everybody in your family will know you slept with my best friend.  I\'m emailing this post anonymously to all of them. Sandra Henderson slept with Derek Walton.','2012-11-23','BOSTON,MASSACHUSETTS,UNITED STATES',5,0),(232,2,0,0,'0','something about Katie that makes me, well, you know  http://www.viewmyact.com/xenakat','2012-11-23','BOSTON,MASSACHUSETTS,UNITED STATES',5,0),(233,2,0,0,'0','My crush is on google+ his name is +NickSmiley but he is in a relationship and that makes me sad i wish he could be my best friend','2012-11-23','OZARK,ALABAMA,UNITED STATES',62,0),(236,4,0,0,'5','Kyle is a trooper, thanks for all your help at work bud!','2012-11-27','BOSTON,MASSACHUSETTS,UNITED STATES',5,0),(240,8,0,0,'0','I HATE my job...please help me get out of here somebody','2012-11-28','BOSTON,MASSACHUSETTS,UNITED STATES',5,0),(241,12,0,0,'0','Lindsay Lohan just can\'t seem to keep herself out of trouble','2012-11-29','BOSTON,MASSACHUSETTS,UNITED STATES',71,0),(242,15,0,0,'5','Hector Camacho was a magnificent boxer RIP','2012-11-29','CINCINNATI,OHIO,UNITED STATES',5,0),(243,5,0,0,'0','I think mean things sometimes.  What is wrong with me','2012-11-30','CINCINNATI,OHIO,UNITED STATES',5,0);
/*!40000 ALTER TABLE `public_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reply_likes`
--

DROP TABLE IF EXISTS `reply_likes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `reply_likes` (
  `id` int(11) NOT NULL auto_increment,
  `reply_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `like_status` tinyint(4) NOT NULL COMMENT '0->dislike,1->like',
  `date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `reply_likes`
--

LOCK TABLES `reply_likes` WRITE;
/*!40000 ALTER TABLE `reply_likes` DISABLE KEYS */;
INSERT INTO `reply_likes` VALUES (1,1,3,1,'2012-11-02'),(2,2,5,1,'2012-11-02'),(3,3,4,1,'2012-11-04'),(4,11,3,1,'2012-11-05'),(5,10,3,1,'2012-11-05'),(6,14,12,1,'2012-11-05'),(7,14,13,1,'2012-11-05'),(8,8,3,1,'2012-11-05'),(9,15,3,1,'2012-11-05'),(10,0,0,0,'2012-11-05'),(11,16,12,1,'2012-11-06'),(12,16,5,1,'2012-11-08'),(13,21,14,1,'2012-11-08'),(14,22,17,1,'2012-11-08'),(15,22,5,1,'2012-11-09'),(16,24,54,1,'2012-11-15'),(17,24,3,1,'2012-11-16'),(18,26,5,1,'2012-11-20'),(19,27,17,0,'2012-11-21'),(20,36,68,0,'2012-11-27');
/*!40000 ALTER TABLE `reply_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_abused_list`
--

DROP TABLE IF EXISTS `report_abused_list`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `report_abused_list` (
  `id` int(11) NOT NULL auto_increment,
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL COMMENT '0->pending  1->abused',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `report_abused_list`
--

LOCK TABLES `report_abused_list` WRITE;
/*!40000 ALTER TABLE `report_abused_list` DISABLE KEYS */;
INSERT INTO `report_abused_list` VALUES (1,32,3,'2012-11-05',1),(2,29,3,'2012-11-05',1),(3,36,13,'2012-11-05',1),(4,0,0,'2012-11-05',1),(5,61,5,'2012-11-06',1),(6,62,5,'2012-11-09',1),(7,132,3,'2012-11-12',1),(17,135,3,'2012-11-12',1),(18,132,0,'2012-11-13',1),(19,132,0,'2012-11-13',1),(20,80,5,'2012-11-13',1),(21,73,5,'2012-11-13',1),(22,171,2,'2012-11-13',1),(23,131,57,'2012-11-20',1),(24,0,0,'2012-11-20',1),(25,214,0,'2012-11-21',1),(26,0,0,'2012-11-22',1),(27,0,0,'2012-11-22',1),(28,232,0,'2012-11-26',1),(29,48,0,'2012-11-27',1),(30,127,0,'2012-11-27',1),(31,205,0,'2012-11-27',1),(32,234,0,'2012-11-27',1),(33,234,0,'2012-11-27',1),(34,234,0,'2012-11-27',1),(35,234,0,'2012-11-27',1),(36,234,0,'2012-11-27',1),(37,234,0,'2012-11-27',1),(38,234,0,'2012-11-27',1),(39,234,0,'2012-11-27',1),(40,234,0,'2012-11-27',1),(41,234,0,'2012-11-27',1),(42,226,5,'2012-11-29',1),(43,231,5,'2012-11-30',1);
/*!40000 ALTER TABLE `report_abused_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `users` (
  `userid` int(11) NOT NULL auto_increment,
  `email` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `age` int(2) NOT NULL,
  `location` varchar(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `scars` varchar(100) NOT NULL,
  `tattoos` varchar(500) NOT NULL,
  `highschool` varchar(100) NOT NULL,
  `college` varchar(100) NOT NULL,
  `relationshp_status` varchar(10) NOT NULL,
  `about_me` text NOT NULL,
  `profile_img` varchar(200) NOT NULL,
  `search_tags` varchar(1000) NOT NULL,
  `reg_date` date NOT NULL,
  `reg_status` int(2) NOT NULL default '0' COMMENT '0->register user   1->fbuser  2->twitter user',
  `status` tinyint(4) NOT NULL default '1' COMMENT '1-active ; 0-deactive user',
  `confirm_code` varchar(500) NOT NULL,
  `email_status` enum('0','1','2') NOT NULL default '0' COMMENT '0-pending,1-verified,2-failed',
  PRIMARY KEY  (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'anishkris@gmail.com','anishkris','098f6bcd4621d373cade4e832627b4f6','Krishnan','Krishnan',0,'','','','','','','','','','','','','','2012-11-02',0,1,'ca59c0bc1b3901ac3ddd49bad27b4b59','0'),(2,'dicksonbarry39@gmail.com','Barry','e10adc3949ba59abbe56e057f20f883e','Barry XXXX','Dickson',0,'','','','','','','','','','','','','','2012-11-02',0,1,'0','1'),(3,'dhanya.p@breezegoindia.com','dhanya','a350bd5e7ea4d3080f4c680f8b95cf0d','Dhanya','P',26,'','','Kerala','','dhanu','','','','','single','','','','2012-11-02',0,1,'0','1'),(4,'tripathiashish_85_2006@yahoo.co.in','ashish85','e10adc3949ba59abbe56e057f20f883e','Ashish','Tripathi',27,'','','','','','','','','','single','','1352056543.jpg','','2012-11-02',0,1,'a2599eb36faec2dfe2261fabf6d115ed','0'),(5,'fuelcreed89@yahoo.com','walls89','e98e0c49de2303c1623a8952fa07706c','T','Gonz',0,'','','','41017','','','','','','','','1351881243929.JPG','','2012-11-02',0,1,'0','1'),(6,'','613866793','','TelliTize','',0,'','','','','','','','','','','','','','2012-11-02',2,1,'','0'),(7,'','157248872','','Ashish Tripathi','',0,'','','','','','','','','','','','','','2012-11-04',2,1,'','0'),(10,'','814438694','','Dhanya Prasanna','',0,'','','','','','','','','','','','','','2012-11-04',2,1,'','0'),(11,'sdfsf2354356@yahoo.com','nicky','e10adc3949ba59abbe56e057f20f883e','nitesh','bhardwaj',0,'','','','','','','','','','','','','','2012-11-05',0,1,'f4fe4eba6db59fc9104f0b0018bb54e4','0'),(12,'kirtisharmapce@gmail.com','nicks','e10adc3949ba59abbe56e057f20f883e','nitesh','bhardwaj',24,'','Jaipur','Raj','302020','nicks.you','','scorpio ','','PCE','single','','1352110582.jpg','','2012-11-05',0,1,'f0a3f620846bc008891465fe4b5adf76','0'),(13,'kirtisharmapce@yahoo.com','yugal','e10adc3949ba59abbe56e057f20f883e','yugal','kishor',0,'','','','','','','','','','','','','','2012-11-05',0,1,'836a5920c48aea7d5b0e6c21a64b84a9','0'),(14,'aaron.smith2743@yahoo.com','100002417348068','','Aaron Smith','',0,'','','','','','','','','','','','1352431147130.JPG','','2012-11-05',1,1,'','0'),(15,'doug.goodman@fmr.com','cbrand11','098c0adba7d7d67507ce8b112d88b68f','Cameron','Brand',0,'','','','90210','','','','','','single','','','','2012-11-05',0,1,'0','1'),(17,'undefined','undefined','','undefined','',0,'','','','','','','','','','','','','','2012-11-05',1,1,'','0'),(18,'','613866793','','TelliTize','',0,'','','','','','','','','','','','','','2012-11-05',2,1,'','0'),(19,'sreeji@breezegoindia.com','sreeji','a350bd5e7ea4d3080f4c680f8b95cf0d','Sreeji','S',0,'','','','','','','','','','','','','','2012-11-05',0,1,'96dc8959ed398c31aab81cf0c239ae59','0'),(21,'trainee@breezegoindia.com','greeshma','a350bd5e7ea4d3080f4c680f8b95cf0d','Greeshma','G',0,'','','','','','','','','','','','','','2012-11-06',0,1,'363bc444398c12705affa6566a260cb2','0'),(22,'trainee@breezegoindia.com','greeshma','a350bd5e7ea4d3080f4c680f8b95cf0d','Greeshma','G',0,'','','','','','','','','','','','','','2012-11-06',0,1,'ceb797869932f83c112b03a9dd01014e','0'),(23,'vidya.l@breezegoindia.com','vidya','a350bd5e7ea4d3080f4c680f8b95cf0d','Vidya','L',0,'','','','','','','','','','','','','','2012-11-06',0,1,'0','1'),(24,'','814438694','','Dhanya Prasanna','',0,'','','','','','','','','','','','','','2012-11-06',2,1,'','0'),(25,'','34527867','','ViewMyAct','',0,'','','','','','','','','','','','','','2012-11-06',2,1,'','0'),(26,'','157248872','','Ashish Tripathi','',0,'','','','','','','','','','','','','','2012-11-06',2,1,'','0'),(28,'','157248872','','Ashish Tripathi','',0,'','','','','','','','','','','','','','2012-11-07',2,1,'','0'),(30,'flynacm07@gmail.com','100002255191898','','Nazeem Nizam','',0,'','','','','','','','','','','','','','2012-11-08',1,1,'','0'),(31,'anish@brizgo.net','anish_kris','42f749ade7f9e195bf475f37a44cafcb','anishkris','Anish',0,'','','','','','','','','','','','','','2012-11-09',0,1,'b5fb86044185de5179184b1781d09657','0'),(34,'ashish.warrior@gmail.com','528129002','','Tripathi Ashish','',0,'','','','','','','','','','','','','','2012-11-09',1,1,'','0'),(35,'yeabuddy.com@gmail.com','100003640830962','','Yeah Buddy','',0,'','','','','','','','','','','','','','2012-11-09',1,1,'','0'),(38,'queensland60@gmail.com','100004636147036','','Adison Nick','',0,'','','','','','','','','','','','','','2012-11-12',1,1,'','0'),(40,'','814438694','','Dhanya Prasanna','',0,'','','','','','','','','','','','','','2012-11-12',2,1,'','0'),(41,'','613866793','','TelliTize','',0,'','','','','','','','','','','','','','2012-11-13',2,1,'','0'),(51,'dhanya1p@breezegoindia.com','dhanus','a350bd5e7ea4d3080f4c680f8b95cf0d','dhanya','p',0,'','','','','','','','','','','','','','2012-11-14',0,1,'ccd277f776762d905092234e21b9e0c9','0'),(52,'prasanna_dhanya@yahoo.com','100000001806851','','Dhanya Prasanna','',0,'','','','','','','','','','','','','','2012-11-14',1,1,'','0'),(54,'','613866793','','TelliTize','',0,'','','','','','','','','','','','','','2012-11-15',2,1,'','0'),(55,'','613866793','','TelliTize','',0,'','','','','','','','','','','','','','2012-11-15',2,1,'','0'),(56,'','613866793','','TelliTize','',0,'','','','','','','','','','','','','','2012-11-18',2,1,'','0'),(57,'abisen99@gmail.com','abisen99','7c6a180b36896a0a8c02787eeafb0e4c','Abhiji','Sen',0,'','','','','','','','','','','','','','2012-11-20',0,1,'d5b4e923192722afa3481137a3ca8364','0'),(58,'rhys1993@ymail.com','CrionSvengali93','980b7450fdbff23be324cd4e2b365801','Crion','Svengali',0,'','','','','','','','','','','','','','2012-11-21',0,1,'8461307aaf7ba4540912bfc74622f4c4','0'),(59,'cagoodman77@gmail.com','cgood77','89a5942ef131055f4849e55d36ea1233','Carrie','Goodman',0,'','','','','','','','','','','','','','2012-11-21',0,1,'0','1'),(60,'','','97bb205933f4ba5fb884ae965d6813af','Kay','simpson',0,'','','','','','','','','','','','','','2012-11-21',0,1,'5b8d203f8492a4d0c769a7b7895ffb10','0'),(61,'raia.leigh@yahoo.com','laybay','afb019da5af78d362b39886234cbe255','Kay','simpson',0,'','','','','','','','','','','','','','2012-11-21',0,1,'4f69ded0654e4e3032f543ee16ca288c','0'),(62,'heather2016@gmail.com','TURTLESareMYbestFRIENDS','e449bc88d7528adfdc32949b57d3161c','Heather','Amber',0,'','','','','','1','0','','','single','Just need to confess and say stuff anonymously','','','2012-11-23',0,1,'336d2cd5619311e9a2468a78dfa3f87e','0'),(63,'imjustme110@hotmail.com','missa2u','a13819675e33af65ef99ffc3db2c52e0','ashley','gordon',0,'','','','','','','','','','','','','','2012-11-23',0,1,'fec3c1f5c384b4e1cd577558f3f0870a','0'),(64,'','34527867','','ViewMyAct','',0,'','','','','','','','','','','','1353733293025.JPG','','2012-11-23',2,1,'','0'),(65,'uthopson7@gmail.com','caramel','e118006727d900235d77e740b2ae92a9','unique','thompson',0,'','','','','','','','','','','','','','2012-11-23',0,1,'a3ef9973b5de1277e6203ee48243395e','0'),(66,'suzys1952@aol.com','suzys1952','de829b0975f44a816ce8f0ed13e68ab1','Sue','Taylor',0,'','','','','','','','','','','','','','2012-11-24',0,1,'c246452273ac6b0772133595c748bc7a','0'),(67,'doggystyle@gmail.com','easterbunny123','69899c7222d16fa315d556aa24bfb8b2','henery','bluebirt',0,'','','','','','','','','','','','','','2012-11-25',0,1,'72f42f4aa0a2f472fa3f993c95cd7870','0'),(68,'testmail.senabi@gmail.com','test','e10adc3949ba59abbe56e057f20f883e','Test FN','Test LN',0,'','','','','','','','','','','','1354089022.jpg',',Test FN','2012-11-27',0,1,'c4b80e62d0a1fbe2e159bd9fec983553','0'),(69,'senabi.test01@gmail.com','test1','e10adc3949ba59abbe56e057f20f883e','Test FN','Test LN',0,'','','','','','','','','','','','','','2012-11-27',0,1,'0','1'),(70,'lk66711@hotmail.com','tiredofliars','c28ffcadff42e4afd4d46aab53cadfc5','ken','kraft',0,'','','','','','','','','','','','','','2012-11-27',0,1,'d6a4389ddf21408df1f0ad2f117de602','0'),(71,'info@tellitize.com','tjones11','7856e2452293032883c017bdccab9142','Tom','Jones',0,'','','','','','','','','','','','','','2012-11-29',0,1,'0','1'),(72,'','34527867','','ViewMyAct','',0,'','','','','','','','','','','','','','2012-11-29',2,1,'','0'),(73,'kritigupta02@gmail.com','kriti002','e10adc3949ba59abbe56e057f20f883e','kriti','gupta',0,'','','','','','','','','','','','','','2012-11-29',0,1,'8bff3513dab8cbc04c3a68803dac2d31','0');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-12-03  6:57:15
