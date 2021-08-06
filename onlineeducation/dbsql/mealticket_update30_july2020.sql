-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 30, 2020 at 02:00 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mealticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `kitchen_establishment_info`
--

DROP TABLE IF EXISTS `kitchen_establishment_info`;
CREATE TABLE IF NOT EXISTS `kitchen_establishment_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipcode` varchar(50) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `contact_number` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `vendorUserId` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kitchen_establishment_info`
--

INSERT INTO `kitchen_establishment_info` (`id`, `name`, `address`, `zipcode`, `latitude`, `longitude`, `contact_number`, `email`, `status`, `vendorUserId`, `image`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
(1, 'test', 'bpl', '445544', '4454545', '54545', '9856985677', 'test@gmail.com', 1, 142, '1596031448.jpg', '2020-07-29 07:36:15', '2020-07-29 08:37:13', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kitchen_food_items`
--

DROP TABLE IF EXISTS `kitchen_food_items`;
CREATE TABLE IF NOT EXISTS `kitchen_food_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `vendorId` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '2014_10_12_000000_create_users_table', 1),
(9, '2014_10_12_100000_create_password_resets_table', 1),
(10, '2018_04_08_055516_create_permission_tables', 1),
(11, '2018_04_08_184453_create_websitesettings_table', 1),
(12, '2018_04_11_183511_create_organizationmasters_table', 1),
(14, '2018_04_16_173443_create_jobmasters_table', 2),
(16, '2018_04_24_171105_create_candidatemasters_table', 3),
(17, '2018_04_26_183446_create_keywords_table', 4),
(18, '2018_04_26_183603_create_skills_table', 4),
(25, '2018_05_06_093229_create_interview_schedules_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_id`, `model_type`) VALUES
(1, 1, 'App\\User'),
(2, 13, 'App\\User'),
(2, 16, 'App\\User'),
(2, 35, 'App\\User'),
(2, 37, 'App\\User'),
(2, 40, 'App\\User'),
(2, 45, 'App\\User'),
(2, 55, 'App\\User'),
(2, 59, 'App\\User'),
(2, 61, 'App\\User'),
(2, 62, 'App\\User'),
(2, 63, 'App\\User'),
(3, 14, 'App\\User'),
(3, 15, 'App\\User'),
(3, 16, 'App\\User'),
(3, 20, 'App\\User'),
(3, 22, 'App\\User'),
(3, 29, 'App\\User'),
(3, 32, 'App\\User'),
(3, 39, 'App\\User'),
(3, 41, 'App\\User'),
(3, 48, 'App\\User'),
(3, 53, 'App\\User'),
(3, 54, 'App\\User'),
(3, 56, 'App\\User'),
(3, 60, 'App\\User'),
(3, 64, 'App\\User'),
(4, 23, 'App\\User'),
(4, 24, 'App\\User'),
(4, 33, 'App\\User'),
(4, 34, 'App\\User'),
(4, 36, 'App\\User'),
(4, 38, 'App\\User'),
(4, 42, 'App\\User'),
(4, 46, 'App\\User'),
(4, 50, 'App\\User'),
(4, 51, 'App\\User'),
(4, 52, 'App\\User'),
(4, 57, 'App\\User'),
(5, 27, 'App\\User'),
(5, 43, 'App\\User'),
(5, 44, 'App\\User'),
(5, 47, 'App\\User'),
(5, 49, 'App\\User'),
(5, 58, 'App\\User'),
(7, 65, 'App\\User'),
(13, 66, 'App\\User'),
(18, 67, 'App\\User'),
(18, 70, 'App\\User'),
(18, 78, 'App\\User'),
(18, 80, 'App\\User'),
(18, 82, 'App\\User'),
(18, 83, 'App\\User'),
(18, 86, 'App\\User'),
(18, 97, 'App\\User'),
(18, 99, 'App\\User'),
(18, 101, 'App\\User'),
(18, 102, 'App\\User'),
(18, 116, 'App\\User'),
(18, 121, 'App\\User'),
(18, 123, 'App\\User'),
(18, 129, 'App\\User'),
(18, 130, 'App\\User'),
(18, 132, 'App\\User'),
(18, 134, 'App\\User'),
(18, 140, 'App\\User'),
(18, 141, 'App\\User'),
(19, 76, 'App\\User'),
(19, 79, 'App\\User'),
(19, 81, 'App\\User'),
(19, 84, 'App\\User'),
(19, 85, 'App\\User'),
(19, 90, 'App\\User'),
(19, 91, 'App\\User'),
(19, 93, 'App\\User'),
(19, 94, 'App\\User'),
(19, 106, 'App\\User'),
(19, 110, 'App\\User'),
(19, 118, 'App\\User'),
(19, 131, 'App\\User'),
(19, 135, 'App\\User'),
(19, 137, 'App\\User'),
(20, 68, 'App\\User'),
(20, 69, 'App\\User'),
(20, 72, 'App\\User'),
(20, 73, 'App\\User'),
(20, 75, 'App\\User'),
(20, 77, 'App\\User'),
(20, 95, 'App\\User'),
(20, 96, 'App\\User'),
(20, 100, 'App\\User'),
(20, 103, 'App\\User'),
(20, 104, 'App\\User'),
(20, 105, 'App\\User'),
(20, 113, 'App\\User'),
(20, 114, 'App\\User'),
(20, 115, 'App\\User'),
(20, 122, 'App\\User'),
(20, 125, 'App\\User'),
(20, 128, 'App\\User'),
(20, 133, 'App\\User'),
(20, 139, 'App\\User'),
(20, 142, 'App\\User'),
(25, 71, 'App\\User'),
(25, 74, 'App\\User'),
(25, 87, 'App\\User'),
(25, 88, 'App\\User'),
(25, 89, 'App\\User'),
(25, 107, 'App\\User'),
(25, 108, 'App\\User'),
(25, 109, 'App\\User'),
(25, 119, 'App\\User'),
(25, 136, 'App\\User'),
(25, 138, 'App\\User'),
(32, 92, 'App\\User'),
(32, 111, 'App\\User'),
(32, 112, 'App\\User'),
(32, 120, 'App\\User'),
(33, 117, 'App\\User'),
(33, 124, 'App\\User'),
(33, 126, 'App\\User'),
(33, 127, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_total` decimal(25,2) NOT NULL,
  `payment_status` enum('paid','unpaid','failed','') NOT NULL DEFAULT 'unpaid',
  `payment_by_subscription` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

DROP TABLE IF EXISTS `orders_detail`;
CREATE TABLE IF NOT EXISTS `orders_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_item` decimal(11,0) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `permission_order` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `parent_id`, `permission_order`, `created_at`, `updated_at`) VALUES
(2, 'Studio module', 'web', 0, 2, '2018-10-31 06:51:07', '2018-10-31 06:51:07'),
(1, 'User module', 'web', 0, 1, '2018-09-30 18:30:00', NULL),
(20, 'Delete', 'web', 1, 1, NULL, NULL),
(19, 'View', 'web', 1, 1, NULL, NULL),
(18, 'View', 'web', 2, 1, NULL, NULL),
(17, 'Delete', 'web', 2, 1, NULL, NULL),
(3, 'Subtitle module', 'web', 0, 3, '2018-10-31 06:51:14', '2018-10-31 06:51:14'),
(4, 'Content module', 'web', 0, 4, '2018-10-31 06:51:21', '2018-10-31 06:51:21'),
(5, 'Report module', 'web', 0, 5, '2018-10-31 06:51:29', '2018-10-31 06:51:29'),
(15, 'Add', 'web', 2, 1, NULL, NULL),
(16, 'Edit', 'web', 2, 1, NULL, NULL),
(21, 'Add', 'web', 1, 1, NULL, NULL),
(22, 'Edit', 'web', 1, 1, NULL, NULL),
(23, 'View', 'web', 3, 1, NULL, NULL),
(24, 'Delete', 'web', 3, 1, NULL, NULL),
(25, 'Add', 'web', 3, 1, NULL, NULL),
(26, 'Edit', 'web', 3, 1, NULL, NULL),
(27, 'View', 'web', 4, 1, NULL, NULL),
(28, 'Delete', 'web', 4, 1, NULL, NULL),
(29, 'Add', 'web', 4, 1, NULL, NULL),
(30, 'Edit', 'web', 4, 1, NULL, NULL),
(31, 'View', 'web', 5, 1, NULL, NULL),
(49, 'Log Module', 'web', 0, 6, '2019-09-06 06:08:01', '2019-09-06 06:08:01'),
(50, 'view', 'web', 49, 1, '2019-09-06 06:08:01', '2019-09-06 06:08:01'),
(51, 'Translate Content', 'web', 0, 1, '2019-10-01 09:08:59', '2019-10-01 09:08:59'),
(52, 'edit', 'web', 51, 1, '2019-10-01 09:08:59', '2019-10-01 09:08:59'),
(53, 'view', 'web', 51, 1, '2019-10-01 09:08:59', '2019-10-01 09:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userType` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) DEFAULT '0',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdby` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `userType`, `userid`, `name`, `guard_name`, `createdby`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 2, 'Super Admin', 'web', 1, '2018-04-18 13:47:48', '2018-04-18 13:47:48', NULL),
(20, 0, 1, 'Vendor Admin', 'web', 1, '2018-11-01 05:06:21', '2019-09-05 05:53:01', NULL),
(36, 0, 0, 'Student', 'web', 1, '2018-11-01 05:06:21', '2019-09-05 05:53:01', NULL),
(37, 0, 1, 'School Admin', 'web', 1, '2018-11-01 05:06:21', '2019-09-05 05:53:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_info`
--

