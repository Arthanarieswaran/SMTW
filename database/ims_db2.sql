-- MySQL dump 10.13  Distrib 8.0.20, for Linux (x86_64)
--
-- Host: localhost    Database: ims_db
-- ------------------------------------------------------
-- Server version	8.0.20-0ubuntu0.19.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attribute_value`
--

DROP TABLE IF EXISTS `attribute_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attribute_value` (
  `id` int NOT NULL AUTO_INCREMENT,
  `value` varchar(255) NOT NULL,
  `attribute_parent_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attribute_value`
--

LOCK TABLES `attribute_value` WRITE;
/*!40000 ALTER TABLE `attribute_value` DISABLE KEYS */;
INSERT INTO `attribute_value` VALUES (5,'Blue',2),(6,'White',2),(7,'M',3),(8,'L',3),(9,'Green',2),(10,'Black',2),(12,'Grey',2),(13,'S',3),(17,'yellow',4),(20,'small',6),(21,'medium',6),(22,'large',6);
/*!40000 ALTER TABLE `attribute_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attributes`
--

DROP TABLE IF EXISTS `attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attributes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `active` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attributes`
--

LOCK TABLES `attributes` WRITE;
/*!40000 ALTER TABLE `attributes` DISABLE KEYS */;
INSERT INTO `attributes` VALUES (4,'color',1),(6,'Size',1);
/*!40000 ALTER TABLE `attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `active` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (15,'Computer',1),(16,'Clothes',1),(17,'Mobile',1),(19,'Sample',1);
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `active` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (7,'JSW Sheets',1),(8,'Everest Cement Sheet',1),(9,'Square Pipes',1);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `service_charge_value` varchar(255) NOT NULL,
  `vat_charge_value` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `currency` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,'SRI MURUGAN TRADERS','9','9','Sankagiri Main Road, Tharamangalam','9486704389','India','hello everyone one','INR');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `address1` varchar(200) DEFAULT NULL,
  `address2` varchar(200) DEFAULT NULL,
  `taluk` varchar(45) DEFAULT NULL,
  `district` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `gst_no` varchar(100) DEFAULT NULL,
  `active` varchar(45) DEFAULT '1',
  `pincode` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mobile_UNIQUE` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (3,'Mohan1','096774984971','Arunthathiyar Street1','Mmmm1','Omalur','Salem','Tamilnadu','545431','1',NULL),(5,'hjhj','09677498496','Arunthathiyar Street','','Omalur','Salem','Tamilnadu','','1',NULL),(6,'Mohan1','096774984951','Arunthathiyar Street1','1',NULL,NULL,'Tamilnadu','2341','1',''),(9,'bbbb','jgjk','gkjk','j',NULL,NULL,'Tamilnadu','hk','1','kj'),(10,'kjbkjh','kjhkjhkj','hkjhkjh','kjhkjhkj',NULL,NULL,'Tamilnadu','kjhkj','1','hkjhkjh'),(11,'jhkjhkjhkjk','hjkhkjhjk','hkjhkjh','kjhkjhj',NULL,NULL,'Tamilnadu','hjkhkjh','1','jkhkjhkj');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups1`
--

