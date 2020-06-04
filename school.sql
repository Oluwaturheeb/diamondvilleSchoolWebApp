-- MariaDB dump 10.17  Distrib 10.4.6-MariaDB, for Android (armv7-a)
--
-- Host: localhost    Database: school
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
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `url` varchar(255) NOT NULL,
  `tags` text DEFAULT NULL,
  `time` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `for_update` text NOT NULL,
  `views` int(11) DEFAULT 0,
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
  `name` varchar(20) NOT NULL,
  `types` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (6,'Vacancy','Teacher'),(17,'Exams','2nd term');
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
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `opt_a` text NOT NULL,
  `opt_b` text NOT NULL,
  `opt_c` text NOT NULL,
  `opt_d` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam`
--

LOCK TABLES `exam` WRITE;
/*!40000 ALTER TABLE `exam` DISABLE KEYS */;
INSERT INTO `exam` VALUES (3,'English','Jss 1','What is the name of the US president.','D','Abraham lincoln','Bush george','Melany dickson','Donald trump'),(6,'Mathematics','Primary 6','How old am i, if i am 10 years older than my brother who is 23 years?superexamCalculate the differece between 1500miles and 500miles.','CsuperexamB','1023superexam15000miles','2301superexam1000miles','33superexam500miles','333superexamNone of the above'),(7,'English','Primary 6','What is the past tense of gosuperexam____ is the time','BsuperexamA','ComesuperexamWhat','WentsuperexamWhere','All of the abovesuperexamThere','None of the abovesuperexamMine'),(8,'Social studies','Primary 6','What is a polygamous familysuperexamTypes of water are _____.','CsuperexamB','Two fathers, one mother and their friendssuperexamDrinking water, bathing water','One father, two wives and there parentssuperexamTap water, well water','One father, two or more wives and their childrensuperexamRiver water','None of the abovesuperexamNone of the above'),(9,'Basic science','Primary 6','How many planets are there in the worldsuperexamSelect the correct answer from below','BsuperexamB','10superexamWe have ruminant and none ruminant animal','9superexamWe have teressial and non-teressial animal','8superexamWe have teresial and aquatic animal','7superexamNone of the above'),(10,'Agriculture','Primary 6','How many months does a maize require before harvestingsuperexamThe following is an aquatic animal','CsuperexamB','10superexamFish and dog','8superexamCatfish and megalodon','3superexamCat and catfish','1superexamAll of the above');
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
  `s_id` int(11) NOT NULL,
  `data` text NOT NULL,
  `session` int(11) NOT NULL,
  `class` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `score`
--

LOCK TABLES `score` WRITE;
/*!40000 ALTER TABLE `score` DISABLE KEYS */;
INSERT INTO `score` VALUES (1,2,'[{\"Hadith\":0,\"score\":0},{\"Home economics\":0,\"score\":0},{\"Agriculture\":1,\"score\":\"2 \\/ 2\"},{\"Basic science\":1,\"score\":\"0 \\/ 2\"},{\"Social studies\":1,\"score\":\"2 \\/ 2\"},{\"English\":1,\"score\":\"2 \\/ 2\"},{\"Mathematics\":1,\"score\":\"2 \\/ 2\"}]',1,'primary 6'),(2,2,'[{\"Hadith\":0,\"score\":0},{\"Home economics\":0,\"score\":0},{\"Agriculture\":1,\"score\":\"0 \\/ 2\"},{\"Basic science\":1,\"score\":\"0 \\/ 2\"},{\"Social studies\":1,\"score\":\"0 \\/ 2\"},{\"English\":1,\"score\":\"0 \\/ 2\"},{\"Mathematics\":1,\"score\":\"0 \\/ 2\"}]',2,'primary 6'),(5,2,'[{\"Hadith\":0,\"score\":0},{\"Home economics\":0,\"score\":0},{\"Agriculture\":1,\"score\":\"1 \\/ 2\"},{\"Basic science\":1,\"score\":\"1 \\/ 2\"},{\"Social studies\":1,\"score\":\"1 \\/ 2\"},{\"English\":1,\"score\":\"1 \\/ 2\"},{\"Mathematics\":1,\"score\":\"1 \\/ 2\"}]',3,'Primary 6'),(6,2,'[{\"Hadith\":0,\"score\":0},{\"Economics\":0,\"score\":0},{\"Agriculture\":0,\"score\":0},{\"Basic science\":0,\"score\":0},{\"Social studies\":0,\"score\":0},{\"English\":1,\"score\":\"1 \\/ 1\"},{\"Mathematics\":0,\"score\":0}]',1,'Jss 1'),(7,1,'[{\"Hadith\":0,\"score\":0},{\"Home economics\":0,\"score\":0},{\"Agriculture\":1,\"score\":\"2 \\/ 2\"},{\"Basic science\":1,\"score\":\"0 \\/ 2\"},{\"Social studies\":1,\"score\":\"2 \\/ 2\"},{\"English\":1,\"score\":\"2 \\/ 2\"},{\"Mathematics\":1,\"score\":\"2 \\/ 2\"}]',1,'primary 6'),(8,1,'[{\"Hadith\":0,\"score\":0},{\"Home economics\":0,\"score\":0},{\"Agriculture\":1,\"score\":\"1 \\/ 2\"},{\"Basic science\":1,\"score\":\"0 \\/ 2\"},{\"Social studies\":1,\"score\":\"1 \\/ 2\"},{\"English\":1,\"score\":\"1 \\/ 2\"},{\"Mathematics\":1,\"score\":\"2 \\/ 2\"}]',2,'primary 6'),(9,5,'[{\"Hadith\":0,\"score\":0},{\"Home economics\":0,\"score\":0},{\"Agriculture\":1,\"score\":\"0 \\/ 2\"},{\"Basic science\":1,\"score\":\"1 \\/ 2\"},{\"Social studies\":1,\"score\":\"0 \\/ 2\"},{\"English\":1,\"score\":\"0 \\/ 2\"},{\"Mathematics\":1,\"score\":\"0 \\/ 2\"}]',2,'primary 6');
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
  `first` varchar(100) NOT NULL,
  `last` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `picture` text DEFAULT NULL,
  `age` int(11) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `joined` varchar(10) NOT NULL,
  `class` varchar(20) NOT NULL,
  `hadd` text NOT NULL,
  `p_first` varchar(100) DEFAULT NULL,
  `p_last` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `student_id` bigint(20) DEFAULT NULL,
  `opt` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,'Sheriff','Mowe','Male','assets/img/student/4_G.jpg',11,'2008-06-05','08, 2019','primary 6','No 16 ogunrun, mowe, ogun','Mama','Alajo','Nifemi@gmail.com','b569709bd980fc0393047df579ff506c02680cbefe9c4e2729ecc8f709cae097','Sheriff Mowe',996336801,0),(2,'Abdul-lateef','Jimoh','Male','assets/img/student/2019-08-20 19.59.29.jpg',10,'2009-05-15','08, 2019','Jss 1','No 1 ogunrun, mowe, ogun','Radia','Jimoh','Oluwaturheeb@gmail.com','74e02232602a58443528ba77930fef2c648cb4011ed4247f330589a0af4cfc87','Abdul-lateef Jimoh',874742976,0),(3,'Sofia','Iyawo','Female','assets/img/student/1_G.jpg',17,'2001-12-23','09, 2019','primary 6','Ogunrun phase 3, mowe ogun','Adewale','Ogunjimi','Someemail@gmail.com','','Sofia Iyawo',0,1),(4,'Sofia','Iyawo mi','Female','assets/img/student/4ff631689edb252d7beccd68c213c1e8.jpg',14,'2005-01-02','09, 2019','primary 6','No 15, majiyagbe ayobo lagos','Adewale','Ogunjimi','Super@gmail.com','0805de79d2d441efeb27e38242dba101ceb43c263bfdac1237cb38adb5f91796','Sofia Iyawo mi',318234328,0),(5,'Cat','Cheetah','Male','assets/img/student/FB_IMG_1504475920176(1).jpg',16,'2003-11-24','11, 2019','primary 6','No 15, riverside estate mowe, ogun.','Adewale','Jimoh','Sperm@gmail.com','dec74ffbe94bfad27791778f7ce107f80cbde8e2ae03c9e390ffbbd7cdc3de9a','Cat Cheetah',564915184,0);
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
  `name` varchar(50) DEFAULT NULL,
  `class` varchar(20) DEFAULT NULL,
  `s_id` int(11) DEFAULT NULL,
  `sit` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject`
