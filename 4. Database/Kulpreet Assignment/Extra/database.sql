-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2020 at 08:49 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `a_id` char(4) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`a_id`, `fname`, `lname`) VALUES
('a1', 'PARAG', 'PARIKH'),
('a2', 'Arthur', 'Miller'),
('a3', 'Ernest', 'Hemingway'),
('a4', 'Margaret', 'Mitchell'),
('a5', 'John', 'Steinbeck'),
('a6', 'F. Scott', 'Fitzgerald'),
('a7', 'Harper', 'Lee'),
('a8', 'Jeff', 'Smith');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `isbn` char(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `btype` varchar(15) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `pub_date` datetime NOT NULL,
  `p_id` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`isbn`, `title`, `btype`, `price`, `pub_date`, `p_id`) VALUES
('0142000671', 'Of Mice and Men', 'Story', '20.05', '2020-01-02 00:00:00', 'p2'),
('0142000777', 'STOCKS TO RICHES ', 'Textbook', '10.90', '2018-11-09 00:00:00', 'p5'),
('0213432112', 'Fundamentals of Database Systems', 'Textbook', '2.60', '2019-09-25 00:00:00', 'p7'),
('0446675539', 'Gone with the Wind', 'Novel', '41.83', '1999-04-01 00:00:00', 'p3'),
('067001690X', 'The Grapes of Wrath', 'Novel', '22.90', '2002-01-08 00:00:00', 'p3'),
('562441756', 'The Great Gatsby', 'Novel', '86.60', '2014-09-10 00:00:00', 'p3'),
('848518451', 'THE GREAT GATSBY', 'Noval', '42.60', '2001-12-11 00:00:00', 'p6'),
('8754954474', 'To Kill a Mockingbird', 'Dramatic', '45.60', '2006-06-23 00:00:00', 'p1');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` char(9) NOT NULL,
  `c_name` varchar(20) NOT NULL,
  `c_address` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `c_name`, `c_address`) VALUES
('c1', 'Alice Kay', '22751 El Prado #1108\nRancho Santa Margarita, California(CA), 92688'),
('c2', 'Harry', '306 Church St\nBroxton, Georgia(GA), 31519'),
('c3', 'George', '250 E Water St\nSlippery Rock, Pennsylvania(PA), 16057'),
('c4', 'Noah', '4101 Amy Ct\nHigh Ridge, Missouri(MO), 63049'),
('c5', 'Jack', '23 Shore Dr\nCuddebackville, New York(NY), 12729');

-- --------------------------------------------------------

--
-- Table structure for table `edited_by`
--

CREATE TABLE `edited_by` (
  `id` int(11) NOT NULL,
  `eid` char(4) NOT NULL,
  `isbn` char(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `edited_by`
--

INSERT INTO `edited_by` (`id`, `eid`, `isbn`) VALUES
(1, 'e7', '0213432112'),
(2, 'e7', '8754954474'),
(3, 'e4', '562441756'),
(4, 'e4', '067001690X'),
(5, 'e3', '0446675539'),
(6, 'e5', '0213432112'),
(7, 'e2', '0142000777'),
(8, 'e1', '0142000671');

-- --------------------------------------------------------

--
-- Table structure for table `editor`
--

CREATE TABLE `editor` (
  `eid` char(4) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `editor`
--

INSERT INTO `editor` (`eid`, `fname`, `lname`) VALUES
('e1', 'John', 'Steinbeck'),
('e2', 'Parag', 'Parikh'),
('e3', 'John', 'Marsh'),
('e4', 'Robert', 'DeMott'),
('e5', 'F. Scott', 'Fitzgerald'),
('e6', 'Tay', 'Hohoff'),
('e7', 'Johannes', 'Gehrke');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` char(9) NOT NULL,
  `order_date` datetime NOT NULL,
  `c_id` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `order_date`, `c_id`) VALUES
