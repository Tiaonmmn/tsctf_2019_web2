create user 'tsctf'@'localhost' identified by 'tsctf';
create database caicaicms;
grant all privileges on caicaicms.* to 'tsctf'@'localhost';
flush privileges;
use caicaicms;

-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: caicaicms
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

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
-- Table structure for table `caicaicms_about`
--

DROP TABLE IF EXISTS `caicaicms_about`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_about` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(50) DEFAULT NULL,
  `content` longtext,
  `link` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_about`
--

LOCK TABLES `caicaicms_about` WRITE;
/*!40000 ALTER TABLE `caicaicms_about` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_about` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_ad`
--

DROP TABLE IF EXISTS `caicaicms_ad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `xuhao` int(11) NOT NULL DEFAULT '0',
  `title` char(50) DEFAULT NULL,
  `titlecolor` char(255) DEFAULT NULL,
  `link` char(255) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `bigclassname` char(50) DEFAULT NULL,
  `smallclassname` char(50) DEFAULT NULL,
  `username` char(50) DEFAULT NULL,
  `nextuser` char(50) DEFAULT NULL,
  `elite` tinyint(4) NOT NULL DEFAULT '0',
  `img` char(255) DEFAULT NULL,
  `starttime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_ad`
--

LOCK TABLES `caicaicms_ad` WRITE;
/*!40000 ALTER TABLE `caicaicms_ad` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_ad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_adclass`
--

DROP TABLE IF EXISTS `caicaicms_adclass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_adclass` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `classname` char(50) NOT NULL,
  `parentid` char(50) NOT NULL,
  `xuhao` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_adclass`
--

LOCK TABLES `caicaicms_adclass` WRITE;
/*!40000 ALTER TABLE `caicaicms_adclass` DISABLE KEYS */;
INSERT INTO `caicaicms_adclass` VALUES (1,'对联广告右侧','首页',0),(2,'对联广告左侧','首页',0),(3,'漂浮广告','首页',0),(4,'首页顶部','首页',0),(5,'品牌招商','首页',0),(6,'banner','首页',0),(7,'轮显广告','展会页',0),(8,'第二行','首页',0),(9,'轮显广告','首页',0),(10,'第一行','首页',0),(11,'B','首页',0),(12,'A','首页',0),(13,'首页','A',0);
/*!40000 ALTER TABLE `caicaicms_adclass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_admin`
--

DROP TABLE IF EXISTS `caicaicms_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) DEFAULT NULL,
  `admin` char(50) DEFAULT NULL,
  `pass` char(50) DEFAULT NULL,
  `logins` int(11) DEFAULT '0',
  `loginip` char(50) DEFAULT NULL,
  `lastlogintime` datetime DEFAULT NULL,
  `showloginip` char(50) DEFAULT NULL,
  `showlogintime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_admin`
--

LOCK TABLES `caicaicms_admin` WRITE;
/*!40000 ALTER TABLE `caicaicms_admin` DISABLE KEYS */;
INSERT INTO `caicaicms_admin` VALUES (1,1,'admin','21232f297a57a5a743894a0e4a801fc3',2,'10.1.220.100','2019-06-01 03:00:32','172.17.0.1','2019-06-01 02:55:10');
/*!40000 ALTER TABLE `caicaicms_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_admingroup`
--

DROP TABLE IF EXISTS `caicaicms_admingroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_admingroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupname` char(50) DEFAULT NULL,
  `config` varchar(1000) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_admingroup`
--

LOCK TABLES `caicaicms_admingroup` WRITE;
/*!40000 ALTER TABLE `caicaicms_admingroup` DISABLE KEYS */;
INSERT INTO `caicaicms_admingroup` VALUES (1,'超级管理员','zs#zs_modify#zs_del#zsclass#zskeyword#dl#dl_add#dl_modify#dl_del#guestbook#zh#zh_add#zh_modify#zh_del#zhclass#zx#zx_add#zx_modify#zx_del#zxclass#zxpinglun#zxtag#pp#pp_modify#pp_del#job#job_modify#job_del#jobclass#special#special_add#special_modify#special_del#specialclass#wangkan#wangkan_add#wangkan_modify#wangkan_del#wangkanclass#baojia#baojia_modify#baojia_del#ask#ask_add#ask_modify#ask_del#askclass#adv#adv_add#adv_modify#adv_del#advclass#adv_user#user#user_modify#user_del#usernoreg#userclass#usergroup#friendlink#friendlink_add#friendlink_modify#friendlink_del#about#about_add#about_modify#about_del#label#label_add#label_modify#label_del#licence#fankui#badusermessage#uploadfiles#sendmessage#sendmail#sendsms#announcement#helps#siteconfig#adminmanage#admingroup'),(2,'管理员(演示用)','zs#zs_modify#zskeyword#dl#dl_add#dl_modify#guestbook#zh#zh_add#zh_modify#zx#zx_add#zx_modify#zxpinglun#zxtag#pp#pp_modify#job#job_modify#special#special_add#special_modify#wangkan#wangkan_add#wangkan_modify#baojia#baojia_modify#ask#ask_add#ask_modify#adv#user#usernoreg#friendlink#about#label#licence#fankui#badusermessage#sendmessage#sendmail#sendsms');
/*!40000 ALTER TABLE `caicaicms_admingroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_answer`
--

DROP TABLE IF EXISTS `caicaicms_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `about` int(11) DEFAULT '0',
  `content` longtext,
  `face` char(50) DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `ip` char(50) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `caina` tinyint(4) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_answer`
--

LOCK TABLES `caicaicms_answer` WRITE;
/*!40000 ALTER TABLE `caicaicms_answer` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_ask`
--

DROP TABLE IF EXISTS `caicaicms_ask`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_ask` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bigclassid` int(11) DEFAULT NULL,
  `bigclassname` char(50) DEFAULT NULL,
  `smallclassid` int(11) DEFAULT NULL,
  `smallclassname` char(50) DEFAULT NULL,
  `title` char(50) DEFAULT NULL,
  `content` longtext,
  `img` char(255) DEFAULT NULL,
  `jifen` int(11) DEFAULT '0',
  `editor` char(50) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `hit` int(11) DEFAULT '0',
  `elite` tinyint(4) DEFAULT '0',
  `typeid` int(11) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `bigclassid` (`bigclassid`),
  KEY `bigclassid_2` (`bigclassid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_ask`
--

LOCK TABLES `caicaicms_ask` WRITE;
/*!40000 ALTER TABLE `caicaicms_ask` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_ask` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_askclass`
--

DROP TABLE IF EXISTS `caicaicms_askclass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_askclass` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) DEFAULT '0',
  `classname` char(50) DEFAULT NULL,
  `classzm` char(50) DEFAULT NULL,
  `img` char(50) DEFAULT NULL,
  `skin` char(50) DEFAULT NULL,
  `xuhao` int(11) DEFAULT '0',
  `isshow` tinyint(4) DEFAULT '1',
  `title` char(255) DEFAULT NULL,
  `keyword` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_askclass`
--

LOCK TABLES `caicaicms_askclass` WRITE;
/*!40000 ALTER TABLE `caicaicms_askclass` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_askclass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_bad`
--

DROP TABLE IF EXISTS `caicaicms_bad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_bad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(50) DEFAULT NULL,
  `ip` char(50) DEFAULT NULL,
  `dose` char(255) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `lockip` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_bad`
--

LOCK TABLES `caicaicms_bad` WRITE;
/*!40000 ALTER TABLE `caicaicms_bad` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_bad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_baojia`
--

DROP TABLE IF EXISTS `caicaicms_baojia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_baojia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classid` tinyint(4) DEFAULT '0',
  `cp` char(50) DEFAULT NULL,
  `province` char(50) DEFAULT NULL,
  `city` char(50) DEFAULT NULL,
  `xiancheng` char(50) DEFAULT NULL,
  `price` char(50) DEFAULT NULL,
  `danwei` char(50) DEFAULT NULL,
  `companyname` char(50) DEFAULT NULL,
  `truename` char(50) DEFAULT NULL,
  `address` char(50) DEFAULT NULL,
  `tel` char(50) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `ip` char(50) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `hit` int(11) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `province` (`province`,`city`,`xiancheng`),
  KEY `classid` (`classid`),
  KEY `province_2` (`province`,`city`,`xiancheng`),
  KEY `classid_2` (`classid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_baojia`
--

LOCK TABLES `caicaicms_baojia` WRITE;
/*!40000 ALTER TABLE `caicaicms_baojia` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_baojia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_dl`
--

DROP TABLE IF EXISTS `caicaicms_dl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_dl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classid` tinyint(4) DEFAULT '0',
  `cpid` int(11) DEFAULT '0',
  `cp` char(50) DEFAULT NULL,
  `province` char(50) DEFAULT NULL,
  `city` char(50) DEFAULT NULL,
  `xiancheng` char(50) DEFAULT NULL,
  `content` char(255) DEFAULT NULL,
  `company` char(50) DEFAULT NULL,
  `companyname` char(50) DEFAULT NULL,
  `dlsname` char(50) DEFAULT NULL,
  `address` char(255) DEFAULT NULL,
  `tel` char(50) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `saver` char(50) DEFAULT NULL,
  `savergroupid` int(11) DEFAULT '0',
  `ip` char(50) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `hit` int(11) DEFAULT '0',
  `looked` tinyint(4) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  `del` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `province` (`province`,`city`,`xiancheng`),
  KEY `classid` (`classid`),
  KEY `province_2` (`province`,`city`,`xiancheng`),
  KEY `classid_2` (`classid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_dl`
--

LOCK TABLES `caicaicms_dl` WRITE;
/*!40000 ALTER TABLE `caicaicms_dl` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_dl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_guestbook`
--

DROP TABLE IF EXISTS `caicaicms_guestbook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_guestbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(50) DEFAULT NULL,
  `content` longtext,
  `sendtime` datetime DEFAULT NULL,
  `linkmen` char(50) DEFAULT NULL,
  `phone` char(50) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `saver` char(50) DEFAULT NULL,
  `looked` tinyint(4) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_guestbook`
--

LOCK TABLES `caicaicms_guestbook` WRITE;
/*!40000 ALTER TABLE `caicaicms_guestbook` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_guestbook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_help`
--

DROP TABLE IF EXISTS `caicaicms_help`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_help` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classid` int(11) DEFAULT NULL,
  `title` char(50) DEFAULT NULL,
  `content` longtext,
  `img` char(255) DEFAULT NULL,
  `elite` tinyint(4) DEFAULT '0',
  `sendtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_help`
--

LOCK TABLES `caicaicms_help` WRITE;
/*!40000 ALTER TABLE `caicaicms_help` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_help` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_job`
--

DROP TABLE IF EXISTS `caicaicms_job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bigclassid` int(11) DEFAULT '0',
  `bigclassname` char(50) DEFAULT NULL,
  `smallclassid` int(11) DEFAULT '0',
  `smallclassname` char(50) DEFAULT NULL,
  `jobname` char(50) DEFAULT NULL,
  `province` char(50) DEFAULT NULL,
  `city` char(50) DEFAULT NULL,
  `xiancheng` char(50) DEFAULT NULL,
  `sm` varchar(1000) DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `comane` char(50) DEFAULT NULL,
  `userid` int(11) DEFAULT '0',
  `sendtime` datetime DEFAULT NULL,
  `hit` int(11) DEFAULT '0',
  `passed` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_job`
--

LOCK TABLES `caicaicms_job` WRITE;
/*!40000 ALTER TABLE `caicaicms_job` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_jobclass`
--

DROP TABLE IF EXISTS `caicaicms_jobclass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_jobclass` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `classname` char(50) DEFAULT NULL,
  `parentid` int(11) DEFAULT '0',
  `classzm` char(50) DEFAULT NULL,
  `img` char(50) DEFAULT NULL,
  `skin` char(50) DEFAULT NULL,
  `title` char(255) DEFAULT NULL,
  `keyword` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `xuhao` int(11) DEFAULT '0',
  `isshow` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_jobclass`
--

LOCK TABLES `caicaicms_jobclass` WRITE;
/*!40000 ALTER TABLE `caicaicms_jobclass` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_jobclass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_licence`
--

DROP TABLE IF EXISTS `caicaicms_licence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_licence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(50) DEFAULT NULL,
  `img` char(255) DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `passed` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_licence`
--

LOCK TABLES `caicaicms_licence` WRITE;
/*!40000 ALTER TABLE `caicaicms_licence` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_licence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_link`
--

DROP TABLE IF EXISTS `caicaicms_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bigclassid` int(11) DEFAULT '0',
  `sitename` char(50) DEFAULT NULL,
  `url` char(255) DEFAULT NULL,
  `content` char(255) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `logo` char(255) DEFAULT NULL,
  `elite` tinyint(4) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_link`
--

LOCK TABLES `caicaicms_link` WRITE;
/*!40000 ALTER TABLE `caicaicms_link` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_linkclass`
--

DROP TABLE IF EXISTS `caicaicms_linkclass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_linkclass` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `classname` char(50) DEFAULT NULL,
  `xuhao` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_linkclass`
--

LOCK TABLES `caicaicms_linkclass` WRITE;
/*!40000 ALTER TABLE `caicaicms_linkclass` DISABLE KEYS */;
INSERT INTO `caicaicms_linkclass` VALUES (1,'合作网站',0),(2,'友链网站',0);
/*!40000 ALTER TABLE `caicaicms_linkclass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_login_times`
--

DROP TABLE IF EXISTS `caicaicms_login_times`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_login_times` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` char(50) DEFAULT NULL,
  `count` int(11) DEFAULT '0',
  `sendtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_login_times`
--

LOCK TABLES `caicaicms_login_times` WRITE;
/*!40000 ALTER TABLE `caicaicms_login_times` DISABLE KEYS */;
INSERT INTO `caicaicms_login_times` VALUES (1,'10.1.220.100',2,'2019-06-01 03:59:05'),(2,'127.0.0.1',2,'2019-06-01 03:48:08');
/*!40000 ALTER TABLE `caicaicms_login_times` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_looked_dls`
--

DROP TABLE IF EXISTS `caicaicms_looked_dls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_looked_dls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dlsid` int(11) DEFAULT NULL,
  `username` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_looked_dls`
--

LOCK TABLES `caicaicms_looked_dls` WRITE;
/*!40000 ALTER TABLE `caicaicms_looked_dls` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_looked_dls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_looked_dls_number_oneday`
--

DROP TABLE IF EXISTS `caicaicms_looked_dls_number_oneday`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_looked_dls_number_oneday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `looked_dls_number_oneday` int(11) DEFAULT NULL,
  `username` char(50) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_looked_dls_number_oneday`
--

LOCK TABLES `caicaicms_looked_dls_number_oneday` WRITE;
/*!40000 ALTER TABLE `caicaicms_looked_dls_number_oneday` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_looked_dls_number_oneday` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_main`
--

DROP TABLE IF EXISTS `caicaicms_main`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_main` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `proname` char(50) DEFAULT NULL,
  `link` char(255) DEFAULT NULL,
  `szm` char(100) DEFAULT NULL,
  `prouse` char(255) DEFAULT NULL,
  `procompany` char(50) DEFAULT NULL,
  `tz` char(25) DEFAULT NULL,
  `sm` text,
  `xuhao` int(4) DEFAULT NULL,
  `bigclassid` tinyint(4) DEFAULT '0',
  `smallclassid` tinyint(4) DEFAULT '0',
  `smallclassids` char(50) DEFAULT NULL,
  `img` char(255) DEFAULT NULL,
  `flv` char(255) DEFAULT NULL,
  `province` char(50) DEFAULT NULL,
  `city` char(50) DEFAULT NULL,
  `xiancheng` char(50) DEFAULT NULL,
  `province_user` char(50) DEFAULT NULL,
  `city_user` char(50) DEFAULT NULL,
  `xiancheng_user` char(50) DEFAULT NULL,
  `zc` char(255) DEFAULT NULL,
  `yq` char(255) DEFAULT NULL,
  `other` char(255) DEFAULT NULL,
  `shuxing_value` char(255) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `timefororder` char(50) DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `elitestarttime` datetime DEFAULT NULL,
  `eliteendtime` datetime DEFAULT NULL,
  `title` char(255) DEFAULT NULL,
  `keywords` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `refresh` int(11) DEFAULT '0',
  `hit` int(11) DEFAULT '0',
  `elite` tinyint(4) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  `userid` int(11) DEFAULT '0',
  `comane` char(255) DEFAULT NULL,
  `qq` char(50) DEFAULT NULL,
  `groupid` int(11) DEFAULT '0',
  `renzheng` tinyint(4) DEFAULT '0',
  `ppid` int(11) DEFAULT '0',
  `gjzpm` tinyint(4) DEFAULT '0',
  `tag` char(255) DEFAULT NULL,
  `skin` char(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `province` (`province`,`city`,`xiancheng`),
  KEY `bigclassid` (`bigclassid`),
  KEY `province_2` (`province`,`city`,`xiancheng`),
  KEY `bigclassid_2` (`bigclassid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_main`
--

LOCK TABLES `caicaicms_main` WRITE;
/*!40000 ALTER TABLE `caicaicms_main` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_main` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_message`
--

DROP TABLE IF EXISTS `caicaicms_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(50) DEFAULT NULL,
  `content` char(255) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `sendto` char(50) NOT NULL,
  `looked` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_message`
--

LOCK TABLES `caicaicms_message` WRITE;
/*!40000 ALTER TABLE `caicaicms_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_msg`
--

DROP TABLE IF EXISTS `caicaicms_msg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(1000) NOT NULL,
  `elite` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_msg`
--

LOCK TABLES `caicaicms_msg` WRITE;
/*!40000 ALTER TABLE `caicaicms_msg` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_msg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_pay`
--

DROP TABLE IF EXISTS `caicaicms_pay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(50) DEFAULT NULL,
  `dowhat` char(50) DEFAULT NULL,
  `RMB` char(50) DEFAULT '0',
  `mark` char(255) DEFAULT NULL,
  `sendtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_pay`
--

LOCK TABLES `caicaicms_pay` WRITE;
/*!40000 ALTER TABLE `caicaicms_pay` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_pay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_pinglun`
--

DROP TABLE IF EXISTS `caicaicms_pinglun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_pinglun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `about` int(11) DEFAULT '0',
  `content` char(255) DEFAULT NULL,
  `face` char(50) DEFAULT NULL,
  `username` char(50) DEFAULT NULL,
  `ip` char(50) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `passed` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_pinglun`
--

LOCK TABLES `caicaicms_pinglun` WRITE;
/*!40000 ALTER TABLE `caicaicms_pinglun` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_pinglun` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_pp`
--

DROP TABLE IF EXISTS `caicaicms_pp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_pp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ppname` char(255) DEFAULT NULL,
  `bigclassid` tinyint(4) DEFAULT '0',
  `smallclassid` tinyint(4) DEFAULT '0',
  `sm` longtext,
  `img` char(255) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `comane` char(50) DEFAULT NULL,
  `userid` int(11) DEFAULT '0',
  `hit` int(11) DEFAULT '0',
  `passed` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `bigclassid` (`bigclassid`),
  KEY `bigclassid_2` (`bigclassid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_pp`
--

LOCK TABLES `caicaicms_pp` WRITE;
/*!40000 ALTER TABLE `caicaicms_pp` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_pp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_special`
--

DROP TABLE IF EXISTS `caicaicms_special`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_special` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bigclassid` int(11) DEFAULT NULL,
  `bigclassname` char(50) DEFAULT NULL,
  `smallclassid` int(11) DEFAULT NULL,
  `smallclassname` char(50) DEFAULT NULL,
  `title` char(50) DEFAULT NULL,
  `link` char(255) DEFAULT NULL,
  `laiyuan` char(50) DEFAULT NULL,
  `keywords` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `content` longtext,
  `img` char(255) DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `hit` int(11) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  `elite` tinyint(4) DEFAULT '0',
  `groupid` int(11) DEFAULT '1',
  `jifen` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `bigclassid` (`bigclassid`),
  KEY `bigclassid_2` (`bigclassid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_special`
--

LOCK TABLES `caicaicms_special` WRITE;
/*!40000 ALTER TABLE `caicaicms_special` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_special` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_specialclass`
--

DROP TABLE IF EXISTS `caicaicms_specialclass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_specialclass` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `classname` char(50) DEFAULT NULL,
  `classzm` char(50) DEFAULT NULL,
  `img` char(50) DEFAULT NULL,
  `skin` char(50) DEFAULT NULL,
  `parentid` int(11) DEFAULT '0',
  `xuhao` int(11) DEFAULT '0',
  `isshow` tinyint(4) DEFAULT '1',
  `title` char(255) DEFAULT NULL,
  `keyword` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_specialclass`
--

LOCK TABLES `caicaicms_specialclass` WRITE;
/*!40000 ALTER TABLE `caicaicms_specialclass` DISABLE KEYS */;
INSERT INTO `caicaicms_specialclass` VALUES (1,'2015广西药交会','','','',0,0,1,'','',''),(2,'访谈','','','',1,1,1,'','',''),(3,'名企直击','','','',1,1,1,'','',''),(4,'展会现场','','','',1,1,1,'','',''),(5,'展会简介','','','',1,1,1,'','',''),(6,'大背景图','','','',1,1,1,'','','');
/*!40000 ALTER TABLE `caicaicms_specialclass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_tagzs`
--

DROP TABLE IF EXISTS `caicaicms_tagzs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_tagzs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` char(50) DEFAULT NULL,
  `url` char(50) DEFAULT NULL,
  `xuhao` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_tagzs`
--

LOCK TABLES `caicaicms_tagzs` WRITE;
/*!40000 ALTER TABLE `caicaicms_tagzs` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_tagzs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_tagzx`
--

DROP TABLE IF EXISTS `caicaicms_tagzx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_tagzx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `xuhao` int(11) DEFAULT '0',
  `keyword` char(50) DEFAULT NULL,
  `url` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_tagzx`
--

LOCK TABLES `caicaicms_tagzx` WRITE;
/*!40000 ALTER TABLE `caicaicms_tagzx` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_tagzx` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_textadv`
--

DROP TABLE IF EXISTS `caicaicms_textadv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_textadv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adv` char(50) DEFAULT NULL,
  `company` char(50) NOT NULL,
  `advlink` char(50) DEFAULT NULL,
  `img` char(255) DEFAULT NULL,
  `username` char(50) DEFAULT NULL,
  `gxsj` datetime DEFAULT NULL,
  `newsid` int(11) NOT NULL DEFAULT '0',
  `passed` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `adv` (`adv`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_textadv`
--

LOCK TABLES `caicaicms_textadv` WRITE;
/*!40000 ALTER TABLE `caicaicms_textadv` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_textadv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_user`
--

DROP TABLE IF EXISTS `caicaicms_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(50) NOT NULL,
  `password` char(50) NOT NULL,
  `passwordtrue` char(50) DEFAULT NULL,
  `qqid` char(50) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `sex` char(50) DEFAULT NULL,
  `comane` char(50) DEFAULT NULL,
  `content` longtext,
  `bigclassid` int(11) DEFAULT '0',
  `smallclassid` int(11) DEFAULT '0',
  `province` char(50) DEFAULT NULL,
  `city` char(50) DEFAULT NULL,
  `xiancheng` char(50) DEFAULT NULL,
  `img` char(255) DEFAULT NULL,
  `flv` char(255) DEFAULT NULL,
  `address` char(100) DEFAULT NULL,
  `somane` char(50) DEFAULT NULL,
  `phone` char(50) DEFAULT NULL,
  `mobile` char(50) DEFAULT NULL,
  `fox` char(50) DEFAULT NULL,
  `qq` char(50) DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  `loginip` char(50) DEFAULT NULL,
  `logins` int(11) NOT NULL DEFAULT '0',
  `homepage` char(50) DEFAULT NULL,
  `lastlogintime` datetime DEFAULT NULL,
  `lockuser` tinyint(4) NOT NULL DEFAULT '0',
  `groupid` int(11) NOT NULL DEFAULT '1',
  `totleRMB` int(11) NOT NULL DEFAULT '0',
  `startdate` datetime DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `showloginip` char(50) DEFAULT NULL,
  `showlogintime` datetime DEFAULT NULL,
  `elite` tinyint(4) NOT NULL DEFAULT '0',
  `renzheng` tinyint(4) NOT NULL DEFAULT '0',
  `usersf` char(20) DEFAULT NULL,
  `passed` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_user`
--

LOCK TABLES `caicaicms_user` WRITE;
/*!40000 ALTER TABLE `caicaicms_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_userclass`
--

DROP TABLE IF EXISTS `caicaicms_userclass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_userclass` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) DEFAULT '0',
  `classname` char(50) NOT NULL,
  `classzm` char(50) DEFAULT NULL,
  `img` char(50) DEFAULT NULL,
  `skin` char(50) DEFAULT NULL,
  `title` char(255) DEFAULT NULL,
  `keyword` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `isshow` tinyint(4) DEFAULT '0',
  `xuhao` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_userclass`
--

LOCK TABLES `caicaicms_userclass` WRITE;
/*!40000 ALTER TABLE `caicaicms_userclass` DISABLE KEYS */;
INSERT INTO `caicaicms_userclass` VALUES (1,0,'生产单位','','','','','','',1,0),(2,0,'经销单位','','','','','','',1,0),(4,0,'展会承办单位','','','','','','',1,0),(5,0,'其它相关行业','','','','','','',1,0);
/*!40000 ALTER TABLE `caicaicms_userclass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_userdomain`
--

DROP TABLE IF EXISTS `caicaicms_userdomain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_userdomain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(50) DEFAULT NULL,
  `domain` char(50) DEFAULT NULL,
  `passed` tinyint(4) DEFAULT '0',
  `del` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_userdomain`
--

LOCK TABLES `caicaicms_userdomain` WRITE;
/*!40000 ALTER TABLE `caicaicms_userdomain` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_userdomain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_usergroup`
--

DROP TABLE IF EXISTS `caicaicms_usergroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_usergroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL DEFAULT '1',
  `groupname` char(50) NOT NULL,
  `grouppic` char(50) NOT NULL,
  `RMB` int(11) NOT NULL DEFAULT '0',
  `config` varchar(1000) NOT NULL DEFAULT '0',
  `looked_dls_number_oneday` int(11) NOT NULL DEFAULT '0',
  `refresh_number` int(11) NOT NULL DEFAULT '0',
  `addinfo_number` int(11) NOT NULL DEFAULT '0',
  `addinfototle_number` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_usergroup`
--

LOCK TABLES `caicaicms_usergroup` WRITE;
/*!40000 ALTER TABLE `caicaicms_usergroup` DISABLE KEYS */;
INSERT INTO `caicaicms_usergroup` VALUES (1,1,'普通会员','/image/level1.gif',0,'showad_inzt',10,1,50,100),(2,2,'vip会员','/image/level2.gif',1999,'look_dls_data#look_dls_liuyan',100,3,100,500),(3,3,'高级会员','/image/level3.gif',2999,'look_dls_data#look_dls_liuyan',999,999,999,999);
/*!40000 ALTER TABLE `caicaicms_usergroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_usermessage`
--

DROP TABLE IF EXISTS `caicaicms_usermessage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_usermessage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(50) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `reply` varchar(255) DEFAULT NULL,
  `replytime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_usermessage`
--

LOCK TABLES `caicaicms_usermessage` WRITE;
/*!40000 ALTER TABLE `caicaicms_usermessage` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_usermessage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_usernoreg`
--

DROP TABLE IF EXISTS `caicaicms_usernoreg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_usernoreg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usersf` char(50) DEFAULT NULL,
  `username` char(50) NOT NULL,
  `password` char(50) DEFAULT NULL,
  `comane` char(50) DEFAULT NULL,
  `kind` int(11) NOT NULL DEFAULT '0',
  `somane` char(50) DEFAULT NULL,
  `phone` char(50) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `checkcode` char(50) DEFAULT NULL,
  `regdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_usernoreg`
--

LOCK TABLES `caicaicms_usernoreg` WRITE;
/*!40000 ALTER TABLE `caicaicms_usernoreg` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_usernoreg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_usersetting`
--

DROP TABLE IF EXISTS `caicaicms_usersetting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_usersetting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(50) DEFAULT NULL,
  `skin` char(50) DEFAULT '1',
  `skin_mobile` char(50) DEFAULT '1',
  `tongji` char(255) DEFAULT NULL,
  `baidu_map` char(50) DEFAULT NULL,
  `mobile` char(50) DEFAULT NULL,
  `daohang` char(50) DEFAULT NULL,
  `bannerbg` char(50) DEFAULT NULL,
  `bannerheight` int(11) NOT NULL DEFAULT '160',
  `comanestyle` char(50) DEFAULT NULL,
  `comanecolor` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_usersetting`
--

LOCK TABLES `caicaicms_usersetting` WRITE;
/*!40000 ALTER TABLE `caicaicms_usersetting` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_usersetting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_wangkan`
--

DROP TABLE IF EXISTS `caicaicms_wangkan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_wangkan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bigclassid` int(11) DEFAULT NULL,
  `title` char(50) DEFAULT NULL,
  `content` longtext,
  `img` char(255) DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `hit` int(11) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  `elite` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_wangkan`
--

LOCK TABLES `caicaicms_wangkan` WRITE;
/*!40000 ALTER TABLE `caicaicms_wangkan` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_wangkan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_wangkanclass`
--

DROP TABLE IF EXISTS `caicaicms_wangkanclass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_wangkanclass` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `classname` char(50) DEFAULT NULL,
  `xuhao` int(11) DEFAULT '0',
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_wangkanclass`
--

LOCK TABLES `caicaicms_wangkanclass` WRITE;
/*!40000 ALTER TABLE `caicaicms_wangkanclass` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_wangkanclass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_zh`
--

DROP TABLE IF EXISTS `caicaicms_zh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_zh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bigclassid` int(11) DEFAULT NULL,
  `title` char(50) DEFAULT NULL,
  `address` char(100) DEFAULT NULL,
  `timestart` datetime DEFAULT NULL,
  `timeend` datetime DEFAULT NULL,
  `content` longtext,
  `editor` char(50) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `hit` int(11) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  `elite` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_zh`
--

LOCK TABLES `caicaicms_zh` WRITE;
/*!40000 ALTER TABLE `caicaicms_zh` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_zh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_zhclass`
--

DROP TABLE IF EXISTS `caicaicms_zhclass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_zhclass` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `classname` char(50) DEFAULT NULL,
  `xuhao` int(11) DEFAULT '0',
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_zhclass`
--

LOCK TABLES `caicaicms_zhclass` WRITE;
/*!40000 ALTER TABLE `caicaicms_zhclass` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_zhclass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_zsclass`
--

DROP TABLE IF EXISTS `caicaicms_zsclass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_zsclass` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) NOT NULL DEFAULT '0',
  `classname` char(50) NOT NULL,
  `classzm` char(50) DEFAULT NULL,
  `img` char(50) NOT NULL DEFAULT '0',
  `skin` char(50) DEFAULT NULL,
  `xuhao` int(11) NOT NULL DEFAULT '0',
  `title` char(255) DEFAULT NULL,
  `keyword` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `isshow` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_zsclass`
--

LOCK TABLES `caicaicms_zsclass` WRITE;
/*!40000 ALTER TABLE `caicaicms_zsclass` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_zsclass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_ztad`
--

DROP TABLE IF EXISTS `caicaicms_ztad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_ztad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classname` char(50) DEFAULT NULL,
  `title` char(50) DEFAULT NULL,
  `link` char(255) DEFAULT NULL,
  `img` char(255) DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `passed` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_ztad`
--

LOCK TABLES `caicaicms_ztad` WRITE;
/*!40000 ALTER TABLE `caicaicms_ztad` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_ztad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_zx`
--

DROP TABLE IF EXISTS `caicaicms_zx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_zx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bigclassid` int(11) DEFAULT NULL,
  `bigclassname` char(50) DEFAULT NULL,
  `smallclassid` int(11) DEFAULT NULL,
  `smallclassname` char(50) DEFAULT NULL,
  `title` char(50) DEFAULT NULL,
  `link` char(255) DEFAULT NULL,
  `laiyuan` char(50) DEFAULT NULL,
  `keywords` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `content` longtext,
  `img` char(255) DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `hit` int(11) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  `elite` tinyint(4) DEFAULT '0',
  `groupid` int(11) DEFAULT '1',
  `jifen` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `bigclassid` (`bigclassid`),
  KEY `bigclassid_2` (`bigclassid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_zx`
--

LOCK TABLES `caicaicms_zx` WRITE;
/*!40000 ALTER TABLE `caicaicms_zx` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_zx` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caicaicms_zxclass`
--

DROP TABLE IF EXISTS `caicaicms_zxclass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caicaicms_zxclass` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) DEFAULT '0',
  `classname` char(50) DEFAULT NULL,
  `classzm` char(50) DEFAULT NULL,
  `img` char(50) DEFAULT NULL,
  `skin` char(50) DEFAULT NULL,
  `xuhao` int(11) DEFAULT '0',
  `isshow` tinyint(4) DEFAULT '1',
  `title` char(255) DEFAULT NULL,
  `keyword` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caicaicms_zxclass`
--

LOCK TABLES `caicaicms_zxclass` WRITE;
/*!40000 ALTER TABLE `caicaicms_zxclass` DISABLE KEYS */;
/*!40000 ALTER TABLE `caicaicms_zxclass` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-31 20:19:58
