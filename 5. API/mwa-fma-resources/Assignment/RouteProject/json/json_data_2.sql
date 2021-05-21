-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2021 at 03:22 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdodata`
--

-- --------------------------------------------------------

--
-- Table structure for table `json_data_2`
--

CREATE TABLE `json_data_2` (
  `id` int(11) NOT NULL,
  `first_name` varchar(11) DEFAULT NULL,
  `last_name` varchar(10) DEFAULT NULL,
  `age` varchar(4) DEFAULT NULL,
  `occupation` varchar(37) DEFAULT NULL,
  `blue_bedge` varchar(11) DEFAULT NULL,
  `tours` varchar(74) DEFAULT NULL,
  `image` varchar(27) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `json_data_2`
--

INSERT INTO `json_data_2` (`id`, `first_name`, `last_name`, `age`, `occupation`, `blue_bedge`, `tours`, `image`) VALUES
(1, 'Harry ', 'Hobsbawm', '42', 'Professional tour guide', 'Yes ', 'Camden Town, Hampstead Heath, City of London ', 'guide-placeholder-image.png'),
(2, 'Celia ', 'Miller ', '38', 'Historian and part-time tour guide', 'No ', 'Camden Town, Bloomsbury, Hyde Park ', 'guide-placeholder-image.png'),
(3, 'Cynthia ', 'Payne', '50', 'Archivist and part-time tour guide', 'Yes ', 'Notting Hill, Kensington and Chelsea, Regents Park, Fitzrovia ', 'guide-placeholder-image.png'),
(4, 'Ronald ', 'Cray', '43', 'Journalist and part-time tour guide', 'Yes ', 'Soho, Covent Garden, Southbank, City of London, Wapping, Greenwich', 'guide-placeholder-image.png'),
(5, 'Rose ', 'Black', '29', 'Professional tour guide', 'Yes ', 'Southbank, Greenwich', 'guide-placeholder-image.png'),
(6, 'David ', 'Spitz', '29', 'Concierge and part-time tour guide', 'No ', 'Notting Hill, Hyde Park, Westminster, Soho, Covent Garden ', 'guide-placeholder-image.png'),
(7, 'Dawid', 'Singh', '44', 'Professional tour guide', 'Yes ', 'City of London, East End, Bloomsbury, Fitzrovia', 'guide-placeholder-image.png'),
(8, 'Karen ', 'Chang', '32', 'Travel agent and part-time tour guide', 'No ', 'Camden Town, Bloomsbury, Hyde Park, Hamstead Heath', 'guide-placeholder-image.png'),
(9, 'Peter', 'Purkiss', '35', 'Part-time tour guide', 'No ', 'Hoxton, Clerkenwell, City of London', 'guide-placeholder-image.png'),
(10, 'Helena', 'Fuller', '29', 'Part-time tour guide', 'No ', 'Soho, Mayfair, Hyde Park, Regents Park', 'guide-placeholder-image.png'),
(11, 'Stephan', 'Le Clerc', '31', 'Professional tour guide', 'Yes ', 'Notting Hill Kensington and Chelsea,  Hyde Park, Belgravia', 'guide-placeholder-image.png'),
(12, 'Ranu', 'Mukerjee', '39', 'Artis and part-time tour guide', 'No ', 'Hoxton, Clerkenwell', 'guide-placeholder-image.png'),
(13, 'Nancy', 'Perry', '25', 'Student and part-time tour guide', 'No ', 'Hoxton, City of London, Camden Town', 'guide-placeholder-image.png'),
(14, 'Spiros', 'Drake', '34', 'Professional tour guide', 'Yes ', 'Camden Town, Hamstead Heath, Regents Park, Fitzrovia', 'guide-placeholder-image.png'),
(15, 'Fleur', 'Dubois', '56', 'Professional tour guide', 'Yes ', 'Westminster, Southbank, Hyde Park, Regents Park, Soho, Fitzrovia, Mayfair ', 'guide-placeholder-image.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `json_data_2`
--
ALTER TABLE `json_data_2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `json_data_2`
--
ALTER TABLE `json_data_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
