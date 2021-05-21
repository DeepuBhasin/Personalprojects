-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2021 at 08:10 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contract_supplies_system`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_add_contract` (IN `in_project_no` INT, IN `in_contract_price` FLOAT, IN `in_description_of_contract_in` VARCHAR(255), IN `in_date_required` DATETIME)  BEGIN 
SET @total_already = (SELECT count(*) as total_already FROM contract_table where description_of_contract=in_description_of_contract_in and contract_price=in_contract_price);
SET @total_exist = (SELECT count(*) as total_exist FROM project_table where project_no=in_project_no);
SET @total_count = (SELECT count(*) as total_count FROM contract_table WHERE created_dt BETWEEN (SELECT DATE_SUB(LAST_DAY(NOW()),INTERVAL DAY(LAST_DAY(NOW()))-
1 DAY) AS 'FIRST DAY OF CURRENT MONTH') and (SELECT LAST_day(now())) ORDER BY created_dt);
  IF(@total_already>0) THEN 
    SELECT 'Error ! Contract Already Exist';
 ELSEIF(@total_exist=0) THEN 
    SELECT 'Error ! Project Don not exist';
 ELSEIF(@total_count <=50) THEN
      INSERT INTO contract_table (project_no,contract_price, description_of_contract,date_required,created_dt) VALUES (in_project_no,in_contract_price,in_description_of_contract_in,in_date_required, CURRENT_TIMESTAMP());
      SELECT 'Contract Added Successfully'; 
   ELSE
    SELECT 'Error ! You Can only Enter 50 Contract Per Month';
