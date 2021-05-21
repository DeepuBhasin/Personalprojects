-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2021 at 04:24 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classes_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `emailidf` varchar(255) NOT NULL,
  `emailids` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admintype` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `lastlogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `lname`, `emailidf`, `emailids`, `password`, `admintype`, `status`, `lastlogin`) VALUES
(1, 'mayuri', 'thakre', 'mayuri@cgsinfotech.com', '', 'password', 0, 0, '2020-12-14 10:23:22'),
(3, 'pallavi p', 'Patole', 'patolepallavi27@gmail.com', 'pallavi@cgscorporate.com', '123456', 1, 1, '2020-12-15 04:33:41'),
(5, 'Krutika', 'Parekh', 'krutika@cyberwebhotels.com', 'test@gmail.com', '123456', 1, 1, '2020-12-15 04:53:26'),
(8, 'Priyanka', 'Kadam', 'priyanka.kadam@cgscorporate.com', '', '123456', 2, 0, '2020-12-16 08:10:39'),
(10, 'Mayuri', 'Thakre', 'marry@cyberwebhotels.com', 'marry1@cyberwebhotels.com', '123456', 1, 1, '2020-12-21 08:39:33'),
(12, 'Deepinder', 'Singh', 'adminknst@gmail.com', 'Deepinder000@gmail.com', 'password', 1, 1, '2021-01-10 01:48:31');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `cid` int(11) NOT NULL,
  `cfname` varchar(255) NOT NULL,
  `clname` varchar(255) NOT NULL,
  `cemailf` varchar(255) NOT NULL,
  `cemails` varchar(255) NOT NULL,
  `cemailt` varchar(255) NOT NULL,
  `cphone` varchar(255) NOT NULL,
  `cmob` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `cpassword` varchar(255) NOT NULL,
  `cstreetaddress` varchar(255) NOT NULL,
  `ccity` varchar(255) NOT NULL,
  `cstate` varchar(255) NOT NULL,
  `ccountry` varchar(255) NOT NULL,
  `accountmanager` varchar(255) NOT NULL,
  `revenuemanager` varchar(255) NOT NULL,
  `supportrevenuemanager` varchar(255) NOT NULL,
  `smomanager` varchar(255) NOT NULL,
  `supportsmomanager` varchar(255) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`cid`, `cfname`, `clname`, `cemailf`, `cemails`, `cemailt`, `cphone`, `cmob`, `currency`, `cpassword`, `cstreetaddress`, `ccity`, `cstate`, `ccountry`, `accountmanager`, `revenuemanager`, `supportrevenuemanager`, `smomanager`, `supportsmomanager`, `status`) VALUES
(3, 'pallavi', 'patole', 'pallavipatole2@gmail.com', 'pallavi27@gmail.com', 'priyu@gmail.com', '7083921401', '8308025253', 'AED', '123456', '144 Merchants Drive, Knoxville, Tennessee 37912, US', 'tets', 'maharashtra', 'india', '5', '10', '3', '5', '10', '1'),
(4, 'mayuri', 'thakrre', 'mayuri@gmail.com', 'test@gmail.com', 'test2@gmail.com', '7083921401', '7083921401', 'AED', '123', '144 Merchants Drive, Knoxville, Tennessee 37912, US', 'tets', 'test', 'Austria', '10', '5', '5', '3', '5', '1');

-- --------------------------------------------------------

--
-- Table structure for table `hoteldata`
--

CREATE TABLE `hoteldata` (
  `id` int(11) NOT NULL,
  `rangedate` datetime DEFAULT NULL,
  `inventory` varchar(255) DEFAULT NULL,
  `current_standard_room_rate` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `rcomended_rate_by_cyberwe` varchar(255) DEFAULT NULL,
  `neay_by_event` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email1` varchar(50) NOT NULL,
  `email2` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `fname`, `lname`, `email1`, `email2`, `username`, `password`) VALUES
(1, 'hello', 'hsjd', 'gjhd', 'hgjsd', 'hdjshk', 'ahsgdy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `hoteldata`
--
ALTER TABLE `hoteldata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `hoteldata`
--
ALTER TABLE `hoteldata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