DROP TABLE IF EXISTS `school_info`;
CREATE TABLE IF NOT EXISTS `school_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `region_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `zipcode` varchar(50) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `contact_number` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `adminUserId` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_info`
--

INSERT INTO `school_info` (`id`, `name`, `region_name`, `address`, `zipcode`, `latitude`, `longitude`, `contact_number`, `email`, `status`, `adminUserId`, `image`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
(1, 'one', 'mp', 'bb', '123123', '123', '123', '1231231234', 'one@gmail.com', 1, 0, '1596095409.jpg', '2020-07-30 02:20:09', '2020-07-30 07:11:45', 1, NULL, NULL),
(2, 'two', 'UP', 'bhopal', '121212', '12', '12', '1212121212', 'two@gmail.com', 1, 0, '1596107711.jpg', '2020-07-30 05:45:11', '2020-07-30 07:11:59', 1, NULL, NULL),
(3, 'three', 'mp', 'asa', '8569855', '55', '55', '9856985644', 'three@gmail.com', 1, 0, '', '2020-07-30 07:12:40', '2020-07-30 07:13:50', 1, NULL, NULL),
(4, 'four', 'mp', 'aa', 'asas', 'sasd', 'sds', '121212121', 'four@gmail.com', 1, 0, '', '2020-07-30 07:13:42', '2020-07-30 07:13:42', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `school_vendor_mapping`
--

DROP TABLE IF EXISTS `school_vendor_mapping`;
CREATE TABLE IF NOT EXISTS `school_vendor_mapping` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_code_count` int(11) NOT NULL DEFAULT '0',
  `school_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_count` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT '0',
  `updated_by` int(11) DEFAULT NULL,
  `IsVerify` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `user_code`, `referral_code`, `referral_code_count`, `school_id`, `name`, `password`, `mobile_number`, `email`, `otp`, `otp_count`, `created_by`, `updated_by`, `IsVerify`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'manish-chakravarti-17', 2, 1, 'manish chakravarti', NULL, '9926331376', 'raj@gmail.com', '7302', 1, 0, NULL, 1, 1, '2020-07-30 01:59:06', '2020-07-30 06:07:45', NULL),
