-- MySQL dump 10.13  Distrib 5.7.26, for Win64 (x86_64)
--
-- Host: localhost    Database: 777
-- ------------------------------------------------------
-- Server version	5.7.26

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
-- Table structure for table `admin_config`
--

DROP TABLE IF EXISTS `admin_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_config_name_unique` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_config`
--

LOCK TABLES `admin_config` WRITE;
/*!40000 ALTER TABLE `admin_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_menu`
--

DROP TABLE IF EXISTS `admin_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_menu`
--

LOCK TABLES `admin_menu` WRITE;
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` VALUES (1,0,1,'仪表盘','fa-bar-chart','/',NULL,NULL,NULL),(2,0,2,'后台管理','fa-tasks','',NULL,NULL,NULL),(3,2,3,'用户','fa-users','auth/users',NULL,NULL,NULL),(4,2,4,'角色','fa-user','auth/roles',NULL,NULL,NULL),(5,2,5,'权限','fa-ban','auth/permissions',NULL,NULL,NULL),(6,2,6,'菜单','fa-bars','auth/menu',NULL,NULL,NULL),(7,2,7,'操作日志','fa-history','auth/logs',NULL,NULL,NULL),(8,0,0,'文章','fa-bars','posts',NULL,'2021-05-21 18:27:19','2021-05-21 18:27:19');
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_operation_log`
--

DROP TABLE IF EXISTS `admin_operation_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_operation_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_operation_log_user_id_index` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_operation_log`
--

