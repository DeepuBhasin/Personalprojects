-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2021 at 09:46 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_table`
--

CREATE TABLE `booking_table` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `receptionist_id` int(11) NOT NULL,
  `number_of_person` int(11) NOT NULL,
  `checkin_date` datetime NOT NULL,
  `checkout_date` datetime NOT NULL,
  `room_id` int(11) NOT NULL,
  `covid_test_report` varchar(255) NOT NULL,
  `test_date_time` datetime NOT NULL,
  `doctor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_table`
--

INSERT INTO `booking_table` (`id`, `customer_id`, `receptionist_id`, `number_of_person`, `checkin_date`, `checkout_date`, `room_id`, `covid_test_report`, `test_date_time`, `doctor_id`) VALUES
(1, 1, 1, 2, '2021-05-01 04:00:00', '2021-05-03 10:00:00', 5, 'Negative', '2021-05-04 00:00:00', 1),
(2, 2, 4, 1, '2021-05-06 08:00:00', '2021-05-20 10:00:00', 17, 'Positive', '2021-05-08 09:00:00', 3),
(3, 3, 3, 1, '2021-05-07 04:00:00', '2021-05-18 10:00:00', 18, 'Positive', '2021-05-08 00:00:00', 1),
(4, 4, 2, 1, '2021-05-17 06:26:07', '2021-05-31 10:00:00', 21, 'Positive', '2021-05-18 10:13:28', 4),
(5, 5, 1, 4, '2021-05-17 12:09:45', '2021-05-30 10:00:00', 14, 'Negative', '2021-05-17 00:00:00', 3),
(6, 6, 2, 1, '2021-05-13 11:13:17', '2021-05-15 10:00:00', 13, 'Negative', '2021-05-13 10:00:00', 2),
(7, 7, 3, 2, '2021-05-14 11:08:13', '2021-05-17 10:10:00', 12, 'Negative', '2021-05-13 07:31:20', 3),
(8, 8, 1, 4, '2021-05-03 08:19:33', '2021-05-21 10:00:00', 23, 'Negative', '2021-05-03 00:00:00', 5),
(9, 9, 4, 2, '2021-05-11 12:00:00', '2021-05-08 10:00:00', 13, 'Negative', '2021-05-05 00:00:00', 1),
(10, 10, 2, 8, '2021-05-03 08:22:00', '2021-05-22 10:00:00', 25, 'Negative', '2021-05-03 03:00:00', 3),
(11, 11, 1, 2, '2021-06-13 11:13:17', '2021-07-15 10:00:00', 11, 'Negative', '2021-06-13 10:00:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `customer_table`
--

CREATE TABLE `customer_table` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_table`
--

INSERT INTO `customer_table` (`id`, `name`, `email`, `phone_number`, `address`) VALUES
(1, 'Wilson', 'Wilson@gmail.com', '0417596288', 'Mansfield, , Victoria, Victoria 3723'),
(2, 'Candy', 'Candy@gmail.com', '0419541439', 'Pakenham, Victoria, WARRAGUL, Victoria 3810'),
(3, 'Raspal', 'Raspal@gmail.com', '0458492045', 'BORONIA, Victoria, MELBOURNE, Victoria 3155'),
(4, 'Hansen', 'hansen@gmail.com', '0404189376', 'Berwick, VIC, BERWICK, Victoria 3806'),
(5, 'Chalmers', 'Chalmers@gmail.com', '0425137375', 'Ringwood, Vic, RINGWOOD NORTH, Victoria 3134'),
(6, 'Kirstin', 'Kirstin@gmail.com', '(03) 9084 7455', 'Ringwood, VIC, Ringwood, Victoria 3134'),
(7, 'Acciarito', 'Acciarito@gmail.com', '0405123068', 'Wantirna, VIC, Victoria 3152'),
(8, 'Janice Riley', 'JaniceRiley@gmail.com', '0413200499', 'Eltham, Victoria 3095'),
(9, 'Maxwell', 'Maxwell@gmail.com', '0456 033 200', 'DONCASTER EAST, Victoria 3095'),
(10, 'Kate', 'Kate@gmail.com', '03 9890 1062', 'Box Hill South, Victoria, BOX HILL SOUTH, Victoria 3128'),
(11, 'Melinda Millar', 'MelindaMillar@gmail.com', '03 9898 0222', 'Surrey Hills, Victoria, Victoria 3104');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_table`
--

CREATE TABLE `doctor_table` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_table`
--