--

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` VALUES (1,'Mathematics','Primary 6',2,1),(2,'Mathematics','Jss 1',NULL,0),(3,'Mathematics','Jss 2',NULL,0),(4,'Mathematics','Jss 3',NULL,0),(5,'Mathematics','Sss 1',NULL,0),(6,'Mathematics','Sss 2',NULL,0),(7,'Mathematics','Sss 3',NULL,0),(8,'English','Primary 6',NULL,0),(9,'English','Jss 1',NULL,0),(10,'English','Jss 2',NULL,0),(11,'English','Jss 3',NULL,0),(12,'English','Sss 1',NULL,0),(13,'English','Sss 2',NULL,0),(14,'English','Sss 3',NULL,0),(15,'Social studies','Primary 6',NULL,0),(16,'Social studies','Jss 1',NULL,0),(17,'Social studies','Jss 2',NULL,0),(18,'Social studies','Jss 3',NULL,0),(19,'Basic science','Primary 6',NULL,0),(20,'Basic science','Jss 1',NULL,0),(21,'Basic science','Jss 2',NULL,0),(22,'Basic science','Jss 3',NULL,0),(23,'Agriculture','Primary 6',NULL,0),(24,'Agriculture','Jss 1',NULL,0),(25,'Agriculture','Jss 2',NULL,0),(26,'Agriculture','Jss 3',NULL,0),(27,'Agriculture','Sss 1',NULL,0),(28,'Agriculture','Sss 2',NULL,0),(29,'Agriculture','Sss 3',NULL,0),(30,'Physics','Sss 1',NULL,0),(31,'Physics','Sss 2',NULL,0),(32,'Physics','Sss 3',NULL,0),(33,'Chemistry','Sss 1',NULL,0),(34,'Chemistry','Sss 2',NULL,0),(35,'Chemistry','Sss 3',NULL,0),(36,'Geography','Sss 1',NULL,0),(37,'Geography','Sss 2',NULL,0),(38,'Geography','Sss 3',NULL,0),(39,'Economics','Jss 1',NULL,0),(40,'Economics','Jss 2',NULL,0),(41,'Economics','Jss 3',NULL,0),(42,'Economics','Sss 1',NULL,0),(43,'Economics','Sss 2',NULL,0),(44,'Economics','Sss 3',NULL,0),(45,'History','Sss 1',NULL,0),(46,'History','Sss 2',NULL,0),(47,'History','Sss 3',NULL,0),(48,'Biology','Sss 1',NULL,0),(49,'Biology','Sss 2',NULL,0),(50,'Biology','Sss 3',NULL,0),(51,'Home economics','Primary 6',NULL,0),(52,'Hadith','Primary 6',NULL,0),(53,'Hadith','Jss 1',NULL,0),(54,'Hadith','Jss 2',NULL,0),(55,'Hadith','Jss 3',NULL,0),(56,'Hadith','Sss 1',NULL,0),(57,'Hadith','Sss 2',NULL,0),(58,'Hadith','Sss 3',NULL,0),(59,NULL,NULL,1,1);
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `pre` varchar(5) NOT NULL,
  `first` varchar(100) NOT NULL,
  `last` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL,
  `picture` text DEFAULT NULL,
  `level` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `class` varchar(20) NOT NULL,
  `hadd` text NOT NULL,
  `password` varchar(64) DEFAULT 'default0000',
  `fullname` varchar(255) NOT NULL,
  `opt` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher`
