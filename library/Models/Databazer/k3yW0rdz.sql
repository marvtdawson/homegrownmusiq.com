-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: rad1oHoGoMusZ09
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

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
-- Table structure for table `k3yW0rdz`
--

DROP TABLE IF EXISTS `k3yW0rdz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `k3yW0rdz` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `keywords_Type` enum('corePages','cPanPages') DEFAULT NULL,
  `pages_Keywords` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `k3yW0rdz`
--

LOCK TABLES `k3yW0rdz` WRITE;
/*!40000 ALTER TABLE `k3yW0rdz` DISABLE KEYS */;
INSERT INTO `k3yW0rdz` VALUES (1,'corePages','\"Marvin Dawson, Marvin Dawson Web Developer, African, African American, African American Owned Web Company, \n                                    Black, Black Owned, Black Owned Web Company, Google, Android, mobile, app, phone, cell phone, application, \n                                    design, whos laundry, notifications, Google Play Market, Apple Store, FREE, Home Grown Mobile Design LLC, iPhone, \n                                    iOS, iPad, responsive site, responsive web sites, Google Developer, CMS, CMS Made Simple, WordPress, osCommerce, \n                                    Magento, web hosting, web developer, web development, custom web sites, customize web site, custom cPanel, professional site,\n                                    industrial web site developer, site developer, SEO, PHP, HTML, HTML5, CSS, CSS3, Bootstrap, Javascript, jQuery, \n                                    Angular, Node, Ember, Cordova, AJAX, XML, JSON, Actionscript3, MySQL, Linux, LAMP, LAMP Stack, GIT, GITHUB,\n                                    PuTTY, Adobe Creative Cloud, Dreamweaver, Zend Studio, eClipse, Netbeans, JAVA, ASP_NET, Number One Black Owned Web Firm, \n                                    Number One, Best Black Owned Web Firm, Number One Afican American Web Firm, Best African American Owned Web Firm\"'),(2,'cPanPages','Pro Tools, Avid');
/*!40000 ALTER TABLE `k3yW0rdz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'rad1oHoGoMusZ09'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-13 11:43:24
