-- MySQL dump 10.13  Distrib 5.6.30, for Linux (x86_64)
--
-- Host: localhost    Database: framework
-- ------------------------------------------------------
-- Server version	5.6.30

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
-- Table structure for table `administrators`
--

DROP TABLE IF EXISTS `administrators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `firstname` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email_verification_code` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `email_verification_date` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrators`
--

LOCK TABLES `administrators` WRITE;
/*!40000 ALTER TABLE `administrators` DISABLE KEYS */;
INSERT INTO `administrators` VALUES (2,'ADMIN','Admin','admin@test.com','$6$199337193b7024b3$TRIFwsRF9laQy/hxaZip20EzS2IAUwHyH66aiDq7k5QCE4j6BAdo7jK0gIzC17suC508WVLgvNRssDX9Ci2VF1','VUFMUE8OW386EPX979C4LPS709RL0E','2017-04-01 17:45:35',1,1,'2017-04-01 17:45:35','2017-07-04 14:03:11'),(3,'Admin1','Minda1','admin1@test.com','$6$199337193b7024b3$Ol.zzqrJgAaEgKJ5rNKxvGt6724CVjEjYfR9TXIO22I69j71PRa36Jf1wZJ88z4UO1praoIfBlZiqHd63zElQ.','TW43S3EMTQJB8MRZRE8K00L5T6IHAJ','2017-06-30 12:00:36',1,1,'2017-06-30 12:00:36','2017-06-30 12:15:21');
/*!40000 ALTER TABLE `administrators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `content` text CHARACTER SET latin1 NOT NULL,
  `user_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `site_id` (`site_id`),
  CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'Articles de test','Est-ce que çà marche ?',5,1,0,0,'2017-04-04 16:30:03','2017-04-04 16:30:03'),(2,'Articles 2','Contenu de l\'article 2',5,1,0,0,'2017-04-04 16:30:03','2017-04-04 16:30:03'),(3,'456 Test','ha ha on sait jamais quoi',5,1,0,0,'2017-04-11 15:48:00','2017-04-11 15:48:00'),(4,'Test','Articles pour le site 1',5,2,9,1,'2017-04-21 18:14:05','2017-04-22 16:40:54');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,NULL,'Test','rez',1,'2017-04-10 15:40:59','2017-04-10 15:40:59',0),(2,NULL,'Toto','qsdqsd',1,'2017-04-11 17:17:54','2017-04-11 17:18:53',0);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galleries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `description` text CHARACTER SET latin1,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES (3,'aaa','aaa','2017-04-07 14:49:41','2017-06-28 13:09:53');
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galleries_medias`
--

DROP TABLE IF EXISTS `galleries_medias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galleries_medias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `description` text CHARACTER SET latin1,
  `position` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_galleries_medias_gallery_idx` (`gallery_id`),
  KEY `fk_galleries_medias_media_idx` (`media_id`),
  CONSTRAINT `fk_galleries_medias_gallery` FOREIGN KEY (`gallery_id`) REFERENCES `galleries` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_galleries_medias_media` FOREIGN KEY (`media_id`) REFERENCES `medias` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries_medias`
--