--

LOCK TABLES `teacher` WRITE;
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
INSERT INTO `teacher` VALUES (0,'Mr','Pradesh','Sahastrabudhe','Pradesh@mail.com','Married','assets/img/teacher/1543829449726.jpg',0,47,'1972-09-21','Primary 6','Ogunrun phase 3, mowe ogun','e7cf3ef4f17c3999a94f2c6f612e8a888e5b1026878e4e19398b23bd38ec221a','Pradesh Sahastrabudhe',0),(1,'','Abdul-Fatai','Abdul-Azeez','Aaaa@gmail.com','Married','assets/img/teacher/admin.svg',1,40,'12-06-1979','','No 10, adekunle street ayobo','e7cf3ef4f17c3999a94f2c6f612e8a888e5b1026878e4e19398b23bd38ec221a','Abdul-Fatai Abdul-Azeez',0),(2,'Miss','Aunty','Shop','Superaunty@gmail.com','Single',NULL,0,88,'1930-10-26','Jss 1','Ogunrun phase 1, mowe ogun','','Aunty Shop',1),(3,'Mr','Muhammad-turyeeb','Bello','Tee@gmail.com','Single','assets/img/teacher/heart.png',0,24,'1995-06-18','Primary 6','No 15, majiyagbe ayobo lagos','e7cf3ef4f17c3999a94f2c6f612e8a888e5b1026878e4e19398b23bd38ec221a','Muhammad-turyeeb Bello',1);
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

-- Dump completed on 2020-06-04 12:52:07
