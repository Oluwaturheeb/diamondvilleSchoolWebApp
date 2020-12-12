-- MySQL dump 10.16  Distrib 10.1.29-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: dvs
-- ------------------------------------------------------
-- Server version	10.1.29-MariaDB

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
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `a_id` int(11) NOT NULL,
  `session` varchar(20) DEFAULT NULL,
  `subject` varchar(20) DEFAULT NULL,
  `sit` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=224 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
INSERT INTO `attendance` VALUES (1,2,'First term','Mathematics',0),(2,2,'First term','English',0),(3,2,'First term','Basic studies',0),(4,2,'First term','Basic science',0),(5,2,'First term','Basic technology',0),(6,2,'First term','Home economics',0),(7,2,'First term','Crs',0),(8,2,'First term','Agriculture',0),(9,2,'First term','Computer',0),(10,2,'First term','French',0),(11,2,'First term','Music',0),(23,4,'First term','',0),(35,9,'First term','Mathematics',0),(36,9,'First term','English',0),(37,9,'First term','Basic studies',0),(38,9,'First term','Basic science',0),(39,9,'First term','Basic technology',0),(40,9,'First term','Home economics',0),(41,9,'First term','Crs',0),(42,9,'First term','Agriculture',0),(43,9,'First term','Computer',0),(44,9,'First term','French',0),(45,9,'First term','Music',0),(202,3,'First term','Mathematics',0),(203,3,'First term','English',0),(204,3,'First term','Basic studies',0),(205,3,'First term','Basic science',0),(206,3,'First term','Basic technology',0),(207,3,'First term','Home economics',0),(208,3,'First term','Crs',0),(209,3,'First term','Agriculture',0),(210,3,'First term','Computer',0),(211,3,'First term','French',0),(212,3,'First term','Music',0),(213,7,'First term','Mathematics',0),(214,7,'First term','English',0),(215,7,'First term','Basic studies',0),(216,7,'First term','Basic science',0),(217,7,'First term','Basic technology',0),(218,7,'First term','Home economics',0),(219,7,'First term','Crs',0),(220,7,'First term','Agriculture',0),(221,7,'First term','Computer',0),(222,7,'First term','French',0),(223,7,'First term','Music',0);
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth`
--

DROP TABLE IF EXISTS `auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `password` varchar(64) NOT NULL,
  `last_log` datetime DEFAULT NULL,
  `last_pc` datetime DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth`
--

LOCK TABLES `auth` WRITE;
/*!40000 ALTER TABLE `auth` DISABLE KEYS */;
INSERT INTO `auth` VALUES (1,'admin@gmail.com','076203fd7300b6350c97421f1bd359986e53f36f4634d0dc927345b342cee9bd',NULL,'0000-00-00 00:00:00','1'),(3,'Jj@gmail.com','passpass',NULL,'0000-00-00 00:00:00','3'),(4,'Dara@gmail.com','passpass',NULL,'0000-00-00 00:00:00','2'),(6,'superduper@gmail.com','passpass',NULL,'0000-00-00 00:00:00','2'),(7,'Viru@gmail.com','passpass',NULL,'0000-00-00 00:00:00','3'),(9,'Top@gmail.com','passpass',NULL,'0000-00-00 00:00:00','3');
/*!40000 ALTER TABLE `auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (11,'session','First term');
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam`
--

DROP TABLE IF EXISTS `exam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `class` varchar(20) NOT NULL,
  `dept` varchar(20) DEFAULT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `opt_a` text NOT NULL,
  `opt_b` text NOT NULL,
  `opt_c` text NOT NULL,
  `opt_d` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam`
--

LOCK TABLES `exam` WRITE;
/*!40000 ALTER TABLE `exam` DISABLE KEYS */;
INSERT INTO `exam` VALUES (11,'Mathematics','Jss 3',NULL,'Multiply 232 by 0___Add 1001 and 1001___divide 2000 by 5','B___C___B','2320___10001___2005','0___2001___2500','2303___2002___800','none___none___none'),(12,'English','Jss 3',NULL,'drug gt ughuij ___hhuoknnvfyuijhg___hhhiijnbgyuiijb','B___A___B','yuuhhhj ggyuh___yuiijggy8u gghh bbh___gyuujvvffgyij','hhjhhguu___ghuijnbvguujjb bhhh vgg___vggyuijjnjky','ggyuijbyui ggyiu___vggggvftyuhfgh___vggguiknbgg','ghhjohbjkiygh___vghhuiknbgyyuh vggh hh___vfggujknbbghkbv');
/*!40000 ALTER TABLE `exam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `score`
--

DROP TABLE IF EXISTS `score`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `a_id` int(11) NOT NULL,
  `session` varchar(20) NOT NULL,
  `class` varchar(20) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `score`
--