('o1', '2020-05-04 06:12:21', 'c1'),
('o10', '2002-05-04 07:46:15', 'c4'),
('o11', '2001-04-17 18:13:00', 'c5'),
('o2', '2019-11-13 14:11:41', 'c5'),
('o3', '2020-01-27 19:11:42', 'c2'),
('o4', '2020-12-08 06:34:35', 'c4'),
('o5', '2020-12-01 07:33:15', 'c3'),
('o6', '2020-04-14 02:33:06', 'c1'),
('o7', '2020-12-16 17:19:42', 'c1'),
('o8', '2019-05-04 06:33:47', 'c2'),
('o9', '2020-04-17 05:36:00', 'c1');

-- --------------------------------------------------------

--
-- Table structure for table `order_book`
--

CREATE TABLE `order_book` (
  `o_id` char(9) NOT NULL,
  `isbn` char(10) DEFAULT NULL,
  `no_of_copy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_book`
--

INSERT INTO `order_book` (`o_id`, `isbn`, `no_of_copy`) VALUES
('o1', '0446675539', 7),
('o10', '0213432112', 2),
('o11', '0213432112', 5),
('o2', '067001690X', 3),
('o3', '562441756', 9),
('o4', '8754954474', 12),
('o5', '0213432112', 11),
('o6', '0142000777', 1),
('o7', '0142000671', 7),
('o8', '0213432112', 2),
('o9', '0213432112', 2);

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `p_id` char(10) NOT NULL,
  `p_name` varchar(30) NOT NULL,
  `p_address` varchar(80) NOT NULL,
  `p_phone` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`p_id`, `p_name`, `p_address`, `p_phone`) VALUES
('p1', 'Harper Perennial', 'USA', '9996664512'),
('p2', 'Scribner ', 'USA', '8880004784'),
('p3', 'Penguin Books ', 'UK', '8524441545'),
('p4', 'Warner Books', 'Atlanta, USA', '4138284821'),
('p5', 'Heinemann Library', 'New York,USA', '6261636264'),
('p6', 'Pearson Education', 'UK', '4148583828'),
('p7', 'McGraw-Hill Education', 'USA', '1020304327');

-- --------------------------------------------------------

--
-- Table structure for table `written_by`
--

CREATE TABLE `written_by` (
  `isbn` char(10) NOT NULL,
  `a_id` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `written_by`
--

INSERT INTO `written_by` (`isbn`, `a_id`) VALUES
('067001690X', 'a1'),
('0142000671', 'a2'),
('0142000777', 'a4'),
('0213432112', 'a3'),
('0446675539', 'a5'),
('0446675539', 'a8'),
('562441756', 'a6'),
('8754954474', 'a7'),
('067001690X', 'a8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`isbn`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `edited_by`
--
ALTER TABLE `edited_by`
  ADD PRIMARY KEY (`id`),
  ADD KEY `isbn` (`isbn`),
  ADD KEY `eid` (`eid`);

--
-- Indexes for table `editor`
--
ALTER TABLE `editor`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `orders_ibfk_1` (`c_id`);

--
-- Indexes for table `order_book`
--
ALTER TABLE `order_book`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `isbn` (`isbn`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `written_by`
--
ALTER TABLE `written_by`
  ADD KEY `isbn` (`isbn`),
  ADD KEY `a_id` (`a_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `edited_by`
--
ALTER TABLE `edited_by`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `publisher` (`p_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`);

--
-- Constraints for table `order_book`
--
ALTER TABLE `order_book`
  ADD CONSTRAINT `order_book_ibfk_1` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`),
  ADD CONSTRAINT `order_book_ibfk_2` FOREIGN KEY (`o_id`) REFERENCES `orders` (`o_id`);

--
-- Constraints for table `written_by`
--
ALTER TABLE `written_by`
  ADD CONSTRAINT `written_by_ibfk_1` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`),
  ADD CONSTRAINT `written_by_ibfk_2` FOREIGN KEY (`a_id`) REFERENCES `author` (`a_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
