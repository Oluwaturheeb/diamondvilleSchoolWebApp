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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
INSERT INTO `attendance` VALUES (1,2,'Third term','Mathematics',0),(2,2,'Third term','English',0),(3,2,'Third term','Basic studies',0),(4,2,'Third term','Basic science',0),(5,2,'Third term','Basic technology',0),(6,2,'Third term','Home economics',0),(7,2,'Third term','Crs',0),(8,2,'Third term','Agriculture',0),(9,2,'Third term','Computer',0),(10,2,'Third term','French',0),(11,2,'Third term','Music',0),(12,3,'Third term','Mathematics',0),(13,3,'Third term','English',0),(14,3,'Third term','Basic studies',0),(15,3,'Third term','Basic science',0),(16,3,'Third term','Basic technology',0),(17,3,'Third term','Home economics',0),(18,3,'Third term','Crs',0),(19,3,'Third term','Agriculture',0),(20,3,'Third term','Computer',0),(21,3,'Third term','French',0),(22,3,'Third term','Music',0),(23,4,'Third term','',0),(24,7,'Third term','Mathematics',0),(25,7,'Third term','English',0),(26,7,'Third term','Basic studies',0),(27,7,'Third term','Basic science',0),(28,7,'Third term','Basic technology',0),(29,7,'Third term','Home economics',0),(30,7,'Third term','Crs',0),(31,7,'Third term','Agriculture',0),(32,7,'Third term','Computer',0),(33,7,'Third term','French',0),(34,7,'Third term','Music',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth`
--

LOCK TABLES `auth` WRITE;
/*!40000 ALTER TABLE `auth` DISABLE KEYS */;
INSERT INTO `auth` VALUES (1,'admin@gmail.com','076203fd7300b6350c97421f1bd359986e53f36f4634d0dc927345b342cee9bd',NULL,'2020-06-12 15:51:07','1'),(3,'Jj@gmail.com','68d26ab662769e0f75a0a86db67108dd2a58ffc5678c7625eb884a80142df946',NULL,'2020-06-12 20:46:09','3'),(4,'Dara@gmail.com','632440c283d5e00ffeaa23187ee12409e44e7852ce85d2b39e22f7ac0c00b0d2',NULL,'2020-06-14 21:29:40','2'),(6,'superduper@gmail.com','632440c283d5e00ffeaa23187ee12409e44e7852ce85d2b39e22f7ac0c00b0d2',NULL,'2020-06-14 21:41:28','2'),(7,'Viru@gmail.com','cba5da2feb9b0cb24a79ba4b7e9b7bcae8fc98d5022eceba6fd6b35a8684ef25',NULL,'2020-06-15 14:20:05','3');
/*!40000 ALTER TABLE `auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `url` varchar(255) NOT NULL,
  `tags` text,
  `time` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `for_update` text NOT NULL,
  `views` int(11) DEFAULT '0',
  `cover` text NOT NULL,
  `files` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` VALUES (1,'Islamic and western education for your kids','Islamic-and-western-education-for-your-kids','Islam, western education, religion','Thu, 12 Sep, 2019','Welcome to the official blog of Guide Intellect Islamic School!\r\nOur main  goal to give your child or ward quality and sound islamic doctrines and western education!\r\n\r\nOur main goals and what we offer;\r\n\r\nNo more going to modrasa because in our curriculum their already a package for modrasa.\r\n\r\nAnd memorization of the qur&#039;an is also included.\r\n\r\nAbility to read, write and speak arabic is also included,\r\n\r\nUp to date western and islamic curriculum is also part of the package\r\n\r\nAnd a mosque is also within the school premise to observe Solaat,\r\n\r\nAnd we have day and boarding facility,\r\n\r\nWell equipped pyhsics and chemistry laboratory\r\n\r\nSport fields e.g basketball and football,\r\n\r\nand the safety of the kids is also or priority as we have cctv cameras all around the school premises and classrooms too!!\r\n\r\nWe hope that after all this you can entrust us with the education of child or ward as we get it all covered the good, qualified and well experience team of teachers!','Welcome to the official blog of Guide Intellect Islamic School!\r\nOur main  goal to give your child or ward quality and sound islamic doctrines and western education!\r\n\r\nOur main goals and what we offer;\r\n\r\nNo more going to modrasa because in our curriculum their already a package for modrasa.\r\n\r\nAnd memorization of the qur&#039;an is also included.\r\n\r\nAbility to read, write and speak arabic is also included,\r\n\r\nUp to date western and islamic curriculum is also part of the package\r\n\r\nAnd a mosque is also within the school premise to observe Solaat,\r\n\r\nAnd we have day and boarding facility,\r\n\r\nWell equipped pyhsics and chemistry laboratory\r\n\r\nSport fields e.g basketball and football,\r\n\r\nand the safety of the kids is also or priority as we have cctv cameras all around the school premises and classrooms too!!\r\n\r\nWe hope that after all this you can entrust us with the education of child or ward as we get it all covered the good, qualified and well experience team of teachers!',1,'',''),(2,'Islam and western education for your kids','Islam-and-western-education-for-your-kids','Islam, western education, religion','Thu, 12 Sep, 2019','Welcome to the official blog of Guide Intellect Islamic School!\r\nOur main  goal to give your child or ward quality and sound islamic doctrines and western education!\r\n\r\nOur main goals and what we offer;\r\n\r\nNo more going to modrasa because in our curriculum their already a package for modrasa.\r\n\r\nAnd memorization of the qur&#039;an is also included.\r\n\r\nAbility to read, write and speak arabic is also included,\r\n\r\nUp to date western and islamic curriculum is also part of the package\r\n\r\nAnd a mosque is also within the school premise to observe Solaat,\r\n\r\nAnd we have day and boarding facility,\r\n\r\nWell equipped pyhsics and chemistry laboratory\r\n\r\nSport fields e.g basketball and football,\r\n\r\nand the safety of the kids is also or priority as we have cctv cameras all around the school premises and classrooms too!!\r\n\r\nWe hope that after all this you can entrust us with the education of child or ward as we get it all covered the good, qualified and well experience team of teachers!','Welcome to the official blog of Guide Intellect Islamic School!\r\nOur main  goal to give your child or ward quality and sound islamic doctrines and western education!\r\n\r\nOur main goals and what we offer;\r\n\r\nNo more going to modrasa because in our curriculum their already a package for modrasa.\r\n\r\nAnd memorization of the qur&#039;an is also included.\r\n\r\nAbility to read, write and speak arabic is also included,\r\n\r\nUp to date western and islamic curriculum is also part of the package\r\n\r\nAnd a mosque is also within the school premise to observe Solaat,\r\n\r\nAnd we have day and boarding facility,\r\n\r\nWell equipped pyhsics and chemistry laboratory\r\n\r\nSport fields e.g basketball and football,\r\n\r\nand the safety of the kids is also or priority as we have cctv cameras all around the school premises and classrooms too!!\r\n\r\nWe hope that after all this you can entrust us with the education of child or ward as we get it all covered the good, qualified and well experience team of teachers!',0,'',''),(3,'The holy quran contains nothing but the true word of Allah','The-holy-quran-contains-nothing-but-the-true-word-of-Allah','Islam, western education, religion','Thu, 12 Sep, 2019','In this holiday we are to be organizing a qur&#039;an competion and the winners prize is as follow\r\nupload_4\r\n<div class=\"h2 section-heading\">Prizes</div>\r\nupload_2\r\n<b>3rd runner up</b> #30, 000\r\nupload_3\r\n<b>2nd runner up</b> #50, 000\r\n<b>1st runner up #75, 000</b>\r\nupload_1\r\n<b>Winner</b>\r\n#100, 000\r\nQur&#039;an - English version and Arabic version\r\nScholarship\r\n\r\nWe urge every to bring their children!\r\nVenue is withing the school premises.','In this holiday we are to be organizing a qur&#039;an competion and the winners prize is as follow\r\nupload_4\r\n[heading]Prizes[/heading]\r\nupload_2\r\n[bold]3rd runner up[/bold] #30, 000\r\nupload_3\r\n[bold]2nd runner up[/bold] #50, 000\r\n[bold]1st runner up #75, 000[/bold]\r\nupload_1\r\n[bold]Winner[/bold]\r\n#100, 000\r\nQur&#039;an - English version and Arabic version\r\nScholarship\r\n\r\nWe urge every to bring their children!\r\nVenue is withing the school premises.',9,'0',''),(5,'Fashion week','Fashion-week','Love story, History, blog','Tue, 17 Sep, 2019','Islam gives peaces AND nothing but peace\r\nMuslims are extremely peaceful people\r\n<img class=\"img-fluid\" src=\"assets/img/post/FB_IMG_1510520060270(1).jpg\">\r\n\r\n<img class=\"img-fluid\" src=\"assets/img/post/FB_IMG_1510520107941.jpg\">\r\n<img class=\"img-fluid\" src=\"assets/img/post/FB_IMG_1510520084622.jpg\">\r\n\r\n<img class=\"img-fluid\" src=\"assets/img/post/FB_IMG_1510520279469.jpg\">','Islam gives peaces AND nothing but peace\r\nMuslims are extremely peaceful people\r\nupload_1\r\n\r\nupload_3\r\nupload_2\r\n\r\nupload_4',5,'assets/img/post/FB_IMG_1510520107941.jpg','assets/img/post/FB_IMG_1510520060270(1).jpg-----assets/img/post/FB_IMG_1510520084622.jpg-----assets/img/post/FB_IMG_1510520107941.jpg-----assets/img/post/FB_IMG_1510520279469.jpg');
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (6,'session','Third term');
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
INSERT INTO `exam` VALUES (11,'Mathematics','Sss 1',NULL,'Multiply 232 by 0___Add 1001 and 1001___divide 2000 by 5','B___C___B','2320___10001___2005','0___2001___2500','2303___2002___800','none___none___none'),(12,'English','Sss 1',NULL,'drug gt ughuij ___hhuoknnvfyuijhg___hhhiijnbgyuiijb','B___A___B','yuuhhhj ggyuh___yuiijggy8u gghh bbh___gyuujvvffgyij','hhjhhguu___ghuijnbvguujjb bhhh vgg___vggyuijjnjky','ggyuijbyui ggyiu___vggggvftyuhfgh___vggguiknbgg','ghhjohbjkiygh___vghhuiknbgyyuh vggh hh___vfggujknbbghkbv');
/*!40000 ALTER TABLE `exam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `konnect`
--

DROP TABLE IF EXISTS `konnect`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `konnect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL,
  `konnect_id` int(11) NOT NULL,
  `status` varchar(10) DEFAULT 'Pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `konnect`
--

LOCK TABLES `konnect` WRITE;
/*!40000 ALTER TABLE `konnect` DISABLE KEYS */;
/*!40000 ALTER TABLE `konnect` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relation`
--

DROP TABLE IF EXISTS `relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tab` varchar(100) NOT NULL,
  `rel` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relation`
--

LOCK TABLES `relation` WRITE;
/*!40000 ALTER TABLE `relation` DISABLE KEYS */;
/*!40000 ALTER TABLE `relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rating` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `time` varchar(20) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT INTO `review` VALUES (1,5,'Muhammad-Turyeeb Bello','Oluwaturheeb@gmail.com','Sun, 8 Sep, 2019','Islam and western education 2 in 1, there nothing better than this!'),(2,5,'Muhammad-Turyeeb Bello','Tee@gmail.com','Mon, 9 Sep, 2019','Superb school i pray u have branches all over the country!');
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `score`
--

LOCK TABLES `score` WRITE;
/*!40000 ALTER TABLE `score` DISABLE KEYS */;
INSERT INTO `score` VALUES (1,3,'First term','Jss 1','[{\"subject\":\"Mathematics\",\"score\":\"3 \\/ 3\"},{\"subject\":\"English\",\"score\":\"1 \\/ 3\"}]'),(2,3,'Second term','Jss 1','[{\"subject\":\"Mathematics\",\"score\":\"2 \\/ 3\"},{\"subject\":\"English\",\"score\":\"2 \\/ 3\"}]'),(3,3,'Third term','Jss 1','[{\"subject\":\"Mathematics\",\"score\":\"1 \\/ 3\"},{\"subject\":\"English\",\"score\":\"1 \\/ 3\"}]'),(4,3,'First term','Jss 2','[{\"subject\":\"Mathematics\",\"score\":\"1 \\/ 3\"},{\"subject\":\"English\",\"score\":\"2 \\/ 3\"}]'),(5,3,'Second term','Jss 2','[{\"subject\":\"Mathematics\",\"score\":\"3 \\/ 3\"},{\"subject\":\"English\",\"score\":\"3 \\/ 3\"}]'),(6,3,'Third term','Jss 2','[{\"subject\":\"Mathematics\",\"score\":\"0 \\/ 3\"},{\"subject\":\"English\",\"score\":\"3 \\/ 3\"}]'),(7,3,'First term','Jss 3','[{\"subject\":\"Mathematics\",\"score\":\"2 \\/ 3\"},{\"subject\":\"English\",\"score\":\"2 \\/ 3\"}]'),(8,3,'Second term','Jss 3','[{\"subject\":\"Mathematics\",\"score\":\"3 \\/ 3\"},{\"subject\":\"English\",\"score\":\"3 \\/ 3\"}]'),(9,3,'Third term','Jss 3','[{\"subject\":\"Mathematics\",\"score\":\"3 \\/ 3\"},{\"subject\":\"English\",\"score\":\"3 \\/ 3\"}]');
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
  `dob` datetime DEFAULT NULL,
  `hadd` varchar(255) DEFAULT NULL,
  `picture` text,
  `p_first` varchar(100) NOT NULL,
  `p_last` varchar(100) NOT NULL,
  `pin` varchar(8) DEFAULT NULL,
  `dept` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,3,'Abdul Lateef','Jimoh','Mr','Male','Jss 3',15,'2005-06-05 00:00:00','no 10, ogunrun','assets/img/student/DiamondVille_864309044_1592301312','Ade','Ferrari','54369ed5','Junior'),(2,7,'Viru','Sahastrabudhe','Mr','Male','Jss 3',17,'2003-03-16 00:00:00','no 15, riverside estate mowe, ogun.',NULL,'Ade','Ferrari','b77126a3','Junior');
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
  `dob` datetime DEFAULT NULL,
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
INSERT INTO `teacher` VALUES (1,1,'Mr','Muhammad-Turyeeb','Bello','Administrator',24,'1995-06-18 00:00:00',NULL,'assets/img/def.png',NULL,'Admin',NULL),(2,4,'Miss','Dara','Vincent','Jss 1, Jss 2, Jss 3',29,'1991-02-14 00:00:00','no 15, riverside estate mowe, ogun.','assets/img/teacher/DiamondVille_24542705_1592303453',NULL,'Mathematics, English',NULL),(3,6,'Miss','Super','Duper','Sss 1, Sss 2, Sss3',29,'1991-02-14 00:00:00','no 15, riverside estate mowe, ogun.','assets/img/teacher/FB_IMG_1503852413848.jpg',NULL,'Mathematics, English',NULL);
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

-- Dump completed on 2020-06-16 12:04:52
