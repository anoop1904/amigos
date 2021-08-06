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

-- Dumping structure for table mealticket.student
CREATE TABLE IF NOT EXISTS `student` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_code_count` int(11) NOT NULL DEFAULT '0',
  `school_id` int(11) DEFAULT NULL,
  `messenger_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `district_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_count` int(11) NOT NULL DEFAULT '0',
  `ambassador` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT '0',
  `updated_by` int(11) DEFAULT NULL,
  `IsVerify` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mealticket.student: 5 rows
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` (`id`, `user_code`, `referral_code`, `referral_code_count`, `school_id`, `messenger_id`, `plan_id`, `district_name`, `name`, `last_name`, `password`, `mobile_number`, `email`, `otp`, `otp_count`, `ambassador`, `created_by`, `updated_by`, `IsVerify`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, NULL, 'manish-chakravarti-17', 12, 1, NULL, NULL, NULL, 'manish chakravarti', NULL, '$2y$10$c2pgkKv3TValQ13661iERObMQ2ft8P0KnkuUWyC9Uk95fPuQwkiGu', '9926331376', 'raj@gmail.com', '7302', 1, 1, 0, NULL, 1, 1, '2020-07-30 07:29:06', '2020-08-02 07:58:14', NULL),
	(7, NULL, '918681', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9926331377', NULL, NULL, 0, 0, 0, NULL, 1, 1, '2020-08-01 11:28:59', '2020-08-01 11:30:18', NULL),
	(8, NULL, '667476', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9926331374', NULL, NULL, 0, 0, 0, NULL, 1, 1, '2020-08-01 11:50:19', '2020-08-01 11:50:51', NULL),
	(9, NULL, '52666562', 0, 4, '123123', NULL, 'MP', NULL, NULL, NULL, '9926331371', NULL, NULL, 0, 0, 0, NULL, 1, 1, '2020-08-01 12:20:05', '2020-08-02 07:48:51', NULL),
	(10, NULL, '64129700', 0, 4, '12312333', NULL, 'MP', NULL, NULL, NULL, '9926331375', NULL, NULL, 0, 0, 0, NULL, 1, 1, '2020-08-02 07:37:13', '2020-08-02 07:58:14', NULL);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
