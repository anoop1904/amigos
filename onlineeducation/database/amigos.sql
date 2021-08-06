-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2020 at 08:00 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amigos`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `countries_id` int(11) NOT NULL,
  `countries_name` varchar(64) NOT NULL DEFAULT '',
  `countries_iso_code` varchar(2) NOT NULL,
  `countries_isd_code` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`countries_id`, `countries_name`, `countries_iso_code`, `countries_isd_code`) VALUES
(57, 'Denmark', 'DK', '45'),
(99, 'India', 'IN', '91');

-- --------------------------------------------------------

--
-- Table structure for table `device_detail`
--

CREATE TABLE `device_detail` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` enum('customer','store') NOT NULL,
  `device_type` enum('android','ios') NOT NULL DEFAULT 'android',
  `device_token` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
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
(20, 143, 'App\\User'),
(20, 145, 'App\\User'),
(20, 146, 'App\\User'),
(20, 147, 'App\\User'),
(20, 148, 'App\\User'),
(20, 149, 'App\\User'),
(20, 150, 'App\\User'),
(20, 151, 'App\\User'),
(20, 152, 'App\\User'),
(20, 153, 'App\\User'),
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
(33, 127, 'App\\User'),
(36, 144, 'App\\User'),
(36, 154, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `sent_by` int(11) NOT NULL,
  `sent_to` int(11) NOT NULL,
  `noti_type` varchar(100) DEFAULT NULL,
  `is_read` int(11) NOT NULL DEFAULT 0,
  `status` int(11) UNSIGNED NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `sent_by`, `sent_to`, `noti_type`, `is_read`, `status`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 84, 'order_detail', 0, 1, 'Your order successfully placed', '2020-08-07 10:06:55', '2020-08-13 10:53:49'),
