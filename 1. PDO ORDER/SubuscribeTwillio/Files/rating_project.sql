-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2021 at 08:22 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rating_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `full_name` varchar(80) NOT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `phone_no` varchar(15) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `age` varchar(50) DEFAULT NULL,
  `marital` varchar(2) DEFAULT NULL,
  `qualification` varchar(2) DEFAULT NULL,
  `profession` varchar(2) DEFAULT NULL,
  `area` varchar(2) DEFAULT NULL,
  `country` varchar(80) DEFAULT NULL,
  `comment` int(11) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `full_name`, `gender`, `phone_no`, `email`, `password`, `age`, `marital`, `qualification`, `profession`, `area`, `country`, `comment`, `type`) VALUES
(1, 'Admin', 'm', '1234567890', 'admin@admin.com', 'admin', '15-30', 'u', 'pg', 'e', 'u', 'india', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_table`
--

CREATE TABLE `customer_table` (
  `customer_id` int(11) NOT NULL,
  `mac_adddress` varchar(150) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `phone_number` varchar(150) NOT NULL,
  `start_sub` date NOT NULL,
  `end_sub` date NOT NULL,
  `sub_type` varchar(10) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_dt` datetime NOT NULL,
  `update_dt` datetime DEFAULT NULL,
  `sms_send_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `error_message`
--

CREATE TABLE `error_message` (
  `id` int(11) NOT NULL,
  `send_to` varchar(150) DEFAULT NULL,
  `customer_name` varchar(150) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `status` varchar(150) DEFAULT NULL,
  `error_reason` varchar(150) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message_table`
--

CREATE TABLE `message_table` (
  `message_id` int(11) NOT NULL,
  `message_text` longtext DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message_table`
--

INSERT INTO `message_table` (`message_id`, `message_text`, `created_dt`) VALUES
(1, 'Dear {{name}} ({{phone}}),\r\nThis is to inform your Subscription is ending soon.', '2021-08-19 11:28:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_table`
--
ALTER TABLE `customer_table`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `error_message`
--
ALTER TABLE `error_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_table`
--
ALTER TABLE `message_table`
  ADD PRIMARY KEY (`message_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `customer_table`
--
ALTER TABLE `customer_table`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `error_message`
--
ALTER TABLE `error_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message_table`
--
ALTER TABLE `message_table`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
