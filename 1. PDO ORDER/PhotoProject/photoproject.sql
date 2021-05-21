-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2021 at 08:19 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photoproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `imagetemplates`
--

CREATE TABLE `imagetemplates` (
  `id` int(11) NOT NULL,
  `nameImage` varchar(200) NOT NULL,
  `headerName` varchar(200) NOT NULL,
  `imageWidth` float NOT NULL,
  `imageHeight` float NOT NULL,
  `imageX` float NOT NULL,
  `imageY` float NOT NULL,
  `dearX` float NOT NULL,
  `dearY` float NOT NULL,
  `fromX` float NOT NULL,
  `fromY` float NOT NULL,
  `classX` float NOT NULL,
  `classY` float NOT NULL,
  `cityX` float NOT NULL,
  `cityY` float NOT NULL,
  `mobileX` float DEFAULT NULL,
  `mobileY` float DEFAULT NULL,
  `dateX` float DEFAULT NULL,
  `dateY` float DEFAULT NULL,
  `cropImage` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imagetemplates`
--

INSERT INTO `imagetemplates` (`id`, `nameImage`, `headerName`, `imageWidth`, `imageHeight`, `imageX`, `imageY`, `dearX`, `dearY`, `fromX`, `fromY`, `classX`, `classY`, `cityX`, `cityY`, `mobileX`, `mobileY`, `dateX`, `dateY`, `cropImage`) VALUES
(1, '1.jpeg', 'Birthday Template', 400, 400, 370, 641, 190, 140, 130, 1155, 130, 1200, 130, 1241, NULL, NULL, NULL, NULL, 0),
(2, '2.jpeg', 'Today Special Request', 300, 300, 300, 695, 300, 180, 260, 650, 0, 0, 0, 0, NULL, NULL, 280, 1110, 1),
(3, '3.jpeg', 'Happy Teacher\'d Day', 520, 620, 220, 340, 250, 100, 650, 1040, 670, 1075, 670, 1115, NULL, NULL, NULL, NULL, 1),
(4, '4.jpeg', 'Birthday Template 2', 585, 645, 50, 50, 350, 820, 150, 1165, 150, 1205, 150, 1246, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `studendetails`
--

CREATE TABLE `studendetails` (
  `studentId` int(11) NOT NULL,
  `studentName` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studendetails`
--

INSERT INTO `studendetails` (`studentId`, `studentName`) VALUES
(1, 'pavandeep Singh'),
(2, 'Simdeep kaur'),
(3, 'navdeep Singh');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `teacherId` int(11) NOT NULL,
  `teacherName` varchar(50) NOT NULL,
  `teacherClass` varchar(50) NOT NULL,
  `teacherMobile` varchar(15) NOT NULL,
  `teacherCity` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`teacherId`, `teacherName`, `teacherClass`, `teacherMobile`, `teacherCity`) VALUES
(1, 'DeepinderSingh', 'Class A', '9915099247', 'Patiala'),
(2, 'Simranjeet Kaur', 'Class B', '9191919191', 'patiala');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `imagetemplates`
--
ALTER TABLE `imagetemplates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studendetails`
--
ALTER TABLE `studendetails`
  ADD PRIMARY KEY (`studentId`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`teacherId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `imagetemplates`
--
ALTER TABLE `imagetemplates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `studendetails`
--
ALTER TABLE `studendetails`
  MODIFY `studentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `teacherId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
