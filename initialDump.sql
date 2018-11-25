-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: gsa
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.18.04.1

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
-- Table structure for table `childSheet`
--

DROP TABLE IF EXISTS `childSheet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `childSheet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `period` varchar(255) DEFAULT NULL,
  `presence` varchar(255) DEFAULT NULL,
  `childId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `childSheet`
--

LOCK TABLES `childSheet` WRITE;
/*!40000 ALTER TABLE `childSheet` DISABLE KEYS */;
INSERT INTO `childSheet` VALUES (5,'2018-11-25','t','t',NULL),(6,'2018-11-25','r','s',2),(7,'2018-11-26','w','w',2),(8,'2018-11-27','a','a',2),(13,'2018-11-24',NULL,NULL,2);
/*!40000 ALTER TABLE `childSheet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `children`
--

DROP TABLE IF EXISTS `children`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `children` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `dateOfEntry` date DEFAULT NULL,
  `addressLine1` varchar(100) DEFAULT NULL,
  `addressLine2` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(45) DEFAULT NULL,
  `createTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `children`
--

LOCK TABLES `children` WRITE;
/*!40000 ALTER TABLE `children` DISABLE KEYS */;
INSERT INTO `children` VALUES (1,'James','Clooney','male','1992-10-04','2000-09-14',NULL,NULL,'555-4444-333','2018-11-24 14:39:10','2018-11-24 14:45:19'),(2,'Brandon','Newman','male','1992-11-07','2000-09-10',NULL,NULL,'5555-2222-3333','2018-11-24 15:05:53','2018-11-24 15:09:20'),(4,'Jean','Grey','female','1995-06-06','2005-01-20',NULL,NULL,NULL,'2018-11-24 15:23:43','2018-11-24 15:23:43');
/*!40000 ALTER TABLE `children` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `childrenGuardians`
--

DROP TABLE IF EXISTS `childrenGuardians`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `childrenGuardians` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `childId` int(11) DEFAULT NULL,
  `guardianId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `childrenGuardians`
--

LOCK TABLES `childrenGuardians` WRITE;
/*!40000 ALTER TABLE `childrenGuardians` DISABLE KEYS */;
INSERT INTO `childrenGuardians` VALUES (5,2,1),(6,2,2);
/*!40000 ALTER TABLE `childrenGuardians` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guardians`
--

DROP TABLE IF EXISTS `guardians`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guardians` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `addressLine1` varchar(100) DEFAULT NULL,
  `addressLine2` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(45) DEFAULT NULL,
  `familyType` varchar(50) DEFAULT NULL,
  `createTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guardians`
--

LOCK TABLES `guardians` WRITE;
/*!40000 ALTER TABLE `guardians` DISABLE KEYS */;
INSERT INTO `guardians` VALUES (1,'Alex','Gagnon','202 River Road','p2','7777-1111-2222','Brother','2018-11-24 15:58:41','2018-11-24 15:58:41'),(2,'Suzan','Rose','12 Lapaka Road',NULL,'7777-2222-3333','Sister','2018-11-24 16:00:24','2018-11-24 16:00:24'),(3,'Hello','World',NULL,NULL,NULL,NULL,'2018-11-24 16:00:36','2018-11-24 16:12:36');
/*!40000 ALTER TABLE `guardians` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `years` varchar(50) DEFAULT NULL,
  `paymentTerm1` varchar(100) DEFAULT NULL,
  `paymentTerm2` varchar(100) DEFAULT NULL,
  `paymentTerm3` varchar(100) DEFAULT NULL,
  `statusTerm1` int(1) DEFAULT NULL,
  `statusTerm2` int(1) DEFAULT NULL,
  `statusTerm3` int(1) DEFAULT NULL,
  `statusTextTerm1` varchar(100) DEFAULT NULL,
  `statusTextTerm2` varchar(100) DEFAULT NULL,
  `statusTextTerm3` varchar(100) DEFAULT NULL,
  `invoiceLinkTerm1` varchar(255) DEFAULT NULL,
  `invoiceLinkTerm2` varchar(255) DEFAULT NULL,
  `invoiceLinkTerm3` varchar(255) DEFAULT NULL,
  `childId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` VALUES (1,'2017/2018','GYD 60,000','GYD 60,000','GYD 60,000',1,2,3,'Paid','Partially paid (47,000)','Unpaid','http://google.com','http://somelink.com','http://somelink.com',2),(5,'2016/2017','GYD 60,000','GYD 60,000','GYD 60,000',1,1,1,'Paid','Paid','Paid','http://somelink.com','http://somelink.com','http://somelink.com',2);
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `categoryId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `user_category_unique_key` (`categoryId`,`userId`),
  UNIQUE KEY `userId_UNIQUE` (`userId`),
  KEY `user_permissions_key_idx` (`userId`),
  KEY `category_permissions_key_idx` (`categoryId`),
  CONSTRAINT `category_permissions_key` FOREIGN KEY (`categoryId`) REFERENCES `userCategories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_permissions_key` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,1,1),(13,10,1),(15,11,2),(16,12,2);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userCategories`
--

DROP TABLE IF EXISTS `userCategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userCategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userCategories`
--

LOCK TABLES `userCategories` WRITE;
/*!40000 ALTER TABLE `userCategories` DISABLE KEYS */;
INSERT INTO `userCategories` VALUES (1,'admin'),(2,'guest'),(3,'editor');
/*!40000 ALTER TABLE `userCategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userChildren`
--

DROP TABLE IF EXISTS `userChildren`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userChildren` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `childId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `uq_user_child` (`userId`,`childId`),
  KEY `fk_user_children_idx` (`childId`),
  KEY `fk_user_idx` (`userId`),
  CONSTRAINT `fk_children` FOREIGN KEY (`childId`) REFERENCES `children` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userChildren`
--

LOCK TABLES `userChildren` WRITE;
/*!40000 ALTER TABLE `userChildren` DISABLE KEYS */;
INSERT INTO `userChildren` VALUES (1,12,2);
/*!40000 ALTER TABLE `userChildren` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `dateOfEntry` datetime DEFAULT NULL,
  `addressLine1` varchar(100) DEFAULT NULL,
  `addressLine2` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `phoneNumber` varchar(45) DEFAULT NULL,
  `familyType` varchar(45) DEFAULT NULL,
  `createTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'piskunov','$2y$10$XuUizxt6PIGnW0vSQK72/.elfhHGZXY6IuT3zrBdgyqzUUnDQHea6','piskunovigorm@gmail.com','Igor','Piskunov','male','1991-08-07',NULL,'Sedina 206',NULL,'Krasnodar','+79528348674',NULL,NULL,NULL),(10,'admin','$2y$10$HiU/oq6Rs.qPomch3B8pi.5YrfJH1q1u4oMlrsWfdKWHpH9RmU51m','mail@comany.com','Administrative','User',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,'test','$2y$10$iA1NrNYopLN4YIYt4bNYxuuzSdsK5GuobvmYTur5IzZqqXNxpqVke','test@user.com','Test','User',NULL,NULL,NULL,NULL,NULL,NULL,'12345678','w','2018-11-22 12:56:49','2018-11-24 16:21:15'),(12,'london','$2y$10$iHrzELqtMAgyJP/iMOWUhO0ZvjmuOaRDy0tvUnfDa//pUmy08odFW','khanna@mail.com','Rajesh','Khanna',NULL,NULL,NULL,'445 Long Street',NULL,NULL,'555-1111-222','Father','2018-11-24 16:29:46','2018-11-25 19:10:11');
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

-- Dump completed on 2018-11-25 23:32:55