End if;    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_add_item_table` (IN `in_contract_id` INT, IN `in_type_of_item` VARCHAR(255), IN `in_quantity_of_item` INT, IN `in_total_price` FLOAT, IN `in_item_description` VARCHAR(255))  BEGIN 
SET @total_already = (SELECT count(*) as total_already FROM item_table where contract_id=in_contract_id and type_of_item=in_type_of_item and quantity_of_item = in_quantity_of_item and total_price = in_total_price and item_description=in_item_description);
SET @total_exist = (SELECT count(*) as total_exist FROM contract_table WHERE contract_no=in_contract_id);
SET @maximum_price = (SELECT contract_price FROM contract_table WHERE contract_no=in_contract_id);

SET @price = (SELECT SUM(total_price) as price FROM item_table WHERE contract_id=in_contract_id) + in_total_price;
SET @total_quantity = (SELECT IF(SUM(quantity_of_item)is not null,SUM(quantity_of_item),0) as total_quantity FROM item_table WHERE contract_id=contract_id) + in_quantity_of_item;
IF(@total_exist=0) THEN 
    SELECT 'Error ! Contract Don not exist';
 ELSEIF(@total_already>0) THEN 
    SELECT 'Error ! Item with same contract_no, type_of_item, quantity_of_item, total_price and item_description';
 ELSEIF(@price>@maximum_price) THEN 
    SELECT 'Error ! Item cannot added beacuse your items amount exceed Contract Amount';
 ELSEIF(@total_quantity>500) THEN 
    SELECT 'Error ! You Exceed 500 limit so you cannot add more item in this contract ';
 ELSE
      INSERT INTO  item_table(contract_id,type_of_item, quantity_of_item,total_price,item_description,created_dt) VALUES (in_contract_id,in_type_of_item,in_quantity_of_item,in_total_price,in_item_description,CURRENT_TIMESTAMP());
      SELECT 'Item Added Successfully'; 
  End if;    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_add_order` (IN `in_item_table_id` INT, IN `in_contract_no` FLOAT, IN `in_supplier_id` INT, IN `in_price` FLOAT, IN `in_date_required` DATETIME, IN `in_date_complete` DATETIME, IN `in_order_qty` INT)  BEGIN 
  SET @check_contract= (SELECT COUNT(*) FROM order_table where contract_no=in_contract_no);
  SET @check_already= (SELECT COUNT(*) FROM order_table where item_table_id=in_item_table_id and contract_no=in_contract_no and supplier_id=in_supplier_id and price=in_price and date_required=in_date_required and date_complete=in_date_complete and order_qty=in_order_qty);
  
  SET @check_item= (SELECT COUNT(*) FROM  item_table where item_no=in_item_table_id);
  SET @check_contract= (SELECT COUNT(*) FROM contract_table where contract_no=in_contract_no);
  SET @check_supplier= (SELECT COUNT(*) FROM supplier_table where supplier_no=in_supplier_id);


  IF(@check_already>0) THEN 
      SELECT 'Error ! Ordder Already Created';
  ELSEIF(@check_contract>6000) THEN 
      SELECT 'Error ! You cannot place more than 600';
  ELSEIF(@check_contract=0) THEN 
      SELECT 'Error ! Contract not Exist';
  ELSEIF(@check_item=0) THEN 
      SELECT 'Error ! Item not Exist';
  ELSEIF(@check_supplier=0) THEN 
      SELECT 'Error ! Supplier not Exist';         
  ELSE
      INSERT INTO order_table (item_table_id,contract_no,supplier_id,price,date_required,date_complete,order_qty) VALUES (in_item_table_id,in_contract_no,in_supplier_id,in_price,in_date_required,in_date_complete,in_order_qty); 
      SELECT 'order Added Successfully.';   
  End if;    
  END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_add_project` (IN `in_project_data` VARCHAR(45))  BEGIN 
SET @total_ready = (SELECT count(*) as total_ready FROM project_table where project_data=in_project_data order by created_dt ASC);
SET @total_count = (SELECT count(*) as total_count FROM project_table WHERE created_dt BETWEEN (SELECT DATE_SUB(LAST_DAY(NOW()),INTERVAL DAY(LAST_DAY(NOW()))-
1 DAY) AS 'FIRST DAY OF CURRENT MONTH') and (SELECT LAST_day(now())) ORDER BY created_dt);
  IF(@total_ready>0) THEN 
    SELECT 'Error ! Your project is already Created';
  ELSEIF(@total_count <=50) THEN
    INSERT INTO project_table (project_data, created_dt) VALUES (in_project_data,CURRENT_TIMESTAMP()); 
    SELECT 'Project Added Successfully.';   
    
ELSE
    SELECT 'Error ! You Can only Enter 50 Projects Per Month';
End if;    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_add_purposl` (IN `in_contract_id` INT, IN `in_supplier_id` INT, IN `in_contract_amount` FLOAT)  BEGIN 
  SET @total_already = (SELECT count(*) as total_already FROM purposal_table where contract_id=in_contract_id and supplier_id=in_supplier_id and contract_amount=in_contract_amount);
  
  SET @check_contract= (SELECT COUNT(*) FROM contract_table where contract_no=in_contract_id);
  SET @check_supplier= (SELECT COUNT(*) FROM supplier_table where supplier_no=in_supplier_id);


  SET @amount = (SELECT contract_price FROM contract_table where contract_no=in_contract_id);
  IF(@total_already>0) THEN 
      SELECT 'Error ! Purposal Already Created';
  ELSEIF(@check_contract=0) THEN 
      SELECT 'Error ! Contract not Exist';
  ELSEIF(@check_supplier=0) THEN 
      SELECT 'Error ! Supplier not Exist';         
  ELSEIF(@amount<in_contract_amount) THEN 
      SELECT 'Error ! Purposal Amount is greater than contract amount';    
    ELSE
      INSERT INTO purposal_table (contract_id,supplier_id,contract_amount,date_of_purposal) VALUES (in_contract_id,in_supplier_id,in_contract_amount,CURRENT_TIMESTAMP()); 
      SELECT 'Purposal Added Successfully.';   
  End if;    
  END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_add_supplier` (IN `in_supplier_name` VARCHAR(45), IN `in_email_id` VARCHAR(45), IN `in_phone_number` VARCHAR(45), IN `in_supplier_address` VARCHAR(45))  BEGIN 
  SET @total_already = (SELECT count(*) as total_already FROM supplier_table where phone_number=in_phone_number);
  IF(@total_already>0) THEN 
      SELECT 'Error ! Supplier Already Created';
    ELSE
      INSERT INTO supplier_table (supplier_name,email_id,phone_number,supplier_address) VALUES (in_supplier_name,in_email_id,in_phone_number,in_supplier_address); 
      SELECT 'Supplier Added Successfully.';   
  End if;    
  END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_show_contract` ()  BEGIN 
