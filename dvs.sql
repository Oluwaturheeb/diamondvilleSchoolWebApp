-- MariaDB dump 10.17  Distrib 10.4.6-MariaDB, for Android (armv7-a)
--
-- Host: localhost    Database: dvs
-- ------------------------------------------------------
-- Server version	10.4.6-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
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
  `sit` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
INSERT INTO `attendance` VALUES (116,17,'First term','English',1),(117,17,'First term','Mathematic',1),(118,17,'First term','Basic Science',0),(119,17,'First term','Basic Technology',0),(120,17,'First term','Basic Studies',0),(121,17,'First term','Basic Agriculture',0),(122,18,'First term','English',0),(123,18,'First term','Mathematic',0),(124,18,'First term','Basic Science',0),(125,18,'First term','Basic Technology',0),(126,18,'First term','Basic Studies',0),(127,18,'First term','Basic Agriculture',0),(128,19,'First term','English',0),(129,19,'First term','Mathematic',0),(130,19,'First term','Basic Science',0),(131,19,'First term','Basic Technology',0),(132,19,'First term','Basic Studies',0),(133,19,'First term','Basic Agriculture',0),(134,20,'First term','English',0),(135,20,'First term','Mathematic',0),(136,20,'First term','Basic Science',0),(137,20,'First term','Basic Technology',0),(138,20,'First term','Basic Studies',0),(139,20,'First term','Basic Agriculture',0);
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
  `password` varchar(128) NOT NULL,
  `last_log` datetime DEFAULT NULL,
  `last_pc` datetime DEFAULT current_timestamp(),
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth`
--

LOCK TABLES `auth` WRITE;
/*!40000 ALTER TABLE `auth` DISABLE KEYS */;
INSERT INTO `auth` VALUES (1,'admin@gmail.com','$2y$10$klBjPrW/HyD1opoAdRv8M.Tn6hobvk3H8PNv.KfyzHd7JbovZT2d2','2021-02-01 19:53:32','2021-01-20 18:32:49','1'),(2,'Ayo@gmail.com','$2y$10$Q2UR33a9rfl8a5B6hPk5tufPbzs2ZCkF4uJD2FVW/hXs95CTJ0h1C','2021-01-30 19:37:24','2021-01-04 22:37:14','2'),(3,'Sho@gmail.com','$2y$10$/9CaKUvAccaShz03g4rhqOCjjvB8dhdzxyam4461Y.gzh1ke9INQS',NULL,'2021-01-04 22:26:39','2'),(4,'Olope@gmail.com','$2y$10$uP.6HfsS1JQmA8svssPGe.a4TShkg0tB6cMrQ2Nae/eYG177WC1Q.','2021-02-02 16:54:44','2021-01-04 22:28:49','3'),(5,'Agbaje@gmail.com','$2y$10$2CWkBoRA34rFbt9bIZ3VqOd6l2TnQM7fzj.1VHj59gvVU6EMwsYZa','2021-01-31 18:48:03','2021-01-04 22:30:41','3'),(6,'Igwe@gmail.com','$2y$10$7bVjQNpjkIJr9cJhEQSnFOrLHDt2Vq6Y9vJMq8gtyxpHom2yLx6xi',NULL,'2021-01-04 22:32:11','3'),(7,'Supermail@gmail.com','$2y$10$/xVkFBFPvBHDv89P0sg0TOYMD99WlZWEUKqvyd6.RwTpbcz2b2oZi',NULL,'2021-01-20 18:27:20','3'),(8,'Ona@mail.com','$2y$10$EPQRay2xYKXPvSgoZW8g/eixpzBghCVESxBye1R5DN7ivpXKUKknC',NULL,'2021-01-20 18:29:30','2'),(10,'Ayo@mail.com','$2y$10$DHhT4SjHZRkW4ttaBF9qOu31ktoGHdg13nUXKwBzNVR927wF9pLgy',NULL,'2021-01-24 23:20:18','3'),(11,'Ayo@mail.com','$2y$10$rRVdjsRiqoR8s34VY45/f.hy/Qvgq3AzwKFWhAxU3e4XYvDW0VzRq',NULL,'2021-01-24 23:27:20','3'),(12,'Cool@mailer.com','$2y$10$3/ZBRu1E/A3CXWWmQNP5S.RFpWAAb2Rjov59hSzUMczTJl4XKgkfi',NULL,'2021-01-29 04:38:03','3'),(13,'Hhujm@mail.hui','$2y$10$GOA9U/3WBe5fOVV32OcjzOIGq46Qi5zVeSo35zJ9fsM./NCXpXvme',NULL,'2021-01-29 04:44:04','3'),(14,'Hhujm@mail.hui','$2y$10$fGSZJpJ2vpFrBcaXRl0t9OY7TPnW4sLqqrOxDTs26VAvu0rDDZdAy',NULL,'2021-01-29 04:44:29','3'),(15,'Some@mail.vhj','$2y$10$qIGL6uTVGDuuspuO0S.5aeJqn0v51.nCQ/dQ8eSBVI23203PgYa6e',NULL,'2021-01-29 04:45:50','2'),(16,'Some@mail.vhj','$2y$10$ckkPvg3.IklkKMeNhsk43ee3OZ1IASm1Zk/MkCgPCg7OwZ/8qQAUa',NULL,'2021-01-29 04:46:09','2'),(17,'Imam@mail.com','$2y$10$0oZZtLyf1qM9QTs6FmMV6u/X0r8vJwHTB.7iONvDkHVvIL/xXq4J.','2021-02-01 14:29:17','2021-01-31 06:28:41','3'),(18,'super@gmail.com','$2y$10$9IFw9XajbuktSUZb9JX4ZeSGiOhACafZQbPNR8lPAKUw4ZeNr2QiS',NULL,'2021-01-31 08:25:36','3'),(19,'Tee@mail.com','$2y$10$9h9ogtY9M/x.alNKW23qS.ggAevEy4e9H5xvAh2yJqidX81oho4Vi',NULL,'2021-01-31 10:58:17','3'),(20,'olope@gmail.com','$2y$10$TaWOK6bDl/fZbAZ6VtcKn.qeCH7R6Hh7OkkJH8BBgVr7G4YW6G296',NULL,'2021-02-01 19:56:25','3');
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
  `content` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (3,'session','First term'),(5,'exams','2021-01-30'),(6,'result','2021-01-30');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam`