(2, 1, 84, 'order_type', 0, 0, 'Order cancelled', '2020-08-07 11:19:19', '2020-08-13 10:54:18'),
(3, 0, 97, NULL, 0, 1, 'Your Order has been Placed', '2020-08-16 13:55:17', '2020-08-16 13:55:17'),
(4, 0, 661, NULL, 0, 1, 'Your Order has been Placed', '2020-08-16 14:03:53', '2020-08-16 14:03:53'),
(5, 0, 638, NULL, 0, 1, 'Your Order has been Placed', '2020-08-16 14:13:12', '2020-08-16 14:13:12'),
(6, 0, 319, NULL, 0, 1, 'Your Order has been Placed', '2020-08-16 14:21:41', '2020-08-16 14:21:41'),
(7, 0, 210, NULL, 0, 1, 'Your Order has been Placed', '2020-08-16 14:30:46', '2020-08-16 14:30:46'),
(8, 0, 97, NULL, 0, 1, 'Your Order has been Placed', '2020-08-16 14:52:26', '2020-08-16 14:52:26'),
(9, 0, 97, NULL, 0, 1, 'Your order has been delivered', '2020-08-16 14:53:03', '2020-08-16 14:53:03'),
(10, 0, 97, NULL, 0, 1, 'Your Order has been Placed', '2020-08-16 14:53:54', '2020-08-16 14:53:54'),
(11, 0, 97, NULL, 0, 1, 'Your Order has been Placed', '2020-08-16 14:53:57', '2020-08-16 14:53:57'),
(12, 0, 97, NULL, 0, 1, 'Your order has been delivered', '2020-08-16 14:55:52', '2020-08-16 14:55:52'),
(13, 0, 743, NULL, 0, 1, 'Your Order has been Placed', '2020-08-16 15:00:02', '2020-08-16 15:00:02'),
(14, 0, 236, NULL, 0, 1, 'Your Order has been Placed', '2020-08-16 15:19:39', '2020-08-16 15:19:39'),
(15, 0, 720, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 11:24:34', '2020-08-17 11:24:34'),
(16, 0, 97, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 12:36:18', '2020-08-17 12:36:18'),
(17, 0, 97, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 12:37:16', '2020-08-17 12:37:16'),
(18, 0, 770, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 13:19:18', '2020-08-17 13:19:18'),
(19, 0, 723, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 13:19:47', '2020-08-17 13:19:47'),
(20, 0, 102, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 13:20:39', '2020-08-17 13:20:39'),
(21, 0, 235, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 13:21:54', '2020-08-17 13:21:54'),
(22, 0, 743, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 13:23:13', '2020-08-17 13:23:13'),
(23, 0, 661, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 13:25:00', '2020-08-17 13:25:00'),
(24, 0, 669, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 13:27:53', '2020-08-17 13:27:53'),
(25, 0, 778, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 13:28:45', '2020-08-17 13:28:45'),
(26, 0, 199, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 13:29:13', '2020-08-17 13:29:13'),
(27, 0, 687, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 13:33:13', '2020-08-17 13:33:13'),
(28, 0, 230, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 13:34:57', '2020-08-17 13:34:57'),
(29, 0, 361, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 13:39:45', '2020-08-17 13:39:45'),
(30, 0, 638, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 13:56:53', '2020-08-17 13:56:53'),
(31, 0, 276, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 13:58:43', '2020-08-17 13:58:43'),
(32, 0, 580, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 14:00:10', '2020-08-17 14:00:10'),
(33, 0, 318, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 14:08:18', '2020-08-17 14:08:18'),
(34, 0, 647, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 14:08:56', '2020-08-17 14:08:56'),
(35, 0, 581, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 14:23:36', '2020-08-17 14:23:36'),
(36, 0, 311, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 14:41:53', '2020-08-17 14:41:53'),
(37, 0, 316, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 15:40:30', '2020-08-17 15:40:30'),
(38, 0, 771, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 17:19:26', '2020-08-17 17:19:26'),
(39, 0, 197, NULL, 0, 1, 'Your Order has been Placed', '2020-08-17 19:48:15', '2020-08-17 19:48:15'),
(40, 0, 279, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 02:26:18', '2020-08-18 02:26:18'),
(41, 0, 713, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 03:47:05', '2020-08-18 03:47:05'),
(42, 0, 228, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 04:28:57', '2020-08-18 04:28:57'),
(43, 0, 180, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 04:43:04', '2020-08-18 04:43:04'),
(44, 0, 695, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 05:00:35', '2020-08-18 05:00:35'),
(45, 0, 767, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 05:10:27', '2020-08-18 05:10:27'),
(46, 0, 797, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 06:19:48', '2020-08-18 06:19:48'),
(47, 0, 797, NULL, 0, 1, 'Your order has been delivered', '2020-08-18 06:22:18', '2020-08-18 06:22:18'),
(48, 0, 800, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 06:22:29', '2020-08-18 06:22:29'),
(49, 0, 523, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 06:22:49', '2020-08-18 06:22:49'),
(50, 0, 802, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 07:33:42', '2020-08-18 07:33:42'),
(51, 0, 694, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 13:08:06', '2020-08-18 13:08:06'),
(52, 0, 494, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:01:07', '2020-08-18 15:01:07'),
(53, 0, 580, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:01:23', '2020-08-18 15:01:23'),
(54, 0, 102, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:01:46', '2020-08-18 15:01:46'),
(55, 0, 276, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:01:48', '2020-08-18 15:01:48'),
(56, 0, 230, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:02:02', '2020-08-18 15:02:02'),
(57, 0, 778, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:02:23', '2020-08-18 15:02:23'),
(58, 0, 288, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:02:27', '2020-08-18 15:02:27'),
(59, 0, 275, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:02:39', '2020-08-18 15:02:39'),
(60, 0, 296, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:03:02', '2020-08-18 15:03:02'),
(61, 0, 743, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:03:07', '2020-08-18 15:03:07'),
(62, 0, 309, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:03:50', '2020-08-18 15:03:50'),
(63, 0, 673, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:04:35', '2020-08-18 15:04:35'),
(64, 0, 669, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:04:44', '2020-08-18 15:04:44'),
(65, 0, 549, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:05:06', '2020-08-18 15:05:06'),
(66, 0, 661, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:05:09', '2020-08-18 15:05:09'),
(67, 0, 190, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:06:44', '2020-08-18 15:06:44'),
(68, 0, 543, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:07:34', '2020-08-18 15:07:34'),
(69, 0, 311, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:07:46', '2020-08-18 15:07:46'),
(70, 0, 253, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:08:22', '2020-08-18 15:08:22'),
(71, 0, 361, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:11:35', '2020-08-18 15:11:35'),
(72, 0, 319, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:12:24', '2020-08-18 15:12:24'),
(73, 0, 188, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:14:22', '2020-08-18 15:14:22'),
(74, 0, 638, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:15:27', '2020-08-18 15:15:27'),
(75, 0, 692, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:16:10', '2020-08-18 15:16:10'),
(76, 0, 198, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:17:24', '2020-08-18 15:17:24'),
(77, 0, 235, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:19:52', '2020-08-18 15:19:52'),
(78, 0, 723, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 15:53:06', '2020-08-18 15:53:06'),
(79, 0, 182, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 16:00:05', '2020-08-18 16:00:05'),
(80, 0, 265, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 16:16:57', '2020-08-18 16:16:57'),
(81, 0, 98, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 16:33:01', '2020-08-18 16:33:01'),
(82, 0, 770, NULL, 0, 1, 'Your Order has been Placed', '2020-08-18 16:39:56', '2020-08-18 16:39:56'),
(83, 0, 623, NULL, 0, 1, 'Your Order has been Placed', '2020-08-19 05:19:40', '2020-08-19 05:19:40'),
(84, 0, 695, NULL, 0, 1, 'Your Order has been Placed', '2020-08-19 05:56:49', '2020-08-19 05:56:49'),
(85, 0, 228, NULL, 0, 1, 'Your Order has been Placed', '2020-08-19 06:53:46', '2020-08-19 06:53:46'),
(86, 0, 816, NULL, 0, 1, 'Your Order has been Placed', '2020-08-19 07:17:47', '2020-08-19 07:17:47'),
(87, 0, 123, NULL, 0, 1, 'Your Order has been Placed', '2020-08-19 05:25:32', '2020-08-19 05:25:32'),
(88, 0, 797, NULL, 0, 1, 'Your Order has been Placed', '2020-08-19 06:34:14', '2020-08-19 06:34:14'),
(89, 0, 797, NULL, 0, 1, 'Your order has been delivered', '2020-08-19 06:36:01', '2020-08-19 06:36:01'),
(90, 0, 78, NULL, 0, 1, 'Your Order has been Placed', '2020-08-19 09:01:09', '2020-08-19 09:01:09'),
(91, 0, 819, NULL, 0, 1, 'Your Order has been Placed', '2020-08-19 07:01:47', '2020-08-19 07:01:47'),
(92, 0, 819, NULL, 0, 1, 'Your order has been delivered', '2020-08-19 07:14:07', '2020-08-19 07:14:07'),
(93, 0, 802, NULL, 0, 1, 'Your Order has been Placed', '2020-08-19 07:28:12', '2020-08-19 07:28:12'),
(94, 0, 802, NULL, 0, 1, 'Your order has been delivered', '2020-08-19 07:32:12', '2020-08-19 07:32:12'),
(95, 0, 93, NULL, 0, 1, 'Your Order has been Placed', '2020-08-21 08:46:18', '2020-08-21 08:46:18'),
(96, 0, 93, NULL, 0, 1, 'Your Order has been Placed', '2020-08-21 08:57:22', '2020-08-21 08:57:22'),
(97, 0, 93, NULL, 0, 1, 'Your Order has been Placed', '2020-08-21 08:58:20', '2020-08-21 08:58:20'),
(98, 0, 93, NULL, 0, 1, 'Your Order has been Placed', '2020-08-21 09:00:24', '2020-08-21 09:00:24'),
(99, 0, 93, NULL, 0, 1, 'Your Order has been Placed', '2020-08-21 09:05:24', '2020-08-21 09:05:24'),
(100, 0, 93, NULL, 0, 1, 'Your Order has been Placed', '2020-08-21 09:09:55', '2020-08-21 09:09:55'),
(101, 0, 61, NULL, 0, 1, 'Your Order has been Placed', '2020-08-21 10:27:50', '2020-08-21 10:27:50'),
(102, 0, 61, NULL, 0, 1, 'Your Order has been Placed', '2020-08-21 10:29:37', '2020-08-21 10:29:37'),
(103, 0, 676, NULL, 0, 1, 'Your Order has been Placed', '2020-08-21 10:46:41', '2020-08-21 10:46:41'),
(104, 0, 676, NULL, 0, 1, 'Your Order has been Placed', '2020-08-21 10:47:12', '2020-08-21 10:47:12'),
(105, 0, 676, NULL, 0, 1, 'Your Order has been Placed', '2020-08-24 01:32:14', '2020-08-24 01:32:14'),
(106, 0, 89, NULL, 0, 1, 'Your Order has been Placed', '2020-08-24 03:47:16', '2020-08-24 03:47:16'),
(107, 0, 89, NULL, 0, 1, 'Your Order has been Placed', '2020-08-24 03:50:08', '2020-08-24 03:50:08'),
(108, 0, 89, NULL, 0, 1, 'Your Order has been Placed', '2020-08-24 03:52:11', '2020-08-24 03:52:11'),
(109, 0, 89, NULL, 0, 1, 'Your Order has been Placed', '2020-08-24 03:54:38', '2020-08-24 03:54:38'),
(110, 0, 89, NULL, 0, 1, 'Your Order has been Placed', '2020-08-24 03:56:07', '2020-08-24 03:56:07'),
(111, 0, 89, NULL, 0, 1, 'Your Order has been Placed', '2020-08-24 03:57:03', '2020-08-24 03:57:03'),
(112, 0, 89, NULL, 0, 1, 'Your Order has been Placed', '2020-08-24 03:57:38', '2020-08-24 03:57:38'),
(113, 0, 89, NULL, 0, 1, 'Your Order has been Placed', '2020-08-24 04:02:55', '2020-08-24 04:02:55'),
(114, 0, 89, NULL, 0, 1, 'Your Order has been Placed', '2020-08-24 04:03:26', '2020-08-24 04:03:26'),
(115, 0, 89, NULL, 0, 1, 'Your Order has been Placed', '2020-08-24 04:08:05', '2020-08-24 04:08:05'),
(116, 0, 88, NULL, 0, 1, 'Your Order has been Placed', '2020-08-24 04:10:23', '2020-08-24 04:10:23'),
(117, 0, 83, NULL, 0, 1, 'Your Order has been Placed', '2020-08-24 08:28:08', '2020-08-24 08:28:08'),
(118, 0, 827, NULL, 0, 1, 'Your Order has been Placed', '2020-08-26 04:59:24', '2020-08-26 04:59:24'),
(119, 0, 827, NULL, 0, 1, 'Your Order has been Placed', '2020-08-26 05:01:37', '2020-08-26 05:01:37'),
(120, 0, 827, NULL, 0, 1, 'Your Order has been Placed', '2020-08-26 05:04:57', '2020-08-26 05:04:57');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `permission_action` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_order` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `parent_id`, `permission_action`, `url`, `permission_order`, `created_at`, `updated_at`) VALUES
(5, 'Master', 'web', 0, 'view', '#', 1, '2020-10-07 08:04:27', '2020-10-07 08:04:27'),
(6, 'Category', 'web', 5, 'add,edit,delete,view', 'admin/category', 1, '2020-10-07 08:06:45', '2020-10-07 08:06:45'),
(7, 'Unit', 'web', 5, 'add,edit,delete,view', 'admin/unit', 1, '2020-10-07 08:07:57', '2020-10-07 08:07:57'),
(8, 'Brand', 'web', 5, 'add,edit,delete,view', 'admin/brand', 1, '2020-10-07 08:08:29', '2020-10-07 08:08:29'),
(9, 'Product', 'web', 5, 'add,edit,delete,view', 'admin/product', 1, '2020-10-07 08:08:58', '2020-10-07 08:08:58'),
(10, 'Email Template Editor', 'web', 5, 'add,edit,delete,view', 'admin/emailtemplate', 1, '2020-10-07 08:09:25', '2020-10-07 08:09:25'),
(11, 'SMS Template Editor', 'web', 5, 'add,edit,delete,view', 'admin/messages', 1, '2020-10-07 08:10:04', '2020-10-07 08:10:04'),
(12, 'Create Offer', 'web', 5, 'add,edit,delete,view', 'admin/offer', 1, '2020-10-07 08:10:32', '2020-10-07 08:10:32'),
(13, 'Static Page Editor', 'web', 5, 'add,edit,delete,view', 'admin/staticpages', 1, '2020-10-07 08:11:06', '2020-10-07 08:11:06'),
(14, 'Customer Management', 'web', 0, 'add,edit,delete,view', 'admin/customer', 1, '2020-10-07 08:11:54', '2020-10-07 08:11:54'),
(15, 'User Management', 'web', 0, 'add,edit,delete,view', 'admin/users', 1, '2020-10-07 08:12:35', '2020-10-07 08:12:35'),
(16, 'Store Management', 'web', 0, 'add,edit,delete,view', 'admin/store', 1, '2020-10-07 08:13:04', '2020-10-07 08:13:04'),
(17, 'Inventory Management', 'web', 0, 'add,edit,delete,view', 'admin/inventory', 1, '2020-10-07 08:17:22', '2020-10-07 08:17:22'),
(18, 'Banner Promotion', 'web', 0, 'add,edit,delete,view', 'admin/banner', 1, '2020-10-07 08:18:23', '2020-10-07 08:18:23'),
(19, 'Abandoned Cart', 'web', 0, 'add,edit,delete,view', 'admin/abandoned', 1, '2020-10-07 08:18:55', '2020-10-07 08:18:55'),
(20, 'Order Managment', 'web', 0, 'add,edit,delete,view', 'admin/order', 1, '2020-10-07 08:19:26', '2020-10-07 08:19:26'),
(21, 'Bulk SMS', 'web', 0, 'add,edit,delete,view', 'admin/bulksms', 1, '2020-10-08 00:54:13', '2020-10-08 00:54:13'),
(22, 'Send Push Notifications', 'web', 0, 'view', 'admin/pushnotifications', 1, '2020-10-08 01:45:44', '2020-10-08 01:45:44'),
(23, 'Account', 'web', 0, 'add,edit,delete,view', 'admin/test', 1, '2020-10-08 04:14:44', '2020-10-08 04:14:44'),
(24, 'Plans', 'web', 5, 'add,edit,delete,view', 'admin/plans', 1, '2020-10-10 13:29:45', '2020-10-10 13:29:45');

-- --------------------------------------------------------

--
-- Table structure for table `permissions1`
--

CREATE TABLE `permissions1` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `permission_order` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions1`
--

INSERT INTO `permissions1` (`id`, `name`, `guard_name`, `parent_id`, `permission_order`, `created_at`, `updated_at`) VALUES
(2, 'Customer Managment', 'web', 0, 2, '2018-10-31 06:51:07', '2018-10-31 06:51:07'),
(1, 'User Managment', 'web', 0, 1, '2018-09-30 18:30:00', NULL),
(20, 'Delete', 'web', 1, 1, NULL, NULL),
(19, 'View', 'web', 1, 1, NULL, NULL),
(18, 'View', 'web', 2, 1, NULL, NULL),
(17, 'Delete', 'web', 2, 1, NULL, NULL),
(3, 'Store Managment', 'web', 0, 3, '2018-10-31 06:51:14', '2018-10-31 06:51:14'),
(4, 'Inventory Managment', 'web', 0, 4, '2018-10-31 06:51:21', '2018-10-31 06:51:21'),
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
(51, 'Order Module', 'web', 0, 1, '2019-10-01 09:08:59', '2019-10-01 09:08:59'),
(52, 'edit', 'web', 51, 1, '2019-10-01 09:08:59', '2019-10-01 09:08:59'),
(53, 'view', 'web', 51, 1, '2019-10-01 09:08:59', '2019-10-01 09:08:59'),
(54, 'Email Template', 'web', 0, 7, '2019-09-06 06:08:01', '2019-09-06 06:08:01'),
(55, 'view', 'web', 54, 1, '2019-10-01 09:08:59', '2019-10-01 09:08:59'),
(56, 'Master', 'web', 0, 1, '2020-10-07 06:12:51', '2020-10-07 06:12:51'),
(57, 'add', 'web', 56, 1, '2020-10-07 06:12:51', '2020-10-07 06:12:51'),
(58, 'edit', 'web', 56, 1, '2020-10-07 06:12:51', '2020-10-07 06:12:51'),
(59, 'delete', 'web', 56, 1, '2020-10-07 06:12:51', '2020-10-07 06:12:51'),
(60, 'view', 'web', 56, 1, '2020-10-07 06:12:51', '2020-10-07 06:12:51'),
(61, 'Create Offer', 'web', 0, 1, '2020-10-07 06:13:46', '2020-10-07 06:13:46'),
(62, 'add', 'web', 61, 1, '2020-10-07 06:13:46', '2020-10-07 06:13:46'),
(63, 'edit', 'web', 61, 1, '2020-10-07 06:13:46', '2020-10-07 06:13:46'),
(64, 'delete', 'web', 61, 1, '2020-10-07 06:13:46', '2020-10-07 06:13:46'),
(65, 'view', 'web', 61, 1, '2020-10-07 06:13:46', '2020-10-07 06:13:46'),
(66, 'Banner Promotion', 'web', 0, 1, '2020-10-07 06:14:07', '2020-10-07 06:14:07'),
(67, 'add', 'web', 66, 1, '2020-10-07 06:14:07', '2020-10-07 06:14:07'),
(68, 'edit', 'web', 66, 1, '2020-10-07 06:14:07', '2020-10-07 06:14:07'),
(69, 'delete', 'web', 66, 1, '2020-10-07 06:14:07', '2020-10-07 06:14:07'),
(70, 'view', 'web', 66, 1, '2020-10-07 06:14:07', '2020-10-07 06:14:07'),
(71, 'Category', 'web', 0, 1, '2020-10-07 07:12:46', '2020-10-07 07:12:46'),
(72, 'add', 'web', 71, 1, '2020-10-07 07:12:46', '2020-10-07 07:12:46'),
(73, 'edit', 'web', 71, 1, '2020-10-07 07:12:46', '2020-10-07 07:12:46'),
(74, 'delete', 'web', 71, 1, '2020-10-07 07:12:46', '2020-10-07 07:12:46'),
(75, 'view', 'web', 71, 1, '2020-10-07 07:12:46', '2020-10-07 07:12:46'),
(76, 'Unit', 'web', 0, 1, '2020-10-07 07:13:01', '2020-10-07 07:13:01'),
(77, 'add', 'web', 76, 1, '2020-10-07 07:13:01', '2020-10-07 07:13:01'),
(78, 'edit', 'web', 76, 1, '2020-10-07 07:13:01', '2020-10-07 07:13:01'),
(79, 'delete', 'web', 76, 1, '2020-10-07 07:13:01', '2020-10-07 07:13:01'),
(80, 'view', 'web', 76, 1, '2020-10-07 07:13:01', '2020-10-07 07:13:01'),
(81, 'Brand', 'web', 0, 1, '2020-10-07 07:13:17', '2020-10-07 07:13:17'),
(82, 'add', 'web', 81, 1, '2020-10-07 07:13:17', '2020-10-07 07:13:17'),
(83, 'edit', 'web', 81, 1, '2020-10-07 07:13:17', '2020-10-07 07:13:17'),
(84, 'delete', 'web', 81, 1, '2020-10-07 07:13:17', '2020-10-07 07:13:17'),
(85, 'view', 'web', 81, 1, '2020-10-07 07:13:17', '2020-10-07 07:13:17'),
(86, 'Product', 'web', 0, 1, '2020-10-07 07:13:31', '2020-10-07 07:13:31'),
(87, 'add', 'web', 86, 1, '2020-10-07 07:13:31', '2020-10-07 07:13:31'),
(88, 'edit', 'web', 86, 1, '2020-10-07 07:13:31', '2020-10-07 07:13:31'),
(89, 'delete', 'web', 86, 1, '2020-10-07 07:13:31', '2020-10-07 07:13:31'),
(90, 'view', 'web', 86, 1, '2020-10-07 07:13:31', '2020-10-07 07:13:31'),
(91, 'SMS Template Editor', 'web', 0, 1, '2020-10-07 07:14:13', '2020-10-07 07:14:13'),
(92, 'add', 'web', 91, 1, '2020-10-07 07:14:13', '2020-10-07 07:14:13'),
(93, 'edit', 'web', 91, 1, '2020-10-07 07:14:13', '2020-10-07 07:14:13'),
(94, 'delete', 'web', 91, 1, '2020-10-07 07:14:13', '2020-10-07 07:14:13'),
(95, 'view', 'web', 91, 1, '2020-10-07 07:14:13', '2020-10-07 07:14:13'),
(96, 'Abandoned Cart', 'web', 0, 1, '2020-10-07 07:14:35', '2020-10-07 07:14:35'),
(97, 'add', 'web', 96, 1, '2020-10-07 07:14:35', '2020-10-07 07:14:35'),
(98, 'edit', 'web', 96, 1, '2020-10-07 07:14:35', '2020-10-07 07:14:35'),
(99, 'delete', 'web', 96, 1, '2020-10-07 07:14:35', '2020-10-07 07:14:35'),
(100, 'view', 'web', 96, 1, '2020-10-07 07:14:35', '2020-10-07 07:14:35'),
(101, 'Static Page Editor', 'web', 0, 1, '2020-10-07 07:15:21', '2020-10-07 07:15:21'),
(102, 'add', 'web', 101, 1, '2020-10-07 07:15:21', '2020-10-07 07:15:21'),
(103, 'edit', 'web', 101, 1, '2020-10-07 07:15:21', '2020-10-07 07:15:21'),
(104, 'delete', 'web', 101, 1, '2020-10-07 07:15:21', '2020-10-07 07:15:21'),
(105, 'view', 'web', 101, 1, '2020-10-07 07:15:21', '2020-10-07 07:15:21');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `plan_id` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(500) NOT NULL DEFAULT '',
  `price` varchar(100) NOT NULL DEFAULT '0',
  `description` varchar(3000) NOT NULL DEFAULT '',
  `plan_type` varchar(10) NOT NULL DEFAULT '0',
  `image` varchar(500) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `plan_id`, `name`, `price`, `description`, `plan_type`, `image`, `deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, '', 'test_plan', '100', '<p>for test sdfadsfsad</p>', '2', '5f81b78381fbb.png', 0, '2020-10-10 13:30:43', '2020-10-10 13:31:41', '2020-10-10 13:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `userType` int(11) NOT NULL DEFAULT 0,
  `userid` int(11) DEFAULT 0,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdby` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `userType`, `userid`, `name`, `guard_name`, `createdby`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 2, 'Super Admin', 'web', 1, '2018-04-18 13:47:48', '2018-04-18 13:47:48', NULL),
(20, 0, 1, 'Store Manager', 'web', 1, '2018-11-01 05:06:21', '2019-09-05 05:53:01', NULL),
(36, 0, 1, 'Customer Manager', 'web', 1, '2018-11-01 05:06:21', '2020-09-01 15:45:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(5, 1),
(5, 20),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(11, 20),
(12, 1),
(12, 20),
(13, 1),
(14, 1),
(14, 36),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(18, 20),
(19, 1),
(19, 20),
(20, 1),
(20, 20),
(20, 36),
(21, 1),
(22, 1),
(23, 1),
(24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '45',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complete_profile` int(11) NOT NULL DEFAULT 0,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT 0,
  `updated_by` int(11) DEFAULT NULL,
  `IsVerify` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `user_reg_status` enum('NEW','OLD') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NEW',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `user_code`, `name`, `last_name`, `password`, `mobile_number`, `country_code`, `email`, `complete_profile`, `profile_pic`, `created_by`, `updated_by`, `IsVerify`, `status`, `user_reg_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, NULL, NULL, NULL, NULL, '9926331375', '91', NULL, 0, NULL, 0, NULL, 1, 1, 'NEW', '2020-09-01 03:22:03', '2020-09-01 03:22:03', NULL),
(6, NULL, NULL, NULL, NULL, '9926331376', '91', NULL, 0, NULL, 0, NULL, 1, 1, 'NEW', '2020-09-01 03:22:42', '2020-09-01 03:22:42', NULL),
(7, NULL, NULL, NULL, NULL, '9926331377', '91', NULL, 0, NULL, 0, NULL, 1, 1, 'NEW', '2020-09-01 03:25:25', '2020-09-01 03:25:25', NULL),
(8, NULL, 'manish', NULL, NULL, '9926331378', '91', 'manish979898@gmail.com', 0, NULL, 0, NULL, 1, 1, 'OLD', '2020-09-01 03:26:29', '2020-09-01 03:33:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `expiry_date` datetime DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `payment_method` tinyint(1) DEFAULT NULL,
  `payment_amount` int(11) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `desctiption` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondCaption` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thirdCaption` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL DEFAULT 0,
  `UpdatedBy` int(11) DEFAULT NULL,
  `IsActive` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_banner`
--

INSERT INTO `tbl_banner` (`id`, `title`, `caption`, `secondCaption`, `thirdCaption`, `image`, `CreatedBy`, `UpdatedBy`, `IsActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test update', 'one', 'one', 'one', '1599841344.jpg', 0, NULL, 1, '2020-09-11 10:52:24', '2020-09-11 11:03:24', NULL),
(2, 'second', 'second', 'second', 'second', '1601459702.jpg', 0, NULL, 1, '2020-09-30 04:25:02', '2020-09-30 04:25:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT 0,
  `updated_by` int(11) DEFAULT NULL,
  `IsActive` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`id`, `name`, `category_id`, `created_by`, `updated_by`, `IsActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'abc', '2', 0, NULL, 1, '2020-09-03 08:05:00', '2020-09-03 08:05:00', NULL),
(2, 'xyz update', '1', 0, NULL, 1, '2020-09-03 08:05:20', '2020-09-08 00:01:11', NULL),
(3, 'test brandadsfads', '1', 0, NULL, 1, '2020-10-10 05:56:04', '2020-10-10 05:58:24', '2020-10-10 05:58:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `IsActive` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`id`, `user_id`, `store_id`, `IsActive`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 1, 1, 1, '2020-09-15 04:07:40', '2020-09-16 00:38:48', NULL),
(2, 7, 7, 1, 1, '2020-10-14 07:33:55', '2020-10-14 07:33:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart_detail`
--

CREATE TABLE `tbl_cart_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `cart_id` int(11) NOT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `max_amount` int(11) DEFAULT NULL,
  `createdBy` int(11) NOT NULL DEFAULT 0,
  `updatedBy` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1:not place,2:place order',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_cart_detail`
--

INSERT INTO `tbl_cart_detail` (`id`, `cart_id`, `inventory_id`, `product_id`, `store_id`, `qty`, `max_amount`, `createdBy`, `updatedBy`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 5, 4, 2, 1, NULL, 0, NULL, 2, '2020-09-15 04:07:41', '2020-09-15 04:14:07', NULL),
(2, 1, 5, 4, 2, 1, NULL, 0, NULL, 2, '2020-09-15 04:13:05', '2020-09-15 04:14:07', NULL),
(8, 1, 2, 3, 1, 4, NULL, 0, NULL, 1, '2020-09-16 00:39:17', '2020-09-16 00:39:30', NULL),
(7, 1, 1, 2, 1, 2, NULL, 0, NULL, 1, '2020-09-16 00:38:48', '2020-09-16 00:38:57', NULL),
(10, 2, 22, 15, 7, 1, NULL, 0, NULL, 1, '2020-10-14 07:36:10', '2020-10-14 07:36:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `IsHomePage` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=yes,0=no',
  `category_order` int(11) NOT NULL,
  `sell_count` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT 0,
  `updated_by` int(11) DEFAULT NULL,
  `IsActive` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`, `image`, `banner_image`, `parent_id`, `IsHomePage`, `category_order`, `sell_count`, `created_by`, `updated_by`, `IsActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ice-Creams', '1599470913.png', NULL, 0, 0, 1, 0, 1, NULL, 1, '2020-08-28 05:29:07', '2020-10-10 06:08:02', '2020-10-10 06:08:02'),
(2, 'Grocery', '1598614067.jpg', NULL, 0, 0, 2, 0, 1, NULL, 1, '2020-08-28 05:57:47', '2020-10-10 06:07:58', '2020-10-10 06:07:58'),
(3, 'Kitchen Staples', '', NULL, 2, 0, 0, 0, 1, NULL, 1, '2020-09-03 05:56:42', '2020-10-10 06:07:53', '2020-10-10 06:07:53'),
(4, 'type 1', '1599924460.jpg', NULL, 3, 0, 0, 0, 1, NULL, 1, '2020-09-03 06:45:21', '2020-10-10 06:07:48', '2020-10-10 06:07:48'),
(5, 'chocobar', '1599924440.jpg', NULL, 1, 0, 0, 0, 1, NULL, 1, '2020-09-04 00:42:21', '2020-10-10 06:07:44', '2020-10-10 06:07:44'),
(6, 'cold ice creams', '1599923991.jpg', NULL, 1, 0, 0, 0, 1, NULL, 1, '2020-09-08 00:00:33', '2020-10-10 06:07:40', '2020-10-10 06:07:40'),
(7, 'Personal Care', '', NULL, 2, 0, 0, 0, 1, NULL, 1, '2020-09-22 03:05:32', '2020-10-10 06:07:36', '2020-10-10 06:07:36'),
(8, 'Packed Food & Snacks', '', NULL, 2, 0, 0, 0, 1, NULL, 1, '2020-09-22 03:05:51', '2020-10-10 06:07:31', '2020-10-10 06:07:31'),
(9, 'Household Care', '', NULL, 2, 1, 0, 0, 1, NULL, 1, '2020-09-22 03:06:11', '2020-10-10 06:07:27', '2020-10-10 06:07:27'),
(10, 'Ready to Eat', '5f7effc76b2fe.jpg', '5f7f00485f92e.png', 2, 1, 0, 0, 1, NULL, 1, '2020-09-22 03:06:28', '2020-10-10 06:07:23', '2020-10-10 06:07:23'),
(12, 'Test', '5f800575c2385.jpg', '5f800575c26b9.png', 0, 0, 0, 0, 1, NULL, 1, '2020-10-09 01:08:45', '2020-10-10 06:07:18', '2020-10-10 06:07:18'),
(13, 'testd', '5f814c44bb73d.jpg', '5f814c44bb78c.jpg', 1, 0, 0, 0, 1, NULL, 1, '2020-10-10 05:53:08', '2020-10-10 05:54:53', '2020-10-10 05:54:53'),
(14, 'Grocery', '5f81503e47caf.jpg', '5f81503e47d0a.jpg', 0, 1, 0, 5, 1, NULL, 1, '2020-10-10 06:10:06', '2020-10-10 06:14:11', NULL),
(15, 'Ice-Creams', '5f81506245564.jpg', '5f815062455b2.png', 0, 1, 0, 4, 1, NULL, 1, '2020-10-10 06:10:42', '2020-10-10 06:14:08', NULL),
(16, 'Cake shops', '5f81509493ce1.jpg', '5f81509493d33.jpg', 0, 1, 0, 0, 1, NULL, 1, '2020-10-10 06:11:32', '2020-10-10 06:14:03', NULL),
(17, 'Stationaries', '5f8150f466160.jpg', '5f8150f4661ba.jpg', 0, 1, 0, 0, 1, NULL, 1, '2020-10-10 06:13:08', '2020-10-10 10:41:16', NULL),
(18, 'Restaurants', '5f815121055aa.jpeg', '5f815121055fb.jpg', 0, 0, 0, 0, 1, NULL, 1, '2020-10-10 06:13:53', '2020-10-10 06:13:53', NULL),
(19, 'kitchen', '5f81659dcc55c.jpg', '5f81659dcc5b9.png', 14, 0, 0, 0, 1, NULL, 1, '2020-10-10 07:41:17', '2020-10-10 07:41:17', NULL),
(20, 'vanilla', '5f81694870b1b.png', '5f81694870b73.jpg', 15, 0, 0, 0, 1, NULL, 1, '2020-10-10 07:56:56', '2020-10-10 07:56:56', NULL),
(21, 'chokobaar', '5f81699333046.jpg', '5f816993330a5.png', 15, 0, 0, 0, 1, NULL, 1, '2020-10-10 07:58:11', '2020-10-10 08:04:05', NULL),
(22, 'chokobaar', '5f816a1104b96.jpeg', '5f816a1104bea.jpeg', 16, 0, 0, 0, 1, NULL, 1, '2020-10-10 08:00:17', '2020-10-10 08:00:17', NULL),
(23, 'vanilla', '5f816a2d716b3.jpg', '5f816a2d71701.jpg', 16, 0, 0, 0, 1, NULL, 1, '2020-10-10 08:00:45', '2020-10-10 08:00:45', NULL),
(24, 'Office Stationary', '5f816c730b25f.jpg', '5f816c730b2af.jpg', 17, 0, 0, 0, 1, NULL, 1, '2020-10-10 08:10:27', '2020-10-10 08:10:27', NULL),
(25, 'school stationary', '5f816cad73793.jpg', '5f816cad737ef.jpg', 17, 0, 0, 0, 1, NULL, 1, '2020-10-10 08:11:25', '2020-10-10 08:11:25', NULL),
(26, 'Veg Restaurant', '5f816cec005a8.jpg', '5f816cec00602.jpg', 18, 0, 0, 0, 1, NULL, 1, '2020-10-10 08:12:28', '2020-10-10 08:13:20', NULL),
(27, 'Non Veg', '5f816d130bdb2.jpg', '5f816d130be08.jpg', 18, 0, 0, 0, 1, NULL, 1, '2020-10-10 08:13:07', '2020-10-10 10:41:03', NULL),
(28, 'test', '5f8188a93fe82.jpg', '5f8188a93feef.png', 0, 0, 0, 0, 1, NULL, 1, '2020-10-10 10:10:49', '2020-10-10 10:13:50', '2020-10-10 10:13:50'),
(29, 'Cleaners', '5f84059fded73.png', '5f84059fdee47.png', 14, 0, 0, 0, 1, NULL, 1, '2020-10-12 07:28:00', '2020-10-12 07:28:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '45',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_count` int(11) NOT NULL DEFAULT 0,
  `complete_profile` int(11) NOT NULL DEFAULT 0,
  `ambassador` int(11) NOT NULL DEFAULT 0,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT 0,
  `updated_by` int(11) DEFAULT NULL,
  `IsVerify` int(11) NOT NULL DEFAULT 1,
  `IsActive` int(11) NOT NULL DEFAULT 1,
  `user_reg_status` enum('NEW','OLD') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NEW',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `user_code`, `name`, `last_name`, `password`, `mobile_number`, `country_code`, `email`, `otp`, `otp_count`, `complete_profile`, `ambassador`, `profile_pic`, `created_by`, `updated_by`, `IsVerify`, `IsActive`, `user_reg_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'manish', 'sharma', NULL, '9856985644', '45', 'manish@gmail.com', NULL, 0, 0, 0, '1598617956.jpg', 0, NULL, 1, 1, 'NEW', '2020-08-28 07:02:36', '2020-10-10 06:30:03', '2020-10-10 06:30:03'),
(2, NULL, 'test', 'test', NULL, '9856888888', '45', 'test11@gmail.com', NULL, 0, 0, 0, '1598988052.jpg', 0, NULL, 1, 1, 'NEW', '2020-09-01 13:50:52', '2020-10-10 06:29:59', '2020-10-10 06:29:59'),
(3, NULL, 'manish', 'Varghese', NULL, '12121212312', '45', 'manish99@gmail.com', NULL, 0, 0, 0, '1598989767.jpg', 0, NULL, 1, 1, 'NEW', '2020-09-01 14:12:37', '2020-10-10 06:29:54', '2020-10-10 06:29:54'),
(4, NULL, 'test update', 'sss', NULL, '1212334455', '45', 'test@gmail.com', NULL, 0, 0, 0, NULL, 0, NULL, 1, 1, 'NEW', '2020-09-02 05:36:49', '2020-10-10 06:29:50', '2020-10-10 06:29:50'),
(5, NULL, 'manish', NULL, NULL, '9926331375', '91', 'manish979898@gmail.com', '1234', 1, 0, 0, NULL, 0, NULL, 1, 1, 'OLD', '2020-09-07 02:46:37', '2020-10-10 06:29:46', '2020-10-10 06:29:46'),
(6, NULL, NULL, NULL, NULL, '9926331375', '91', NULL, NULL, 1, 0, 0, NULL, 0, NULL, 1, 1, 'NEW', '2020-10-10 07:51:38', '2020-10-10 09:11:03', NULL),
(7, NULL, 'Rajesh Thakur', NULL, NULL, '9779191546', '91', 'rajeshupwork01@gmail.com', NULL, 1, 0, 0, NULL, 0, NULL, 1, 1, 'OLD', '2020-10-10 09:25:11', '2020-10-10 09:25:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_template`
--

CREATE TABLE `tbl_email_template` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdBy` int(11) NOT NULL DEFAULT 0,
  `updatedBy` int(11) DEFAULT NULL,
  `IsActive` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_email_template`
--

INSERT INTO `tbl_email_template` (`id`, `title`, `subject`, `body`, `background_img`, `createdBy`, `updatedBy`, `IsActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
(44, 'Test Email Templatexcvxc', 'applicant test', '<p>TO:{first_name}</p>\r\n\r\n<p>Subjec: for test</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Instead of defining all of your request handling logic in a single&nbsp;<code>routes.php</code>&nbsp;file, you may wish to organize this behavior using Controller classes. Controllers can group related HTTP request handling logic into a class. Controllers are typically stored in thexcvxcv</p>', '1602311505.jpg', 0, NULL, 1, '2020-10-06 04:19:17', '2020-10-10 06:31:45', NULL),
(45, 'v', 'v', '<p>cxvxc xxcvxcv</p>', '1602311493.png', 0, NULL, 1, '2020-10-08 05:18:20', '2020-10-10 06:31:33', NULL),
(46, 'cvb', 'cvbcvbcvbcvbcvb', '<p>cvbcvb</p>', '', 0, NULL, 1, '2020-10-08 06:00:25', '2020-10-08 06:00:32', '2020-10-08 06:00:32'),
(47, 'Test Email Templateasdfsd asdfds', 'asdfadsfads ds fds', '<p>asdfadssdag safdsafsd sdfa dfsd</p>', '1602310154.jpg', 0, NULL, 1, '2020-10-10 06:09:14', '2020-10-10 06:09:32', '2020-10-10 06:09:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory`
--

CREATE TABLE `tbl_inventory` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `inventory_entry_id` int(11) NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `weight` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `internal_price` decimal(25,2) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `discount_type` tinyint(4) NOT NULL COMMENT '0=nodiscount,1=flat,2=per',
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `IsActive` int(11) NOT NULL DEFAULT 1,
  `productVerify` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_inventory`
--

INSERT INTO `tbl_inventory` (`id`, `product_id`, `inventory_entry_id`, `store_id`, `stock`, `weight`, `unit`, `price`, `internal_price`, `discount`, `discount_type`, `brand_id`, `category_id`, `sub_category_id`, `status`, `added_by`, `created_by`, `IsActive`, `productVerify`, `created_at`, `updated_at`, `deleted_at`) VALUES
(21, 15, 21, 7, 23, '1', 1, '56.00', '50.00', 3, 2, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-10 08:39:05', '2020-10-10 08:39:05', NULL),
(20, 13, 20, 7, 3, '2', 1, '23.00', '50.00', NULL, 0, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-10 08:38:17', '2020-10-10 08:38:17', NULL),
(19, 13, 19, 7, 2, '1', 1, '60.00', '50.00', NULL, 0, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-10 08:38:17', '2020-10-10 08:38:17', NULL),
(18, 13, 18, 7, 12, '5', 1, '56.00', '50.00', NULL, 0, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-10 08:38:17', '2020-10-10 08:38:17', NULL),
(22, 15, 22, 7, 22, '2', 1, '60.00', '50.00', 10, 1, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-10 08:39:05', '2020-10-10 08:39:05', NULL),
(23, 16, 23, 8, 45, '5', 1, '100.00', '100.00', 3, 2, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-10 08:40:06', '2020-10-10 08:40:06', NULL),
(24, 16, 24, 8, 123, '2', 1, '120.00', '100.00', NULL, 0, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-10 08:40:06', '2020-10-10 08:40:06', NULL),
(25, 13, 25, 9, 233, '1', 1, '200.00', '199.00', 2, 2, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-10 08:44:58', '2020-10-10 08:44:58', NULL),
(26, 13, 26, 9, 333, '2', 1, '333.00', '111.00', 2, 2, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-10 08:44:58', '2020-10-10 08:44:58', NULL),
(27, 13, 27, 9, 33, '5', 1, '333.00', '111.00', 2, 2, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-10 08:44:58', '2020-10-10 08:44:58', NULL),
(28, 13, 28, 9, 33, '10', 1, '333.00', '111.00', 20, 1, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-10 08:44:58', '2020-10-10 08:44:58', NULL),
(29, 14, 29, 9, 233, '1', 1, '200.00', '199.00', 2, 2, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-10 08:46:52', '2020-10-10 08:46:52', NULL),
(30, 14, 30, 9, 233, '5', 1, '2000.00', '199.00', 2, 1, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-10 08:46:52', '2020-10-10 08:46:52', NULL),
(31, 15, 31, 9, 233, '1', 1, '200.00', '199.00', 2, 1, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-10 08:48:59', '2020-10-10 08:48:59', NULL),
(32, 16, 32, 9, 2000, '5', 1, '2000.00', '199.00', 2, 2, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-10 08:49:51', '2020-10-10 08:49:51', NULL),
(33, 17, 33, 9, 2000, '5', 1, '2000.00', '199.00', 2, 2, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-10 08:50:46', '2020-10-10 08:50:46', NULL),
(34, 17, 34, 9, 233, '1', 1, '200.00', '199.00', 2, 2, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-10 08:50:46', '2020-10-10 08:50:46', NULL),
(35, 18, 35, 7, 600, '1', 4, '1111.00', '199.00', 20, 2, NULL, 15, 20, 'available', 'admin', 1, 1, 1, '2020-10-10 10:33:20', '2020-10-10 10:33:20', NULL),
(36, 19, 36, 7, 2000, '1', 4, '200.00', '199.00', 2, 2, NULL, 15, 21, 'available', 'admin', 1, 1, 1, '2020-10-10 11:34:46', '2020-10-10 11:34:46', NULL),
(37, 21, 37, 7, 2000, '1', 4, '400.00', '199.00', 20, 2, NULL, 15, 21, 'available', 'admin', 1, 1, 1, '2020-10-10 11:35:19', '2020-10-10 11:35:19', NULL),
(38, 22, 38, 7, 2000, '300', 5, '200.00', '199.00', 2, 1, NULL, 16, 22, 'available', 'admin', 1, 1, 1, '2020-10-10 11:35:56', '2020-10-10 11:35:56', NULL),
(39, 23, 39, 7, 2000, '600', 5, '1200.00', '199.00', 20, 2, NULL, 16, 22, 'available', 'admin', 1, 1, 1, '2020-10-10 11:36:43', '2020-10-10 11:36:43', NULL),
(40, 24, 40, 7, 233, '300', 5, '200.00', '199.00', 2, 1, NULL, 16, 23, 'available', 'admin', 1, 1, 1, '2020-10-10 11:37:24', '2020-10-10 11:37:24', NULL),
(41, 29, 41, 10, 2000, '600', 4, '200.00', '199.00', 2, 2, NULL, 17, 24, 'available', 'admin', 1, 1, 1, '2020-10-10 11:38:38', '2020-10-10 11:38:38', NULL),
(42, NULL, 42, 7, 10, '500', 5, '150.00', '110.00', 50, 1, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-12 07:41:46', '2020-10-12 07:41:46', NULL),
(43, NULL, 43, 7, 10, '1', 1, '250.00', '240.00', 40, 1, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-12 07:41:46', '2020-10-12 07:41:46', NULL),
(44, NULL, 44, 7, 3, '3', 1, '350.00', '340.00', 20, 1, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-12 07:41:46', '2020-10-12 07:41:46', NULL),
(45, NULL, 45, 7, 20, '5', 1, '450.00', '440.00', 30, 1, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-12 07:41:46', '2020-10-12 07:41:46', NULL),
(46, NULL, 46, 7, 10, '500', 5, '150.00', '110.00', 50, 1, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-12 07:43:01', '2020-10-12 07:43:01', NULL),
(47, NULL, 47, 7, 10, '1', 1, '250.00', '240.00', 40, 1, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-12 07:43:01', '2020-10-12 07:43:01', NULL),
(48, NULL, 48, 7, 3, '3', 1, '350.00', '340.00', 20, 1, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-12 07:43:01', '2020-10-12 07:43:01', NULL),
(49, NULL, 49, 7, 20, '5', 1, '450.00', '440.00', 30, 1, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-12 07:43:01', '2020-10-12 07:43:01', NULL),
(50, 14, 50, 7, 10, '500', 5, '150.00', '110.00', 5, 2, NULL, 14, 19, 'available', 'admin', 1, 1, 1, '2020-10-12 07:45:00', '2020-10-12 07:45:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_entry`
--

CREATE TABLE `tbl_inventory_entry` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `weight` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `internal_price` decimal(25,2) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `discount_type` tinyint(4) NOT NULL COMMENT '0=nodiscount,1=flat,2=per',
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `IsActive` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_inventory_entry`
--

INSERT INTO `tbl_inventory_entry` (`id`, `product_id`, `store_id`, `category_id`, `sub_category_id`, `qty`, `weight`, `unit`, `price`, `internal_price`, `discount`, `discount_type`, `status`, `added_by`, `created_by`, `IsActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
(21, 15, 7, 14, 19, 23, '1', 1, '56.00', '50.00', 3, 2, 'add', 'admin', 1, 1, '2020-10-10 08:39:05', '2020-10-10 08:39:05', NULL),
(20, 13, 7, 14, 19, 3, '2', 1, '23.00', '50.00', NULL, 0, 'add', 'admin', 1, 1, '2020-10-10 08:38:17', '2020-10-10 08:38:17', NULL),
(19, 13, 7, 14, 19, 2, '1', 1, '60.00', '50.00', NULL, 0, 'add', 'admin', 1, 1, '2020-10-10 08:38:17', '2020-10-10 08:38:17', NULL),
(18, 13, 7, 14, 19, 12, '5', 1, '56.00', '50.00', NULL, 0, 'add', 'admin', 1, 1, '2020-10-10 08:38:17', '2020-10-10 08:38:17', NULL),
(22, 15, 7, 14, 19, 22, '2', 1, '60.00', '50.00', 10, 1, 'add', 'admin', 1, 1, '2020-10-10 08:39:05', '2020-10-10 08:39:05', NULL),
(23, 16, 8, 14, 19, 45, '5', 1, '100.00', '100.00', 3, 2, 'add', 'admin', 1, 1, '2020-10-10 08:40:06', '2020-10-10 08:40:06', NULL),
(24, 16, 8, 14, 19, 123, '2', 1, '120.00', '100.00', NULL, 0, 'add', 'admin', 1, 1, '2020-10-10 08:40:06', '2020-10-10 08:40:06', NULL),
(25, 13, 9, 14, 19, 233, '1', 1, '200.00', '199.00', 2, 2, 'add', 'admin', 1, 1, '2020-10-10 08:44:58', '2020-10-10 08:44:58', NULL),
(26, 13, 9, 14, 19, 333, '2', 1, '333.00', '111.00', 2, 2, 'add', 'admin', 1, 1, '2020-10-10 08:44:58', '2020-10-10 08:44:58', NULL),
(27, 13, 9, 14, 19, 33, '5', 1, '333.00', '111.00', 2, 2, 'add', 'admin', 1, 1, '2020-10-10 08:44:58', '2020-10-10 08:44:58', NULL),
(28, 13, 9, 14, 19, 33, '10', 1, '333.00', '111.00', 20, 1, 'add', 'admin', 1, 1, '2020-10-10 08:44:58', '2020-10-10 08:44:58', NULL),
(29, 14, 9, 14, 19, 233, '1', 1, '200.00', '199.00', 2, 2, 'add', 'admin', 1, 1, '2020-10-10 08:46:52', '2020-10-10 08:46:52', NULL),
(30, 14, 9, 14, 19, 233, '5', 1, '2000.00', '199.00', 2, 1, 'add', 'admin', 1, 1, '2020-10-10 08:46:52', '2020-10-10 08:46:52', NULL),
(31, 15, 9, 14, 19, 233, '1', 1, '200.00', '199.00', 2, 1, 'add', 'admin', 1, 1, '2020-10-10 08:48:59', '2020-10-10 08:48:59', NULL),
(32, 16, 9, 14, 19, 2000, '5', 1, '2000.00', '199.00', 2, 2, 'add', 'admin', 1, 1, '2020-10-10 08:49:51', '2020-10-10 08:49:51', NULL),
(33, 17, 9, 14, 19, 2000, '5', 1, '2000.00', '199.00', 2, 2, 'add', 'admin', 1, 1, '2020-10-10 08:50:46', '2020-10-10 08:50:46', NULL),
(34, 17, 9, 14, 19, 233, '1', 1, '200.00', '199.00', 2, 2, 'add', 'admin', 1, 1, '2020-10-10 08:50:46', '2020-10-10 08:50:46', NULL),
(35, 18, 7, 15, 20, 600, '1', 4, '1111.00', '199.00', 20, 2, 'add', 'admin', 1, 1, '2020-10-10 10:33:20', '2020-10-10 10:33:20', NULL),
(36, 19, 7, 15, 21, 2000, '1', 4, '200.00', '199.00', 2, 2, 'add', 'admin', 1, 1, '2020-10-10 11:34:46', '2020-10-10 11:34:46', NULL),
(37, 21, 7, 15, 21, 2000, '1', 4, '400.00', '199.00', 20, 2, 'add', 'admin', 1, 1, '2020-10-10 11:35:19', '2020-10-10 11:35:19', NULL),
(38, 22, 7, 16, 22, 2000, '300', 5, '200.00', '199.00', 2, 1, 'add', 'admin', 1, 1, '2020-10-10 11:35:56', '2020-10-10 11:35:56', NULL),
(39, 23, 7, 16, 22, 2000, '600', 5, '1200.00', '199.00', 20, 2, 'add', 'admin', 1, 1, '2020-10-10 11:36:43', '2020-10-10 11:36:43', NULL),
(40, 24, 7, 16, 23, 233, '300', 5, '200.00', '199.00', 2, 1, 'add', 'admin', 1, 1, '2020-10-10 11:37:24', '2020-10-10 11:37:24', NULL),
(41, 29, 10, 17, 24, 2000, '600', 4, '200.00', '199.00', 2, 2, 'add', 'admin', 1, 1, '2020-10-10 11:38:38', '2020-10-10 11:38:38', NULL),
(42, NULL, 7, 14, 19, 10, '500', 5, '150.00', '110.00', 50, 1, 'add', 'admin', 1, 1, '2020-10-12 07:41:46', '2020-10-12 07:41:46', NULL),
(43, NULL, 7, 14, 19, 10, '1', 1, '250.00', '240.00', 40, 1, 'add', 'admin', 1, 1, '2020-10-12 07:41:46', '2020-10-12 07:41:46', NULL),
(44, NULL, 7, 14, 19, 3, '3', 1, '350.00', '340.00', 20, 1, 'add', 'admin', 1, 1, '2020-10-12 07:41:46', '2020-10-12 07:41:46', NULL),
(45, NULL, 7, 14, 19, 20, '5', 1, '450.00', '440.00', 30, 1, 'add', 'admin', 1, 1, '2020-10-12 07:41:46', '2020-10-12 07:41:46', NULL),
(46, NULL, 7, 14, 19, 10, '500', 5, '150.00', '110.00', 50, 1, 'add', 'admin', 1, 1, '2020-10-12 07:43:01', '2020-10-12 07:43:01', NULL),
(47, NULL, 7, 14, 19, 10, '1', 1, '250.00', '240.00', 40, 1, 'add', 'admin', 1, 1, '2020-10-12 07:43:01', '2020-10-12 07:43:01', NULL),
(48, NULL, 7, 14, 19, 3, '3', 1, '350.00', '340.00', 20, 1, 'add', 'admin', 1, 1, '2020-10-12 07:43:01', '2020-10-12 07:43:01', NULL),
(49, NULL, 7, 14, 19, 20, '5', 1, '450.00', '440.00', 30, 1, 'add', 'admin', 1, 1, '2020-10-12 07:43:01', '2020-10-12 07:43:01', NULL),
(50, 14, 7, 14, 19, 10, '500', 5, '150.00', '110.00', 5, 2, 'add', 'admin', 1, 1, '2020-10-12 07:45:00', '2020-10-12 07:45:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages_template`
--

CREATE TABLE `tbl_messages_template` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `background_img` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `createdBy` int(11) NOT NULL,
  `updatedBy` int(11) NOT NULL,
  `IsActive` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_messages_template`
--

INSERT INTO `tbl_messages_template` (`id`, `title`, `background_img`, `subject`, `body`, `createdBy`, `updatedBy`, `IsActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'Sms Template', '', '', 'name:- {first_name}\r\nBody:->  It is very important to note that we did not need to specify the full controller namespace, only the portion of the class name that comes after the', 0, 0, 1, '2020-10-08 11:25:55', '2020-10-08 05:55:55', NULL),
(7, 'sdfads asdfdsafasdf a fds ds', '', '', 'adsf adsdsafadsf s sdfadsf sdfdsf sdf sd dfasfsd sd fsdadsds', 0, 0, 1, '2020-10-10 06:10:43', '2020-10-10 06:10:43', '2020-10-10 06:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offer`
--

CREATE TABLE `tbl_offer` (
  `id` int(10) UNSIGNED NOT NULL,
  `coupon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_type` int(11) NOT NULL COMMENT '1:store;2:offer;',
  `discount_type` int(11) NOT NULL COMMENT '1:flat;2:%;',
  `discount_amount` varchar(233) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `min_amount` int(11) DEFAULT NULL,
  `max_amount` int(11) DEFAULT NULL,
  `store_ids` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createdBy` int(11) NOT NULL DEFAULT 0,
  `updatedBy` int(11) DEFAULT NULL,
  `IsActive` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_offer`
--

INSERT INTO `tbl_offer` (`id`, `coupon`, `coupon_type`, `discount_type`, `discount_amount`, `description`, `from_date`, `to_date`, `min_amount`, `max_amount`, `store_ids`, `createdBy`, `updatedBy`, `IsActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test', 1, 0, '', '', '2020-09-12', '2020-09-13', 100, 500, '1,2', 0, NULL, 0, '2020-09-12 04:11:57', '2020-10-10 06:32:16', '2020-10-10 06:32:16'),
(2, 'test1', 2, 0, '', '', '2020-09-08', '2020-09-15', 500, 600, '1,2,3,4', 0, NULL, 1, '2020-09-12 04:22:05', '2020-10-10 06:32:29', '2020-10-10 06:32:29'),
(3, 'test_coupon123', 1, 1, '20', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when&nbsp;</p>', '2020-10-20', '2020-10-31', 100, 200, '2,3,9', 0, NULL, 1, '2020-10-06 11:17:38', '2020-10-10 06:32:25', '2020-10-10 06:32:25'),
(4, 'sdfsdf', 2, 1, '12', '<p>cvxcvxcvxcv</p>', '2020-10-09', '2020-10-22', 12, 2233, '', 0, NULL, 1, '2020-10-09 06:56:29', '2020-10-10 06:32:21', '2020-10-10 06:32:21'),
(5, 'offer', 2, 2, '23', NULL, '2020-10-10', '2020-10-10', 122, 123, '7,8', 0, NULL, 1, '2020-10-10 12:26:14', '2020-10-10 14:30:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `offer_id` int(11) DEFAULT NULL,
  `offer_amount` int(11) DEFAULT NULL,
  `order_amount` decimal(25,2) DEFAULT NULL,
  `payable_amount` decimal(25,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1:Pending,2:accept,3=placed,4=discard',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pendding,1=done',
  `order_detail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createdBy` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updatedBy` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `user_id`, `store_id`, `offer_id`, `offer_amount`, `order_amount`, `payable_amount`, `status`, `description`, `payment_status`, `order_detail`, `createdBy`, `created_at`, `updatedBy`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 2, 200, '211.00', '0.00', 5, '', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum ', 0, '2020-10-06 13:45:08', NULL, '2020-10-12 07:57:11', NULL),
(2, 2, 1, 2, 200, '211.00', '0.00', 5, 'xcvxcvxcv', 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum ', 0, '2020-10-06 13:45:21', NULL, '2020-10-08 01:17:09', NULL),
(3, 3, 1, 2, 200, '211.00', '0.00', 5, 'xhsd dfsfjsdf', 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum ', 0, '2020-10-06 13:45:25', NULL, '2020-10-08 04:00:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_detail`
--

CREATE TABLE `tbl_order_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `waight` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `amount` decimal(25,2) DEFAULT NULL,
  `discount_amount` decimal(25,2) NOT NULL DEFAULT 0.00,
  `payable_amount` decimal(25,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdBy` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_order_detail`
--

INSERT INTO `tbl_order_detail` (`id`, `order_id`, `product_id`, `store_id`, `qty`, `waight`, `unit`, `amount`, `discount_amount`, `payable_amount`, `status`, `createdBy`, `created_at`, `updatedBy`, `updated_at`, `deleted_at`) VALUES
(1, 3, 2, 1, 11, 10, 1, '100.00', '10.00', '90.00', 1, 0, NULL, NULL, NULL, NULL),
(2, 3, 2, 1, 5, 5, 3, '100.00', '10.00', '90.00', 1, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `sub_sub_category_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `unit_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(25,2) DEFAULT NULL,
  `internal_price` decimal(25,2) DEFAULT NULL,
  `meta_data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_tags` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `discount_type` tinyint(1) DEFAULT NULL COMMENT '1=flat,2=per',
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT 0,
  `updated_by` int(11) DEFAULT NULL,
  `IsVerify` int(11) NOT NULL DEFAULT 1,
  `IsActive` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `product_code`, `name`, `category_id`, `sub_category_id`, `sub_sub_category_id`, `brand_id`, `unit_id`, `profile_pic`, `price`, `internal_price`, `meta_data`, `meta_description`, `product_tags`, `discount`, `discount_type`, `description`, `short_description`, `created_by`, `updated_by`, `IsVerify`, `IsActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, NULL, 'DHara Oil', '2', 3, NULL, 2, '1', '1598625522.jpg', '15.00', '15.00', NULL, NULL, NULL, 5, 1, NULL, NULL, 0, NULL, 1, 1, '2020-08-28 09:08:42', '2020-10-10 07:29:40', '2020-10-10 07:29:40'),
(3, NULL, 'product one', '1', 6, NULL, 1, '1', NULL, '25.00', '25.00', NULL, NULL, NULL, 5, 1, NULL, NULL, 0, NULL, 1, 1, '2020-09-02 01:31:45', '2020-10-10 07:29:36', '2020-10-10 07:29:36'),
(4, NULL, 'Product second', '2', 3, 4, 1, '1', NULL, '16.00', '16.00', NULL, NULL, NULL, 5, 1, NULL, NULL, 0, NULL, 1, 1, '2020-09-02 01:32:04', '2020-10-10 07:29:30', '2020-10-10 07:29:30'),
(9, NULL, 'Rin', '2', 3, 4, 1, '1', NULL, '15.00', '15.00', NULL, NULL, NULL, 10, 1, NULL, NULL, 0, NULL, 1, 1, '2020-09-03 05:23:05', '2020-10-10 07:29:26', '2020-10-10 07:29:26'),
(10, NULL, 'one ice creams', '1', 5, NULL, 1, '1', NULL, '10.00', '10.00', NULL, NULL, NULL, 5, 1, NULL, NULL, 0, NULL, 1, 1, '2020-09-08 00:01:36', '2020-10-10 07:29:22', '2020-10-10 07:29:22'),
(11, NULL, 'bansal oil', '2', 3, 4, 1, '1', '1599813836.jpg', '15.00', '15.00', NULL, NULL, NULL, 12, 1, 'test', 'test', 0, NULL, 1, 1, '2020-09-11 00:49:36', '2020-10-10 07:26:55', '2020-10-10 07:26:55'),
(12, NULL, 'testice', '1', 5, NULL, 2, '4', '1602309732.jpg', '10.00', '8.00', 'test', 'test_descrip', 'test_tage', 10, 1, 'dfdgdfsd asfds', 'for gtestadsfds', 0, NULL, 1, 1, '2020-10-10 06:01:33', '2020-10-10 07:29:18', '2020-10-10 07:29:18'),
(13, NULL, 'Mung Dal', '14', 19, NULL, 1, '1', '1602315799.jpg', NULL, NULL, 'asd', 'sadf', 'asd', 0, NULL, 'sdsdsd', 'dssdsd', 0, NULL, 1, 1, '2020-10-10 07:37:58', '2020-10-10 07:43:19', NULL),
(14, NULL, 'Dal', '14', 19, NULL, 1, '1', '1602315546.jpg', NULL, NULL, 'test', 'test', 'test', 0, NULL, 'is a term used in the Indian subcontinent for dried, split pulses (that is, lentils, peas, and beans) that do not require pre-soaking. India is the largest producer of pulses in the world.', 'is a term used in the Indian subcontinent for dried, split pulse', 0, NULL, 1, 1, '2020-10-10 07:39:06', '2020-10-10 07:41:32', NULL),
(15, NULL, 'Toor Dal', '14', 19, NULL, 1, '1', '1602316237.jpg', NULL, NULL, 'asasa', 'asasa', 'assas', 0, NULL, 'sasasas', 'saasasas', 0, NULL, 1, 1, '2020-10-10 07:50:37', '2020-10-10 08:01:26', NULL),
(16, NULL, 'Basmati Raice', '14', 19, NULL, 1, NULL, '1602316383.jpg', NULL, NULL, 'test', 'test', 'test', 0, NULL, 'asas', 'ssas', 0, NULL, 1, 1, '2020-10-10 07:53:03', '2020-10-10 08:01:40', NULL),
(17, NULL, 'Dawat Rice', '14', 19, NULL, 1, NULL, '1602316463.jpg', NULL, NULL, 'test', 'test', 'test', 0, NULL, 'dsdsdsd', 'ssdssds', 0, NULL, 1, 1, '2020-10-10 07:54:23', '2020-10-10 08:02:00', NULL),
(18, NULL, 'vanela tt', '15', 20, NULL, 1, NULL, '1602317008.jpg', NULL, NULL, 'test', 'test', 'test', 0, NULL, 'sdsd', 'sdsds', 0, NULL, 1, 1, '2020-10-10 08:03:28', '2020-10-10 08:03:28', NULL),
(19, NULL, 'chokobaar masti', '15', 21, NULL, 1, NULL, '1602317086.jpg', NULL, NULL, 'test', 'test', 'test', 0, NULL, 'sdsd', 'xssdsd', 0, NULL, 1, 1, '2020-10-10 08:04:46', '2020-10-10 08:04:55', NULL),
(20, NULL, 'batter b', '15', 20, NULL, 1, NULL, '1602317140.jpg', NULL, NULL, 'zxxx', 'zxzxxz', 'xzxz', 0, NULL, 'zxzx', 'xzxzxzx', 0, NULL, 1, 1, '2020-10-10 08:05:40', '2020-10-10 08:05:40', NULL),
(21, NULL, 'chako chips', '15', 21, NULL, 1, NULL, '1602317183.jpg', NULL, NULL, 'zzx', 'zxzxx', 'xzxzx', 0, NULL, 'xzxzx', 'zxzxz', 0, NULL, 1, 1, '2020-10-10 08:06:23', '2020-10-10 08:06:23', NULL),
(22, NULL, 'Birthday Cack', '16', 22, NULL, 1, NULL, '1602317226.jpg', NULL, NULL, 'test', 'test', 'test', 0, NULL, 'xccx', 'xcxcxcx', 0, NULL, 1, 1, '2020-10-10 08:07:06', '2020-10-10 08:07:06', NULL),
(23, NULL, 'Engagement cack', '16', 22, NULL, 1, NULL, '1602317265.jpeg', NULL, NULL, 'test', 'test', 'test', 0, NULL, 'cxc', 'xccxcx', 0, NULL, 1, 1, '2020-10-10 08:07:45', '2020-10-10 08:07:54', NULL),
(24, NULL, 'marriage cack', '16', 23, NULL, 1, NULL, '1602317346.jpg', NULL, NULL, 'test', 'cc', 'cs', 0, NULL, 'scscsscs', 'ssscsc', 0, NULL, 1, 1, '2020-10-10 08:09:06', '2020-10-10 08:09:06', NULL),
(25, NULL, 'Sahi Thali', '18', 26, NULL, 1, NULL, '1602317670.jpg', NULL, NULL, 'zxxz', 'xzxzx', 'zxzxzxz', 0, NULL, 'zxzxzx', 'xzxzxzx', 0, NULL, 1, 1, '2020-10-10 08:14:30', '2020-10-10 08:14:30', NULL),
(26, NULL, 'Dal tadka', '18', 26, NULL, 1, NULL, '1602317747.jpg', NULL, NULL, 'xzxzx', 'zxzx', 'zxzxzx', 0, NULL, 'zxzx', 'zxzx', 0, NULL, 1, 1, '2020-10-10 08:15:47', '2020-10-10 08:15:47', NULL),
(27, NULL, 'Matar paneer', '18', 26, NULL, 1, NULL, '1602317868.jpg', NULL, NULL, 'sdds', 'dsds', 'dsds', 0, NULL, 'dsd', 'dsds', 0, NULL, 1, 1, '2020-10-10 08:17:48', '2020-10-10 08:18:00', NULL),
(28, NULL, 'shahi paneer', '18', 26, NULL, 1, NULL, '1602317934.jpg', NULL, NULL, 'xdadada', 'dadad', 'adad', 0, NULL, 'dadadada', 'adadad', 0, NULL, 1, 1, '2020-10-10 08:18:54', '2020-10-10 08:18:54', NULL),
(29, NULL, 'pen', '17', 24, NULL, 1, NULL, '1602317988.jpg', NULL, NULL, 'asasas', 'sasass', 'asasa', 0, NULL, 'asasasas', 'sasasas', 0, NULL, 1, 1, '2020-10-10 08:19:48', '2020-10-10 08:19:48', NULL),
(30, NULL, 'Books', '17', 24, NULL, 1, NULL, '1602318140.jpg', NULL, NULL, 'ssdds', 'dsdsd', 'sdsd', 0, NULL, 'dsds', 'sdsd', 0, NULL, 1, 1, '2020-10-10 08:21:43', '2020-10-10 08:22:20', NULL),
(31, NULL, 'Rin Combo', '14', 29, NULL, 1, NULL, '1602487940.png', NULL, NULL, 'fhgfhg', 'fdf', 'rin', 0, NULL, 'cleaners', 'cleaners', 0, NULL, 1, 1, '2020-10-12 07:32:20', '2020-10-12 07:32:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_search_history`
--

CREATE TABLE `tbl_search_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `IsActive` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_search_history`
--

INSERT INTO `tbl_search_history` (`id`, `item_id`, `item_type`, `user_id`, `IsActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '4', 'product', 5, 1, '2020-09-10 07:22:27', '2020-09-10 07:22:27', NULL),
(2, '4', 'product', 5, 1, '2020-09-10 07:23:52', '2020-09-10 07:23:52', NULL),
(3, '1', 'store', 5, 1, '2020-09-10 07:52:15', '2020-09-10 07:52:15', NULL),
(4, '2', 'store', 5, 1, '2020-09-10 08:04:11', '2020-09-10 08:04:11', NULL),
(5, '3', 'store', 5, 1, '2020-09-10 08:04:26', '2020-09-10 08:04:26', NULL),
(6, '2', 'category', 5, 1, '2020-09-23 02:16:22', '2020-09-23 02:16:22', NULL),
(7, '4', 'product22', 5, 1, '2020-09-23 03:02:26', '2020-09-23 03:02:26', NULL),
(8, '14', 'category', 8, 1, '2020-10-10 07:14:03', '2020-10-10 07:14:03', NULL),
(9, '4', 'store', 8, 1, '2020-10-10 07:15:34', '2020-10-10 07:15:34', NULL),
(10, '4', 'product', 8, 1, '2020-10-10 07:16:21', '2020-10-10 07:16:21', NULL),
(11, '7', 'store', 8, 1, '2020-10-10 07:36:58', '2020-10-10 07:36:58', NULL),
(12, '13', 'product', 8, 1, '2020-10-10 07:40:09', '2020-10-10 07:40:09', NULL),
(13, '14', 'category', 7, 1, '2020-10-10 09:26:50', '2020-10-10 09:26:50', NULL),
(14, '10', 'store', 7, 1, '2020-10-10 09:42:00', '2020-10-10 09:42:00', NULL),
(15, '9', 'store', 10, 1, '2020-10-10 10:35:35', '2020-10-10 10:35:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_static_page_editor`
--

CREATE TABLE `tbl_static_page_editor` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `IsActive` int(1) NOT NULL DEFAULT 1,
  `updated_at` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_static_page_editor`
--

INSERT INTO `tbl_static_page_editor` (`id`, `title`, `content`, `IsActive`, `updated_at`, `created_at`) VALUES
(1, 'Tarm&Condition', '<h1>GOOGLE TERMS OF SERVICE</h1>\r\n\r\n<p>Effective 31 March 2020&nbsp;|&nbsp;<a href=\"https://policies.google.com/terms/archive?hl=en-IN&amp;fg=1\">Archived versions</a>&nbsp;|&nbsp;<a href=\"https://www.gstatic.com/policies/terms/pdf/20200331/ba461e2f/google_terms_of_service_en-GB_in.pdf\">Download PDF</a></p>\r\n\r\n<h2>What&rsquo;s covered in these terms</h2>\r\n\r\n<h3>We know it&rsquo;s tempting to skip these Terms of Service, but it&rsquo;s important to establish what you can expect from us as you use Google&nbsp;<a href=\"https://policies.google.com/terms?hl=en-IN&amp;fg=1#footnote-services\">services</a>, and what we expect from you.</h3>\r\n\r\n<p>These Terms of Service reflect&nbsp;<a href=\"https://about.google/intl/en-GB_IN/how-our-business-works\" target=\"_blank\">the way that Google&rsquo;s business works</a>, the laws that apply to our company, and&nbsp;<a href=\"https://www.google.com/about/philosophy.html?hl=en_GB\" target=\"_blank\">certain things that we&rsquo;ve always believed to be true</a>. As a result, these Terms of Service help define Google&rsquo;s relationship with you as you interact with our services. For example, these terms include the following topic headings:</p>\r\n\r\n<ul>\r\n	<li><a href=\"https://policies.google.com/terms?hl=en-IN&amp;fg=1#toc-what-you-expect\">What you can expect from us</a>, which describes how we provide and develop our services</li>\r\n	<li><a href=\"https://policies.google.com/terms?hl=en-IN&amp;fg=1#toc-what-we-expect\">What we expect from you</a>, which establishes certain rules for using our services</li>\r\n	<li><a href=\"https://policies.google.com/terms?hl=en-IN&amp;fg=1#toc-content\">Content in Google services</a>, which describes the intellectual property rights to the content that you find in our services &ndash; whether that content belongs to you, Google or others</li>\r\n	<li><a href=\"https://policies.google.com/terms?hl=en-IN&amp;fg=1#toc-problems\">In case of problems or disagreements</a>, which describes other legal rights that you have, and what to expect in case someone violates these terms.</li>\r\n</ul>\r\n\r\n<p>Understanding these terms is important because, by using our services, you&rsquo;re agreeing to these terms.</p>\r\n\r\n<p>Besides these terms, we also publish a&nbsp;<a href=\"https://policies.google.com/privacy?hl=en-IN&amp;fg=1\">Privacy Policy</a>. Although it&rsquo;s not part of these terms, we encourage you to read it to better understand how you can&nbsp;<a href=\"https://myaccount.google.com/?hl=en_GB\" target=\"_blank\">update, manage, export and delete your information</a>.</p>\r\n\r\n<h2>Service provider</h2>\r\n\r\n<p>Google&nbsp;<a href=\"https://policies.google.com/terms?hl=en-IN&amp;fg=1#footnote-services\">services</a>&nbsp;are provided by, and you&rsquo;re contracting with:</p>\r\n\r\n<p>Google LLC<br />\r\norganised under the laws of the State of Delaware, USA, and operating under the laws of the USA<br />\r\n<br />\r\n1600 Amphitheatre Parkway<br />\r\nMountain View, California 94043<br />\r\nUSA</p>', 1, '2020-10-08 11:41:38', '2020-10-08 11:41:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_store`
--

CREATE TABLE `tbl_store` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_type` int(11) NOT NULL DEFAULT 0,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ratting` int(11) DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sell_count` int(11) NOT NULL DEFAULT 0,
  `plain_id` int(11) NOT NULL,
  `payment_link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` tinyint(4) DEFAULT NULL COMMENT '0:Phone_Pay;1:Google_Pay;2:upi;3:paytm',
  `payment_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:pending;1:done',
  `storelogo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CreatedBy` int(11) NOT NULL DEFAULT 0,
  `UpdatedBy` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IsVerify` int(11) NOT NULL DEFAULT 1,
  `IsActive` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_store`
--

INSERT INTO `tbl_store` (`id`, `category_id`, `user_id`, `user_type`, `name`, `email`, `password`, `mobile_number`, `Designation`, `zipcode`, `city`, `ratting`, `latitude`, `longitude`, `address`, `image`, `sell_count`, `plain_id`, `payment_link`, `payment_method`, `payment_status`, `storelogo`, `CreatedBy`, `UpdatedBy`, `remember_token`, `IsVerify`, `IsActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '', NULL, 20, 'First Store', 'test@gmail.com', NULL, '9856985555', NULL, '45', NULL, NULL, '22.7612936', '78.3491007', 'Pipariya, Madhya Pradesh, India', '1598989181.jpg', 0, 0, '', NULL, 0, '', 0, NULL, NULL, 1, 1, '2020-09-01 13:58:28', '2020-10-10 06:21:40', '2020-10-10 06:21:40'),
(2, '', NULL, 20, 'second store', 'second@gmail.com', NULL, '9856985644', NULL, 'aa', NULL, NULL, '23.1842854', '77.41767469999999', 'Kolar Mandakini, Kolar Road, Mandakini Society, Shirdipuram, Kolar Rd, Bhopal, Madhya Pradesh, India', '1598989197.jpg', 0, 0, '', NULL, 0, '', 0, NULL, NULL, 1, 1, '2020-09-01 14:01:18', '2020-10-10 06:21:37', '2020-10-10 06:21:37'),
(3, '', NULL, 20, 'manish', 'admin@gmail.com', NULL, '1111985555', NULL, NULL, 'bhopal', 4, '23.3027707', '77.4042243', 'India, Karond Chauraha, Karond Chouraha, Murli Nagar, Karond, Bhopal, Madhya Pradesh, India', '1598989256.jpg', 0, 0, '', NULL, 0, '', 0, NULL, NULL, 1, 1, '2020-09-01 14:10:40', '2020-10-10 06:21:33', '2020-10-10 06:21:33'),
(4, '', NULL, 20, 'Junior', 'junior@gmail.com', NULL, '1212121212', NULL, '11', 'Bhopal', 5, '23.302886', '77.4045689', 'Karond Chouraha, Karond, Bhopal, Madhya Pradesh, India', NULL, 0, 0, '', NULL, 0, '', 0, NULL, NULL, 1, 1, '2020-09-01 14:11:30', '2020-10-10 06:21:30', '2020-10-10 06:21:30'),
(5, '', 147, 20, 'Test12', 'rahul@gmail.com', NULL, '9090909090', NULL, '462042', 'Bhopal', 2, '23.2599333', '77.412615', 'Bhopal, Madhya Pradesh, India', NULL, 0, 0, '', NULL, 0, '', 0, NULL, NULL, 1, 1, '2020-10-07 06:52:43', '2020-10-10 06:21:27', '2020-10-10 06:21:27'),
(6, '1,2', 148, 20, 'Test One', 'test12@gmail.com', NULL, '9090909099', NULL, '289292', 'Agra', 3, '27.1766701', '78.00807449999999', 'Agra, Uttar Pradesh, India', NULL, 0, 0, '', NULL, 0, '', 0, NULL, NULL, 1, 1, '2020-10-08 04:35:28', '2020-10-10 06:21:23', '2020-10-10 06:21:23'),
(7, '', 149, 20, 'Bangalore grocery delivery 1', 'user@gmail.com', NULL, '9020922989', NULL, '121212', 'Vinayaka nagar Medahali, Krishnarajapura', 2, '13.0033885', '77.713813', 'Grocery delivery, Surya Layout, Kodigehalli, Krishnarajapura, Bangalore, Karnataka, India', NULL, 0, 0, '', NULL, 0, '5f8162c087b3c.jpg', 0, NULL, NULL, 1, 1, '2020-10-10 06:25:10', '2020-10-10 07:29:04', NULL),
(8, '', 150, 20, 'bangalore grocery delivery 2', 'admin1@gmail.com', NULL, '1212212112', NULL, NULL, 'Bengaluru', NULL, '12.9715987', '77.5945627', 'Bangalore, Karnataka, India', NULL, 0, 0, '', NULL, 0, '5f8162aeede31.jpg', 0, NULL, NULL, 1, 1, '2020-10-10 06:25:59', '2020-10-10 07:28:46', NULL),
(9, '', 151, 20, 'Bhopal grocery delivery 1', 'admin2@gmail.com', NULL, '2121212121212', NULL, NULL, 'Bhopal', NULL, '23.2599333', '77.412615', 'Bhopal, Madhya Pradesh, India', NULL, 0, 0, '', NULL, 0, '5f816296e81ad.jpg', 0, NULL, NULL, 1, 1, '2020-10-10 06:26:44', '2020-10-10 07:28:22', NULL),
(10, '', 152, 20, 'Chandigarh grocery delivery 2', 'admin3@gmail.com', NULL, '121212121212', NULL, NULL, 'Chandigarh', NULL, '30.7333148', '76.7794179', 'Chandigarh, India', NULL, 0, 0, '', NULL, 0, '5f8162776c829.png', 0, NULL, NULL, 1, 1, '2020-10-10 06:27:34', '2020-10-10 07:27:51', NULL),
(11, '', 153, 20, 'bangalore grocery delivery 3', 'admin4@gmail.com', NULL, '2322323223', NULL, NULL, 'Bengaluru', NULL, '12.9715987', '77.5945627', 'Bangalore, Karnataka, India', NULL, 0, 0, 'www.googlepay.com', 0, 0, '5f816287c4377.png', 0, NULL, NULL, 1, 1, '2020-10-10 06:29:29', '2020-10-12 10:41:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_store_category_maping`
--

CREATE TABLE `tbl_store_category_maping` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_store_category_maping`
--

INSERT INTO `tbl_store_category_maping` (`id`, `store_id`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(35, 9, 14, '2020-10-10 07:28:22', '2020-10-10 07:28:22', NULL),
(36, 8, 14, '2020-10-10 07:28:46', '2020-10-10 07:28:46', NULL),
(37, 8, 15, '2020-10-10 07:28:46', '2020-10-10 07:28:46', NULL),
(38, 8, 16, '2020-10-10 07:28:46', '2020-10-10 07:28:46', NULL),
(39, 7, 14, '2020-10-10 07:29:04', '2020-10-10 07:29:04', NULL),
(40, 7, 15, '2020-10-10 07:29:04', '2020-10-10 07:29:04', NULL),
(41, 7, 16, '2020-10-10 07:29:04', '2020-10-10 07:29:04', NULL),
(42, 11, 14, '2020-10-10 08:52:13', '2020-10-10 08:52:13', NULL),
(43, 11, 15, '2020-10-10 08:52:13', '2020-10-10 08:52:13', NULL),
(44, 11, 16, '2020-10-10 08:52:13', '2020-10-10 08:52:13', NULL),
(45, 11, 17, '2020-10-10 08:52:13', '2020-10-10 08:52:13', NULL),
(46, 10, 15, '2020-10-10 08:52:39', '2020-10-10 08:52:39', NULL),
(47, 10, 16, '2020-10-10 08:52:39', '2020-10-10 08:52:39', NULL),
(48, 10, 17, '2020-10-10 08:52:39', '2020-10-10 08:52:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit`
--

CREATE TABLE `tbl_unit` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT 0,
  `updated_by` int(11) DEFAULT NULL,
  `IsActive` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_unit`
--

INSERT INTO `tbl_unit` (`id`, `name`, `image`, `created_by`, `updated_by`, `IsActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kg', '1598614089.jpg', 1, NULL, 1, '2020-08-28 05:29:07', '2020-08-28 09:19:58', NULL),
(5, 'Gm', NULL, 1, NULL, 1, '2020-10-07 02:24:02', '2020-10-07 02:24:02', NULL),
(3, 'Litre', NULL, 1, NULL, 1, '2020-10-07 02:21:47', '2020-10-07 02:21:47', NULL),
(4, 'Pc', NULL, 1, NULL, 1, '2020-10-07 02:22:02', '2020-10-07 02:22:02', NULL),
(6, 'testUnit1', NULL, 1, NULL, 1, '2020-10-10 05:55:23', '2020-10-10 05:55:36', '2020-10-10 05:55:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_address`
--

CREATE TABLE `tbl_user_address` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_block_flat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `landmark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_type` int(11) DEFAULT 0 COMMENT '0 = Home, 1 Office, 2 = Other',
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL DEFAULT 0,
  `UpdatedBy` int(11) DEFAULT NULL,
  `IsDefault` int(11) NOT NULL DEFAULT 0,
  `IsActive` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_user_address`
--

INSERT INTO `tbl_user_address` (`id`, `user_id`, `full_address`, `home_block_flat`, `landmark`, `area`, `city`, `state`, `country`, `pincode`, `address_type`, `latitude`, `longitude`, `CreatedBy`, `UpdatedBy`, `IsDefault`, `IsActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '5', 'bhopal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'a', 'b', 0, NULL, 0, 1, '2020-09-22 02:37:29', '2020-09-22 02:50:37', '2020-09-22 02:50:37'),
(2, '5', 'indore road bhopal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '111111a', 'b', 0, NULL, 1, 1, '2020-09-22 02:37:37', '2020-10-10 07:17:38', '2020-10-10 07:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` int(11) NOT NULL DEFAULT 0,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL DEFAULT 0,
  `UpdatedBy` int(11) DEFAULT NULL,
  `RoleID` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IsVerify` int(11) NOT NULL DEFAULT 1,
  `IsActive` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_code`, `user_type`, `name`, `email`, `password`, `Phone`, `Designation`, `zipcode`, `latitude`, `longitude`, `address`, `CreatedBy`, `UpdatedBy`, `RoleID`, `remember_token`, `IsVerify`, `IsActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 1, 'Admin', 'admin@gmail.com', '$2y$10$c2pgkKv3TValQ13661iERObMQ2ft8P0KnkuUWyC9Uk95fPuQwkiGu', '7869522084', 'MCA', NULL, NULL, NULL, NULL, 0, 0, 0, 'B0LhQFKXTvahWOPTmcmIxMMpYvCv3jbYlXr5SNZwy9LbnAAwlViq0laoX7rt', 1, 1, '2018-04-02 19:37:09', '2019-09-24 02:47:20', NULL),
(148, 'u2020148', 20, 'Test One', 'test12@gmail.com', '$2y$10$e./ahj2GDdTY7zke3oOZ7.KgeRjbx//aaCyZ4nQ.iMjYX/tUhRQ/q', '9090909099', '', NULL, NULL, NULL, NULL, 1, NULL, NULL, 'NXwNHyBwEZoqjCcfvdCMfOB66rk5EFoznBmVGaj4XN4iUebfRTHeE5KAOcUu', 1, 1, '2020-10-08 04:35:28', '2020-10-08 04:35:28', NULL),
(147, 'u2020147', 20, 'Test12', 'rahul@gmail.com', '$2y$10$mBUIPhERocZSOEs6NbJxa.iosJwgZJp0oi3k1hCH9GQNG2l6TcbZS', '9090909090', '', NULL, NULL, NULL, NULL, 1, NULL, NULL, 'pG6bhG7fpUas1hQuMpXbHTkhgj3fFvauIz35cvQnM4wjOC8fLkdGiQ1QpH7A', 1, 1, '2020-10-07 06:52:43', '2020-10-07 06:52:43', NULL),
(149, 'u2020149', 20, 'Bangalore grocery delivery 1', 'user@gmail.com', '$2y$10$A7HC6F8l.2pDmtba3dbmuu592JYh/aRkFaoQGrrvXEvJaik7RwpIu', '9020922989', '', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2020-10-10 06:25:10', '2020-10-10 06:25:10', NULL),
(150, 'u2020150', 20, 'bangalore grocery delivery 2', 'admin1@gmail.com', '$2y$10$OK9Nvn3d5jaBDX.1uOz3Q.EXDGN1jawqOMVayY3z11im8m9bxG5x2', '1212212112', '', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2020-10-10 06:25:59', '2020-10-10 06:25:59', NULL),
(151, 'u2020151', 20, 'Bhopal grocery delivery 1', 'admin2@gmail.com', '$2y$10$leFpNX1vMOsUvy4mWta64u7Ppdn0qd0TKeKm.bzUgUimkevdTKw8q', '2121212121212', '', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2020-10-10 06:26:44', '2020-10-10 06:26:44', NULL),
(152, 'u2020152', 20, 'bangalore grocery delivery 2', 'admin3@gmail.com', '$2y$10$0iQ7O5whqIi8ZAQ3ganc7uCcUCtonUGChKI.Y4NZXLcfSuahpP/Ne', '121212121212', '', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2020-10-10 06:27:34', '2020-10-10 06:27:34', NULL),
(153, 'u2020153', 20, 'bangalore grocery delivery 3', 'admin4@gmail.com', '$2y$10$6s5c6G3LHJxGaSSceQkl4udl0HwB3DufS6bihAcGhBYcycn0ETk1G', '2322323223', '', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2020-10-10 06:29:29', '2020-10-10 06:29:29', NULL),
(154, 'u2020154', 20, 'Sachi', 'sachi@gmail.com', '$2y$10$YvJPPBwsDbraTIvFTUFrvuLRey2MsW642.F1YdwcOHrAKy7JFRZNC', '8888888888', 'Manager', NULL, NULL, NULL, NULL, 1, NULL, NULL, 'gmT7UMtZvIySfvIxhMxZuEU6vVz7MHML5RHPyOvanIfmwynI6OL2iIwMdXHX', 1, 1, '2020-10-12 08:05:18', '2020-10-12 08:06:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `webhooks`
--

CREATE TABLE `webhooks` (
  `id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `payload` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webhooks`
--

INSERT INTO `webhooks` (`id`, `status`, `type`, `payload`, `created_at`) VALUES
(1, '', 'stripe', '{\"created\":1326853478,\"livemode\":false,\"id\":\"evt_00000000000000\",\"type\":\"payment_intent.amount_capturable_updated\",\"object\":\"event\",\"request\":null,\"pending_webhooks\":1,\"api_version\":\"2018-10-31\",\"data\":{\"object\":{\"id\":\"pi_00000000000000\",\"object\":\"payment_intent\",\"amount\":1099,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"url\":\"\\/v1\\/charges?payment_intent=pi_1HIWbkCHKNBUNpgk98N16JFm\"},\"client_secret\":null,\"confirmation_method\":\"automatic\",\"created\":1598002344,\"currency\":\"dkk\",\"customer\":\"cus_00000000000000\",\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}}}', '2020-08-24 10:48:50'),
(2, '', 'stripe', '{\"created\":1326853478,\"livemode\":false,\"id\":\"evt_00000000000000\",\"type\":\"charge.captured\",\"object\":\"event\",\"request\":null,\"pending_webhooks\":1,\"api_version\":\"2018-10-31\",\"data\":{\"object\":{\"id\":\"ch_00000000000000\",\"object\":\"charge\",\"amount\":10000,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_00000000000000\",\"billing_details\":{\"address\":{\"city\":\"Mohali\",\"country\":\"IN\",\"line1\":\"1320\",\"line2\":\"Phase 3B2\",\"postal_code\":\"160059\",\"state\":\"Punjab\"},\"email\":\"rajeshupwork01@gmail.com\",\"name\":\"Rajesh\",\"phone\":null},\"calculated_statement_descriptor\":\"MEALTICKET\",\"captured\":true,\"created\":1597778752,\"currency\":\"dkk\",\"customer\":\"cus_00000000000000\",\"description\":\"Invoice 644973D4-0001\",\"disputed\":false,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":\"in_00000000000000\",\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":34,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":\"pi_00000000000000\",\"payment_method\":\"pm_00000000000000\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":\"pass\",\"address_postal_code_check\":\"pass\",\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":11,\"exp_year\":2022,\"fingerprint\":\"9qtuSqKEtouZSQN9\",\"funding\":\"credit\",\"installments\":null,\"last4\":\"4242\",\"network\":\"visa\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1DTVcrCHKNBUNpgk\\/ch_1HHaRQCHKNBUNpgkkuuHpeP9\\/rcpt_HrJ3cKBPyik7Dn7Sw6cmPdv3j07PN8v\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"url\":\"\\/v1\\/charges\\/ch_1HHaRQCHKNBUNpgkkuuHpeP9\\/refunds\"},\"review\":null,\"shipping\":null,\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}}}', '2020-08-24 10:49:54'),
(3, '', 'stripe', '{\"id\":\"evt_1HJdQJCHKNBUNpgkex4EeuZ1\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598266870,\"data\":{\"object\":{\"id\":\"ch_1HJdQHCHKNBUNpgk26MYdtuH\",\"object\":\"charge\",\"amount\":3800,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1HJdQICHKNBUNpgkbMuvE95T\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":\"22222\",\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"MEALTICKET\",\"captured\":true,\"created\":1598266869,\"currency\":\"dkk\",\"customer\":\"cus_HtQBDsofxzGzmw\",\"description\":\"Subscription creation\",\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":\"in_1HJdQHCHKNBUNpgkftmcr1H8\",\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":21,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":\"pi_1HJdQHCHKNBUNpgkz32HMPTz\",\"payment_method\":\"pm_1HJdQCCHKNBUNpgknbDdkxX7\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":\"pass\",\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":4,\"exp_year\":2022,\"fingerprint\":\"663QPYdZgNc6hEkp\",\"funding\":\"credit\",\"installments\":null,\"last4\":\"4242\",\"network\":\"visa\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1DTVcrCHKNBUNpgk\\/ch_1HJdQHCHKNBUNpgk26MYdtuH\\/rcpt_HtQGSKTV7u9jZURP4oCNg7KfmeNueKG\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1HJdQHCHKNBUNpgk26MYdtuH\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":null,\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}},\"livemode\":false,\"pending_webhooks\":4,\"request\":{\"id\":\"req_6LsInxaOyQwhsA\",\"idempotency_key\":null},\"type\":\"charge.succeeded\"}', '2020-08-24 11:01:12'),
(4, '', 'charge.succeeded', '{\"id\":\"evt_1HJde7CHKNBUNpgkN0QVSF59\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598267726,\"data\":{\"object\":{\"id\":\"ch_1HJde5CHKNBUNpgkzzXqIaSE\",\"object\":\"charge\",\"amount\":3800,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1HJde6CHKNBUNpgkRI85DPYT\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":\"22222\",\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"MEALTICKET\",\"captured\":true,\"created\":1598267725,\"currency\":\"dkk\",\"customer\":\"cus_HtQBDsofxzGzmw\",\"description\":\"Subscription creation\",\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":\"in_1HJde5CHKNBUNpgkfe1y3Bnv\",\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":60,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":\"pi_1HJde5CHKNBUNpgkvHhkeAhz\",\"payment_method\":\"pm_1HJde0CHKNBUNpgkwDiTZOSS\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":\"pass\",\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":4,\"exp_year\":2022,\"fingerprint\":\"663QPYdZgNc6hEkp\",\"funding\":\"credit\",\"installments\":null,\"last4\":\"4242\",\"network\":\"visa\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1DTVcrCHKNBUNpgk\\/ch_1HJde5CHKNBUNpgkzzXqIaSE\\/rcpt_HtQVYfBRJJV9gMmkNwDHb7AP8DqaUCy\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1HJde5CHKNBUNpgkzzXqIaSE\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":null,\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}},\"livemode\":false,\"pending_webhooks\":4,\"request\":{\"id\":\"req_JdHGyYTlFNmz1g\",\"idempotency_key\":null},\"type\":\"charge.succeeded\"}', '2020-08-24 11:15:39'),
(5, '', 'invoice.paid', '{\"id\":\"evt_1HJde7CHKNBUNpgkplaR85kb\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598267726,\"data\":{\"object\":{\"id\":\"in_1HJde5CHKNBUNpgkfe1y3Bnv\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":3800,\"amount_paid\":3800,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":1,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":\"ch_1HJde5CHKNBUNpgkzzXqIaSE\",\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598267725,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtQBDsofxzGzmw\",\"customer_address\":null,\"customer_email\":\"Kathrine@gmail.com\",\"customer_name\":\"Kathrine Villemoes\",\"customer_phone\":\"30953244\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598267725,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598267724,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtQVmagfMZu80NU3eLVjVNpmFd4L2YY\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtQVmagfMZu80NU3eLVjVNpmFd4L2YY\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_0a0f1490e6bc80\",\"object\":\"line_item\",\"amount\":3800,\"currency\":\"dkk\",\"description\":\"1 \\u00d7 Junior (at 38.00 kr \\/ week)\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598872524,\"start\":1598267724},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtQV2BnDhiw7rA\",\"subscription_item\":\"si_HtQV8uDeP9qeVi\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJde5CHKNBUNpgkbHcmCFcz\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJde5CHKNBUNpgkfe1y3Bnv\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"32B8DF93-0004\",\"paid\":true,\"payment_intent\":\"pi_1HJde5CHKNBUNpgkvHhkeAhz\",\"period_end\":1598267724,\"period_start\":1598267724,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598267724,\"marked_uncollectible_at\":null,\"paid_at\":1598267724,\"voided_at\":null},\"subscription\":\"sub_HtQV2BnDhiw7rA\",\"subtotal\":3800,\"tax\":null,\"tax_percent\":null,\"total\":3800,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_JdHGyYTlFNmz1g\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 11:15:40'),
(6, '', 'charge.succeeded', '{\"id\":\"evt_1HJdqlCHKNBUNpgk3WqKLFPr\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598268510,\"data\":{\"object\":{\"id\":\"ch_1HJdqjCHKNBUNpgkZZzLXxdU\",\"object\":\"charge\",\"amount\":3800,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1HJdqkCHKNBUNpgkHktps2RO\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":\"22222\",\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"MEALTICKET\",\"captured\":true,\"created\":1598268509,\"currency\":\"dkk\",\"customer\":\"cus_HtQBDsofxzGzmw\",\"description\":\"Subscription creation\",\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":\"in_1HJdqjCHKNBUNpgkUwv0k2zO\",\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":41,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":\"pi_1HJdqjCHKNBUNpgkoDdNOAg9\",\"payment_method\":\"pm_1HJdqdCHKNBUNpgkIIT1Wiuh\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":\"pass\",\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":4,\"exp_year\":2022,\"fingerprint\":\"663QPYdZgNc6hEkp\",\"funding\":\"credit\",\"installments\":null,\"last4\":\"4242\",\"network\":\"visa\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1DTVcrCHKNBUNpgk\\/ch_1HJdqjCHKNBUNpgkZZzLXxdU\\/rcpt_HtQivz85Ag29NzQ9M0R6rU996TMgnOj\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1HJdqjCHKNBUNpgkZZzLXxdU\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":null,\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}},\"livemode\":false,\"pending_webhooks\":4,\"request\":{\"id\":\"req_lpJO45r3fTQ3Wt\",\"idempotency_key\":null},\"type\":\"charge.succeeded\"}', '2020-08-24 11:28:36'),
(7, '', 'invoice.paid', '{\"id\":\"evt_1HJdqlCHKNBUNpgkeskQ1tpm\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598268510,\"data\":{\"object\":{\"id\":\"in_1HJdqjCHKNBUNpgkUwv0k2zO\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":3800,\"amount_paid\":3800,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":1,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":\"ch_1HJdqjCHKNBUNpgkZZzLXxdU\",\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598268509,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtQBDsofxzGzmw\",\"customer_address\":null,\"customer_email\":\"Kathrine@gmail.com\",\"customer_name\":\"Kathrine Villemoes\",\"customer_phone\":\"30953244\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598268509,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598268508,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtQi7FlZUIKLq4loiI99xTbmFtkSaMn\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtQi7FlZUIKLq4loiI99xTbmFtkSaMn\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_1b56dd52fcbe9d\",\"object\":\"line_item\",\"amount\":3800,\"currency\":\"dkk\",\"description\":\"1 \\u00d7 Junior (at 38.00 kr \\/ week)\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598873308,\"start\":1598268508},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtQitSY3APPfgu\",\"subscription_item\":\"si_HtQijrNmuHCgdy\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJdqjCHKNBUNpgk3xmvtimH\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJdqjCHKNBUNpgkUwv0k2zO\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"32B8DF93-0005\",\"paid\":true,\"payment_intent\":\"pi_1HJdqjCHKNBUNpgkoDdNOAg9\",\"period_end\":1598268508,\"period_start\":1598268508,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598268508,\"marked_uncollectible_at\":null,\"paid_at\":1598268508,\"voided_at\":null},\"subscription\":\"sub_HtQitSY3APPfgu\",\"subtotal\":3800,\"tax\":null,\"tax_percent\":null,\"total\":3800,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_lpJO45r3fTQ3Wt\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 11:28:37'),
(8, '', 'invoice.upcoming', '{\"id\":\"evt_1HJdqnCHKNBUNpgkYuz0XqvT\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598268513,\"data\":{\"object\":{\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":3800,\"amount_paid\":0,\"amount_remaining\":3800,\"application_fee\":null,\"attempt_count\":0,\"attempted\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"upcoming\",\"charge\":null,\"closed\":false,\"collection_method\":\"charge_automatically\",\"created\":1598873308,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtQBDsofxzGzmw\",\"customer_address\":null,\"customer_email\":\"Kathrine@gmail.com\",\"customer_name\":\"Kathrine Villemoes\",\"customer_phone\":\"30953244\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598873308,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":null,\"footer\":null,\"forgiven\":false,\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_0afc799c3d794e\",\"object\":\"line_item\",\"amount\":3800,\"currency\":\"dkk\",\"description\":\"1 \\u00d7 Junior (at 38.00 kr \\/ week)\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1599478108,\"start\":1598873308},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtQitSY3APPfgu\",\"subscription_item\":\"si_HtQijrNmuHCgdy\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_tmp_0afc799c3d794e\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/upcoming\\/lines?customer=cus_HtQBDsofxzGzmw&subscription=sub_HtQitSY3APPfgu\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":1598876908,\"number\":\"32B8DF93-0006\",\"paid\":false,\"payment_intent\":null,\"period_end\":1598873308,\"period_start\":1598268508,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"draft\",\"status_transitions\":{\"finalized_at\":null,\"marked_uncollectible_at\":null,\"paid_at\":null,\"voided_at\":null},\"subscription\":\"sub_HtQitSY3APPfgu\",\"subtotal\":3800,\"tax\":null,\"tax_percent\":null,\"total\":3800,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":null,\"idempotency_key\":null},\"type\":\"invoice.upcoming\"}', '2020-08-24 11:28:37'),
(9, '', 'invoice.paid', '{\"id\":\"evt_1HJduACHKNBUNpgkDmmgTZ5g\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598268721,\"data\":{\"object\":{\"id\":\"in_1HJdu8CHKNBUNpgkeDdE0nke\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598268720,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtQBDsofxzGzmw\",\"customer_address\":null,\"customer_email\":\"Kathrine@gmail.com\",\"customer_name\":\"Kathrine Villemoes\",\"customer_phone\":\"30953244\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598268720,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598268720,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtQlQFdAlsCbenUGDfEqMsnjy5tyT9h\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtQlQFdAlsCbenUGDfEqMsnjy5tyT9h\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_e3e34228857210\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598268720},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtQlorbvP0LYxL\",\"subscription_item\":\"si_HtQlTGsd3zvskB\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJdu8CHKNBUNpgkBpyC8INW\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJdu8CHKNBUNpgkeDdE0nke\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"32B8DF93-0006\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598268720,\"period_start\":1598268720,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598268720,\"marked_uncollectible_at\":null,\"paid_at\":1598268720,\"voided_at\":null},\"subscription\":\"sub_HtQlorbvP0LYxL\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_cDi7OLbfC0QBFF\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 11:32:03'),
(10, '', 'charge.succeeded', '{\"id\":\"evt_1HJdvUCHKNBUNpgkwMdGHc1l\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598268803,\"data\":{\"object\":{\"id\":\"ch_1HJdvSCHKNBUNpgkdkfz16fY\",\"object\":\"charge\",\"amount\":3800,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1HJdvTCHKNBUNpgkDU3mAxgu\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":\"22222\",\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"MEALTICKET\",\"captured\":true,\"created\":1598268802,\"currency\":\"dkk\",\"customer\":\"cus_HtQBDsofxzGzmw\",\"description\":\"Subscription creation\",\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":\"in_1HJdvSCHKNBUNpgk2eDF1sv1\",\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":43,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":\"pi_1HJdvSCHKNBUNpgkexEuPiZ9\",\"payment_method\":\"pm_1HJdvLCHKNBUNpgkJwnIcxql\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":\"pass\",\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":4,\"exp_year\":2022,\"fingerprint\":\"663QPYdZgNc6hEkp\",\"funding\":\"credit\",\"installments\":null,\"last4\":\"4242\",\"network\":\"visa\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1DTVcrCHKNBUNpgk\\/ch_1HJdvSCHKNBUNpgkdkfz16fY\\/rcpt_HtQnVgZXBsGU4zCuaTq7Rr2NvLxkq44\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1HJdvSCHKNBUNpgkdkfz16fY\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":null,\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}},\"livemode\":false,\"pending_webhooks\":4,\"request\":{\"id\":\"req_kyDol30NL0LEuH\",\"idempotency_key\":null},\"type\":\"charge.succeeded\"}', '2020-08-24 11:33:25'),
(11, '', 'invoice.paid', '{\"id\":\"evt_1HJdvUCHKNBUNpgkBXUTaLuW\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598268803,\"data\":{\"object\":{\"id\":\"in_1HJdvSCHKNBUNpgk2eDF1sv1\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":3800,\"amount_paid\":3800,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":1,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":\"ch_1HJdvSCHKNBUNpgkdkfz16fY\",\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598268802,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtQBDsofxzGzmw\",\"customer_address\":null,\"customer_email\":\"Kathrine@gmail.com\",\"customer_name\":\"Kathrine Villemoes\",\"customer_phone\":\"30953244\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598268802,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598268801,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtQnwtvqVrvGFcLwyTOpvouS4TF9LTv\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtQnwtvqVrvGFcLwyTOpvouS4TF9LTv\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_8b2ce43fb1d69b\",\"object\":\"line_item\",\"amount\":3800,\"currency\":\"dkk\",\"description\":\"1 \\u00d7 Junior (at 38.00 kr \\/ week)\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598873601,\"start\":1598268801},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtQnW2Tb1Juvn5\",\"subscription_item\":\"si_HtQnQThFeKoZ9s\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJdvSCHKNBUNpgkWcRyEI7s\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJdvSCHKNBUNpgk2eDF1sv1\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"32B8DF93-0007\",\"paid\":true,\"payment_intent\":\"pi_1HJdvSCHKNBUNpgkexEuPiZ9\",\"period_end\":1598268801,\"period_start\":1598268801,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598268801,\"marked_uncollectible_at\":null,\"paid_at\":1598268801,\"voided_at\":null},\"subscription\":\"sub_HtQnW2Tb1Juvn5\",\"subtotal\":3800,\"tax\":null,\"tax_percent\":null,\"total\":3800,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_kyDol30NL0LEuH\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 11:33:26'),
(12, '', 'invoice.upcoming', '{\"id\":\"evt_1HJdvrCHKNBUNpgkkoH0WDqu\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598268827,\"data\":{\"object\":{\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":3800,\"amount_paid\":0,\"amount_remaining\":3800,\"application_fee\":null,\"attempt_count\":0,\"attempted\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"upcoming\",\"charge\":null,\"closed\":false,\"collection_method\":\"charge_automatically\",\"created\":1598873601,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtQBDsofxzGzmw\",\"customer_address\":null,\"customer_email\":\"Kathrine@gmail.com\",\"customer_name\":\"Kathrine Villemoes\",\"customer_phone\":\"30953244\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598873601,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":null,\"footer\":null,\"forgiven\":false,\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_daf0defd226856\",\"object\":\"line_item\",\"amount\":3800,\"currency\":\"dkk\",\"description\":\"1 \\u00d7 Junior (at 38.00 kr \\/ week)\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1599478401,\"start\":1598873601},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtQnW2Tb1Juvn5\",\"subscription_item\":\"si_HtQnQThFeKoZ9s\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_tmp_daf0defd226856\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/upcoming\\/lines?customer=cus_HtQBDsofxzGzmw&subscription=sub_HtQnW2Tb1Juvn5\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":1598877201,\"number\":\"32B8DF93-0008\",\"paid\":false,\"payment_intent\":null,\"period_end\":1598873601,\"period_start\":1598268801,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"draft\",\"status_transitions\":{\"finalized_at\":null,\"marked_uncollectible_at\":null,\"paid_at\":null,\"voided_at\":null},\"subscription\":\"sub_HtQnW2Tb1Juvn5\",\"subtotal\":3800,\"tax\":null,\"tax_percent\":null,\"total\":3800,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":null,\"idempotency_key\":null},\"type\":\"invoice.upcoming\"}', '2020-08-24 11:33:48'),
(13, '', 'invoice.paid', '{\"id\":\"evt_1HJe16CHKNBUNpgkUCmZopNl\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598269152,\"data\":{\"object\":{\"id\":\"in_1HJe15CHKNBUNpgkuJkMwolI\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598269151,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtQBDsofxzGzmw\",\"customer_address\":null,\"customer_email\":\"Kathrine@gmail.com\",\"customer_name\":\"Kathrine Villemoes\",\"customer_phone\":\"30953244\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598269151,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598269150,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtQs5XW0mkpIbI37lXN2FUVLQR4liqf\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtQs5XW0mkpIbI37lXN2FUVLQR4liqf\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_36336d54d09d19\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598269150},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtQsLO7fRtf51X\",\"subscription_item\":\"si_HtQs6vmR0xwT3l\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJe15CHKNBUNpgkyVKPvYrQ\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJe15CHKNBUNpgkuJkMwolI\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"32B8DF93-0008\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598269150,\"period_start\":1598269150,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598269150,\"marked_uncollectible_at\":null,\"paid_at\":1598269150,\"voided_at\":null},\"subscription\":\"sub_HtQsLO7fRtf51X\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_DoYL6Mk4xJ8zcC\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 11:39:14'),
(14, '', 'invoice.paid', '{\"id\":\"evt_1HJe5tCHKNBUNpgk8SFJo5Mh\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598269448,\"data\":{\"object\":{\"id\":\"in_1HJe5sCHKNBUNpgkDFJ2WjZq\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598269448,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtQBDsofxzGzmw\",\"customer_address\":null,\"customer_email\":\"Kathrine@gmail.com\",\"customer_name\":\"Kathrine Villemoes\",\"customer_phone\":\"30953244\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598269448,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598269447,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtQxD7gdtHODJvXmP9cNVbAsbDTJSwS\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtQxD7gdtHODJvXmP9cNVbAsbDTJSwS\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_33069b43de962e\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598269447},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtQxocgPUCxcVv\",\"subscription_item\":\"si_HtQxFzh8lnm1K6\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJe5sCHKNBUNpgkj9oTWyKf\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJe5sCHKNBUNpgkDFJ2WjZq\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"32B8DF93-0009\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598269447,\"period_start\":1598269447,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598269447,\"marked_uncollectible_at\":null,\"paid_at\":1598269447,\"voided_at\":null},\"subscription\":\"sub_HtQxocgPUCxcVv\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_bG7qUFF5L8LvM7\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 11:44:10'),
(15, '1598400000', 'invoice.paid', '{\"id\":\"evt_1HJe5tCHKNBUNpgk8SFJo5Mh\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598269448,\"data\":{\"object\":{\"id\":\"in_1HJe5sCHKNBUNpgkDFJ2WjZq\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598269448,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtQBDsofxzGzmw\",\"customer_address\":null,\"customer_email\":\"Kathrine@gmail.com\",\"customer_name\":\"Kathrine Villemoes\",\"customer_phone\":\"30953244\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598269448,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598269447,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtQxD7gdtHODJvXmP9cNVbAsbDTJSwS\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtQxD7gdtHODJvXmP9cNVbAsbDTJSwS\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_33069b43de962e\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598269447},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtQxocgPUCxcVv\",\"subscription_item\":\"si_HtQxFzh8lnm1K6\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJe5sCHKNBUNpgkj9oTWyKf\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJe5sCHKNBUNpgkDFJ2WjZq\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"32B8DF93-0009\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598269447,\"period_start\":1598269447,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598269447,\"marked_uncollectible_at\":null,\"paid_at\":1598269447,\"voided_at\":null},\"subscription\":\"sub_HtQxocgPUCxcVv\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_bG7qUFF5L8LvM7\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 11:44:10');
INSERT INTO `webhooks` (`id`, `status`, `type`, `payload`, `created_at`) VALUES
(16, '', 'invoice.paid', '{\"id\":\"evt_1HJecjCHKNBUNpgky9WbBfFb\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598271484,\"data\":{\"object\":{\"id\":\"in_1HJeciCHKNBUNpgkCOqLdXhv\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598271484,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtQBDsofxzGzmw\",\"customer_address\":null,\"customer_email\":\"Kathrine@gmail.com\",\"customer_name\":\"Kathrine Villemoes\",\"customer_phone\":\"30953244\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598271484,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598271483,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtRVvhk7FCJC0rfppVdogo0qhCcvooA\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtRVvhk7FCJC0rfppVdogo0qhCcvooA\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_dbabdb44122e4b\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598271483},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtRVHlHVpFP5oc\",\"subscription_item\":\"si_HtRVJYxLr59bXm\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJeciCHKNBUNpgkFkTuyht3\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJeciCHKNBUNpgkCOqLdXhv\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"32B8DF93-0010\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598271483,\"period_start\":1598271483,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598271483,\"marked_uncollectible_at\":null,\"paid_at\":1598271483,\"voided_at\":null},\"subscription\":\"sub_HtRVHlHVpFP5oc\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_psGBoQEPLs1eCO\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 12:18:06'),
(17, '1598400000', 'invoice.paid', '{\"id\":\"evt_1HJecjCHKNBUNpgky9WbBfFb\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598271484,\"data\":{\"object\":{\"id\":\"in_1HJeciCHKNBUNpgkCOqLdXhv\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598271484,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtQBDsofxzGzmw\",\"customer_address\":null,\"customer_email\":\"Kathrine@gmail.com\",\"customer_name\":\"Kathrine Villemoes\",\"customer_phone\":\"30953244\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598271484,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598271483,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtRVvhk7FCJC0rfppVdogo0qhCcvooA\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtRVvhk7FCJC0rfppVdogo0qhCcvooA\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_dbabdb44122e4b\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598271483},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtRVHlHVpFP5oc\",\"subscription_item\":\"si_HtRVJYxLr59bXm\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJeciCHKNBUNpgkFkTuyht3\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJeciCHKNBUNpgkCOqLdXhv\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"32B8DF93-0010\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598271483,\"period_start\":1598271483,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598271483,\"marked_uncollectible_at\":null,\"paid_at\":1598271483,\"voided_at\":null},\"subscription\":\"sub_HtRVHlHVpFP5oc\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_psGBoQEPLs1eCO\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 12:18:06'),
(18, '', 'invoice.paid', '{\"id\":\"evt_1HJg9mCHKNBUNpgkmRMnph1v\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598277377,\"data\":{\"object\":{\"id\":\"in_1HJg9kCHKNBUNpgkMSXZXisS\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598277376,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtT59aq0UTvhp8\",\"customer_address\":null,\"customer_email\":\"stranden93@gmail.com\",\"customer_name\":\"Martin Christensen\",\"customer_phone\":\"24618067\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598277376,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598277376,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtT5pHLNUyhxgHtbK0ScdtOu1dahTve\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtT5pHLNUyhxgHtbK0ScdtOu1dahTve\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_3cee5269384305\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598277376},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtT5sQVPTuyzvA\",\"subscription_item\":\"si_HtT5BIBIa16I66\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJg9kCHKNBUNpgkuqsfdocZ\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJg9kCHKNBUNpgkMSXZXisS\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"572B72CF-0001\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598277376,\"period_start\":1598277376,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598277376,\"marked_uncollectible_at\":null,\"paid_at\":1598277376,\"voided_at\":null},\"subscription\":\"sub_HtT5sQVPTuyzvA\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_NohPANnhnCr5nZ\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 13:56:19'),
(19, '1598400000', 'invoice.paid', '{\"id\":\"evt_1HJg9mCHKNBUNpgkmRMnph1v\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598277377,\"data\":{\"object\":{\"id\":\"in_1HJg9kCHKNBUNpgkMSXZXisS\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598277376,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtT59aq0UTvhp8\",\"customer_address\":null,\"customer_email\":\"stranden93@gmail.com\",\"customer_name\":\"Martin Christensen\",\"customer_phone\":\"24618067\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598277376,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598277376,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtT5pHLNUyhxgHtbK0ScdtOu1dahTve\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtT5pHLNUyhxgHtbK0ScdtOu1dahTve\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_3cee5269384305\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598277376},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtT5sQVPTuyzvA\",\"subscription_item\":\"si_HtT5BIBIa16I66\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJg9kCHKNBUNpgkuqsfdocZ\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJg9kCHKNBUNpgkMSXZXisS\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"572B72CF-0001\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598277376,\"period_start\":1598277376,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598277376,\"marked_uncollectible_at\":null,\"paid_at\":1598277376,\"voided_at\":null},\"subscription\":\"sub_HtT5sQVPTuyzvA\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_NohPANnhnCr5nZ\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 13:56:19'),
(20, '', 'charge.succeeded', '{\"id\":\"evt_1HJgBVCHKNBUNpgkhFmmjvFn\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598277484,\"data\":{\"object\":{\"id\":\"ch_1HJgBUCHKNBUNpgk7HgJL4OH\",\"object\":\"charge\",\"amount\":10000,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1HJgBUCHKNBUNpgkQcSoUvYt\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":\"44444\",\"state\":null},\"email\":null,\"name\":\"Martin\",\"phone\":null},\"calculated_statement_descriptor\":\"MEALTICKET\",\"captured\":true,\"created\":1598277484,\"currency\":\"dkk\",\"customer\":\"cus_HtT59aq0UTvhp8\",\"description\":null,\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":12,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":\"pi_1HJgB5CHKNBUNpgkByU4USJq\",\"payment_method\":\"pm_1HJgBTCHKNBUNpgknwYItqsh\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":\"pass\",\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":4,\"exp_year\":2044,\"fingerprint\":\"663QPYdZgNc6hEkp\",\"funding\":\"credit\",\"installments\":null,\"last4\":\"4242\",\"network\":\"visa\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1DTVcrCHKNBUNpgk\\/ch_1HJgBUCHKNBUNpgk7HgJL4OH\\/rcpt_HtT7jeGKB36sknjirMUV79v0vgRek0Z\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1HJgBUCHKNBUNpgk7HgJL4OH\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":null,\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}},\"livemode\":false,\"pending_webhooks\":4,\"request\":{\"id\":\"req_ALtGgk1wJDIvnW\",\"idempotency_key\":null},\"type\":\"charge.succeeded\"}', '2020-08-24 13:58:06'),
(21, '', 'customer.subscription.deleted', '{\"id\":\"evt_1HJh5gCHKNBUNpgkzjlxPSmP\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598280968,\"data\":{\"object\":{\"id\":\"sub_HtQsLO7fRtf51X\",\"object\":\"subscription\",\"application_fee_percent\":null,\"billing\":\"charge_automatically\",\"billing_cycle_anchor\":1598400000,\"billing_thresholds\":null,\"cancel_at\":null,\"cancel_at_period_end\":false,\"canceled_at\":1598280968,\"collection_method\":\"charge_automatically\",\"created\":1598269150,\"current_period_end\":1598400000,\"current_period_start\":1598269150,\"customer\":\"cus_HtQBDsofxzGzmw\",\"days_until_due\":null,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"discount\":null,\"ended_at\":1598280968,\"invoice_customer_balance_settings\":{\"consume_applied_balance_on_void\":true},\"items\":{\"object\":\"list\",\"data\":[{\"id\":\"si_HtQs6vmR0xwT3l\",\"object\":\"subscription_item\",\"billing_thresholds\":null,\"created\":1598269152,\"metadata\":[],\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"quantity\":1,\"subscription\":\"sub_HtQsLO7fRtf51X\",\"tax_rates\":[]}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/subscription_items?subscription=sub_HtQsLO7fRtf51X\"},\"latest_invoice\":\"in_1HJe15CHKNBUNpgkuJkMwolI\",\"livemode\":false,\"metadata\":[],\"next_pending_invoice_item_invoice\":null,\"pause_collection\":null,\"pending_invoice_item_interval\":null,\"pending_setup_intent\":null,\"pending_update\":null,\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"quantity\":1,\"schedule\":null,\"start\":1598269150,\"start_date\":1598269150,\"status\":\"canceled\",\"tax_percent\":null,\"transfer_data\":null,\"trial_end\":1598400000,\"trial_start\":1598269150}},\"livemode\":false,\"pending_webhooks\":3,\"request\":{\"id\":\"req_dfumDxVJuSrUMD\",\"idempotency_key\":null},\"type\":\"customer.subscription.deleted\"}', '2020-08-24 14:56:10'),
(22, '', 'invoice.paid', '{\"id\":\"evt_1HJhQvCHKNBUNpgkSKo3Tnob\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598282283,\"data\":{\"object\":{\"id\":\"in_1HJhQtCHKNBUNpgkN88ZBrfv\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598282283,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtUPIVaLqdrM1E\",\"customer_address\":null,\"customer_email\":\"Oliver@gmail.com\",\"customer_name\":\"Oliver Basse\",\"customer_phone\":\"60350954\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598282283,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598282283,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtUPPrtIlhUtfXNkfxft4G5XchdUDGS\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtUPPrtIlhUtfXNkfxft4G5XchdUDGS\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_b5b7a8953f779b\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598282283},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtUPL7gmUkkBWK\",\"subscription_item\":\"si_HtUPpz2ym7EJhx\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJhQtCHKNBUNpgkk61PFayZ\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJhQtCHKNBUNpgkN88ZBrfv\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"1C68C074-0001\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598282283,\"period_start\":1598282283,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598282283,\"marked_uncollectible_at\":null,\"paid_at\":1598282283,\"voided_at\":null},\"subscription\":\"sub_HtUPL7gmUkkBWK\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_AAEthQUBDrUals\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 15:18:06'),
(23, '1598400000', 'invoice.paid', '{\"id\":\"evt_1HJhQvCHKNBUNpgkSKo3Tnob\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598282283,\"data\":{\"object\":{\"id\":\"in_1HJhQtCHKNBUNpgkN88ZBrfv\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598282283,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtUPIVaLqdrM1E\",\"customer_address\":null,\"customer_email\":\"Oliver@gmail.com\",\"customer_name\":\"Oliver Basse\",\"customer_phone\":\"60350954\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598282283,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598282283,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtUPPrtIlhUtfXNkfxft4G5XchdUDGS\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtUPPrtIlhUtfXNkfxft4G5XchdUDGS\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_b5b7a8953f779b\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598282283},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtUPL7gmUkkBWK\",\"subscription_item\":\"si_HtUPpz2ym7EJhx\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJhQtCHKNBUNpgkk61PFayZ\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJhQtCHKNBUNpgkN88ZBrfv\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"1C68C074-0001\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598282283,\"period_start\":1598282283,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598282283,\"marked_uncollectible_at\":null,\"paid_at\":1598282283,\"voided_at\":null},\"subscription\":\"sub_HtUPL7gmUkkBWK\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_AAEthQUBDrUals\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 15:18:06'),
(24, '', 'customer.subscription.deleted', '{\"id\":\"evt_1HJhULCHKNBUNpgkxoKH33yK\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598282497,\"data\":{\"object\":{\"id\":\"sub_HtUPL7gmUkkBWK\",\"object\":\"subscription\",\"application_fee_percent\":null,\"billing\":\"charge_automatically\",\"billing_cycle_anchor\":1598400000,\"billing_thresholds\":null,\"cancel_at\":null,\"cancel_at_period_end\":false,\"canceled_at\":1598282497,\"collection_method\":\"charge_automatically\",\"created\":1598282283,\"current_period_end\":1598400000,\"current_period_start\":1598282283,\"customer\":\"cus_HtUPIVaLqdrM1E\",\"days_until_due\":null,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"discount\":null,\"ended_at\":1598282497,\"invoice_customer_balance_settings\":{\"consume_applied_balance_on_void\":true},\"items\":{\"object\":\"list\",\"data\":[{\"id\":\"si_HtUPpz2ym7EJhx\",\"object\":\"subscription_item\",\"billing_thresholds\":null,\"created\":1598282283,\"metadata\":[],\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"quantity\":1,\"subscription\":\"sub_HtUPL7gmUkkBWK\",\"tax_rates\":[]}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/subscription_items?subscription=sub_HtUPL7gmUkkBWK\"},\"latest_invoice\":\"in_1HJhQtCHKNBUNpgkN88ZBrfv\",\"livemode\":false,\"metadata\":[],\"next_pending_invoice_item_invoice\":null,\"pause_collection\":null,\"pending_invoice_item_interval\":null,\"pending_setup_intent\":null,\"pending_update\":null,\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"quantity\":1,\"schedule\":null,\"start\":1598282283,\"start_date\":1598282283,\"status\":\"canceled\",\"tax_percent\":null,\"transfer_data\":null,\"trial_end\":1598400000,\"trial_start\":1598282283}},\"livemode\":false,\"pending_webhooks\":3,\"request\":{\"id\":\"req_YHin6gJkZCtqiZ\",\"idempotency_key\":null},\"type\":\"customer.subscription.deleted\"}', '2020-08-24 15:21:38'),
(25, '', 'invoice.paid', '{\"id\":\"evt_1HJhWNCHKNBUNpgkB9Uqtnwh\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598282622,\"data\":{\"object\":{\"id\":\"in_1HJhWLCHKNBUNpgkePlVzphR\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598282621,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtUVV2zlkjmTmb\",\"customer_address\":null,\"customer_email\":\"William01@gmail.com\",\"customer_name\":\"William Gormsen\",\"customer_phone\":\"30743143\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598282621,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598282621,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtUVfS1lmJmzYmYM3NPHlQz8NTzLDvB\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtUVfS1lmJmzYmYM3NPHlQz8NTzLDvB\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_e200f1d92d64be\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598282621},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtUVjmsiHBtiaS\",\"subscription_item\":\"si_HtUVnsT5uI4uQR\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJhWLCHKNBUNpgkwSkmKLgK\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJhWLCHKNBUNpgkePlVzphR\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"87017DC3-0001\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598282621,\"period_start\":1598282621,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598282621,\"marked_uncollectible_at\":null,\"paid_at\":1598282621,\"voided_at\":null},\"subscription\":\"sub_HtUVjmsiHBtiaS\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_NJgtcII753s5kQ\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 15:23:44'),
(26, '1598400000', 'invoice.paid', '{\"id\":\"evt_1HJhWNCHKNBUNpgkB9Uqtnwh\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598282622,\"data\":{\"object\":{\"id\":\"in_1HJhWLCHKNBUNpgkePlVzphR\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598282621,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtUVV2zlkjmTmb\",\"customer_address\":null,\"customer_email\":\"William01@gmail.com\",\"customer_name\":\"William Gormsen\",\"customer_phone\":\"30743143\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598282621,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598282621,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtUVfS1lmJmzYmYM3NPHlQz8NTzLDvB\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtUVfS1lmJmzYmYM3NPHlQz8NTzLDvB\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_e200f1d92d64be\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598282621},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtUVjmsiHBtiaS\",\"subscription_item\":\"si_HtUVnsT5uI4uQR\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJhWLCHKNBUNpgkwSkmKLgK\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJhWLCHKNBUNpgkePlVzphR\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"87017DC3-0001\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598282621,\"period_start\":1598282621,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598282621,\"marked_uncollectible_at\":null,\"paid_at\":1598282621,\"voided_at\":null},\"subscription\":\"sub_HtUVjmsiHBtiaS\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_NJgtcII753s5kQ\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 15:23:44'),
(27, '', 'customer.subscription.deleted', '{\"id\":\"evt_1HJhXICHKNBUNpgkhuVDl2tL\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598282680,\"data\":{\"object\":{\"id\":\"sub_HtUVjmsiHBtiaS\",\"object\":\"subscription\",\"application_fee_percent\":null,\"billing\":\"charge_automatically\",\"billing_cycle_anchor\":1598400000,\"billing_thresholds\":null,\"cancel_at\":null,\"cancel_at_period_end\":false,\"canceled_at\":1598282680,\"collection_method\":\"charge_automatically\",\"created\":1598282621,\"current_period_end\":1598400000,\"current_period_start\":1598282621,\"customer\":\"cus_HtUVV2zlkjmTmb\",\"days_until_due\":null,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"discount\":null,\"ended_at\":1598282680,\"invoice_customer_balance_settings\":{\"consume_applied_balance_on_void\":true},\"items\":{\"object\":\"list\",\"data\":[{\"id\":\"si_HtUVnsT5uI4uQR\",\"object\":\"subscription_item\",\"billing_thresholds\":null,\"created\":1598282622,\"metadata\":[],\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"quantity\":1,\"subscription\":\"sub_HtUVjmsiHBtiaS\",\"tax_rates\":[]}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/subscription_items?subscription=sub_HtUVjmsiHBtiaS\"},\"latest_invoice\":\"in_1HJhWLCHKNBUNpgkePlVzphR\",\"livemode\":false,\"metadata\":[],\"next_pending_invoice_item_invoice\":null,\"pause_collection\":null,\"pending_invoice_item_interval\":null,\"pending_setup_intent\":null,\"pending_update\":null,\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"quantity\":1,\"schedule\":null,\"start\":1598282621,\"start_date\":1598282621,\"status\":\"canceled\",\"tax_percent\":null,\"transfer_data\":null,\"trial_end\":1598400000,\"trial_start\":1598282621}},\"livemode\":false,\"pending_webhooks\":3,\"request\":{\"id\":\"req_lVE2ZBkRVGXo7L\",\"idempotency_key\":null},\"type\":\"customer.subscription.deleted\"}', '2020-08-24 15:24:41'),
(28, '', 'invoice.paid', '{\"id\":\"evt_1HJheqCHKNBUNpgkN632zv6g\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598283147,\"data\":{\"object\":{\"id\":\"in_1HJhepCHKNBUNpgk1GA5FuTn\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598283147,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtUebuMUD80zUN\",\"customer_address\":null,\"customer_email\":\"Peter@gmail.com\",\"customer_name\":\"Peter Nielsen\",\"customer_phone\":\"12312312\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598283147,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598283146,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtUedFvUjmgLNgFe9jhkqBr0pZOcc9m\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtUedFvUjmgLNgFe9jhkqBr0pZOcc9m\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_7fdf66de3fe93d\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598283146},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtUezn7dWVuYnA\",\"subscription_item\":\"si_HtUeKtljBQc6sz\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJhepCHKNBUNpgkcApsWeU9\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJhepCHKNBUNpgk1GA5FuTn\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"47E99820-0001\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598283146,\"period_start\":1598283146,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598283146,\"marked_uncollectible_at\":null,\"paid_at\":1598283146,\"voided_at\":null},\"subscription\":\"sub_HtUezn7dWVuYnA\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_QmvGoVdHcjlUoV\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 15:32:29');
INSERT INTO `webhooks` (`id`, `status`, `type`, `payload`, `created_at`) VALUES
(29, '1598400000', 'invoice.paid', '{\"id\":\"evt_1HJheqCHKNBUNpgkN632zv6g\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598283147,\"data\":{\"object\":{\"id\":\"in_1HJhepCHKNBUNpgk1GA5FuTn\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598283147,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtUebuMUD80zUN\",\"customer_address\":null,\"customer_email\":\"Peter@gmail.com\",\"customer_name\":\"Peter Nielsen\",\"customer_phone\":\"12312312\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598283147,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598283146,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtUedFvUjmgLNgFe9jhkqBr0pZOcc9m\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtUedFvUjmgLNgFe9jhkqBr0pZOcc9m\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_7fdf66de3fe93d\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598283146},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtUezn7dWVuYnA\",\"subscription_item\":\"si_HtUeKtljBQc6sz\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJhepCHKNBUNpgkcApsWeU9\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJhepCHKNBUNpgk1GA5FuTn\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"47E99820-0001\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598283146,\"period_start\":1598283146,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598283146,\"marked_uncollectible_at\":null,\"paid_at\":1598283146,\"voided_at\":null},\"subscription\":\"sub_HtUezn7dWVuYnA\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_QmvGoVdHcjlUoV\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 15:32:29'),
(30, '', 'customer.subscription.deleted', '{\"id\":\"evt_1HJhfcCHKNBUNpgkDwTAQxCC\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598283196,\"data\":{\"object\":{\"id\":\"sub_HtUezn7dWVuYnA\",\"object\":\"subscription\",\"application_fee_percent\":null,\"billing\":\"charge_automatically\",\"billing_cycle_anchor\":1598400000,\"billing_thresholds\":null,\"cancel_at\":null,\"cancel_at_period_end\":false,\"canceled_at\":1598283195,\"collection_method\":\"charge_automatically\",\"created\":1598283146,\"current_period_end\":1598400000,\"current_period_start\":1598283146,\"customer\":\"cus_HtUebuMUD80zUN\",\"days_until_due\":null,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"discount\":null,\"ended_at\":1598283195,\"invoice_customer_balance_settings\":{\"consume_applied_balance_on_void\":true},\"items\":{\"object\":\"list\",\"data\":[{\"id\":\"si_HtUeKtljBQc6sz\",\"object\":\"subscription_item\",\"billing_thresholds\":null,\"created\":1598283147,\"metadata\":[],\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"quantity\":1,\"subscription\":\"sub_HtUezn7dWVuYnA\",\"tax_rates\":[]}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/subscription_items?subscription=sub_HtUezn7dWVuYnA\"},\"latest_invoice\":\"in_1HJhepCHKNBUNpgk1GA5FuTn\",\"livemode\":false,\"metadata\":[],\"next_pending_invoice_item_invoice\":null,\"pause_collection\":null,\"pending_invoice_item_interval\":null,\"pending_setup_intent\":null,\"pending_update\":null,\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"quantity\":1,\"schedule\":null,\"start\":1598283146,\"start_date\":1598283146,\"status\":\"canceled\",\"tax_percent\":null,\"transfer_data\":null,\"trial_end\":1598400000,\"trial_start\":1598283146}},\"livemode\":false,\"pending_webhooks\":3,\"request\":{\"id\":\"req_qDqz0mn5VP5UYv\",\"idempotency_key\":null},\"type\":\"customer.subscription.deleted\"}', '2020-08-24 15:33:17'),
(31, '', 'invoice.paid', '{\"id\":\"evt_1HJhogCHKNBUNpgkJbbK2b0p\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598283756,\"data\":{\"object\":{\"id\":\"in_1HJhoeCHKNBUNpgkxyBdQwQH\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598283756,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtUoJU0tnbFpxy\",\"customer_address\":null,\"customer_email\":\"Vansh@gmail.com\",\"customer_name\":\"Vansh Soni\",\"customer_phone\":\"9950123751\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598283756,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598283755,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtUorxN0XUKMx5sEB9lsgPrMC3H8a9b\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtUorxN0XUKMx5sEB9lsgPrMC3H8a9b\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_e35f8c11ce231e\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598283755},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtUo9YfkZnQSky\",\"subscription_item\":\"si_HtUokgfU2eqZPa\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJhoeCHKNBUNpgkZhocBlXP\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJhoeCHKNBUNpgkxyBdQwQH\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"4833FAA9-0001\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598283755,\"period_start\":1598283755,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598283755,\"marked_uncollectible_at\":null,\"paid_at\":1598283755,\"voided_at\":null},\"subscription\":\"sub_HtUo9YfkZnQSky\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_BvUex6a3YXhXmI\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 15:42:39'),
(32, '', 'customer.subscription.deleted', '{\"id\":\"evt_1HJhq6CHKNBUNpgkaasd8lF7\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598283846,\"data\":{\"object\":{\"id\":\"sub_HtUo9YfkZnQSky\",\"object\":\"subscription\",\"application_fee_percent\":null,\"billing\":\"charge_automatically\",\"billing_cycle_anchor\":1598400000,\"billing_thresholds\":null,\"cancel_at\":null,\"cancel_at_period_end\":false,\"canceled_at\":1598283846,\"collection_method\":\"charge_automatically\",\"created\":1598283755,\"current_period_end\":1598400000,\"current_period_start\":1598283755,\"customer\":\"cus_HtUoJU0tnbFpxy\",\"days_until_due\":null,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"discount\":null,\"ended_at\":1598283846,\"invoice_customer_balance_settings\":{\"consume_applied_balance_on_void\":true},\"items\":{\"object\":\"list\",\"data\":[{\"id\":\"si_HtUokgfU2eqZPa\",\"object\":\"subscription_item\",\"billing_thresholds\":null,\"created\":1598283756,\"metadata\":[],\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"quantity\":1,\"subscription\":\"sub_HtUo9YfkZnQSky\",\"tax_rates\":[]}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/subscription_items?subscription=sub_HtUo9YfkZnQSky\"},\"latest_invoice\":\"in_1HJhoeCHKNBUNpgkxyBdQwQH\",\"livemode\":false,\"metadata\":[],\"next_pending_invoice_item_invoice\":null,\"pause_collection\":null,\"pending_invoice_item_interval\":null,\"pending_setup_intent\":null,\"pending_update\":null,\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"quantity\":1,\"schedule\":null,\"start\":1598283755,\"start_date\":1598283755,\"status\":\"canceled\",\"tax_percent\":null,\"transfer_data\":null,\"trial_end\":1598400000,\"trial_start\":1598283755}},\"livemode\":false,\"pending_webhooks\":3,\"request\":{\"id\":\"req_fJdrnlYtOxGKym\",\"idempotency_key\":null},\"type\":\"customer.subscription.deleted\"}', '2020-08-24 15:44:08'),
(33, '', 'customer.subscription.deleted', '{\"id\":\"evt_1HJhq6CHKNBUNpgkaasd8lF7\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598283846,\"data\":{\"object\":{\"id\":\"sub_HtUo9YfkZnQSky\",\"object\":\"subscription\",\"application_fee_percent\":null,\"billing\":\"charge_automatically\",\"billing_cycle_anchor\":1598400000,\"billing_thresholds\":null,\"cancel_at\":null,\"cancel_at_period_end\":false,\"canceled_at\":1598283846,\"collection_method\":\"charge_automatically\",\"created\":1598283755,\"current_period_end\":1598400000,\"current_period_start\":1598283755,\"customer\":\"cus_HtUoJU0tnbFpxy\",\"days_until_due\":null,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"discount\":null,\"ended_at\":1598283846,\"invoice_customer_balance_settings\":{\"consume_applied_balance_on_void\":true},\"items\":{\"object\":\"list\",\"data\":[{\"id\":\"si_HtUokgfU2eqZPa\",\"object\":\"subscription_item\",\"billing_thresholds\":null,\"created\":1598283756,\"metadata\":[],\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"quantity\":1,\"subscription\":\"sub_HtUo9YfkZnQSky\",\"tax_rates\":[]}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/subscription_items?subscription=sub_HtUo9YfkZnQSky\"},\"latest_invoice\":\"in_1HJhoeCHKNBUNpgkxyBdQwQH\",\"livemode\":false,\"metadata\":[],\"next_pending_invoice_item_invoice\":null,\"pause_collection\":null,\"pending_invoice_item_interval\":null,\"pending_setup_intent\":null,\"pending_update\":null,\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"quantity\":1,\"schedule\":null,\"start\":1598283755,\"start_date\":1598283755,\"status\":\"canceled\",\"tax_percent\":null,\"transfer_data\":null,\"trial_end\":1598400000,\"trial_start\":1598283755}},\"livemode\":false,\"pending_webhooks\":1,\"request\":{\"id\":\"req_fJdrnlYtOxGKym\",\"idempotency_key\":null},\"type\":\"customer.subscription.deleted\"}', '2020-08-24 15:44:39'),
(34, '', 'invoice.paid', '{\"id\":\"evt_1HJhu1CHKNBUNpgkA438bHNH\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598284088,\"data\":{\"object\":{\"id\":\"in_1HJhu0CHKNBUNpgkA4uCmFOu\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598284088,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HrzodLJ1PikxBK\",\"customer_address\":null,\"customer_email\":null,\"customer_name\":null,\"customer_phone\":\"27266895\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598284088,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598284087,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtUtJquPdY3aVxZviPaSvoQ71n3Kfz1\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtUtJquPdY3aVxZviPaSvoQ71n3Kfz1\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_dc353bc4fca40a\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598284087},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtUtvNnuzvEAZ8\",\"subscription_item\":\"si_HtUtbiDNXs4TD8\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJhu0CHKNBUNpgkW4vV81up\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJhu0CHKNBUNpgkA4uCmFOu\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"66C0CAC0-0003\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598284087,\"period_start\":1598284087,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598284087,\"marked_uncollectible_at\":null,\"paid_at\":1598284087,\"voided_at\":null},\"subscription\":\"sub_HtUtvNnuzvEAZ8\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_2Zf9gtrqNjYrzU\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 15:48:13'),
(35, '', 'customer.subscription.deleted', '{\"id\":\"evt_1HJhvWCHKNBUNpgktVsIaVMh\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598284182,\"data\":{\"object\":{\"id\":\"sub_HtUtvNnuzvEAZ8\",\"object\":\"subscription\",\"application_fee_percent\":null,\"billing\":\"charge_automatically\",\"billing_cycle_anchor\":1598400000,\"billing_thresholds\":null,\"cancel_at\":null,\"cancel_at_period_end\":false,\"canceled_at\":1598284182,\"collection_method\":\"charge_automatically\",\"created\":1598284087,\"current_period_end\":1598400000,\"current_period_start\":1598284087,\"customer\":\"cus_HrzodLJ1PikxBK\",\"days_until_due\":null,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"discount\":null,\"ended_at\":1598284182,\"invoice_customer_balance_settings\":{\"consume_applied_balance_on_void\":true},\"items\":{\"object\":\"list\",\"data\":[{\"id\":\"si_HtUtbiDNXs4TD8\",\"object\":\"subscription_item\",\"billing_thresholds\":null,\"created\":1598284088,\"metadata\":[],\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"quantity\":1,\"subscription\":\"sub_HtUtvNnuzvEAZ8\",\"tax_rates\":[]}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/subscription_items?subscription=sub_HtUtvNnuzvEAZ8\"},\"latest_invoice\":\"in_1HJhu0CHKNBUNpgkA4uCmFOu\",\"livemode\":false,\"metadata\":[],\"next_pending_invoice_item_invoice\":null,\"pause_collection\":null,\"pending_invoice_item_interval\":null,\"pending_setup_intent\":null,\"pending_update\":null,\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"quantity\":1,\"schedule\":null,\"start\":1598284087,\"start_date\":1598284087,\"status\":\"canceled\",\"tax_percent\":null,\"transfer_data\":null,\"trial_end\":1598400000,\"trial_start\":1598284087}},\"livemode\":false,\"pending_webhooks\":3,\"request\":{\"id\":\"req_k5b3NVrPOMaIba\",\"idempotency_key\":null},\"type\":\"customer.subscription.deleted\"}', '2020-08-24 15:49:43'),
(36, '', 'invoice.paid', '{\"id\":\"evt_1HJhxYCHKNBUNpgkk7EiLp4x\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598284307,\"data\":{\"object\":{\"id\":\"in_1HJhxWCHKNBUNpgkbGAFO7iJ\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598284306,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtUxjJOalWUNlg\",\"customer_address\":null,\"customer_email\":\"Rohit@gmail.com\",\"customer_name\":\"Rohit Gupta\",\"customer_phone\":\"8290163691\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598284306,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598284306,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtUxVVOjuaDJxbBFN45YTGiykN4TxnH\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtUxVVOjuaDJxbBFN45YTGiykN4TxnH\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_d157102957c6db\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598284306},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtUxG9WW1pz9NW\",\"subscription_item\":\"si_HtUxAxncZUCSGo\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJhxWCHKNBUNpgkMVew60nb\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJhxWCHKNBUNpgkbGAFO7iJ\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"9C7BB7F8-0001\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598284306,\"period_start\":1598284306,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598284306,\"marked_uncollectible_at\":null,\"paid_at\":1598284306,\"voided_at\":null},\"subscription\":\"sub_HtUxG9WW1pz9NW\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_6qdQLc39HEwexn\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 15:51:49'),
(37, '', 'customer.subscription.deleted', '{\"id\":\"evt_1HJhyDCHKNBUNpgkYidaTS2G\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598284349,\"data\":{\"object\":{\"id\":\"sub_HtUxG9WW1pz9NW\",\"object\":\"subscription\",\"application_fee_percent\":null,\"billing\":\"charge_automatically\",\"billing_cycle_anchor\":1598400000,\"billing_thresholds\":null,\"cancel_at\":null,\"cancel_at_period_end\":false,\"canceled_at\":1598284349,\"collection_method\":\"charge_automatically\",\"created\":1598284306,\"current_period_end\":1598400000,\"current_period_start\":1598284306,\"customer\":\"cus_HtUxjJOalWUNlg\",\"days_until_due\":null,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"discount\":null,\"ended_at\":1598284349,\"invoice_customer_balance_settings\":{\"consume_applied_balance_on_void\":true},\"items\":{\"object\":\"list\",\"data\":[{\"id\":\"si_HtUxAxncZUCSGo\",\"object\":\"subscription_item\",\"billing_thresholds\":null,\"created\":1598284307,\"metadata\":[],\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"quantity\":1,\"subscription\":\"sub_HtUxG9WW1pz9NW\",\"tax_rates\":[]}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/subscription_items?subscription=sub_HtUxG9WW1pz9NW\"},\"latest_invoice\":\"in_1HJhxWCHKNBUNpgkbGAFO7iJ\",\"livemode\":false,\"metadata\":[],\"next_pending_invoice_item_invoice\":null,\"pause_collection\":null,\"pending_invoice_item_interval\":null,\"pending_setup_intent\":null,\"pending_update\":null,\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"quantity\":1,\"schedule\":null,\"start\":1598284306,\"start_date\":1598284306,\"status\":\"canceled\",\"tax_percent\":null,\"transfer_data\":null,\"trial_end\":1598400000,\"trial_start\":1598284306}},\"livemode\":false,\"pending_webhooks\":3,\"request\":{\"id\":\"req_cZsM1axki3zk5I\",\"idempotency_key\":null},\"type\":\"customer.subscription.deleted\"}', '2020-08-24 15:52:30'),
(38, '', 'subscription_schedule.canceled', '{\"created\":1326853478,\"livemode\":false,\"id\":\"evt_00000000000000\",\"type\":\"subscription_schedule.canceled\",\"object\":\"event\",\"request\":null,\"pending_webhooks\":1,\"api_version\":\"2018-10-31\",\"data\":{\"object\":{\"id\":\"sub_00000000000000\",\"object\":\"subscription_schedule\",\"canceled_at\":null,\"completed_at\":null,\"created\":1598284584,\"current_phase\":null,\"customer\":\"cus_00000000000000\",\"default_settings\":{\"billing_cycle_anchor\":\"automatic\",\"billing_thresholds\":null,\"collection_method\":\"charge_automatically\",\"default_payment_method\":null,\"invoice_settings\":null,\"transfer_data\":null},\"end_behavior\":\"release\",\"livemode\":false,\"metadata\":[],\"phases\":[{\"add_invoice_items\":[],\"application_fee_percent\":null,\"billing_cycle_anchor\":null,\"billing_thresholds\":null,\"collection_method\":null,\"coupon\":null,\"default_payment_method\":null,\"default_tax_rates\":[],\"end_date\":1630338984,\"invoice_settings\":null,\"plans\":[{\"billing_thresholds\":null,\"price\":\"price_00000000000000\",\"quantity\":1,\"tax_rates\":[]}],\"prorate\":true,\"proration_behavior\":\"create_prorations\",\"start_date\":1598889384,\"tax_percent\":null,\"transfer_data\":null,\"trial_end\":null}],\"released_at\":null,\"released_subscription\":null,\"status\":\"not_started\",\"subscription\":null}}}', '2020-08-24 15:56:25'),
(39, '', 'invoice.paid', '{\"id\":\"evt_1HJi8xCHKNBUNpgknI4TX4KX\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598285014,\"data\":{\"object\":{\"id\":\"in_1HJi8vCHKNBUNpgkRafyFgfK\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598285013,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtV98OWk9iR1Cj\",\"customer_address\":null,\"customer_email\":\"Christopher@gmail.com\",\"customer_name\":\"Christopher Guillaud Kleberg\",\"customer_phone\":\"60108696\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598285013,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598285013,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtV9YKkiugEhjGfmq2wdt7HAaeLhOQy\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtV9YKkiugEhjGfmq2wdt7HAaeLhOQy\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_42645ff4630e3f\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598285013},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtV9gDs8rfIx5B\",\"subscription_item\":\"si_HtV9u8bypKhTih\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJi8vCHKNBUNpgkgzYt69bv\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJi8vCHKNBUNpgkRafyFgfK\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"0087C7F3-0001\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598285013,\"period_start\":1598285013,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598285013,\"marked_uncollectible_at\":null,\"paid_at\":1598285013,\"voided_at\":null},\"subscription\":\"sub_HtV9gDs8rfIx5B\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_SS6OBDznuy4BgR\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 16:03:37'),
(40, '', 'customer.subscription.deleted', '{\"id\":\"evt_1HJi9DCHKNBUNpgkRUCvlzs2\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598285031,\"data\":{\"object\":{\"id\":\"sub_HtV9gDs8rfIx5B\",\"object\":\"subscription\",\"application_fee_percent\":null,\"billing\":\"charge_automatically\",\"billing_cycle_anchor\":1598400000,\"billing_thresholds\":null,\"cancel_at\":null,\"cancel_at_period_end\":false,\"canceled_at\":1598285030,\"collection_method\":\"charge_automatically\",\"created\":1598285013,\"current_period_end\":1598400000,\"current_period_start\":1598285013,\"customer\":\"cus_HtV98OWk9iR1Cj\",\"days_until_due\":null,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"discount\":null,\"ended_at\":1598285030,\"invoice_customer_balance_settings\":{\"consume_applied_balance_on_void\":true},\"items\":{\"object\":\"list\",\"data\":[{\"id\":\"si_HtV9u8bypKhTih\",\"object\":\"subscription_item\",\"billing_thresholds\":null,\"created\":1598285014,\"metadata\":[],\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"quantity\":1,\"subscription\":\"sub_HtV9gDs8rfIx5B\",\"tax_rates\":[]}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/subscription_items?subscription=sub_HtV9gDs8rfIx5B\"},\"latest_invoice\":\"in_1HJi8vCHKNBUNpgkRafyFgfK\",\"livemode\":false,\"metadata\":[],\"next_pending_invoice_item_invoice\":null,\"pause_collection\":null,\"pending_invoice_item_interval\":null,\"pending_setup_intent\":null,\"pending_update\":null,\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"quantity\":1,\"schedule\":null,\"start\":1598285013,\"start_date\":1598285013,\"status\":\"canceled\",\"tax_percent\":null,\"transfer_data\":null,\"trial_end\":1598400000,\"trial_start\":1598285013}},\"livemode\":false,\"pending_webhooks\":3,\"request\":{\"id\":\"req_sm4gAeUDetLtLD\",\"idempotency_key\":null},\"type\":\"customer.subscription.deleted\"}', '2020-08-24 16:03:52'),
(41, '', 'invoice.paid', '{\"id\":\"evt_1HJiM4CHKNBUNpgkCFsZEKn2\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598285827,\"data\":{\"object\":{\"id\":\"in_1HJiM2CHKNBUNpgkggQrf5a4\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598285826,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtVME9HahgnNsA\",\"customer_address\":null,\"customer_email\":\"Alexander@gmail.com\",\"customer_name\":\"Alexander Chalmer\",\"customer_phone\":\"22324681\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598285826,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598285826,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtVM4ltXh6gVPYUZwKvJcr8YavCL99E\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtVM4ltXh6gVPYUZwKvJcr8YavCL99E\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_f988d368ad2645\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598285826},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtVMjOH0fC6OeR\",\"subscription_item\":\"si_HtVMBNOucOYhVI\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJiM2CHKNBUNpgkvKVYyRtT\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJiM2CHKNBUNpgkggQrf5a4\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"9B07998E-0001\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598285826,\"period_start\":1598285826,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598285826,\"marked_uncollectible_at\":null,\"paid_at\":1598285826,\"voided_at\":null},\"subscription\":\"sub_HtVMjOH0fC6OeR\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_8JDA5wX7TcqvJw\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 16:17:10'),
(42, '', 'customer.subscription.deleted', '{\"id\":\"evt_1HJiNVCHKNBUNpgkjGcDA09t\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598285917,\"data\":{\"object\":{\"id\":\"sub_HtVMjOH0fC6OeR\",\"object\":\"subscription\",\"application_fee_percent\":null,\"billing\":\"charge_automatically\",\"billing_cycle_anchor\":1598400000,\"billing_thresholds\":null,\"cancel_at\":null,\"cancel_at_period_end\":false,\"canceled_at\":1598285917,\"collection_method\":\"charge_automatically\",\"created\":1598285826,\"current_period_end\":1598400000,\"current_period_start\":1598285826,\"customer\":\"cus_HtVME9HahgnNsA\",\"days_until_due\":null,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"discount\":null,\"ended_at\":1598285917,\"invoice_customer_balance_settings\":{\"consume_applied_balance_on_void\":true},\"items\":{\"object\":\"list\",\"data\":[{\"id\":\"si_HtVMBNOucOYhVI\",\"object\":\"subscription_item\",\"billing_thresholds\":null,\"created\":1598285827,\"metadata\":[],\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"quantity\":1,\"subscription\":\"sub_HtVMjOH0fC6OeR\",\"tax_rates\":[]}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/subscription_items?subscription=sub_HtVMjOH0fC6OeR\"},\"latest_invoice\":\"in_1HJiM2CHKNBUNpgkggQrf5a4\",\"livemode\":false,\"metadata\":[],\"next_pending_invoice_item_invoice\":null,\"pause_collection\":null,\"pending_invoice_item_interval\":null,\"pending_setup_intent\":null,\"pending_update\":null,\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"quantity\":1,\"schedule\":null,\"start\":1598285826,\"start_date\":1598285826,\"status\":\"canceled\",\"tax_percent\":null,\"transfer_data\":null,\"trial_end\":1598400000,\"trial_start\":1598285826}},\"livemode\":false,\"pending_webhooks\":3,\"request\":{\"id\":\"req_Cy95NEn0TVF3z7\",\"idempotency_key\":null},\"type\":\"customer.subscription.deleted\"}', '2020-08-24 16:18:40');
INSERT INTO `webhooks` (`id`, `status`, `type`, `payload`, `created_at`) VALUES
(43, '', 'invoice.paid', '{\"id\":\"evt_1HJiYVCHKNBUNpgk96iRWPlf\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598286598,\"data\":{\"object\":{\"id\":\"in_1HJiYUCHKNBUNpgkdAZTCAVJ\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598286598,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtVZtaJn9OTm7t\",\"customer_address\":null,\"customer_email\":\"manish111@gmail.com\",\"customer_name\":\"manish\",\"customer_phone\":\"9926331376\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598286598,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598286597,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtVZookWJ7ETUxWfsB6s8zDwbV5epD5\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtVZookWJ7ETUxWfsB6s8zDwbV5epD5\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_07f4381f5c74ce\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598286597},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtVZ0x3m9jGmab\",\"subscription_item\":\"si_HtVZDc0DlFrO0b\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJiYUCHKNBUNpgkAj1h9Z9c\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJiYUCHKNBUNpgkdAZTCAVJ\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"7F745AE9-0001\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598286597,\"period_start\":1598286597,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598286597,\"marked_uncollectible_at\":null,\"paid_at\":1598286597,\"voided_at\":null},\"subscription\":\"sub_HtVZ0x3m9jGmab\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_e2sezl4ujFdAMn\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 16:30:02'),
(44, '', 'customer.subscription.deleted', '{\"id\":\"evt_1HJiYuCHKNBUNpgkiMcx7H2z\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598286623,\"data\":{\"object\":{\"id\":\"sub_HtVZ0x3m9jGmab\",\"object\":\"subscription\",\"application_fee_percent\":null,\"billing\":\"charge_automatically\",\"billing_cycle_anchor\":1598400000,\"billing_thresholds\":null,\"cancel_at\":null,\"cancel_at_period_end\":false,\"canceled_at\":1598286623,\"collection_method\":\"charge_automatically\",\"created\":1598286597,\"current_period_end\":1598400000,\"current_period_start\":1598286597,\"customer\":\"cus_HtVZtaJn9OTm7t\",\"days_until_due\":null,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"discount\":null,\"ended_at\":1598286623,\"invoice_customer_balance_settings\":{\"consume_applied_balance_on_void\":true},\"items\":{\"object\":\"list\",\"data\":[{\"id\":\"si_HtVZDc0DlFrO0b\",\"object\":\"subscription_item\",\"billing_thresholds\":null,\"created\":1598286598,\"metadata\":[],\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"quantity\":1,\"subscription\":\"sub_HtVZ0x3m9jGmab\",\"tax_rates\":[]}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/subscription_items?subscription=sub_HtVZ0x3m9jGmab\"},\"latest_invoice\":\"in_1HJiYUCHKNBUNpgkdAZTCAVJ\",\"livemode\":false,\"metadata\":[],\"next_pending_invoice_item_invoice\":null,\"pause_collection\":null,\"pending_invoice_item_interval\":null,\"pending_setup_intent\":null,\"pending_update\":null,\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"quantity\":1,\"schedule\":null,\"start\":1598286597,\"start_date\":1598286597,\"status\":\"canceled\",\"tax_percent\":null,\"transfer_data\":null,\"trial_end\":1598400000,\"trial_start\":1598286597}},\"livemode\":false,\"pending_webhooks\":3,\"request\":{\"id\":\"req_yj9cS4hq0A00AJ\",\"idempotency_key\":null},\"type\":\"customer.subscription.deleted\"}', '2020-08-24 16:30:27'),
(45, '', 'invoice.paid', '{\"id\":\"evt_1HJib4CHKNBUNpgkAVJsl0Hh\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598286756,\"data\":{\"object\":{\"id\":\"in_1HJib2CHKNBUNpgkCNGzF4e2\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598286756,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtVcU6X2HKlVWp\",\"customer_address\":null,\"customer_email\":\"Vladimir@gmail.com\",\"customer_name\":\"Vladimir Ristic\",\"customer_phone\":\"28687766\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598286756,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598286756,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtVcO9zfI2cbbB0wDLyWBuE0hPun6jx\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtVcO9zfI2cbbB0wDLyWBuE0hPun6jx\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_a5cab7eaf2a616\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598286756},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtVcaOLV8e0OfM\",\"subscription_item\":\"si_HtVcE6bfff8LjB\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJib2CHKNBUNpgkSPIBO2Hx\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJib2CHKNBUNpgkCNGzF4e2\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"2718EA7B-0001\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598286756,\"period_start\":1598286756,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598286756,\"marked_uncollectible_at\":null,\"paid_at\":1598286756,\"voided_at\":null},\"subscription\":\"sub_HtVcaOLV8e0OfM\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_zAy9hk30ZcQuzT\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 16:32:40'),
(46, '', 'customer.subscription.deleted', '{\"id\":\"evt_1HJibGCHKNBUNpgkUgzT6suC\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598286770,\"data\":{\"object\":{\"id\":\"sub_HtVcaOLV8e0OfM\",\"object\":\"subscription\",\"application_fee_percent\":null,\"billing\":\"charge_automatically\",\"billing_cycle_anchor\":1598400000,\"billing_thresholds\":null,\"cancel_at\":null,\"cancel_at_period_end\":false,\"canceled_at\":1598286770,\"collection_method\":\"charge_automatically\",\"created\":1598286756,\"current_period_end\":1598400000,\"current_period_start\":1598286756,\"customer\":\"cus_HtVcU6X2HKlVWp\",\"days_until_due\":null,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"discount\":null,\"ended_at\":1598286770,\"invoice_customer_balance_settings\":{\"consume_applied_balance_on_void\":true},\"items\":{\"object\":\"list\",\"data\":[{\"id\":\"si_HtVcE6bfff8LjB\",\"object\":\"subscription_item\",\"billing_thresholds\":null,\"created\":1598286756,\"metadata\":[],\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"quantity\":1,\"subscription\":\"sub_HtVcaOLV8e0OfM\",\"tax_rates\":[]}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/subscription_items?subscription=sub_HtVcaOLV8e0OfM\"},\"latest_invoice\":\"in_1HJib2CHKNBUNpgkCNGzF4e2\",\"livemode\":false,\"metadata\":[],\"next_pending_invoice_item_invoice\":null,\"pause_collection\":null,\"pending_invoice_item_interval\":null,\"pending_setup_intent\":null,\"pending_update\":null,\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"quantity\":1,\"schedule\":null,\"start\":1598286756,\"start_date\":1598286756,\"status\":\"canceled\",\"tax_percent\":null,\"transfer_data\":null,\"trial_end\":1598400000,\"trial_start\":1598286756}},\"livemode\":false,\"pending_webhooks\":3,\"request\":{\"id\":\"req_mAA2TibWV0zAYc\",\"idempotency_key\":null},\"type\":\"customer.subscription.deleted\"}', '2020-08-24 16:32:53'),
(47, '', 'customer.subscription.deleted', '{\"id\":\"evt_1HJhq6CHKNBUNpgkaasd8lF7\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598283846,\"data\":{\"object\":{\"id\":\"sub_HtUo9YfkZnQSky\",\"object\":\"subscription\",\"application_fee_percent\":null,\"billing\":\"charge_automatically\",\"billing_cycle_anchor\":1598400000,\"billing_thresholds\":null,\"cancel_at\":null,\"cancel_at_period_end\":false,\"canceled_at\":1598283846,\"collection_method\":\"charge_automatically\",\"created\":1598283755,\"current_period_end\":1598400000,\"current_period_start\":1598283755,\"customer\":\"cus_HtUoJU0tnbFpxy\",\"days_until_due\":null,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"discount\":null,\"ended_at\":1598283846,\"invoice_customer_balance_settings\":{\"consume_applied_balance_on_void\":true},\"items\":{\"object\":\"list\",\"data\":[{\"id\":\"si_HtUokgfU2eqZPa\",\"object\":\"subscription_item\",\"billing_thresholds\":null,\"created\":1598283756,\"metadata\":[],\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"quantity\":1,\"subscription\":\"sub_HtUo9YfkZnQSky\",\"tax_rates\":[]}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/subscription_items?subscription=sub_HtUo9YfkZnQSky\"},\"latest_invoice\":\"in_1HJhoeCHKNBUNpgkxyBdQwQH\",\"livemode\":false,\"metadata\":[],\"next_pending_invoice_item_invoice\":null,\"pause_collection\":null,\"pending_invoice_item_interval\":null,\"pending_setup_intent\":null,\"pending_update\":null,\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"quantity\":1,\"schedule\":null,\"start\":1598283755,\"start_date\":1598283755,\"status\":\"canceled\",\"tax_percent\":null,\"transfer_data\":null,\"trial_end\":1598400000,\"trial_start\":1598283755}},\"livemode\":false,\"pending_webhooks\":1,\"request\":{\"id\":\"req_fJdrnlYtOxGKym\",\"idempotency_key\":null},\"type\":\"customer.subscription.deleted\"}', '2020-08-24 16:43:39'),
(48, '', 'invoice.paid', '{\"id\":\"evt_1HJiqACHKNBUNpgkCgxQltkV\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598287693,\"data\":{\"object\":{\"id\":\"in_1HJiq8CHKNBUNpgkXXmfV0nf\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598287692,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtVrMAzsj1TxLx\",\"customer_address\":null,\"customer_email\":\"Lucas@gmail.com\",\"customer_name\":\"Lucas Castenborg\",\"customer_phone\":\"52396393\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598287692,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598287692,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtVr6eYboR1mD73fR2RXSdKGTX64gzD\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtVr6eYboR1mD73fR2RXSdKGTX64gzD\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_f6474b273e5a2a\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598287692},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtVrF1BRImH8P7\",\"subscription_item\":\"si_HtVrYta9QrJE6Q\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJiq8CHKNBUNpgk49faJNb9\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJiq8CHKNBUNpgkXXmfV0nf\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"15996E70-0001\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598287692,\"period_start\":1598287692,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598287692,\"marked_uncollectible_at\":null,\"paid_at\":1598287692,\"voided_at\":null},\"subscription\":\"sub_HtVrF1BRImH8P7\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_hxbGeSMX8cJlBm\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 16:48:16'),
(49, '', 'customer.subscription.deleted', '{\"id\":\"evt_1HJhvWCHKNBUNpgktVsIaVMh\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598284182,\"data\":{\"object\":{\"id\":\"sub_HtUtvNnuzvEAZ8\",\"object\":\"subscription\",\"application_fee_percent\":null,\"billing\":\"charge_automatically\",\"billing_cycle_anchor\":1598400000,\"billing_thresholds\":null,\"cancel_at\":null,\"cancel_at_period_end\":false,\"canceled_at\":1598284182,\"collection_method\":\"charge_automatically\",\"created\":1598284087,\"current_period_end\":1598400000,\"current_period_start\":1598284087,\"customer\":\"cus_HrzodLJ1PikxBK\",\"days_until_due\":null,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"discount\":null,\"ended_at\":1598284182,\"invoice_customer_balance_settings\":{\"consume_applied_balance_on_void\":true},\"items\":{\"object\":\"list\",\"data\":[{\"id\":\"si_HtUtbiDNXs4TD8\",\"object\":\"subscription_item\",\"billing_thresholds\":null,\"created\":1598284088,\"metadata\":[],\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"quantity\":1,\"subscription\":\"sub_HtUtvNnuzvEAZ8\",\"tax_rates\":[]}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/subscription_items?subscription=sub_HtUtvNnuzvEAZ8\"},\"latest_invoice\":\"in_1HJhu0CHKNBUNpgkA4uCmFOu\",\"livemode\":false,\"metadata\":[],\"next_pending_invoice_item_invoice\":null,\"pause_collection\":null,\"pending_invoice_item_interval\":null,\"pending_setup_intent\":null,\"pending_update\":null,\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"quantity\":1,\"schedule\":null,\"start\":1598284087,\"start_date\":1598284087,\"status\":\"canceled\",\"tax_percent\":null,\"transfer_data\":null,\"trial_end\":1598400000,\"trial_start\":1598284087}},\"livemode\":false,\"pending_webhooks\":1,\"request\":{\"id\":\"req_k5b3NVrPOMaIba\",\"idempotency_key\":null},\"type\":\"customer.subscription.deleted\"}', '2020-08-24 16:49:04'),
(50, '', 'customer.subscription.deleted', '{\"id\":\"evt_1HJirSCHKNBUNpgkryNvRv1C\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598287774,\"data\":{\"object\":{\"id\":\"sub_HtVrF1BRImH8P7\",\"object\":\"subscription\",\"application_fee_percent\":null,\"billing\":\"charge_automatically\",\"billing_cycle_anchor\":1598400000,\"billing_thresholds\":null,\"cancel_at\":null,\"cancel_at_period_end\":false,\"canceled_at\":1598287774,\"collection_method\":\"charge_automatically\",\"created\":1598287692,\"current_period_end\":1598400000,\"current_period_start\":1598287692,\"customer\":\"cus_HtVrMAzsj1TxLx\",\"days_until_due\":null,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"discount\":null,\"ended_at\":1598287774,\"invoice_customer_balance_settings\":{\"consume_applied_balance_on_void\":true},\"items\":{\"object\":\"list\",\"data\":[{\"id\":\"si_HtVrYta9QrJE6Q\",\"object\":\"subscription_item\",\"billing_thresholds\":null,\"created\":1598287692,\"metadata\":[],\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"quantity\":1,\"subscription\":\"sub_HtVrF1BRImH8P7\",\"tax_rates\":[]}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/subscription_items?subscription=sub_HtVrF1BRImH8P7\"},\"latest_invoice\":\"in_1HJiq8CHKNBUNpgkXXmfV0nf\",\"livemode\":false,\"metadata\":[],\"next_pending_invoice_item_invoice\":null,\"pause_collection\":null,\"pending_invoice_item_interval\":null,\"pending_setup_intent\":null,\"pending_update\":null,\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"quantity\":1,\"schedule\":null,\"start\":1598287692,\"start_date\":1598287692,\"status\":\"canceled\",\"tax_percent\":null,\"transfer_data\":null,\"trial_end\":1598400000,\"trial_start\":1598287692}},\"livemode\":false,\"pending_webhooks\":3,\"request\":{\"id\":\"req_czvnw3jgYCFIAx\",\"idempotency_key\":null},\"type\":\"customer.subscription.deleted\"}', '2020-08-24 16:49:36'),
(51, '', 'invoice.paid', '{\"id\":\"evt_1HJiwqCHKNBUNpgkBGMAHpxm\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598288107,\"data\":{\"object\":{\"id\":\"in_1HJiwoCHKNBUNpgkzGwpDQwh\",\"object\":\"invoice\",\"account_country\":\"DK\",\"account_name\":\"MealTicket\",\"amount_due\":0,\"amount_paid\":0,\"amount_remaining\":0,\"application_fee\":null,\"attempt_count\":0,\"attempted\":true,\"auto_advance\":false,\"billing\":\"charge_automatically\",\"billing_reason\":\"subscription_create\",\"charge\":null,\"closed\":true,\"collection_method\":\"charge_automatically\",\"created\":1598288106,\"currency\":\"dkk\",\"custom_fields\":null,\"customer\":\"cus_HtVycqA76px8IS\",\"customer_address\":null,\"customer_email\":\"Hector@gmail.com\",\"customer_name\":\"Hector Foss\",\"customer_phone\":\"42921172\",\"customer_shipping\":null,\"customer_tax_exempt\":\"none\",\"customer_tax_ids\":[],\"date\":1598288106,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"description\":null,\"discount\":null,\"discounts\":[],\"due_date\":null,\"ending_balance\":0,\"finalized_at\":1598288106,\"footer\":null,\"forgiven\":false,\"hosted_invoice_url\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtVyqSdYsTGRthM7M75cf2wQtDO9OlK\",\"invoice_pdf\":\"https:\\/\\/pay.stripe.com\\/invoice\\/acct_1DTVcrCHKNBUNpgk\\/invst_HtVyqSdYsTGRthM7M75cf2wQtDO9OlK\\/pdf\",\"lines\":{\"object\":\"list\",\"data\":[{\"id\":\"sli_0363905b9c77f3\",\"object\":\"line_item\",\"amount\":0,\"currency\":\"dkk\",\"description\":\"Trial period for Junior\",\"discount_amounts\":[],\"discountable\":true,\"discounts\":[],\"livemode\":false,\"metadata\":[],\"period\":{\"end\":1598400000,\"start\":1598288106},\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"proration\":false,\"quantity\":1,\"subscription\":\"sub_HtVyrGCRYeQ8lT\",\"subscription_item\":\"si_HtVyXz4gnWhiTM\",\"tax_amounts\":[],\"tax_rates\":[],\"type\":\"subscription\",\"unique_id\":\"il_1HJiwoCHKNBUNpgkiQ0h8L9H\"}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/invoices\\/in_1HJiwoCHKNBUNpgkzGwpDQwh\\/lines\"},\"livemode\":false,\"metadata\":[],\"next_payment_attempt\":null,\"number\":\"89FE7DB2-0001\",\"paid\":true,\"payment_intent\":null,\"period_end\":1598288106,\"period_start\":1598288106,\"post_payment_credit_notes_amount\":0,\"pre_payment_credit_notes_amount\":0,\"receipt_number\":null,\"starting_balance\":0,\"statement_descriptor\":null,\"status\":\"paid\",\"status_transitions\":{\"finalized_at\":1598288106,\"marked_uncollectible_at\":null,\"paid_at\":1598288106,\"voided_at\":null},\"subscription\":\"sub_HtVyrGCRYeQ8lT\",\"subtotal\":0,\"tax\":null,\"tax_percent\":null,\"total\":0,\"total_discount_amounts\":[],\"total_tax_amounts\":[],\"transfer_data\":null,\"webhooks_delivered_at\":null}},\"livemode\":false,\"pending_webhooks\":2,\"request\":{\"id\":\"req_MyIv3bZbcgzKNn\",\"idempotency_key\":null},\"type\":\"invoice.paid\"}', '2020-08-24 16:55:11'),
(52, '', 'customer.subscription.deleted', '{\"id\":\"evt_1HJizWCHKNBUNpgk5luNMMtt\",\"object\":\"event\",\"api_version\":\"2018-10-31\",\"created\":1598288274,\"data\":{\"object\":{\"id\":\"sub_HtVyrGCRYeQ8lT\",\"object\":\"subscription\",\"application_fee_percent\":null,\"billing\":\"charge_automatically\",\"billing_cycle_anchor\":1598400000,\"billing_thresholds\":null,\"cancel_at\":null,\"cancel_at_period_end\":false,\"canceled_at\":1598288274,\"collection_method\":\"charge_automatically\",\"created\":1598288106,\"current_period_end\":1598400000,\"current_period_start\":1598288106,\"customer\":\"cus_HtVycqA76px8IS\",\"days_until_due\":null,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"discount\":null,\"ended_at\":1598288274,\"invoice_customer_balance_settings\":{\"consume_applied_balance_on_void\":true},\"items\":{\"object\":\"list\",\"data\":[{\"id\":\"si_HtVyXz4gnWhiTM\",\"object\":\"subscription_item\",\"billing_thresholds\":null,\"created\":1598288107,\"metadata\":[],\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"week\",\"interval_count\":1,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":3800,\"unit_amount_decimal\":\"3800\"},\"quantity\":1,\"subscription\":\"sub_HtVyrGCRYeQ8lT\",\"tax_rates\":[]}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/subscription_items?subscription=sub_HtVyrGCRYeQ8lT\"},\"latest_invoice\":\"in_1HJiwoCHKNBUNpgkzGwpDQwh\",\"livemode\":false,\"metadata\":[],\"next_pending_invoice_item_invoice\":null,\"pause_collection\":null,\"pending_invoice_item_interval\":null,\"pending_setup_intent\":null,\"pending_update\":null,\"plan\":{\"id\":\"price_1HJZ6BCHKNBUNpgkKgGnC5xT\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":3800,\"amount_decimal\":\"3800\",\"billing_scheme\":\"per_unit\",\"created\":1598250247,\"currency\":\"dkk\",\"interval\":\"week\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HtLnMRfxhVyUsI\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":2,\"usage_type\":\"licensed\"},\"quantity\":1,\"schedule\":null,\"start\":1598288106,\"start_date\":1598288106,\"status\":\"canceled\",\"tax_percent\":null,\"transfer_data\":null,\"trial_end\":1598400000,\"trial_start\":1598288106}},\"livemode\":false,\"pending_webhooks\":3,\"request\":{\"id\":\"req_ZCIXMDV00tzfcs\",\"idempotency_key\":null},\"type\":\"customer.subscription.deleted\"}', '2020-08-24 16:57:56');

-- --------------------------------------------------------

--
-- Table structure for table `websitesettings`
--

CREATE TABLE `websitesettings` (
  `id` int(10) UNSIGNED NOT NULL,
  `website_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website_logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locktimeout` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatapps_no` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sapport_no` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `near_by_distance` int(11) DEFAULT 0,
  `fb_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twi_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `yout_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `websitesettings`
--

INSERT INTO `websitesettings` (`id`, `website_name`, `website_logo`, `locktimeout`, `email`, `address`, `mobile`, `whatapps_no`, `sapport_no`, `near_by_distance`, `fb_link`, `twi_link`, `yout_link`, `created_at`, `updated_at`) VALUES
(1, 'Amigos', '', '10', 'manish09.chakravarti@gmail.com', 'BHOPAL', '9926331375', '9876543213', '8987654323', 20, '', '', '', '2018-04-10 21:57:19', '2020-10-05 08:16:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`countries_id`);

--
-- Indexes for table `device_detail`
--
ALTER TABLE `device_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions1`
--
ALTER TABLE `permissions1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile_number` (`mobile_number`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cart_detail`
--
ALTER TABLE `tbl_cart_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_email_template`
--
ALTER TABLE `tbl_email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_inventory_entry`
--
ALTER TABLE `tbl_inventory_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_messages_template`
--
ALTER TABLE `tbl_messages_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_offer`
--
ALTER TABLE `tbl_offer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupon` (`coupon`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tbl_search_history`
--
ALTER TABLE `tbl_search_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_static_page_editor`
--
ALTER TABLE `tbl_static_page_editor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_store`
--
ALTER TABLE `tbl_store`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `tbl_store_category_maping`
--
ALTER TABLE `tbl_store_category_maping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_address`
--
ALTER TABLE `tbl_user_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_roleid_foreign` (`RoleID`);

--
-- Indexes for table `webhooks`
--
ALTER TABLE `webhooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `websitesettings`
--
ALTER TABLE `websitesettings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `countries_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `device_detail`
--
ALTER TABLE `device_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `permissions1`
--
ALTER TABLE `permissions1`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_cart_detail`
--
ALTER TABLE `tbl_cart_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_email_template`
--
ALTER TABLE `tbl_email_template`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tbl_inventory_entry`
--
ALTER TABLE `tbl_inventory_entry`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tbl_messages_template`
--
ALTER TABLE `tbl_messages_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_offer`
--
ALTER TABLE `tbl_offer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_search_history`
--
ALTER TABLE `tbl_search_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_static_page_editor`
--
ALTER TABLE `tbl_static_page_editor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_store`
--
ALTER TABLE `tbl_store`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_store_category_maping`
--
ALTER TABLE `tbl_store_category_maping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_user_address`
--
ALTER TABLE `tbl_user_address`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `webhooks`
--
ALTER TABLE `webhooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `websitesettings`
--
ALTER TABLE `websitesettings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
