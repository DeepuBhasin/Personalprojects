-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 13, 2020 at 07:13 AM
-- Server version: 5.6.47-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `email`, `created_at`) VALUES
('cus_H5cE4o4L985u2U', 'Deepinder', 'Singh', 'Deepinder000@gmail.com', '2020-04-13 05:02:23'),
('cus_H5cOaiPGMza96h', 'mohmedirfan', 'ansari', 'charles.phoneix@gmail.com', '2020-04-13 05:12:51');

-- --------------------------------------------------------

--
-- Table structure for table `didww_user`
--

CREATE TABLE `didww_user` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `user_number` varchar(225) DEFAULT NULL,
  `user_limit` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `didww_user`
--

INSERT INTO `didww_user` (`user_id`, `full_name`, `email_id`, `user_number`, `user_limit`, `status`, `created_dt`) VALUES
(1, 'Mohammad Furkan', 'furqan@mycountrymobile.com', '19177225031', NULL, 1, '2020-04-09 17:09:53'),
(7, 'shoeb', 'shoeb@gmail.com', '8291990220', NULL, 1, '2020-04-10 16:02:24'),
(8, 'Deepinder Singh', 'deepinder999@gmail.com', '919915099247', 4, 1, '2020-04-13 18:48:22'),
(9, 'gurjeet', 'gurgeet@gmail.com', '9911111111', 3, 1, '2020-04-13 19:33:16');

-- --------------------------------------------------------

--
-- Table structure for table `login_user`
--

CREATE TABLE `login_user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `status` int(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_user`
--

INSERT INTO `login_user` (`id`, `user_name`, `password`, `email_id`, `status`, `code`) VALUES
(1, 'admin', 'Callmama@123', 'furqan@mycountrymobile.com', 0, 'fdc372f3aca4cbfe55f285418ae751d4');

-- --------------------------------------------------------

--
-- Table structure for table `receive_data`
--

CREATE TABLE `receive_data` (
  `id` int(11) NOT NULL,
  `source` varchar(255) DEFAULT NULL,
  `dest` varchar(255) DEFAULT NULL,
  `message` longtext,
  `receive_time` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receive_data`
--

INSERT INTO `receive_data` (`id`, `source`, `dest`, `message`, `receive_time`, `status`, `user_id`, `created_dt`) VALUES
(3, '15742851428', '19177225031', 'Hi this is testing sms', 'Thu, 09 Apr 2020 14:47:59 GMT', 1, 8, '2020-04-09 07:48:00'),
(4, '15742851428', '19177225031', 'Send Message By automatic by cron job', 'Thu, 09 Apr 2020 14:47:59 GMT', 1, 8, '2020-04-09 07:48:00'),
(5, '15742851428', '19177225031', 'Hi this is testing sms', 'Thu, 09 Apr 2020 14:47:59 GMT', 1, 8, '2020-04-09 07:48:00'),
(6, '15742851428', '19177225031', 'Send Message By automatic by cron job', 'Thu, 09 Apr 2020 14:47:59 GMT', 1, 8, '2020-04-09 07:48:00'),
(7, '15742851428', '19177225031', 'Hi this is testing sms', 'Thu, 09 Apr 2020 14:47:59 GMT', 1, 8, '2020-04-09 07:48:00'),
(8, '15742851428', '19177225031', 'Send Message By automatic by cron job', 'Thu, 09 Apr 2020 14:47:59 GMT', 1, 8, '2020-04-09 07:48:00'),
(9, '15742851428', '19177225031', 'Hi this is testing sms', 'Thu, 09 Apr 2020 14:47:59 GMT', 1, 8, '2020-04-09 07:48:00'),
(10, '15742851428', '19177225031', 'Send Message By automatic by cron job', 'Thu, 09 Apr 2020 14:47:59 GMT', 1, 8, '2020-04-09 07:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `product` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `customer_id`, `product`, `amount`, `currency`, `status`, `created_at`) VALUES
('ch_1GXQzbGxXnaw8WREUjlpa2AZ', 'cus_H5cE4o4L985u2U', 'Intro To React Course', '5000', 'inr', 'succeeded', '2020-04-13 05:02:23'),
('ch_1GXR9hGxXnaw8WREygZyjdka', 'cus_H5cOaiPGMza96h', 'Intro To React Course', '5000', 'inr', 'succeeded', '2020-04-13 05:12:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `didww_user`
--
ALTER TABLE `didww_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `login_user`
--
ALTER TABLE `login_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receive_data`
--
ALTER TABLE `receive_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `didww_user`
--
ALTER TABLE `didww_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `login_user`
--
ALTER TABLE `login_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `receive_data`
--
ALTER TABLE `receive_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
