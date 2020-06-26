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
) ENGINE=InnoDB AUTO_INCREMENT=202 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
INSERT INTO `attendance` VALUES (1,2,'First term','Mathematics',0),(2,2,'First term','English',0),(3,2,'First term','Basic studies',0),(4,2,'First term','Basic science',0),(5,2,'First term','Basic technology',0),(6,2,'First term','Home economics',0),(7,2,'First term','Crs',0),(8,2,'First term','Agriculture',0),(9,2,'First term','Computer',0),(10,2,'First term','French',0),(11,2,'First term','Music',0),(23,4,'First term','',0),(35,9,'First term','Mathematics',0),(36,9,'First term','English',0),(37,9,'First term','Basic studies',0),(38,9,'First term','Basic science',0),(39,9,'First term','Basic technology',0),(40,9,'First term','Home economics',0),(41,9,'First term','Crs',0),(42,9,'First term','Agriculture',0),(43,9,'First term','Computer',0),(44,9,'First term','French',0),(45,9,'First term','Music',0),(178,7,'First term','Mathematics',0),(179,7,'First term','English',0),(180,7,'First term','Basic studies',0),(181,7,'First term','Basic science',0),(182,7,'First term','Basic technology',0),(183,7,'First term','Home economics',0),(184,7,'First term','Crs',0),(185,7,'First term','Agriculture',0),(186,7,'First term','Computer',0),(187,7,'First term','French',0),(188,7,'First term','Music',0),(189,7,'First term','History',0),(190,3,'First term','Mathematics',0),(191,3,'First term','English',0),(192,3,'First term','Basic studies',0),(193,3,'First term','Basic science',0),(194,3,'First term','Basic technology',0),(195,3,'First term','Home economics',0),(196,3,'First term','Crs',0),(197,3,'First term','Agriculture',0),(198,3,'First term','Computer',0),(199,3,'First term','French',0),(200,3,'First term','Music',0),(201,3,'First term','History',0);
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
INSERT INTO `student` VALUES (1,3,'Abdul Lateef','Jimoh','Mr','Male','Sss 1',15,'2005-06-05','no 10, ogunrun','assets/img/student/tlight.jpg','Ade','Ferrari','54369ed5','Art',NULL,0),(2,7,'Viru','Sahastrabudhe','Mr','Male','Sss 1',17,'2003-03-16','no 15, riverside estate mowe, ogun.','assets/img/student/IMG_20150908_135715.gif','Ade','Ferrari','b77126a3','Art',NULL,0),(3,9,'Super','Cheetah','Mr','Female','Jss 1',6,'2014-01-06','no 15, riverside estate mowe, ogun.','assets/img/student/FB_IMG_14848986964600995.jpg','Ade','Ferrari','3d540132','Junior',2147483647,0);
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
INSERT INTO `teacher` VALUES (1,1,'Mr','Muhammad-Turyeeb','Bello','Administrator',24,'1995-06-18',NULL,'assets/img/def.png',NULL,'Admin',NULL),(2,4,'Miss','Dara','Vincent','Jss 1, Jss 2, Jss 3',29,'1991-02-14','no 15, riverside estate mowe, ogun.','assets/img/teacher/FB_IMG_14954000816192126.jpg',NULL,'Mathematics, English',NULL),(3,6,'Miss','Super','Duper','Sss 1, Sss 2, Sss3',29,'1991-02-14','no 15, riverside estate mowe, ogun.','assets/img/teacher/bg.png',NULL,'Mathematics, English',NULL);
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

-- Dump completed on 2020-06-26 21:47:00
