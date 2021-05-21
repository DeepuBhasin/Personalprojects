-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2020 at 09:14 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cr_getAllCustomers` ()  BEGIN
DECLARE cr_first_name varchar(45);
DECLARE cr_last_name varchar(45);
DECLARE cr_phone_number varchar(45);
DECLARE v_finished integer DEFAULT 0;
DECLARE c1 CURSOR FOR SELECT c.first_name,c.last_name,c.phone_number FROM customers as c ;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished=1;
OPEN c1;
    get_cust: LOOP
    FETCH c1 INTO cr_first_name,cr_last_name ,cr_phone_number;
    IF v_finished=1 THEN
    	LEAVE get_cust;
    end IF;
    SELECT cr_first_name,cr_last_name,cr_phone_number;
    END LOOP get_cust;
CLOSE c1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_addCustomer` (IN `first_name` VARCHAR(45), IN `last_name` VARCHAR(45), IN `address` VARCHAR(45), IN `state` VARCHAR(45), IN `country` VARCHAR(45), IN `phone_number` VARCHAR(45), IN `email` VARCHAR(45), IN `DOB` DATE)  BEGIN 
INSERT INTO customers (first_name, last_name, address, state, country, phone_number, email, DOB) VALUES (first_name,last_name,address,state,country,phone_number,email,DOB);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_authorName` (IN `autherName` VARCHAR(300))  BEGIN
SELECT * FROM books WHERE book_author=autherName;
End$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_book_publisher` ()  BEGIN
SELECT p.publisher_id,p.publisher_name,b.book_id,b.book_name FROM publisher_has_books as phb INNER JOIN books as b ON phb.book_id=b.book_id INNER JOIN publisher as p ON p.publisher_id=phb.publisher_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_comingDue` ()  BEGIN
SELECT l.loan_id, b.book_name,c.first_name,c.last_name FROM loan as l INNER JOIN customers as c ON c.customer_id=l.customers_customer_id INNER JOIN books as b ON b.book_id=l.books_book_id WHERE DATEDIFF(l.book_due_date,CURRENT_DATE)<=7 and l.is_loan_active=1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_deleteCustomer` (`sp_emialid` VARCHAR(100))  BEGIN
DELETE FROM customers WHERE email=sp_emialid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_dueDate` ()  BEGIN 
SELECT c.* FROM loan as l INNER JOIN customers as c ON l.customers_customer_id=c.customer_id WHERE CURRENT_DATE>l.issue_date and l.return_date IS NULL;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getAllCustomers` ()  BEGIN
SELECT * FROM customers;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getCustomerState` (`sp_state` VARCHAR(45))  BEGIN 
SELECT * FROM customers as c WHERE c.state=sp_state ORDER BY c.first_name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_loan` ()  BEGIN
SELECT b.book_name,c.first_name,c.last_name,c.phone_number,c.email,s.first_name as staff_first_name,s.last_name as staff_last_name,s.phone_number as staff_phone_number,l.issue_date,l.book_due_date,l.return_date FROM loan as l INNER JOIN customers as c ON c.customer_id=l.customers_customer_id INNER JOIN books as b ON b.book_id=l.books_book_id INNER JOIN staff as s ON l.staff_emp_id=s.emp_id ORDER BY l.issue_date ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_publisherBook` (IN `publisher_name` VARCHAR(300))  BEGIN
SELECT b.* FROM publisher_has_books as phb INNER JOIN books as b ON phb.book_id=b.book_id INNER JOIN publisher as p ON p.publisher_id=phb.publisher_id WHERE p.publisher_name=publisher_name ORDER BY b.book_name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_staffLastName` (IN `t_last_name` VARCHAR(45))  BEGIN 
SELECT * FROM staff WHERE last_name Like t_last_name;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(105) DEFAULT NULL,
  `book_author` varchar(45) DEFAULT NULL,
  `cost` decimal(11,0) DEFAULT NULL,
  `year_published` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `book_author`, `cost`, `year_published`) VALUES
(1, 'Abcd', 'Carlos James', '14', 2001),
(2, 'The cosmos', 'Carl Segan', '120', 1998),
(3, 'The book of sience', 'James Vardy', '20', 2015),
(4, 'Xyz', 'Ron Misk', '31', 2010);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `address` varchar(145) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `phone_number` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `DOB` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `address`, `state`, `country`, `phone_number`, `email`, `DOB`) VALUES
(1, 'James', 'Dean ', 'abc, 195th st', 'NY', 'USA', '9481048291', 'james@gmail.com', '2004-01-21'),
(2, 'Steve', 'Finch', '4222, 9th Av', 'NY', 'USA', '5829402949', 'sfinch@gmail.com', '1995-02-13');

--
-- Triggers `customers`
--
DELIMITER $$
CREATE TRIGGER `tr_afterDeletCustomer` AFTER DELETE ON `customers` FOR EACH ROW BEGIN
DECLARE tr_customer_id int;
DECLARE tr_customer_first_name varchar(45);
DECLARE tr_customer_last_name varchar(45);

