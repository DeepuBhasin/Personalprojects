-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 28, 2020 at 07:38 AM
-- Server version: 5.6.49
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ishawebh_rmspanel`
--
CREATE DATABASE IF NOT EXISTS `ishawebh_rmspanel` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ishawebh_rmspanel`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `emailidf` varchar(255) NOT NULL,
  `emailids` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admintype` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `lastlogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `lname`, `emailidf`, `emailids`, `password`, `admintype`, `status`, `lastlogin`) VALUES
(1, 'mayuri', 'thakre', 'mayuri@cgsinfotech.com', '', 'password', 0, 0, '2020-12-14 10:23:22'),
(3, 'pallavi p', 'Patole', 'patolepallavi27@gmail.com', 'pallavi@cgscorporate.com', '123456', 1, 1, '2020-12-15 04:33:41'),
(5, 'Krutika', 'Parekh', 'krutika@cyberwebhotels.com', 'test@gmail.com', '123456', 1, 1, '2020-12-15 04:53:26'),
(8, 'Priyanka', 'Kadam', 'priyanka.kadam@cgscorporate.com', '', '123456', 2, 0, '2020-12-16 08:10:39'),
(10, 'Mayuri', 'Thakre', 'marry@cyberwebhotels.com', 'marry1@cyberwebhotels.com', '123456', 1, 1, '2020-12-21 08:39:33');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` varchar(11) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`cid`, `cfname`, `clname`, `cemailf`, `cemails`, `cemailt`, `cphone`, `cmob`, `currency`, `cpassword`, `cstreetaddress`, `ccity`, `cstate`, `ccountry`, `accountmanager`, `revenuemanager`, `supportrevenuemanager`, `smomanager`, `supportsmomanager`, `status`) VALUES
(3, 'pallavi', 'patole', 'pallavipatole2@gmail.com', 'pallavi27@gmail.com', 'priyu@gmail.com', '7083921401', '8308025253', 'AED', '123456', '144 Merchants Drive, Knoxville, Tennessee 37912, US', 'tets', 'maharashtra', 'india', '5', '10', '3', '5', '10', '1'),
(4, 'mayuri', 'thakrre', 'mayuri@gmail.com', 'test@gmail.com', 'test2@gmail.com', '7083921401', '7083921401', 'AED', '123', '144 Merchants Drive, Knoxville, Tennessee 37912, US', 'tets', 'test', 'Austria', '10', '5', '5', '3', '5', '1');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email1` varchar(50) NOT NULL,
  `email2` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `fname`, `lname`, `email1`, `email2`, `username`, `password`) VALUES
(1, 'hello', 'hsjd', 'gjhd', 'hgjsd', 'hdjshk', 'ahsgdy');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