(2, NULL, '154637', 0, NULL, NULL, NULL, '9926331375', NULL, NULL, 0, 0, NULL, 1, 1, '2020-07-30 08:09:26', '2020-07-30 08:12:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_school_mapping`
--

DROP TABLE IF EXISTS `student_school_mapping`;
CREATE TABLE IF NOT EXISTS `student_school_mapping` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_subscription_entry`
--

DROP TABLE IF EXISTS `student_subscription_entry`;
CREATE TABLE IF NOT EXISTS `student_subscription_entry` (
  `id` int(11) NOT NULL,
  `studentId` varchar(255) NOT NULL,
  `subscriptionId` decimal(25,2) NOT NULL,
  `nextRenewalDate` date DEFAULT NULL,
  `currentAvailableOrders` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
CREATE TABLE IF NOT EXISTS `subscription` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `durationInDay` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` int(11) NOT NULL DEFAULT '0',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL DEFAULT '0',
  `UpdatedBy` int(11) DEFAULT NULL,
  `RoleID` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IsVerify` int(11) NOT NULL DEFAULT '1',
  `IsActive` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_roleid_foreign` (`RoleID`)
) ENGINE=MyISAM AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_code`, `user_type`, `name`, `email`, `password`, `Phone`, `Designation`, `CreatedBy`, `UpdatedBy`, `RoleID`, `remember_token`, `IsVerify`, `IsActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 1, 'Admin', 'admin@gmail.com', '$2y$10$c2pgkKv3TValQ13661iERObMQ2ft8P0KnkuUWyC9Uk95fPuQwkiGu', '7869522084', 'MCA', 0, 0, 0, 'UqrkEEeJk3tY2G2DLIw2DpRnvk7Z4QpQXojUTKPoz075TxnPyfPRpfQEZi5t', 1, 1, '2018-04-02 19:37:09', '2019-09-24 02:47:20', NULL),
(142, 'u2020142', 20, 'test update new', 'test@gmail.com', '$2y$10$/d0Me95KmvyttTqZ5xH6mOywg7zfK9uqt6U1RTZU6igCeYoLzKmSO', '9856985644', 'admin', 1, NULL, NULL, 'j57kIDKRnM3srcwm60lxZwPA9GzTLSvylIsOOp6hLqWP0gzLOl4brhHAkZwd', 1, 1, '2020-07-27 09:18:16', '2020-07-29 03:56:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `websitesettings`
--

DROP TABLE IF EXISTS `websitesettings`;
CREATE TABLE IF NOT EXISTS `websitesettings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `website_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website_logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locktimeout` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fb_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twi_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `yout_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `websitesettings`
--

INSERT INTO `websitesettings` (`id`, `website_name`, `website_logo`, `locktimeout`, `email`, `address`, `mobile`, `fb_link`, `twi_link`, `yout_link`, `created_at`, `updated_at`) VALUES
(1, 'Subtitle Crazy', '', '10', 'manish09.chakravarti@gmail.com', 'BHOPAL', '9826702123', '', '', '', '2018-04-10 21:57:19', '2019-10-09 10:36:33');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