LOCK TABLES `admin_operation_log` WRITE;
/*!40000 ALTER TABLE `admin_operation_log` DISABLE KEYS */;
INSERT INTO `admin_operation_log` VALUES (1,1,'back-log/auth/login','POST','127.0.0.1','{\"username\":\"fuckkdmin\",\"password\":\"Fuck!kdmin\",\"remember\":\"1\",\"_token\":\"LjMxVKeHMvQxaBczyr4GEl0IY2e698WtU7qQUTbg\"}','2021-05-21 18:26:00','2021-05-21 18:26:00'),(2,1,'back-log/auth/login','GET','127.0.0.1','[]','2021-05-21 18:26:00','2021-05-21 18:26:00'),(3,1,'back-log','GET','127.0.0.1','[]','2021-05-21 18:26:00','2021-05-21 18:26:00'),(4,1,'back-log','GET','127.0.0.1','[]','2021-05-21 18:27:09','2021-05-21 18:27:09'),(5,1,'back-log/auth/menu','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2021-05-21 18:27:13','2021-05-21 18:27:13'),(6,1,'back-log/auth/menu','POST','127.0.0.1','{\"parent_id\":\"0\",\"title\":\"\\u6587\\u7ae0\",\"icon\":\"fa-bars\",\"uri\":\"posts\",\"roles\":[null],\"permission\":null,\"_token\":\"LjMxVKeHMvQxaBczyr4GEl0IY2e698WtU7qQUTbg\"}','2021-05-21 18:27:19','2021-05-21 18:27:19'),(7,1,'back-log/auth/menu','GET','127.0.0.1','[]','2021-05-21 18:27:19','2021-05-21 18:27:19'),(8,1,'back-log','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2021-05-21 18:27:21','2021-05-21 18:27:21'),(9,1,'back-log','GET','127.0.0.1','[]','2021-05-21 18:27:21','2021-05-21 18:27:21'),(10,1,'back-log','GET','127.0.0.1','[]','2021-05-21 18:27:21','2021-05-21 18:27:21'),(11,1,'back-log/posts','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2021-05-21 18:27:22','2021-05-21 18:27:22'),(12,1,'back-log/posts/create','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2021-05-21 18:27:23','2021-05-21 18:27:23'),(13,1,'back-log/posts/create','GET','127.0.0.1','[]','2021-05-21 18:28:03','2021-05-21 18:28:03'),(14,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"1.gif\",\"_token\":\"LjMxVKeHMvQxaBczyr4GEl0IY2e698WtU7qQUTbg\"}','2021-05-21 18:28:10','2021-05-21 18:28:10'),(15,1,'back-log/posts/create','GET','127.0.0.1','[]','2021-05-21 18:29:35','2021-05-21 18:29:35'),(16,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"1.gif\",\"_token\":\"LjMxVKeHMvQxaBczyr4GEl0IY2e698WtU7qQUTbg\"}','2021-05-21 18:29:43','2021-05-21 18:29:43'),(17,1,'back-log/posts/create','GET','127.0.0.1','[]','2021-05-21 18:29:47','2021-05-21 18:29:47'),(18,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"1.gif\",\"_token\":\"LjMxVKeHMvQxaBczyr4GEl0IY2e698WtU7qQUTbg\"}','2021-05-21 18:30:39','2021-05-21 18:30:39'),(19,1,'back-log/posts','POST','127.0.0.1','{\"title\":\"hahahahahaha\",\"content\":\"<p><img alt=\\\"1.gif\\\" src=\\\"http:\\/\\/666.showtime.test\\/storage\\/images\\/2021\\/05\\/22\\/\\/zIFTIG0ffI08VFDwhNAftdQi4SQKIQiOOoKVgDcb.gif\\\" width=\\\"700\\\" height=\\\"494\\\"><br><\\/p>\",\"hide_content\":\"<p>asdadsasdasd<\\/p>\",\"user_id\":\"0\",\"images\":null,\"category_alias\":\"gif\",\"post_status\":\"on\",\"view_count\":\"0\",\"sort\":\"0\",\"hot\":\"0\",\"need_coin\":\"0\",\"answer_id\":\"0\",\"_token\":\"LjMxVKeHMvQxaBczyr4GEl0IY2e698WtU7qQUTbg\"}','2021-05-21 18:30:47','2021-05-21 18:30:47'),(20,1,'back-log/posts','GET','127.0.0.1','[]','2021-05-21 18:30:48','2021-05-21 18:30:48'),(21,1,'back-log/posts','GET','127.0.0.1','[]','2021-05-21 18:30:55','2021-05-21 18:30:55'),(22,1,'back-log','GET','127.0.0.1','[]','2021-05-21 22:07:40','2021-05-21 22:07:40'),(23,1,'back-log/posts','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2021-05-21 22:07:42','2021-05-21 22:07:42'),(24,1,'back-log/posts/create','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2021-05-21 22:07:43','2021-05-21 22:07:43'),(25,1,'back-log/posts/create','GET','127.0.0.1','[]','2021-05-21 22:18:53','2021-05-21 22:18:53'),(26,1,'back-log/posts/create','GET','127.0.0.1','[]','2021-05-21 22:19:21','2021-05-21 22:19:21'),(27,1,'back-log/posts','POST','127.0.0.1','{\"title\":\"123\",\"content\":\"<p>123<\\/p>\",\"hide_content\":\"<p>123<\\/p>\",\"user_id\":\"0\",\"images\":null,\"category_alias\":\"gif\",\"post_status\":\"on\",\"view_count\":\"0\",\"sort\":\"0\",\"hot\":\"0\",\"need_coin\":\"0\",\"answer_id\":\"0\",\"tags\":[\"\\u8f66\\u724c\",\"\\u6296\\u97f3\",null],\"_token\":\"1yqd2qcZ2rcizukfLKXe1XtYzsE6Jkra4e37zkfA\"}','2021-05-21 22:19:34','2021-05-21 22:19:34'),(28,1,'back-log/posts/create','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2021-05-21 22:19:56','2021-05-21 22:19:56'),(29,1,'back-log/posts','POST','127.0.0.1','{\"title\":\"123\",\"content\":\"<p>123<\\/p>\",\"hide_content\":\"<p>123<\\/p>\",\"user_id\":\"0\",\"images\":null,\"category_alias\":\"gif\",\"post_status\":\"on\",\"view_count\":\"0\",\"sort\":\"0\",\"hot\":\"0\",\"need_coin\":\"0\",\"answer_id\":\"0\",\"tags\":[\"\\u8f66\\u724c\",\"\\u6296\\u97f3\",null],\"_token\":\"1yqd2qcZ2rcizukfLKXe1XtYzsE6Jkra4e37zkfA\"}','2021-05-21 22:20:03','2021-05-21 22:20:03'),(30,1,'back-log/posts','GET','127.0.0.1','[]','2021-05-21 22:20:03','2021-05-21 22:20:03'),(31,1,'back-log/posts/1/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2021-05-21 22:20:32','2021-05-21 22:20:32'),(32,1,'back-log/posts/1','PUT','127.0.0.1','{\"title\":\"123\",\"content\":\"<p>123<\\/p>\",\"hide_content\":\"<p>123<\\/p>\",\"user_id\":\"0\",\"images\":\"[]\",\"category_alias\":\"gif\",\"post_status\":\"on\",\"view_count\":\"0\",\"sort\":\"0\",\"hot\":\"0\",\"need_coin\":\"0\",\"answer_id\":\"0\",\"tags\":[\"\\u8f66\\u724c\",null],\"_token\":\"1yqd2qcZ2rcizukfLKXe1XtYzsE6Jkra4e37zkfA\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/666.showtime.test\\/back-log\\/posts\"}','2021-05-21 22:20:45','2021-05-21 22:20:45'),(33,1,'back-log/posts','GET','127.0.0.1','[]','2021-05-21 22:20:45','2021-05-21 22:20:45'),(34,1,'back-log/posts/1/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2021-05-21 22:20:48','2021-05-21 22:20:48'),(35,1,'back-log','GET','127.0.0.1','[]','2021-05-24 00:13:34','2021-05-24 00:13:34'),(36,1,'back-log/config','GET','127.0.0.1','[]','2021-05-24 00:15:19','2021-05-24 00:15:19'),(37,1,'back-log/posts','GET','127.0.0.1','[]','2021-05-24 22:51:29','2021-05-24 22:51:29'),(38,1,'back-log/posts/create','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2021-05-24 22:51:31','2021-05-24 22:51:31'),(39,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"1.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 22:51:43','2021-05-24 22:51:43'),(40,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"1.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 22:52:43','2021-05-24 22:52:43'),(41,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"1.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 22:53:06','2021-05-24 22:53:06'),(42,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"1.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 22:56:27','2021-05-24 22:56:27'),(43,1,'back-log/posts','POST','127.0.0.1','{\"title\":\"234\",\"content\":\"<p><img alt=\\\"1.gif\\\" src=\\\"http:\\/\\/666.showtime.test\\/storage\\/images\\/2021\\/05\\/25\\/\\/ldQYzIy5FZIjgUtCmqD7QT7z0Xdmkbam9c3aPEhz.gif\\\" width=\\\"700\\\" height=\\\"494\\\"><br><\\/p>\",\"hide_content\":\"<p>123<\\/p>\",\"user_id\":\"0\",\"images\":null,\"category_alias\":\"gif\",\"post_status\":\"on\",\"view_count\":\"0\",\"sort\":\"0\",\"hot\":\"0\",\"need_coin\":\"0\",\"answer_id\":\"0\",\"tags\":[null],\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\",\"_previous_\":\"http:\\/\\/666.showtime.test\\/back-log\\/posts\"}','2021-05-24 23:01:06','2021-05-24 23:01:06'),(44,1,'back-log/posts','GET','127.0.0.1','[]','2021-05-24 23:01:06','2021-05-24 23:01:06'),(45,1,'back-log/_handle_action_','POST','127.0.0.1','{\"_key\":\"1\",\"_model\":\"App_Models_Post\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\",\"_action\":\"Encore_Admin_Grid_Actions_Delete\",\"_input\":\"true\"}','2021-05-24 23:02:58','2021-05-24 23:02:58'),(46,1,'back-log/posts','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2021-05-24 23:02:59','2021-05-24 23:02:59'),(47,1,'back-log/posts/2/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2021-05-24 23:14:25','2021-05-24 23:14:25'),(48,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"2.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 23:14:31','2021-05-24 23:14:31'),(49,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"2.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 23:14:48','2021-05-24 23:14:48'),(50,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"2.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 23:16:33','2021-05-24 23:16:33'),(51,1,'back-log/posts/2/edit','GET','127.0.0.1','[]','2021-05-24 23:18:44','2021-05-24 23:18:44'),(52,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"2.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 23:18:50','2021-05-24 23:18:50'),(53,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"2.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 23:22:46','2021-05-24 23:22:46'),(54,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"2.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 23:23:26','2021-05-24 23:23:26'),(55,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"2.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 23:23:36','2021-05-24 23:23:36'),(56,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"2.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 23:29:49','2021-05-24 23:29:49'),(57,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"2.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 23:30:42','2021-05-24 23:30:42'),(58,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"2.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 23:37:59','2021-05-24 23:37:59'),(59,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"2.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 23:39:14','2021-05-24 23:39:14'),(60,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"2.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 23:40:30','2021-05-24 23:40:30'),(61,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"2.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 23:42:55','2021-05-24 23:42:55'),(62,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"2.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 23:44:21','2021-05-24 23:44:21'),(63,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"2.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 23:46:48','2021-05-24 23:46:48'),(64,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"2.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 23:47:42','2021-05-24 23:47:42'),(65,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"1.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 23:48:17','2021-05-24 23:48:17'),(66,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"1.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 23:48:59','2021-05-24 23:48:59'),(67,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"1.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 23:56:38','2021-05-24 23:56:38'),(68,1,'back-log/upload','POST','127.0.0.1','{\"original_filename\":\"1.gif\",\"_token\":\"Zb5QGp5Td3EsvdABRaui5hd9031o2krZexwOlcYk\"}','2021-05-24 23:57:27','2021-05-24 23:57:27'),(69,1,'back-log/posts/2/edit','GET','127.0.0.1','[]','2021-05-25 00:32:14','2021-05-25 00:32:14');
/*!40000 ALTER TABLE `admin_operation_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_permissions`
--

DROP TABLE IF EXISTS `admin_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_permissions_name_unique` (`name`),
  UNIQUE KEY `admin_permissions_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_permissions`
--

LOCK TABLES `admin_permissions` WRITE;
/*!40000 ALTER TABLE `admin_permissions` DISABLE KEYS */;
INSERT INTO `admin_permissions` VALUES (1,'All permission','*','','*',NULL,NULL),(2,'Dashboard','dashboard','GET','/',NULL,NULL),(3,'Login','auth.login','','/auth/login\r\n/auth/logout',NULL,NULL),(4,'User setting','auth.setting','GET,PUT','/auth/setting',NULL,NULL),(5,'Auth management','auth.management','','/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs',NULL,NULL);
/*!40000 ALTER TABLE `admin_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_role_menu`
--

DROP TABLE IF EXISTS `admin_role_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_menu_role_id_menu_id_index` (`role_id`,`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_role_menu`
--

LOCK TABLES `admin_role_menu` WRITE;
/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;
INSERT INTO `admin_role_menu` VALUES (1,2,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_role_permissions`
--

DROP TABLE IF EXISTS `admin_role_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_permissions_role_id_permission_id_index` (`role_id`,`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_role_permissions`
--

LOCK TABLES `admin_role_permissions` WRITE;
/*!40000 ALTER TABLE `admin_role_permissions` DISABLE KEYS */;
INSERT INTO `admin_role_permissions` VALUES (1,1,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_role_users`
--

DROP TABLE IF EXISTS `admin_role_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_role_users` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_users_role_id_user_id_index` (`role_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_role_users`
--

LOCK TABLES `admin_role_users` WRITE;
/*!40000 ALTER TABLE `admin_role_users` DISABLE KEYS */;
INSERT INTO `admin_role_users` VALUES (1,1,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_roles`
--

DROP TABLE IF EXISTS `admin_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_roles_name_unique` (`name`),
  UNIQUE KEY `admin_roles_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_roles`
--

LOCK TABLES `admin_roles` WRITE;
/*!40000 ALTER TABLE `admin_roles` DISABLE KEYS */;
INSERT INTO `admin_roles` VALUES (1,'Administrator','administrator','2021-05-21 18:25:07','2021-05-21 18:25:07');
/*!40000 ALTER TABLE `admin_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_user_permissions`
--

DROP TABLE IF EXISTS `admin_user_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_user_permissions` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_user_permissions_user_id_permission_id_index` (`user_id`,`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_user_permissions`
--

LOCK TABLES `admin_user_permissions` WRITE;
/*!40000 ALTER TABLE `admin_user_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_username_unique` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_users`
--

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` VALUES (1,'admin','$2y$10$d63x/Co2aazoCkFP9YXwwu4wuoMIj627As/zr1mBIRJspaeRmnCzS','Administrator',NULL,'bvRDiKIct67yaWFAMekn5qy3d3cTYVb8xL0g8oDE7ld3rCSTgOE3i2wpyJz1','2021-05-21 18:25:07','2021-05-21 18:25:07');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-25 16:57:50
