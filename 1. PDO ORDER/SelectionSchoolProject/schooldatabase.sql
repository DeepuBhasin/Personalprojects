-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2021 at 12:07 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schooldatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `class_table`
--

CREATE TABLE `class_table` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `class_limit` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_table`
--

INSERT INTO `class_table` (`class_id`, `class_name`, `class_limit`) VALUES
(1, 'Class - 1', 2),
(2, 'Class - 2', 2),
(3, 'Class - 3', 5),
(4, 'Class - 4', 10);

-- --------------------------------------------------------

--
-- Table structure for table `section_table`
--

CREATE TABLE `section_table` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(50) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section_table`
--

INSERT INTO `section_table` (`section_id`, `section_name`, `class_id`) VALUES
(1, 'Section - A', 1),
(2, 'Section - B', 1),
(3, 'Section - C', 1),
(4, 'Section - D', 1),
(5, 'Section - 1', 2),
(6, 'Section - 2', 2),
(7, 'Section - 3', 2),
(8, 'Section - 4', 2),
(9, 'Section - I', 3),
(10, 'Section - II', 3),
(11, 'Section - III', 3),
(12, 'Section - IV', 3);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_table`
--

CREATE TABLE `teacher_table` (
  `teacher_id` int(11) NOT NULL,
  `teacher_name` varchar(50) NOT NULL,
  `section_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_table`
--

INSERT INTO `teacher_table` (`teacher_id`, `teacher_name`, `section_id`, `class_id`, `status`) VALUES
(1, 'Deepinder Singh', 1, 1, NULL),
(2, 'Sanjanna', 2, 1, NULL),
(3, 'Simranjeet Kaur', 3, 1, NULL),
(4, '1 teacher - section 1 - class 3', 9, 3, 'pending'),
(5, '2 teacher - section 1 - class 3', 9, 3, 'pending'),
(6, '3 teacher - section 1 - class 3', 9, 3, 'pending'),
(7, '4 teacher - section 1 - class 3', 9, 3, 'pending'),
(8, '5 teacher - section 1 - class 3', 9, 3, 'pending'),
(9, '6 teacher - section 1 - class 3', 9, 3, 'pending'),
(10, '7 teacher - section 1 - class 3', 9, 3, 'pending'),
(11, '8 teacher - section 1 - class 3', 9, 3, 'pending'),
(12, '9 teacher - section 1 - class 3', 9, 3, 'pending'),
(13, '10 teacher - section 1 - class 3', 9, 3, 'pending'),
(14, '11 teacher - section 1 - class 3', 9, 3, 'pending'),
(15, '12 teacher - section 1 - class 3', 9, 3, 'pending'),
(16, '13 teacher - section 1 - class 3', 9, 3, 'pending'),
(17, '14 teacher - section 1 - class 3', 9, 3, 'pending'),
(18, '15 teacher - section 1 - class 3', 9, 3, 'pending'),
(19, '16 teacher - section 1 - class 3', 9, 3, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class_table`
--
ALTER TABLE `class_table`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `section_table`
--
ALTER TABLE `section_table`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `teacher_table`
--
ALTER TABLE `teacher_table`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class_table`
--
ALTER TABLE `class_table`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `section_table`
--
ALTER TABLE `section_table`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `teacher_table`
--
ALTER TABLE `teacher_table`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
