-- MariaDB dump 10.19  Distrib 10.5.21-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: silver_screen
-- ------------------------------------------------------
-- Server version	10.5.21-MariaDB-0+deb11u1

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
-- Current Database: `silver_screen`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `silver_screen1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `silver_screen1`;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_movie_id` int(11) DEFAULT NULL,
  `comment_user_id` int(11) DEFAULT NULL,
  `comment_username` varchar(255) DEFAULT NULL,
  `comment_avatar` varchar(255) DEFAULT NULL,
  `comment_text` longtext DEFAULT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `comment_movie_id` (`comment_movie_id`),
  KEY `comment_user_id` (`comment_user_id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`comment_movie_id`) REFERENCES `movies` (`movie_id`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`comment_user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,5,1,'admin','651d5953ccd96_324017406_469004508758904_5932528951960013059_n.jpg','awesome'),(2,4,1,'admin','651d5953ccd96_324017406_469004508758904_5932528951960013059_n.jpg','test comment'),(3,4,1,'admin','651d5953ccd96_324017406_469004508758904_5932528951960013059_n.jpg','please upload mission impossible'),(4,6,1,'admin','651d5953ccd96_324017406_469004508758904_5932528951960013059_n.jpg','this is comment'),(5,5,1,'admin','651d5953ccd96_324017406_469004508758904_5932528951960013059_n.jpg','this is comment'),(6,7,1,'admin','651d5953ccd96_324017406_469004508758904_5932528951960013059_n.jpg','this is comment'),(7,9,1,'admin','651d5953ccd96_324017406_469004508758904_5932528951960013059_n.jpg','herr mero comment'),(8,3,7,'rikesh','6560494ad2b91_Screenshot 2023-05-13 154456.png','qwertyu'),(9,1,1,'admin','651d5953ccd96_324017406_469004508758904_5932528951960013059_n.jpg','Aewsome');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL AUTO_INCREMENT,
  `movie_name` varchar(255) DEFAULT NULL,
  `movie_upload_name` varchar(255) DEFAULT NULL,
  `movie_upload_image` varchar(255) DEFAULT NULL,
  `movie_description` longtext DEFAULT NULL,
  `movie_genre` varchar(255) DEFAULT NULL,
  `movie_subscription` varchar(255) DEFAULT NULL,
  `release_date` varchar(255) DEFAULT NULL,
  `movie_language` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`movie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movies`
--

LOCK TABLES `movies` WRITE;
/*!40000 ALTER TABLE `movies` DISABLE KEYS */;
INSERT INTO `movies` VALUES (1,'movie_test','651d7112c4aa8_242468465_594261368247553_2322973193556881581_n.mp4','651d7112c4946_272999124_3180732085582625_6391622957893453487_n.jpg','This is descri[tion','Action','free','2023','nepali'),(2,'Carla Brock','651d7724e4377_2022-09-26_20-20-10.mp4','651d7724e427a_280752917_688300048897747_4471061614589813199_n.jpg','Consequat Expedita ','Drama','free','27-Apr-2011','Qui nostrum ipsum vo'),(3,'Dawn Mann','651d77417f398_335888522_1158628708134306_5783167234078438848_n (1).mp4','651d77417f1e4_313018198_577233477537424_1416717656470396202_n.jpg','Inventore ad tempora','Comedy','free','04-May-2017','Dolorum maxime rerum'),(4,'Noah Shannon','651d775a63afc_349016056_813979160084075_2209021640985995234_n.mp4','651d775a639ea_319560288_6327084213971570_8892882654511116947_n.jpg','Voluptate cumque vel','Action','free','17-May-1986','Officia quia anim eu'),(5,'Damon Battle','651d7772ce0e2_vlc-record-2023-03-13-21h32m59s-Timid Tabby -Tom & Jerry SuperCartoons.mp4-.mp4','651d7772ce00c_344349355_625429062440856_7061349186950783311_n.jpg','Qui irure minima ali','Adventure','free','21-Jul-1973','Quod reiciendis esse'),(6,'Amery Berry','651d8913be1dd_331411521_164324416475745_5915473970060853601_n.mp4','651d8913be106_337880594_810880610469519_803996174794976070_n.jpg','Deleniti corporis la','Drama','free','06-Aug-2021','Nesciunt pariatur '),(7,'test movie 123','651e342deb0d8_319226934_521584639905418_5340707859004247823_n.mp4','651e342deb012_324925924_1446227429117311_3271049359093216385_n.jpg','this is description of id 6','Action','premium','2023','newari'),(9,'Movie test 123','6560055407472_332418708_792904275525931_5201284926891529333_n.mp4','65600554068f0_323334678_1485812545277031_1622538820601876999_n.jpg','This is based on romantic movie','Comedy','free','2023','Hindi'),(10,'Mission Impossible','656d9ef4ef8c7_329417712_725898178883636_4716835437640179956_n.mp4','656d9ef4ef403_gerbera_flowers_bouquet_5k-5120x2880-1221704523.jpg','Mission impossibe 2023 Action movie','Action','free','2023','Nepali');
/*!40000 ALTER TABLE `movies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rating` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `review_movie_id` int(11) DEFAULT NULL,
  `review_user_id` int(11) DEFAULT NULL,
  `review_score` int(11) DEFAULT NULL,
  PRIMARY KEY (`review_id`),
  KEY `review_movie_id` (`review_movie_id`),
  KEY `review_user_id` (`review_user_id`),
  CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`review_movie_id`) REFERENCES `movies` (`movie_id`),
  CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`review_user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating`
--

LOCK TABLES `rating` WRITE;
/*!40000 ALTER TABLE `rating` DISABLE KEYS */;
INSERT INTO `rating` VALUES (1,6,1,4),(2,5,1,5),(3,7,1,2),(5,3,7,3),(6,1,1,4),(7,1,8,3),(8,6,8,5),(9,10,1,5);
/*!40000 ALTER TABLE `rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `flag_admin` varchar(255) DEFAULT NULL,
  `flag_premium` varchar(255) DEFAULT NULL,
  `premium_transaction` varchar(255) DEFAULT NULL,
  `expire_premium` date DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','5f4dcc3b5aa765d61d8327deb882cf99','admin@gmail.com','9876543210','651d5953ccd96_324017406_469004508758904_5932528951960013059_n.jpg','1','premium','qwerty','2023-10-04'),(2,'pugyqypy','f3ed11bbdb94fd9ebdefbaf646ab94d3','vymizymuq@mailinator.com','9841327003','651d5f7723d8f_336238300_742341984160201_1183180336652973478_n.jpg','0','free',NULL,'2023-10-04'),(3,'root','f3ed11bbdb94fd9ebdefbaf646ab94d3','tst_ghj@gmail.com','963147','651e37aabbf23_325576302_1556763874805044_283565963488937669_n.jpg','1','free',NULL,'2023-10-04'),(6,'lol','9cdfb439c7876e703e307864c9167a15','lol@q.q','9632581470','655ff628549d0_82chhm.jpg','0','free',NULL,'2023-11-24'),(7,'rikesh','202cb962ac59075b964b07152d234b70','123@gmail.com','9861447785','6560494ad2b91_Screenshot 2023-05-13 154456.png','0','free',NULL,'2023-11-24'),(8,'sushan','5f4dcc3b5aa765d61d8327deb882cf99','sushan@gmail.com','986520023','656d9a6174b75_52109756.jpeg','0','free',NULL,'2023-12-04');
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

-- Dump completed on 2023-12-04 16:14:04