SELECT c.*,p.project_data,p.created_dt FROM contract_table as c INNER JOIN project_table as p ON p.project_no=c.project_no ORDER BY p.created_dt ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_show_item_contract_project` ()  BEGIN 
SELECT t.*,c.*,t.* FROM item_table as t INNER JOIN contract_table as c ON c.contract_no=t.contract_id INNER JOIN project_table as p On p.project_no=c.project_no ORDER BY p.project_no ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_show_order_item_contract_project` ()  BEGIN 
SELECT o.*,i.*,c.*,pr.* FROM order_table as o INNER JOIN supplier_table as s ON s.supplier_no=o.supplier_id INNER JOIN contract_table as c ON c.contract_no=o.contract_no INNER JOIN item_table as i ON i.item_no=o.item_table_id INNER JOIN project_table as pr ON pr.project_no=c.project_no ORDER BY pr.created_dt ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_show_project` ()  BEGIN 
SELECT * FROM project_table ORDER BY project_data ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_show_purposal_supplier_contract` ()  BEGIN 
SELECT p.*,c.*,pr.* FROM purposal_table as p INNER JOIN supplier_table as s ON s.supplier_no=p.supplier_id INNER JOIN contract_table as c ON c.contract_no=p.contract_id INNER JOIN project_table as pr ON pr.project_no=c.project_no ORDER BY pr.created_dt ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_show_supplier` ()  BEGIN 
SELECT * FROM supplier_table ORDER BY supplier_name ASC;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `contract_table`
--

CREATE TABLE `contract_table` (
  `contract_no` int(6) NOT NULL,
  `project_no` int(11) NOT NULL,
  `contract_price` float NOT NULL,
  `description_of_contract` varchar(255) NOT NULL,
  `created_dt` datetime NOT NULL,
  `date_required` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contract_table`
--

