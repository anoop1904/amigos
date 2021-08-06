-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2020 at 04:32 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `ref_by_ambas_credit` int(11) NOT NULL,
  `referred_by_credit` int(11) NOT NULL,
  `referred_to_credit` int(11) NOT NULL,
  `fb_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twi_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `yout_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `websitesettings`
--

INSERT INTO `websitesettings` (`id`, `website_name`, `website_logo`, `locktimeout`, `email`, `address`, `mobile`, `ref_by_ambas_credit`, `referred_by_credit`, `referred_to_credit`, `fb_link`, `twi_link`, `yout_link`, `created_at`, `updated_at`) VALUES
(1, 'Subtitle Crazy', '', '10', 'manish09.chakravarti@gmail.com', 'BHOPAL', '9826702123', 60, 50, 50, '', '', '', '2018-04-10 21:57:19', '2020-08-02 07:48:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `websitesettings`
--
ALTER TABLE `websitesettings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `websitesettings`
--
ALTER TABLE `websitesettings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