INSERT INTO `doctor_table` (`id`, `name`, `email`, `phone_number`, `address`) VALUES
(1, 'Dr Jennifer', 'Jennifer@gmail.com', '1300 856 168', 'Carlton North, VIC, CARLTON NORTH, Victoria 3054'),
(2, 'Dr Viraj', 'DrViraj@gmail.com', '1300 874 325', 'Rouse Hill , NSW, BELLA VISTA, New South Wales 2155'),
(3, 'Dr  J Arachchi', 'Arachchi@gmail.com', '0383 917 020', 'Hoppers Crossing, Victoira, Victoria 3029'),
(4, 'Dr Kemble ', 'KembleWang@gmail.com', '03 9928 6968', 'East Melbourne, Vic, Victoria 3002'),
(5, 'Dr Christine', 'Christine@gmail.com', '0492 867 653', 'Gympie , Qld, GYMPIE, Queensland 4570');

-- --------------------------------------------------------

--
-- Table structure for table `receptionist_table`
--

CREATE TABLE `receptionist_table` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `salary` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receptionist_table`
--

INSERT INTO `receptionist_table` (`id`, `name`, `email`, `phone_number`, `address`, `salary`) VALUES
(1, 'Ms Naomi', 'Naomi@gmail.com', '(03) 9466-1160', 'Lalor, Victoria, LALOR, Victoria 3075', 10000),
(2, 'Edwards-Hart', 'EdwardsHart@gmail.com', '03 9005 5425', 'Kew, Victoria 3101', 11000),
(3, 'Brozovic', 'Brozovic@gmail.com', '0474 249 463', 'Kew, Victoria, Kew, Victoria', 11000),
(4, 'Melanie', 'Melanie@gmail.com', '0490166977', 'Hawthorn East, Victoria, HAWTHORN EAST, Victoria 3122', 11000);

-- --------------------------------------------------------

--
-- Table structure for table `room_table`
--

CREATE TABLE `room_table` (
  `id` int(11) NOT NULL,
  `room_no` int(11) NOT NULL,
  `type_of_booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_table`
--

INSERT INTO `room_table` (`id`, `room_no`, `type_of_booking_id`) VALUES
(1, 101, 1),
(2, 102, 1),
(3, 103, 1),
(4, 104, 1),
(5, 201, 2),
(6, 202, 2),
(7, 203, 2),
(8, 204, 2),
(9, 301, 3),
(10, 302, 3),
(11, 401, 4),
(12, 402, 4),
(13, 501, 5),
(14, 502, 5),
(15, 503, 5),
(16, 504, 5),
(17, 601, 6),
(18, 602, 6),
(19, 603, 6),
(20, 604, 6),
(21, 605, 6),
(22, 606, 6),
(23, 701, 7),
(24, 702, 7),
(25, 703, 7),
(26, 704, 7);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_table`
--

