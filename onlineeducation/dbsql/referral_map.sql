-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table mealticket.referred_map
CREATE TABLE IF NOT EXISTS `referred_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `referred_by` int(11) NOT NULL,
  `referred_to` int(11) NOT NULL,
  `referred_by_credit` int(11) NOT NULL,
  `referred_to_credit` int(11) NOT NULL,
  `approval_status` int(11) NOT NULL DEFAULT '2' COMMENT '1: approved,2:Pending,0:Rejected',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table mealticket.referred_map: 3 rows
/*!40000 ALTER TABLE `referred_map` DISABLE KEYS */;
INSERT INTO `referred_map` (`id`, `referred_by`, `referred_to`, `referred_by_credit`, `referred_to_credit`, `approval_status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
	(1, 1, 7, 50, 50, 2, '2020-08-01 11:47:04', '2020-08-01 11:47:04', NULL, NULL, NULL),
	(3, 1, 8, 60, 50, 2, '2020-08-01 11:52:02', '2020-08-01 11:52:02', NULL, NULL, NULL),
	(4, 1, 9, 60, 50, 2, '2020-08-01 12:20:52', '2020-08-01 12:20:52', NULL, NULL, NULL);
/*!40000 ALTER TABLE `referred_map` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
