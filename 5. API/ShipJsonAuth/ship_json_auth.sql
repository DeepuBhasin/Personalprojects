-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2021 at 04:12 PM
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
-- Database: `ship_json_auth`
--

-- --------------------------------------------------------

--
-- Table structure for table `ship_json_auth_table`
--

CREATE TABLE `ship_json_auth_table` (
  `id` int(11) NOT NULL,
  `voyageId` int(11) NOT NULL,
  `voyageCod` varchar(50) NOT NULL,
  `suiteCategoryCod` varchar(50) NOT NULL,
  `suiteCategory` varchar(50) NOT NULL,
  `currencyCod` varchar(50) NOT NULL,
  `cruiseOnlyFare` varchar(50) NOT NULL,
  `bundleFare` varchar(50) NOT NULL,
  `earlyBookingBonus` varchar(50) NOT NULL,
  `earlyBookingPerc` varchar(50) NOT NULL,
  `suiteAvailability` varchar(50) NOT NULL,
  `singleSupplementPerc` varchar(50) NOT NULL,
  `hasLoyaltySaving` varchar(50) NOT NULL,
  `loyaltySaving` varchar(50) NOT NULL,
  `airPrices` varchar(50) NOT NULL,
  `price_voyageId` varchar(50) NOT NULL,
  `fare` varchar(50) NOT NULL,
  `promoID` varchar(50) NOT NULL,
  `promoDesc` varchar(255) NOT NULL,
  `validityDateFrom` varchar(255) NOT NULL,
  `validityDateTo` varchar(255) NOT NULL,
  `isManual` varchar(50) NOT NULL,
  `coFlag` varchar(50) NOT NULL,
  `asFlag` varchar(50) NOT NULL,
  `productCod` varchar(50) NOT NULL,
  `itemCod` varchar(50) NOT NULL,
  `itemDesc` varchar(150) NOT NULL,
  `itemPrice` varchar(50) NOT NULL,
  `firstPaxOnlyFlag` varchar(50) NOT NULL,
  `firstAndSecondPaxFlag` varchar(50) NOT NULL,
  `thirdAndFourthPaxFlag` varchar(50) NOT NULL,
  `groupCod` varchar(50) NOT NULL,
  `promoType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ship_json_auth_table`
--
ALTER TABLE `ship_json_auth_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ship_json_auth_table`
--
ALTER TABLE `ship_json_auth_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
