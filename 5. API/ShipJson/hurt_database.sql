-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2021 at 07:45 PM
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
-- Database: `hurt_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `hurtigruten`
--

CREATE TABLE `hurtigruten` (
  `id` int(11) NOT NULL,
  `master_id` int(11) NOT NULL,
  `package_id` varchar(150) DEFAULT NULL,
  `pax` varchar(150) NOT NULL,
  `cabin_id` varchar(150) NOT NULL,
  `cabin_description` varchar(150) NOT NULL,
  `cabins_available` varchar(150) DEFAULT NULL,
  `single_price` varchar(150) DEFAULT NULL,
  `double_price` varchar(150) DEFAULT NULL,
  `RateCode` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hurtigruten`
--
ALTER TABLE `hurtigruten`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hurtigruten`
--
ALTER TABLE `hurtigruten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