--

LOCK TABLES `exam` WRITE;
/*!40000 ALTER TABLE `exam` DISABLE KEYS */;
INSERT INTO `exam` VALUES (1,'English','Jss 1',NULL,'Hassan____to the market yesterday***EXAM***we ____ 12 in the room yesterday***EXAM***The school is ______ to resume soon***EXAM***What is the official language of Nigeria***EXAM***States in Nigeria are the following except','A***EXAM***A***EXAM***A***EXAM***A***EXAM***A','Went***EXAM***were***EXAM***Going***EXAM***English***EXAM***Niger, Abdijan, Abuja','Go***EXAM***are***EXAM***about***EXAM***Hausa***EXAM***Niger, Lagos, Nasarawa','Do***EXAM***all of the above***EXAM***Ready***EXAM***Igbo***EXAM***Delta, Akwa-Ibom, Kogi','attend***EXAM***none of the above***EXAM***none of the above***EXAM***Yoruba***EXAM***None of the above'),(2,'Mathematic','Jss 1',NULL,'Calcute the division between 100 and 4 and then multiply the result by 2***EXAM***If shukurat is 36years calculate the age of felicia if shukurat is older than her by 12years***EXAM***calculate 25 raised to power 3***EXAM***if a fish eats N1000 food in a month, calculate how much feed will 10 eat in 3month***EXAM***Multiply 5 by 12 by zero','C***EXAM***B***EXAM***A***EXAM***D***EXAM***B','106***EXAM***36***EXAM***15625***EXAM***30100***EXAM***60','102***EXAM***24***EXAM***75***EXAM***30110***EXAM***0','50***EXAM***40***EXAM***1875***EXAM***15000***EXAM***17','104***EXAM***none of the above***EXAM***None of the above***EXAM***30000***EXAM***600'),(3,'English','Jss 3',NULL,'past tense of go is? ___','A','went','gone','go','come');
/*!40000 ALTER TABLE `exam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fees`
--

DROP TABLE IF EXISTS `fees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `a_id` int(11) NOT NULL,
  `fees` int(11) DEFAULT NULL,
  `status` enum('false','true') DEFAULT NULL,
  `session` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `a_id` (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fees`
--

LOCK TABLES `fees` WRITE;
/*!40000 ALTER TABLE `fees` DISABLE KEYS */;
INSERT INTO `fees` VALUES (1,4,10000,'false',''),(2,5,10000,'false',''),(3,6,10000,'false',''),(4,7,10000,'false',''),(5,10,15000,'false',''),(6,11,15000,'false',''),(7,13,10000,'false',''),(8,14,10000,'false',''),(9,17,10000,'false','First term'),(10,18,10000,'false','First term'),(11,19,18000,'false','First term'),(12,20,10000,'false','First term');
/*!40000 ALTER TABLE `fees` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `score`
--

LOCK TABLES `score` WRITE;
/*!40000 ALTER TABLE `score` DISABLE KEYS */;
INSERT INTO `score` VALUES (1,17,'First term','Jss 1','[{\"subject\":\"English\",\"score\":\"5 \\/ 5\"},{\"subject\":\"Mathematic\",\"score\":\"2 \\/ 5\"}]');
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
  `a_id` int(11) DEFAULT NULL,
  `pre` varchar(5) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `class` varchar(10) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `hadd` varchar(255) DEFAULT NULL,
  `picture` text DEFAULT NULL,
  `pin` varchar(8) DEFAULT NULL,
  `dept` varchar(20) DEFAULT NULL,
  `active` int(11) DEFAULT 0,
  `phone` varchar(12) DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,17,'Mr','Male','Jss 1',12,'2009-01-01 00:00:00','ogunrun phase 1',NULL,'0408c3d0','Junior',0,'08033333333','Awwal Ibn Imam','Imam'),(2,18,'Mr','Male','Jss 1',15,'2006-01-01 00:00:00','mowe',NULL,'5bde0def','Junior',0,'80000008','super tee','super'),(3,19,'Mr','Male','Jss 3',15,'2006-01-01 00:00:00','mowe',NULL,'5b17a86e','Junior',0,'0803333333','bello toheeb','tee'),(4,20,'Mr','Female','Jss 1',15,'2006-01-01 00:00:00','mowe',NULL,'f74174b6','Junior',0,'08033333333','Idris Olope','olope');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject`
--

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` VALUES (1,'Junior','English, Mathematic, Basic Science, Basic Technology, Basic Studies, Basic Agriculture','Jss'),(2,'Science','Mathematics, English, Basic studies, Basic science, Basic technology, Home economics, Crs, Agriculture, Computer, French, Music, Physics, Chemistry, Further Math','Sss'),(3,'Commercial','Mathematics, English, Basic studies, Basic science, Basic technology, Home economics, Crs, Agriculture, Computer, French, Music, Commerce, Account','Sss'),(4,'Art','Mathematics, English, Basic studies, Basic science, Basic technology, Home economics, Crs, Agriculture, Computer, French, Music, History','Sss'),(5,'Science','physics, math','Sss'),(6,'Science','physics, math','Sss'),(7,'Science','physics, math','Sss');
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
  `class` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `hadd` varchar(255) DEFAULT NULL,
  `picture` text DEFAULT NULL,
  `dept` varchar(20) DEFAULT NULL,
  `subject` text NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher`
--

LOCK TABLES `teacher` WRITE;
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
INSERT INTO `teacher` VALUES (1,1,'Mr','Dept',NULL,NULL,NULL,'assets/img/teacher/tkode.png','Dept','Administrator','Abdul-Turyeeb Ibn Bello','08121001052'),(2,2,'Miss','Jss 1, Jss 2, Jss 3',30,'1990-12-03 00:00:00','somewhere safe','assets/img/teacher/DiamondVille_323041213_1611870198.png',NULL,'English, Mathematic','Secretary DVS','08161582081'),(3,3,'Mrs','Sss 1, Sss 2, Sss 3',32,'1988-07-11 00:00:00','somewhere safe','assets/img/teacher/IMG-20210119-WA0000.jpg',NULL,'English, Mathematic','Solomon DVS','09032790815'),(5,16,'Mr','Jss 1',25,'1995-06-18 00:00:00','mowe','assets/img/teacher/DiamondVille_233702621_1612104259.png',NULL,'Basic Agriculture','random guh','08063857863');
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

-- Dump completed on 2021-02-16 10:10:01
