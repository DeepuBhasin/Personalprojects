-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2021 at 04:47 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fayda`
--

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `codeDate` datetime DEFAULT NULL,
  `code_date_create` datetime NOT NULL,
  `period` varchar(10) NOT NULL,
  `avail` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `codeDate`, `code_date_create`, `period`, `avail`) VALUES
(1, 'ENF7FDO8', '2021-11-30 00:00:00', '2021-11-22 00:00:00', '2', '1'),
(2, 'EMXSL3Y6', '2021-11-30 00:00:00', '2021-11-22 00:00:00', '2', '1'),
(3, 'Z1T4IMQS', '2021-11-30 00:00:00', '2021-11-22 00:00:00', '2', '1'),
(4, 'SG4U113B', '2021-11-30 00:00:00', '2021-11-22 00:00:00', '2', '1'),
(5, 'OGNGJSMM', '2021-11-30 00:00:00', '2021-11-22 00:00:00', '2', '1'),
(6, 'VJI24HKR', '2021-11-30 00:00:00', '2021-11-22 00:00:00', '2', '1'),
(7, 'BS2JTNBS', '2021-11-30 00:00:00', '2021-11-22 00:00:00', '2', '1'),
(8, 'M3VMO85H', '2021-12-01 00:00:00', '2021-11-23 00:00:00', '3', '1'),
(9, '1N0N7OL2', '2021-12-01 00:00:00', '2021-11-23 00:00:00', '3', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `login_type` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `token`, `created_at`, `login_type`, `password`) VALUES
(1, 'zakblack', 'admin@fayda.io', NULL, '0000-00-00 00:00:00', NULL, '5bbecf046327a6d9a4306bf5501727ee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