SET tr_customer_id=old.customer_id;
SET tr_customer_first_name=old.first_name;
SET tr_customer_last_name=old.last_name;

INSERT INTO customer_delete_date(customer_id,customer_first_name,customer_last_name,explanation,created_dt) VALUES(tr_customer_id,tr_customer_first_name,tr_customer_last_name,'A row is Deleted in Customer table',CURRENT_TIMESTAMP());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_afterInsertCustomer` AFTER INSERT ON `customers` FOR EACH ROW BEGIN
DECLARE tr_customer_id int;
SET tr_customer_id=new.customer_id;
INSERT INTO customer_insert_date(explanation,customer_id,created_dt) VALUES('A row is inserted in staff table',tr_customer_id,CURRENT_TIMESTAMP());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_delete_date`
--

CREATE TABLE `customer_delete_date` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_first_name` varchar(50) DEFAULT NULL,
  `customer_last_name` varchar(50) DEFAULT NULL,
  `explanation` varchar(300) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_delete_date`
--

INSERT INTO `customer_delete_date` (`id`, `customer_id`, `customer_first_name`, `customer_last_name`, `explanation`, `created_dt`) VALUES
(2, 9, 'abc', 'bcd', 'A row is Deleted in Customer table', '2020-12-15 14:44:39');

-- --------------------------------------------------------

--
-- Table structure for table `customer_insert_date`
--

CREATE TABLE `customer_insert_date` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `explanation` varchar(200) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `loan_id` int(11) NOT NULL,
  `books_book_id` int(11) NOT NULL,
  `customers_customer_id` int(11) NOT NULL,
  `staff_emp_id` int(11) NOT NULL,
  `book_due_date` date DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `is_loan_active` tinyint(1) DEFAULT '1',
  `return_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`loan_id`, `books_book_id`, `customers_customer_id`, `staff_emp_id`, `book_due_date`, `issue_date`, `is_loan_active`, `return_date`) VALUES
(1, 1, 2, 2, '2020-12-31', '2020-12-01', 0, '2020-12-10'),
(2, 2, 1, 2, '2020-12-03', '2020-12-01', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `publisher_id` int(11) NOT NULL,
  `publisher_name` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `ph_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`publisher_id`, `publisher_name`, `address`, `state`, `country`, `ph_number`) VALUES
(1, 'Evergreen', '5829, xyz St.', 'NJ', 'USA', '4491949144'),
(2, 'J&J', '4929, fsa PL', 'NY', 'USA', '4810003144'),
(3, 'East publication House ', '444, Naj st. ', 'TX', 'USA', '1149192222');

-- --------------------------------------------------------

--
-- Table structure for table `publisher_has_books`
--

CREATE TABLE `publisher_has_books` (
  `id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publisher_has_books`
--

INSERT INTO `publisher_has_books` (`id`, `publisher_id`, `book_id`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 2, 1),
(4, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `emp_id` int(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `phone_number` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `DOB` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`emp_id`, `first_name`, `last_name`, `phone_number`, `address`, `state`, `country`, `email`, `DOB`) VALUES
(1, 'Adam', 'Williamson', '4929141444', '492, Jason St.', 'NY', 'USA', 'awill@yahoo.com', '2001-02-02'),
(2, 'Sophia', 'Jacob ', '4418499111', '4944, Jackson Blvd.', 'NJ', 'USA', 'sjacob@gmail.com', '1990-04-10'),
(3, 'Andrew ', 'Garcia', '9481044441', '1184, John St.', 'NY', 'USA', 'agarcia@yahoo.com', '1999-03-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `customer_delete_date`
--
ALTER TABLE `customer_delete_date`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_insert_date`
--
ALTER TABLE `customer_insert_date`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`loan_id`),
  ADD KEY `fk_loan_books1_idx` (`books_book_id`),
  ADD KEY `fk_loan_staff1_idx` (`staff_emp_id`),
  ADD KEY `fk_loan_customers1_idx` (`customers_customer_id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`publisher_id`),
  ADD KEY `publisher_id` (`publisher_id`);

--
-- Indexes for table `publisher_has_books`
--
ALTER TABLE `publisher_has_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publisher_id_idx` (`publisher_id`),
  ADD KEY `book_id_idx` (`book_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `customer_delete_date`
--
ALTER TABLE `customer_delete_date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customer_insert_date`
--
ALTER TABLE `customer_insert_date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `publisher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `publisher_has_books`
--
ALTER TABLE `publisher_has_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `books_book_id` FOREIGN KEY (`books_book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customers_customer_id` FOREIGN KEY (`customers_customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_emp_id` FOREIGN KEY (`staff_emp_id`) REFERENCES `staff` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `publisher_has_books`
--
ALTER TABLE `publisher_has_books`
  ADD CONSTRAINT `book_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `publisher_id` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`publisher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
