-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: blog
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` mediumtext NOT NULL,
  `author_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'nice article',3,9,'2024-01-02 02:14:10'),(2,'I love it',3,2,'2024-01-02 02:24:16'),(3,'nice php',3,2,'2024-01-02 02:30:05'),(4,'nice language',3,2,'2024-01-02 02:30:16'),(5,'wowo',1,9,'2024-01-02 02:36:08'),(6,'new comment',1,8,'2024-01-02 02:37:41'),(7,'I love it',1,8,'2024-01-02 02:38:44'),(8,'I love it',1,8,'2024-01-02 02:38:47'),(9,'I love it',1,8,'2024-01-02 02:39:14'),(10,'fkc',1,8,'2024-01-02 02:39:31'),(11,'fkc',1,8,'2024-01-02 02:40:10'),(12,'fkc',1,8,'2024-01-02 02:40:36'),(13,'fkc',1,8,'2024-01-02 02:41:55'),(14,'yes',1,2,'2024-01-02 03:23:49'),(15,'ddd',7,8,'2024-01-07 11:33:16');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` longtext NOT NULL,
  `image` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Flutter','Flutter is awesome','../images/Screenshot at 2023-07-30 19-37-17.png',1,'2023-12-28 15:52:43','2023-12-28 15:52:43'),(2,'PHP','I Love PHP','../images/Screenshot_2023-05-28_09_32_09.png',1,'2023-12-28 16:01:30','2023-12-28 16:01:30'),(4,'Python','I love python','../images/unicode.jpg',1,'2023-12-30 14:51:31','2023-12-30 14:51:31'),(6,'Laravel','PHP framework','../images/logo.png',1,'2023-12-31 02:37:14','2023-12-31 02:37:14'),(7,'Laravel','HHHH','../images/logo.png',1,'2024-01-01 05:03:09','2024-01-01 05:03:09'),(9,'Test Lorem','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.','../images/logo.png',1,'2024-01-01 14:35:32','2024-01-01 14:35:32'),(10,'<script>alert(\"Hello\")</script>','Script','../images/logo.png',1,'2024-01-07 11:41:03','2024-01-07 11:41:03'),(11,'new test','new test','../images/logo.png',1,'2024-01-07 11:53:26','2024-01-07 11:53:26'),(12,'BBB','bbb','../images/logo.png',1,'2024-01-07 11:54:40','2024-01-07 11:54:40');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','admin@gmail.com','2023-12-27 08:11:47',1),(3,'Htun','b59c67bf196a4758191e42f76670ceba','htun@gmail.com','2024-01-01 13:23:00',1),(4,'oppa','b59c67bf196a4758191e42f76670ceba','oppa@gmail.com','2024-01-01 13:49:39',0),(5,'new','934b535800b1cba8f96a5d72f72f1611','new@gmail.com','2024-01-04 08:07:26',0),(7,'test','b59c67bf196a4758191e42f76670ceba','test@gmail.com','2024-01-07 11:32:47',0);
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

-- Dump completed on 2024-01-07 21:50:28