LOCK TABLES `galleries_medias` WRITE;
/*!40000 ALTER TABLE `galleries_medias` DISABLE KEYS */;
INSERT INTO `galleries_medias` VALUES (1,3,39,NULL,NULL,0,1,'2017-06-28 13:09:53','2017-06-28 13:09:53'),(2,3,38,NULL,NULL,1,1,'2017-06-28 13:09:53','2017-06-28 13:09:53');
/*!40000 ALTER TABLE `galleries_medias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET latin1 NOT NULL,
  `label` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'administrators','Administrateurs','2017-06-29 12:56:59','2017-06-30 10:37:21'),(2,'users','Utilisateurs','2017-06-30 09:18:36','2017-06-30 09:30:50');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mediacategories`
--

DROP TABLE IF EXISTS `mediacategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mediacategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET latin1 NOT NULL,
  `label` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mediacategories`
--

LOCK TABLES `mediacategories` WRITE;
/*!40000 ALTER TABLE `mediacategories` DISABLE KEYS */;
INSERT INTO `mediacategories` VALUES (1,'product','Product','2017-04-22 12:42:50','2017-04-22 12:42:50'),(2,'user','User','2017-04-22 12:43:00','2017-04-22 12:43:00'),(3,'article','Article','2017-04-22 13:45:17','2017-04-22 14:06:55'),(4,'menuitem','Menu Item','2017-05-03 08:28:30','2017-05-03 08:28:30'),(5,'page','Page','2017-01-01 11:00:00','2017-01-01 11:00:00');
/*!40000 ALTER TABLE `mediacategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mediaformats`
--

DROP TABLE IF EXISTS `mediaformats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mediaformats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET latin1 NOT NULL,
  `label` varchar(255) CHARACTER SET latin1 NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mediaformats`
--

LOCK TABLES `mediaformats` WRITE;
/*!40000 ALTER TABLE `mediaformats` DISABLE KEYS */;
INSERT INTO `mediaformats` VALUES (1,'large','Large',450,450,'2017-06-27 09:00:17','2017-06-27 09:00:17'),(2,'medium','Medium',150,150,'2017-06-27 09:00:35','2017-06-27 09:00:35'),(3,'small','Small',50,50,'2017-06-27 09:00:47','2017-06-27 09:01:50');
/*!40000 ALTER TABLE `mediaformats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medias`
--

DROP TABLE IF EXISTS `medias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('image','video','audio') CHARACTER SET latin1 NOT NULL DEFAULT 'image',
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1,
  `image` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `video` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `audio` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `url` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `mediacategory_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mediacategory_id` (`mediacategory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medias`
--

LOCK TABLES `medias` WRITE;
/*!40000 ALTER TABLE `medias` DISABLE KEYS */;
INSERT INTO `medias` VALUES (16,'image','m1','','/uploads/media/1/6/16_image.png','','',NULL,NULL,'2017-06-22 09:36:02','2017-06-22 09:36:02'),(17,'image','m2','','/uploads/media/1/7/17_image.png','','',NULL,NULL,'2017-06-22 09:36:21','2017-06-22 09:36:21'),(18,'image','20170622122859',NULL,'/uploads/media/1/8/18_image.png',NULL,NULL,NULL,5,'2017-06-22 12:28:59','2017-06-22 12:28:59'),(36,'image','20170623113717',NULL,'/uploads/media/3/6/36_image.jpg','','',NULL,2,'2017-06-23 11:37:17','2017-06-23 11:37:17'),(37,'image','20170623113735',NULL,'/uploads/media/3/7/37_image.jpg','','',NULL,2,'2017-06-23 11:37:35','2017-06-23 11:37:35'),(38,'image','20170623114809',NULL,'/uploads/media/3/8/38_image.jpg','','',NULL,NULL,'2017-06-23 11:48:09','2017-06-23 11:48:09'),(39,'image','20170623133149',NULL,'/uploads/media/3/9/39_image.png','','',NULL,NULL,'2017-06-23 13:31:49','2017-06-23 13:31:49'),(65,'image','20170626134314',NULL,'/uploads/media/6/5/65_image.jpg','','',NULL,2,'2017-06-26 13:43:14','2017-06-26 13:43:14'),(67,'image','20170626135659',NULL,'/uploads/media/6/7/67_image.jpg','','',NULL,2,'2017-06-26 13:56:59','2017-06-26 13:56:59'),(68,'image','20170627141313',NULL,'/uploads/media/6/8/68_image.png','','',NULL,5,'2017-06-27 14:13:13','2017-06-27 14:13:13'),(71,'image','20170628161208',NULL,'/uploads/media/7/1/71_image.jpg','','',NULL,5,'2017-06-28 16:12:08','2017-06-28 16:12:08'),(72,'image','20170630104033',NULL,'/uploads/media/7/2/72_image.jpg','','',NULL,2,'2017-06-30 10:40:33','2017-06-30 10:40:33');
/*!40000 ALTER TABLE `medias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menuitems`
--

DROP TABLE IF EXISTS `menuitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menuitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `label` varchar(255) CHARACTER SET latin1 NOT NULL,
  `position` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `link` varchar(255) CHARACTER SET latin1 NOT NULL,
  `menu_id` int(11) NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `media_id` (`media_id`),
  CONSTRAINT `menuitems_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menuitems`
--

LOCK TABLES `menuitems` WRITE;
/*!40000 ALTER TABLE `menuitems` DISABLE KEYS */;
INSERT INTO `menuitems` VALUES (1,NULL,'Articles',0,1,'2017-04-03 16:59:51','2017-05-03 10:31:23','/articles/index',1,NULL),(11,NULL,'Test',0,1,'2017-04-24 16:32:38','2017-05-03 16:38:29','/pages/1',1,NULL);
/*!40000 ALTER TABLE `menuitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) CHARACTER SET latin1 NOT NULL,
  `active` int(11) NOT NULL,
  `principal` tinyint(1) NOT NULL,
  `site_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Menu Principal',1,1,1,'2017-04-03 16:59:51','2017-04-21 17:57:16'),(2,'Menu Footer',0,0,1,'2017-04-11 13:33:14','2017-04-11 13:33:14'),(3,'Menu Principal',1,1,2,'2017-04-21 17:22:22','2017-04-21 18:05:49');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `content` text CHARACTER SET latin1 NOT NULL,
  `site_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `layout` varchar(255) CHARACTER SET latin1 NOT NULL,
  `show_page_title` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Accueil','{\"title\":\"Accueil\",\"active\":\"1\",\"sections\":[{\"blockType\":\"section\",\"attributes\":{\"class\":\"\"},\"styles\":{},\"rows\":[{\"blockType\":\"row\",\"attributes\":{},\"styles\":{\"background\":\"#aabcce\"},\"cols\":[{\"blockType\":\"row\",\"attributes\":{},\"styles\":{\"background\":\"#ffcc33\"},\"content\":\"qsdqsd\",\"widget\":null},{\"blockType\":\"row\",\"attributes\":{},\"styles\":{},\"content\":\"\",\"widget\":null}]}],\"fullwidth\":false},{\"blockType\":\"section\",\"attributes\":{},\"styles\":{},\"rows\":[{\"blockType\":\"row\",\"attributes\":{},\"styles\":{},\"cols\":[{\"blockType\":\"row\",\"attributes\":{},\"styles\":{},\"content\":\"%7B%25%20widget%20type%3D%22gallery%22%20id%3D%221%22%20%25%7D\",\"widget\":null},{\"blockType\":\"row\",\"attributes\":{},\"styles\":{},\"content\":\"%7B%25%20image%20src%3D%22%2Fuploads%2Fmedia%2F7%2F1%2F71_image.jpg%22%20%25%7D\",\"widget\":null}]}],\"fullwidth\":false}]}',1,1,'',1,'2017-04-06 15:50:15','2017-06-28 16:13:01');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1,
  `price` decimal(19,4) NOT NULL DEFAULT '0.0000',
  `quantity` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `media_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_id` (`media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roleassignments`
--

DROP TABLE IF EXISTS `roleassignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roleassignments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `administrator_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roleassignments`
--

LOCK TABLES `roleassignments` WRITE;
/*!40000 ALTER TABLE `roleassignments` DISABLE KEYS */;
INSERT INTO `roleassignments` VALUES (30,3,1,NULL,NULL,'2017-07-04 14:19:09','2017-07-04 14:19:09');
/*!40000 ALTER TABLE `roleassignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET latin1 NOT NULL,
  `label` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'cms','CMS','2017-06-30 10:49:11','2017-06-30 10:50:35'),(3,'faire_un_truc','Faire un truc','2017-06-30 10:49:48','2017-06-30 10:49:48'),(4,'faire_ceci','Faire ceci','2017-06-30 10:50:51','2017-06-30 10:50:51'),(5,'faire_cela','Faire cela','2017-06-30 10:51:03','2017-06-30 10:51:03');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sites`
--

DROP TABLE IF EXISTS `sites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `host` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sites`
--

LOCK TABLES `sites` WRITE;
/*!40000 ALTER TABLE `sites` DISABLE KEYS */;
INSERT INTO `sites` VALUES (1,'LazyPHP','Site de LazyPHP','lazyphp.fixe','2017-04-16 12:27:46','2017-04-21 15:15:47',1),(2,'Site 1','','site1.fixe','2017-04-16 13:48:15','2017-04-21 15:19:21',1),(5,'Test 2','sqdqsd','test2.fixe','2017-04-21 17:07:20','2017-04-21 15:19:16',0);
/*!40000 ALTER TABLE `sites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` int(11) NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `delay` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sliders`
--

LOCK TABLES `sliders` WRITE;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `firstname` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email_verification_code` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `email_verification_date` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `address` text CHARACTER SET latin1,
  `media_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (5,'DANDOY','Loïc','ldandoy@gmail.com','$6$199337193b7024b3$TRIFwsRF9laQy/hxaZip20EzS2IAUwHyH66aiDq7k5QCE4j6BAdo7jK0gIzC17suC508WVLgvNRssDX9Ci2VF1','7N68HJZGH06NR0EN12XG2ET1NWAUTU','2017-04-01 14:27:15','test',NULL,NULL,0,'2017-04-01 14:27:15','2017-04-01 14:27:15'),(6,'User1_LastName','User1_FirstName','user1@test.com','$6$199337193b7024b3$/1WkTWdV.AlinR1bqySmT0XWFbshDeR8J066PymhbRWRJG0hcqCvlUXM/bG3RVlxXQ8rVpctmMb.qf7xgsXGE1','1DEBVOLIGR9J86DTVNIDK3W46OQPYU','2017-06-30 11:47:45',NULL,NULL,2,1,'2017-06-30 11:47:45','2017-06-30 11:58:30'),(7,'User2_LastName','User2_FirstName','user2@test.com','$6$199337193b7024b3$3GTR7q.ASkfoi.EvaITD5.6AQ2J5v8ChKmec0fpvCjEzXZKV5MiVal2mAXBBNV06kXqYydlfFCUWhB1x1oTZA.','OV3A35O6269NW8JE7HB50EF1MOJGK4','2017-06-30 11:50:57',NULL,NULL,2,1,'2017-06-30 11:50:57','2017-06-30 11:58:23');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widgets`
--

DROP TABLE IF EXISTS `widgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) CHARACTER SET latin1 NOT NULL,
  `type` varchar(255) CHARACTER SET latin1 NOT NULL,
  `app_widget` int(11) NOT NULL DEFAULT '0',
  `params` text CHARACTER SET latin1,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widgets`
--

LOCK TABLES `widgets` WRITE;
/*!40000 ALTER TABLE `widgets` DISABLE KEYS */;
INSERT INTO `widgets` VALUES (1,'Gallerie','gallery',0,'id','2017-05-26 16:18:15','2017-05-26 16:18:15');
/*!40000 ALTER TABLE `widgets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-04 14:24:57
