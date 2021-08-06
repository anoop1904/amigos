-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2020 at 12:00 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mealticket_webapp`
--

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
  `trail_days` int(11) NOT NULL DEFAULT 0,
  `max_meals_per_week` int(11) NOT NULL,
  `max_amount_per_meal` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `plan_id`, `name`, `price`, `description`, `trail_days`, `max_meals_per_week`, `max_amount_per_meal`, `image`, `deleted`, `created_at`, `updated_at`) VALUES
(4, 'new', 'Silver Plan', '100', 'Student budget plan', 0, 4, 30, '1596187052.jpg', 0, '2020-07-31 03:47:32', '2020-07-31 04:08:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