DROP TABLE IF EXISTS `groups1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups1` (
  `id` int NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL,
  `permission` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups1`
--

LOCK TABLES `groups1` WRITE;
/*!40000 ALTER TABLE `groups1` DISABLE KEYS */;
INSERT INTO `groups1` VALUES (1,'Administrator','a:49:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:11:\"createBrand\";i:9;s:11:\"updateBrand\";i:10;s:9:\"viewBrand\";i:11;s:11:\"deleteBrand\";i:12;s:14:\"createCategory\";i:13;s:14:\"updateCategory\";i:14;s:12:\"viewCategory\";i:15;s:14:\"deleteCategory\";i:16;s:11:\"createStore\";i:17;s:11:\"updateStore\";i:18;s:9:\"viewStore\";i:19;s:11:\"deleteStore\";i:20;s:15:\"createAttribute\";i:21;s:15:\"updateAttribute\";i:22;s:13:\"viewAttribute\";i:23;s:15:\"deleteAttribute\";i:24;s:13:\"createProduct\";i:25;s:13:\"updateProduct\";i:26;s:11:\"viewProduct\";i:27;s:13:\"deleteProduct\";i:28;s:11:\"createOrder\";i:29;s:11:\"updateOrder\";i:30;s:9:\"viewOrder\";i:31;s:11:\"deleteOrder\";i:32;s:13:\"createInvoice\";i:33;s:13:\"updateInvoice\";i:34;s:11:\"viewInvoice\";i:35;s:13:\"deleteInvoice\";i:36;s:14:\"createCustomer\";i:37;s:14:\"updateCustomer\";i:38;s:12:\"viewCustomer\";i:39;s:14:\"deleteCustomer\";i:40;s:12:\"createVendor\";i:41;s:12:\"updateVendor\";i:42;s:10:\"viewVendor\";i:43;s:12:\"deleteVendor\";i:44;s:14:\"createPurchase\";i:45;s:14:\"updatePurchase\";i:46;s:12:\"viewPurchase\";i:47;s:14:\"deletePurchase\";i:48;s:13:\"updateCompany\";}'),(5,'Testing','a:49:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:11:\"createBrand\";i:9;s:11:\"updateBrand\";i:10;s:9:\"viewBrand\";i:11;s:11:\"deleteBrand\";i:12;s:14:\"createCategory\";i:13;s:14:\"updateCategory\";i:14;s:12:\"viewCategory\";i:15;s:14:\"deleteCategory\";i:16;s:11:\"createStore\";i:17;s:11:\"updateStore\";i:18;s:9:\"viewStore\";i:19;s:11:\"deleteStore\";i:20;s:15:\"createAttribute\";i:21;s:15:\"updateAttribute\";i:22;s:13:\"viewAttribute\";i:23;s:15:\"deleteAttribute\";i:24;s:13:\"createProduct\";i:25;s:13:\"updateProduct\";i:26;s:11:\"viewProduct\";i:27;s:13:\"deleteProduct\";i:28;s:11:\"createOrder\";i:29;s:11:\"updateOrder\";i:30;s:9:\"viewOrder\";i:31;s:11:\"deleteOrder\";i:32;s:13:\"createInvoice\";i:33;s:13:\"updateInvoice\";i:34;s:11:\"viewInvoice\";i:35;s:13:\"deleteInvoice\";i:36;s:14:\"createCustomer\";i:37;s:14:\"updateCustomer\";i:38;s:12:\"viewCustomer\";i:39;s:14:\"deleteCustomer\";i:40;s:12:\"createVendor\";i:41;s:12:\"updateVendor\";i:42;s:10:\"viewVendor\";i:43;s:12:\"deleteVendor\";i:44;s:14:\"createPurchase\";i:45;s:14:\"updatePurchase\";i:46;s:12:\"viewPurchase\";i:47;s:14:\"deletePurchase\";i:48;s:13:\"updateCompany\";}'),(6,'Staff','a:5:{i:0;s:11:\"viewProduct\";i:1;s:11:\"createOrder\";i:2;s:11:\"updateOrder\";i:3;s:9:\"viewOrder\";i:4;s:11:\"deleteOrder\";}'),(7,'Customer','N;'),(8,'jjjjj','a:2:{i:0;s:10:\"createUser\";i:1;s:14:\"updatePurchase\";}');
/*!40000 ALTER TABLE `groups1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bill_no` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `gross_amount` varchar(255) NOT NULL,
  `service_charge_rate` varchar(255) NOT NULL,
  `service_charge` varchar(255) NOT NULL,
  `vat_charge_rate` varchar(255) NOT NULL,
  `vat_charge` varchar(255) NOT NULL,
  `net_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `paid_status` int NOT NULL,
  `user_id` int NOT NULL,
  `paid_amount` varchar(255) DEFAULT NULL,
  `due_amount` varchar(255) DEFAULT NULL,
  `due_date` varchar(255) DEFAULT NULL,
  `old_balance` varchar(255) DEFAULT NULL,
  `payment_method` varchar(45) DEFAULT NULL,
  `transaction_number` varchar(45) DEFAULT NULL,
  `extra_amount` varchar(45) DEFAULT '0',
  `gst` varchar(45) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` VALUES (15,'INV-3F51','6','1607928311','58.00','9','5.22','9','5.22','67.54','0.90',1,1,'524','77112.00','16-12-2020','77568.46','Online',NULL,'0','0'),(16,'INV-C751','6','1608122648','140.00','9','12.60','9','12.60','165.20','',1,1,'5000','2802.10','29-12-2020','7636.90','Cheque',NULL,'0','0'),(17,'INV-CE41','5','1609229810','1131.00','9','101.79','9','101.79','1334.58','',1,1,'1334.58','0.00','','0.00','Cash',NULL,'0','0'),(18,'INV-E8F9','5','1609254166','70.00','9','6.30','9','6.30','82.60','',1,1,'82.60','0.00','','0.00','Cash',NULL,'0','0'),(19,'INV-A698','3','1609254542','70.00','9','6.30','9','6.30','82.60','',1,1,'82.60','0.00','','0.00','Cheque','55454654654','0','0'),(20,'INV-38C7','3','1609352053','74.00','9','6.66','9','6.66','87.32','',1,1,'0','96.32','','0.00','Cash','','9','1');
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_item`
--

DROP TABLE IF EXISTS `invoice_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `square_bit_1` varchar(45) DEFAULT NULL,
  `square_bit_2` varchar(45) DEFAULT NULL,
  `product_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_item`
--

LOCK TABLES `invoice_item` WRITE;
/*!40000 ALTER TABLE `invoice_item` DISABLE KEYS */;
INSERT INTO `invoice_item` VALUES (23,12,14,'1','58','58.00',NULL,NULL,NULL),(24,13,14,'1','58','58.00',NULL,NULL,NULL),(25,14,16,'2','70','140.00',NULL,NULL,NULL),(26,14,14,'1','58','58.00',NULL,NULL,NULL),(28,15,14,'1','58','58.00',NULL,NULL,NULL),(29,16,16,'1','70','70.00',NULL,NULL,NULL),(30,16,16,'1','70','70.00',NULL,NULL,NULL),(32,17,16,'1','70','210.00','1','3','Piece'),(33,17,16,'1','70','70.00','1','1','Piece'),(34,17,16,'1','70','70.00','1','1','Piece'),(35,17,15,'1','781','781.00','1','1','Square'),(36,18,16,'1','70','70.00','1','1','Piece'),(37,19,16,'1','70','70.00','1','1','Piece'),(44,20,16,'1','70','70.00','1','1','Piece'),(45,20,15,'2','2','4.00','1','1','Square');
/*!40000 ALTER TABLE `invoice_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bill_no` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `gross_amount` varchar(255) NOT NULL,
  `service_charge_rate` varchar(255) NOT NULL,
  `service_charge` varchar(255) NOT NULL,
  `vat_charge_rate` varchar(255) NOT NULL,
  `vat_charge` varchar(255) NOT NULL,
  `net_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `paid_status` int NOT NULL,
  `user_id` int NOT NULL,
  `paid_amount` varchar(255) DEFAULT NULL,
  `due_amount` varchar(255) DEFAULT NULL,
  `due_date` varchar(100) DEFAULT NULL,
  `old_balance` varchar(255) DEFAULT NULL,
  `gst` varchar(45) DEFAULT '0',
  `transaction_number` varchar(45) DEFAULT NULL,
  `payment_method` varchar(45) DEFAULT NULL,
  `extra_amount` varchar(45) DEFAULT '0',
  PRIMARY KEY (`id`,`paid_status`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (4,'BILPR-239D','6','1526279725','450000.00','13','58500.00','10','45000.00','45000.00','',2,1,'40000',NULL,NULL,NULL,'0',NULL,NULL,'0'),(6,'BILPR-4A66','6','1606799361','2500.00','13','325.00','10','250.00','3075.00','',1,1,'3000',NULL,NULL,NULL,'0',NULL,NULL,'0'),(14,'SMTW-0C6F','6','1607874261','58.00','9','5.22','9','5.22','68.44','',1,1,'65',NULL,NULL,NULL,'0',NULL,NULL,'0'),(15,'SMTW-9F31','6','1607879298','781.00','9','70.29','9','70.29','921.58','',1,1,'500',NULL,'14-12-2020',NULL,'0',NULL,NULL,'0'),(16,'SMTW-B677','6','1607922203','58.00','9','5.22','9','5.22','68.44','',1,1,'5000',NULL,NULL,NULL,'0',NULL,NULL,'0'),(17,'SMTW-C0B2','6','1607922446','150000.00','9','13500.00','9','13500.00','177000.00','',1,1,' 100000',NULL,'31-12-2020','568.46','0',NULL,NULL,'0'),(18,'SMTW-BF6E','3','1607922637','70.00','9','6.30','9','6.30','82.60','',1,1,'50',NULL,'15-12-2020','0','0',NULL,NULL,'0'),(19,'SMTW-6BE7','3','1607922716','128.00','9','11.52','9','11.52','151.04','',1,1,'50','133.64','23-12-2020','32.60','0',NULL,NULL,'0'),(20,'SMTW-2727','3','1607925457','70.00','9','6.30','9','6.30','82.54','0.06',1,1,'70000','7651.00','16-12-2020','77568.46','0',NULL,NULL,'0'),(21,'SMTW-B1C2','6','1609352053','58.00','9','5.22','9','5.22','68.44','',1,1,'70000','7636.90','17-12-2020','77568.46','0',NULL,NULL,'0'),(22,'SMTW-1E0E','5','1609352053','210.00','9','0','9','0','200.00','10',1,1,'200','0.00','','0','0',NULL,NULL,'0'),(23,'SMTW-25A8','5','1609352053','10747.00','9','967.23','9','967.23','12681.46','',1,1,'12681.46','0.00','','0.00','1','','Cash','0'),(24,'SMTW-AA0E','3','1609352053','12.00','9','0','9','0','12.00','',1,1,'12','0.00','','0.00','0','','Cash','0'),(25,'SMTW-3B0C','3','1609352053','44181.00','9','0','9','0','44181.00','',1,1,'10000','34181.00','31-12-2020','0.00','0','','Cash','0'),(26,'SMTW-4533','3','1609352053','36.00','9','0','9','0','36.00','',1,1,'18','22.00','','0.00','0','5465465','Cash','4'),(27,'SMTW-4219','3','1609352053','70.00','9','0','9','0','70.00','',1,1,'70','0.00','','0.00','0','','Cheque','0'),(28,'SMTW-74F9','10','1609393111','7000.00','9','0','9','0','7000.00','',1,1,'7000','0.00','','0','0','','Cash','0');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_item`
--

DROP TABLE IF EXISTS `orders_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `square_bit_1` varchar(45) DEFAULT NULL,
  `square_bit_2` varchar(45) DEFAULT NULL,
  `product_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_item`
--

LOCK TABLES `orders_item` WRITE;
/*!40000 ALTER TABLE `orders_item` DISABLE KEYS */;
INSERT INTO `orders_item` VALUES (6,4,8,'3','150000','450000.00',NULL,NULL,NULL),(7,5,11,'13','900','11700.00',NULL,NULL,NULL),(8,5,10,'5','150000','750000.00',NULL,NULL,NULL),(12,7,13,'5','23','115.00',NULL,NULL,NULL),(14,8,13,'10','23','230.00',NULL,NULL,NULL),(16,9,12,'19','2500','47500.00',NULL,NULL,NULL),(18,10,12,'40','2500','100000.00',NULL,NULL,NULL),(20,11,11,'1','900','900.00',NULL,NULL,NULL),(21,6,12,'1','2500','2500.00',NULL,NULL,NULL),(22,12,13,'1','23','23.00',NULL,NULL,NULL),(23,13,16,'1','70','70.00',NULL,NULL,NULL),(24,13,13,'1','23','23.00',NULL,NULL,NULL),(25,13,16,'1','70','70.00',NULL,NULL,NULL),(26,13,16,'1','70','70.00',NULL,NULL,NULL),(27,14,14,'4','58','58.00',NULL,NULL,NULL),(28,15,15,'1','781','781.00',NULL,NULL,NULL),(29,16,14,'1','58','58.00',NULL,NULL,NULL),(30,17,10,'1','150000','150000.00',NULL,NULL,NULL),(31,18,16,'1','70','70.00',NULL,NULL,NULL),(33,19,14,'1','58','58.00',NULL,NULL,NULL),(34,19,16,'1','70','70.00',NULL,NULL,NULL),(38,20,16,'1','70','70.00',NULL,NULL,NULL),(40,21,14,'1','58','58.00',NULL,NULL,NULL),(41,22,16,'1','70','210.00',NULL,NULL,NULL),(57,24,18,'1','12','12.00','1','1','Piece'),(126,23,16,'2','70','140.00','1','1','Piece'),(127,23,13,'1','23','23.00','1','1','Kgs'),(128,23,17,'1','250','250.00','1','1','Kgs'),(129,23,13,'1','23','23.00','1','1','Kgs'),(130,23,12,'1','2500','2500.00','1','1','Piece'),(131,23,15,'1','781','781.00','1','1','Square'),(132,23,13,'1','23','23.00','1','1','Kgs'),(133,23,13,'1','23','23.00','1','1','Kgs'),(134,23,18,'1','12','12.00','1','1','Piece'),(135,23,17,'1','250','250.00','1','1','Kgs'),(136,23,16,'1','70','70.00','1','1','Piece'),(137,23,16,'1','70','70.00','1','1','Piece'),(138,23,13,'1','23','23.00','1','1','Kgs'),(139,23,15,'1','781','781.00','1','1','Square'),(140,23,15,'1','781','781.00','1','1','Square'),(141,23,18,'1','12','12.00','1','1',''),(142,23,11,'1','900','900.00','1','1','Kgs'),(143,23,11,'1','900','900.00','1','1','Kgs'),(144,23,14,'1','58','58.00','1','1',''),(145,23,14,'1','58','58.00','1','1','Kgs'),(146,23,16,'1','70','70.00','1','1','Piece'),(147,23,18,'1','12','12.00','1','1',''),(148,23,17,'1','250','250.00','1','1','Kgs'),(149,23,16,'1','70','70.00','1','1',''),(150,23,15,'1','781','781.00','1','1','Square'),(151,23,18,'1','12','12.00','1','1',''),(152,23,15,'1','781','781.00','1','1','Square'),(153,23,17,'1','250','250.00','1','1','Kgs'),(154,23,18,'1','12','12.00','1','1',''),(155,23,17,'1','250','250.00','1','1','Kgs'),(156,23,17,'1','250','250.00','1','1',''),(157,23,13,'1','23','23.00','1','1','Kgs'),(158,23,17,'1','250','250.00','1','1',''),(159,23,14,'1','58','58.00','1','1','Kgs'),(160,25,16,'1','70','1400.00','10','2','Piece'),(161,25,15,'1','781','781.00','1','1','Square'),(162,25,16,'100','70','35000.00','5','1','Piece'),(163,25,16,'10','70','7000.00','10','1','Piece'),(165,26,19,'1','18','18.00','1','1','Kgs'),(166,26,19,'1','18','18.00','1','1','Kgs'),(167,27,16,'1','70','70.00','1','1','Piece'),(168,28,16,'100','70','7000.00','1','1','Piece');
/*!40000 ALTER TABLE `orders_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_history`
--

DROP TABLE IF EXISTS `payment_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(45) DEFAULT NULL,
  `order_id` varchar(45) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `active` varchar(45) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_history`
--

LOCK TABLES `payment_history` WRITE;
/*!40000 ALTER TABLE `payment_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `image` text,
  `description` text,
  `attribute_value_id` text,
  `brand_id` text,
  `category_id` text NOT NULL,
  `store_id` int DEFAULT NULL,
  `availability` int NOT NULL,
  `product_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (10,'Mac','','150000','38','assets/images/product_image/5afa5fe395f9d.jpg','<p>sample <br></p>','[\"17\",\"20\"]','[\"15\"]','[\"7\"]',5,1,'Kgs'),(11,'Rubuke','','900','34','assets/images/product_image/5afa6026d808e.jpg','<p>sample<br></p>','[\"17\",\"21\"]','[\"15\"]','[\"7\"]',5,1,'Kgs'),(12,'Sample Product','','2500','4','assets/images/product_image/5fc5cf759483c.png','<p>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rutrum nisi sed est tempor dapibus. Sed auctor porttitor ligula a hendrerit. Praesent lacus eros, pulvinar vitae ante vel, gravida ullamcorper nunc. Sed ac dolor lorem. Quisque felis magna, varius eu malesuada non, sollicitudin nec eros. Praesent pellentesque quam tellus, non dignissim erat sollicitudin sit amet. Sed suscipit tellus sit amet sem vehicula mattis. Quisque bibendum ac quam eget auctor. Pellentesque facilisis nisl mauris, vel venenatis leo varius id. Cras semper convallis tincidunt. Nam ut pulvinar justo, sed vestibulum lectus. Praesent iaculis sem at molestie mattis. Mauris sodales, ipsum a cursus pellentesque, turpis tellus ultricies velit, nec vestibulum turpis risus ac lorem.\r\n\r\n<br></p>','[\"17\",\"21\"]','[\"16\",\"19\"]','[\"9\"]',7,1,'Piece'),(13,'mmmm','','23','44','<p>You did not select a file to upload.</p>','<p>akjdhbkjabd</p>','[\"17\"]','null','[\"7\"]',6,1,'Kgs'),(14,'steel',NULL,'58','46','<p>You did not select a file to upload.</p>','','[\"17\"]','null','[\"7\"]',NULL,1,'Kgs'),(15,'CCC1',NULL,'781','554','<p>You did not select a file to upload.</p>','','null','null','[\"9\"]',NULL,1,'Square'),(16,'MS Sheet',NULL,'70','773','<p>You did not select a file to upload.</p>','','[\"21\"]','null','[\"7\"]',NULL,1,'Piece'),(17,'ggg',NULL,'250','24','<p>You did not select a file to upload.</p>','','null','null','[\"7\"]',NULL,1,'Kgs'),(18,'kdkf',NULL,'12','-5','<p>You did not select a file to upload.</p>','','null','null','[\"7\"]',NULL,1,'Piece'),(19,'ashdkajshdkjas',NULL,'18','-1','<p>You did not select a file to upload.</p>','','null','null','[\"8\"]',NULL,1,'Kgs');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int DEFAULT NULL,
  `bill_no` varchar(255) DEFAULT NULL,
  `cgst_rate` varchar(255) DEFAULT NULL,
  `cgst_amount` varchar(255) DEFAULT NULL,
  `sgst_rate` varchar(255) DEFAULT NULL,
  `sgst_amount` varchar(255) DEFAULT NULL,
  `invoice_date` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `net_amount` varchar(255) DEFAULT NULL,
  `user_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase`
--

LOCK TABLES `purchase` WRITE;
/*!40000 ALTER TABLE `purchase` DISABLE KEYS */;
INSERT INTO `purchase` VALUES (1,9,'GJHDGJHG','9','97.20','9','97.20','10-12-2020','1080.00','1274.40','1'),(2,9,'GJHDGJHG','9','67.50','9','67.50','29-12-2020','750.00','885.00','1'),(3,9,'GJHDGJHG','9','147.60','9','147.60','08-12-2020','1640.00','1935.20','1'),(4,9,'snbdjhashb','9','90.00','9','90.00','02-12-2020','1000.00','1180.00','1');
/*!40000 ALTER TABLE `purchase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_item`
--

DROP TABLE IF EXISTS `purchase_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `purchase_id` varchar(45) DEFAULT NULL,
  `product_id` varchar(45) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_item`
--

LOCK TABLES `purchase_item` WRITE;
/*!40000 ALTER TABLE `purchase_item` DISABLE KEYS */;
INSERT INTO `purchase_item` VALUES (40,'1','14','18','60','1080.00'),(41,'2','12','15','50','750.00'),(44,'3','15','20','12','240.00'),(45,'3','17','30','20','600.00'),(46,'3','16','40','20','800.00'),(47,'4','15','20','50','1000.00');
/*!40000 ALTER TABLE `purchase_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `active` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores`
--

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
INSERT INTO `stores` VALUES (5,'colombo',2),(6,'kandy',1),(7,'Sample Warehouse',1);
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_group` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `group_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_group`
--

LOCK TABLES `user_group` WRITE;
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
INSERT INTO `user_group` VALUES (1,1,1),(7,6,4),(8,7,4),(9,8,4),(10,9,5),(11,10,5),(12,11,5),(13,12,5),(14,13,5),(15,14,5);
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` int NOT NULL,
  `language` varchar(45) DEFAULT 'english',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'super admin','$2y$10$yfi5nUQGXUZtMdl27dWAyOd/jMOmATBpiUvJDmUu9hJ5Ro6BE5wsK','admin@admin.com','john','doe','65646546',1,'english'),(11,'shafraz','$2y$10$LK91ERpEJxortR86lkDjwu7MClazgIrvDqehqOnq5ZKm30elKAkUa','shafraz@gmail.com','mohamed','nizam','0778650669',1,'english'),(12,'jsmith','$2y$10$WLS.lZeiEfyXYfR0l/wkXeRRuqazsgIAMC9//L44J4KkZGbbqcKYC','jsmith@sample.com','John','Smith','2345678',1,'english'),(13,'mohanraj1','$2y$10$4Ph3/cHhYeTzg3v5YLT3P.rAuMcC2.J7xVENQ3Syk03HCc3gZd7fa','smohanrajcse94@gmail.com1','Mohan1','s1','109677498497',2,'english');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `address1` varchar(200) DEFAULT NULL,
  `address2` varchar(200) DEFAULT NULL,
  `taluk` varchar(45) DEFAULT NULL,
  `district` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `gst_no` varchar(100) DEFAULT NULL,
  `active` varchar(45) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mobile_UNIQUE` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendor`
--

LOCK TABLES `vendor` WRITE;
/*!40000 ALTER TABLE `vendor` DISABLE KEYS */;
INSERT INTO `vendor` VALUES (9,'Mohan1','096774984971','Arunthathiyar Street1','bvbsfvdbf1','jdbfjd1','bdsvfbsdf1','1Mariyamman Kovil','25417763331','1'),(10,'nbnb','nbmnbmn','bmnbmnb','nbmnb','mnbmnbnm','bnmbmn','bmnbmnb','mnbmnb','1');
/*!40000 ALTER TABLE `vendor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ims_db'
--

--
-- Dumping routines for database 'ims_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-04 12:06:44