CREATE TABLE `transaction_table` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `total_amount` float NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_table`
--

INSERT INTO `transaction_table` (`id`, `booking_id`, `transaction_date`, `total_amount`, `description`) VALUES
(1, 1, '2021-05-01 00:00:00', 2566, 'Booking of room'),
(2, 1, '2021-05-01 00:00:00', 500, 'Evening meal'),
(3, 1, '2021-05-02 00:00:00', 524, 'Morning meal and cup of coffee'),
(4, 1, '2021-05-03 00:00:00', 200, 'checkout fees'),
(5, 2, '2021-05-06 00:00:00', 4324, 'lunch meal with tea'),
(6, 2, '2021-05-07 00:00:00', 400, 'steam bath and cleaning of room'),
(7, 3, '2021-05-07 00:00:00', 4104, 'lunch and cleaning of room'),
(8, 3, '2021-05-08 00:00:00', 500, 'evening meal'),
(9, 3, '2021-05-10 00:00:00', 854, 'morning meal'),
(10, 3, '2021-05-11 00:00:00', 410, 'Dinner and juice'),
(11, 4, '2021-05-17 00:00:00', 4512, 'booking of room and evening meal'),
(12, 4, '2021-05-19 00:00:00', 854, 'Dinner and juice'),
(13, 5, '2021-05-17 00:00:00', 4527, 'Booking of room and get dulex meal of lunch '),
(14, 5, '2021-05-18 00:00:00', 451, 'breakfast and coffee cup'),
(15, 6, '2021-05-13 00:00:00', 4785, 'booking and lunch meal'),
(16, 6, '2021-05-14 00:00:00', 741, 'morning meal'),
(17, 7, '2021-05-14 00:00:00', 7451, 'evening meal and booking of room'),
(18, 7, '2021-05-16 00:00:00', 410, 'morning meal'),
(19, 8, '2021-05-08 00:00:00', 4128, 'booking of room and night meal'),
(20, 8, '2021-05-09 00:00:00', 400, 'morning meal'),
(21, 9, '2021-05-03 00:00:00', 7451, 'evening meal and booking of room'),
(22, 9, '2021-05-05 00:00:00', 410, 'morning meal'),
(23, 10, '2021-05-03 00:00:00', 4128, 'booking of room and night meal'),
(24, 11, '2021-05-13 00:00:00', 400, 'morning meal');

-- --------------------------------------------------------

--
-- Table structure for table `type_of_booking`
--

CREATE TABLE `type_of_booking` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_of_booking`
--

INSERT INTO `type_of_booking` (`id`, `name`) VALUES
(1, 'Single bed'),
(2, 'Double bed'),
(3, 'Rest Room'),
(4, 'Twin Bed Room'),
(5, 'President Suite'),
(6, 'Covid Room'),
(7, 'Executive Suite');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_table`
--
ALTER TABLE `booking_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_customer` (`customer_id`),
  ADD KEY `fk_receptionist` (`receptionist_id`),
  ADD KEY `fk_room` (`room_id`),
  ADD KEY `fk_doctor` (`doctor_id`);

--
-- Indexes for table `customer_table`
--
ALTER TABLE `customer_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_table`
--
ALTER TABLE `doctor_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receptionist_table`
--
ALTER TABLE `receptionist_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_table`
--
ALTER TABLE `room_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_type_of_booking_id` (`type_of_booking_id`);

--
-- Indexes for table `transaction_table`
--
ALTER TABLE `transaction_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_booking_id` (`booking_id`);

--
-- Indexes for table `type_of_booking`
--
ALTER TABLE `type_of_booking`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_table`
--
ALTER TABLE `booking_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `customer_table`
--
ALTER TABLE `customer_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `doctor_table`
--
ALTER TABLE `doctor_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `receptionist_table`
--
ALTER TABLE `receptionist_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `room_table`
--
ALTER TABLE `room_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `transaction_table`
--
ALTER TABLE `transaction_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `type_of_booking`
--
ALTER TABLE `type_of_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_table`
--
ALTER TABLE `booking_table`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer_table` (`id`),
  ADD CONSTRAINT `fk_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctor_table` (`id`),
  ADD CONSTRAINT `fk_receptionist` FOREIGN KEY (`receptionist_id`) REFERENCES `receptionist_table` (`id`),
  ADD CONSTRAINT `fk_room` FOREIGN KEY (`room_id`) REFERENCES `room_table` (`id`);

--
-- Constraints for table `room_table`
--
ALTER TABLE `room_table`
  ADD CONSTRAINT `fk_type_of_booking_id` FOREIGN KEY (`type_of_booking_id`) REFERENCES `type_of_booking` (`id`);

--
-- Constraints for table `transaction_table`
--
ALTER TABLE `transaction_table`
  ADD CONSTRAINT `fk_booking_id` FOREIGN KEY (`booking_id`) REFERENCES `booking_table` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