LOCK TABLES `score` WRITE;
/*!40000 ALTER TABLE `score` DISABLE KEYS */;
INSERT INTO `score` VALUES (1,3,'First term','Jss 1','[{\"subject\":\"Mathematics\",\"score\":\"3 \\/ 3\"},{\"subject\":\"English\",\"score\":\"1 \\/ 3\"}]'),(2,3,'Second term','Jss 1','[{\"subject\":\"Mathematics\",\"score\":\"2 \\/ 3\"},{\"subject\":\"English\",\"score\":\"2 \\/ 3\"}]'),(3,3,'Third term','Jss 1','[{\"subject\":\"Mathematics\",\"score\":\"1 \\/ 3\"},{\"subject\":\"English\",\"score\":\"1 \\/ 3\"}]'),(4,3,'First term','Jss 2','[{\"subject\":\"Mathematics\",\"score\":\"1 \\/ 3\"},{\"subject\":\"English\",\"score\":\"2 \\/ 3\"}]'),(5,3,'Second term','Jss 2','[{\"subject\":\"Mathematics\",\"score\":\"3 \\/ 3\"},{\"subject\":\"English\",\"score\":\"3 \\/ 3\"}]'),(6,3,'Third term','Jss 2','[{\"subject\":\"Mathematics\",\"score\":\"0 \\/ 3\"},{\"subject\":\"English\",\"score\":\"3 \\/ 3\"}]'),(7,3,'First term','Jss 3','[{\"subject\":\"Mathematics\",\"score\":\"2 \\/ 3\"},{\"subject\":\"English\",\"score\":\"2 \\/ 3\"},{\"subject\":\"Mathematics\",\"score\":\"0 \\/ 3\"},{\"subject\":\"English\",\"score\":\"0 \\/ 3\"}]'),(8,3,'Second term','Jss 3','[{\"subject\":\"Mathematics\",\"score\":\"3 \\/ 3\"},{\"subject\":\"English\",\"score\":\"3 \\/ 3\"}]'),(9,3,'Third term','Jss 3','[{\"subject\":\"Mathematics\",\"score\":\"3 \\/ 3\"},{\"subject\":\"English\",\"score\":\"3 \\/ 3\"}]'),(10,7,'First term','Jss 3','[{\"subject\":\"Mathematics\",\"score\":\"0 \\/ 3\"},{\"subject\":\"English\",\"score\":\"3 \\/ 3\"}]');
/*!40000 ALTER TABLE `score` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `a_id` int(11) NOT NULL,
  `first` varchar(100) NOT NULL,
  `last` varchar(100) NOT NULL,
  `pre` varchar(5) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `class` varchar(10) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `hadd` varchar(255) DEFAULT NULL,
  `picture` text,
  `p_first` varchar(100) NOT NULL,
  `p_last` varchar(100) NOT NULL,
  `pin` varchar(8) DEFAULT NULL,
  `dept` varchar(20) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,3,'Abdul Lateef','Jimoh','Mr','Male','Jss 1',15,'2005-06-05','no 10, ogunrun','assets/img/student/tlight.jpg','Ade','Ferrari','54369ed5','Junior',NULL,0),(2,7,'Viru','Sahastrabudhe','Mr','Male','Jss 1',17,'2003-03-16','no 15, riverside estate mowe, ogun.','assets/img/student/IMG_20150908_135715.gif','Ade','Ferrari','b77126a3','Junior',NULL,0),(3,9,'Super','Cheetah','Mr','Female','Jss 1',6,'2014-01-06','no 15, riverside estate mowe, ogun.','assets/img/student/FB_IMG_14848986964600995.jpg','Ade','Ferrari','3d540132','Junior',2147483647,0);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept` varchar(20) DEFAULT NULL,
  `subject` text NOT NULL,
  `class` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject`
--

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` VALUES (1,'Junior','Mathematics, English, Basic studies, Basic science, Basic technology, Home economics, Crs, Agriculture, Computer, French, Music',NULL),(2,'Art','Mathematics, English, Basic studies, Basic science, Basic technology, Home economics, Crs, Agriculture, Computer, French, Music, History','Sss'),(3,'Commercial','Mathematics, English, Basic studies, Basic science, Basic technology, Home economics, Crs, Agriculture, Computer, French, Music, Commerce, Account','Sss'),(4,'Science','Mathematics, English, Basic studies, Basic science, Basic technology, Home economics, Crs, Agriculture, Computer, French, Music, Physics, Chemistry, Further Math','Sss');
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `a_id` int(11) NOT NULL,
  `pre` varchar(5) NOT NULL,
  `first` varchar(100) NOT NULL,
  `last` varchar(100) NOT NULL,
  `class` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `hadd` varchar(255) DEFAULT NULL,
  `picture` text,
  `dept` varchar(20) DEFAULT NULL,
  `subject` text NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher`
--

LOCK TABLES `teacher` WRITE;
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
INSERT INTO `teacher` VALUES (1,1,'Mr','Muhammad-Turyeeb','Bello','Administrator',24,'1995-06-18',NULL,'assets/img/def.png',NULL,'Admin',NULL),(2,4,'Miss','Dara','Vincent','Jss 1, Jss 2, Jss 3',29,'1991-02-14','no 15, riverside estate mowe, ogun.','assets/img/teacher/tkode.png',NULL,'Mathematics, English',NULL),(3,6,'Miss','Super','Duper','Sss 1, Sss 2, Sss3',29,'1991-02-14','no 15, riverside estate mowe, ogun.','assets/img/teacher/tlight.png',NULL,'Mathematics, English',NULL);
/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-26 13:34:04