INSERT INTO `contract_table` (`contract_no`, `project_no`, `contract_price`, `description_of_contract`, `created_dt`, `date_required`) VALUES
(1, 1, 50000, 'This is a tender for the material of roof slab of hospital building', '2021-05-08 22:39:17', '2021-05-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `item_table`
--

CREATE TABLE `item_table` (
  `item_no` int(6) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `type_of_item` varchar(255) NOT NULL,
  `quantity_of_item` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `created_dt` datetime NOT NULL,
  `item_description` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_table`
--

INSERT INTO `item_table` (`item_no`, `contract_id`, `type_of_item`, `quantity_of_item`, `total_price`, `created_dt`, `item_description`) VALUES
(1, 1, 'Steel', 15, 1250, '2021-05-08 22:59:14', 'Steel bar with high yielding point. High shear strength'),
(2, 1, 'Cement bags', 200, 2350, '2021-05-08 23:05:14', 'It is a greyish color which don\'t have lumps and it is a good binding material');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `id` int(11) NOT NULL,
  `item_table_id` int(11) NOT NULL,
  `contract_no` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `date_required` datetime NOT NULL,
  `date_complete` datetime NOT NULL,
  `order_qty` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`id`, `item_table_id`, `contract_no`, `supplier_id`, `price`, `date_required`, `date_complete`, `order_qty`) VALUES
(1, 1, 1, 2, 320, '2021-05-15 00:00:00', '2021-05-15 00:00:00', 50);

-- --------------------------------------------------------

--
-- Table structure for table `project_table`
--

CREATE TABLE `project_table` (
  `project_no` int(11) NOT NULL,
  `project_data` varchar(255) NOT NULL,
  `created_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_table`
--

INSERT INTO `project_table` (`project_no`, `project_data`, `created_dt`) VALUES
(1, 'Construction of Kids Hospital', '2021-05-08 14:00:00'),
(2, 'Construction of Boys Hostel', '2021-05-01 15:00:00'),
(3, 'Construction of school', '2021-05-08 16:43:12'),
(4, 'Construction of villa', '2021-05-08 16:43:53');

-- --------------------------------------------------------

--
-- Table structure for table `purposal_table`
--

CREATE TABLE `purposal_table` (
  `id` int(11) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `contract_amount` float NOT NULL,
  `date_of_purposal` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purposal_table`
--

INSERT INTO `purposal_table` (`id`, `contract_id`, `supplier_id`, `contract_amount`, `date_of_purposal`) VALUES
(1, 1, 2, 45000, '2021-05-09 00:08:32');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_table`
--

CREATE TABLE `supplier_table` (
  `supplier_no` int(11) NOT NULL,
  `supplier_name` varchar(20) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `supplier_address` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_table`
--

INSERT INTO `supplier_table` (`supplier_no`, `supplier_name`, `email_id`, `phone_number`, `supplier_address`) VALUES
(2, 'Fluor Aus Pty Ltd', 'FluorAustralia@gmail.com', '+61 8 9278 7555', 'Level 1, The Atrium, 168 St Georges Terrace, Perth WA 6000, Australia'),
(3, 'ADCO Const', 'ADCOConstructionsSydney@gmail.com', '+61 2 8437 5000', ' Level 2/7-9 West St, North Sydney NSW 2060, Australia'),
(4, 'Vaughan Const', 'VaughanConstructions@gmail.com', '+61 2 9502 4544', '9A Commercial Rd, Kingsgrove NSW 2208, Australia'),
(5, 'Ferrovial Constructs', 'FerrovialConstruction@gmail.com', '+61 2 8736 9600', '9/65 Berry St, North Sydney NSW 2060, Australia'),
(6, 'CPB Contractors', 'CPBContractors@gmail.com', '+61 2 8668 6000', '2&4/177 Pacific Hwy, North Sydney NSW 2060, Australia'),
(7, 'Leighton Contracts', 'LeightonContractors@gmail.com', '+61 8 8980 6300', '62 Cavenagh St, Darwin City NT 0800, Australia'),
(8, 'Sida Dev', 'sidedev@gmail.com', '09780038419', '41-L, Lehal Colony');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contract_table`
--
ALTER TABLE `contract_table`
  ADD PRIMARY KEY (`contract_no`);

--
-- Indexes for table `item_table`
--
ALTER TABLE `item_table`
  ADD PRIMARY KEY (`item_no`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_contract_no_new` (`contract_no`);

--
-- Indexes for table `project_table`
--
ALTER TABLE `project_table`
  ADD PRIMARY KEY (`project_no`);

--
-- Indexes for table `purposal_table`
--
ALTER TABLE `purposal_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_table`
--
ALTER TABLE `supplier_table`
  ADD PRIMARY KEY (`supplier_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contract_table`
--
ALTER TABLE `contract_table`
  MODIFY `contract_no` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `item_table`
--
ALTER TABLE `item_table`
  MODIFY `item_no` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `project_table`
--
ALTER TABLE `project_table`
  MODIFY `project_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `purposal_table`
--
ALTER TABLE `purposal_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `supplier_table`
--
ALTER TABLE `supplier_table`
  MODIFY `supplier_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
