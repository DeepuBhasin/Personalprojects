-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2022 at 07:40 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_history`
--

CREATE TABLE `customer_history` (
  `id` int(11) NOT NULL,
  `explanation` varchar(150) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `created_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_history`
--

INSERT INTO `customer_history` (`id`, `explanation`, `customer_id`, `customer_email`, `created_dt`) VALUES
(1, 'Patient Insert Successfully Successfully', 1, 'sd@side.com', '2022-05-03 23:04:40'),
(2, 'Patient Update Successfully', 1, 'deepinder999@gmail.com', '2022-05-03 23:05:27'),
(3, 'Patient Insert Successfully Successfully', 2, 'okokok@gmail.com', '2022-05-03 23:06:06'),
(4, 'Patient Delete Successfully', 2, 'okokok@gmail.com', '2022-05-03 23:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(3) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `age`, `email`, `phone_number`) VALUES
(1, 'Deepinder Singh', 29, 'deepinder999@gmail.com', '09915099247');

--
-- Triggers `patient`
--
DELIMITER $$
CREATE TRIGGER `tr_afterDeleteCustomer` AFTER DELETE ON `patient` FOR EACH ROW BEGIN
DECLARE tr_customer_id int;
DECLARE tr_customer_email varchar(255);
SET tr_customer_id=old.id;
SET tr_customer_email=old.email;
INSERT INTO customer_history(explanation,customer_id,customer_email,created_dt) VALUES('Patient Delete Successfully',tr_customer_id,tr_customer_email,CURRENT_TIMESTAMP());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_afterInsertCustomer` AFTER INSERT ON `patient` FOR EACH ROW BEGIN
DECLARE tr_customer_id int;
DECLARE tr_customer_email varchar(255);
SET tr_customer_id=new.id;
SET tr_customer_email=new.email;
INSERT INTO customer_history(explanation,customer_id,customer_email,created_dt) VALUES('Patient Insert Successfully Successfully',tr_customer_id,tr_customer_email,CURRENT_TIMESTAMP());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_afterUpdateCustomer` AFTER UPDATE ON `patient` FOR EACH ROW BEGIN
DECLARE tr_customer_id int;
DECLARE tr_customer_email varchar(255);
SET tr_customer_id=new.id;
SET tr_customer_email=new.email;
INSERT INTO customer_history(explanation,customer_id,customer_email,created_dt) VALUES('Patient Update Successfully',tr_customer_id,tr_customer_email,CURRENT_TIMESTAMP());
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_history`
--
ALTER TABLE `customer_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_history`
--
ALTER TABLE `customer_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
